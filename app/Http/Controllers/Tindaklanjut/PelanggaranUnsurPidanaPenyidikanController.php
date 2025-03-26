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
            'berkasBawBapAhli'
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
        ]);

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

        // Proses data tersangka
        $dataTersangka = [];
        if ($request->has('tersangka_nama')) {
            foreach ($request->tersangka_nama as $key => $nama) {
                // Ambil data pejabat_spm jika ada dan pastikan dalam format array
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
        ]);

        $requestData['data_saksi'] = json_encode($dataSaksi);
        $requestData['data_tersangka'] = json_encode($dataTersangka);
        $requestData['data_ahli'] = json_encode($dataAhli);
        $requestData['berkas_baw_bap_saksi'] = json_encode($berkasBawBapSaksi);
        $requestData['berkas_baw_bap_tersangka'] = json_encode($berkasBawBapTersangka);
        $requestData['berkas_baw_bap_ahli'] = json_encode($berkasBawBapAhli);

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