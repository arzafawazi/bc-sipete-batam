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
use App\Models\TblPelanggaranKetentuanLain;
use App\Models\TblPelanggaranAdministrasi;
use App\Models\TblAturanLartas;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Models\Barang;

class PelanggaranAdministrasiController extends Controller
{
    public function index()
    {
        $pelanggaranadministrasi = TblPelanggaranAdministrasi::select('id', 'jenis_pelanggaran_administrasi')->get();


        // dd($pelanggaranlain);

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

        $sbpData = TblSbp::with('laporanInformasi')
            ->select('no_sbp', 'tgl_sbp', 'id_pra_penindakan_ref')
            ->get()
            ->map(function ($item) {
                $item->tgl_sbp = $this->formatDates(['tgl_sbp' => $item->tgl_sbp])['tgl_sbp'];
                return $item;
            });
        return view('Tindaklanjut.pelanggaran-administrasi.index', compact('pelanggaranadministrasi', 'pascapenindakan', 'sbpData', 'penyidikan'));
    }



    public function create(Request $request)
    {
        $id_penyidikan = $request->query('id_penyidikan');

        // Ambil data penyidikan berdasarkan ID yang dikirim
        $penyidikan = TblPenyidikan::where('id_penyidikan', $id_penyidikan)->first();
        $barang = Barang::where('id_penyidikan', $id_penyidikan)
            ->select('kode_komoditi', 'jenis_barang', 'id')
            ->get();

        // dd($barang);
        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();

        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', $pascapenindakan->id_penindakan_ref)
            ->first();



        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))
            ->get();


        $users = User::all();
        $no_ref = TblNoRef::first();


        return view('Tindaklanjut.pelanggaran-administrasi.create', compact(
            'users',
            'no_ref',
            'id_penyidikan',
            'barang',
            'pascapenindakan',
            'penyidikan', // Menambahkan data TblPenyidikan
            'sbpData', // Menambahkan data TblSbp
            'laporanInformasi', // Menambahkan data TblLaporanInformasi
        ));
    }



    public function store(Request $request)
    {
        try {
            // Validasi Input
            $validatedData = $request->validate([
                'tgl_pelanggaran_administrasi' => 'nullable|date',
                'jenis_pelanggaran_administrasi' => 'nullable|string',
                'id_barang_pelanggaran_administrasi' => 'nullable|array',
                'id_penyidikan_ref' => 'required|string',
                'id_pelanggaran_administrasi' => 'required|string',

                // Validasi untuk semua file
                'permohonan_dokumen_kepabeanan_ppftz' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'bukti_penerimaan_negara_ppftz' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'dokumen_ppftz' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'keputusan_bdn' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'bast_bdn' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'surat_permohonan_reekspor' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'dokumen_ppftz_reekspor' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'penelitian_dokumen_reekspor' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'penerbitan_spsa' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'surat_spsa' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'billing_djbc_spsa' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'bukti_transaksi_spsa' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'dokumen_lartas' => 'nullable|file|mimes:pdf,jpg,jpeg,png',

                // Field tambahan
                'tgl_bast_pemilik' => 'nullable|date',
                'pejabat_bast_1' => 'nullable|string',
                'ket_ba_pemilik_tl' => 'nullable|string',
                'pejabat_bast_2' => 'nullable|string',
                'pejabat_bast_3' => 'nullable|string',
            ]);

            // Simpan Data ke Model
            $data = new TblPelanggaranAdministrasi();
            $data->fill($validatedData);

            // Simpan array sebagai JSON jika ada
            if (isset($validatedData['id_barang_pelanggaran_administrasi'])) {
                $data->id_barang_pelanggaran_administrasi = json_encode($validatedData['id_barang_pelanggaran_administrasi']);
            }

            // Penyimpanan File
            $fileFields = [
                'permohonan_dokumen_kepabeanan_ppftz' => 'pelanggaran_administrasi/pembuatan_dokumen_ppftz',
                'bukti_penerimaan_negara_ppftz' => 'pelanggaran_administrasi/pembuatan_dokumen_ppftz',
                'dokumen_ppftz' => 'pelanggaran_administrasi/pembuatan_dokumen_ppftz',
                'keputusan_bdn' => 'pelanggaran_administrasi/bdn',
                'bast_bdn' => 'pelanggaran_administrasi/bdn',
                'surat_permohonan_reekspor' => 'pelanggaran_administrasi/reekspor',
                'dokumen_ppftz_reekspor' => 'pelanggaran_administrasi/reekspor',
                'penelitian_dokumen_reekspor' => 'pelanggaran_administrasi/reekspor',
                'penerbitan_spsa' => 'pelanggaran_administrasi/spsa',
                'surat_spsa' => 'pelanggaran_administrasi/spsa',
                'billing_djbc_spsa' => 'pelanggaran_administrasi/spsa',
                'bukti_transaksi_spsa' => 'pelanggaran_administrasi/spsa',
                'dokumen_lartas' => 'pelanggaran_administrasi/dokumen_lartas',
            ];

            foreach ($fileFields as $field => $directory) {
                if ($request->hasFile($field)) {
                    try {
                        $filePath = $request->file($field)->store($directory, 'public');
                        $data->$field = $filePath;
                    } catch (\Exception $e) {
                        Log::error("Gagal mengunggah file $field: " . $e->getMessage());
                        return redirect()->back()->withErrors(["Gagal mengunggah file $field: " . $e->getMessage()]);
                    }
                }
            }

            // Simpan Data ke Database
            try {
                $data->save();
                return redirect()->route('pelanggaran-administrasi.index')->with('success', 'Data Pelanggaran Administrasi berhasil disimpan!');
            } catch (\Exception $e) {
                Log::error('Gagal menyimpan data ke database: ' . $e->getMessage());
                return redirect()->route('pelanggaran-administrasi.index')->withErrors(['error' => 'Terjadi kesalahan dalam menyimpan data: ' . $e->getMessage()]);
            }
        } catch (\Exception $e) {
            Log::error('Kesalahan umum: ' . $e->getMessage());
            return redirect()->route('pelanggaran-administrasi.index')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }




    public function edit($id)
    {
        $pelanggaranadministrasi = TblPelanggaranAdministrasi::where('id', $id)->first();
        if (!$pelanggaranadministrasi) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $penyidikan = TblPenyidikan::where('id_penyidikan', $pelanggaranadministrasi->id_penyidikan_ref)->first();

        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();

        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', $pascapenindakan->id_penindakan_ref)
            ->first();

        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))
            ->get();

        $users = User::all();

        $no_ref = TblNoRef::first();

        $barang = Barang::all();
        $selectedBarangIds = json_decode($pelanggaranadministrasi->id_barang_pelanggaran_administrasi, true) ?? [];

        return view('Tindaklanjut.pelanggaran-administrasi.edit', compact(
            'pelanggaranadministrasi',
            'users',
            'no_ref',
            'penyidikan',
            'pascapenindakan',
            'sbpData',
            'laporanInformasi',
            'selectedBarangIds',
            'barang' // Pastikan variabel barang dikirim ke view
        ));
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'tgl_pelanggaran_administrasi' => 'nullable|date',
                'id_barang_pelanggaran_administrasi' => 'nullable|array',
                'permohonan_dokumen_kepabeanan_ppftz' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'bukti_penerimaan_negara_ppftz' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'dokumen_ppftz' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'keputusan_bdn' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'bast_bdn' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'surat_permohonan_reekspor' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'dokumen_ppftz_reekspor' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'penelitian_dokumen_reekspor' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'penerbitan_spsa' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'surat_spsa' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'billing_djbc_spsa' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'bukti_transaksi_spsa' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
                'dokumen_lartas' => 'nullable|file|mimes:pdf,jpg,jpeg,png',

                'tgl_bast_pemilik' => 'nullable|date',
                'pejabat_bast_1' => 'nullable|string',
                'ket_ba_pemilik_tl' => 'nullable|string',
                'pejabat_bast_2' => 'nullable|string',
                'pejabat_bast_3' => 'nullable|string',
            ]);

            $data = TblPelanggaranAdministrasi::findOrFail($id);
            $data->tgl_pelanggaran_administrasi = $request->tgl_pelanggaran_administrasi;
            $data->tgl_bast_pemilik = $request->tgl_bast_pemilik;
            $data->pejabat_bast_1 = $request->pejabat_bast_1;
            $data->ket_ba_pemilik_tl = $request->ket_ba_pemilik_tl;
            $data->pejabat_bast_2 = $request->pejabat_bast_2;
            $data->pejabat_bast_3 = $request->pejabat_bast_3;
            $data->id_barang_pelanggaran_administrasi = json_encode($request->id_barang_pelanggaran_administrasi);

            $fileFields = [
                'permohonan_dokumen_kepabeanan_ppftz' => 'pelanggaran_administrasi/pembuatan_dokumen_ppftz',
                'bukti_penerimaan_negara_ppftz' => 'pelanggaran_administrasi/pembuatan_dokumen_ppftz',
                'dokumen_ppftz' => 'pelanggaran_administrasi/pembuatan_dokumen_ppftz',

                'keputusan_bdn' => 'pelanggaran_administrasi/bdn',
                'bast_bdn' => 'pelanggaran_administrasi/bdn',

                'surat_permohonan_reekspor' => 'pelanggaran_administrasi/reekspor',
                'dokumen_ppftz_reekspor' => 'pelanggaran_administrasi/reekspor',
                'penelitian_dokumen_reekspor' => 'pelanggaran_administrasi/reekspor',

                'penerbitan_spsa' => 'pelanggaran_administrasi/spsa',
                'surat_spsa' => 'pelanggaran_administrasi/spsa',
                'billing_djbc_spsa' => 'pelanggaran_administrasi/spsa',
                'bukti_transaksi_spsa' => 'pelanggaran_administrasi/spsa',

                'dokumen_lartas' => 'pelanggaran_administrasi/dokumen_lartas',
            ];

            foreach ($fileFields as $field => $directory) {
                if ($request->hasFile($field)) {
                    if (!empty($data->$field) && file_exists(storage_path('app/public/' . $data->$field))) {
                        unlink(storage_path('app/public/' . $data->$field));
                    }

                    try {
                        $filePath = $request->file($field)->store($directory, 'public');
                        $data->$field = $filePath;
                    } catch (\Exception $e) {
                        return redirect()->back()->withErrors(["Gagal mengunggah file $field"]);
                    }
                }
            }

            $data->save();

            return redirect()->route('pelanggaran-administrasi.index')->with('success', 'Data Pelanggaran Administrasi berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('pelanggaran-administrasi.index')->withErrors(['error' => 'Terjadi kesalahan dalam memperbarui data.']);
        }
    }


    public function destroy($id)
    {
        try {
            $data = TblPelanggaranAdministrasi::findOrFail($id);

            $fileFields = [
                'permohonan_dokumen_kepabeanan_ppftz' => 'pelanggaran_administrasi/pembuatan_dokumen_ppftz',
                'bukti_penerimaan_negara_ppftz' => 'pelanggaran_administrasi/pembuatan_dokumen_ppftz',
                'dokumen_ppftz' => 'pelanggaran_administrasi/pembuatan_dokumen_ppftz',
                'keputusan_bdn' => 'pelanggaran_administrasi/bdn',
                'bast_bdn' => 'pelanggaran_administrasi/bdn',
                'surat_permohonan_reekspor' => 'pelanggaran_administrasi/reekspor',
                'dokumen_ppftz_reekspor' => 'pelanggaran_administrasi/reekspor',
                'penelitian_dokumen_reekspor' => 'pelanggaran_administrasi/reekspor',
                'penerbitan_spsa' => 'pelanggaran_administrasi/spsa',
                'surat_spsa' => 'pelanggaran_administrasi/spsa',
                'billing_djbc_spsa' => 'pelanggaran_administrasi/spsa',
                'bukti_transaksi_spsa' => 'pelanggaran_administrasi/spsa',
                'dokumen_lartas' => 'pelanggaran_administrasi/dokumen_lartas',
            ];

            foreach ($fileFields as $field => $directory) {
                if ($data->$field && Storage::exists('public/' . $data->$field)) {
                    Storage::delete('public/' .  $data->$field);
                } else {
                    Log::warning("File tidak ditemukan untuk dihapus", ['path' => 'public/' . $directory . '/' . $data->$field]);
                }
            }


            $data->delete();

            return redirect()->route('pelanggaran-administrasi.index')->with('success', 'Data Pelanggaran Administrasi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('pelanggaran-administrasi.index')->withErrors(['error' => 'Terjadi kesalahan dalam menghapus data.']);
        }
    }



    public function print_dokumen($id)
    {
        $pelanggaranadministrasi = TblPelanggaranAdministrasi::findOrFail($id);

        $dokumenLinks = [];
        $missingDokumen = [];

        if ($pelanggaranadministrasi->jenis_pelanggaran_administrasi === 'Pembuatan Dokumen PPFTZ-01') {
            $dokumenLinks = [
                'Permohonan Dokumen Kepabeanan' => $pelanggaranadministrasi->permohonan_dokumen_kepabeanan_ppftz,
                'Bukti Penerimaan Negara' => $pelanggaranadministrasi->bukti_penerimaan_negara_ppftz,
                'Dokumen PPFTZ' => $pelanggaranadministrasi->dokumen_ppftz,
            ];
        } elseif ($pelanggaranadministrasi->jenis_pelanggaran_administrasi === 'Barang Yang Dikuasai Negara (BDN)') {
            $dokumenLinks = [
                'Keputusan BDN' => $pelanggaranadministrasi->keputusan_bdn,
                'BAST BDN' => $pelanggaranadministrasi->bast_bdn,
            ];
        } elseif ($pelanggaranadministrasi->jenis_pelanggaran_administrasi === 'Re-Ekspor/Pembatalan Dokumen') {
            $dokumenLinks = [
                'Surat Permohonan Re-ekspor' => $pelanggaranadministrasi->surat_permohonan_reekspor,
                'Dokumen PPFTZ Re-ekspor' => $pelanggaranadministrasi->dokumen_ppftz_reekspor,
                'Penelitian Dokumen Re-ekspor' => $pelanggaranadministrasi->penelitian_dokumen_reekspor,
            ];
        } elseif ($pelanggaranadministrasi->jenis_pelanggaran_administrasi === 'Sanksi Administrasi SPSA') {
            $dokumenLinks = [
                'Penerbitan SPSA' => $pelanggaranadministrasi->penerbitan_spsa,
                'Surat SPSA' => $pelanggaranadministrasi->surat_spsa,
                'Billing DJBC SPSA' => $pelanggaranadministrasi->billing_djbc_spsa,
                'Bukti Transaksi SPSA' => $pelanggaranadministrasi->bukti_transaksi_spsa,
            ];
        } elseif ($pelanggaranadministrasi->jenis_pelanggaran_administrasi === 'Pemenuhan Dokumen lartas') {
            $dokumenLinks = [
                'Dokumen Lartas' => $pelanggaranadministrasi->dokumen_lartas,
            ];
        }

        foreach ($dokumenLinks as $name => $path) {
            if (!$path) {
                $missingDokumen[] = $name;
                unset($dokumenLinks[$name]);
            } else {
                $dokumenLinks[$name] = asset('storage/' . $path);
            }
        }

        return response()->json([
            'dokumenLinks' => array_values($dokumenLinks),
            'missingDokumen' => $missingDokumen,
        ]);
    }



    public function print_bast_pemilik_tindak_lanjut($id)
    {
        $pelanggaran = TblPelanggaranAdministrasi::with([
            'pascapenindakan',
            'penindakan',
            'laporanInformasi'
        ])->findOrFail($id);

        Carbon::setLocale('id');

        $tglBastPemilikOriginal = $pelanggaran->tgl_ba_serah_terima_pemilik_tindak_lanjut ?? null;
        $data['tgl_bast_pemilik'] = $tglBastPemilikOriginal;

        $pascapenindakan = $pelanggaran->pascapenindakan;
        $penindakans = $pascapenindakan ? $pascapenindakan->penindakans : collect();
        $formattedPenindakans = [];

        foreach ($penindakans as $penindakan) {
            $penindakanArray = $penindakan->toArray();
            $formattedPenindakan = $penindakanArray;

            $formattedPenindakan['tgl_sbp'] = $penindakanArray['tgl_sbp'] ?? null;

            $pejabatKeys = [
                'pejabat_bast_1',
                'pejabat_bast_2',
                'pejabat_bast_3',
            ];

            foreach ($pejabatKeys as $key) {
                if ($pelanggaran && $pelanggaran->$key) {
                    $pejabat = $pelanggaran->pejabat($key)->first();
                    $formattedPenindakan[$key . '_nama'] = $pejabat->nama_admin ?? '';
                    $formattedPenindakan[$key . '_pangkat'] = $pejabat->pangkat ?? '';
                    $formattedPenindakan[$key . '_jabatan'] = $pejabat->jabatan ?? '';
                    $formattedPenindakan[$key . '_nip'] = $pejabat->nip ?? '';
                } else {
                    $formattedPenindakan[$key . '_nama'] = '';
                    $formattedPenindakan[$key . '_pangkat'] = '';
                    $formattedPenindakan[$key . '_jabatan'] = '';
                    $formattedPenindakan[$key . '_nip'] = '';
                }
            }

            $formattedPenindakans[] = $formattedPenindakan;
        }

        $data = $pelanggaran->toArray();
        foreach ($formattedPenindakans as $penindakan) {
            foreach ($penindakan as $key => $value) {
                $data[$key] = $value ?? '-';
            }
        }

        $data['penindakans'] = $formattedPenindakans;
        $data = array_map(fn($value) => $value ?? '-', $data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Tindaklanjut/pelanggaran-administrasi/surat-bast-pemilik.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        if (!empty($data['tgl_bast_pemilik']) && $this->isValidDate($data['tgl_bast_pemilik'])) {
            $tglBastPemilik = Carbon::parse($data['tgl_bast_pemilik']);
            $namaHari = $tglBastPemilik->translatedFormat('l');

            $formatter = new \NumberFormatter('id', \NumberFormatter::SPELLOUT);
            $tanggal = $formatter->format($tglBastPemilik->day);
            $bulan = $tglBastPemilik->translatedFormat('F');
            $tahun = $formatter->format($tglBastPemilik->year);

            $data['formatBastPemilik'] = ucwords("$namaHari tanggal $tanggal bulan $bulan tahun $tahun");
        } else {
            $data['formatBastPemilik'] = '';
        }


        $templateProcessor->setValue('formatBastPemilik', $data['formatBastPemilik'] ?? '-');

        $fileName = "Dokumen_Tindak_Lanjut_Berita_Acara_Serah_Terima_Pemilik_{$penindakan['nama_saksi']}.docx";
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

        Carbon::setLocale('id');

        $dateFields = [
            'tempus_lp',
            ''
        ];

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
            90 => 'sembilan puluh'
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
