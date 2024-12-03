<?php

namespace App\Http\Controllers\Dokintelijen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TblNoRef;
use App\Models\TblNegara;
use App\Models\TblLaporanPengawasan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

class LaporanPengawasanControllers extends Controller
{
    public function index()
    {
        $laporanpengawasan = TblLaporanPengawasan::all();

        foreach ($laporanpengawasan as $laporan) {
            $laporan->status_lpt = empty($laporan->pegawai_pembuat_lpt) ? 'LPT-1 belum diisi' : 'LPT-1 lengkap';

            $laporan->status_lppi = empty($laporan->pejabat_lppi) ? 'LPP-I belum diisi' : 'LPP-I lengkap';

            $laporan->status_lkai = empty($laporan->hasil_analisis_diterima_tanggal_2_lkai) ? 'LKA-I belum diisi' : 'LKA-I lengkap';
        }

        return view('Dokintelijen.laporan-pengawasan.index', compact('laporanpengawasan'));
    }

    public function create()
    {
        $users = User::all();
        $no_ref = TblNoRef::first();
        $nama_negara = TblNegara::all()->groupBy('benua');
        return view('Dokintelijen.laporan-pengawasan.create', compact('users', 'no_ref', 'nama_negara'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokumentasi_foto_lpt.*' => 'nullable|mimes:jpg,jpeg,png|max:1706',
            'dokumentasi_audio_lpt' => 'nullable|string',
            'dokumentasi_video_lpt' => 'nullable|string',
            'tipe_nhi' => 'nullable|in:NHI,NHI-HKI',
        ]);

        try {
            \Log::info('Request data received:', $request->all());

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

            $data['dokumentasi_audio_lpt'] = json_encode($request->input('dokumentasi_audio_lpt') ? array_filter(array_map('trim', explode(',', $request->input('dokumentasi_audio_lpt')))) : []);

            $data['dokumentasi_video_lpt'] = json_encode($request->input('dokumentasi_video_lpt') ? array_filter(array_map('trim', explode(',', $request->input('dokumentasi_video_lpt')))) : []);

            $data['tim_operasi_st'] = json_encode($request->input('tim_operasi_st', []));
            $data['tim_dukungan_operasi_st'] = json_encode($request->input('tim_dukungan_operasi_st', []));

            $ikhtisarData = [];
            $ikhtisarArray = $request->input('ikhtisar', []);
            $sumberArray = $request->input('sumber', []);
            $validitasArray = $request->input('validitas', []);

            foreach ($ikhtisarArray as $index => $ikhtisar) {
                $ikhtisarData[] = [
                    'ikhtisar' => $ikhtisar,
                    'sumber' => $sumberArray[$index] ?? null,
                    'validitas' => $validitasArray[$index] ?? null,
                ];
            }

            $data['ikhtisar'] = json_encode($ikhtisarData);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengonversi data ikhtisar ke format JSON');
            }

            $no_ref = TblNoRef::first();
            if ($request->input('tipe_nhi') === 'NHI') {
                $no_ref->no_nhi += 1;
            } elseif ($request->input('tipe_nhi') === 'NHI-HKI') {
                $no_ref->no_nhi_hki += 1;
            }

            $no_ref->no_st += 1;
            $no_ref->no_lpt += 1;
            $no_ref->no_lppi += 1;
            $no_ref->no_lkai += 1;
            $no_ref->no_ni += 1;
            $no_ref->save();

            // Create the record
            TblLaporanPengawasan::create($data);

            \Log::info('Data successfully saved.');

            return redirect()->route('laporan-pengawasan.index')->with('success', 'Data berhasil disimpan.');
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

            return redirect()->route('laporan-pengawasan.index')->with('success', 'Data Laporan Pengawasan beserta file dokumentasinya berhasil dihapus.');
        }

        return redirect()->route('laporan-pengawasan.index')->with('error', 'Data tidak ditemukan.');
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

            if ($request->has('melaksanakan_tugas_st')) {
                $data['melaksanakan_tugas_st'] = $request->input('melaksanakan_tugas_st');
            } else {
                $data['melaksanakan_tugas_st'] = null;
            }

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

            \Log::info('melaksanakan_tugas_st value:', ['value' => $request->input('melaksanakan_tugas_st')]);


            \Log::info('Updating data:', [
                'melaksanakan_tugas_st' => $data['melaksanakan_tugas_st'],
                'video' => $data['dokumentasi_video_lpt'],
                'audio' => $data['dokumentasi_audio_lpt'],
            ]);

            $pengawasan->update($data);

