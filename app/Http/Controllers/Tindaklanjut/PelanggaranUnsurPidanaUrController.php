<?php

namespace App\Http\Controllers\Tindaklanjut;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TblKemasan;
use App\Models\TblJenisPelanggaran;
use App\Models\TblSegel;
use App\Models\TblNoRef;
use App\Models\TblLaporanInformasi;
use App\Models\TblLaporanPengawasan;
use App\Models\TblPascaPenindakan;
use App\Models\TblSbp;
use App\Models\TblNegara;
use App\Models\TblLocus;
use App\Models\TblPenyidikan;
use App\Models\TblAturanLartas;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\Barang;
use App\Models\TblPelanggaranUnsurPidanaUr;
use App\Models\TblPelanggaranUnsurPidanaPenyidikan;

class PelanggaranUnsurPidanaUrController extends Controller
{
    public function index()
    {
        $unsurpidana = TblPelanggaranUnsurPidanaUr::select('id', 'id_pelanggaran_unsur_pidana_penyidikan_ref','id_penyidikan_ref')->get();

        // $unsurpidana = $unsurpidana->map(function ($item) {
        //     $item->tgl_bast_instansi_lain_pkl = $this->formatDates(['tgl_bast_instansi_lain_pkl' => $item->tgl_bast_instansi_lain_pkl])['tgl_bast_instansi_lain_pkl'];
        //     return $item;
        // });

        // dd($unsurpidana);

        $pascapenindakan = TblPascaPenindakan::select('no_lp', 'tgl_lp', 'id_pasca_penindakan', 'id_penindakan_ref')
            ->get()
            ->map(function ($item) {
                $item->tgl_lp = $this->formatDates(['tgl_lp' => $item->tgl_lp])['tgl_lp'];
                return $item;
            });

        $penyidikan = TblPenyidikan::select('no_lhp_penyidikan', 'tgl_lhp_penyidikan', 'id_pasca_penindakan_ref', 'id_penyidikan')
            ->get()
            ->map(function ($item) {
                $item->tgl_lhp_penyidikan = $this->formatDates(['tgl_lhp_penyidikan' => $item->tgl_lhp_penyidikan])['tgl_lhp_penyidikan'];
                return $item;
            });

        $unsurPidanaPenyidikan = TblPelanggaranUnsurPidanaPenyidikan::select('id', 'id_pelanggaran_unsur_pidana_penyidikan', 'no_lk', 'tgl_lk')
            ->get()
            ->map(function ($item) {
                $item->tgl_lk = $this->formatDates(['tgl_lk' => $item->tgl_lk])['tgl_lk'];
                return $item;
            });

        $sbpData = TblSbp::with('laporanInformasi')
            ->select('no_sbp', 'tgl_sbp', 'id_pra_penindakan_ref')
            ->get()
            ->map(function ($item) {
                $item->tgl_sbp = $this->formatDates(['tgl_sbp' => $item->tgl_sbp])['tgl_sbp'];
                return $item;
            });

        // dd($unsurpidana);

        return view('Tindaklanjut.pelanggaran-unsur-pidana-ur.index', compact('unsurpidana', 'pascapenindakan', 'sbpData', 'penyidikan', 'unsurPidanaPenyidikan'));
    }

