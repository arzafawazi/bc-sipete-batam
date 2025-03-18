<?php

namespace App\Http\Controllers\Tindaklanjut;

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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\Barang;
use App\Models\TblPelanggaranUnsurPidanaPenyidikan;

class PelanggaranUnsurPidanaPenyidikanController extends Controller
{
    public function index()
    {
        $unsurpidana = TblPelanggaranUnsurPidanaPenyidikan::select('id', 'no_lk', 'tgl_lk')->get();


        $unsurpidana = $unsurpidana->map(function ($item) {
            $item->tgl_lk = $this->formatDates(['tgl_lk' => $item->tgl_lk])['tgl_lk'];
            return $item;
        });

        // dd($unsurpidana);

        $pascapenindakan = TblPascaPenindakan::select('no_lp', 'tgl_lp', 'id_pasca_penindakan', 'id_penindakan_ref')
            ->get()
            ->map(function ($item) {
                $item->tgl_lp = $this->formatDates(['tgl_lp' => $item->tgl_lp])['tgl_lp'];
                return $item;
            });

        $penyidikan = TblPenyidikan::select('no_lhp_penyidikan', 'tgl_lhp_penyidikan', 'id_pasca_penindakan_ref', 'id_penyidikan')
            ->get()
            ->map(function ($item) {
                $item->tgl_lhp_penyidikan = $this->formatDates(['tgl_lhp_penyidikan' => $item->tgl_lhp_penyidikan])['tgl_lhp_penyidikan'];
                return $item;
            });

        $sbpData = TblSbp::with('laporanInformasi')
            ->select('no_sbp', 'tgl_sbp', 'id_pra_penindakan_ref')
            ->get()
            ->map(function ($item) {
                $item->tgl_sbp = $this->formatDates(['tgl_sbp' => $item->tgl_sbp])['tgl_sbp'];
                return $item;
            });

        return view('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.index', compact('unsurpidana', 'pascapenindakan', 'sbpData', 'penyidikan'));
    }


