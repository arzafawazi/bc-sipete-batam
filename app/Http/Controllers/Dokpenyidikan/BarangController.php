<?php

namespace App\Http\Controllers\Dokpenyidikan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\TblAturanLartas;
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
            'jumlah' => 'nullable|integer',
            'satuan' => 'nullable|string',
            'negara_asal' => 'nullable|string',
            'kondisi_pabean' => 'nullable|string',
            'merk_cukai' => 'nullable|string',
            'tipe_cukai' => 'nullable|string',
            'pita_cukai' => 'nullable|string',
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
        $barang->jumlah = $validatedData['jumlah'] ?? null;
        $barang->satuan = $validatedData['satuan'] ?? null;
        $barang->negara_asal = $validatedData['negara_asal'] ?? null;
        $barang->kondisi_pabean = $validatedData['kondisi_pabean'] ?? null;
        $barang->merk_cukai = $validatedData['merk_cukai'] ?? null;
        $barang->tipe_cukai = $validatedData['tipe_cukai'] ?? null;
        $barang->pita_cukai = $validatedData['pita_cukai'] ?? null;
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

        $barangData = Barang::where('id_penyidikan', $idPenyidikan)->get();

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
        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan'], 404);
        }

        $barang->update($request->all());

        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);
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