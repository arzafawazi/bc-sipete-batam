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
        try {
            DB::beginTransaction(); // Mulai transaksi database


            $requestData = $request->all();


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
                'pejabat_saksi_sp1.*' => 'nullable|string',
                'pejabat_saksi_sp2.*' => 'nullable|string',
                'status_surat_panggilan_1_saksi.*' => 'nullable|string',
                'status_surat_panggilan_2_saksi.*' => 'nullable|string',
                'tgl_panggilan_1_saksi.*' => 'nullable|string',
                'tgl_panggilan_2_saksi.*' => 'nullable|string',
                'no_spm_saksi.*' => 'nullable|string',
                'tgl_spm_saksi.*' => 'nullable|string',
                'pejabat_saksi_spm.*' => 'nullable',

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
            $dataSaksi = [];
            if ($request->has('saksi_nama')) {
                foreach ($request->saksi_nama as $key => $nama) {

                    $pejabatSpm = $request->pejabat_saksi_spm[$key] ?? null;
                    if ($pejabatSpm !== null && !is_array($pejabatSpm)) {
                        $pejabatSpm = [$pejabatSpm];
                    }

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
                        'pejabat_sp1' => $request->pejabat_saksi_sp1[$key] ?? null,
                        'pejabat_sp2' => $request->pejabat_saksi_sp2[$key] ?? null,
                        'status_panggilan_1' => $request->status_surat_panggilan_1_saksi[$key] ?? null,
                        'status_panggilan_2' => $request->status_surat_panggilan_2_saksi[$key] ?? null,
                        'tgl_panggilan_1' => $request->tgl_panggilan_1_saksi[$key] ?? null,
                        'tgl_panggilan_2' => $request->tgl_panggilan_2_saksi[$key] ?? null,
                        'no_spm' => $request->no_spm_saksi[$key] ?? null,
                        'tgl_spm' => $request->tgl_spm_saksi[$key] ?? null,
                        'pejabat_spm' => $pejabatSpm ? json_encode($pejabatSpm) : null,
                    ];
                }
            }

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
                'no_sp1_saksi',
                'tgl_sp1_saksi',
                'saksi_nama',
                'saksi_ttl',
                'saksi_kelamin',
                'saksi_kewarganegaraan',
                'saksi_agama',
                'saksi_pekerjaan',
                'saksi_alamat',
                'no_sp2_saksi',
                'tgl_sp2_saksi',
                'pejabat_saksi_sp1',
                'pejabat_saksi_sp2',
                'status_surat_panggilan_1_saksi',
                'status_surat_panggilan_2_saksi',
                'tgl_panggilan_1_saksi',
                'tgl_panggilan_2_saksi',
                'no_spm_saksi',
                'tgl_spm_saksi',
                'pejabat_saksi_spm',

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
            $requestData['data_saksi'] = json_encode($dataSaksi);
            $requestData['data_tersangka'] = json_encode($dataTersangka);

            // dd($requestData);
            // dd($requestData);

            // Simpan ke database
            $unsurpenyidikan = TblPelanggaranUnsurPidanaPenyidikan::create($requestData);

            // Update nomor referensi
            $no_ref = TblNoRef::first();
            $no_ref->no_lk += 1;
            $no_ref->no_sptp += 1;
            $no_ref->no_pdp += 1;
            $no_ref->save();

            DB::commit(); // Simpan transaksi

            return redirect()->route('unsur-pidana-penyidikan.edit', $unsurpenyidikan->id)
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

        
        $saksiData = json_decode($unsurpenyidikan->data_saksi ?? '[]', true);
        $tersangkaData = json_decode($unsurpenyidikan->data_tersangka ?? '[]', true);
        $ahliData = json_decode($unsurpenyidikan->data_ahli ?? '[]', true);

        $berkasBawBapSaksi = json_decode($unsurpenyidikan->berkas_baw_bap_saksi ?? '[]', true);
        $berkasBawBapTersangka = json_decode($unsurpenyidikan->berkas_baw_bap_tersangka ?? '[]', true);
        $berkasBawBapAhli = json_decode($unsurpenyidikan->berkas_baw_bap_ahli ?? '[]', true);

        $baSumpahSaksi = json_decode($unsurpenyidikan->ba_sumpah_saksi ?? '[]', true);
        $baSumpahAhli = json_decode($unsurpenyidikan->ba_sumpah_ahli ?? '[]', true);
        
        $penggeledahanTersangka = json_decode($unsurpenyidikan->penggeledahan_tersangka ?? '[]', true);
        $BaPenggeledahanTersangka = json_decode($unsurpenyidikan->ba_penggeledahan_tersangka ?? '[]', true);

        $penyitaanTersangka = json_decode($unsurpenyidikan->penyitaan_tersangka ?? '[]', true);
        $BaPenyitaanTersangka = json_decode($unsurpenyidikan->ba_penyitaan_tersangka ?? '[]', true);

        $sidikjariTersangka = json_decode($unsurpenyidikan->sidik_jari_tersangka ?? '[]', true);;

        

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
            'tersangkaData', // Kirim data saksi ke view
            'ahliData',
            'berkasBawBapSaksi',
            'berkasBawBapTersangka',
            'berkasBawBapAhli',
            'baSumpahSaksi',
            'baSumpahAhli',
            'penggeledahanTersangka',
            'BaPenggeledahanTersangka',
            'penyitaanTersangka',
            'BaPenyitaanTersangka',
            'sidikjariTersangka'
        ));
    }



    public function update(Request $request, $id)
    {
    try {
        DB::beginTransaction();

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
            'pejabat_saksi_sp1.*' => 'nullable|string',
            'pejabat_saksi_sp2.*' => 'nullable|string',
            'status_surat_panggilan_1_saksi.*' => 'nullable|string',
            'status_surat_panggilan_2_saksi.*' => 'nullable|string',
            'tgl_panggilan_1_saksi.*' => 'nullable|string',
            'tgl_panggilan_2_saksi.*' => 'nullable|string',
            'no_spm_saksi.*' => 'nullable|string',
            'tgl_spm_saksi.*' => 'nullable|string',
            'pejabat_saksi_spm.*' => 'nullable|array',
            'baw_bap_nama_saksi.*' => 'nullable|string',
            'baw_saksi.*' => 'nullable|file|mimes:pdf,doc,docx',
            'bap_saksi.*' => 'nullable|file|mimes:pdf,doc,docx',
            'ba_sumpah_nama_saksi.*' => 'nullable|string',
            'waktu_sumpah_saksi.*' => 'nullable|string',
            'saksi_pertama_ba_sumpah_saksi.*' => 'nullable|string',
            'saksi_kedua_ba_sumpah_saksi.*' => 'nullable|string',

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
            'pejabat_tersangka_spm.*' => 'nullable|array',
            'baw_bap_nama_tersangka.*' => 'nullable|string',
            'baw_tersangka.*' => 'nullable|file|mimes:pdf,doc,docx',
            'bap_tersangka.*' => 'nullable|file|mimes:pdf,doc,docx',

            'ahli_nama.*' => 'nullable|string',
            'ahli_ttl.*' => 'nullable|string',
            'ahli_kelamin.*' => 'nullable|string',
            'ahli_agama.*' => 'nullable|string',
            'ahli_pekerjaan.*' => 'nullable|string',
            'ahli_alamat_domisili.*' => 'nullable|string',
            'ahli_alamat_kantor.*' => 'nullable|string',
            'baw_bap_nama_ahli.*' => 'nullable|string',
            'baw_ahli.*' => 'nullable|file|mimes:pdf,doc,docx',
            'bap_ahli.*' => 'nullable|file|mimes:pdf,doc,docx',
            'ba_sumpah_nama_ahli.*' => 'nullable|string',
            'waktu_sumpah_ahli.*' => 'nullable|string',
            'saksi_pertama_ba_sumpah_ahli.*' => 'nullable|string',
            'saksi_kedua_ba_sumpah_ahli.*' => 'nullable|string',

            'waktu_ba_geledah.*' => 'nullable|string',
            'pejabat_penerbit_surat_penggeledahan_tersangka_ba.*' => 'nullable|string',
            'ba_penggeledahan_izin_pengadilan.*' => 'nullable|string',
            'ba_penggeledahan_izin_lain.*' => 'nullable|string',
            'diisi_ba_penggeledahan.*' => 'nullable|string',
            'diisi_identitas_ba_penggeledahan.*' => 'nullable|string',
            'ba_penggeledahan_nama_tersangka.*' => 'nullable|string',
            'saksi1_geledah_nama.*' => 'nullable|string',
            'saksi1_geledah_alamat.*' => 'nullable|string',
            'saksi1_geledah_pekerjaan.*' => 'nullable|string',
            'saksi2_geledah_nama.*' => 'nullable|string',
            'saksi2_geledah_alamat.*' => 'nullable|string',
            'uraian_penggeledahan.*' => 'nullable|string',

            'no_spp_tersangka.*' => 'nullable|string',
            'tgl_spp_tersangka.*' => 'nullable|string',
            'penyitaan_nama_tersangka.*' => 'nullable|string',
            'jumlah_jenis_barang_sita.*' => 'nullable|string',
            'waktu_surat_penyitaan_tersangka.*' => 'nullable|string',
            'pejabat_penerbit_surat_penyitaan_tersangka.*' => 'nullable|string',
            
            'waktu_ba_penyitaan.*' => 'nullable|string',
            'pejabat_penerbit_surat_penyitaan_tersangka_ba.*' => 'nullable|string',
            'pejabat_saksi_pertama.*' => 'nullable|string',
            'pejabat_saksi_kedua.*' => 'nullable|string',
            'ba_penyitaan_nama_tersangka.*' => 'nullable|string',

            'no_sppp_tersangka.*' => 'nullable|string',
            'tgl_sppp_tersangka.*' => 'nullable|string',
            'pemotretan_nama_tersangka.*' => 'nullable|string',
            'rincian_data.*' => 'nullable|string',
            'waktu_surat_pemotretan_tersangka.*' => 'nullable|string',
            'pejabat_penerbit_surat_pemotretan_tersangka.*' => 'nullable|string',

            'waktu_ba_potret.*' => 'nullable|string',
            'pejabat_pertama_surat_penggeledahan_tersangka_ba.*' => 'nullable|string',
            'pejabat_kedua_surat_penggeledahan_tersangka_ba.*' => 'nullable|string',
            'ba_pemotretan_nama_tersangka.*' => 'nullable|string',
            'saksi1_potret_nama.*' => 'nullable|string',
            'saksi1_potret_alamat.*' => 'nullable|string',
            'saksi1_potret_pekerjaan.*' => 'nullable|string',
            'saksi2_potret_nama.*' => 'nullable|string',
            'saksi2_potret_alamat.*' => 'nullable|string',
            'diisi_cara_pemotretan.*' => 'nullable|string',

            'no_sppsj_tersangka.*' => 'nullable|string',
            'tgl_sppsj_tersangka.*' => 'nullable|string',
            'sidikjari_nama_tersangka.*' => 'nullable|string',
            'waktu_surat_sidikjari_tersangka.*' => 'nullable|string',
            'pejabat_penerbit_surat_sidikjari_tersangka.*' => 'nullable|string',

            'waktu_ba_sidik_jari.*' => 'nullable|string',
            'pejabat_pertama_surat_sidikjari_tersangka_ba.*' => 'nullable|string',
            'pejabat_kedua_surat_sidikjari_tersangka_ba.*' => 'nullable|string',
            'ba_sidikjari_nama_tersangka.*' => 'nullable|string',
            'saksi1_sidik_jari_nama.*' => 'nullable|string',
            'saksi1_sidik_jari_alamat.*' => 'nullable|string',
            'saksi1_sidik_jari_pekerjaan.*' => 'nullable|string',
            'saksi2_sidik_jari_nama.*' => 'nullable|string',
            'saksi2_sidik_jari_alamat.*' => 'nullable|string',

            'no_spfd_tersangka.*' => 'nullable|string',
            'tgl_spfd_tersangka.*' => 'nullable|string',
            'forensik_nama_tersangka.*' => 'nullable|string',
            'rincian_data_bukti.*' => 'nullable|string',
            'waktu_surat_forensik_tersangka.*' => 'nullable|string',
            'pejabat_penerbit_surat_forensik_tersangka.*' => 'nullable|string',

            'no_ba_perolehan.*' => 'nullable|string',
            'tgl_ba_perolehan.*' => 'nullable|string',
            'ba_forensik_nama_tersangka.*' => 'nullable|string',
            'surat_nota_dinas.*' => 'nullable|string',
            'nama_forensik_digital.*' => 'nullable|string',
            'pejabat_meminta_surat_forensik_tersangka_ba.*' => 'nullable|string',

            'waktu_ba_gelar_perkara.*' => 'nullable|string',
            'hasil_gelar_perkara.*' => 'nullable|string',
            'ba_gelar_perkara_nama_tersangka.*' => 'nullable|string',
            'kesimpulan_gelar_perkara.*' => 'nullable|string',
            'rencana_kegiatan_penyidikan.*' => 'nullable|string',
            'pejabat_gelar_perkara.*' => 'nullable|string',

            'no_staptsk_tersangka.*' => 'nullable|string',
            'tgl_staptsk_tersangka.*' => 'nullable|string',
            'penetapan_nama_tersangka.*' => 'nullable|string',
            'pejabat_penerbit_surat_penetapan_tersangka.*' => 'nullable|string',
            'status_plh.*' => 'nullable|string',

            'no_spp_penangkapan_tersangka.*' => 'nullable|string',
            'tgl_spp_penangkapan_tersangka.*' => 'nullable|string',
            'penangkapan_nama_tersangka.*' => 'nullable|string',
            'pejabat_penerbit_surat_penangkapan_tersangka.*' => 'nullable|string',
            'status_plh_spp.*' => 'nullable|string',
            'pejabat_penerima_surat_penangkapan_tersangka.*' => 'nullable|string',
            'pejabat_menyerahkan_surat_penangkapan_tersangka.*' => 'nullable|string',
        ]);


        // dd($request->all());

        // Cari data yang akan diupdate
        $item = TblPelanggaranUnsurPidanaPenyidikan::find($id);
        if (!$item) {
            return redirect()->route('unsur-pidana-penyidikan.index')->with('error', 'Data tidak ditemukan.');
        }

        // Proses data saksi
        $dataSaksi = [];
        if ($request->has('saksi_nama')) {
            foreach ($request->saksi_nama as $key => $nama) {
                $pejabatSpm = $request->input("pejabat_saksi_spm.$key", []);

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
                    'pejabat_sp1' => $request->pejabat_saksi_sp1[$key] ?? null,
                    'pejabat_sp2' => $request->pejabat_saksi_sp2[$key] ?? null,
                    'status_panggilan_1' => $request->status_surat_panggilan_1_saksi[$key] ?? null,
                    'status_panggilan_2' => $request->status_surat_panggilan_2_saksi[$key] ?? null,
                    'tgl_panggilan_1' => $request->tgl_panggilan_1_saksi[$key] ?? null,
                    'tgl_panggilan_2' => $request->tgl_panggilan_2_saksi[$key] ?? null,
                    'no_spm' => $request->no_spm_saksi[$key] ?? null,
                    'tgl_spm' => $request->tgl_spm_saksi[$key] ?? null,
                    'pejabat_spm' => !empty($pejabatSpm) ? json_encode($pejabatSpm) : null,
                ];
            }
        }

        $dataTersangka = [];
        if ($request->has('tersangka_nama')) {
            foreach ($request->tersangka_nama as $key => $nama) {
                $pejabatSpm = $request->input("pejabat_tersangka_spm.$key", []);

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
                    'pejabat_spm' => !empty($pejabatSpm) ? json_encode($pejabatSpm) : null,
                ];
            }
        }

        $dataAhli = [];
        if ($request->has('ahli_nama')) {
                foreach ($request->ahli_nama as $key => $nama) {
                    $dataAhli[] = [
                        'nama' => $nama,
                        'ttl' => $request->ahli_ttl[$key] ?? null,
                        'jenis_kelamin' => $request->ahli_kelamin[$key] ?? null,
                        'agama' => $request->ahli_agama[$key] ?? null,
                        'pekerjaan' => $request->ahli_pekerjaan[$key] ?? null,
                        'alamat_domisili' => $request->ahli_alamat_domisili[$key] ?? null,
                        'alamat_kantor' => $request->ahli_alamat_kantor[$key] ?? null,
                    ];
                }
            }

        // Proses data berkas BAW dan BAP saksi
        $berkasBawBapSaksi = [];
        if ($request->has('baw_bap_nama_saksi')) {
            // Ambil data sebelumnya dari database
            $dataSebelumnya = json_decode($item->berkas_baw_bap_saksi, true) ?? [];

            foreach ($request->baw_bap_nama_saksi as $key => $nama) {
                $berkasBaw = null;
                $berkasBap = null;
                
                // Proses upload file BAW
                if ($request->hasFile("baw_saksi.$key")) {
                    $file = $request->file("baw_saksi.$key");
                    $fileName = 'baw_saksi_' . time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('berkas/saksi/baw', $fileName, 'public');
                    $berkasBaw = $path;
                }
                
                // Proses upload file BAP
                if ($request->hasFile("bap_saksi.$key")) {
                    $file = $request->file("bap_saksi.$key");
                    $fileName = 'bap_saksi_' . time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('berkas/saksi/bap', $fileName, 'public');
                    $berkasBap = $path;
                }
                
                // Cari indeks data yang sudah ada sebelumnya
                $dataSebelumnyaIndex = array_search($nama, array_column($dataSebelumnya, 'nama'));
                
                // Logika update yang komprehensif
                if ($dataSebelumnyaIndex !== false) {
                    // Jika data sudah ada, update file yang baru diupload
                    $entryLama = $dataSebelumnya[$dataSebelumnyaIndex];
                    
                    $berkasBawBapSaksi[] = [
                        'nama' => $nama,
                        'berkas_baw' => $berkasBaw ?? $entryLama['berkas_baw'],
                        'berkas_bap' => $berkasBap ?? $entryLama['berkas_bap'],
                        'tanggal_upload' => now()->format('Y-m-d H:i:s')
                    ];
                } else {
                    // Jika data baru, tambahkan entri baru
                    if ($berkasBaw || $berkasBap) {
                        $berkasBawBapSaksi[] = [
                            'nama' => $nama,
                            'berkas_baw' => $berkasBaw,
                            'berkas_bap' => $berkasBap,
                            'tanggal_upload' => now()->format('Y-m-d H:i:s')
                        ];
                    }
                }
            }
}
        
        // Proses data berkas BAW dan BAP tersangka
        $berkasBawBapTersangka = [];
        if ($request->has('baw_bap_nama_tersangka')) {
            $dataSebelumnya = json_decode($item->berkas_baw_bap_tersangka, true) ?? [];
        
            foreach ($request->baw_bap_nama_tersangka as $key => $nama) {
                $berkasBaw = null;
                $berkasBap = null;
                
                if ($request->hasFile("baw_tersangka.$key")) {
                    $file = $request->file("baw_tersangka.$key");
                    $fileName = 'baw_tersangka_' . time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('berkas/tersangka/baw', $fileName, 'public');
                    $berkasBaw = $path;
                }
                
                if ($request->hasFile("bap_tersangka.$key")) {
                    $file = $request->file("bap_tersangka.$key");
                    $fileName = 'bap_tersangka_' . time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('berkas/tersangka/bap', $fileName, 'public');
                    $berkasBap = $path;
                }
                
                $dataSebelumnyaIndex = array_search($nama, array_column($dataSebelumnya, 'nama'));
                
                if ($dataSebelumnyaIndex !== false) {
                    $entryLama = $dataSebelumnya[$dataSebelumnyaIndex];
                    
                    $berkasBawBapTersangka[] = [
                        'nama' => $nama,
                        'berkas_baw' => $berkasBaw ?? $entryLama['berkas_baw'],
                        'berkas_bap' => $berkasBap ?? $entryLama['berkas_bap'],
                        'tanggal_upload' => now()->format('Y-m-d H:i:s')
                    ];
                } else {
                    if ($berkasBaw || $berkasBap) {
                        $berkasBawBapTersangka[] = [
                            'nama' => $nama,
                            'berkas_baw' => $berkasBaw,
                            'berkas_bap' => $berkasBap,
                            'tanggal_upload' => now()->format('Y-m-d H:i:s')
                        ];
                    }
                }
            }
        }


        $berkasBawBapAhli = [];
        if ($request->has('baw_bap_nama_ahli')) {
            $dataSebelumnya = json_decode($item->berkas_baw_bap_ahli, true) ?? [];
        
            foreach ($request->baw_bap_nama_ahli as $key => $nama) {
                $berkasBaw = null;
                $berkasBap = null;
                
                if ($request->hasFile("baw_ahli.$key")) {
                    $file = $request->file("baw_ahli.$key");
                    $fileName = 'baw_ahli_' . time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('berkas/ahli/baw', $fileName, 'public');
                    $berkasBaw = $path;
                }
                
                if ($request->hasFile("bap_ahli.$key")) {
                    $file = $request->file("bap_ahli.$key");
                    $fileName = 'bap_ahli_' . time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('berkas/ahli/bap', $fileName, 'public');
                    $berkasBap = $path;
                }
                
                $dataSebelumnyaIndex = array_search($nama, array_column($dataSebelumnya, 'nama'));
                
                if ($dataSebelumnyaIndex !== false) {
                    $entryLama = $dataSebelumnya[$dataSebelumnyaIndex];
                    
                    $berkasBawBapAhli[] = [
                        'nama' => $nama,
                        'berkas_baw' => $berkasBaw ?? $entryLama['berkas_baw'],
                        'berkas_bap' => $berkasBap ?? $entryLama['berkas_bap'],
                        'tanggal_upload' => now()->format('Y-m-d H:i:s')
                    ];
                } else {
                    if ($berkasBaw || $berkasBap) {
                        $berkasBawBapAhli[] = [
                            'nama' => $nama,
                            'berkas_baw' => $berkasBaw,
                            'berkas_bap' => $berkasBap,
                            'tanggal_upload' => now()->format('Y-m-d H:i:s')
                        ];
                    }
                }
            }
        }



        $dataBaSumpahSaksi = [];
        if ($request->has('ba_sumpah_nama_saksi')) {
            foreach ($request->ba_sumpah_nama_saksi as $key => $nama) {

                $dataBaSumpahSaksi[] = [
                    'nama' => $nama,
                    'waktu_sumpah' => $request->waktu_sumpah_saksi[$key] ?? null,
                    'saksi_pertama' => $request->saksi_pertama_ba_sumpah_saksi[$key] ?? null,
                    'saksi_kedua' => $request->saksi_kedua_ba_sumpah_saksi[$key] ?? null,
                ];
            }
        }

        $dataBaSumpahAhli = [];
        if ($request->has('ba_sumpah_nama_ahli')) {
            foreach ($request->ba_sumpah_nama_ahli as $key => $nama) {

                $dataBaSumpahAhli[] = [
                    'nama' => $nama,
                    'waktu_sumpah' => $request->waktu_sumpah_ahli[$key] ?? null,
                    'saksi_pertama' => $request->saksi_pertama_ba_sumpah_ahli[$key] ?? null,
                    'saksi_kedua' => $request->saksi_kedua_ba_sumpah_ahli[$key] ?? null,
                ];
            }
        }

        $dataGeledahTersangka = [];
        if ($request->has('penggeledahan_nama_tersangka')) {
            foreach ($request->penggeledahan_nama_tersangka as $key => $nama) {
                $pejabatGeledah = $request->input("pejabat_geledah.$key", []);

                $dataGeledahTersangka[] = [
                    'nama' => $nama,
                    'no_sppr' => $request->no_sppr_tersangka[$key] ?? null,
                    'tgl_sppr' => $request->tgl_sppr_tersangka[$key] ?? null,
                    'pejabat_geledah' => !empty($pejabatGeledah) ? json_encode($pejabatGeledah) : null,
                    'waktu_berlaku_penggeledahan' => $request->waktu_surat_penggeledahan_tersangka[$key] ?? null,
                    'pejabat_penerbit' => $request->pejabat_penerbit_surat_penggeledahan_tersangka[$key] ?? null,
                ];
            }
        }

        $dataBaGeledahTersangka = [];
        if ($request->has('ba_penggeledahan_nama_tersangka')) {
            foreach ($request->ba_penggeledahan_nama_tersangka as $key => $nama) {

                $dataBaGeledahTersangka[] = [
                    'nama' => $nama,
                    'waktu_geledah' => $request->waktu_ba_geledah[$key] ?? null,
                    'pejabat_penerbit_ba' => $request->pejabat_penerbit_surat_penggeledahan_tersangka_ba[$key] ?? null,
                    'izin_pengadilan' => $request->ba_penggeledahan_izin_pengadilan[$key] ?? null,
                    'izin_lainnya' => $request->ba_penggeledahan_izin_lain[$key] ?? null,
                    'isi_ba_geledah' => $request->diisi_ba_penggeledahan[$key] ?? null,
                    'isi_ba_geledah_identitas' => $request->diisi_identitas_ba_penggeledahan[$key] ?? null,
                    'saksi_pertama_nama' => $request->saksi1_geledah_nama[$key] ?? null,
                    'saksi_pertama_alamat' => $request->saksi1_geledah_alamat[$key] ?? null,
                    'saksi_pertama_pekerjaan' => $request->saksi1_geledah_pekerjaan[$key] ?? null,
                    'saksi_kedua_nama' => $request->saksi2_geledah_nama[$key] ?? null,
                    'saksi_kedua_alamat' => $request->saksi2_geledah_alamat[$key] ?? null,
                    'saksi_kedua_pekerjaan' => $request->saksi2_geledah_pekerjaan[$key] ?? null,
                    'uraian_penggeledahan' => $request->uraian_penggeledahan[$key] ?? null,
                ];
            }
        }

        $dataPenyitaanTersangka = [];
        if ($request->has('penyitaan_nama_tersangka')) {
            foreach ($request->penyitaan_nama_tersangka as $key => $nama) {
                $pejabatPenyitaan = $request->input("pejabat_penyitaan.$key", []);

                $dataPenyitaanTersangka[] = [
                    'nama' => $nama,
                    'no_spp' => $request->no_spp_tersangka[$key] ?? null,
                    'tgl_spp' => $request->tgl_spp_tersangka[$key] ?? null,
                    'pejabat_penyitaan' => !empty($pejabatPenyitaan) ? json_encode($pejabatPenyitaan) : null,
                    'jumlah_jenis_barang_sita' => $request->jumlah_jenis_barang_sita[$key] ?? null,
                    'waktu_berlaku_penyitaan' => $request->waktu_surat_penyitaan_tersangka[$key] ?? null,
                    'pejabat_penerbit' => $request->pejabat_penerbit_surat_penyitaan_tersangka[$key] ?? null,
                ];
            }
        }


        $dataBaPenyitaanTersangka = [];
        if ($request->has('ba_penyitaan_nama_tersangka')) {
            foreach ($request->ba_penyitaan_nama_tersangka as $key => $nama) {
                
                $dataBaPenyitaanTersangka[] = [
                    'nama' => $nama,
                    'waktu_penyitaan' => $request->waktu_ba_penyitaan[$key] ?? null,
                    'pejabat_penerbit_ba' => $request->pejabat_penerbit_surat_penyitaan_tersangka_ba[$key] ?? null,
                    'pejabat_saksi_pertama' => $request->pejabat_saksi_pertama[$key] ?? null,
                    'pejabat_saksi_kedua' => $request->pejabat_saksi_kedua[$key] ?? null,
                ];
            }
        }

        $dataPemotretanTersangka = [];
        if ($request->has('pemotretan_nama_tersangka')) {
            foreach ($request->pemotretan_nama_tersangka as $key => $nama) {
                $pejabatPemotretan = $request->input("pejabat_pemotretan.$key", []);

                $dataPemotretanTersangka[] = [
                    'nama' => $nama,
                    'no_sppp' => $request->no_sppp_tersangka[$key] ?? null,
                    'tgl_sppp' => $request->tgl_sppp_tersangka[$key] ?? null,
                    'pejabat_pemotretan' => !empty($pejabatPemotretan) ? json_encode($pejabatPemotretan) : null,
                    'rincian_data' => $request->rincian_data[$key] ?? null,
                    'waktu_berlaku_pemotretan' => $request->waktu_surat_pemotretan_tersangka[$key] ?? null,
                    'pejabat_penerbit' => $request->pejabat_penerbit_surat_pemotretan_tersangka[$key] ?? null,
                ];
            }
        }


        $dataBaPemotretanTersangka = [];
        if ($request->has('ba_pemotretan_nama_tersangka')) {
            foreach ($request->ba_pemotretan_nama_tersangka as $key => $nama) {

                $dataBaPemotretanTersangka[] = [
                    'nama' => $nama,
                    'waktu_potret' => $request->waktu_ba_potret[$key] ?? null,
                    'pejabat_pertama_ba' => $request->pejabat_pertama_surat_pemotretan_tersangka_ba[$key] ?? null,
                    'pejabat_kedua_ba' => $request->pejabat_kedua_surat_pemotretan_tersangka_ba[$key] ?? null,
                    'saksi_pertama_nama' => $request->saksi1_potret_nama[$key] ?? null,
                    'saksi_pertama_alamat' => $request->saksi1_potret_alamat[$key] ?? null,
                    'saksi_pertama_pekerjaan' => $request->saksi1_potret_pekerjaan[$key] ?? null,
                    'saksi_kedua_nama' => $request->saksi2_potret_nama[$key] ?? null,
                    'saksi_kedua_alamat' => $request->saksi2_potret_alamat[$key] ?? null,
                    'saksi_kedua_pekerjaan' => $request->saksi2_potret_pekerjaan[$key] ?? null,
                    'cara_pemotretan' => $request->diisi_cara_pemotretan[$key] ?? null,
                ];
            }
        }


        $dataSidikJariTersangka = [];
        if ($request->has('sidikjari_nama_tersangka')) {
            foreach ($request->sidikjari_nama_tersangka as $key => $nama) {
                $pejabatSidikJari = $request->input("pejabat_sidik.$key", []);

                $dataSidikJariTersangka[] = [
                    'nama' => $nama,
                    'no_sppsj' => $request->no_sppsj_tersangka[$key] ?? null,
                    'tgl_sppsj' => $request->tgl_sppsj_tersangka[$key] ?? null,
                    'pejabat_sidik' => !empty($pejabatSidikJari) ? json_encode($pejabatSidikJari) : null,
                    'waktu_berlaku_sidikjari' => $request->waktu_surat_sidikjari_tersangka[$key] ?? null,
                    'pejabat_penerbit' => $request->pejabat_penerbit_surat_sidikjari_tersangka[$key] ?? null,
                ];
            }
        }

        $dataBaSidikJariTersangka = [];
        if ($request->has('ba_sidikjari_nama_tersangka')) {
            foreach ($request->ba_sidikjari_nama_tersangka as $key => $nama) {

                $dataBaSidikJariTersangka[] = [
                    'nama' => $nama,
                    'waktu_sidik_jari' => $request->waktu_ba_sidik_jari[$key] ?? null,
                    'pejabat_pertama_ba' => $request->pejabat_pertama_surat_sidikjari_tersangka_ba[$key] ?? null,
                    'pejabat_kedua_ba' => $request->pejabat_kedua_surat_sidikjari_tersangka_ba[$key] ?? null,
                    'saksi_pertama_nama' => $request->saksi1_sidik_jari_nama[$key] ?? null,
                    'saksi_pertama_alamat' => $request->saksi1_sidik_jari_alamat[$key] ?? null,
                    'saksi_pertama_pekerjaan' => $request->saksi1_sidik_jari_pekerjaan[$key] ?? null,
                    'saksi_kedua_nama' => $request->saksi2_sidik_jari_nama[$key] ?? null,
                    'saksi_kedua_alamat' => $request->saksi2_sidik_jari_alamat[$key] ?? null,
                    'saksi_kedua_pekerjaan' => $request->saksi2_sidik_jari_pekerjaan[$key] ?? null,    
                ];
            }
        }


        $dataForensikDigitalTersangka = [];
        if ($request->has('forensik_nama_tersangka')) {
            foreach ($request->forensik_nama_tersangka as $key => $nama) {
                $pejabatForensik = $request->input("pejabat_forensik.$key", []);

                $dataForensikDigitalTersangka[] = [
                    'nama' => $nama,
                    'no_spfd' => $request->no_sppp_tersangka[$key] ?? null,
                    'tgl_spfd' => $request->tgl_sppp_tersangka[$key] ?? null,
                    'pejabat_forensik' => !empty($pejabatForensik) ? json_encode($pejabatForensik) : null,
                    'rincian_data_bukti' => $request->rincian_data_bukti[$key] ?? null,
                    'waktu_berlaku_forensik' => $request->waktu_surat_forensik_tersangka[$key] ?? null,
                    'pejabat_penerbit' => $request->pejabat_penerbit_surat_forensik_tersangka[$key] ?? null,
                ];
            }
        }

        $dataBaForensikDigitalTersangka = [];
        if ($request->has('ba_forensik_nama_tersangka')) {
            foreach ($request->ba_forensik_nama_tersangka as $key => $nama) {

                $dataBaForensikDigitalTersangka[] = [
                    'nama' => $nama,
                    'ba_perolehan' => $request->no_ba_perolehan[$key] ?? null,
                    'tgl_ba_perolehan' => $request->tgl_ba_perolehan[$key] ?? null,
                    'waktu_forensik' => $request->waktu_ba_forensik[$key] ?? null,
                    'nota_dinas' => $request->surat_nota_dinas[$key] ?? null,
                    'nama_forensik_digital' => $request->nama_forensik_digital[$key] ?? null,
                    'pejabat_meminta_ba' => $request->pejabat_meminta_surat_forensik_tersangka_ba[$key] ?? null,    
                ];
            }
        }

        $dataBaGelarPerkaraTersangka = [];
        if ($request->has('ba_gelar_perkara_nama_tersangka')) {
            foreach ($request->ba_gelar_perkara_nama_tersangka as $key => $nama) {
                $pejabatPerkara = $request->input("pejabat_gelar_perkara.$key", []);

                $dataBaGelarPerkaraTersangka[] = [
                    'nama' => $nama,
                    'waktu_gelar_perkara' => $request->waktu_ba_gelar_perkara[$key] ?? null,
                    'hasil_gelar_perkara' => $request->hasil_gelar_perkara[$key] ?? null,
                    'kesimpulan_gelar_perkara' => $request->kesimpulan_gelar_perkara[$key] ?? null,
                    'pejabat_perkara' => !empty($pejabatPerkara) ? json_encode($pejabatPerkara) : null,
                    'rencana_kegiatan_penyidikan' => $request->rencana_kegiatan_penyidikan[$key] ?? null,
                ];
            }
        }
        
        $dataSuratPenetapanTersangka = [];
        if ($request->has('penetapan_nama_tersangka')) {
            foreach ($request->penetapan_nama_tersangka as $key => $nama) {

                $dataSuratPenetapanTersangka[] = [
                    'nama' => $nama,
                    'no_staptsk' => $request->no_staptsk_tersangka[$key] ?? null,
                    'tgl_staptsk' => $request->tgl_staptsk_tersangka[$key] ?? null,
                    'pejabat_penerbit' => $request->pejabat_penerbit_surat_penetapan_tersangka[$key] ?? null,
                    'status_plh' => $request->status_plh[$key] ?? null,    
                ];
            }
        }

        $dataSuratPenangkapanTersangka = [];
        if ($request->has('penangkapan_nama_tersangka')) {
            foreach ($request->penangkapan_nama_tersangka as $key => $nama) {
                $pejabatPenangkapan = $request->input("pejabat_penangkapan.$key", []);

                $dataSuratPenangkapanTersangka[] = [
                    'nama' => $nama,
                    'no_spp_penangkapan' => $request->no_spp_penangkapan_tersangka[$key] ?? null,
                    'tgl_spp_penangkapan' => $request->tgl_spp_penangkapan_tersangka[$key] ?? null,
                    'pejabat_penerbit' => $request->pejabat_penerbit_surat_penangkapan_tersangka[$key] ?? null,
                    'pejabat_penangkapan' => !empty($pejabatPenangkapan) ? json_encode($pejabatPenangkapan) : null,
                    'status_plh_spp' => $request->status_plh_spp[$key] ?? null,    
                    'pejabat_penerima' => $request->pejabat_penerima_surat_penangkapan_tersangka[$key] ?? null,    
                    'pejabat_menyerahkan' => $request->pejabat_menyerahkan_surat_penangkapan_tersangka[$key] ?? null,    
                ];
            }
        }

        $requestData = $request->except([
            'no_sp1_saksi',
            'tgl_sp1_saksi',
            'saksi_nama',
            'saksi_ttl',
            'saksi_kelamin',
            'saksi_kewarganegaraan',
            'saksi_agama',
            'saksi_pekerjaan',
            'saksi_alamat',
            'no_sp2_saksi',
            'tgl_sp2_saksi',
            'pejabat_saksi_sp1',
            'pejabat_saksi_sp2',
            'status_surat_panggilan_1_saksi',
            'status_surat_panggilan_2_saksi',
            'tgl_panggilan_1_saksi',
            'tgl_panggilan_2_saksi',
            'no_spm_saksi',
            'tgl_spm_saksi',
            'pejabat_saksi_spm',
            'baw_bap_nama_saksi',
            'baw_saksi',
            'bap_saksi',
            'ba_sumpah_nama_saksi',
            'waktu_sumpah_saksi',
            'saksi_pertama_ba_sumpah_saksi',
            'saksi_kedua_ba_sumpah_saksi',

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
            'baw_bap_nama_tersangka',
            'baw_tersangka',
            'bap_tersangka',

            'ahli_nama',
            'ahli_ttl',
            'ahli_kelamin',
            'ahli_agama',
            'ahli_pekerjaan',
            'ahli_alamat_domisili',
            'ahli_alamat_kantor',
            'baw_bap_nama_ahli',
            'baw_ahli',
            'bap_ahli',
            'ba_sumpah_nama_ahli',
            'waktu_sumpah_ahli',
            'saksi_pertama_ba_sumpah_ahli',
            'saksi_kedua_ba_sumpah_ahli',
            
            'no_sppr_tersangka',
            'tgl_sppr_tersangka',
            'penggeledahan_nama_tersangka',
            'waktu_surat_penggeledahan_tersangka',
            'pejabat_geledah',
            'pejabat_penerbit_surat_penggeledahan_tersangka',
            'waktu_ba_geledah',
            'pejabat_penerbit_surat_penggeledahan_tersangka_ba',
            'ba_penggeledahan_izin_pengadilan',
            'ba_penggeledahan_izin_lain',
            'diisi_ba_penggeledahan',
            'diisi_identitas_ba_penggeledahan',
            'ba_penggeledahan_nama_tersangka',
            'saksi1_geledah_nama',
            'saksi1_geledah_alamat',
            'saksi1_geledah_pekerjaan',
            'saksi2_geledah_nama',
            'saksi2_geledah_alamat',
            'saksi2_geledah_pekerjaan',
            'uraian_penggeledahan',

            'no_spp_tersangka',
            'tgl_spp_tersangka',
            'pejabat_penyitaan',
            'penyitaan_nama_tersangka',
            'jumlah_jenis_barang_sita',
            'waktu_surat_penyitaan_tersangka',
            'pejabat_penerbit_surat_penyitaan_tersangka',

            'waktu_ba_penyitaan',
            'pejabat_penerbit_surat_penyitaan_tersangka_ba',
            'pejabat_saksi_pertama',
            'pejabat_saksi_kedua',
            'ba_penyitaan_nama_tersangka',

            'no_sppp_tersangka',
            'tgl_sppp_tersangka',
            'pemotretan_nama_tersangka',
            'rincian_data',
            'waktu_surat_pemotretan_tersangka',
            'pejabat_penerbit_surat_pemotretan_tersangka',

            'waktu_ba_potret',
            'pejabat_pertama_surat_penggeledahan_tersangka_ba',
            'pejabat_kedua_surat_penggeledahan_tersangka_ba',
            'ba_pemotretan_nama_tersangka',
            'saksi1_potret_nama',
            'saksi1_potret_alamat',
            'saksi1_potret_pekerjaan',
            'saksi2_potret_nama',
            'saksi2_potret_alamat',
            'diisi_cara_pemotretan',

            'no_sppsj_tersangka',
            'tgl_sppsj_tersangka',
            'sidikjari_nama_tersangka',
            'waktu_surat_sidikjari_tersangka',
            'pejabat_penerbit_surat_sidikjari_tersangka',

            
            'waktu_ba_sidik_jari',
            'pejabat_pertama_surat_sidikjari_tersangka_ba',
            'pejabat_kedua_surat_sidikjari_tersangka_ba',
            'ba_sidikjari_nama_tersangka',
            'saksi1_sidik_jari_nama',
            'saksi1_sidik_jari_alamat',
            'saksi1_sidik_jari_pekerjaan',
            'saksi2_sidik_jari_nama',
            'saksi2_sidik_jari_alamat',

            'no_spfd_tersangka',
            'tgl_spfd_tersangka',
            'forensik_nama_tersangka',
            'rincian_data_bukti',
            'waktu_surat_forensik_tersangka',
            'pejabat_penerbit_surat_forensik_tersangka',

            'no_ba_perolehan',
            'tgl_ba_perolehan',
            'ba_forensik_nama_tersangka',
            'surat_nota_dinas',
            'nama_forensik_digital',
            'pejabat_meminta_surat_forensik_tersangka_ba',

            'waktu_ba_gelar_perkara',
            'hasil_gelar_perkara',
            'ba_gelar_perkara_nama_tersangka',
            'kesimpulan_gelar_perkara',
            'rencana_kegiatan_penyidikan',
            'pejabat_gelar_perkara',

            'no_staptsk_tersangka',
            'tgl_staptsk_tersangka',
            'penetapan_nama_tersangka',
            'pejabat_penerbit_surat_penetapan_tersangka',
            'status_plh',

            'no_spp_penangkapan_tersangka',
            'tgl_spp_penangkapan_tersangka',
            'pejabat_penangkapan',
            'penangkapan_nama_tersangka',
            'pejabat_penerbit_surat_penangkapan_tersangka',
            'status_plh_spp',
            'pejabat_penerima_surat_penangkapan_tersangka',
            'pejabat_menyerahkan_surat_penangkapan_tersangka',
        ]);

        $requestData['data_saksi'] = json_encode($dataSaksi);
        $requestData['data_tersangka'] = json_encode($dataTersangka);
        $requestData['data_ahli'] = json_encode($dataAhli);

        $requestData['berkas_baw_bap_saksi'] = json_encode($berkasBawBapSaksi);
        $requestData['berkas_baw_bap_tersangka'] = json_encode($berkasBawBapTersangka);
        $requestData['berkas_baw_bap_ahli'] = json_encode($berkasBawBapAhli);

        $requestData['ba_sumpah_saksi'] = json_encode($dataBaSumpahSaksi);
        $requestData['ba_sumpah_ahli'] = json_encode($dataBaSumpahAhli);

        $requestData['penggeledahan_tersangka'] = json_encode($dataGeledahTersangka);
        $requestData['ba_penggeledahan_tersangka'] = json_encode($dataBaGeledahTersangka);

        $requestData['penyitaan_tersangka'] = json_encode($dataPenyitaanTersangka);
        $requestData['ba_penyitaan_tersangka'] = json_encode($dataBaPenyitaanTersangka);

        $requestData['pemotretan_tersangka'] = json_encode($dataPemotretanTersangka);
        $requestData['ba_pemotretan_tersangka'] = json_encode($dataBaPemotretanTersangka);

        $requestData['sidik_jari_tersangka'] = json_encode($dataSidikJariTersangka);
        $requestData['ba_sidik_jari_tersangka'] = json_encode($dataBaSidikJariTersangka);

        $requestData['forensik_digital_tersangka'] = json_encode($dataForensikDigitalTersangka);
        $requestData['ba_forensik_digital_tersangka'] = json_encode($dataBaForensikDigitalTersangka);

        $requestData['ba_gelar_perkara_tersangka'] = json_encode($dataBaGelarPerkaraTersangka);

        $requestData['penetapan_tersangka'] = json_encode($dataSuratPenetapanTersangka);

        $requestData['penangkapan_tersangka'] = json_encode($dataSuratPenangkapanTersangka);

        // Hapus baris dd() yang digunakan untuk debugging
        // dd($requestData);

        // Update data
        $item->update($requestData);

        DB::commit(); // Simpan transaksi

        return redirect()->route('unsur-pidana-penyidikan.index')
            ->with('success', 'Data berhasil diperbarui.');
    } catch (\Exception $e) {
        DB::rollBack();

        Log::error("Error saat memperbarui data: " . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
    }
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