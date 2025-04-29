<?php

namespace App\Http\Controllers\Pengawasanlain;

use App\Http\Controllers\Controller;
use App\Models\TblPemasukanAmunisiSenjataApi;
use Illuminate\Http\Request;
use App\Models\TblAturanLartas;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Illuminate\Support\Facades\Schema; // Tambahkan ini
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;

class PemasukanAmunisiSenjataApiController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_bast_senjata_api' => 'required|string',
            'kategori_bast' => 'required|string',
            'senjata_api' => 'nullable|string',
            'jenis_amunisi' => 'nullable|string',
            'kaliber_amunisi' => 'nullable|string',
            'jumlah_amunisi' => 'nullable|string',
        ]);

        $senjataamunisi = new TblPemasukanAmunisiSenjataApi();
        $senjataamunisi->id_bast_senjata_api = $validatedData['id_bast_senjata_api'];
        $senjataamunisi->kategori_bast = $validatedData['kategori_bast'];
        $senjataamunisi->senjata_api = $validatedData['senjata_api'] ?? null;
        $senjataamunisi->jenis_amunisi = $validatedData['jenis_amunisi'] ?? null;
        $senjataamunisi->kaliber_amunisi = $validatedData['kaliber_amunisi'] ?? null;
        $senjataamunisi->jumlah_amunisi = $validatedData['jumlah_amunisi'] ?? null;
        $senjataamunisi->save();

        $idBastSenjataApi = $validatedData['id_bast_senjata_api'];
        return redirect()->route('getBastData', ['id_bast_senjata_api' => $idBastSenjataApi]);

        return response()->json([
            'success' => true,
            'message' => 'Data Senjata berhasil disimpan!',
        ]);
    }

    public function getBastData(Request $request)
    {
        $validatedData = $request->validate([
            'id_bast_senjata_api' => 'required|string',
        ]);

        // Ambil id_bast_senjata_api dari request
        $idBastSenjataApi = $validatedData['id_bast_senjata_api'];

        $senjataamunisiData = TblPemasukanAmunisiSenjataApi::where('id_bast_senjata_api', $idBastSenjataApi)->get();

        return response()->json([
            'data' => $senjataamunisiData
        ]);
    }

    public function edit($id)
    {
        $senjataamunisi = TblPemasukanAmunisiSenjataApi::findOrFail($id);
        return response()->json($senjataamunisi);
    }

    public function update(Request $request, $id)
    {
        $senjataamunisi = TblPemasukanAmunisiSenjataApi::find($id);
        if (!$senjataamunisi) {
            return response()->json(['success' => false, 'message' => 'Senjata tidak ditemukan'], 404);
        }

        $senjataamunisi->update($request->all());

        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);
    }



    public function destroy($id)
    {
        $senjataamunisi = TblPemasukanAmunisiSenjataApi::findOrFail($id); // Cari barang berdasarkan ID

        $senjataamunisi->delete(); // Hapus barang

        return response()->json([
            'success' => true,
            'message' => 'Data Senjata berhasil dihapus!',
        ]);
    }
}
