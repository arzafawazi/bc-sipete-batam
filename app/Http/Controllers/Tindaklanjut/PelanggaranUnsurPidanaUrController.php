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
use App\Models\TblPelanggaranUnsurPidanaUr;
use App\Models\TblPelanggaranUnsurPidanaPenyidikan;

class PelanggaranUnsurPidanaUrController extends Controller
{
    public function index()
    {
        $unsurpidana = TblPelanggaranUnsurPidanaUr::select('id')->get();

        // $unsurpidana = $unsurpidana->map(function ($item) {
        //     $item->tgl_bast_instansi_lain_pkl = $this->formatDates(['tgl_bast_instansi_lain_pkl' => $item->tgl_bast_instansi_lain_pkl])['tgl_bast_instansi_lain_pkl'];
        //     return $item;
        // });

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

        $unsurPidanaPenyidikan = TblPelanggaranUnsurPidanaPenyidikan::select('id', 'id_pelanggaran_unsur_pidana_penyidikan', 'no_lk', 'tgl_lk')
            ->get()
            ->map(function ($item) {
                $item->tgl_lk = $this->formatDates(['tgl_lk' => $item->tgl_lk])['tgl_lk'];
                return $item;
            });

        $sbpData = TblSbp::with('laporanInformasi')
            ->select('no_sbp', 'tgl_sbp', 'id_pra_penindakan_ref')
            ->get()
            ->map(function ($item) {
                $item->tgl_sbp = $this->formatDates(['tgl_sbp' => $item->tgl_sbp])['tgl_sbp'];
                return $item;
            });

        return view('Tindaklanjut.pelanggaran-unsur-pidana-ur.index', compact('unsurpidana', 'pascapenindakan', 'sbpData', 'penyidikan', 'unsurPidanaPenyidikan'));
    }

    public function create(Request $request)
    {
        $id_penyidikan = $request->query('id_penyidikan');
        $id_unsur_pidana = $request->query('id_pelanggaran_unsur_pidana_penyidikan');

        $users = User::all();
        $no_ref = TblNoRef::first();
        $nama_negara = TblNegara::all()->groupBy('benua');

        $pascapenindakan = null;
        $penyidikan = null;
        $sbpData = null;
        $laporanInformasi = collect(); // default collection kosong
        $saksiData = [];
        $tersangkaData = [];

        // Jika ada id_pelanggaran_unsur_pidana_penyidikan, prioritaskan
        if (!empty($id_unsur_pidana)) {
            $unsurpenyidikan = TblPelanggaranUnsurPidanaPenyidikan::where('id_pelanggaran_unsur_pidana_penyidikan', $id_unsur_pidana)->first();

            if ($unsurpenyidikan) {
                $saksiData = json_decode($unsurpenyidikan->data_saksi ?? '[]', true);
                $tersangkaData = json_decode($unsurpenyidikan->data_tersangka ?? '[]', true);

                // Override id_penyidikan dari relasi unsur
                $id_penyidikan = $unsurpenyidikan->id_penyidikan_ref ?? $id_penyidikan;
            }
        }

        // Jika belum ada data tersangka dari unsur, coba ambil dari penyidikan
        if (!empty($id_penyidikan) && empty($tersangkaData)) {
            $penyidikan = TblPenyidikan::where('id_penyidikan', $id_penyidikan)->first();

            if ($penyidikan) {
                $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();
                $sbpData = TblSbp::with('laporanInformasi')->where('id_penindakan', $pascapenindakan->id_penindakan_ref)->first();

                $laporanInformasi = TblLaporanInformasi::whereIn('id_pra_penindakan', $sbpData ? [$sbpData->id_pra_penindakan_ref] : [])->get();

                if ($sbpData) {
                    $tersangkaData = [
                        [
                            'nama' => $sbpData->nama_saksi ?? '',
                            'ttl' => $sbpData->ttl_saksi ?? '',
                            'agama' => $sbpData->agama_saksi ?? '',
                            'jenis_kelamin' => $sbpData->jk_saksi ?? '',
                            'kewarganegaraan' => $sbpData->kewarganegaraan_saksi ?? '',
                            'pekerjaan' => $sbpData->pekerjaan_saksi ?? '',
                            'alamat' => $sbpData->alamat_saksi ?? '',
                            'jenis_identitas' => $sbpData->jenis_iden_saksi ?? '',
                            'nomor_identitas' => $sbpData->no_identitas_saksi ?? '',
                            'pendidikan' => $sbpData->pendidikan_terakhir_saksi ?? '',
                        ],
                    ];
                }
            }
        }

        $dugaan_pelanggaran_tersangka = '';

        // Cek prioritas: ambil dari penyidikan atau unsurpenyidikan
        if (!empty($unsurpenyidikan) && isset($unsurpenyidikan->dugaan_pelanggaran_lpp)) {
            $dugaan_pelanggaran_tersangka = $unsurpenyidikan->dugaan_pelanggaran_lpp;
        } elseif (!empty($penyidikan) && isset($penyidikan->dugaan_pelanggaran_lpp)) {
            $dugaan_pelanggaran_tersangka = $penyidikan->dugaan_pelanggaran_lpp;
        }

        return view('Tindaklanjut.pelanggaran-unsur-pidana-ur.create', compact('users', 'no_ref', 'nama_negara', 'id_penyidikan', 'penyidikan', 'pascapenindakan', 'sbpData', 'laporanInformasi', 'saksiData', 'tersangkaData', 'dugaan_pelanggaran_tersangka'));
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); // Mulai transaksi database