            return redirect()->route('laporan-pengawasan.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            \Log::error('Error updating laporan pengawasan: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function print_surat_tugas($id)
    {
        $pengawasan = TblLaporanPengawasan::findOrFail($id);
        $data = $pengawasan->toArray();

        $pejabatKeys = [
            'pengendali_operasi_st',
            'tim_operasi_st',
            'tim_dukungan_operasi_st',
            'penerbit_st',
            'ketua_tim_lpt',
            'pegawai_pembuat_lpt',
            'pegawai_lppi',
            'pejabat_lppi',
            'id_penerima_nhi',
            'id_pejabat_penerima_nhi',
            'id_pejabat_penerbit_ni',
            'id_pegawai_analisis_lkai',
            'id_pejabat_pengawas_lkai',
            'id_pejabat_administrator_lkai',
        ];


        foreach ($pejabatKeys as $key) {
            if ($pengawasan->$key) {
                $pejabat = $pengawasan->getPejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }


        $data['tim_operasi_st'] = [];
        if (!empty($pengawasan->tim_operasi_st)) {
            $timOperasi = json_decode($pengawasan->tim_operasi_st, true) ?? [];
            foreach ($timOperasi as $index => $id) {
                $user = User::where('id_admin', $id)->first();
                $data['tim_operasi_st'][] = [
                    'no' => $index + 1,
                    'nama' => $user->nama_admin ?? '',
                    'pangkat' => $user->pangkat ?? '',
                    'jabatan' => $user->jabatan ?? '',
                ];
            }
        }

        $data['tim_dukungan_operasi_st'] = [];
        if (!empty($pengawasan->tim_operasi_st)) {
            $timDukungan = json_decode($pengawasan->tim_dukungan_operasi_st, true) ?? [];
            foreach ($timDukungan as $index => $id) {
                $user = User::where('id_admin', $id)->first();
                $data['tim_dukungan_operasi_st'][] = [
                    'no' => $index + 1,
                    'nama' => $user->nama_admin ?? '',
                    'pangkat' => $user->pangkat ?? '',
                    'jabatan' => $user->jabatan ?? '',
                ];
            }
        }



        $data['tahun_sekarang'] = date('Y');

        $data = $this->formatDates($data);


        $data = array_map(fn($value) => is_null($value) ? '' : $value, $data);


        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpengawasan/surat-tugas.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        if (!empty($data['tim_operasi_st'])) {
            $tempData = $data['tim_operasi_st'];
            $firstData = array_shift($tempData);
            array_unshift($tempData, $firstData);


            $templateProcessor->cloneBlock('tim_operasi_section', count($tempData), true, true);
            foreach ($tempData as $index => $tim) {
                $realIndex = $index + 1;
                $templateProcessor->setValue("i#$realIndex", $realIndex);
                $templateProcessor->setValue("tim_operasi_nama#$realIndex", $tim['nama']);
                $templateProcessor->setValue("tim_operasi_pangkat#$realIndex", $tim['pangkat']);
                $templateProcessor->setValue("tim_operasi_jabatan#$realIndex", $tim['jabatan']);
            }
        } else {
            $templateProcessor->deleteBlock('tim_operasi_section');
        }


        if (!empty($data['tim_dukungan_operasi_st'])) {
            $tempData = $data['tim_dukungan_operasi_st'];
            $firstData = array_shift($tempData);
            array_unshift($tempData, $firstData);
            $templateProcessor->setValue('tim_dukungan_title', 'Tim Dukungan Operasi');

            $templateProcessor->cloneBlock('tim_dukungan_section', count($tempData), true, true);
            foreach ($tempData as $index => $tim) {
                $realIndex = $index + 1;
                $templateProcessor->setValue("i#$realIndex", $realIndex);
                $templateProcessor->setValue("tim_dukungan_nama#$realIndex", $tim['nama']);
                $templateProcessor->setValue("tim_dukungan_pangkat#$realIndex", $tim['pangkat']);
                $templateProcessor->setValue("tim_dukungan_jabatan#$realIndex", $tim['jabatan']);
            }
        } else {
            $templateProcessor->deleteBlock('tim_dukungan_section');
        }



        $melaksanakan_tugas_st_raw = $pengawasan->melaksanakan_tugas_st;
        $melaksanakan_tugas_st_raw = preg_replace('/\s+/', ' ', trim($melaksanakan_tugas_st_raw));
        preg_match_all('/\*(.*?)\*/', $melaksanakan_tugas_st_raw, $matches);
        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'no' => $index + 1,
                'tugas_st' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('no', $templateData);



        $fileName = 'Dokumen_Intelijen_Nomor_Surat_Tugas_' . $pengawasan->no_st . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_lpt($id)
    {
        $pengawasan = TblLaporanPengawasan::findOrFail($id);
        $data = $pengawasan->toArray();

        $pejabatKeys = [
            'ketua_tim_lpt',
            'pegawai_pembuat_lpt',
        ];


        foreach ($pejabatKeys as $key) {
            if ($pengawasan->$key) {
                $pejabat = $pengawasan->getPejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                $data[$key . '_nip'] = $pejabat->nip ?? '';
            } else {
                $data[$key . '_nama'] = '';
                $data[$key . '_pangkat'] = '';
                $data[$key . '_jabatan'] = '';
                $data[$key . '_nip'] = '';
            }
        }

        $data['tahun_sekarang'] = date('Y');

        $data = $this->formatDates($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpengawasan/surat-lpt.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }




        $fileName = 'Dokumen_Intelijen_Nomor_Surat_LPT_' . $pengawasan->no_lpt . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }



    private function formatDates($data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value) && $this->isValidDate($value)) {
                $date = \DateTime::createFromFormat('Y-m-d', $value);
                if ($date) {
                    $data[$key] = $date->format('d F Y');
                }
            }
        }
        return $data;
    }


    private function isValidDate($date)
    {
        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}