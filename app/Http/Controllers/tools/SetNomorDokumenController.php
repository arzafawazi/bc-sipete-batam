<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TblNoRef;    

class SetNomorDokumenController extends Controller
{
    public function index()
    {
        $no_ref = TblNoRef::first();
        return view('tools.setNomorDokumen.index', compact('no_ref'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'no_sbp' => 'nullable|string|max:100',
            'no_sbp_npp' => 'nullable|string|max:100',
            'no_ba_segel' => 'nullable|string|max:100',
            'no_ba_segel_npp' => 'nullable|string|max:100',
            'no_ba_serah' => 'nullable|string|max:100',
            'no_ba_serah_npp' => 'nullable|string|max:100',
            'no_ba_musnah' => 'nullable|string|max:100',
            'no_ba_musnah_npp' => 'nullable|string|max:100',
            'no_ba_tegah' => 'nullable|string|max:100',
            'no_ba_tegah_npp' => 'nullable|string|max:100',
            'no_ba_buka_segel' => 'nullable|string|max:100',
            'no_lptp' => 'nullable|string|max:100',
            'no_lptp_npp' => 'nullable|string|max:100',
            'no_lpp' => 'nullable|string|max:100',
            'no_lpp_npp' => 'nullable|string|max:100',
            'no_sp_cacah' => 'nullable|string|max:100',
            'no_ba_cacah' => 'nullable|string|max:100',
            'no_pelekatan' => 'nullable|string|max:100',
            'no_pelepasan' => 'nullable|string|max:100',
            'no_bapp' => 'nullable|string|max:100',
            'no_ppbs' => 'nullable|string|max:100',
            'no_menu' => 'nullable|string|max:100',
            'no_bapbc' => 'nullable|string|max:100',
            'no_patroli' => 'nullable|string|max:100',
            'no_bcl12' => 'nullable|string|max:100',
            'no_ba_riksa' => 'nullable|string|max:100',

        ]);

        try {
            // Lakukan update pada data dengan ID yang sesuai
            $noRef = TblNoRef::findOrFail($id);
            $noRef->update($validatedData);

            // Redirect dengan pesan sukses jika update berhasil
            return redirect()->route('tools.setNomorDokumen.index')->with('success', 'Nomor Dokumen berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->route('tools.setNomorDokumen.index')->with('error', 'Terjadi kesalahan saat memperbarui Nomor Dokumen');
        }
    }
}
