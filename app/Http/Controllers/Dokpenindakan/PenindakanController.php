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

class PenindakanController extends Controller
{
    public function index()
    {
        $laporanInformasi = TblLaporanInformasi::select('no_li', 'tgl_li')->get();
        return view('Dokpenindakan.DaftarSbp.index', compact('laporanInformasi'));
    }


    public function create(Request $request)
{
    // Ambil nomor laporan dari parameter query
    $nomor_laporan = $request->query('nomor_laporan');
    
    // Cari laporan berdasarkan nomor_laporan
    $laporan = TblLaporanInformasi::where('no_li', $nomor_laporan)->first();  // Pastikan ini mengembalikan data yang benar
    
    // Ambil data lain yang diperlukan untuk form
    $users = User::all();
    $segels = TblSegel::all();
    $kemasans = TblKemasan::all();
    $no_ref = TblNoRef::first();
    $jenisPelanggaran = TblJenisPelanggaran::all();

    // Kirim data ke view
    return view('Dokpenindakan.DaftarSbp.rekam', compact('users', 'segels', 'kemasans', 'jenisPelanggaran', 'no_ref', 'laporan', 'nomor_laporan'));
}

    

    public function getNomorSegel($id)
    {
        $segel = TblSegel::find($id);
        return response()->json(['nomor_segel' => $segel->nomor_segel ?? '']);
    }

}
