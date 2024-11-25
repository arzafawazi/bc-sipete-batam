<?php

namespace App\Http\Controllers\Dokintelijen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TblNoRef;
use App\Models\TblLaporanPengawasan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LaporanPengawasanControllers extends Controller
{
    public function index()
    {
        $laporanpengawasan = TblLaporanPengawasan::all();

        foreach ($laporanpengawasan as $laporan) {
            $laporan->status_lpt = empty($laporan->pegawai_pembuat_lpt)
                ? 'LPT-1 belum diisi'
                : 'LPT-1 lengkap';

            $laporan->status_lppi = empty($laporan->pejabat_lppi)
                ? 'LPP-I belum diisi'
                : 'LPP-I lengkap';

            $laporan->status_lkai = empty($laporan->hasil_analisis_diterima_tanggal_2_lkai)
                ? 'LKA-I belum diisi'
                : 'LKA-I lengkap';
        }

        return view('Dokintelijen.laporan-pengawasan.index', compact('laporanpengawasan'));
    }

    public function create()
    {
        $users = User::all();
        $no_ref = TblNoRef::first();
        return view('Dokintelijen.laporan-pengawasan.create', compact('users', 'no_ref'));
    }


    public function store(Request $request)
    {   
        $request->validate([
            'dokumentasi_foto_lpt.*' => 'nullable|mimes:jpg,jpeg,png|max:1706',
            'dokumentasi_audio_lpt' => 'nullable|string',
            'dokumentasi_video_lpt' => 'nullable|string',
        ]);
    
        try {
            $data = $request->all();
    
            if ($request->hasFile('dokumentasi_foto_lpt')) {
                $fotoPaths = [];
                foreach ($request->file('dokumentasi_foto_lpt') as $foto) {
                    $fotoPath = $foto->store('dokumen/foto', 'public');
                    $fotoPaths[] = $fotoPath;
                }
                $data['dokumentasi_foto_lpt'] = json_encode($fotoPaths);
            } else {
                $data['dokumentasi_foto_lpt'] = json_encode([]);
            }
    
            if ($request->has('dokumentasi_audio_lpt')) {
                $audioLinks = $request->input('dokumentasi_audio_lpt');
                
                if (is_string($audioLinks)) {
                    $audioLinks = array_filter(array_map('trim', explode(',', $audioLinks)));
                }
    
                if (is_array($audioLinks)) {
                    $audioLinks = array_map('trim', $audioLinks);
                    $audioLinks = array_filter($audioLinks);
                }
                
                $data['dokumentasi_audio_lpt'] = json_encode(array_values($audioLinks ?: []));
            } else {
                $data['dokumentasi_audio_lpt'] = json_encode([]);
            }
    
            if ($request->has('dokumentasi_video_lpt')) {
                $videoLinks = $request->input('dokumentasi_video_lpt');
                
                if (is_string($videoLinks)) {
                    $videoLinks = array_filter(array_map('trim', explode(',', $videoLinks)));
                }
    
                if (is_array($videoLinks)) {
                    $videoLinks = array_map('trim', $videoLinks);
                    $videoLinks = array_filter($videoLinks);
                }
                
                $data['dokumentasi_video_lpt'] = json_encode(array_values($videoLinks ?: []));
            } else {
                $data['dokumentasi_video_lpt'] = json_encode([]);
            }
    
            $data['tim_operasi_st'] = json_encode($request->input('tim_operasi_st', []));
            $data['tim_dukungan_operasi_st'] = json_encode($request->input('tim_dukungan_operasi_st', []));
    
            \Log::info('Saving data:', [
                'video' => $data['dokumentasi_video_lpt'],
                'audio' => $data['dokumentasi_audio_lpt']
            ]);

            $no_ref = TblNoRef::first();
            $no_ref->no_st += 1;  
            $no_ref->no_lpt += 1;  
            $no_ref->no_lppi += 1;  
            $no_ref->no_lkai += 1;  
            $no_ref->save();
    
            $laporanPengawasan = TblLaporanPengawasan::create($data);
    
            return redirect()
                ->route('laporan-pengawasan.index')
                ->with('success', 'Data berhasil disimpan.');
    
        } catch (\Exception $e) {
            \Log::error('Error saving laporan pengawasan: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    



    public function destroy($id)
    {
        $pengawasan = TblLaporanPengawasan::find($id);

        if ($pengawasan) {

            $fotoPaths = json_decode($pengawasan->dokumentasi_foto_lpt, true);
            if ($fotoPaths && is_array($fotoPaths)) {
                foreach ($fotoPaths as $fotoPath) {
                    $cleanPhotoPath = 'dokumen/foto/' . basename($fotoPath);
                    if (Storage::disk('public')->exists($cleanPhotoPath)) {
                        Storage::disk('public')->delete($cleanPhotoPath);
                    }
                }
            }

            if ($pengawasan->dokumentasi_audio_lpt) {
                $cleanAudioPath = 'dokumen/audio/' . basename($pengawasan->dokumentasi_audio_lpt);
                if (Storage::disk('public')->exists($cleanAudioPath)) {
                    Storage::disk('public')->delete($cleanAudioPath);
                }
            }

            if ($pengawasan->dokumentasi_video_lpt) {
                $cleanVideoPath = 'dokumen/video/' . basename($pengawasan->dokumentasi_video_lpt);
                if (Storage::disk('public')->exists($cleanVideoPath)) {
                    Storage::disk('public')->delete($cleanVideoPath);
                }
            }

            $pengawasan->delete();

            return redirect()
                ->route('laporan-pengawasan.index')
                ->with('success', 'Data Laporan Pengawasan beserta file dokumentasinya berhasil dihapus.');
        }

        return redirect()
            ->route('laporan-pengawasan.index')
            ->with('error', 'Data tidak ditemukan.');
    }


    public function edit($id)
    {

        $pengawasan = TblLaporanPengawasan::findOrFail($id);
        $users = User::all();
        $no_ref = TblNoRef::first();
        return view('Dokintelijen.laporan-pengawasan.edit', compact('pengawasan', 'users', 'no_ref'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'dokumentasi_foto_lpt.*' => 'nullable|mimes:jpg,jpeg,png|max:1706',
            'dokumentasi_audio_lpt' => 'nullable|string',
            'dokumentasi_video_lpt' => 'nullable|string',
        ]);
    
        try {
            $pengawasan = TblLaporanPengawasan::findOrFail($id);
            $data = $request->all();
    
            if ($request->hasFile('dokumentasi_foto_lpt')) {
                $fotoPaths = [];
                $oldFotos = json_decode($pengawasan->dokumentasi_foto_lpt, true);
                if ($oldFotos && is_array($oldFotos)) {
                    foreach ($oldFotos as $oldFoto) {
                        $cleanPath = 'dokumen/foto/' . basename($oldFoto);
                        if (Storage::disk('public')->exists($cleanPath)) {
                            Storage::disk('public')->delete($cleanPath);
                        }
                    }
                }
                foreach ($request->file('dokumentasi_foto_lpt') as $foto) {
                    $fotoPath = $foto->store('dokumen/foto', 'public');
                    $fotoPaths[] = $fotoPath;
                }
                $data['dokumentasi_foto_lpt'] = json_encode($fotoPaths);
            }
    
            if ($request->has('dokumentasi_audio_lpt')) {
                $audioLinks = $request->input('dokumentasi_audio_lpt');
                
                if (is_string($audioLinks)) {
                    $audioLinks = array_filter(array_map('trim', explode(',', $audioLinks)));
                }
    
                if (is_array($audioLinks)) {
                    $audioLinks = array_map('trim', $audioLinks);
                    $audioLinks = array_filter($audioLinks);
                }
                
                $data['dokumentasi_audio_lpt'] = json_encode(array_values($audioLinks ?: []));
            } else {
                $data['dokumentasi_audio_lpt'] = json_encode([]);
            }
    
            if ($request->has('dokumentasi_video_lpt')) {
                $videoLinks = $request->input('dokumentasi_video_lpt');
                
                if (is_string($videoLinks)) {
                    $videoLinks = array_filter(array_map('trim', explode(',', $videoLinks)));
                }
    
                if (is_array($videoLinks)) {
                    $videoLinks = array_map('trim', $videoLinks);
                    $videoLinks = array_filter($videoLinks);
                }
                
                $data['dokumentasi_video_lpt'] = json_encode(array_values($videoLinks ?: []));
            } else {
                $data['dokumentasi_video_lpt'] = json_encode([]);
            }
    
            $data['tim_operasi_st'] = json_encode($request->input('tim_operasi_st', []));
            $data['tim_dukungan_operasi_st'] = json_encode($request->input('tim_dukungan_operasi_st', []));
    
            \Log::info('Updating data:', [
                'video' => $data['dokumentasi_video_lpt'],
                'audio' => $data['dokumentasi_audio_lpt']
            ]);
    
            $pengawasan->update($data);
    
            return redirect()
                ->route('laporan-pengawasan.index')
                ->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            \Log::error('Error updating laporan pengawasan: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
    
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
    
}