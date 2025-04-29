<?php

namespace App\Http\Controllers\Pengawasanlain;

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
use App\Models\TblPelanggaranKetentuanLain;
use App\Models\TblBastSenjataApi;
use App\Models\TblSenjataApi;
use App\Models\TblPemasukanAmunisiSenjataApi;

class BastSenjataApiController extends Controller
{
    public function index()
    {
        $senjataapi = TblBastSenjataApi::select('id', 'tgl_bast_senjata_api', 'no_bast_senjata_api')->get();

        $senjataapi = $senjataapi->map(function ($item) {
            $item->tgl_bast_senjata_api = $this->formatDates(['tgl_bast_senjata_api' => $item->tgl_bast_senjata_api])['tgl_bast_senjata_api'];
            return $item;
        });
        // dd($senjataapi);

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

        // dd($sbpData);
        return view('Pengawasanlain.bast-senjata-api.index', compact('senjataapi', 'pascapenindakan', 'sbpData', 'penyidikan'));
    }

    public function create(Request $request)
    {
        // Ambil data penyidikan berdasarkan ID yang dikirim
        // $penyidikan = TblPenyidikan::where('id_penyidikan', $id_penyidikan)->first();
        // $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();

        // $sbpData = TblSbp::with('laporanInformasi')->where('id_penindakan', $pascapenindakan->id_penindakan_ref)->first();

        // $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))->get();

        $users = User::all();
        $senjataapi = TblSenjataApi::all();
        $senjataapiedit = TblSenjataApi::all();
        $no_ref = TblNoRef::first();

        return view('Pengawasanlain.bast-senjata-api.create', compact('users', 'no_ref', 'senjataapi', 'senjataapiedit'));
    }

    public function store(Request $request)
    {
        TblBastSenjataApi::create($request->except(['kategori_bast', 'senjata_api', 'jenis_amunisi', 'kaliber_amunisi', 'jumlah_amunisi']));

        $no_ref = TblNoRef::first();
        $no_ref->no_bast_senjata_api += 1;
        $no_ref->save();

        return redirect()->route('bast-senjata-api.index')->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');
    }

