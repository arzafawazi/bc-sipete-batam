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

            $laporanData = $laporan->toArray();
            $laporanFormatted = $this->formatDates($laporanData);


            $laporan->tgl_st = $laporanFormatted['tgl_st'];
        }

        // dd($laporanpengawasan);



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

            unset($data['sumber'], $data['validitas']);

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

            // dd($data);

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
        $nama_negara = TblNegara::all()->groupBy('benua');

        $audioDataRaw = $pengawasan->dokumentasi_audio_lpt;
        $videoDataRaw = $pengawasan->dokumentasi_video_lpt;

        $audioDataRaw = stripslashes($audioDataRaw);
        $videoDataRaw = stripslashes($videoDataRaw);

        // dd($audioDataRaw, $videoDataRaw);

        return view('Dokintelijen.laporan-pengawasan.edit', compact('pengawasan', 'users', 'no_ref', 'audioDataRaw', 'videoDataRaw', 'nama_negara'));
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

            $ikhtisarArray = $request->input('ikhtisar', []);

            $ikhtisarData = [];
            foreach ($ikhtisarArray as $ikhtisar) {
                $ikhtisarData[] = [
                    'ikhtisar' => $ikhtisar['ikhtisar'] ?? '',
                    'sumber' => $ikhtisar['sumber'] ?? '',
                    'validitas' => $ikhtisar['validitas'] ?? '',
                ];
            }

            $data['ikhtisar'] = json_encode($ikhtisarData);

            unset($data['sumber'], $data['validitas']);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return redirect()->back()->withInput()->with('error', 'Error encoding JSON: ' . json_last_error_msg());
            }

            \Log::info('melaksanakan_tugas_st value:', ['value' => $request->input('melaksanakan_tugas_st')]);


            \Log::info('Updating data:', [
                'melaksanakan_tugas_st' => $data['melaksanakan_tugas_st'],
                'video' => $data['dokumentasi_video_lpt'],
                'audio' => $data['dokumentasi_audio_lpt'],
            ]);

            // dd($data);

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
        preg_match_all('/\#(.*?)\#/', $melaksanakan_tugas_st_raw, $matches);
        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'i' => $index + 1 . '.',
                'tugas_st' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('i', $templateData);



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

        $uraian_tugas_lpt_raw = $pengawasan->uraian_tugas_lpt;
        $uraian_tugas_lpt_raw = preg_replace('/\s+/', ' ', trim($uraian_tugas_lpt_raw));
        preg_match_all('/\#(.*?)\#/', $uraian_tugas_lpt_raw, $matches);

        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'no_uraian' => ($index + 1) . '.',
                'uraian_tugas' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('no_uraian', $templateData);

        $ikhtisar_informasi_lpt_raw = $pengawasan->ikhtisar_informasi_lpt;
        $ikhtisar_informasi_lpt_raw = preg_replace('/\s+/', ' ', trim($ikhtisar_informasi_lpt_raw));
        preg_match_all('/\#(.*?)\#/', $ikhtisar_informasi_lpt_raw, $matches);

        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'no_ikhtisar' => $index + 1,
                'ikhtisar_informasi' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('no_ikhtisar', $templateData);

        $dokumentasi = [
            'dokumentasi_foto' => !empty($pengawasan->dokumentasi_foto_lpt) ? 'Terlampir' : '-',
            'dokumentasi_audio' => !empty($pengawasan->dokumentasi_audio_lpt) ? 'Terlampir' : '-',
            'dokumentasi_video' => !empty($pengawasan->dokumentasi_video_lpt) ? 'Terlampir' : '-',
            'info_lainnya' => !empty($pengawasan->info_lainnya_lpt) ? $pengawasan->info_lainnya_lpt : '-',
        ];

        $templateProcessor->setValues($dokumentasi);

        $fotoPaths = json_decode($pengawasan->dokumentasi_foto_lpt, true);

        // dd($fotoPaths);

        if (!empty($fotoPaths)) {
            $templateProcessor->cloneBlock('foto_section', count($fotoPaths), true, true);

            foreach ($fotoPaths as $index => $fotoPath) {
                $realIndex = $index + 1;
                $imagePath = public_path('storage/' . $fotoPath);

                if (file_exists($imagePath)) {
                    list($width, $height) = getimagesize($imagePath);

                    $maxWidth = 400;
                    $maxHeight = 400;

                    $ratio = min($maxWidth / $width, $maxHeight / $height);

                    $newWidth = round($width * $ratio);
                    $newHeight = round($height * $ratio);

                    $widthCm = round($newWidth * 0.0264583, 2);
                    $heightCm = round($newHeight * 0.0264583, 2);

                    $templateProcessor->setImageValue("foto#$realIndex", [
                        'path' => $imagePath,
                        'width' => $widthCm . 'cm',
                        'height' => $heightCm . 'cm'
                    ]);
                } else {
                    $templateProcessor->setValue("foto#$realIndex", '-');
                }
            }
        } else {
            $templateProcessor->deleteBlock('foto_section');
        }

        $kesimpulan_lpt_raw = $pengawasan->kesimpulan_lpt;
        $kesimpulan_lpt_raw = preg_replace('/\s+/', ' ', trim($kesimpulan_lpt_raw));
        preg_match_all('/\#(.*?)\#/', $kesimpulan_lpt_raw, $matches);

        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'k' => $index + 1,
                'kesimpulan' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('k', $templateData);

        $rekomendasi_lpt_raw = $pengawasan->rekomendasi_lpt;
        $rekomendasi_lpt_raw = preg_replace('/\s+/', ' ', trim($rekomendasi_lpt_raw));
        preg_match_all('/\#(.*?)\#/', $rekomendasi_lpt_raw, $matches);

        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'r' => $index + 1,
                'rekomendasi' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('r', $templateData);



        $fileName = 'Dokumen_Intelijen_Nomor_Surat_LPT_' . $pengawasan->no_lpt . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_surat_lpp($id)
    {
        $pengawasan = TblLaporanPengawasan::findOrFail($id);
        $data = $pengawasan->toArray();

        $pejabatKeys = [
            'penerima_informasi_lppi',
            'penilai_informasi_lppi',
            'pegawai_lppi',
            'pejabat_lppi',
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

        if ($pengawasan->internal_lppi === 'YA') {
            $data['i_l'] = '✔';
        } else {
            $data['i_l'] = '';
        }

        if ($pengawasan->eksternal_lppi === 'YA') {
            $data['e_l'] = '✔';
        } else {
            $data['e_l'] = '';
        }

        if ($pengawasan->tindak_lanjut_lppi === 'Analisis') {
            $data['a_l'] = '✔';
        } else {
            $data['a_l'] = '';
        }

        if ($pengawasan->tindak_lanjut_lppi === 'Arsip') {
            $data['a_r'] = '✔';
        } else {
            $data['a_r'] = '';
        }

        $data['tahun_sekarang'] = date('Y');

        $data = $this->formatDates($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpengawasan/surat-lpp.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglLppi = $pengawasan->tgl_lppi;

        if (!empty($tglLppi)) {
            $tahunSuratLppi = date('Y', strtotime($tglLppi));
        } else {
            $tahunSuratLppi = '-';
        }

        $templateProcessor->setValue('tahun_surat_lppi', $tahunSuratLppi);


        $rawIkhtisar = $pengawasan->ikhtisar;
        $data = json_decode($rawIkhtisar, true);
        // dd($data);

        if (!empty($data)) {
            $templateProcessor->cloneBlock('ikhtisar_section', count($data), true, true);

            foreach ($data as $index => $item) {
                $realIndex = $index + 1;
                $templateProcessor->setValue("s#$realIndex", $item['sumber']);
                $templateProcessor->setValue("i#$realIndex", $item['ikhtisar']);
                $templateProcessor->setValue("v#$realIndex", $item['validitas']);
            }
        } else {
            $templateProcessor->deleteBlock('ikhtisar_section');
        }



        $fileName = 'Dokumen_Intelijen_Nomor_Surat_LPPI_' . $pengawasan->no_lppi . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_lkai($id)
    {
        $pengawasan = TblLaporanPengawasan::findOrFail($id);
        $data = $pengawasan->toArray();

        $pejabatKeys = [
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

        if ($pengawasan->nhi === 'YA') {
            $data['nh'] = '✔';
        } else {
            $data['nh'] = '✘';
        }

        if ($pengawasan->ni === 'YA') {
            $data['ni'] = '✔';
        } else {
            $data['ni'] = '✘';
        }

        if ($pengawasan->rekomendasi_lainnya === 'YA') {
            $data['r'] = '✔';
        } else {
            $data['r'] = '✘';
        }

        if ($pengawasan->informasi_lainnya === 'YA') {
            $data['i'] = '✔';
        } else {
            $data['i'] = '✘';
        }

        if ($pengawasan->keputusan_pertama_lkai === 'YA') {
            $data['p'] = '✔';
            $data['pt'] = '✘';
        } else {
            $data['p'] = '✘';
            $data['pt'] = '✔';
        }

        if ($pengawasan->keputusan_kedua_lkai === 'YA') {
            $data['k'] = '✔';
            $data['kt'] = '✘';
        } else {
            $data['k'] = '✘';
            $data['kt'] = '✔';
        }

        $data['tahun_sekarang'] = date('Y');

        $data = $this->formatDates($data);


        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpengawasan/surat-lkai.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglLkai = $pengawasan->tgl_lkai;

        if (!empty($tglLkai)) {
            $tahunSuratLkai = date('Y', strtotime($tglLkai));
        } else {
            $tahunSuratLkai = '-';
        }

        $templateProcessor->setValue('tahun_surat_lkai', $tahunSuratLkai);


        $ikhtisar_data_lkai_raw = $pengawasan->ikhtisar_data_lkai;
        $ikhtisar_data_lkai_raw = preg_replace('/\s+/', ' ', trim($ikhtisar_data_lkai_raw));
        preg_match_all('/\#(.*?)\#/', $ikhtisar_data_lkai_raw, $matches);

        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'nok' => '-',
                'ikhtisar_data' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('nok', $templateData);

        $prosedur_analisis_lkai_raw = $pengawasan->prosedur_analisis_lkai;
        $prosedur_analisis_lkai_raw = preg_replace('/\s+/', ' ', trim($prosedur_analisis_lkai_raw));
        preg_match_all('/\#(.*?)\#/', $prosedur_analisis_lkai_raw, $matches);

        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'nop' => '-',
                'prosedur_data' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('nop', $templateData);


        $hasil_analisis_lkai_raw = $pengawasan->hasil_analisis_lkai;
        $hasil_analisis_lkai_raw = preg_replace('/\s+/', ' ', trim($hasil_analisis_lkai_raw));
        preg_match_all('/\#(.*?)\#/', $hasil_analisis_lkai_raw, $matches);

        $templateData = [];
        foreach (array_unique($matches[1]) as $index => $task) {
            $templateData[] = [
                'noh' => '-',
                'hasil_data' => trim($task),
            ];
        }

        $templateProcessor->cloneRowAndSetValues('noh', $templateData);


        $fileName = 'Dokumen_Intelijen_Nomor_Surat_LKAI_' . $pengawasan->no_lkai . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_nhi($id)
    {
        $pengawasan = TblLaporanPengawasan::findOrFail($id);
        $data = $pengawasan->toArray();

        $pejabatKeys = [
            'id_penerima_nhi',
            'id_pejabat_penerbit_nhi',
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




        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpengawasan/surat-nhi.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        if ($pengawasan->tipe_nhi === 'NHI') {
            $tglNhi = $pengawasan->tgl_nhi;
        } elseif ($pengawasan->tipe_nhi === 'NHI-HKI') {
            $tglNhi = $pengawasan->tgl_nhi_hki;
        } else {
            $tglNhi = null;
        }

        $tahunSuratNhi = !empty($tglNhi) ? date('Y', strtotime($tglNhi)) : '-';



        if ($pengawasan->tipe_nhi === 'NHI') {
            $data['tipe_nhi'] = $pengawasan->no_nhi
                ? 'NHI–' . $pengawasan->no_nhi . '/KPU.206/' . $tahunSuratNhi
                : '-';
            $data['tanggal_surat'] = $pengawasan->tgl_nhi ?: '-';
        } elseif ($pengawasan->tipe_nhi === 'NHI-HKI') {
            $data['tipe_nhi'] = $pengawasan->no_nhi_hki
                ? 'NHI–HKI-' . $pengawasan->no_nhi_hki . '/KPU.206/' . $tahunSuratNhi
                : '-';
            $data['tanggal_surat'] = $pengawasan->tgl_nhi_hki ?: '-';
        } else {
            $data['tipe_nhi'] = '-';
            $data['tanggal_surat'] = '-';
        }
        $data = $this->formatDates($data);

        $templateProcessor->setValue('type', $data['tipe_nhi']);
        $templateProcessor->setValue('tanggal_surat', $data['tanggal_surat']);
        $templateProcessor->setValue('tahun', $tahunSuratNhi);



        // dd($data);

        $fileName = 'Dokumen_Intelijen_Nomor_Surat_NHI_' . $pengawasan->no_nhi . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_surat_ni($id)
    {
        $pengawasan = TblLaporanPengawasan::findOrFail($id);
        $data = $pengawasan->toArray();

        $pejabatKeys = [
            'id_pejabat_penerima_ni',
            'id_pejabat_penerbit_ni',
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

        $tglNi = $pengawasan->tgl_ni;

        if (!empty($tglNi)) {
            $data['tgl_ni_hari'] = \Carbon\Carbon::parse($tglNi)->locale('id')->isoFormat('dddd, D MMMM YYYY');
        } else {
            $data['tgl_ni_hari'] = '-';
        }


        $data = $this->formatDates($data);



        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpengawasan/surat-ni.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }


        $tglNi = $pengawasan->tgl_ni;

        if (!empty($tglNi)) {
            $tahunSuratNi = date('Y', strtotime($tglNi));
        } else {
            $tahunSuratNi = '-';
        }

        $templateProcessor->setValue('th', $tahunSuratNi);

        $fileName = 'Dokumen_Intelijen_Nomor_Surat_NI_' . $pengawasan->no_ni . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_surat_rekomendasi($id)
    {
        $pengawasan = TblLaporanPengawasan::findOrFail($id);
        $data = $pengawasan->toArray();

        $pejabatKeys = [
            'id_pejabat_notdin',
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

        $data['perkiraan_waktu_tempuh'] = $this->calculateDuration($data['perkiraan_keberangkatan_notdin'], $data['perkiraan_kedatangan_notdin']);
        $data['selisih_waktu_penyampaian'] = $this->calculateDuration($data['perkiraan_kedatangan_notdin'], $data['waktu_penyampaian_notdin']);


        $data = $this->formatDates($data);


        // dd($data);



        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpengawasan/surat-rekomendasi.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglLkai = $pengawasan->tgl_lkai;

        if (!empty($tglLKAI)) {
            $tahunSuratLKAI = date('Y', strtotime($tglLKAI));
        } else {
            $tahunSuratLKAI = '-';
        }

        $templateProcessor->setValue('tahun_lkai', $tahunSuratLKAI);



        $fileName = 'Dokumen_Intelijen_Surat_Nota_Dinas_' . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    private function formatDates($data)
    {
        $bulanIndo = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];

        $dateFields = [
            'perkiraan_keberangkatan_notdin',
            'perkiraan_kedatangan_notdin',
            'waktu_penyampaian_notdin',
        ];

        foreach ($dateFields as $field) {
            if (!empty($data[$field])) {
                $data[$field] = date('d/m/Y H:i', strtotime($data[$field]));
            }
        }

        foreach ($data as $key => $value) {
            if (is_string($value) && $this->isValidDate($value)) {
                $date = \DateTime::createFromFormat('Y-m-d', $value);
                if ($date) {
                    $formattedDate = $date->format('d F Y');

                    foreach ($bulanIndo as $englishMonth => $indonesianMonth) {
                        if (strpos($formattedDate, $englishMonth) !== false) {
                            $formattedDate = str_replace($englishMonth, $indonesianMonth, $formattedDate);
                            break;
                        }
                    }

                    $data[$key] = $formattedDate;
                }
            }
        }

        if (!empty($data['rentang_waktu_notdin'])) {
            $dates = explode(' - ', $data['rentang_waktu_notdin']);
            if (count($dates) === 2) {
                $startDate = strtotime($dates[0]);
                $endDate = strtotime($dates[1]);

                if ($startDate && $endDate) {
                    $formattedStartDate = date('j', $startDate);
                    $formattedEndDate = date('j', $endDate);
                    $formattedMonthYear = date('F Y', $endDate);

                    $formattedMonthYear = str_replace(array_keys($bulanIndo), array_values($bulanIndo), $formattedMonthYear);

                    $data['rentang_waktu_notdin'] = "$formattedStartDate s.d. $formattedEndDate $formattedMonthYear";
                }
            }
        }

        return $data;
    }

    private function calculateDuration($start, $end): string
    {
        if (empty($start) || empty($end)) {
            return '-';
        }

        $startTime = strtotime($start);
        $endTime = strtotime($end);

        if (!$startTime || !$endTime || $endTime < $startTime) {
            return '-';
        }

        $interval = $endTime - $startTime;

        $days = floor($interval / 86400);
        $hours = floor(($interval % 86400) / 3600);
        $minutes = floor(($interval % 3600) / 60);

        $result = [];

        if ($days > 0) {
            $result[] = "$days hari";
        }
        if ($hours > 0) {
            $result[] = "$hours jam";
        }
        if ($minutes > 0) {
            $result[] = "$minutes menit";
        }

        return implode(' ', $result);
    }

    private function isValidDate($date)
    {
        if (!is_string($date)) {
            return false;
        }

        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}
