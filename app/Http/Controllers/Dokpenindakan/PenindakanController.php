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
        $id_pra_penindakan = $request->query('id_pra_penindakan'); // ini ngambil id_pra_penindakan di tbl_li

        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $id_pra_penindakan)->first();

        $users = User::all();
        $segels = TblSegel::all();
        $kemasans = TblKemasan::all();
        $no_ref = TblNoRef::first();
        $jenisPelanggaran = TblJenisPelanggaran::all();

        return view('Dokpenindakan.penindakan.create', compact('users', 'segels', 'kemasans', 'jenisPelanggaran', 'no_ref', 'laporan', 'id_pra_penindakan'));
    }

    public function store(Request $request)
    {
        TblSbp::create($request->all());
        $no_ref = TblNoRef::first();
        $no_ref->no_sbp += 1;
        $no_ref->no_mpp += 1;
        $no_ref->no_lap += 1;
        $no_ref->no_npi += 1;
        $no_ref->no_print += 1;
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
        $jenisPelanggaran = TblJenisPelanggaran::all();

        return view('Dokpenindakan.penindakan.edit', compact('penindakans', 'users', 'segels', 'kemasans', 'jenisPelanggaran', 'no_ref'));
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

        $kode_kantor = "KBC.0204";

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


        $data['tahun_sekarang'] = date('Y');

        $data = $this->formatDates($data);

        $data = array_map(function ($value) {
            return is_null($value) ? '' : $value;
        }, $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-bukti-penindakan.docx'));

        $templateProcessor->setValues($data);

        $fileName = 'Dokumen_Surat_Bukti_Penindakan' . $penindakan->no_sbp . '.docx';

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
