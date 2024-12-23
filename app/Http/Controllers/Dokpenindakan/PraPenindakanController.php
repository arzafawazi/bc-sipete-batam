<?php

namespace App\Http\Controllers\Dokpenindakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TblNoRef;
use App\Models\TblLaporanInformasi;
use App\Models\TblLaporanPengawasan;
use App\Models\TblKategoriPenindakan;
use App\Models\TblJenisPelanggaran;
use App\Models\TblUraianModus;
use App\Models\TblLocus;
use App\Models\TblSbp;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PraPenindakanController extends Controller
{
    public function index()
    {
        $praPenindakans = TblLaporanInformasi::all();

        $dokumenIntelijen = TblLaporanPengawasan::select('id_pengawasan', 'no_st', 'tgl_st')
            ->whereNotIn('id_pengawasan', function ($query) {
                $query->select('id_pengawasan_ref')->from('tbl_li');
            })
            ->get();

        $dokumenIntelijen = $dokumenIntelijen->map(function ($item) {
            $itemData = $item->toArray();
            $formattedData = $this->formatDates($itemData);
            return (object) $formattedData;
        });

        $laporanData = $praPenindakans->toArray();
        $laporanFormatted = array_map([$this, 'formatDates'], $laporanData);

        $praPenindakans = $praPenindakans->map(function ($item, $index) use ($laporanFormatted) {
            $formatted = $laporanFormatted[$index];
            $item->tgl_li = $formatted['tgl_li'] ?? null;
            return $item;
        });

        $dokumenIntelijen = $dokumenIntelijen->filter(function ($item) {
            return !empty($item->no_st) && !empty($item->tgl_st);
        });

        return view('Dokpenindakan.pra-penindakan.index', compact('praPenindakans', 'dokumenIntelijen'));
    }




    public function create(Request $request)
    {
        $no_laporan = $request->query('id_dokumen_intelijen');

        $laporan = TblLaporanPengawasan::where('id_pengawasan', $no_laporan)->first();

        $users = User::all();
        $no_ref = TblNoRef::first();
        $kapen = TblKategoriPenindakan::all();
        $jenis_pelanggaran = TblJenisPelanggaran::all();
        $uraian_modus = TblUraianModus::all();
        $tempat = TblLocus::all();

        $dokumenIntelijen = TblLaporanPengawasan::whereNotIn('id_pengawasan', function ($query) {
            $query->select('id_pengawasan_ref')->from('tbl_li');
        })->get();

        // dd($dokumenIntelijen);


        return view('Dokpenindakan.pra-penindakan.create', compact('users', 'tempat', 'uraian_modus', 'jenis_pelanggaran', 'kapen', 'no_ref', 'no_laporan', 'laporan', 'dokumenIntelijen'));
    }



    public function store(Request $request)
    {
        TblLaporanInformasi::create($request->all());

        $no_ref = TblNoRef::first();
        $no_ref->no_li += 1;
        $no_ref->no_mpp += 1;
        $no_ref->no_lap += 1;
        $no_ref->no_npi += 1;
        $no_ref->no_print += 1;
        $no_ref->save();

        return redirect()->route('pra-penindakan.index')->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');
    }

    public function edit($id)
    {
        $praPenindakan = TblLaporanInformasi::findOrFail($id);

        $laporanPengawasan = TblLaporanPengawasan::where('id_pengawasan', $praPenindakan->id_pengawasan_ref)->first();

        $praPenindakan->dugaan_pelanggaran_mpp = $praPenindakan->dugaan_pelanggaran_mpp ?? $laporanPengawasan->jenis_pelanggaran_lpt;
        $praPenindakan->modus_pelanggaran_mpp = $praPenindakan->modus_pelanggaran_mpp ?? $laporanPengawasan->modus_pelanggaran_lpt;
        $praPenindakan->locus_pelanggaran_mpp = $praPenindakan->locus_pelanggaran_mpp ?? $laporanPengawasan->perkiraan_tempat_pelanggaran_lpt;
        $praPenindakan->tempus_pelanggaran_mpp = $praPenindakan->tempus_pelanggaran_mpp ?? $laporanPengawasan->perkiraan_waktu_pelanggaran_lpt;



        $praPenindakan->keterangan_dugaan_pelanggaran = $praPenindakan->keterangan_dugaan_pelanggaran ?? $laporanPengawasan->jenis_pelanggaran_lpt;
        $praPenindakan->keterangan_locus = $praPenindakan->keterangan_locus ?? $laporanPengawasan->perkiraan_tempat_pelanggaran_lpt;
        // dd($praPenindakan->dugaan_pelanggaran_mpp);

        $no_ref = TblNoRef::first();
        $users = User::all();
        $kapen = TblKategoriPenindakan::all();
        $jenis_pelanggaran = TblJenisPelanggaran::all();
        $uraian_modus = TblUraianModus::all();
        $tempat = TblLocus::all();

        return view('Dokpenindakan.pra-penindakan.edit', compact(
            'praPenindakan',
            'kapen',
            'no_ref',
            'users',
            'jenis_pelanggaran',
            'uraian_modus',
            'tempat'
        ));
    }

    public function update($id)
    {
        $data = request()->all();

        $item = TblLaporanInformasi::find($id);
        if ($item) {
            $item->update($data);
            return redirect()->route('pra-penindakan.index')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->route('pra-penindakan.index')->with('error', 'Data tidak ditemukan.');
    }

    public function destroy($id)
    {
        $praPenindakan = TblLaporanInformasi::find($id);
        if ($praPenindakan) {
            $praPenindakan->delete();
            return redirect()->route('pra-penindakan.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('pra-penindakan.index')->with('error', 'Data tidak ditemukan.');
    }

    public function print_laporan_informasi($id)
    {

        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        $pejabatKeys = [
            'id_pejabat_li_1',
            'id_pejabat_li_2',
            'id_pejabat_li_3',
        ];


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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

        $data['tahun_sekarang'] = date('Y');


        $data = $this->formatDates($data);


        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-laporan-informasi.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglLi = $praPenindakan->tgl_li;

        if (!empty($tglLi)) {
            $tahunSuratLi = date('Y', strtotime($tglLi));
        } else {
            $tahunSuratLi = '-';
        }

        $templateProcessor->setValue('tahun_li', $tahunSuratLi);



        $fileName = 'Dokumen_Pra_Penindakan_Laporan_Informasi_Nomor_' . $praPenindakan->no_li . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_surat_npi($id)
    {
        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        $laporanPengawasan = $praPenindakan->laporanPengawasan;

        $data['sumber_informasi'] = '';

        if ($laporanPengawasan) {
            if ($laporanPengawasan->nhi === 'YA') {
                $prefix = '';
                $noNhi = '';
                $tglNhi = '';
                $formattedTglNhi = '';
                $tahunNhi = '';

                if ($laporanPengawasan->tipe_nhi === 'NHI') {
                    $prefix = 'NHI-';
                    $noNhi = $laporanPengawasan->no_nhi ?? '';
                    $tglNhi = $laporanPengawasan->tgl_nhi ?? '';
                } elseif ($laporanPengawasan->tipe_nhi === 'NHI-HKI') {
                    $prefix = 'NHI-HKI-';
                    $noNhi = $laporanPengawasan->no_nhi_hki ?? '';
                    $tglNhi = $laporanPengawasan->tgl_nhi_hki ?? '';
                }

                if (!empty($tglNhi)) {
                    $formattedTglNhi = $this->formatDates(['tgl_nhi' => $tglNhi])['tgl_nhi'];
                    $tahunNhi = date('Y', strtotime($tglNhi));
                }

                $data['sumber_informasi'] = "{$prefix}{$noNhi}/KPU.02/{$tahunNhi} tanggal {$formattedTglNhi}";
            } elseif ($laporanPengawasan->ni === 'YA') {
                $noNi = $laporanPengawasan->no_ni ?? '';
                $tglNi = $laporanPengawasan->tgl_ni ?? '';
                $formattedTglNi = '';

                if (!empty($tglNi)) {
                    $formattedTglNi = $this->formatDates(['tgl_ni' => $tglNi])['tgl_ni'];
                    $tahunNi = date('Y', strtotime($tglNi));
                }

                $data['sumber_informasi'] = "NI-{$noNi}/KPU.206/{$tahunNi} Tanggal {$formattedTglNi}";
            } elseif ($laporanPengawasan->rekomendasi_lainnya === 'YA') {
                $noNotdin = $laporanPengawasan->no_notdin ?? '';
                $tglNotdin = $laporanPengawasan->tgl_notdin ?? '';
                $formattedTglNotdin = '';

                if (!empty($tglNotdin)) {
                    $formattedTglNotdin = $this->formatDates(['tgl_notdin' => $tglNotdin])['tgl_notdin'];
                    $tahunNotdin = date('Y', strtotime($tglNotdin));
                }

                $data['sumber_informasi'] = "NOMOR ND-{$noNotdin}/KPU.206/{$tahunNotdin} tanggal {$formattedTglNotdin}";
            } elseif ($laporanPengawasan->informasi_lainnya === 'YA') {
                $data['sumber_informasi'] = $laporanPengawasan->isi_informasi_lainnya ?? '';
            }
        }




        $pejabatKeys = [
            'id_pejabat_npi',
        ];

        // dd($data);


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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

        $data['tahun_sekarang'] = date('Y');


        $data = $this->formatDates($data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-npi.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglNpi = $praPenindakan->tgl_npi;

        if (!empty($tglNpi)) {
            $tahunSuratNpi = date('Y', strtotime($tglNpi));
        } else {
            $tahunSuratNpi = '-';
        }

        $templateProcessor->setValue('tahun_npi', $tahunSuratNpi);

        $fileName = 'Dokumen_Pra_Penindakan_Surat_NPI_Nomor_' . $praPenindakan->no_npi . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_lapp($id)
    {
        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        $laporanPengawasan = $praPenindakan->laporanPengawasan;

        dd($laporanPengawasan);

        // dd($laporanPengawasan);

        if ($laporanPengawasan) {
            if ($laporanPengawasan->nhi === 'YA') {
                $prefix = '';
                $noNhi = '';
                $tglNhi = '';
                $formattedTglNhi = '';
                $tahunNhi = '';

                if ($laporanPengawasan->tipe_nhi === 'NHI') {
                    $prefix = 'NHI-';
                    $si = 'NHI';
                    $noNhi = $laporanPengawasan->no_nhi ?? '';
                    $tglNhi = $laporanPengawasan->tgl_nhi ?? '';
                } elseif ($laporanPengawasan->tipe_nhi === 'NHI-HKI') {
                    $prefix = 'NHI-HKI-';
                    $si = 'NHI-HKI';
                    $noNhi = $laporanPengawasan->no_nhi_hki ?? '';
                    $tglNhi = $laporanPengawasan->tgl_nhi_hki ?? '';
                }

                if (!empty($tglNhi)) {
                    $formattedTglNhi = $this->formatDates(['tgl_nhi' => $tglNhi])['tgl_nhi'];
                    $tahunNhi = date('Y', strtotime($tglNhi));
                }

                $data['no'] = "{$prefix}{$noNhi}/KPU.206/{$tahunNhi}";
                $data['si'] = "{$si}";
                $data['tgl'] = "{$formattedTglNhi}";
            } else {
                $noLi = $praPenindakan->no_li ?? '';
                $tglLi = $praPenindakan->tgl_li ?? '';
                $formattedTglLi = '';

                if (!empty($tglLi)) {
                    $formattedTglLi = $this->formatDates(['tgl_li' => $tglLi])['tgl_li'];
                    $tahunLi = date('Y', strtotime($tglLi));
                }

                $data['no'] = "LI-{$noLi}/KPU.206/{$tahunLi} tanggal {$formattedTglLi}";
                $data['si'] = "LI-1";
                $data['tgl'] = "{$formattedTglLi}";
            }
        }

        // dd($data);


        $pejabatKeys = [
            'id_pejabat_lap_1',
            'id_pejabat_lap_2',
            'id_pejabat_lap_3',
        ];


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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

        if ($praPenindakan->pelaku === 'YA') {
            $data['p_d'] = '✔';
            $data['p_t'] = '✘';
        } else {
            $data['p_d'] = '✘';
            $data['p_t'] = '✔';
        }

        if ($praPenindakan->dugaan_pelanggaran === 'YA') {
            $data['d_p'] = '✔';
            $data['d_t'] = '✘';
        } else {
            $data['d_p'] = '✘';
            $data['d_t'] = '✔';
        }

        if ($praPenindakan->locus === 'YA') {
            $data['l_y'] = '✔';
            $data['l_t'] = '✘';
        } else {
            $data['l_y'] = '✘';
            $data['l_t'] = '✔';
        }

        if ($praPenindakan->tempus === 'YA') {
            $data['t_y'] = '✔';
            $data['t_t'] = '✘';
        } else {
            $data['t_y'] = '✘';
            $data['t_t'] = '✔';
        }

        if ($praPenindakan->layak_penindakan === 'YA') {
            $data['lp'] = '✔';
        } else {
            $data['lp'] = '✘';
        }

        if ($praPenindakan->layak_patroli === 'YA') {
            $data['lpt'] = '✔';
        } else {
            $data['lpt'] = '✘';
        }

        if ($praPenindakan->tidak_layak === 'YA') {
            $data['tl'] = '✔';
        } else {
            $data['tl'] = '✘';
        }

        $data['tahun_sekarang'] = date('Y');


        $data = $this->formatDates($data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-lapp.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglLap = $praPenindakan->tgl_li;

        if (!empty($tglLap)) {
            $tahunSuratLap = date('Y', strtotime($tglLap));
        } else {
            $tahunSuratLap = '-';
        }

        $templateProcessor->setValue('tahun_lap', $tahunSuratLap);

        $fileName = 'Dokumen_Pra_Penindakan_Surat_LAP_Nomor_' . $praPenindakan->no_lap . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_surat_perintah($id)
    {
        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        $pejabatKeys = [
            'id_pejabat_sp_1',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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

        $data['id_pejabat_sp_1'] = [];
        if (!empty($praPenindakan->id_pejabat_sp_1)) {
            $pejabatsp = json_decode($praPenindakan->id_pejabat_sp_1, true) ?? [];
            foreach ($pejabatsp as $index => $id) {
                $user = User::where('id_admin', $id)->first();
                $data['id_pejabat_sp_1'][] = [
                    'no' => $index + 1,
                    'nama' => $user->nama_admin ?? '',
                    'pangkat' => $user->pangkat ?? '',
                    'jabatan' => $user->jabatan ?? '',
                    'nip' => $user->nip ?? '',
                ];
            }
        }



        $data['tahun_sekarang'] = date('Y');


        $data = $this->formatDates($data);

        $data = array_map(fn($value) => is_null($value) ? '' : $value, $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-print.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        if (!empty($data['id_pejabat_sp_1'])) {
            $tempData = $data['id_pejabat_sp_1'];

            $templateProcessor->cloneBlock('memberi_perintah_section', count($tempData), true, true);

            foreach ($tempData as $index => $tim) {
                $realIndex = $index + 1;


                $templateProcessor->setValue("kepada#$realIndex", $index === 0 ? 'Kepada      :' : '');

                $templateProcessor->setValue("i#$realIndex", "$realIndex.");
                $templateProcessor->setValue("memberi_perintah_nama#$realIndex", $tim['nama']);
                $templateProcessor->setValue("memberi_perintah_pangkat#$realIndex", $tim['pangkat']);
                $templateProcessor->setValue("memberi_perintah_nip#$realIndex", $tim['nip']);
                $templateProcessor->setValue("memberi_perintah_jabatan#$realIndex", $tim['jabatan']);
            }
        } else {
            $templateProcessor->deleteBlock('memberi_perintah_section');
        }



        $keterangan_perundang_raw = $praPenindakan->ket_perundang;
        $keterangan_perundang_raw = preg_replace('/\s+/', ' ', trim($keterangan_perundang_raw));
        preg_match_all('/\#(.*?)\#/', $keterangan_perundang_raw, $matches);
        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'ik' => $index + 1 . '.',
                'keterangan_perundung' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('ik', $templateData);

        $dasar_sp_raw = $praPenindakan->dasar_sp;
        $dasar_sp_raw = preg_replace('/\s+/', ' ', trim($dasar_sp_raw));
        preg_match_all('/\#(.*?)\#/', $dasar_sp_raw, $matches);
        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'is' => $index + 1 . '.',
                'dasar_surat' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('is', $templateData);


        $perintah_sp_raw = $praPenindakan->perintah_sp;
        $perintah_sp_raw = preg_replace('/\s+/', ' ', trim($perintah_sp_raw));
        preg_match_all('/\#(.*?)\#/', $perintah_sp_raw, $matches);
        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'no' => $index + 1 . '.',
                'perintah_surat' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('no', $templateData);

        $ketentuan_lain_raw = $praPenindakan->ketentuan_lain;
        $ketentuan_lain_raw = preg_replace('/\s+/', ' ', trim($ketentuan_lain_raw));
        preg_match_all('/\#(.*?)\#/', $ketentuan_lain_raw, $matches);
        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'ke' => $index + 1 . '.',
                'ket_lain' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('ke', $templateData);

        $tglPrint = $praPenindakan->tgl_print;

        if (!empty($tglPrint)) {
            $tahunSuratPrint = date('Y', strtotime($tglPrint));
        } else {
            $tahunSuratPrint = '-';
        }

        $data['tahun_print'] = $tahunSuratPrint;

        $templateProcessor->setValue('tahun_print', $tahunSuratPrint);

        if (!empty($praPenindakan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($praPenindakan->skema_penindakan_perintah);
            $noPrint = $data['no_print'] ?? '1';
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['format_nomor'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['format_nomor'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['format_nomor'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['format_nomor'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['format_nomor'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }

        $templateProcessor->setValue('format_nomor', $data['format_nomor']);

        // dd($data);


        $fileName = 'Dokumen_Pra_Penindakan_Surat_Perintah_Nomor_' . $praPenindakan->no_print . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_mpp($id)
    {
        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        if (!empty($praPenindakan->dugaan_pelanggaran_mpp)) {
            preg_match('/^(.*?)\s*\((.*?)\)$/', $praPenindakan->dugaan_pelanggaran_mpp, $matches);

            $data['alasan_penindakan'] = $matches[1] ?? '';
            $data['pasal'] = $matches[2] ?? '';
        } else {
            $data['alasan_penindakan'] = '';
            $data['pasal'] = '';
        }


        $pejabatKeys = [
            'id_pejabat_mpp',
        ];


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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

        $data['tahun_sekarang'] = date('Y');


        $data = $this->formatDates($data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-mpp.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglPrint = $praPenindakan->tgl_print;

        if (!empty($tglPrint)) {
            $tahunSuratPrint = date('Y', strtotime($tglPrint));
        } else {
            $tahunSuratPrint = '-';
        }

        // dd($data);

        $templateProcessor->setValue('tahun_print', $tahunSuratPrint);

        $fileName = 'Dokumen_Pra_Penindakan_Surat_MPP_Nomor_' . $praPenindakan->no_mpp . '.docx';

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
