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
        $pascaPenindakan = TblPascaPenindakan::select('id', 'tgl_lphp', 'no_lphp')->get();

        $pascaPenindakan = $pascaPenindakan->map(function ($item) {
            $item->tgl_lphp = $this->formatDates(['tgl_lphp' => $item->tgl_lphp])['tgl_lphp'];
            return $item;
        });

        $penindakan = TblSbp::select('no_sbp', 'tgl_sbp', 'id_pra_penindakan_ref', 'id_penindakan', 'opsi_penindakan')
            ->get()
            ->map(function ($item) {
                $item->tgl_sbp = $this->formatDates(['tgl_sbp' => $item->tgl_sbp])['tgl_sbp'];
                return $item;
            });


        return view('Dokpenindakan.pasca-penindakan.index', compact('pascaPenindakan', 'penindakan'));
    }

    public function create(Request $request)
    {
        $id_penindakan = $request->query('id_penindakan');

        // dd($id_penindakan);

        $penindakan = TblSbp::where('id_penindakan', $id_penindakan)->first();

        // dd($penindakan);

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
            'locus'
        ));
    }

    public function edit($id)
    {
        // $id_penindakan = $request->query('id_penindakan');

        // dd($id_penindakan);

        // $penindakan = TblSbp::where('id_penindakan', $id_penindakan)->first();

        // dd($penindakan);

        $pascapenindakan = TblPascaPenindakan::findOrFail($id);

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
            // 'penindakan',
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