    public function edit($id)
    {
        $senjataapipemasukan = TblBastSenjataApi::where('id', $id)->first();
        if (!$senjataapipemasukan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $users = User::all();
        $no_ref = TblNoRef::first();
        $senjataapi = TblSenjataApi::all();
        $senjataapiedit = TblSenjataApi::all();

        return view('Pengawasanlain.bast-senjata-api.edit', compact('senjataapipemasukan', 'users', 'no_ref', 'senjataapi', 'senjataapiedit'));
    }

    public function update($id)
    {
        $data = request()->except(['kategori_bast', 'senjata_api', 'jenis_amunisi', 'kaliber_amunisi', 'jumlah_amunisi']);

        $item = TblBastSenjataApi::find($id);
        if ($item) {
            $item->update($data);
            return redirect()->route('bast-senjata-api.index')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->route('bast-senjata-api.index')->with('error', 'Data tidak ditemukan.');
    }

    public function destroy($id)
    {
        $senjataapi = TblBastSenjataApi::find($id);
        if ($senjataapi) {
            $senjataapi->delete();
            return redirect()->route('bast-senjata-api.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('bast-senjata-api.index')->with('error', 'Data tidak ditemukan.');
    }

    public function print_bast_senjata_api($id)
    {
        $senjataapi = TblBastSenjataApi::where('id', $id)->first();
        if (!$senjataapi) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        // Inisialisasi array data di awal
        $data = [];

        // Hapus dd() yang menghentikan eksekusi
        // dd($laporan);

        Carbon::setLocale('id');

        $tglBaSegelOriginal = $senjataapi->tgl_bast_senjata_api ?? null;
        // Gabungkan data yang sudah ada dengan hasil formatDates
        $formattedData = $this->formatDates(array_diff_key($senjataapi->toArray(), ['tgl_bast_senjata_api' => '']));
        $data = array_merge($data, $formattedData); // Gabungkan data, jangan timpa
        $data['tgl_bast_senjata_api'] = $tglBaSegelOriginal;
        $data['tgl_bast_senjata_apii'] = $this->formatDates(['tgl_bast_senjata_api' => $tglBaSegelOriginal])['tgl_bast_senjata_api'] ?? '-';

        $pejabatKeys = ['pejabat_pertama_bast_senjata_api', 'pejabat_kedua_bast_senjata_api', 'pejabat_saksi_bast_senjata_api'];

        foreach ($pejabatKeys as $key) {
            if ($key === 'id_pejabat_sp_2') {
                // Khusus untuk id_pejabat_sp_2, ambil dari laporan
                $pejabatId = $laporan->id_pejabat_sp_2 ?? null;
                if ($pejabatId) {
                    // Gunakan model yang sesuai untuk akses data pejabat
                    $pejabat = $senjataapi->pejabat($key)->first(); // Sesuaikan nama model
                    $data[$key . '_nama'] = $pejabat->nama_admin ?? '-';
                    $data[$key . '_pangkat'] = $pejabat->pangkat ?? '-';
                    $data[$key . '_jabatan'] = $pejabat->jabatan ?? '-';
                    $data[$key . '_nip'] = $pejabat->nip ?? '-';

                    // Tambahkan versi tanpa underscore untuk template
                    $data['id_pejabat_sp2_nama'] = $pejabat->nama_admin ?? '-';
                    $data['id_pejabat_sp2_pangkat'] = $pejabat->pangkat ?? '-';
                    $data['id_pejabat_sp2_jabatan'] = $pejabat->jabatan ?? '-';
                    $data['id_pejabat_sp2_nip'] = $pejabat->nip ?? '-';
                } else {
                    $data[$key . '_nama'] = '-';
                    $data[$key . '_pangkat'] = '-';
                    $data[$key . '_jabatan'] = '-';
                    $data[$key . '_nip'] = '-';

                    // Tambahkan versi tanpa underscore untuk template
                    $data['id_pejabat_sp2_nama'] = '-';
                    $data['id_pejabat_sp2_pangkat'] = '-';
                    $data['id_pejabat_sp2_jabatan'] = '-';
                    $data['id_pejabat_sp2_nip'] = '-';
                }
            } elseif ($senjataapi->$key) {
                // Untuk pejabat lain, gunakan data dari senjataapi
                $pejabat = $senjataapi->pejabat($key)->first();
                $data[$key . '_nama'] = $pejabat->nama_admin ?? '-';
                $data[$key . '_pangkat'] = $pejabat->pangkat ?? '-';
                $data[$key . '_jabatan'] = $pejabat->jabatan ?? '-';
                $data[$key . '_nip'] = $pejabat->nip ?? '-';
            } else {
                $data[$key . '_nama'] = '-';
                $data[$key . '_pangkat'] = '-';
                $data[$key . '_jabatan'] = '-';
                $data[$key . '_nip'] = '-';
            }
        }

        if (!empty($data['tgl_bast_senjata_api']) && $this->isValidDate($data['tgl_bast_senjata_api'])) {
            $tgl = Carbon::parse($data['tgl_bast_senjata_api']);

            $namaHari = $tgl->translatedFormat('l') . ' ini';
            $tanggalHuruf = $this->terbilang((int) $tgl->translatedFormat('d'));
            $bulan = $tgl->translatedFormat('F');
            $tahunHuruf = $this->terbilang((int) $tgl->translatedFormat('Y'));

            $data['formatBastSenjataApi'] = "$namaHari tanggal $tanggalHuruf bulan $bulan tahun $tahunHuruf";
        } else {
            $data['formatBastSenjataApi'] = '';
        }

        $tglsenjata = $senjataapi->tgl_bast_senjata_api;
        $tahunsenjata = !empty($tglsenjata) ? date('Y', strtotime($tglsenjata)) : '-';
        $data['tahun_senjata'] = $tahunsenjata;

        $data = array_map(fn($value) => $value ?? '-', $data);

        // Debugging - uncomment jika perlu
        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Pengawasanlainnya/bast-senjata-api.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $pemasukanData = TblPemasukanAmunisiSenjataApi::where('id_bast_senjata_api', $senjataapi->id_bast_senjata_api)->get();

        $rowsSenjata = [];
        $rowsAmunisi = [];

        foreach ($pemasukanData as $item) {
            if (strtolower($item->kategori_bast) === 'senjata') {
                // Misal format: Senapan Semi Otomatis SBC.1 | AH. CZ000610 | 222mm | Febri Ramadhoni Saputra
                $parts = array_map('trim', explode('|', $item->senjata_api));
                $pemilikNama = $parts[3] ?? '-';
                $user = User::where('nama_admin', $pemilikNama)->first();

                $rowsSenjata[] = [
                    'jenis_senjata' => $parts[0] ?? '-',
                    'nomor_seri' => $parts[1] ?? '-',
                    'kaliber_senjata' => $parts[2] ?? '-',
                    'pemilik' => $pemilikNama,
                    'nip_pemilik' => $user->nip ?? '-',
                ];
            } elseif (strtolower($item->kategori_bast) === 'amunisi') {
                $rowsAmunisi[] = [
                    'jenis_amunisi' => $item->jenis_amunisi ?? '-',
                    'kaliber_amunisi' => $item->kaliber_amunisi ?? '-',
                    'jumlah_amunisi' => $item->jumlah_amunisi ?? '-',
                ];
            }
        }

        // Clone dan set data senjata
        if (count($rowsSenjata)) {
            $templateProcessor->cloneRowAndSetValues('jenis_senjata', $rowsSenjata);
        }

        // Clone dan set data amunisi
        if (count($rowsAmunisi)) {
            $templateProcessor->cloneRowAndSetValues('jenis_amunisi', $rowsAmunisi);
        }

        $fileName = "Dokumen_Pengawasan_Lain_BAST_Senjata_Api_NO_{$senjataapi->no_bast_senjata_api}.docx";
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

    public function terbilang($angka)
    {
        $angka = abs($angka);
        $baca = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];

        if ($angka < 12) {
            return $baca[$angka];
        } elseif ($angka < 20) {
            return $baca[$angka - 10] . ' Belas';
        } elseif ($angka < 100) {
            return $baca[intval($angka / 10)] . ' Puluh ' . $baca[$angka % 10];
        } elseif ($angka < 200) {
            return 'Seratus ' . $this->terbilang($angka - 100);
        } elseif ($angka < 1000) {
            return $baca[intval($angka / 100)] . ' Ratus ' . $this->terbilang($angka % 100);
        } elseif ($angka < 2000) {
            return 'Seribu ' . $this->terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            return $this->terbilang(intval($angka / 1000)) . ' Ribu ' . $this->terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            return $this->terbilang(intval($angka / 1000000)) . ' Juta ' . $this->terbilang($angka % 1000000);
        } else {
            return 'Terlalu besar';
        }
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
