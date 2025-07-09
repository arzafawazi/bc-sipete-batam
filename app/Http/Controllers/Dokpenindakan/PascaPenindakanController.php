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
use App\Models\TblLaporanPengawasan;
use App\Models\TblPascaPenindakan;
use App\Models\TblSbp;
use App\Models\TblNegara;
use App\Models\TblLocus;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class PascaPenindakanController extends Controller
{
    public function index()
    {
        $pascaPenindakan = TblPascaPenindakan::select('id', 'tgl_lphp', 'no_lphp', 'id_penindakan_ref')
            ->latest()
            ->paginate(50);

        $pascaPenindakan->getCollection()->transform(function ($item) {
            return (object) $this->formatDates($item->toArray());
        });

        $penindakan = TblSbp::select('no_sbp', 'tgl_sbp', 'id_pra_penindakan_ref', 'id_penindakan', 'opsi_penindakan')
            ->whereNotIn('id_penindakan', function ($query) {
                $query->select('id_penindakan_ref')->from('tbl_pasca_penindakan');
            })
            ->latest()
            ->limit(500)
            ->get()
            ->map(function ($item) {
                return (object) $this->formatDates($item->toArray());
            });

        return view('Dokpenindakan.pasca-penindakan.index', compact('pascaPenindakan', 'penindakan'));
    }


    public function create(Request $request)
    {
        $id_penindakan = $request->query('id_penindakan');

        $penindakan = TblSbp::where('id_penindakan', $id_penindakan)->first();
        $user = User::where('id', $penindakan->id_user)->first();

        $tglsbp = $penindakan->tgl_sbp ?? null;

        $tahunsbp = !empty($tglsbp) ? date('Y', strtotime($tglsbp)) : '-';

        $nosbp = $penindakan->no_sbp ?? '-';

        $laporan = $penindakan->laporanInformasi ?? null;

        $formatSbp = null;

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $formatSbp = "Nomor SBP-{$nosbp}/MANDIRI/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN':
                    $formatSbp = "Nomor SBP-{$nosbp}/PERBANTUAN/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $formatSbp = "Nomor SBP-{$nosbp}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunsbp}";
                    break;
                default:
                    $formatSbp = "Nomor SBP-{$nosbp}/UNKNOWN/KPU.206/{$tahunsbp}";
                    break;
            }
        } else {
            $formatSbp = "Nomor SBP-{$nosbp}/UNKNOWN/KPU.206/{$tahunsbp}";
        }

        $penindakan->tgl_sbp = $this->formatDates(['tgl_sbp' => $penindakan->tgl_sbp])['tgl_sbp'];

        $defaultKeterangan = sprintf(
            "telah menyerahkan Barang berupa %s sejumlah %s sesuai dengan Surat Bukti Penindakan nomor %s tanggal %s.\n\nBerdasarkan hasil wawancara, atas selisih kurang barang sejumlah (kurang barang), tidak dilakukan pemasukan sebagian kembali (eksep) sesuai (pasal yang berlaku).",
            $penindakan->jenis_barang ?? '-',
            $penindakan->jumlah_barang ?? '-',
            $penindakan->format_sbp = $formatSbp,
            $penindakan->tgl_sbp  ?? '-',
        );

        $users = User::all();
        $segels = TblSegel::all();
        $locus = TblLocus::all();
        $kemasans = TblKemasan::all();
        $no_ref = TblNoRef::first();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $jenisPelanggaran = TblJenisPelanggaran::all();

        return view('Dokpenindakan.pasca-penindakan.create', compact(
            'users',
            'segels',
            'kemasans',
            'jenisPelanggaran',
            'no_ref',
            'id_penindakan',
            'nama_negara',
            'penindakan',
            'locus',
            'defaultKeterangan'
        ));
    }


    public function edit($id)
    {

        $pascapenindakan = TblPascaPenindakan::findOrFail($id);

        $penindakan = TblSbp::where('id_penindakan', $pascapenindakan->id_penindakan_ref)->first();


        $users = User::all();
        $segels = TblSegel::all();
        $locus = TblLocus::all();
        $kemasans = TblKemasan::all();
        $no_ref = TblNoRef::first();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $jenisPelanggaran = TblJenisPelanggaran::all();

        return view('Dokpenindakan.pasca-penindakan.edit', compact(
            'users',
            'segels',
            'kemasans',
            'jenisPelanggaran',
            'no_ref',
            // 'id_penindakan',
            'nama_negara',
            'penindakan',
            'locus',
            'pascapenindakan'
        ));
    }

    public function update($id)
    {
        $data = request()->all();

        $item = TblPascaPenindakan::find($id);
        if ($item) {
            $item->update($data);
            return redirect()->route('pasca-penindakan.index')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->route('pasca-penindakan.index')->with('error', 'Data tidak ditemukan.');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        TblPascaPenindakan::create($request->all());
        $no_ref = TblNoRef::first();
        $no_ref->no_lphp += 1;
        $no_ref->no_bast_pemilik += 1;
        $no_ref->no_bast_instansi += 1;
        $no_ref->no_lp += 1;
        $no_ref->no_bast_penyidik += 1;
        $no_ref->no_lpt_penindakan += 1;
        $no_ref->save();

        return redirect()->route('pasca-penindakan.index')->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');
    }



    public function destroy($id)
    {
        $pascapenindakan = TblPascaPenindakan::find($id);
        if ($pascapenindakan) {
            $pascapenindakan->delete();
            return redirect()->route('pasca-penindakan.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('pasca-penindakan.index')->with('error', 'Data tidak ditemukan.');
    }


    public function print_surat_lphp($id)
    {
        $pascapenindakan = TblPascaPenindakan::with('penindakans')->findOrFail($id);

        Carbon::setLocale('id');

        $data = $this->formatDates($pascapenindakan->toArray());

        $penindakans = $pascapenindakan->penindakans;
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            $tglsbp = $penindakanArray['tgl_sbp'] ?? null;
            $formattedPenindakan['tgl_sbp'] = $tglsbp;

            $pejabatKeys = [
                'id_petugas_1_sbp',
                'id_petugas_2_sbp',
                'id_pejabat_sp_2',
            ];

            foreach ($pejabatKeys as $key) {
                if ($penindakan->$key) {
                    $pejabat = $penindakan->pejabat($key)->first();
                    $formattedPenindakan[$key . '_nama'] = $pejabat->nama_admin ?? '';
                    $formattedPenindakan[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                    $formattedPenindakan[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                    $formattedPenindakan[$key . '_nip'] = $pejabat->nip ?? '';
                } else {

                    $formattedPenindakan[$key . '_nama'] = '';
                    $formattedPenindakan[$key . '_pangkat'] = '';
                    $formattedPenindakan[$key . '_jabatan'] = '';
                    $formattedPenindakan[$key . '_nip'] = '';
                }
            }

            $formattedPenindakans[] = $formattedPenindakan;
        }

        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }

        $data['penindakans'] = $formattedPenindakans;

        $tglsbp = $data['tgl_sbp'] ?? null;
        $tahunsbp = !empty($tglsbp) ? date('Y', strtotime($tglsbp)) : '-';
        $data['tahun_sbp'] = $tahunsbp;

        $laporan = $pascapenindakan->penindakans->first()->laporanInformasi ?? null;
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

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/pasca-penindakan/surat-lphp.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglsbp = $data['tgl_sbp'] ?? null;
        if ($tglsbp) {
            $formattedTglSbp = $this->formatDates(['tgl_sbp' => $tglsbp])['tgl_sbp'] ?? '-';
            $data['tg_sbp'] = $formattedTglSbp;
        } else {
            $data['tg_sbp'] = '-';
        }

        $templateProcessor->setValue('tg_sbp', $data['tg_sbp']);

        $tglLphp = $pascapenindakan->tgl_lphp;
        $tahunLphp = !empty($tglLphp) ? date('Y', strtotime($tglLphp)) : '-';
        $data['tahun_lphp'] = $tahunLphp;

        $templateProcessor->setValue('tahun_lphp', $tahunLphp);

        $analisis_hasil_penindakan_raw = $pascapenindakan->analisis_hasil_penindakan_lphp;
        $analisis_hasil_penindakan_raw = preg_replace('/\s+/', ' ', trim($analisis_hasil_penindakan_raw));
        preg_match_all('/\#(.*?)\#/', $analisis_hasil_penindakan_raw, $matches);
        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'i' => '-',
                'hasil_tindak' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('i', $templateData);

        // dd($data);

        $fileName = "Dokumen_Pasca_Penindakan_Laporan_Penentuan_Hasil_Penindakan_Nomor_{$pascapenindakan->no_lphp}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }



    public function print_surat_lp($id)
    {
        $pascapenindakan = TblPascaPenindakan::with('penindakans')->findOrFail($id);

        Carbon::setLocale('id');

        $data = $this->formatDates($pascapenindakan->toArray());

        $penindakans = $pascapenindakan->penindakans;
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            $tglsbp = $penindakanArray['tgl_sbp'] ?? null;
            $formattedPenindakan['tgl_sbp'] = $tglsbp;

            $pejabatKeys = [
                'kepala_bidang_penindakan',
            ];

            foreach ($pejabatKeys as $key) {
                if ($pascapenindakan->$key) {
                    $pejabat = $pascapenindakan->pejabat($key)->first();
                    $formattedPenindakan[$key . '_nama'] = $pejabat->nama_admin ?? '';
                    $formattedPenindakan[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                    $formattedPenindakan[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                    $formattedPenindakan[$key . '_nip'] = $pejabat->nip ?? '';
                } else {
                    $formattedPenindakan[$key . '_nama'] = '';
                    $formattedPenindakan[$key . '_pangkat'] = '';
                    $formattedPenindakan[$key . '_jabatan'] = '';
                    $formattedPenindakan[$key . '_nip'] = '';
                }
            }

            $formattedPenindakans[] = $formattedPenindakan;
        }

        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }

        $data['penindakans'] = $formattedPenindakans;

        $tglsbp = $data['tgl_sbp'] ?? null;
        $tahunsbp = !empty($tglsbp) ? date('Y', strtotime($tglsbp)) : '-';
        $data['tahun_sbp'] = $tahunsbp;

        $laporan = $pascapenindakan->penindakans->first()->laporanInformasi ?? null;
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

        $tglLphp = $pascapenindakan->tgl_lphp;
        $tahunLphp = !empty($tglLphp) ? date('Y', strtotime($tglLphp)) : '-';
        $data['tahun_lphp'] = $tahunLphp;

        $nolphp = $data['no_lphp'] ?? '-';
        $tahunlphp = $data['tahun_lphp'];

        $data['formatLphp'] = "LPHP-{$nolphp}/KPU.206/{$tahunlphp}";



        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/pasca-penindakan/surat-lp.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglsbp = $data['tgl_sbp'] ?? null;
        if ($tglsbp) {
            $formattedTglSbp = $this->formatDates(['tgl_sbp' => $tglsbp])['tgl_sbp'] ?? '-';
            $data['tg_sbp'] = $formattedTglSbp;
        } else {
            $data['tg_sbp'] = '-';
        }

        $templateProcessor->setValue('tg_sbp', $data['tg_sbp']);

        $tgllp = $pascapenindakan->tgl_lp;
        $tahunlp = !empty($tglLphp) ? date('Y', strtotime($tgllp)) : '-';
        $data['tahun_lp'] = $tahunlp;

        $templateProcessor->setValue('tahun_lp', $tahunlp);


        // dd($data);

        $fileName = "Dokumen_Pasca_Penindakan_Laporan_Pelanggaran_Nomor_{$pascapenindakan->no_lp}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_np($id)
    {
        $pascapenindakan = TblPascaPenindakan::with('penindakans')->findOrFail($id);

        Carbon::setLocale('id');

        $data = $this->formatDates($pascapenindakan->toArray());

        $penindakans = $pascapenindakan->penindakans;
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            $tglsbp = $penindakanArray['tgl_sbp'] ?? null;
            $formattedPenindakan['tgl_sbp'] = $tglsbp;

            $pejabatKeys = [
                'id_kepala_seksi_penindakan',
            ];

            foreach ($pejabatKeys as $key) {
                if ($pascapenindakan->$key) {
                    $pejabat = $pascapenindakan->pejabat($key)->first();
                    $formattedPenindakan[$key . '_nama'] = $pejabat->nama_admin ?? '';
                    $formattedPenindakan[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                    $formattedPenindakan[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                    $formattedPenindakan[$key . '_nip'] = $pejabat->nip ?? '';
                } else {

                    $formattedPenindakan[$key . '_nama'] = '';
                    $formattedPenindakan[$key . '_pangkat'] = '';
                    $formattedPenindakan[$key . '_jabatan'] = '';
                    $formattedPenindakan[$key . '_nip'] = '';
                }
            }

            $formattedPenindakans[] = $formattedPenindakan;
        }

        $tgllp = $pascapenindakan->tgl_lp;
        $tahunlp = !empty($tgllp) ? date('Y', strtotime($tgllp)) : '-';
        $data['tahun_lp'] = $tahunlp;

        $nolp = $data['no_lp'] ?? '-';
        $tahunlp = $data['tahun_lp'];

        $data['formatlp'] = "LPHP-{$nolp}/KPU.206/{$tahunlp}";

        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }

        $data['penindakans'] = $formattedPenindakans;

        $tglsbp = $data['tgl_sbp'] ?? null;
        $tahunsbp = !empty($tglsbp) ? date('Y', strtotime($tglsbp)) : '-';
        $data['tahun_sbp'] = $tahunsbp;


        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/pasca-penindakan/surat-np.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tgllp = $pascapenindakan->tgl_lp;
        $tahunlp = !empty($tgllp) ? date('Y', strtotime($tgllp)) : '-';
        $data['tahun_np'] = $tahunlp;

        $templateProcessor->setValue('tahun_np', $tahunlp);

        // dd($data);

        $fileName = "Dokumen_Pasca_Penindakan_Nota_Pendapat_Nomor_{$pascapenindakan->no_lp}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_bast_pemilik($id)
    {
        $pascapenindakan = TblPascaPenindakan::with('penindakans')->findOrFail($id);

        Carbon::setLocale('id');

        $tglBastPemilikOriginal = $pascapenindakan->tgl_bast_pemilik ?? null;

        $data = $this->formatDates(array_diff_key($pascapenindakan->toArray(), ['tgl_bast_pemilik' => '']));

        $data['tgl_bast_pemilik'] = $tglBastPemilikOriginal;

        $penindakans = $pascapenindakan->penindakans;
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            $tglsbp = $penindakanArray['tgl_sbp'] ?? null;
            $formattedPenindakan['tgl_sbp'] = $tglsbp;

            $pejabatKeys = [
                'id_pejabat_1_bast_pemilik',
                'id_pejabat_2_bast_pemilik',
                'id_pejabat_3_bast_pemilik',
            ];

            foreach ($pejabatKeys as $key) {
                if ($pascapenindakan->$key) {
                    $pejabat = $pascapenindakan->pejabat($key)->first();
                    $formattedPenindakan[$key . '_nama'] = $pejabat->nama_admin ?? '';
                    $formattedPenindakan[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                    $formattedPenindakan[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                    $formattedPenindakan[$key . '_nip'] = $pejabat->nip ?? '';
                } else {
                    $formattedPenindakan[$key . '_nama'] = '';
                    $formattedPenindakan[$key . '_pangkat'] = '';
                    $formattedPenindakan[$key . '_jabatan'] = '';
                    $formattedPenindakan[$key . '_nip'] = '';
                }
            }

            $formattedPenindakans[] = $formattedPenindakan;
        }

        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }

        if (!empty($data['tgl_bast_pemilik']) && $this->isValidDate($data['tgl_bast_pemilik'])) {
            $tglBastPemilik = Carbon::parse($data['tgl_bast_pemilik']);
            $namaHari = $tglBastPemilik->translatedFormat('l');


            $formatter = new \NumberFormatter('id', \NumberFormatter::SPELLOUT);

            $tanggal = $formatter->format($tglBastPemilik->day);
            $bulan = $tglBastPemilik->translatedFormat('F');
            $tahun = $formatter->format($tglBastPemilik->year);


            $data['formatBastPemilik'] = ucwords("$namaHari tanggal $tanggal bulan $bulan tahun $tahun");
        } else {
            $data['formatBastPemilik'] = '';
        }



        $data['penindakans'] = $formattedPenindakans;

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/pasca-penindakan/surat-bast-pemilik.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglsbp = $data['tgl_sbp'] ?? null;
        if ($tglsbp) {
            $formattedTglSbp = $this->formatDates(['tgl_sbp' => $tglsbp])['tgl_sbp'] ?? '-';
            $data['tg_sbp'] = $formattedTglSbp;
        } else {
            $data['tg_sbp'] = '-';
        }

        $templateProcessor->setValue('tg_sbp', $data['tg_sbp']);

        // dd($data);

        $fileName = "Dokumen_Pasca_Penindakan_Berita_Acara_Serah_Terima_Pemilik_Nomor_{$pascapenindakan->no_bast_pemilik}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_bast_instansi($id)
    {
        $pascapenindakan = TblPascaPenindakan::with('penindakans')->findOrFail($id);

        Carbon::setLocale('id');

        $tglBastinstansiOriginal = $pascapenindakan->tgl_bast_instansi ?? null;

        $data = $this->formatDates(array_diff_key($pascapenindakan->toArray(), ['tgl_bast_instansi' => '']));

        $data['tgl_bast_instansi'] = $tglBastinstansiOriginal;

        $penindakans = $pascapenindakan->penindakans;
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            $tglsbp = $penindakanArray['tgl_sbp'] ?? null;
            $formattedPenindakan['tgl_sbp'] = $tglsbp;

            $pejabatKeys = [
                'id_pejabat_1_bast_instansi',
                'id_pejabat_2_bast_instansi',
                'id_pejabat_3_bast_instansi',
            ];

            foreach ($pejabatKeys as $key) {
                if ($pascapenindakan->$key) {
                    $pejabat = $pascapenindakan->pejabat($key)->first();
                    $formattedPenindakan[$key . '_nama'] = $pejabat->nama_admin ?? '';
                    $formattedPenindakan[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                    $formattedPenindakan[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                    $formattedPenindakan[$key . '_nip'] = $pejabat->nip ?? '';
                } else {
                    $formattedPenindakan[$key . '_nama'] = '';
                    $formattedPenindakan[$key . '_pangkat'] = '';
                    $formattedPenindakan[$key . '_jabatan'] = '';
                    $formattedPenindakan[$key . '_nip'] = '';
                }
            }

            $formattedPenindakans[] = $formattedPenindakan;
        }

        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }

        if (!empty($data['tgl_bast_instansi']) && $this->isValidDate($data['tgl_bast_instansi'])) {
            $tglBastInstansi = Carbon::parse($data['tgl_bast_instansi']);
            $namaHari = $tglBastInstansi->translatedFormat('l');
            $tanggal = $tglBastInstansi->translatedFormat('d');
            $bulan = $tglBastInstansi->translatedFormat('F');
            $tahun = $tglBastInstansi->translatedFormat('Y');

            $data['formatBastInstansi'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBastInstansi'] = '';
        }

        $tglinstansi = $pascapenindakan->tgl_bast_instansi;
        $tahuninstansi = !empty($tglinstansi) ? date('Y', strtotime($tglinstansi)) : '-';
        $data['tahun_instansi'] = $tahuninstansi;

        $data['penindakans'] = $formattedPenindakans;

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/pasca-penindakan/surat-bast-instansi-lain.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        // dd($data);

        $fileName = "Dokumen_Pasca_Penindakan_Berita_Acara_Serah_Terima_Instansi_Lain_Nomor_{$pascapenindakan->no_bast_instansi}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_bast_penyidik($id)
    {
        $pascapenindakan = TblPascaPenindakan::with('penindakans')->findOrFail($id);

        Carbon::setLocale('id');

        $tglBastpenyidikOriginal = $pascapenindakan->tgl_bast_penyidik ?? null;

        $data = $this->formatDates(array_diff_key($pascapenindakan->toArray(), ['tgl_bast_penyidik' => '']));

        $data['tgl_bast_penyidik'] = $tglBastpenyidikOriginal;

        $penindakans = $pascapenindakan->penindakans;
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            $tglsbp = $penindakanArray['tgl_sbp'] ?? null;
            $formattedPenindakan['tgl_sbp'] = $tglsbp;

            $pejabatKeys = [
                'id_pejabat_1_bast_penyidik',
                'id_pejabat_2_bast_penyidik',
                'id_kepala_seksi_penindakan',
            ];

            foreach ($pejabatKeys as $key) {
                if ($pascapenindakan->$key) {
                    $pejabat = $pascapenindakan->pejabat($key)->first();
                    $formattedPenindakan[$key . '_nama'] = $pejabat->nama_admin ?? '';
                    $formattedPenindakan[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                    $formattedPenindakan[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                    $formattedPenindakan[$key . '_nip'] = $pejabat->nip ?? '';
                } else {
                    $formattedPenindakan[$key . '_nama'] = '';
                    $formattedPenindakan[$key . '_pangkat'] = '';
                    $formattedPenindakan[$key . '_jabatan'] = '';
                    $formattedPenindakan[$key . '_nip'] = '';
                }
            }

            $formattedPenindakans[] = $formattedPenindakan;
        }

        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }

        if (!empty($data['tgl_bast_penyidik']) && $this->isValidDate($data['tgl_bast_penyidik'])) {
            $tglBastPenyidik = Carbon::parse($data['tgl_bast_penyidik']);
            $namaHari = $tglBastPenyidik->translatedFormat('l');
            $tanggal = $tglBastPenyidik->translatedFormat('d');
            $bulan = $tglBastPenyidik->translatedFormat('F');
            $tahun = $tglBastPenyidik->translatedFormat('Y');

            $data['formatBastPenyidik'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBastPenyidik'] = '';
        }

        $tglpenyidik = $pascapenindakan->tgl_bast_penyidik;
        $tahunpenyidik = !empty($tglpenyidik) ? date('Y', strtotime($tglpenyidik)) : '-';
        $data['tahun_penyidik'] = $tahunpenyidik;

        $data['penindakans'] = $formattedPenindakans;

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/pasca-penindakan/surat-bast-penyidik.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglsidik = $pascapenindakan->tgl_bast_penyidik;
        if ($tglsidik) {
            $formattedTglSidik = $this->formatDates(['tgl_bast_penyidik' => $tglsidik])['tgl_bast_penyidik'] ?? '-';
            $data['tg_sidik'] = $formattedTglSidik;
        } else {
            $data['tg_sidik'] = '-';
        }

        $templateProcessor->setValue('tg_sidik', $data['tg_sidik']);

        // dd($data);

        $fileName = "Dokumen_Pasca_Penindakan_Berita_Acara_Serah_Terima_Ke_Penyidik_Nomor_{$pascapenindakan->no_bast_penyidik}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_lpt($id)
    {
        $pascapenindakan = TblPascaPenindakan::with('penindakans')->findOrFail($id);
        Carbon::setLocale('id');


        $data = $this->formatDates($pascapenindakan->toArray());

        $penindakans = $pascapenindakan->penindakans;
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            $tglsbp = $penindakanArray['tgl_sbp'] ?? null;
            $formattedPenindakan['tgl_sbp'] = $tglsbp;

            $pejabatKeys = [
                'kepala_bidang_penindakan',
                'id_kepala_seksi_penindakan',
            ];

            foreach ($pejabatKeys as $key) {
                if ($pascapenindakan->$key) {
                    $pejabat = $pascapenindakan->pejabat($key)->first();
                    $formattedPenindakan[$key . '_nama'] = $pejabat->nama_admin ?? '';
                    $formattedPenindakan[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                    $formattedPenindakan[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                    $formattedPenindakan[$key . '_nip'] = $pejabat->nip ?? '';
                } else {
                    $formattedPenindakan[$key . '_nama'] = '';
                    $formattedPenindakan[$key . '_pangkat'] = '';
                    $formattedPenindakan[$key . '_jabatan'] = '';
                    $formattedPenindakan[$key . '_nip'] = '';
                }
            }

            $formattedPenindakans[] = $formattedPenindakan;
        }

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            $tglsbp = $penindakanArray['tgl_sbp'] ?? null;
            $formattedPenindakan['tgl_sbp'] = $tglsbp;

            $pejabatKeys = [
                'id_petugas_1_sbp',
                'id_petugas_2_sbp',
            ];

            foreach ($pejabatKeys as $key) {
                if ($penindakan->$key) {
                    $pejabat = $penindakan->pejabat($key)->first();
                    $formattedPenindakan[$key . '_nama'] = $pejabat->nama_admin ?? '';
                    $formattedPenindakan[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                    $formattedPenindakan[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                    $formattedPenindakan[$key . '_nip'] = $pejabat->nip ?? '';
                } else {
                    $formattedPenindakan[$key . '_nama'] = '';
                    $formattedPenindakan[$key . '_pangkat'] = '';
                    $formattedPenindakan[$key . '_jabatan'] = '';
                    $formattedPenindakan[$key . '_nip'] = '';
                }
            }

            $formattedPenindakans[] = $formattedPenindakan;
        }

        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '';
            }
        }

        $data['penindakans'] = $formattedPenindakans;

        $tglsbp = $data['tgl_sbp'] ?? null;
        $tahunsbp = !empty($tglsbp) ? date('Y', strtotime($tglsbp)) : '-';
        $data['tahun_sbp'] = $tahunsbp;

        $laporan = $pascapenindakan->penindakans->first()->laporanInformasi ?? null;

        $penindakan = $pascapenindakan->penindakans->first();
        $opsiPenindakan = $penindakan->opsi_penindakan ?? null;

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $nosbp = $data['no_sbp'];
            $tahunsbp = $data['tahun_sbp'];

            if ($opsiPenindakan === 'SBP') {
                switch ($tipePenindakan) {
                    case 'MANDIRI':
                        $data['formatDasar'] = "Nomor SBP-{$nosbp}/MANDIRI/KPU.206/{$tahunsbp}";
                        break;
                    case 'PERBANTUAN':
                        $data['formatDasar'] = "Nomor SBP-{$nosbp}/PERBANTUAN/KPU.206/{$tahunsbp}";
                        break;
                    case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                        $data['formatDasar'] = "Nomor SBP-{$nosbp}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunsbp}";
                        break;
                    default:
                        $data['formatDasar'] = "Nomor SBP-{$nosbp}/UNKNOWN/KPU.206/{$tahunsbp}";
                        break;
                }
            } else {
                $formatDasar = '';

                if ($penindakan->ba_riksa === 'YA') {
                    $tahunRiksa = !empty($penindakan->tgl_ba_riksa) ? date('Y', strtotime($penindakan->tgl_ba_riksa)) : '-';
                    $formatDasar = "Nomor : BA-{$penindakan->no_ba_riksa}/Riksa/KPU.206/{$tahunRiksa}";
                } else {
                    if ($penindakan->ba_segel === 'YA') {
                        $tahunSegel = !empty($penindakan->tgl_ba_segel) ? date('Y', strtotime($penindakan->tgl_ba_segel)) : '-';
                        $formatDasar = "Nomor : BA–{$penindakan->no_ba_segel}/Segel/KPU.206/{$tahunSegel}";
                    } elseif (!empty($penindakan->format_free_entry)) {
                        $tahunFreeEntry = !empty($penindakan->tgl_free_entry) ? date('Y', strtotime($penindakan->tgl_free_entry)) : '-';
                        $formatDasar = "{$penindakan->format_free_entry}/{$tahunFreeEntry}";
                    } else {
                        $formatDasar = "UNKNOWN";
                    }
                }

                $data['formatDasar'] = $formatDasar;
            }
        } else {
            $data['formatDasar'] = "Nomor SBP-{$data['no_sbp']}/UNKNOWN/KPU.206/{$data['tahun_sbp']}";
        }




        $data = array_map(fn($value) => $value ?? '', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/pasca-penindakan/surat-lpt.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tgllpt = $pascapenindakan->tgl_lpt;
        $tahunlpt = !empty($tgllpt) ? date('Y', strtotime($tgllpt)) : '-';
        $data['tahun_lpt'] = $tahunlpt;
        $templateProcessor->setValue('tahun_lpt', $tahunlpt);

        // dd($data);

        $fileName = "Dokumen_Pasca_Penindakan_Laporan_Pelaksanaan_Tugas_Nomor_{$pascapenindakan->no_lpt_penindakan}.docx";
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
            'waktu_pelaksanaan_tugas_lpt',
            'waktu_selesai_tugas_lpt'
        ];

        foreach ($dateFields as $field) {
            if (!empty($data[$field])) {
                $dateValue = $data[$field];
                if ($dateValue) {
                    $date = Carbon::parse($dateValue);
                    $formattedDate = 'Tanggal ' . $date->isoFormat('D MMMM YYYY') . ' Pukul ' . $date->format('H.i');
                    $data[$field] = $formattedDate;
                } else {
                    $data[$field] = '';
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