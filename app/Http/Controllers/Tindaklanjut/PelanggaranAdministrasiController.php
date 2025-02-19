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

            $request->validate([
                'tgl_pelanggaran_administrasi' => 'nullable|date',
                'jenis_pelanggaran_administrasi' => 'nullable|string',
                'nama_barang_pelanggaran_administrasi' => 'required|array',
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
            ]);


            $data = new TblPelanggaranAdministrasi();
            $data->id_penyidikan_ref = $request->id_penyidikan_ref;
            $data->id_pelanggaran_administrasi = $request->id_pelanggaran_administrasi;
            $data->tgl_pelanggaran_administrasi = $request->tgl_pelanggaran_administrasi;
            $data->jenis_pelanggaran_administrasi = $request->jenis_pelanggaran_administrasi;
            $data->nama_barang_pelanggaran_administrasi = json_encode($request->nama_barang_pelanggaran_administrasi);



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
                        return redirect()->back()->withErrors(["Gagal mengunggah file $field"]);
                    }
                }
            }


            $data->save();


            return redirect()->route('pelanggaran-administrasi.index')->with('success', 'Data Pelanggaran Administrasi berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->route('pelanggaran-administrasi.index')->withErrors(['error' => 'Terjadi kesalahan dalam menyimpan data.']);
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
        $selectedBarangIds = json_decode($pelanggaranadministrasi->nama_barang_pelanggaran_administrasi, true) ?? [];

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
                'nama_barang_pelanggaran_administrasi' => 'required|array',
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
            ]);

            // Cari data yang akan diupdate
            $data = TblPelanggaranAdministrasi::findOrFail($id);
            $data->tgl_pelanggaran_administrasi = $request->tgl_pelanggaran_administrasi;
            $data->nama_barang_pelanggaran_administrasi = json_encode($request->nama_barang_pelanggaran_administrasi);

            // Daftar field file
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