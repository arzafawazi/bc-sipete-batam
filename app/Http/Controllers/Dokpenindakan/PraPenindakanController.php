<?php

namespace App\Http\Controllers\Dokpenindakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TblNoRef;
use App\Models\TblLaporanInformasi;
use App\Models\TblSbp;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PraPenindakanController extends Controller
{
    public function index()
    {
        $praPenindakans = TblLaporanInformasi::all();
        // dd($praPenindakans);
        return view('Dokpenindakan.pra-penindakan.index', compact('praPenindakans'));
    }


    public function create()    
    {
        $users = User::all();
        $no_ref = TblNoRef::first();
        return view('Dokpenindakan.pra-penindakan.create', compact('users','no_ref'));
    }

    public function store(Request $request)
{
    TblLaporanInformasi::create($request->all());

    
    $no_ref = TblNoRef::first();
    $no_ref->no_li += 1;  
    $no_ref->no_urut_lap += 1;  
    $no_ref->no_npi += 1;  
    $no_ref->no_print += 1;  
    $no_ref->save();  
    
    return redirect()->route('pra-penindakan.index')->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');
}

public function edit($id)
{
   
    $praPenindakan = TblLaporanInformasi::findOrFail($id);
    $no_ref = TblNoRef::first();
    $users = User::all();
    return view('Dokpenindakan.pra-penindakan.edit', compact('praPenindakan','no_ref','users'));
}

public function update($id)
{
    // Mengambil data dari input form
    $data = request()->all();

    // Mencari data berdasarkan ID dan melakukan update
    $item = TblLaporanInformasi::find($id);
    if ($item) {
        $item->update($data);
        return redirect()->route('pra-penindakan.index')->with('success', 'Data berhasil diperbarui.');
    }

    return redirect()->route('pra-penindakan.index')->with('error', 'Data tidak ditemukan.');
}

public function destroy($id){
    $praPenindakan = TblLaporanInformasi::find($id);
    if ($praPenindakan) {
        $praPenindakan->delete();
        return redirect()->route('pra-penindakan.index')->with('success', 'Data berhasil dihapus.');
    }
    return redirect()->route('pra-penindakan.index')->with('error', 'Data tidak ditemukan.');
}




public function print($id)
{
    // Ambil data laporan dengan relasi dinamis
    $praPenindakan = TblLaporanInformasi::findOrFail($id);

    // Konversi model menjadi array associative
    $data = $praPenindakan->toArray();

    // Daftar kolom pejabat yang perlu diambil datanya
    $pejabatKeys = [
        'id_pejabat_li_1',
        'id_pejabat_li_2',
        'id_pejabat_li_3',
        'id_pejabat_lap_1',
        'id_pejabat_lap_2',
        'id_pejabat_lap_3',
        'id_pejabat_npi',
        'id_pejabat_sp_1',
        'id_pejabat_sp_2',
    ];

    // Loop untuk mendapatkan data pejabat secara dinamis
    foreach ($pejabatKeys as $key) {
        if ($praPenindakan->$key) {
            // Ambil data relasi pejabat sesuai key
            $pejabat = $praPenindakan->pejabat($key)->first();

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

    // Tambahkan tahun sekarang ke dalam array data
    $data['tahun_sekarang'] = date('Y');  // Mendapatkan tahun saat ini

    // Format tanggal jika ada dalam array
    $data = $this->formatDates($data);

    // Convert all null values to empty string
    $data = array_map(function ($value) {
        return is_null($value) ? '' : $value;
    }, $data);

    // Load template .docx
    $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/template-pra-penindakan.docx'));

    // Replace placeholder dengan data dari array
    $templateProcessor->setValues($data);

    // Tentukan nama file yang akan diunduh
    $fileName = 'Laporan_Informasi_Nomor_' . $praPenindakan->no_li . '.docx';

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