            $requestData = $request->all();

            // Validasi request
            $request->validate([
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
                'pejabat_tersangka_sp1.*' => 'nullable|string',
                'pejabat_tersangka_sp2.*' => 'nullable|string',
                'status_surat_panggilan_1_tersangka.*' => 'nullable|string',
                'status_surat_panggilan_2_tersangka.*' => 'nullable|string',
                'tgl_panggilan_1_tersangka.*' => 'nullable|string',
                'tgl_panggilan_2_tersangka.*' => 'nullable|string',
                'no_spm_tersangka.*' => 'nullable|string',
                'tgl_spm_tersangka.*' => 'nullable|string',
                'pejabat_tersangka_spm.*' => 'nullable',
            ]);

            // dd($request->all());

            // Proses data saksi

            // Proses data tersangka
            $dataTersangka = [];
            if ($request->has('tersangka_nama')) {
                foreach ($request->tersangka_nama as $key => $nama) {

                    $pejabatSpm = $request->pejabat_tersangka_spm[$key] ?? null;
                    if ($pejabatSpm !== null && !is_array($pejabatSpm)) {
                        $pejabatSpm = [$pejabatSpm];
                    }

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
                        'pejabat_sp1' => $request->pejabat_tersangka_sp1[$key] ?? null,
                        'pejabat_sp2' => $request->pejabat_tersangka_sp2[$key] ?? null,
                        'status_panggilan_1' => $request->status_surat_panggilan_1_tersangka[$key] ?? null,
                        'status_panggilan_2' => $request->status_surat_panggilan_2_tersangka[$key] ?? null,
                        'tgl_panggilan_1' => $request->tgl_panggilan_1_tersangka[$key] ?? null,
                        'tgl_panggilan_2' => $request->tgl_panggilan_2_tersangka[$key] ?? null,
                        'no_spm' => $request->no_spm_tersangka[$key] ?? null,
                        'tgl_spm' => $request->tgl_spm_tersangka[$key] ?? null,
                        'pejabat_spm' => $pejabatSpm ? json_encode($pejabatSpm) : null,
                    ];
                }
            }

            $requestData = $request->except([
                'no_sp1_tersangka',
                'tgl_sp1_tersangka',
                'tersangka_nama',
                'tersangka_ttl',
                'tersangka_agama',
                'tersangka_kelamin',
                'tersangka_kewarganegaraan',
                'tersangka_pekerjaan',
                'tersangka_alamat',
                'tersangka_jenis_identitas',
                'tersangka_nomor_identitas',
                'tersangka_pendidikan',
                'no_sp2_tersangka',
                'tgl_sp2_tersangka',
                'pejabat_tersangka_sp1',
                'pejabat_tersangka_sp2',
                'status_surat_panggilan_1_tersangka',
                'status_surat_panggilan_2_tersangka',
                'tgl_panggilan_1_tersangka',
                'tgl_panggilan_2_tersangka',
                'no_spm_tersangka',
                'tgl_spm_tersangka',
                'pejabat_tersangka_spm',
            ]);


            // Tambahkan data saksi dan tersangka dalam bentuk JSON
            $requestData['data_tersangka'] = json_encode($dataTersangka);

            // dd($requestData);
            // dd($requestData);

            // Simpan ke database
            $unsurpenyidikanur = TblPelanggaranUnsurPidanaUr::create($requestData);

            // Update nomor referensi
            // $no_ref = TblNoRef::first();
            // $no_ref->no_lk += 1;
            // $no_ref->no_sptp += 1;
            // $no_ref->no_pdp += 1;
            // $no_ref->save();

            DB::commit(); // Simpan transaksi

            return redirect()->route('unsur-pidana-ur.edit', $unsurpenyidikanur->id)
                ->with('success', 'Data berhasil disimpan, silakan lanjutkan edit.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika ada error

            // Log detail error
            Log::error("Error saat menyimpan data: " . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Redirect dengan pesan error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi atau hubungi admin.');
        }
    }

    public function edit($id)
    {
        $unsurpenyidikanur = TblPelanggaranUnsurPidanaUr::where('id', $id)->first();
        if (!$unsurpenyidikanur) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $penyidikan = TblPenyidikan::where('id_penyidikan', $unsurpenyidikanur->id_penyidikan_ref)->first();
        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();
        $sbpData = TblSbp::with('laporanInformasi')->where('id_penindakan', $pascapenindakan->id_penindakan_ref)->first();
        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))->get();

        $users = User::all();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $no_ref = TblNoRef::first();

        $surat_penelitian = json_decode($unsurpenyidikanur->surat_perintah_penelitian_ur_tersangka ?? '[]', true);

        return view('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.edit', compact('unsurpenyidikanur', 'users', 'no_ref', 'penyidikan', 'nama_negara', 'pascapenindakan', 'sbpData', 'laporanInformasi', 'surat_penelitian'));
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
            'December' => 'Desember',
        ];

        Carbon::setLocale('id');

        $dateFields = ['tempus_lp', ''];

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
            90 => 'sembilan puluh',
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
