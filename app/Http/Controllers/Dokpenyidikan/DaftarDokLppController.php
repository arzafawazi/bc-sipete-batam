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
            'tipe_penyidikan'
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



    public function edit() {}

    public function update() {}

    public function destroy() {}



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