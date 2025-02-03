<?php

namespace App\Http\Controllers\Dokpenyidikan;

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
use App\Models\TblPenyidikan;
use App\Models\TblAturanLartas;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DaftarDokLppController extends Controller
{
    public function index()
    {
        $penyidikan = TblPenyidikan::select('id', 'tgl_lpp', 'no_lpp')->get();

        $penyidikan = $penyidikan->map(function ($item) {
            $item->tgl_lpp = $this->formatDates(['tgl_lpp' => $item->tgl_lpp])['tgl_lpp'];
            return $item;
        });

        $pascapenindakan = TblPascaPenindakan::select('no_lp', 'tgl_lp', 'id_pasca_penindakan', 'id_penindakan_ref')
            ->get()
            ->map(function ($item) {
                $item->tgl_lp = $this->formatDates(['tgl_lp' => $item->tgl_lp])['tgl_lp'];
                return $item;
            });

        $sbpData = TblSbp::with('laporanInformasi')
            ->select('no_sbp', 'tgl_sbp', 'id_pra_penindakan_ref')
            ->get()
            ->map(function ($item) {
                $item->tgl_sbp = $this->formatDates(['tgl_sbp' => $item->tgl_sbp])['tgl_sbp'];
                $item->skema_penindakan_perintah = optional($item->laporanInformasi)->skema_penindakan_perintah ?? '-';
                return $item;
            });

        // dd($sbpData);

        return view('Dokpenyidikan.daftar-dok-lpp.index', compact('penyidikan', 'pascapenindakan', 'sbpData'));
    }


    public function create(Request $request)
    {
        $id_pasca_penindakan = $request->query('id_pasca_penindakan');
        $tipe_penyidikan = $request->query('penyidikan');

        // dd($tipe_penyidikan);

        $penyidikan = TblPenyidikan::where('id_pasca_penindakan_ref', $id_pasca_penindakan)->first();

        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $id_pasca_penindakan)->first();

        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', $pascapenindakan->id_penindakan_ref)
            ->first();

        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))
            ->get();

        // dd([
        //     'pascapenindakan' => $pascapenindakan,
        //     'sbpData' => $sbpData,
        //     'laporanInformasi' => $laporanInformasi
        // ]);

        // dd($sbpData);

        $users = User::all();
        $segels = TblSegel::all();
        $locus = TblLocus::all();
        $kemasans = TblKemasan::all();
        $no_ref = TblNoRef::first();
        $lartas = TblAturanLartas::all();
        $lartasedit = TblAturanLartas::all();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $jenisPelanggaran = TblJenisPelanggaran::all();

        return view('Dokpenyidikan.daftar-dok-lpp.create', compact(
            'users',
            'segels',
            'kemasans',
            'jenisPelanggaran',
            'no_ref',
            'id_pasca_penindakan',
            'nama_negara',
            'pascapenindakan',
            'locus',
            'penyidikan', // Menambahkan data TblPenyidikan
            'sbpData', // Menambahkan data TblSbp
            'laporanInformasi', // Menambahkan data TblLaporanInformasi
            'tipe_penyidikan',
            'lartas',
            'lartasedit'
        ));
    }


    public function store(Request $request)
    {
        TblPenyidikan::create($request->all());
        $no_ref = TblNoRef::first();
        $no_ref->no_lpp += 1;
        $no_ref->no_lpf += 1;
        $no_ref->no_split += 1;
        $no_ref->no_print_cacah += 1;
        $no_ref->no_ba_cacah += 1;
        $no_ref->no_lhp_penyidikan += 1;
        $no_ref->save();

        return redirect()->route('daftar-dok-lpp.index')->with('success', 'Data Penyidikan berhasil disimpan dan nomor referensi telah diperbarui.');
    }



    public function edit(Request $request, $id)
    {
        // Ambil data berdasarkan ID yang diberikan
        $penyidikan = TblPenyidikan::findOrFail($id);  // Mengambil data TblPenyidikan berdasarkan ID
        $id_pasca_penindakan = $penyidikan->id_pasca_penindakan_ref;  // Mengambil id_pasca_penindakan dari data Penyidikan
        $tipe_penyidikan = $penyidikan->tipe_penyidikan;  // Ambil tipe penyidikan

        // Ambil data pasca penindakan berdasarkan ID
        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $id_pasca_penindakan)->first();


        // Ambil data SBP
        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', $pascapenindakan->id_penindakan_ref)
            ->first();

        // Ambil data laporan informasi
        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))
            ->get();

        // Ambil data terkait lainnya
        $users = User::all();
        $segels = TblSegel::all();
        $locus = TblLocus::all();
        $kemasans = TblKemasan::all();
        $no_ref = TblNoRef::first();
        $lartas = TblAturanLartas::all();
        $lartasedit = TblAturanLartas::all();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $jenisPelanggaran = TblJenisPelanggaran::all();

        // Kembalikan tampilan edit dengan membawa data yang dibutuhkan
        return view('Dokpenyidikan.daftar-dok-lpp.edit', compact(
            'users',
            'segels',
            'kemasans',
            'jenisPelanggaran',
            'no_ref',
            'id_pasca_penindakan',
            'nama_negara',
            'pascapenindakan',
            'locus',
            'penyidikan', // Menambahkan data TblPenyidikan
            'sbpData', // Menambahkan data TblSbp
            'laporanInformasi', // Menambahkan data TblLaporanInformasi
            'tipe_penyidikan',
            'lartas',
            'lartasedit'
        ));
    }


    public function update($id)
    {
        $data = request()->all();

        $item = TblPenyidikan::find($id);
        if ($item) {
            $item->update($data);
            return redirect()->route('daftar-dok-lpp.index')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->route('daftar-dok-lpp.index')->with('error', 'Data tidak ditemukan.');
    }

    public function destroy($id)
    {
        $penyidikan = TblPenyidikan::find($id);
        if ($penyidikan) {
            $penyidikan->delete();
            return redirect()->route('daftar-dok-lpp.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('daftar-dok-lpp.index')->with('error', 'Data tidak ditemukan.');
    }


    public function print_surat_lpp($id)
    {
        $penyidikan = TblPenyidikan::with([
            'pascapenindakan',
            'penindakan',
            'laporanInformasi'
        ])->findOrFail($id);

        $tglLpp = $penyidikan->tgl_lpp;

        // Format tanggal untuk `tgl_lpp`
        $penyidikan->tgl_lpp = $this->formatDates(['tgl_lpp' => $penyidikan->tgl_lpp])['tgl_lpp'];

        $pascapenindakan = $penyidikan->pascapenindakan;
        $penindakans = $pascapenindakan ? $pascapenindakan->penindakans : collect();
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            // Menjaga format tgl_sbp tetap seperti di data asli
            $formattedPenindakan['tgl_sbp'] = $penindakanArray['tgl_sbp'] ?? null;

            // Data pejabat yang diambil dari model Penyidikan
            $pejabatKeys = [
                'kepala_bidang_penindakan_lpp',
                'id_1_pejabat_penyidik',
                'id_2_pejabat_penyidik',
            ];

            foreach ($pejabatKeys as $key) {
                if ($penyidikan && $penyidikan->$key) {  // Ambil dari Penyidikan, bukan Pascapenindakan
                    $pejabat = $penyidikan->pejabat($key)->first();
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

        $data = $this->formatDates($penyidikan->toArray());
        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }
        $data['penindakans'] = $formattedPenindakans;

        $tglsbp = $data['tgl_sbp'] ?? null;
        $data['tahun_sbp'] = !empty($tglsbp) ? date('Y', strtotime($tglsbp)) : '-';

        $laporan = $penindakans->first()->laporanInformasi ?? null;
        // dd($laporan);
        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $nosbp = $data['no_sbp'] ?? '-';
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

        $data['locus_lp'] = $pascapenindakan->locus_lp ?? '-';
        $data['tempus_lp'] = $pascapenindakan->tempus_lp ? $this->formatDates(['tempus_lp' => $pascapenindakan->tempus_lp])['tempus_lp'] : '-';

        $tglLp = $pascapenindakan->tgl_lp;
        $no_lp = $pascapenindakan->no_lp;
        $data['tgllp'] = !empty($tglLp) ? $this->formatDates(['tgl_lp' => $tglLp])['tgl_lp'] : '-';

        // Format LP
        $tahunLp = !empty($tglLp) ? date('Y', strtotime($tglLp)) : '-';
        $data['tahun_lp'] = $tahunLp;

        $nolp = $no_lp ?? '-';
        $tahunlp = $data['tahun_lp'];

        $data['formatLp'] = "LP-{$nolp}/KPU.206/{$tahunlp}";

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenyidikan/surat-lpp.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }
        // Set value untuk tgllp
        $templateProcessor->setValue('tgllp', $data['tgllp']);

        // Mengatur nilai lainnya dalam template
        $templateProcessor->setValue('formatLp', $data['formatLp']);


        // Menggunakan formatDates untuk tgl_lpp
        $data['tahun_lpp'] = $tglLpp ? date('Y', strtotime($tglLpp)) : '-';

        // Set value untuk tahun_lpp
        $templateProcessor->setValue('tahun_lpp', $data['tahun_lpp']);

        $templateProcessor->setValue('locus_lp', $data['locus_lp']);
        $templateProcessor->setValue('tempus_lp', $data['tempus_lp']);


        $tglsbp = $data['tgl_sbp'] ?? null;
        $data['tg_sbp'] = $tglsbp ? $this->formatDates(['tgl_sbp' => $tglsbp])['tgl_sbp'] ?? '-' : '-';
        $templateProcessor->setValue('tg_sbp', $data['tg_sbp']);

        // dd($data);

        $fileName = "Dokumen_Penyidikan_Lembar_Penerimaan_Perkara_Nomor_{$penyidikan->no_lpp}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_lpf($id)
    {
        $penyidikan = TblPenyidikan::with([
            'pascapenindakan',
            'penindakan',
            'laporanInformasi'
        ])->findOrFail($id);

        $tglLpf = $penyidikan->tgl_lpf;

        // Format tanggal untuk `tgl_lpp`
        $penyidikan->tgl_lpf = $this->formatDates(['tgl_lpf' => $penyidikan->tgl_lpf])['tgl_lpf'];

        $pascapenindakan = $penyidikan->pascapenindakan;
        $penindakans = $pascapenindakan ? $pascapenindakan->penindakans : collect();
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            // Menjaga format tgl_sbp tetap seperti di data asli
            $formattedPenindakan['tgl_sbp'] = $penindakanArray['tgl_sbp'] ?? null;

            // Data pejabat yang diambil dari model Penyidikan
            $pejabatKeys = [
                'kepala_bidang_penindakan_lpp',
                'id_1_pejabat_penyidik',
                'id_2_pejabat_penyidik',
            ];

            foreach ($pejabatKeys as $key) {
                if ($penyidikan && $penyidikan->$key) {  // Ambil dari Penyidikan, bukan Pascapenindakan
                    $pejabat = $penyidikan->pejabat($key)->first();
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

        $data = $this->formatDates($penyidikan->toArray());
        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }
        $data['penindakans'] = $formattedPenindakans;

        $tglsbp = $data['tgl_sbp'] ?? null;
        $data['tahun_sbp'] = !empty($tglsbp) ? date('Y', strtotime($tglsbp)) : '-';

        $laporan = $penindakans->first()->laporanInformasi ?? null;
        // dd($laporan);
        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $nosbp = $data['no_sbp'] ?? '-';
            $tahunsbp = $data['tahun_sbp'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatSbp'] = "SBP-{$nosbp}/MANDIRI/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN':
                    $data['formatSbp'] = "SBP-{$nosbp}/PERBANTUAN/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatSbp'] = "SBP-{$nosbp}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunsbp}";
                    break;
                default:
                    $data['formatSbp'] = "SBP-{$nosbp}/UNKNOWN/KPU.206/{$tahunsbp}";
                    break;
            }
        } else {
            $data['formatSbp'] = "SBP-{$data['no_sbp']}/UNKNOWN/KPU.206/{$data['tahun_sbp']}";
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

        $data['locus_lp'] = $pascapenindakan->locus_lp ?? '-';
        $data['tempus_lp'] = $pascapenindakan->tempus_lp ? $this->formatDates(['tempus_lp' => $pascapenindakan->tempus_lp])['tempus_lp'] : '-';

        $tglLp = $pascapenindakan->tgl_lp;
        $no_lp = $pascapenindakan->no_lp;
        $data['tgllp'] = !empty($tglLp) ? $this->formatDates(['tgl_lp' => $tglLp])['tgl_lp'] : '-';

        $data['bap_nama'] = $penyidikan->bap_nama ? 'BAP SAKSI-' . $penyidikan->bap_nama . '' : '-';
        $data['bap_tersangka'] = $penyidikan->bap_tersangka ? 'BAP TERSANGKA-' . $penyidikan->bap_tersangka . '' : '-';


        // Format LP
        $tahunLp = !empty($tglLp) ? date('Y', strtotime($tglLp)) : '-';
        $data['tahun_lp'] = $tahunLp;

        $nolp = $no_lp ?? '-';
        $tahunlp = $data['tahun_lp'];

        $data['formatLp'] = "LP-{$nolp}/KPU.206/{$tahunlp}";

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenyidikan/surat-lpf.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }
        // Set value untuk tgllp
        $templateProcessor->setValue('tgllp', $data['tgllp']);

        // Mengatur nilai lainnya dalam template
        $templateProcessor->setValue('formatLp', $data['formatLp']);


        // Menggunakan formatDates untuk tgl_lpp
        $data['tahun_lpf'] = $tglLpf ? date('Y', strtotime($tglLpf)) : '-';

        // Set value untuk tahun_lpp
        $templateProcessor->setValue('tahun_lpf', $data['tahun_lpf']);

        $templateProcessor->setValue('locus_lp', $data['locus_lp']);
        $templateProcessor->setValue('tempus_lp', $data['tempus_lp']);


        $tglsbp = $data['tgl_sbp'] ?? null;
        $data['tg_sbp'] = $tglsbp ? $this->formatDates(['tgl_sbp' => $tglsbp])['tgl_sbp'] ?? '-' : '-';
        $templateProcessor->setValue('tg_sbp', $data['tg_sbp']);

        $tglprint = $data['tgl_print'] ?? null;
        $data['tg_print'] = $tglprint ? $this->formatDates(['tgl_print' => $tglprint])['tgl_print'] ?? '-' : '-';
        $templateProcessor->setValue('tg_print', $data['tg_print']);

        // dd($data);

        $fileName = "Dokumen_Penyidikan_Lembar_Penelitian_Formal_Nomor_{$penyidikan->no_lpf}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_split($id)
    {
        $penyidikan = TblPenyidikan::with([
            'pascapenindakan',
            'penindakan',
            'laporanInformasi'
        ])->findOrFail($id);


        $tglsplit = $penyidikan->tgl_split;

        // Format tanggal untuk `tgl_lpp`
        $penyidikan->tgl_split = $this->formatDates(['tgl_split' => $penyidikan->tgl_split])['tgl_split'];

        $pascapenindakan = $penyidikan->pascapenindakan;
        $penindakans = $pascapenindakan ? $pascapenindakan->penindakans : collect();
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            // Menjaga format tgl_sbp tetap seperti di data asli
            $formattedPenindakan['tgl_sbp'] = $penindakanArray['tgl_sbp'] ?? null;

            // Data pejabat yang diambil dari model Penyidikan
            $pejabatKeys = [
                'kepala_bidang_penindakan_lpp',
                'pejabat_penelitian',
            ];

            foreach ($pejabatKeys as $key) {
                if ($penyidikan && $penyidikan->$key) {  // Ambil dari Penyidikan, bukan Pascapenindakan
                    $pejabat = $penyidikan->pejabat($key)->first();
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

        $data['pejabat_penelitian'] = [];
        if (!empty($penyidikan->pejabat_penelitian)) {
            try {
                $timPeneliti = json_decode($penyidikan->pejabat_penelitian, true);
                if (is_array($timPeneliti)) {
                    foreach ($timPeneliti as $index => $id) {
                        $user = User::where('id_admin', $id)->first();
                        if ($user) {
                            $data['pejabat_penelitian'][] = [
                                'no' => $index + 1,
                                'nama' => $user->nama_admin ?? '-',
                                'nip' => $user->nip ?? '-',
                                'pangkat' => $user->pangkat ?? '-',
                                'jabatan' => $user->jabatan ?? '-',
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                // Handle error jika json_decode gagal
                $data['pejabat_penelitian'] = [];
            }
        }

        $data = $this->formatDates($penyidikan->toArray());
        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }
        $data['penindakans'] = $formattedPenindakans;


        $laporan = $penindakans->first()->laporanInformasi ?? null;
        // dd($laporan);


        $tglLp = $pascapenindakan->tgl_lp;
        $no_lp = $pascapenindakan->no_lp;
        $data['tgllp'] = !empty($tglLp) ? $this->formatDates(['tgl_lp' => $tglLp])['tgl_lp'] : '-';

        // Format LP
        $tahunLp = !empty($tglLp) ? date('Y', strtotime($tglLp)) : '-';
        $data['tahun_lp'] = $tahunLp;

        $nolp = $no_lp ?? '-';
        $tahunlp = $data['tahun_lp'];

        $data['formatLp'] = "LP-{$nolp}/KPU.206/{$tahunlp}";

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenyidikan/surat-split.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $data['pejabat_penelitian'] = [];

        // Decode string JSON menjadi array
        if (!empty($penyidikan->pejabat_penelitian)) {
            // Decode JSON string
            $timPeneliti = json_decode($penyidikan->pejabat_penelitian, true);

            // Pastikan hasil decode valid dan berbentuk array
            if (json_last_error() === JSON_ERROR_NONE && is_array($timPeneliti)) {
                foreach ($timPeneliti as $index => $id) {
                    // Bersihkan ID dari karakter yang tidak diinginkan
                    $cleanId = trim($id, '"');

                    $user = User::where('id_admin', $cleanId)->first();
                    if ($user) {
                        $data['pejabat_penelitian'][] = [
                            'no' => $index + 1,
                            'nama' => $user->nama_admin ?? '-',
                            'nip' => $user->nip ?? '-',
                            'pangkat' => $user->pangkat ?? '-',
                            'jabatan' => $user->jabatan ?? '-',
                        ];
                    }
                }
            }
        }


        // Bagian template processor
        if (!empty($data['pejabat_penelitian']) && is_array($data['pejabat_penelitian'])) {
            $templateProcessor->cloneBlock('penelitian_section', count($data['pejabat_penelitian']), true, true);

            foreach ($data['pejabat_penelitian'] as $index => $tim) {
                $realIndex = $index + 1;
                $templateProcessor->setValue("i#$realIndex", $realIndex);
                $templateProcessor->setValue("peneliti_nama#$realIndex", $tim['nama']);
                $templateProcessor->setValue("peneliti_nip#$realIndex", $tim['nip']);
                $templateProcessor->setValue("peneliti_pangkat#$realIndex", $tim['pangkat']);
                $templateProcessor->setValue("peneliti_jabatan#$realIndex", $tim['jabatan']);


                if ($index === 0) {
                    $templateProcessor->setValue("kepada#$realIndex", "Kepada");
                } else {
                    $templateProcessor->setValue("kepada#$realIndex", "");
                }

                if ($index === 0) {
                    $templateProcessor->setValue("t#$realIndex", ":");
                } else {
                    $templateProcessor->setValue("t#$realIndex", "");
                }
            }
        } else {
            $templateProcessor->deleteBlock('penelitian_section');
        }


        // Set value untuk tgllp
        $templateProcessor->setValue('tgllp', $data['tgllp']);

        // Mengatur nilai lainnya dalam template
        $templateProcessor->setValue('formatLp', $data['formatLp']);


        $data['tahun_split'] = $tglsplit ? date('Y', strtotime($tglsplit)) : '-';

        $templateProcessor->setValue('tahun_split', $data['tahun_split']);

        $fileName = "Dokumen_Penyidikan_Surat_Perintah_Penelitian_Nomor_{$penyidikan->no_split}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_baw($id)
    {
        $penyidikan = TblPenyidikan::with([
            'pascapenindakan',
            'penindakan',
            'laporanInformasi'
        ])->findOrFail($id);

        $tglLpf = $penyidikan->tgl_lpf;

        // Format tanggal untuk `tgl_lpp`
        $penyidikan->tgl_lpf = $this->formatDates(['tgl_lpf' => $penyidikan->tgl_lpf])['tgl_lpf'];

        $pascapenindakan = $penyidikan->pascapenindakan;
        $penindakans = $pascapenindakan ? $pascapenindakan->penindakans : collect();
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            // Menjaga format tgl_sbp tetap seperti di data asli
            $formattedPenindakan['tgl_sbp'] = $penindakanArray['tgl_sbp'] ?? null;

            // Data pejabat yang diambil dari model Penyidikan
            $pejabatKeys = [
                'kepala_bidang_penindakan_lpp',
                'id_1_pejabat_penyidik',
                'id_2_pejabat_penyidik',
            ];

            foreach ($pejabatKeys as $key) {
                if ($penyidikan && $penyidikan->$key) {  // Ambil dari Penyidikan, bukan Pascapenindakan
                    $pejabat = $penyidikan->pejabat($key)->first();
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

        $data = $this->formatDates($penyidikan->toArray());
        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }
        $data['penindakans'] = $formattedPenindakans;

        $tglsbp = $data['tgl_sbp'] ?? null;
        $data['tahun_sbp'] = !empty($tglsbp) ? date('Y', strtotime($tglsbp)) : '-';

        $laporan = $penindakans->first()->laporanInformasi ?? null;
        // dd($laporan);
        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $nosbp = $data['no_sbp'] ?? '-';
            $tahunsbp = $data['tahun_sbp'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatSbp'] = "SBP-{$nosbp}/MANDIRI/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN':
                    $data['formatSbp'] = "SBP-{$nosbp}/PERBANTUAN/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatSbp'] = "SBP-{$nosbp}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunsbp}";
                    break;
                default:
                    $data['formatSbp'] = "SBP-{$nosbp}/UNKNOWN/KPU.206/{$tahunsbp}";
                    break;
            }
        } else {
            $data['formatSbp'] = "SBP-{$data['no_sbp']}/UNKNOWN/KPU.206/{$data['tahun_sbp']}";
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

        $data['locus_lp'] = $pascapenindakan->locus_lp ?? '-';
        $data['tempus_lp'] = $pascapenindakan->tempus_lp ? $this->formatDates(['tempus_lp' => $pascapenindakan->tempus_lp])['tempus_lp'] : '-';

        $tglLp = $pascapenindakan->tgl_lp;
        $no_lp = $pascapenindakan->no_lp;
        $data['tgllp'] = !empty($tglLp) ? $this->formatDates(['tgl_lp' => $tglLp])['tgl_lp'] : '-';

        $data['bap_nama'] = $penyidikan->bap_nama ? 'BAP SAKSI-' . $penyidikan->bap_nama . '' : '-';
        $data['bap_tersangka'] = $penyidikan->bap_tersangka ? 'BAP TERSANGKA-' . $penyidikan->bap_tersangka . '' : '-';


        // Format LP
        $tahunLp = !empty($tglLp) ? date('Y', strtotime($tglLp)) : '-';
        $data['tahun_lp'] = $tahunLp;

        $nolp = $no_lp ?? '-';
        $tahunlp = $data['tahun_lp'];

        $data['formatLp'] = "LP-{$nolp}/KPU.206/{$tahunlp}";

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenyidikan/surat-lpf.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }
        // Set value untuk tgllp
        $templateProcessor->setValue('tgllp', $data['tgllp']);

        // Mengatur nilai lainnya dalam template
        $templateProcessor->setValue('formatLp', $data['formatLp']);


        // Menggunakan formatDates untuk tgl_lpp
        $data['tahun_lpf'] = $tglLpf ? date('Y', strtotime($tglLpf)) : '-';

        // Set value untuk tahun_lpp
        $templateProcessor->setValue('tahun_lpf', $data['tahun_lpf']);

        $templateProcessor->setValue('locus_lp', $data['locus_lp']);
        $templateProcessor->setValue('tempus_lp', $data['tempus_lp']);


        $tglsbp = $data['tgl_sbp'] ?? null;
        $data['tg_sbp'] = $tglsbp ? $this->formatDates(['tgl_sbp' => $tglsbp])['tgl_sbp'] ?? '-' : '-';
        $templateProcessor->setValue('tg_sbp', $data['tg_sbp']);

        $tglprint = $data['tgl_print'] ?? null;
        $data['tg_print'] = $tglprint ? $this->formatDates(['tgl_print' => $tglprint])['tgl_print'] ?? '-' : '-';
        $templateProcessor->setValue('tg_print', $data['tg_print']);

        // dd($data);

        $fileName = "Dokumen_Penyidikan_Lembar_Penelitian_Formal_Nomor_{$penyidikan->no_lpf}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_surat_print_cacah($id) //print(perintah)
    {
        $penyidikan = TblPenyidikan::with([
            'pascapenindakan',
            'penindakan',
            'laporanInformasi'
        ])->findOrFail($id);


        $tglprintcacah = $penyidikan->tgl_print_cacah;


        $penyidikan->tgl_print_cacah = $this->formatDates(['tgl_print_cacah' => $penyidikan->tgl_print_cacah])['tgl_print_cacah'];

        $pascapenindakan = $penyidikan->pascapenindakan;
        $penindakans = $pascapenindakan ? $pascapenindakan->penindakans : collect();
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            // Menjaga format tgl_sbp tetap seperti di data asli
            $formattedPenindakan['tgl_sbp'] = $penindakanArray['tgl_sbp'] ?? null;

            // Data pejabat yang diambil dari model Penyidikan
            $pejabatKeys = [
                'kepala_bidang_penindakan_lpp',
                'pejabat_penelitian',
                'pejabat_print_cacah',
            ];

            foreach ($pejabatKeys as $key) {
                if ($penyidikan && $penyidikan->$key) {  // Ambil dari Penyidikan, bukan Pascapenindakan
                    $pejabat = $penyidikan->pejabat($key)->first();
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

        $data['pejabat_penelitian'] = [];
        if (!empty($penyidikan->pejabat_penelitian)) {
            try {
                $timPeneliti = json_decode($penyidikan->pejabat_penelitian, true);
                if (is_array($timPeneliti)) {
                    foreach ($timPeneliti as $index => $id) {
                        $user = User::where('id_admin', $id)->first();
                        if ($user) {
                            $data['pejabat_penelitian'][] = [
                                'no' => $index + 1,
                                'nama' => $user->nama_admin ?? '-',
                                'nip' => $user->nip ?? '-',
                                'pangkat' => $user->pangkat ?? '-',
                                'jabatan' => $user->jabatan ?? '-',
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                $data['pejabat_penelitian'] = [];
            }
        }


        $data['pejabat_print_cacah'] = [];
        if (!empty($penyidikan->pejabat_print_cacah)) {
            try {
                $timPencacah = json_decode($penyidikan->pejabat_print_cacah, true);
                if (is_array($timPencacah)) {
                    foreach ($timPencacah as $index => $id) {
                        $user = User::where('id_admin', $id)->first();
                        if ($user) {
                            $data['pejabat_print_cacah'][] = [
                                'no' => $index + 1,
                                'nama' => $user->nama_admin ?? '-',
                                'nip' => $user->nip ?? '-',
                                'pangkat' => $user->pangkat ?? '-',
                                'jabatan' => $user->jabatan ?? '-',
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                $data['pejabat_print_cacah'] = [];
            }
        }

        $data = $this->formatDates($penyidikan->toArray());
        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }
        $data['penindakans'] = $formattedPenindakans;


        $laporan = $penindakans->first()->laporanInformasi ?? null;
        // dd($laporan);


        $tglLp = $pascapenindakan->tgl_lp;
        $no_lp = $pascapenindakan->no_lp;
        $data['tgllp'] = !empty($tglLp) ? $this->formatDates(['tgl_lp' => $tglLp])['tgl_lp'] : '-';

        // Format LP
        $tahunLp = !empty($tglLp) ? date('Y', strtotime($tglLp)) : '-';
        $data['tahun_lp'] = $tahunLp;

        $nolp = $no_lp ?? '-';
        $tahunlp = $data['tahun_lp'];

        $data['formatLp'] = "LP-{$nolp}/KPU.206/{$tahunlp}";

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenyidikan/surat-print-cacah.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $data['pejabat_print_cacah'] = [];
        // Decode string JSON menjadi array
        if (!empty($penyidikan->pejabat_print_cacah)) {
            // Decode JSON string
            $timPencacah = json_decode($penyidikan->pejabat_print_cacah, true);

            // Pastikan hasil decode valid dan berbentuk array
            if (json_last_error() === JSON_ERROR_NONE && is_array($timPencacah)) {
                foreach ($timPencacah as $index => $id) {
                    // Bersihkan ID dari karakter yang tidak diinginkan
                    $cleanId = trim($id, '"');

                    $user = User::where('id_admin', $cleanId)->first();
                    if ($user) {
                        $data['pejabat_print_cacah'][] = [
                            'no' => $index + 1,
                            'nama' => $user->nama_admin ?? '-',
                            'nip' => $user->nip ?? '-',
                            'pangkat' => $user->pangkat ?? '-',
                            'jabatan' => $user->jabatan ?? '-',
                        ];
                    }
                }
            }
        }


        $data['pejabat_penelitian'] = [];
        // Decode string JSON menjadi array
        if (!empty($penyidikan->pejabat_penelitian)) {
            // Decode JSON string
            $timPeneliti = json_decode($penyidikan->pejabat_penelitian, true);

            // Pastikan hasil decode valid dan berbentuk array
            if (json_last_error() === JSON_ERROR_NONE && is_array($timPeneliti)) {
                foreach ($timPeneliti as $index => $id) {
                    // Bersihkan ID dari karakter yang tidak diinginkan
                    $cleanId = trim($id, '"');

                    $user = User::where('id_admin', $cleanId)->first();
                    if ($user) {
                        $data['pejabat_penelitian'][] = [
                            'no' => $index + 1,
                            'nama' => $user->nama_admin ?? '-',
                            'nip' => $user->nip ?? '-',
                            'pangkat' => $user->pangkat ?? '-',
                            'jabatan' => $user->jabatan ?? '-',
                        ];
                    }
                }
            }
        }


        $timGabungan = [];

        // First add pejabat_penelitian
        if (!empty($data['pejabat_penelitian']) && is_array($data['pejabat_penelitian'])) {
            $timGabungan = array_merge($timGabungan, $data['pejabat_penelitian']);
        }

        // Then add pejabat_print_cacah
        if (!empty($data['pejabat_print_cacah']) && is_array($data['pejabat_print_cacah'])) {
            $timGabungan = array_merge($timGabungan, $data['pejabat_print_cacah']);
        }

        // dd($timGabungan);

        // Process template with combined officials
        if (!empty($timGabungan)) {
            $templateProcessor->cloneBlock('perintah_cacah_section', count($timGabungan), true, true);

            foreach ($timGabungan as $index => $tim) {
                $realIndex = $index + 1;
                $templateProcessor->setValue("i#$realIndex", $realIndex);
                $templateProcessor->setValue("tim_cacah_nama#$realIndex", $tim['nama']);
                $templateProcessor->setValue("tim_cacah_nip#$realIndex", $tim['nip']);
                $templateProcessor->setValue("tim_cacah_pangkat#$realIndex", $tim['pangkat']);
                $templateProcessor->setValue("tim_cacah_jabatan#$realIndex", $tim['jabatan']);

                if ($index === 0) {
                    $templateProcessor->setValue("kepada#$realIndex", "Kepada");
                    $templateProcessor->setValue("t#$realIndex", ":");
                } else {
                    $templateProcessor->setValue("kepada#$realIndex", "");
                    $templateProcessor->setValue("t#$realIndex", "");
                }
            }
        } else {
            $templateProcessor->deleteBlock('perintah_cacah_section');
        }



        // Set value untuk tgllp
        $templateProcessor->setValue('tgllp', $data['tgllp']);

        // Mengatur nilai lainnya dalam template
        $templateProcessor->setValue('formatLp', $data['formatLp']);


        $data['tahun_print_cacah'] = $tglprintcacah ? date('Y', strtotime($tglprintcacah)) : '-';

        $templateProcessor->setValue('tahun_print_cacah', $data['tahun_print_cacah']);

        // dd($data);

        $fileName = "Dokumen_Penyidikan_Surat_Perintah_Pencacahan_Barang_Hasil_Penindakan_Nomor_{$penyidikan->no_split}.docx";
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_ba_cacah($id) //print(perintah)
    {
        $penyidikan = TblPenyidikan::with([
            'pascapenindakan',
            'penindakan',
            'laporanInformasi'
        ])->findOrFail($id);


        $tglbacacah = $penyidikan->tgl_ba_cacah;


        $penyidikan->tgl_ba_cacah = $this->formatDates(['tgl_ba_cacah' => $penyidikan->tgl_ba_cacah])['tgl_ba_cacah'];

        $pascapenindakan = $penyidikan->pascapenindakan;
        $penindakans = $pascapenindakan ? $pascapenindakan->penindakans : collect();
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $this->formatDates($penindakanArray);

            // Menjaga format tgl_sbp tetap seperti di data asli
            $formattedPenindakan['tgl_sbp'] = $penindakanArray['tgl_sbp'] ?? null;

            // Data pejabat yang diambil dari model Penyidikan
            $pejabatKeys = [
                'kepala_bidang_penindakan_lpp',
                'pejabat_penelitian',
                'pejabat_print_cacah',
            ];

            foreach ($pejabatKeys as $key) {
                if ($penyidikan && $penyidikan->$key) {  // Ambil dari Penyidikan, bukan Pascapenindakan
                    $pejabat = $penyidikan->pejabat($key)->first();
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

        // Pejabat Penelitian
        $data['pejabat_penelitian'] = [];
        if (!empty($penyidikan->pejabat_penelitian)) {
            try {
                $timPeneliti = json_decode($penyidikan->pejabat_penelitian, true);
                if (is_array($timPeneliti)) {
                    foreach ($timPeneliti as $index => $id) {
                        $user = User::where('id_admin', $id)->first();
                        if ($user) {
                            $data['pejabat_penelitian'][] = [
                                'no' => $index + 1,
                                'nama' => $user->nama_admin ?? '-',
                                'nip' => $user->nip ?? '-',
                                'pangkat' => $user->pangkat ?? '-',
                                'jabatan' => $user->jabatan ?? '-',
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                $data['pejabat_penelitian'] = [];
            }
        }

        // Pejabat Print Cacah
        $data['pejabat_print_cacah'] = [];
        if (!empty($penyidikan->pejabat_print_cacah)) {
            try {
                $timPencacah = json_decode($penyidikan->pejabat_print_cacah, true);
                if (is_array($timPencacah)) {
                    foreach ($timPencacah as $index => $id) {
                        $user = User::where('id_admin', $id)->first();
                        if ($user) {
                            $data['pejabat_print_cacah'][] = [
                                'no' => $index + 1,
                                'nama' => $user->nama_admin ?? '-',
                                'nip' => $user->nip ?? '-',
                                'pangkat' => $user->pangkat ?? '-',
                                'jabatan' => $user->jabatan ?? '-',
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                $data['pejabat_print_cacah'] = [];
            }
        }




        $data = $this->formatDates($penyidikan->toArray());
        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }
        $data['penindakans'] = $formattedPenindakans;
        $tglsbp = $data['tgl_sbp'] ?? null;
        $data['tahun_sbp'] = !empty($tglsbp) ? date('Y', strtotime($tglsbp)) : '-';

        $laporan = $penindakans->first()->laporanInformasi ?? null;
        // dd($laporan);
        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $nosbp = $data['no_sbp'] ?? '-';
            $tahunsbp = $data['tahun_sbp'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatSbp'] = "SBP-{$nosbp}/MANDIRI/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN':
                    $data['formatSbp'] = "SBP-{$nosbp}/PERBANTUAN/KPU.206/{$tahunsbp}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatSbp'] = "SBP-{$nosbp}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunsbp}";
                    break;
                default:
                    $data['formatSbp'] = "SBP-{$nosbp}/UNKNOWN/KPU.206/{$tahunsbp}";
                    break;
            }
        } else {
            $data['formatSbp'] = "SBP-{$data['no_sbp']}/UNKNOWN/KPU.206/{$data['tahun_sbp']}";
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

        $data['locus_lp'] = $pascapenindakan->locus_lp ?? '-';

        // dd($laporan);


        $tglLp = $pascapenindakan->tgl_lp;
        $no_lp = $pascapenindakan->no_lp;
        $data['tgllp'] = !empty($tglLp) ? $this->formatDates(['tgl_lp' => $tglLp])['tgl_lp'] : '-';

        // Format LP
        $tahunLp = !empty($tglLp) ? date('Y', strtotime($tglLp)) : '-';
        $data['tahun_lp'] = $tahunLp;

        $nolp = $no_lp ?? '-';
        $tahunlp = $data['tahun_lp'];

        $data['formatLp'] = "LP-{$nolp}/KPU.206/{$tahunlp}";

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenyidikan/surat-ba-cacah.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $data['pejabat_print_cacah'] = [];

        // Decode string JSON menjadi array
        if (!empty($penyidikan->pejabat_print_cacah)) {
            // Decode JSON string
            $timPencacah = json_decode($penyidikan->pejabat_print_cacah, true);

            // Pastikan hasil decode valid dan berbentuk array
            if (json_last_error() === JSON_ERROR_NONE && is_array($timPencacah)) {
                foreach ($timPencacah as $index => $id) {
                    // Bersihkan ID dari karakter yang tidak diinginkan
                    $cleanId = trim($id, '"');

                    $user = User::where('id_admin', $cleanId)->first();
                    if ($user) {
                        $data['pejabat_print_cacah'][] = [
                            'no' => $index + 1,
                            'nama' => $user->nama_admin ?? '-',
                            'nip' => $user->nip ?? '-',
                            'pangkat' => $user->pangkat ?? '-',
                            'jabatan' => $user->jabatan ?? '-',
                        ];
                    }
                }
            }
        }




        $data['pejabat_penelitian'] = [];
        // Decode string JSON menjadi array
        if (!empty($penyidikan->pejabat_penelitian)) {
            // Decode JSON string
            $timPeneliti = json_decode($penyidikan->pejabat_penelitian, true);

            // Pastikan hasil decode valid dan berbentuk array
            if (json_last_error() === JSON_ERROR_NONE && is_array($timPeneliti)) {
                foreach ($timPeneliti as $index => $id) {
                    // Bersihkan ID dari karakter yang tidak diinginkan
                    $cleanId = trim($id, '"');

                    $user = User::where('id_admin', $cleanId)->first();
                    if ($user) {
                        $data['pejabat_penelitian'][] = [
                            'no' => $index + 1,
                            'nama' => $user->nama_admin ?? '-',
                            'nip' => $user->nip ?? '-',
                            'pangkat' => $user->pangkat ?? '-',
                            'jabatan' => $user->jabatan ?? '-',
                        ];
                    }
                }
            }
        }




        // Bagian template processor
        if (!empty($data['pejabat_penelitian']) && is_array($data['pejabat_penelitian'])) {
            $templateProcessor->cloneBlock('penelitian_section', count($data['pejabat_penelitian']), true, true);

            foreach ($data['pejabat_penelitian'] as $index => $tim) {
                $realIndex = $index + 1;
                $templateProcessor->setValue("t#$realIndex", $realIndex);
                $templateProcessor->setValue("peneliti_nama#$realIndex", $tim['nama']);
                $templateProcessor->setValue("peneliti_nip#$realIndex", $tim['nip']);
                $templateProcessor->setValue("peneliti_pangkat#$realIndex", $tim['pangkat']);
                $templateProcessor->setValue("peneliti_jabatan#$realIndex", $tim['jabatan']);


                if ($index === 0) {
                    $templateProcessor->setValue("kepada#$realIndex", "Kepada");
                } else {
                    $templateProcessor->setValue("kepada#$realIndex", "");
                }

                if ($index === 0) {
                    $templateProcessor->setValue("t#$realIndex", ":");
                } else {
                    $templateProcessor->setValue("t#$realIndex", "");
                }
            }
        } else {
            $templateProcessor->deleteBlock('penelitian_section');
        }


        // Bagian template processor
        if (!empty($data['pejabat_print_cacah']) && is_array($data['pejabat_print_cacah'])) {
            $templateProcessor->cloneBlock('pejabat_print_cacah_section', count($data['pejabat_print_cacah']), true, true);

            foreach ($data['pejabat_print_cacah'] as $index => $tim) {
                $realIndex = $index + 1;
                $templateProcessor->setValue("i#$realIndex", $realIndex);
                $templateProcessor->setValue("pencacahan_nama#$realIndex", $tim['nama']);
                $templateProcessor->setValue("pencacahan_nip#$realIndex", $tim['nip']);
                $templateProcessor->setValue("pencacahan_pangkat#$realIndex", $tim['pangkat']);
                $templateProcessor->setValue("pencacahan_jabatan#$realIndex", $tim['jabatan']);
            }
        } else {
            $templateProcessor->deleteBlock('pejabat_print_cacah_section');
        }


        $templateProcessor->setValue('tgllp', $data['tgllp']);

        $templateProcessor->setValue('formatLp', $data['formatLp']);

        $tglprint = $data['tgl_print'] ?? null;
        $data['tg_print'] = $tglprint ? $this->formatDates(['tgl_print' => $tglprint])['tgl_print'] ?? '-' : '-';
        $templateProcessor->setValue('tg_print', $data['tg_print']);

        Carbon::setLocale('id');

        $tglBaCacahOriginal = $tglbacacah ?? null;


        // Lanjutkan dengan proses format jika diperlukan
        $data['tgl_ba_cacah'] = $tglBaCacahOriginal;

        // Format tanggal dengan Carbon
        $tglBaCacah = Carbon::parse($tglBaCacahOriginal);

        // Mengambil komponen tanggal
        $namaHari = $tglBaCacah->translatedFormat('l');
        $tanggal = $tglBaCacah->translatedFormat('d');
        $bulan = $tglBaCacah->translatedFormat('F');
        $tahun = $tglBaCacah->translatedFormat('Y');

        // Mengonversi angka ke kata (tanggal dan tahun)
        $tanggalKata = $this->angkaKeKata($tanggal);
        $tahunKata = $this->angkaKeKata($tahun);

        // Menyusun format tanggal sesuai yang diinginkan
        $data['formatTglBaCacah'] = "$namaHari tanggal $tanggalKata bulan $bulan tahun $tahunKata";

        // Lakukan yang lainnya seperti menyetting nilai untuk TemplateProcessor
        $templateProcessor->setValue('formatTglBaCacah', $data['formatTglBaCacah']);


        $data['tahun_ba_cacah'] = $tglbacacah ? date('Y', strtotime($tglbacacah)) : '-';

        $templateProcessor->setValue('tahun_ba_cacah', $data['tahun_ba_cacah']);

        // dd($data);

        $fileName = "Dokumen_Penyidikan_Berita_Acara_Pencacahan_Nomor_{$penyidikan->no_ba_cacah}.docx";
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
            'tempus_lp',
            ''
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


    private function angkaKeKata($angka)
    {
        $huruf = [
            0 => 'nol',
            1 => 'satu',
            2 => 'dua',
            3 => 'tiga',
            4 => 'empat',
            5 => 'lima',
            6 => 'enam',
            7 => 'tujuh',
            8 => 'delapan',
            9 => 'sembilan',
            10 => 'sepuluh',
            11 => 'sebelas',
            12 => 'dua belas',
            13 => 'tiga belas',
            14 => 'empat belas',
            15 => 'lima belas',
            16 => 'enam belas',
            17 => 'tujuh belas',
            18 => 'delapan belas',
            19 => 'sembilan belas',
            20 => 'dua puluh',
            30 => 'tiga puluh',
            40 => 'empat puluh',
            50 => 'lima puluh',
            60 => 'enam puluh',
            70 => 'tujuh puluh',
            80 => 'delapan puluh',
            90 => 'sembilan puluh'
        ];

        // Pastikan angka yang diterima berupa integer
        $angka = (int) $angka;

        if ($angka < 20) {
            return $huruf[$angka];
        } elseif ($angka < 100) {
            $puluhan = floor($angka / 10) * 10;
            $satuan = $angka % 10;
            return $huruf[$puluhan] . ($satuan ? ' ' . $huruf[$satuan] : '');
        } elseif ($angka < 1000) {
            $ratusan = floor($angka / 100);
            $sisa = $angka % 100;
            return $huruf[$ratusan] . ' ratus' . ($sisa ? ' ' . $this->angkaKeKata($sisa) : '');
        } else {
            $ribuan = floor($angka / 1000);
            $sisa = $angka % 1000;
            return $huruf[$ribuan] . ' ribu' . ($sisa ? ' ' . $this->angkaKeKata($sisa) : '');
        }
    }




    private function isValidDate($date)
    {
        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}