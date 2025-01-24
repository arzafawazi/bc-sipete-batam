<?php

namespace App\Http\Controllers\Dokpenyidikan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Illuminate\Support\Facades\Schema; // Tambahkan ini
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;


class BarangController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_penyidikan' => 'required|string',
            'kategori_barang' => 'nullable|string',
            'kode_komoditi' => 'nullable|string',
            'jenis_barang' => 'nullable|string',
            'merk_pabean' => 'nullable|string',
            'tipe_pabean' => 'nullable|string',
            'ukuran_kapasitas' => 'nullable|string',
            'jumlah' => 'nullable|integer',
            'satuan' => 'nullable|string',
            'negara_asal' => 'nullable|string',
            'kondisi_pabean' => 'nullable|string',
            'merk_cukai' => 'nullable|string',
            'tipe_cukai' => 'nullable|string',
            'kadar_cukai' => 'nullable|string',
            'subyek_cukai' => 'nullable|string',
            'tahun' => 'nullable|string',
            'gol' => 'nullable|string',
            'vol' => 'nullable|string',
            'kondisi_cukai' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'kategori_lartas' => 'nullable|string',
        ]);

        $barang = new Barang();
        $barang->id_penyidikan = $validatedData['id_penyidikan'];
        $barang->kategori_barang = $validatedData['kategori_barang'] ?? null;
        $barang->kode_komoditi = $validatedData['kode_komoditi'] ?? null;
        $barang->jenis_barang = $validatedData['jenis_barang'] ?? null;
        $barang->merk_pabean = $validatedData['merk_pabean'] ?? null;
        $barang->tipe_pabean = $validatedData['tipe_pabean'] ?? null;
        $barang->ukuran_kapasitas = $validatedData['ukuran_kapasitas'] ?? null;
        $barang->jumlah = $validatedData['jumlah'] ?? null;
        $barang->satuan = $validatedData['satuan'] ?? null;
        $barang->negara_asal = $validatedData['negara_asal'] ?? null;
        $barang->kondisi_pabean = $validatedData['kondisi_pabean'] ?? null;
        $barang->merk_cukai = $validatedData['merk_cukai'] ?? null;
        $barang->tipe_cukai = $validatedData['tipe_cukai'] ?? null;
        $barang->kadar_cukai = $validatedData['kadar_cukai'] ?? null;
        $barang->subyek_cukai = $validatedData['subyek_cukai'] ?? null;
        $barang->tahun = $validatedData['tahun'] ?? null;
        $barang->gol = $validatedData['gol'] ?? null;
        $barang->vol = $validatedData['vol'] ?? null;
        $barang->kondisi_cukai = $validatedData['kondisi_cukai'] ?? null;
        $barang->keterangan = $validatedData['keterangan'] ?? null;
        $barang->kategori_lartas = $validatedData['kategori_lartas'] ?? null;
        $barang->save();

        $idPenyidikan = $validatedData['id_penyidikan'];
        return redirect()->route('getBarangData', ['id_penyidikan' => $idPenyidikan]);

        return response()->json([
            'success' => true,
            'message' => 'Data Barang Cacah berhasil disimpan!',
        ]);
    }


    public function getBarangData(Request $request)
    {
        $validatedData = $request->validate([
            'id_penyidikan' => 'required|string',
        ]);

        // Ambil id_penyidikan dari request
        $idPenyidikan = $validatedData['id_penyidikan'];

        // Cari data barang berdasarkan id_penyidikan
        $barangData = Barang::where('id_penyidikan', $idPenyidikan)->get();

        // Kembalikan data barang dalam format JSON
        return response()->json([
            'data' => $barangData
        ]);
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json($barang);
    }

    public function update(Request $request, $id)
    {
        try {
            $barang = Barang::findOrFail($id);
            $barang->update($request->all());
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id); // Cari barang berdasarkan ID

        $barang->delete(); // Hapus barang

        return response()->json([
            'success' => true,
            'message' => 'Data Barang berhasil dihapus!',
        ]);
    }
}