    public function create(Request $request)
    {
        $id_penyidikan = $request->query('id_penyidikan');

        // Ambil data penyidikan berdasarkan ID yang dikirim
        $penyidikan = TblPenyidikan::where('id_penyidikan', $id_penyidikan)->first();

        $no_lhp_penyidikan = $penyidikan->no_lhp_penyidikan;
        $tahun_lhp = date('Y', strtotime($penyidikan->tgl_lhp_penyidikan));


        // dd($barang);
        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();

        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', $pascapenindakan->id_penindakan_ref)
            ->first();



        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))
            ->get();


        $users = User::all();
        $no_ref = TblNoRef::first();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $saksiData = json_decode($unsurpenyidikan->data_saksi ?? '[]', true);
        $tersangkaData = json_decode($unsurpenyidikan->data_tersangka ?? '[]', true);




        return view('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.create', compact(
            'users',
            'no_ref',
            'nama_negara',
            'id_penyidikan',
            'saksiData',
            'tersangkaData',
            'pascapenindakan',
            'penyidikan', // Menambahkan data TblPenyidikan
            'sbpData', // Menambahkan data TblSbp
            'laporanInformasi', // Menambahkan data TblLaporanInformasi
        ));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi request
        $request->validate([
            'no_sp1_saksi.*' => 'nullable|string',
            'tgl_sp1_saksi.*' => 'nullable|date',
            'saksi_nama.*' => 'nullable|string',
            'saksi_ttl.*' => 'nullable|string',
            'saksi_kelamin.*' => 'nullable|string',
            'saksi_kewarganegaraan.*' => 'nullable|string',
            'saksi_agama.*' => 'nullable|string',
            'saksi_pekerjaan.*' => 'nullable|string',
            'saksi_alamat.*' => 'nullable|string',
            'no_sp2_saksi.*' => 'nullable|string',
            'tgl_sp2_saksi.*' => 'nullable|string',
            'no_spm_saksi.*' => 'nullable|string',
            'tgl_spm_saksi.*' => 'nullable|string',
            'pejabat_saksi_sp1.*' => 'nullable|string',
            'pejabat_saksi_sp2.*' => 'nullable|string',
            'status_surat_panggilan_1_saksi.*' => 'nullable|string',
            'status_surat_panggilan_2_saksi.*' => 'nullable|string',
            'tgl_panggilan_1_saksi.*' => 'nullable|string',
            'tgl_panggilan_2_saksi.*' => 'nullable|string',

            'no_sp1_tersangka.*' => 'nullable|string',
            'tgl_sp1_tersangka.*' => 'nullable|date',
            'tersangka_nama.*' => 'nullable|string',
            'tersangka_ttl.*' => 'nullable|string',
            'tersangka_agama.*' => 'nullable|string',
            'tersangka_kelamin.*' => 'nullable|string',
            'tersangka_kewarganegaraan.*' => 'nullable|string',
            'tersangka_pekerjaan.*' => 'nullable|string',
            'tersangka_alamat.*' => 'nullable|string',
            'tersangka_jenis_identitas.*' => 'nullable|string',
            'tersangka_nomor_identitas.*' => 'nullable|string',
            'tersangka_pendidikan.*' => 'nullable|string',
            'no_sp2_tersangka.*' => 'nullable|string',
            'tgl_sp2_tersangka.*' => 'nullable|string',
            'no_spm_tersangka.*' => 'nullable|string',
            'tgl_spm_tersangka.*' => 'nullable|string',
            'pejabat_tersangka_sp1.*' => 'nullable|string',
            'pejabat_tersangka_sp2.*' => 'nullable|string',
            'status_surat_panggilan_1_tersangka.*' => 'nullable|string',
            'status_surat_panggilan_2_tersangka.*' => 'nullable|string',
            'tgl_panggilan_1_tersangka.*' => 'nullable|string',
            'tgl_panggilan_2_tersangka.*' => 'nullable|string',
        ]);

        // Proses data saksi menjadi array
        $dataSaksi = [];
        if ($request->has('saksi_nama')) {
            foreach ($request->saksi_nama as $key => $nama) {
                $dataSaksi[] = [
                    'no_sp1' => $request->no_sp1_saksi[$key] ?? null,
                    'tgl_sp1' => $request->tgl_sp1_saksi[$key] ?? null,
                    'nama' => $nama,
                    'ttl' => $request->saksi_ttl[$key] ?? null,
                    'jenis_kelamin' => $request->saksi_kelamin[$key] ?? null,
                    'kewarganegaraan' => $request->saksi_kewarganegaraan[$key] ?? null,
                    'agama' => $request->saksi_agama[$key] ?? null,
                    'pekerjaan' => $request->saksi_pekerjaan[$key] ?? null,
                    'alamat' => $request->saksi_alamat[$key] ?? null,
                    'no_sp2' => $request->no_sp2_saksi[$key] ?? null,
                    'tgl_sp2' => $request->tgl_sp2_saksi[$key] ?? null,
                    'no_spm' => $request->no_spm_saksi[$key] ?? null,
                    'tgl_spm' => $request->tgl_spm_saksi[$key] ?? null,
                    'pejabat_sp1' => $request->pejabat_saksi_sp1[$key] ?? null,
                    'pejabat_sp2' => $request->pejabat_saksi_sp2[$key] ?? null,
                    'status_panggilan_1' => $request->status_surat_panggilan_1_saksi[$key] ?? null,
                    'status_panggilan_2' => $request->status_surat_panggilan_2_saksi[$key] ?? null,
                    'tgl_panggilan_1' => $request->tgl_panggilan_1_saksi[$key] ?? null,
                    'tgl_panggilan_2' => $request->tgl_panggilan_2_saksi[$key] ?? null,
                ];
            }
        }

        // Proses data tersangka menjadi array
        $dataTersangka = [];
        if ($request->has('tersangka_nama')) {
            foreach ($request->tersangka_nama as $key => $nama) {
                $dataTersangka[] = [
                    'no_sp1' => $request->no_sp1_tersangka[$key] ?? null,
                    'tgl_sp1' => $request->tgl_sp1_tersangka[$key] ?? null,
                    'nama' => $nama,
                    'ttl' => $request->tersangka_ttl[$key] ?? null,
                    'agama' => $request->tersangka_agama[$key] ?? null,
                    'jenis_kelamin' => $request->tersangka_kelamin[$key] ?? null,
                    'kewarganegaraan' => $request->tersangka_kewarganegaraan[$key] ?? null,
                    'pekerjaan' => $request->tersangka_pekerjaan[$key] ?? null,
                    'alamat' => $request->tersangka_alamat[$key] ?? null,
                    'jenis_identitas' => $request->tersangka_jenis_identitas[$key] ?? null,
                    'nomor_identitas' => $request->tersangka_nomor_identitas[$key] ?? null,
                    'pendidikan' => $request->tersangka_pendidikan[$key] ?? null,
                    'no_sp2' => $request->no_sp2_tersangka[$key] ?? null,
                    'tgl_sp2' => $request->tgl_sp2_tersangka[$key] ?? null,
                    'no_spm' => $request->no_spm_tersangka[$key] ?? null,
                    'tgl_spm' => $request->tgl_spm_tersangka[$key] ?? null,
                    'pejabat_sp1' => $request->pejabat_tersangka_sp1[$key] ?? null,
                    'pejabat_sp2' => $request->pejabat_tersangka_sp2[$key] ?? null,
                    'status_panggilan_1' => $request->status_surat_panggilan_1_tersangka[$key] ?? null,
                    'status_panggilan_2' => $request->status_surat_panggilan_2_tersangka[$key] ?? null,
                    'tgl_panggilan_1' => $request->tgl_panggilan_1_tersangka[$key] ?? null,
                    'tgl_panggilan_2' => $request->tgl_panggilan_2_tersangka[$key] ?? null,
                ];
            }
        }

        // Ambil semua input dari form kecuali field yang sudah diproses sebelumnya
        $requestData = $request->except(array_keys($request->all()));

        // Tambahkan data saksi dan tersangka dalam bentuk JSON
        $requestData['data_saksi'] = json_encode($dataSaksi);
        $requestData['data_tersangka'] = json_encode($dataTersangka);



        // dd($requestData);

        // Simpan ke database
        TblPelanggaranUnsurPidanaPenyidikan::create($requestData);

        // Update nomor referensi
        $no_ref = TblNoRef::first();
        $no_ref->no_lk += 1;
        $no_ref->no_sptp += 1;
        $no_ref->no_pdp += 1;
        $no_ref->save();

        return redirect()->route('unsur-pidana-penyidikan.index')
            ->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');
    }





    public function edit($id)
    {
        $unsurpenyidikan = TblPelanggaranUnsurPidanaPenyidikan::where('id', $id)->first();
        if (!$unsurpenyidikan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $penyidikan = TblPenyidikan::where('id_penyidikan', $unsurpenyidikan->id_penyidikan_ref)->first();
        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();
        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', $pascapenindakan->id_penindakan_ref)
            ->first();
        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))->get();

        $users = User::all();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $no_ref = TblNoRef::first();

        // Decode JSON data saksi
        $saksiData = json_decode($unsurpenyidikan->data_saksi ?? '[]', true);
        $tersangkaData = json_decode($unsurpenyidikan->data_tersangka ?? '[]', true);


        return view('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.edit', compact(
            'unsurpenyidikan',
            'users',
            'no_ref',
            'penyidikan',
            'nama_negara',
            'pascapenindakan',
            'sbpData',
            'laporanInformasi',
            'saksiData', // Kirim data saksi ke view
            'tersangkaData' // Kirim data saksi ke view
        ));
    }



    public function update($id)
    {
        $data = request()->all();

        $item = TblPelanggaranUnsurPidanaPenyidikan::find($id);
        if ($item) {
            $item->update($data);
            return redirect()->route('unsur-pidana-penyidikan.index')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->route('unsur-pidana-penyidikan.index')->with('error', 'Data tidak ditemukan.');
    }

    public function destroy($id)
    {
        $unsurpenyidikan = TblPelanggaranUnsurPidanaPenyidikan::find($id);
        if ($unsurpenyidikan) {
            $unsurpenyidikan->delete();
            return redirect()->route('unsur-pidana-penyidikan.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('unsur-pidana-penyidikan.index')->with('error', 'Data tidak ditemukan.');
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