    public function create(Request $request)
    {
        $id_penyidikan = $request->query('id_penyidikan');
        $id_unsur_pidana = $request->query('id_pelanggaran_unsur_pidana_penyidikan');

        $users = User::all();
        $no_ref = TblNoRef::first();
        $nama_negara = TblNegara::all()->groupBy('benua');

        $unsurpenyidikan = null;
        $pascapenindakan = null;
        $penyidikan = null;
        $sbpData = null;
        $laporanInformasi = collect();
        $saksiData = [];
        $tersangkaData = [];

        if (!empty($id_unsur_pidana)) {
            $unsurpenyidikan = TblPelanggaranUnsurPidanaPenyidikan::where('id_pelanggaran_unsur_pidana_penyidikan', $id_unsur_pidana)->first();

            if ($unsurpenyidikan) {
                $saksiData = json_decode($unsurpenyidikan->data_saksi ?? '[]', true);
                $tersangkaData = json_decode($unsurpenyidikan->data_tersangka ?? '[]', true);

                $id_penyidikan = $unsurpenyidikan->id_penyidikan_ref ?? $id_penyidikan;
            }
        }

        if (!empty($id_penyidikan)) {
            $penyidikan = TblPenyidikan::where('id_penyidikan', $id_penyidikan)->first();

            if ($penyidikan) {
                $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();
                $sbpData = TblSbp::with('laporanInformasi')->where('id_penindakan', $pascapenindakan->id_penindakan_ref)->first();

                $laporanInformasi = TblLaporanInformasi::whereIn('id_pra_penindakan', $sbpData ? [$sbpData->id_pra_penindakan_ref] : [])->get();

                if ($sbpData && empty($tersangkaData)) {
                    $tersangkaData = [
                        [
                            'nama' => $sbpData->nama_saksi ?? '',
                            'ttl' => $sbpData->ttl_saksi ?? '',
                            'agama' => $sbpData->agama_saksi ?? '',
                            'jenis_kelamin' => $sbpData->jk_saksi ?? '',
                            'kewarganegaraan' => $sbpData->kewarganegaraan_saksi ?? '',
                            'pekerjaan' => $sbpData->pekerjaan_saksi ?? '',
                            'alamat' => $sbpData->alamat_saksi ?? '',
                            'jenis_identitas' => $sbpData->jenis_iden_saksi ?? '',
                            'nomor_identitas' => $sbpData->no_identitas_saksi ?? '',
                            'pendidikan' => $sbpData->pendidikan_terakhir_saksi ?? '',
                        ],
                    ];
                }
            }
        }

        // Ambil dari penyidikan apapun kondisinya
        $dugaan_pelanggaran_tersangka = $penyidikan->dugaan_pelanggaran_lpp ?? '';

        return view('Tindaklanjut.pelanggaran-unsur-pidana-ur.create', compact('users', 'no_ref', 'nama_negara', 'id_penyidikan', 'penyidikan', 'pascapenindakan', 'sbpData', 'laporanInformasi', 'saksiData', 'tersangkaData', 'dugaan_pelanggaran_tersangka'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); // Mulai transaksi database

            $requestData = $request->all();

            // Validasi request
            $request->validate([
                'no_split_tersangka.*' => 'nullable|string',
                'tgl_split_tersangka.*' => 'nullable|string',
                'penelitian_nama_tersangka.*' => 'nullable|string',
                'dugaan_pelanggaran_tersangka.*' => 'nullable|string',
                'pejabat_penerbit_surat_penelitian_tersangka.*' => 'nullable|string',
                'status_plh_split.*' => 'nullable|string',
                'status_sanggup_split.*' => 'nullable|string',

                'berita_acara.*' => 'nullable|file',
                'surat_permohonan.*' => 'nullable|file',
                'surat_pengakuan.*' => 'nullable|file',
                'tanda_terima.*' => 'nullable|file',
                'nd_permohonan.*' => 'nullable|file',
            ]);

            // Proses upload file
            $fileUploads = [];
            $uploadTypes = ['berita_acara', 'surat_permohonan', 'surat_pengakuan', 'tanda_terima', 'nd_permohonan'];

            foreach ($uploadTypes as $type) {
                if ($request->hasFile($type)) {
                    $fileUploads[$type] = [];
                    foreach ($request->file($type) as $file) {
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $uniqueId = uniqid() . '_' . time();
                        $fileName = $type . '_' . $uniqueId . '.' . $extension;

                        $filePath = $file->storeAs('ur_document/' . $type, $fileName, 'public');

                        $fileUploads[$type][] = [
                            'name' => $fileName,
                            'path' => $filePath,
                            'original_name' => $originalName,
                        ];
                    }
                }
            }

            // Proses data tersangka
            $dataSuratPenilitianTersangka = [];
            if ($request->has('penelitian_nama_tersangka')) {
                foreach ($request->penelitian_nama_tersangka as $key => $nama) {
                    $pejabatPenelitian = $request->input("pejabat_penelitian.$key", []);

                    $dataSuratPenilitianTersangka[] = [
                        'nama' => $nama,
                        'no_split' => $request->no_split_tersangka[$key] ?? null,
                        'tgl_split' => $request->tgl_split_tersangka[$key] ?? null,
                        'dugaan_pelanggaran_tersangka' => $request->dugaan_pelanggaran_tersangka[$key] ?? null,
                        'pejabat_penelitian' => !empty($pejabatPenelitian) ? json_encode($pejabatPenelitian) : null,
                        'pejabat_penerbit' => $request->pejabat_penerbit_surat_penelitian_tersangka[$key] ?? null,
                        'status_plh_split' => $request->status_plh_split[$key] ?? null,
                        'status_sanggup_split' => $request->status_sanggup_split[$key] ?? null,
                    ];
                }
            }

            // Bersihkan requestData dari data yang sudah diproses
            $requestData = $request->except(['no_split_tersangka', 'tgl_split_tersangka', 'penelitian_nama_tersangka', 'dugaan_pelanggaran_tersangka', 'pejabat_penerbit_surat_penelitian_tersangka', 'status_plh_split', 'status_sanggup_split', 'berita_acara', 'surat_permohonan', 'surat_pengakuan', 'tanda_terima', 'nd_permohonan', 'pejabat_penelitian']);

            // Tambahkan data tersangka dalam bentuk JSON
            $requestData['surat_perintah_penelitian_ur_tersangka'] = json_encode($dataSuratPenilitianTersangka);
            $requestData['upload_ur_tersangka'] = json_encode($fileUploads);

            // Simpan ke database
            $unsurpenyidikanur = TblPelanggaranUnsurPidanaUr::create($requestData);

            DB::commit(); // Simpan transaksi

            return redirect()->route('unsur-pidana-ur.edit', $unsurpenyidikanur->id)->with('success', 'Data berhasil disimpan, silakan lanjutkan edit.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika ada error

            // Log detail error
            Log::error('Error saat menyimpan data: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $unsurpenyidikanur = TblPelanggaranUnsurPidanaUr::where('id', $id)->first();
        if (!$unsurpenyidikanur) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $penyidikan = null;
        $unsurpenyidikan = null;

        if ($unsurpenyidikanur->id_penyidikan_ref) {
            $penyidikan = TblPenyidikan::where('id_penyidikan', $unsurpenyidikanur->id_penyidikan_ref)->first();
        } elseif ($unsurpenyidikanur->id_pelanggaran_unsur_pidana_penyidikan_ref) {
            $unsurpenyidikan = TblPelanggaranUnsurPidanaPenyidikan::where('id_pelanggaran_unsur_pidana_penyidikan', $unsurpenyidikanur->id_pelanggaran_unsur_pidana_penyidikan_ref)->first();
            if (!$unsurpenyidikan) {
                return redirect()->back()->with('error', 'Data penyidikan unsur tidak ditemukan.');
            }

            $penyidikan = TblPenyidikan::where('id_penyidikan', $unsurpenyidikan->id_penyidikan_ref)->first();
        }

        if (!$penyidikan) {
            return redirect()->back()->with('error', 'Data penyidikan tidak ditemukan.');
        }

        // Ambil tersangka dari unsur penyidikan jika tersedia
        if (!$unsurpenyidikan && $unsurpenyidikanur->id_pelanggaran_unsur_pidana_penyidikan_ref) {
            $unsurpenyidikan = TblPelanggaranUnsurPidanaPenyidikan::where('id_pelanggaran_unsur_pidana_penyidikan', $unsurpenyidikanur->id_pelanggaran_unsur_pidana_penyidikan_ref)->first();
        }

        $tersangkaData = json_decode($unsurpenyidikan->data_tersangka ?? '[]', true);

        // dd($tersangkaData);

        $pascapenindakan = $penyidikan->id_pasca_penindakan_ref ? TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first() : null;
        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', $pascapenindakan->id_penindakan_ref ?? null)
            ->first();
        $laporanInformasi = TblLaporanInformasi::whereIn('id_pra_penindakan', $sbpData ? $sbpData->pluck('id_pra_penindakan_ref') : [])->get();

        $users = User::all();
        $nama_negara = TblNegara::all()->groupBy('benua');
        $no_ref = TblNoRef::first();
        $dugaan_pelanggaran_tersangka = $penyidikan->dugaan_pelanggaran_lpp ?? '';

        $penelitianTersangka = json_decode($unsurpenyidikanur->surat_perintah_penelitian_ur_tersangka ?? '[]', true);

        return view('Tindaklanjut.pelanggaran-unsur-pidana-ur.edit', compact('unsurpenyidikanur', 'users', 'no_ref', 'penyidikan', 'nama_negara', 'pascapenindakan', 'sbpData', 'laporanInformasi', 'penelitianTersangka', 'tersangkaData', 'dugaan_pelanggaran_tersangka'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction(); // Mulai transaksi database

            $unsurpenyidikanur = TblPelanggaranUnsurPidanaUr::findOrFail($id);

            $request->validate([
                'no_split_tersangka.*' => 'nullable|string',
                'tgl_split_tersangka.*' => 'nullable|string',
                'penelitian_nama_tersangka.*' => 'nullable|string',
                'dugaan_pelanggaran_tersangka.*' => 'nullable|string',
                'pejabat_penerbit_surat_penelitian_tersangka.*' => 'nullable|string',
                'status_plh_split.*' => 'nullable|string',
                'status_sanggup_split.*' => 'nullable|string',

                'berita_acara.*' => 'nullable|file',
                'surat_permohonan.*' => 'nullable|file',
                'surat_pengakuan.*' => 'nullable|file',
                'tanda_terima.*' => 'nullable|file',
                'nd_permohonan.*' => 'nullable|file',
            ]);

            // Proses upload file
            $fileUploads = [];
            $uploadTypes = ['berita_acara', 'surat_permohonan', 'surat_pengakuan', 'tanda_terima', 'nd_permohonan'];

            foreach ($uploadTypes as $type) {
                if ($request->hasFile($type)) {
                    $fileUploads[$type] = [];
                    foreach ($request->file($type) as $file) {
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $uniqueId = uniqid() . '_' . time();
                        $fileName = $type . '_' . $uniqueId . '.' . $extension;

                        $filePath = $file->storeAs('ur_document/' . $type, $fileName, 'public');

                        $fileUploads[$type][] = [
                            'name' => $fileName,
                            'path' => $filePath,
                            'original_name' => $originalName,
                        ];
                    }
                }
            }

            // Proses data tersangka
            $dataSuratPenilitianTersangka = [];
            if ($request->has('penelitian_nama_tersangka')) {
                foreach ($request->penelitian_nama_tersangka as $key => $nama) {
                    $pejabatPenelitian = $request->input("pejabat_penelitian.$key", []);

                    $dataSuratPenilitianTersangka[] = [
                        'nama' => $nama,
                        'no_split' => $request->no_split_tersangka[$key] ?? null,
                        'tgl_split' => $request->tgl_split_tersangka[$key] ?? null,
                        'dugaan_pelanggaran_tersangka' => $request->dugaan_pelanggaran_tersangka[$key] ?? null,
                        'pejabat_penelitian' => !empty($pejabatPenelitian) ? json_encode($pejabatPenelitian) : null,
                        'pejabat_penerbit' => $request->pejabat_penerbit_surat_penelitian_tersangka[$key] ?? null,
                        'status_plh_split' => $request->status_plh_split[$key] ?? null,
                        'status_sanggup_split' => $request->status_sanggup_split[$key] ?? null,
                    ];
                }
            }

            // Ambil data inputan selain yang dikecualikan
            $requestData = $request->except(['no_split_tersangka', 'tgl_split_tersangka', 'penelitian_nama_tersangka', 'dugaan_pelanggaran_tersangka', 'pejabat_penerbit_surat_penelitian_tersangka', 'status_plh_split', 'status_sanggup_split', 'berita_acara', 'surat_permohonan', 'surat_pengakuan', 'tanda_terima', 'nd_permohonan', 'pejabat_penelitian']);

            // Gabungkan file baru dengan file lama
            $existingUploads = json_decode($unsurpenyidikanur->upload_ur_tersangka, true) ?? [];
            foreach ($uploadTypes as $type) {
                if (!empty($fileUploads[$type])) {
                    $existingUploads[$type] = array_merge($existingUploads[$type] ?? [], $fileUploads[$type]);
                }
            }

            $requestData['surat_perintah_penelitian_ur_tersangka'] = json_encode($dataSuratPenilitianTersangka);
            $requestData['upload_ur_tersangka'] = json_encode($existingUploads);

            // Update data ke database
            $unsurpenyidikanur->update($requestData);

            DB::commit();
            return redirect()->route('unsur-pidana-ur.edit', $unsurpenyidikanur->id)->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat update data: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat update: ' . $e->getMessage());
        }
    }

    public function deleteFile(Request $request, $id)
    {
        try {
            $unsurpenyidikanur = TblPelanggaranUnsurPidanaUr::findOrFail($id);
            $type = $request->type;
            $index = $request->index;

            $uploadedFiles = json_decode($unsurpenyidikanur->upload_ur_tersangka, true);

            if (isset($uploadedFiles[$type][$index])) {
                // Hapus file dari storage
                $filePath = $uploadedFiles[$type][$index]['path'];
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }

                // Hapus data file dari array
                array_splice($uploadedFiles[$type], $index, 1);

                // Update database
                $unsurpenyidikanur->upload_ur_tersangka = json_encode($uploadedFiles);
                $unsurpenyidikanur->save();

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false, 'message' => 'File tidak ditemukan']);
        } catch (\Exception $e) {
            Log::error('Error saat menghapus file: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $unsurpenyidikanur = TblPelanggaranUnsurPidanaUr::find($id);

        if ($unsurpenyidikanur) {
            // Hapus file dari storage
            $uploadedFiles = json_decode($unsurpenyidikanur->upload_ur_tersangka, true);

            if (is_array($uploadedFiles)) {
                foreach ($uploadedFiles as $fileGroup) {
                    foreach ($fileGroup as $file) {
                        if (isset($file['path']) && Storage::disk('public')->exists($file['path'])) {
                            Storage::disk('public')->delete($file['path']);
                        }
                    }
                }
            }

            // Hapus data dari database
            $unsurpenyidikanur->delete();

            return redirect()->route('unsur-pidana-ur.index')->with('success', 'Data dan file berhasil dihapus.');
        }

        return redirect()->route('unsur-pidana-ur.index')->with('error', 'Data tidak ditemukan.');
    }

    public function printSuratPerTersangka($id)
    {
        $data = TblPelanggaranUnsurPidanaUr::findOrFail($id);

        // Decode data tersangka dari JSON
        $dataTersangka = json_decode($data->surat_perintah_penelitian_ur_tersangka, true);

        $filePaths = [];

        // Loop untuk setiap tersangka dan buat dokumen per tersangka
        foreach ($dataTersangka as $tersangka) {
            // Buat TemplateProcessor baru untuk setiap dokumen
            $templateProcessor = new TemplateProcessor(resource_path('templates/Tindaklanjut/unsur-pidana-ur/tes.docx'));

            // Set data untuk setiap tersangka
            $templateProcessor->setValue('nama', $tersangka['nama']);
            $templateProcessor->setValue('no_split', $tersangka['no_split']);
            $templateProcessor->setValue('tgl_split', $tersangka['tgl_split']);
            $templateProcessor->setValue('dugaan_pelanggaran_tersangka', $tersangka['dugaan_pelanggaran_tersangka']);
            $templateProcessor->setValue('pejabat_penelitian', implode(', ', json_decode($tersangka['pejabat_penelitian'] ?? '[]')));
            $templateProcessor->setValue('pejabat_penerbit', $tersangka['pejabat_penerbit']);
            $templateProcessor->setValue('status_plh_split', $tersangka['status_plh_split']);
            $templateProcessor->setValue('status_sanggup_split', $tersangka['status_sanggup_split']);

            // Tentukan nama file untuk setiap surat per tersangka
            $fileName = "Surat_UR_{$tersangka['no_split']}_{$tersangka['nama']}.docx";
            $filePath = storage_path("app/public/{$fileName}");

            // Simpan dokumen hasil template
            $templateProcessor->saveAs($filePath);

            // Simpan file path untuk nanti di-download
            $filePaths[] = $filePath;
        }

        // Jika semua dokumen sudah dibuat, gabungkan dalam bentuk zip dan download
        if (count($filePaths) > 0) {
            $zipFilePath = storage_path('app/public/surat_ur.zip');
            $zip = new \ZipArchive();

            if ($zip->open($zipFilePath, \ZipArchive::CREATE) === true) {
                foreach ($filePaths as $file) {
                    $zip->addFile($file, basename($file));
                }
                $zip->close();

                // Hapus file individual setelah zip
                foreach ($filePaths as $file) {
                    unlink($file);
                }

                // Return zip file untuk di-download
                return response()->download($zipFilePath)->deleteFileAfterSend(true);
            }
        }

        return response()->json(['error' => 'Tidak ada file yang dibuat.'], 404);
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
            'December' => 'Desember',
        ];

        Carbon::setLocale('id');

        $dateFields = ['tempus_lp', ''];

        foreach ($dateFields as $field) {
            if (!empty($data[$field])) {
                $dateValue = $data[$field];
                if ($dateValue) {
                    $date = Carbon::parse($dateValue);
                    $formattedDate = 'Tanggal ' . $date->isoFormat('D MMMM YYYY') . ' Pukul ' . $date->format('H.i');
                    $data[$field] = $formattedDate;
                } else {
                    $data[$field] = '';
                }
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

        return $data;
    }

    private function angkaKeKata($angka)
    {
        $huruf = [
            0 => 'nol',
            1 => 'satu',
            2 => 'dua',
            3 => 'tiga',
            4 => 'empat',
            5 => 'lima',
            6 => 'enam',
            7 => 'tujuh',
            8 => 'delapan',
            9 => 'sembilan',
            10 => 'sepuluh',
            11 => 'sebelas',
            12 => 'dua belas',
            13 => 'tiga belas',
            14 => 'empat belas',
            15 => 'lima belas',
            16 => 'enam belas',
            17 => 'tujuh belas',
            18 => 'delapan belas',
            19 => 'sembilan belas',
            20 => 'dua puluh',
            30 => 'tiga puluh',
            40 => 'empat puluh',
            50 => 'lima puluh',
            60 => 'enam puluh',
            70 => 'tujuh puluh',
            80 => 'delapan puluh',
            90 => 'sembilan puluh',
        ];

        $angka = (int) $angka;

        if ($angka < 20) {
            return $huruf[$angka];
        } elseif ($angka < 100) {
            $puluhan = floor($angka / 10) * 10;
            $satuan = $angka % 10;
            return $huruf[$puluhan] . ($satuan ? ' ' . $huruf[$satuan] : '');
        } elseif ($angka < 1000) {
            $ratusan = floor($angka / 100);
            $sisa = $angka % 100;
            return $huruf[$ratusan] . ' ratus' . ($sisa ? ' ' . $this->angkaKeKata($sisa) : '');
        } else {
            $ribuan = floor($angka / 1000);
            $sisa = $angka % 1000;
            return $huruf[$ribuan] . ' ribu' . ($sisa ? ' ' . $this->angkaKeKata($sisa) : '');
        }
    }

    private function isValidDate($date)
    {
        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}
