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


class PenindakanController extends Controller
{
    public function index()
    {
        $penindakans = TblSbp::all();
        $laporanInformasi = TblLaporanInformasi::select('no_print', 'tanggal_mulai_print', 'no_li', 'tgl_li')->get();
        return view('Dokpenindakan.DaftarSbp.index', compact('laporanInformasi','penindakans'));
    }


    public function create(Request $request)
{
    // Ambil nomor laporan dari parameter query
    $nomor_laporan = $request->query('nomor_laporan');
    
    // Cari laporan berdasarkan nomor_laporan
    $laporan = TblLaporanInformasi::where('no_print', $nomor_laporan)->first();  // Pastikan ini mengembalikan data yang benar
    
    // Ambil data lain yang diperlukan untuk form
    $users = User::all();
    $segels = TblSegel::all();
    $kemasans = TblKemasan::all();
    $no_ref = TblNoRef::first();
    $jenisPelanggaran = TblJenisPelanggaran::all();

    // Kirim data ke view
    return view('Dokpenindakan.DaftarSbp.rekam', compact('users', 'segels', 'kemasans', 'jenisPelanggaran', 'no_ref', 'laporan', 'nomor_laporan'));
}

public function store(Request $request){
    // Ambil data dari form
    TblSbp::create($request->all());

    return redirect()->route('DaftarSbp.index')->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');

}

public function destroy($id){
    $penindakan = TblSbp::find($id);
    if ($penindakan) {
        $penindakan->delete();
        return redirect()->route('DaftarSbp.index')->with('success', 'Data berhasil dihapus.');
    }
    return redirect()->route('DaftarSbp.index')->with('error', 'Data tidak ditemukan.');
}

    

    public function getNomorSegel($id)
    {
        $segel = TblSegel::find($id);
        return response()->json(['nomor_segel' => $segel->nomor_segel ?? '']);
    }


    public function print($id)
{
    // Ambil data laporan dengan relasi dinamis
    $penindakan = TblSbp::findOrFail($id);

    // Konversi model menjadi array associative
    $data = $penindakan->toArray();

    // Daftar kolom pejabat yang perlu diambil datanya
    $pejabatKeys = [
        'id_petugas_1_sbp',
        'id_petugas_2_sbp',
    ];

    // Loop untuk mendapatkan data pejabat secara dinamis
    foreach ($pejabatKeys as $key) {
        if ($penindakan->$key) {
            // Ambil data relasi pejabat sesuai key
            $pejabat = $penindakan->getPejabat($key)->first();

            
    
            // Jika data pejabat ditemukan, masukkan ke array data
            if ($pejabat) {
                $data[$key . '_nama'] = $pejabat->nama_admin;
                $data[$key . '_pangkat'] = $pejabat->pangkat;
                $data[$key . '_jabatan'] = $pejabat->jabatan;
                $data[$key . '_nip'] = $pejabat->nip;
            } else {
                // Jika pejabat tidak ditemukan, kosongkan data
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






     

    // Tambahkan tahun sekarang ke dalam array data
    $data['tahun_sekarang'] = date('Y');  // Mendapatkan tahun saat ini

    // Format tanggal jika ada dalam array
    $data = $this->formatDates($data);

    // Convert all null values to empty string
    $data = array_map(function ($value) {
        return is_null($value) ? '' : $value;
    }, $data);

    // Load template .docx
    $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/template-penindakan.docx'));

    // Replace placeholder dengan data dari array
    $templateProcessor->setValues($data);

    // Tentukan nama file yang akan diunduh
    // $fileName = 'Laporan_' . $penindakan->nama_laporan . '.docx';
    $fileName = 'Dokumen_Surat_Bukti_Penindakan' . $penindakan->no_sbp . '.docx';

    // Simpan file sementara
    $filePath = storage_path('app/public/' . $fileName);
    $templateProcessor->saveAs($filePath);

    // Unduh file setelah selesai
    return response()->download($filePath)->deleteFileAfterSend(true);
}

// Fungsi untuk format tanggal
private function formatDates($data)
{
    foreach ($data as $key => $value) {
        // Cek apakah data berupa string dengan format tanggal (yyyy-mm-dd)
        if ($this->isValidDate($value)) {
            // Format ulang tanggal
            $date = \DateTime::createFromFormat('Y-m-d', $value);  // Gunakan \DateTime untuk mengakses kelas PHP built-in
            $data[$key] = $date->format('d F Y');  // Mengubah ke format 'dd MMMM yyyy'
        }
    }
    return $data;
}


// Fungsi untuk cek apakah string adalah tanggal valid dengan format yyyy-mm-dd
private function isValidDate($date)
{
    // Gunakan \DateTime untuk memastikan merujuk ke kelas PHP built-in
    $d = \DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

}