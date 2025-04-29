<?php

namespace App\Http\Controllers\Pengawasanlain;

use App\Http\Controllers\Controller;
use App\Models\TblKemasanBaBongkar;
use Illuminate\Http\Request;
use App\Models\TblAturanLartas;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Illuminate\Support\Facades\Schema; // Tambahkan ini
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;

class KemasanBaBongkarController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_ba_bongkar' => 'required|string',
            'jenis_kemasan' => 'nullable|string',
            'jumlah_kemasan' => 'nullable|string',
            'dilaporkan' => 'nullable|string',
            'dibongkar' => 'nullable|string',
            'selisih' => 'nullable|string',
            'keterangan' => 'nullable|string',
            ]);

        $kemasan = new TblKemasanBaBongkar();
        $kemasan->id_ba_bongkar = $validatedData['id_ba_bongkar'];
        $kemasan->jenis_kemasan = $validatedData['jenis_kemasan'] ?? null;
        $kemasan->jumlah_kemasan = $validatedData['jumlah_kemasan'] ?? null;
        $kemasan->dilaporkan = $validatedData['dilaporkan'] ?? null;
        $kemasan->dibongkar = $validatedData['dibongkar'] ?? null;
        $kemasan->selisih = $validatedData['selisih'] ?? null;
        $kemasan->keterangan = $validatedData['keterangan'] ?? null;
        $kemasan->save();

        $idBaBongkar = $validatedData['id_ba_bongkar'];
        return redirect()->route('getKemasanData', ['id_ba_bongkar' => $idBaBongkar]);

        return response()->json([
            'success' => true,
            'message' => 'Data Kemasan berhasil disimpan!',
        ]);
    }


    public function getKemasanData(Request $request)
    {
        $validatedData = $request->validate([
            'id_ba_bongkar' => 'required|string',
        ]);

        // Ambil id_ba_bongkar dari request
        $idBaBongkar = $validatedData['id_ba_bongkar'];

        $kemasanData = TblKemasanBaBongkar::where('id_ba_bongkar', $idBaBongkar)->get();

        return response()->json([
            'data' => $kemasanData
        ]);
    }

    public function edit($id)
    {
        $kemasan = TblKemasanBaBongkar::findOrFail($id);
        return response()->json($kemasan);
    }

    public function update(Request $request, $id)
    {
        $kemasan = TblKemasanBaBongkar::find($id);
        if (!$kemasan) {
            return response()->json(['success' => false, 'message' => 'Kemasan tidak ditemukan'], 404);
        }

        $kemasan->update($request->all());

        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);
    }



    public function destroy($id)
    {
        $kemasan = TblKemasanBaBongkar::findOrFail($id); // Cari barang berdasarkan ID

        $kemasan->delete(); // Hapus barang

        return response()->json([
            'success' => true,
            'message' => 'Data Barang berhasil dihapus!',
        ]);
    }
}
