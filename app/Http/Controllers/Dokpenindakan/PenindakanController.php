<?php

namespace App\Http\Controllers\Dokpenindakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TblKemasan;
use App\Models\TblJenisPelanggaran;
use App\Models\TblSegel;
use App\Models\TblNoRef;
use App\Models\TblLaporanInformasi;
use App\Models\TblSbp;
use App\Models\TblNegara;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class PenindakanController extends Controller
{
    public function index()
    {
        $penindakans = TblSbp::select('id', 'tgl_sbp', 'no_sbp')->get();

        $penindakans = $penindakans->map(function ($item) {
            $item->tgl_sbp = $this->formatDates(['tgl_sbp' => $item->tgl_sbp])['tgl_sbp'];
            return $item;
        });

        $laporanInformasi = TblLaporanInformasi::select('no_print', 'tanggal_mulai_print', 'no_li', 'tgl_li', 'id_pra_penindakan')
            ->get()
            ->map(function ($item) {
                $item->tanggal_mulai_print = $this->formatDates(['tanggal_mulai_print' => $item->tanggal_mulai_print])['tanggal_mulai_print'];
                $item->tgl_li = $this->formatDates(['tgl_li' => $item->tgl_li])['tgl_li'];
                return $item;
            });


        return view('Dokpenindakan.penindakan.index', compact('laporanInformasi', 'penindakans'));
    }


    public function create(Request $request)
    {
        $id_pra_penindakan_SBP = $request->query('id_pra_penindakan_SBP');
        $id_pra_penindakan_NON_SBP = $request->query('id_pra_penindakan_NON_SBP');

        $kategori = $id_pra_penindakan_SBP ? 'SBP' : ($id_pra_penindakan_NON_SBP ? 'NON-SBP' : null);
        $id_pra_penindakan = $id_pra_penindakan_SBP ?? $id_pra_penindakan_NON_SBP;

        if (!$id_pra_penindakan) {
            return redirect()->back()->withErrors('Parameter id_pra_penindakan tidak ditemukan.');
        }

        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $id_pra_penindakan)->first();

        if (!$laporan) {
            return redirect()->back()->withErrors('Data dengan id_pra_penindakan tidak ditemukan.');
        }

        $users = User::all();
        $segels = TblSegel::all();
        $kemasans = TblKemasan::all();
        $no_ref = TblNoRef::first();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $jenisPelanggaran = TblJenisPelanggaran::all();

        return view('Dokpenindakan.penindakan.create', compact(
            'users',
            'segels',
            'kemasans',
            'jenisPelanggaran',
            'no_ref',
            'laporan',
            'id_pra_penindakan',
            'kategori',
            'nama_negara'
        ));
    }



    public function store(Request $request)
    {
        TblSbp::create($request->all());
        $no_ref = TblNoRef::first();
        $no_ref->no_sbp += 1;
        $no_ref->no_ba_henti += 1;
        $no_ref->no_ba_riksa += 1;
        $no_ref->no_ba_riksa_badan += 1;
        $no_ref->no_ba_sarkut += 1;
        $no_ref->no_ba_contoh += 1;
        $no_ref->no_ba_dok += 1;
        $no_ref->no_ba_tegah += 1;
        $no_ref->no_ba_segel += 1;
        $no_ref->no_ba_titip += 1;
        $no_ref->no_ba_tolak_1 += 1;
        $no_ref->no_ba_tolak_2 += 1;
        $no_ref->save();

        return redirect()->route('penindakan.index')->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');
    }


    public function edit($id)
    {
        $penindakans = TblSbp::findOrFail($id);
        $users = User::all();
        $segels = TblSegel::all();
        $kemasans = TblKemasan::all();
        $no_ref = TblNoRef::first();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $jenisPelanggaran = TblJenisPelanggaran::all();

        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakans->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print']);



        return view('Dokpenindakan.penindakan.edit', compact(
            'penindakans',
            'users',
            'segels',
            'kemasans',
            'jenisPelanggaran',
            'no_ref',
            'laporan',
            'nama_negara'
        ));
    }



    public function update($id)
    {
        $data = request()->all();

        $item = TblSbp::find($id);
        if ($item) {
            $item->update($data);
            return redirect()->route('penindakan.index')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->route('penindakan.index')->with('error', 'Data tidak ditemukan.');
    }

    public function destroy($id)
    {
        $penindakan = TblSbp::find($id);
        if ($penindakan) {
            $penindakan->delete();
            return redirect()->route('penindakan.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('penindakan.index')->with('error', 'Data tidak ditemukan.');
    }



    public function getNomorSegel($id)
    {
        $segel = TblSegel::find($id);
        return response()->json(['nomor_segel' => $segel->nomor_segel ?? '']);
    }


    public function print_surat_sbp($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();

        $pejabatKeys = [
            'id_petugas_1_sbp',
            'id_petugas_2_sbp',
        ];

        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->getPejabat($key)->first();



                if ($pejabat) {
                    $data[$key . '_nama'] = $pejabat->nama_admin;
                    $data[$key . '_pangkat'] = $pejabat->pangkat;
                    $data[$key . '_jabatan'] = $pejabat->jabatan;
                    $data[$key . '_nip'] = $pejabat->nip;
                } else {
                    $data[$key . '_nama'] = '';
                    $data[$key . '_pangkat'] = '';
                    $data[$key . '_jabatan'] = '';
                    $data[$key . '_nip'] = '';
                }
            }
        }

        // dd($data);

        $kode_kantor = "KPU.2";

        $no_sprint = $penindakan->no_print . " tanggal " . $this->formatDates(['tgl_print' => $penindakan->tgl_print])['tgl_print'];
        $data['no_sprint'] = $no_sprint;

        $ba_pemeriksaan = $penindakan->no_ba_riksa != "" ? "BA-" . ltrim($penindakan->no_ba_riksa, '0') . "/Riksa/" . $kode_kantor . "/" . date('Y') : "--";
        $data['ba_pemeriksaan'] = $ba_pemeriksaan;


        $ba_penegahan = $penindakan->no_ba_tegah != "" ? "BA-" . ltrim($penindakan->no_ba_tegah, '0') . "/Tegah/" . $kode_kantor . "/" . date('Y') : "--";
        $data['ba_penegahan'] = $ba_penegahan;


        $ba_penyegelan = $penindakan->no_ba_segel != "" ? "BA-" . ltrim($penindakan->no_ba_segel, '0') . "/Segel/" . $kode_kantor . "/" . date('Y') : "--";
        $data['ba_penyegelan'] = $ba_penyegelan;


        $tindakan_lain = $penindakan->no_ba_lainnya != "" ? "BA-" . ltrim($penindakan->no_ba_lainnya, '0') . "/Lainnya/" . $kode_kantor . "/" . date('Y') : "--";
        $data['tindakan_lain'] = $tindakan_lain;



        $data = $this->formatDates($data);

        $data = array_map(function ($value) {
            return is_null($value) ? '-' : $value;
        }, $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-bukti-penindakan.docx'));



        $tglSbp = $penindakan->tgl_sbp;

        if (!empty($tglSbp)) {
            $tahunSbp = date('Y', strtotime($tglSbp));
        } else {
            $tahunSbp = '-';
        }

        $data['tahun_sbp'] = $tahunSbp;

        $templateProcessor->setValue('tahun_sbp', $tahunSbp);

        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $nosbp = $data['no_sbp'];
            $tahunSbp  = $data['tahun_sbp'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatSbp'] = "SBP-{$nosbp}/MANDIRI/KPU.2/{$tahunSbp}";
                    break;
                case 'PERBANTUAN':
                    $data['formatSbp'] = "SBP-{$nosbp}/PERBANTUAN/KPU.2/{$tahunSbp}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatSbp'] = "SBP-{$nosbp}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.2/{$tahunSbp}";
                    break;
                default:
                    $data['formatSbp'] = "SBP-{$nosbp}/UNKNOWN/KPU.2/{$tahunSbp}";
                    break;
            }
        } else {
            $data['formatSbp'] = "SBP-{$data['no_sbp']}/UNKNOWN/KPU.2/{$data['tahun_sbp']}";
        }

        $data['no_print'] = $laporan->no_print ?? '-';
        $data['tgl_print'] = $laporan->tgl_print ?? '-';
        $data['skem_penindakan_sbp'] = $laporan->skema_penindakan_perintah ?? '-';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }


        // dd($data);

        $templateProcessor->setValues($data);

        $fileName = 'Dokumen_Surat_Bukti_Penindakan_Nomor_' . $penindakan->no_sbp . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }



    public function print_ba_riksa($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();
        Carbon::setLocale('id');


        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }


        if ($laporan && $laporan->id_pejabat_sp_2) {
            $penindakan->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }


        $pejabatKeys = [
            'id_pejabat_1_ba_riksa',
            'id_pejabat_2_ba_riksa',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        if (!empty($data['tgl_ba_riksa']) && $this->isValidDate($data['tgl_ba_riksa'])) {
            $tglBaRiksa = Carbon::parse($data['tgl_ba_riksa']);
            $namaHari = $tglBaRiksa->translatedFormat('l');
            $tanggal = $tglBaRiksa->translatedFormat('d');
            $bulan = $tglBaRiksa->translatedFormat('F');
            $tahun = $tglBaRiksa->translatedFormat('Y');

            $data['formatBaRiksa'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaRiksa'] = '';
        }



        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '-' : $value, $data);



        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/beritaacara/ba-riksa.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglRiksa = $penindakan->tgl_ba_riksa;

        if (!empty($tglRiksa)) {
            $tahunBaRiksa = date('Y', strtotime($tglRiksa));
        } else {
            $tahunBaRiksa = '-';
        }

        $data['tahun_riksa'] = $tahunBaRiksa;

        $templateProcessor->setValue('tahun_riksa', $tahunBaRiksa);


        // dd($data);


        $fileName = 'Dokumen_Penindakan_Berita_Acara_Pemeriksaan_Nomor_' . $penindakan->no_ba_riksa . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_ba_riksa_badan($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();
        Carbon::setLocale('id');


        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }


        if ($laporan && $laporan->id_pejabat_sp_2) {
            $penindakan->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }


        $pejabatKeys = [
            'id_pejabat_1_ba_riksa_badan',
            'id_pejabat_2_ba_riksa_badan',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        if (!empty($data['tgl_ba_riksa_badan']) && $this->isValidDate($data['tgl_ba_riksa_badan'])) {
            $tglBaRiksaBadan = Carbon::parse($data['tgl_ba_riksa_badan']);
            $namaHari = $tglBaRiksaBadan->translatedFormat('l');
            $tanggal = $tglBaRiksaBadan->translatedFormat('d');
            $bulan = $tglBaRiksaBadan->translatedFormat('F');
            $tahun = $tglBaRiksaBadan->translatedFormat('Y');

            $data['formatBaRiksaBadan'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaRiksaBadan'] = '';
        }



        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '-' : $value, $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/beritaacara/ba-riksa-badan.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglRiksaBadan = $penindakan->tgl_ba_riksa_badan;

        if (!empty($tglRiksaBadan)) {
            $tahunBaRiksaBadan = date('Y', strtotime($tglRiksaBadan));
        } else {
            $tahunBaRiksaBadan = '-';
        }

        $data['tahun_riksa'] = $tahunBaRiksaBadan;

        $templateProcessor->setValue('tahun_riksa_badan', $tahunBaRiksaBadan);


        // dd($data);


        $fileName = 'Dokumen_Penindakan_Berita_Acara_Pemeriksaan_Badan_Nomor_' . $penindakan->no_ba_riksa_badan . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_ba_sarkut($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();
        Carbon::setLocale('id');


        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }


        if ($laporan && $laporan->id_pejabat_sp_2) {
            $penindakan->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }


        $pejabatKeys = [
            'id_pejabat_1_ba_sarkut',
            'id_pejabat_2_ba_sarkut',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        if (!empty($data['tgl_ba_sarkut']) && $this->isValidDate($data['tgl_ba_sarkut'])) {
            $tglBaSarkut = Carbon::parse($data['tgl_ba_sarkut']);
            $namaHari = $tglBaSarkut->translatedFormat('l');
            $tanggal = $tglBaSarkut->translatedFormat('d');
            $bulan = $tglBaSarkut->translatedFormat('F');
            $tahun = $tglBaSarkut->translatedFormat('Y');

            $data['formatBaSarkut'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaSarkut'] = '';
        }



        if (!empty($data['waktu_berangkat']) && Carbon::hasFormat($data['waktu_berangkat'], 'Y-m-d H:i')) {
            $waktuBerangkat = Carbon::parse($data['waktu_berangkat']);
            $tanggal = $waktuBerangkat->translatedFormat('d');
            $bulan = $waktuBerangkat->translatedFormat('F');
            $tahun = $waktuBerangkat->translatedFormat('Y');
            $jamMenit = $waktuBerangkat->translatedFormat('H:i');

            $data['waktuBerangkat'] = "Tanggal $tanggal bulan $bulan tahun $tahun pukul $jamMenit";
        } else {
            $data['waktuBerangkat'] = '-';
        }

        if (!empty($data['waktu_tiba']) && Carbon::hasFormat($data['waktu_tiba'], 'Y-m-d H:i')) {
            $waktuTiba = Carbon::parse($data['waktu_tiba']);
            $tanggal = $waktuTiba->translatedFormat('d');
            $bulan = $waktuTiba->translatedFormat('F');
            $tahun = $waktuTiba->translatedFormat('Y');
            $jamMenit = $waktuTiba->translatedFormat('H:i');

            $data['waktuTiba'] = "Tanggal $tanggal bulan $bulan tahun $tahun pukul $jamMenit";
        } else {
            $data['waktuTiba'] = '-';
        }


        // dd($data['waktu_berangkat'], $data['waktu_tiba']);



        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '-' : $value, $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/beritaacara/ba-sarkut.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglSarkut = $penindakan->tgl_ba_sarkut;

        if (!empty($tglSarkut)) {
            $tahunBaSarkut = date('Y', strtotime($tglSarkut));
        } else {
            $tahunBaSarkut = '-';
        }

        $data['tahun_sarkut'] = $tahunBaSarkut;

        $templateProcessor->setValue('tahun_sarkut', $tahunBaSarkut);


        // dd($data);


        $fileName = 'Dokumen_Penindakan_Berita_Acara_Membawa_Sarana_Pengangkut_Nomor_' . $penindakan->no_ba_sarkut . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_ba_contoh($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();
        Carbon::setLocale('id');


        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }


        if ($laporan && $laporan->id_pejabat_sp_2) {
            $penindakan->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }


        $pejabatKeys = [
            'id_pejabat_1_ba_contoh',
            'id_pejabat_2_ba_contoh',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        if (!empty($data['tgl_ba_contoh']) && $this->isValidDate($data['tgl_ba_contoh'])) {
            $tglBaContoh = Carbon::parse($data['tgl_ba_contoh']);
            $namaHari = $tglBaContoh->translatedFormat('l');
            $tanggal = $tglBaContoh->translatedFormat('d');
            $bulan = $tglBaContoh->translatedFormat('F');
            $tahun = $tglBaContoh->translatedFormat('Y');

            $data['formatBaContoh'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaContoh'] = '';
        }





        // dd($data['waktu_berangkat'], $data['waktu_tiba']);



        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '-' : $value, $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/beritaacara/ba-contoh.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglContoh = $penindakan->tgl_ba_contoh;

        if (!empty($tglContoh)) {
            $tahunBaContoh = date('Y', strtotime($tglContoh));
        } else {
            $tahunBaContoh = '-';
        }

        $data['tahun_contoh'] = $tahunBaContoh;

        $templateProcessor->setValue('tahun_contoh', $tahunBaContoh);


        // dd($data);


        $fileName = 'Dokumen_Penindakan_Berita_Acara_Pengambilan_Contoh_Barang_Nomor_' . $penindakan->no_ba_contoh . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_ba_dokumentasi($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();
        Carbon::setLocale('id');


        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }


        if ($laporan && $laporan->id_pejabat_sp_2) {
            $penindakan->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }


        $pejabatKeys = [
            'id_pejabat_1_ba_dokumentasi',
            'id_pejabat_2_ba_dokumentasi',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        if (!empty($data['tgl_ba_dok']) && $this->isValidDate($data['tgl_ba_dok'])) {
            $tglBaDokumentasi = Carbon::parse($data['tgl_ba_dok']);
            $namaHari = $tglBaDokumentasi->translatedFormat('l');
            $tanggal = $tglBaDokumentasi->translatedFormat('d');
            $bulan = $tglBaDokumentasi->translatedFormat('F');
            $tahun = $tglBaDokumentasi->translatedFormat('Y');

            $data['formatBaDokumentasi'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaDokumentasi'] = '';
        }





        // dd($data['waktu_berangkat'], $data['waktu_tiba']);



        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '-' : $value, $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/beritaacara/ba-dokumentasi.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglDokumentasi = $penindakan->tgl_ba_dok;

        if (!empty($tglDokumentasi)) {
            $tahunBaDokumentasi = date('Y', strtotime($tglDokumentasi));
        } else {
            $tahunBaDokumentasi = '-';
        }

        $data['tahun_dokumentasi'] = $tahunBaDokumentasi;

        $templateProcessor->setValue('tahun_dokumentasi', $tahunBaDokumentasi);


        // dd($data);


        $fileName = 'Dokumen_Penindakan_Berita_Acara_Pengambilan_Contoh_Barang_Nomor_' . $penindakan->no_ba_contoh . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_ba_segel($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();
        Carbon::setLocale('id');


        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }


        if ($laporan && $laporan->id_pejabat_sp_2) {
            $penindakan->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }


        $pejabatKeys = [
            'id_pejabat_1_ba_segel',
            'id_pejabat_2_ba_segel',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        if (!empty($data['tgl_ba_segel']) && $this->isValidDate($data['tgl_ba_segel'])) {
            $tglBaSegel = Carbon::parse($data['tgl_ba_segel']);
            $namaHari = $tglBaSegel->translatedFormat('l');
            $tanggal = $tglBaSegel->translatedFormat('d');
            $bulan = $tglBaSegel->translatedFormat('F');
            $tahun = $tglBaSegel->translatedFormat('Y');

            $data['formatBaSegel'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaSegel'] = '';
        }



        // dd($data['waktu_berangkat'], $data['waktu_tiba']);



        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '-' : $value, $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/beritaacara/ba-segel.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglSegel = $penindakan->tgl_ba_segel;

        if (!empty($tglSegel)) {
            $tahunBaSegel = date('Y', strtotime($tglSegel));
        } else {
            $tahunBaSegel = '-';
        }

        $data['tahun_segel'] = $tahunBaSegel;

        $templateProcessor->setValue('tahun_segel', $tahunBaSegel);


        // dd($data);


        $fileName = 'Dokumen_Penindakan_Berita_Acara_Penyegelan_Nomor_' . $penindakan->no_ba_segel . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_ba_titip($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();
        Carbon::setLocale('id');


        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }


        if ($laporan && $laporan->id_pejabat_sp_2) {
            $penindakan->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }


        $pejabatKeys = [
            'id_pejabat_1_ba_titip',
            'id_pejabat_2_ba_titip',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        if (!empty($data['tgl_ba_titip']) && $this->isValidDate($data['tgl_ba_titip'])) {
            $tglBaTitip = Carbon::parse($data['tgl_ba_titip']);
            $namaHari = $tglBaTitip->translatedFormat('l');
            $tanggal = $tglBaTitip->translatedFormat('d');
            $bulan = $tglBaTitip->translatedFormat('F');
            $tahun = $tglBaTitip->translatedFormat('Y');

            $data['formatBaTitip'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaTitip'] = '';
        }

        if (!empty($penindakan->no_ba_segel) && !empty($penindakan->tgl_ba_segel) && $this->isValidDate($penindakan->tgl_ba_segel)) {
            $tahunSegel = date('Y', strtotime($penindakan->tgl_ba_segel));
            $data['formatBaSegel'] = "BA–{$penindakan->no_ba_segel}/Segel/KPU.206/{$tahunSegel}";
        } else {
            $data['formatBaSegel'] = '-';
        }


        // dd($data['waktu_berangkat'], $data['waktu_tiba']);


        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '-' : $value, $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/beritaacara/ba-titip.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglTitip = $penindakan->tgl_ba_titip;

        if (!empty($tglTitip)) {
            $tahunBaTitip = date('Y', strtotime($tglTitip));
        } else {
            $tahunBaTitip = '-';
        }

        $data['tahun_titip'] = $tahunBaTitip;

        $templateProcessor->setValue('tahun_titip', $tahunBaTitip);






        // dd($data);


        $fileName = 'Dokumen_Penindakan_Berita_Acara_Penitipan_Nomor_' . $penindakan->no_ba_titip . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_ba_tolak1($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();
        Carbon::setLocale('id');


        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }



        $tglsbp = $penindakan->tgl_sbp;

        if (!empty($tglsbp)) {
            $tahunsbp = date('Y', strtotime($tglsbp));
        } else {
            $tahunsbp = '-';
        }

        $data['tahun_sbp'] = $tahunsbp ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $nosbp = $data['no_sbp'];
            $tahunsbp = $data['tahun_sbp'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatSbp'] = "Nomor SBP-{$nosbp}/MANDIRI/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN':
                    $data['formatSbp'] = "Nomor SBP-{$nosbp}/PERBANTUAN/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatSbp'] = "Nomor SBP-{$nosbp}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunsbp}";
                    break;
                default:
                    $data['formatSbp'] = "Nomor SBP-{$nosbp}/UNKNOWN/KPU.206/{$tahunsbp}";
                    break;
            }
        } else {
            $data['formatSbp'] = "Nomor SBP-{$data['no_sbp']}/UNKNOWN/KPU.206/{$data['tahun_sbp']}";
        }




        if ($laporan && $laporan->id_pejabat_sp_2) {
            $penindakan->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }


        $pejabatKeys = [
            'id_pejabat_1_ba_tolak1',
            'id_pejabat_2_ba_tolak1',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        if (!empty($data['tgl_ba_tolak_1']) && $this->isValidDate($data['tgl_ba_tolak_1'])) {
            $tglBaTolak1 = Carbon::parse($data['tgl_ba_tolak_1']);
            $namaHari = $tglBaTolak1->translatedFormat('l');
            $tanggal = $tglBaTolak1->translatedFormat('d');
            $bulan = $tglBaTolak1->translatedFormat('F');
            $tahun = $tglBaTolak1->translatedFormat('Y');

            $data['formatBaTolak1'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaTolak1'] = '';
        }




        // dd($data['waktu_berangkat'], $data['waktu_tiba']);


        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '-' : $value, $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/beritaacara/ba-tolak-pertama.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglTolak1 = $penindakan->tgl_ba_tolak_1;

        if (!empty($tglTolak1)) {
            $tahunBaTolak1 = date('Y', strtotime($tglTolak1));
        } else {
            $tahunBaTolak1 = '-';
        }

        $data['tahun_tolak1'] = $tahunBaTolak1;

        $templateProcessor->setValue('tahun_tolak1', $tahunBaTolak1);


        // dd($data);


        $fileName = 'Dokumen_Penindakan_Berita_Acara_Penolakan_Tanda_Tangan_Surat_Bukti_Penindakan_Nomor_' . $penindakan->no_ba_tolak_1 . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_ba_tolak2($id)
    {
        $penindakan = TblSbp::findOrFail($id);

        $data = $penindakan->toArray();
        Carbon::setLocale('id');


        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $penindakan->id_pra_penindakan_ref)
            ->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);


        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }



        $tglsbp = $penindakan->tgl_sbp;

        if (!empty($tglsbp)) {
            $tahunsbp = date('Y', strtotime($tglsbp));
        } else {
            $tahunsbp = '-';
        }

        $data['tahun_sbp'] = $tahunsbp ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $nosbp = $data['no_sbp'];
            $tahunsbp = $data['tahun_sbp'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatSbp'] = "Nomor SBP-{$nosbp}/MANDIRI/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN':
                    $data['formatSbp'] = "Nomor SBP-{$nosbp}/PERBANTUAN/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatSbp'] = "Nomor SBP-{$nosbp}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunsbp}";
                    break;
                default:
                    $data['formatSbp'] = "Nomor SBP-{$nosbp}/UNKNOWN/KPU.206/{$tahunsbp}";
                    break;
            }
        } else {
            $data['formatSbp'] = "Nomor SBP-{$data['no_sbp']}/UNKNOWN/KPU.206/{$data['tahun_sbp']}";
        }




        if ($laporan && $laporan->id_pejabat_sp_2) {
            $penindakan->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }


        $pejabatKeys = [
            'id_pejabat_1_ba_tolak2',
            'id_pejabat_2_ba_tolak2',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($penindakan->$key) {
                $pejabat = $penindakan->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        if (!empty($data['tgl_ba_tolak_2']) && $this->isValidDate($data['tgl_ba_tolak_2'])) {
            $tglBaTolak2 = Carbon::parse($data['tgl_ba_tolak_2']);
            $namaHari = $tglBaTolak2->translatedFormat('l');
            $tanggal = $tglBaTolak2->translatedFormat('d');
            $bulan = $tglBaTolak2->translatedFormat('F');
            $tahun = $tglBaTolak2->translatedFormat('Y');

            $data['formatBaTolak2'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaTolak2'] = '';
        }




        // dd($data['waktu_berangkat'], $data['waktu_tiba']);


        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '-' : $value, $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/beritaacara/ba-tolak-kedua.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglTolak1 = $penindakan->tgl_ba_tolak_1;

        if (!empty($tglTolak2)) {
            $tahunBaTolak2 = date('Y', strtotime($tglTolak2));
        } else {
            $tahunBaTolak2 = '-';
        }

        $data['tahun_tolak2'] = $tahunBaTolak2;

        $templateProcessor->setValue('tahun_tolak2', $tahunBaTolak2);


        // dd($data);


        $fileName = 'Dokumen_Penindakan_Berita_Acara_Penolakan_Tanda_Tangan_Surat_Bukti_Penindakan_Nomor_' . $penindakan->no_ba_tolak_2 . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }



    private function formatDates($data)
    {
        $bulanIndo = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        Carbon::setLocale('id');

        $dateFields = [
            'tempus_pelanggaran_mpp'
        ];

        foreach ($dateFields as $field) {
            if (!empty($data[$field])) {
                if ($field == 'tempus_pelanggaran_mpp') {
                    $tempusPelanggaran = $data[$field];

                    if ($tempusPelanggaran) {
                        $date = Carbon::parse($tempusPelanggaran);
                        $formattedDate = $date->isoFormat('dddd, D MMMM YYYY');
                        $data['tempus_pelanggaran'] = $formattedDate;
                        $data['pukul'] = $date->format('H:i');
                    } else {
                        $data['tempus_pelanggaran'] = '';
                        $data['pukul'] = '';
                    }
                } else {
                    $data[$field] = date('d/m/Y H:i', strtotime($data[$field]));
                }
            }
        }

        foreach ($data as $key => $value) {
            if (is_string($value) && $this->isValidDate($value)) {
                $date = \DateTime::createFromFormat('Y-m-d', $value);
                if ($date) {
                    $formattedDate = $date->format('d F Y');

                    foreach ($bulanIndo as $englishMonth => $indonesianMonth) {
                        if (strpos($formattedDate, $englishMonth) !== false) {
                            $formattedDate = str_replace($englishMonth, $indonesianMonth, $formattedDate);
                            break;
                        }
                    }

                    $data[$key] = $formattedDate;
                }
            }
        }

        return $data;
    }




    private function isValidDate($date)
    {
        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}