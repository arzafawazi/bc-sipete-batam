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
use App\Models\TblBaSegelCtp;

class BaSegelCtpController extends Controller
{
    public function index()
    {
        $segelctp = TblBaSegelCtp::select('id', 'tgl_ba_segel_ctp', 'no_ba_segel_ctp')->get();

        $segelctp = $segelctp->map(function ($item) {
            $item->tgl_ba_segel_ctp = $this->formatDates(['tgl_ba_segel_ctp' => $item->tgl_ba_segel_ctp])['tgl_ba_segel_ctp'];
            return $item;
        });
        // dd($segelctp);

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
        return view('Pengawasanlain.ba-segel-ctp.index', compact('segelctp', 'pascapenindakan', 'sbpData', 'penyidikan'));
    }

    public function create(Request $request)
    {
        $id_penyidikan = $request->query('id_penyidikan');

        // Ambil data penyidikan berdasarkan ID yang dikirim
        $penyidikan = TblPenyidikan::where('id_penyidikan', $id_penyidikan)->first();
        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();

        $sbpData = TblSbp::with('laporanInformasi')->where('id_penindakan', $pascapenindakan->id_penindakan_ref)->first();

        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))->get();

        $users = User::all();
        $no_ref = TblNoRef::first();

        return view(
            'Pengawasanlain.ba-segel-ctp.create',
            compact(
                'users',
                'no_ref',
                'id_penyidikan',
                'pascapenindakan',
                'penyidikan', // Menambahkan data TblPenyidikan
                'sbpData', // Menambahkan data TblSbp
                'laporanInformasi', // Menambahkan data TblLaporanInformasi
            ),
        );
    }

    public function store(Request $request)
    {
        TblBaSegelCtp::create($request->all());
        $no_ref = TblNoRef::first();
        $no_ref->no_ba_segel_ctp += 1;
        $no_ref->save();

        return redirect()->route('ba-segel-ctp.index')->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');
    }

    public function edit($id)
    {
        $segelctp = TblBaSegelCtp::where('id', $id)->first();
        if (!$segelctp) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $penyidikan = TblPenyidikan::where('id_penyidikan', $segelctp->id_penyidikan_ref)->first();

        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();

        $sbpData = TblSbp::with('laporanInformasi')->where('id_penindakan', $pascapenindakan->id_penindakan_ref)->first();

        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))->get();

        $users = User::all();

        $no_ref = TblNoRef::first();

        return view('Pengawasanlain.ba-segel-ctp.edit', compact('segelctp', 'users', 'no_ref', 'penyidikan', 'pascapenindakan', 'sbpData', 'laporanInformasi'));
    }

    public function update($id)
    {
        $data = request()->all();

        $item = TblBaSegelCtp::find($id);
        if ($item) {
            $item->update($data);
            return redirect()->route('ba-segel-ctp.index')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->route('ba-segel-ctp.index')->with('error', 'Data tidak ditemukan.');
    }

    public function destroy($id)
    {
        $segelctp = TblBaSegelCtp::find($id);
        if ($segelctp) {
            $segelctp->delete();
            return redirect()->route('ba-segel-ctp.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('ba-segel-ctp.index')->with('error', 'Data tidak ditemukan.');
    }

    public function print_ba_segel_ctp($id)
    {
        $segelctp = TblBaSegelCtp::where('id', $id)->first();
        if (!$segelctp) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        $penyidikan = TblPenyidikan::where('id_penyidikan', $segelctp->id_penyidikan_ref)->first();

        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', optional($penyidikan)->id_pasca_penindakan_ref)->first();

        $sbpData = TblSbp::with('laporanInformasi')->where('id_penindakan', optional($pascapenindakan)->id_penindakan_ref)->first();

        $laporan = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->id_pra_penindakan_ref)->first(['no_print', 'tgl_print', 'id_pejabat_sp_2', 'skema_penindakan_perintah']);

        // Inisialisasi array data di awal
        $data = [];

        $data['no_print'] = $laporan->no_print ?? '';
        $data['tgl_print'] = $laporan->tgl_print ?? '';
        $tglprint = $laporan->tgl_print;

        // Format tgl_print menggunakan fungsi formatDates
        if (!empty($laporan->tgl_print)) {
            $formattedTglPrint = $this->formatDates(['tgl_print' => $laporan->tgl_print]);
            $data['tgl_print_formatted'] = $formattedTglPrint['tgl_print'] ?? $data['tgl_print'];
            // Jika Anda ingin menggantikan nilai asli dengan yang sudah diformat
            $data['tgl_print'] = $formattedTglPrint['tgl_print'] ?? $data['tgl_print'];
        }

        if (!empty($tglprint)) {
            $tahunprint = date('Y', strtotime($tglprint));
        } else {
            $tahunprint = '-';
        }
        $data['tahun_print'] = $tahunprint ?? '';

        if (!empty($laporan->skema_penindakan_perintah)) {
            $tipePenindakan = strtoupper($laporan->skema_penindakan_perintah);
            $noPrint = $data['no_print'];
            $tahunPrint = $data['tahun_print'];

            switch ($tipePenindakan) {
                case 'MANDIRI':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/MANDIRI/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/KPU.206/{$tahunPrint}";
                    break;
                case 'PERBANTUAN/BERSAMA INSTANSI LAIN':
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/PERBANTUAN/BERSAMA INSTANSI LAIN/KPU.206/{$tahunPrint}";
                    break;
                default:
                    $data['formatPrint'] = "Nomor PRIN-{$noPrint}/UNKNOWN/KPU.206/{$tahunPrint}";
                    break;
            }
        } else {
            $data['formatPrint'] = "Nomor PRIN-{$data['no_print']}/UNKNOWN/KPU.206/{$data['tahun_print']}";
        }

        // Tambah id_pejabat_sp2 (tanpa underscore) untuk template
        $data['id_pejabat_sp2'] = $laporan->id_pejabat_sp_2 ?? null;

        if ($laporan && $laporan->id_pejabat_sp_2) {
            $sbpData->id_pejabat_sp_2 = $laporan->id_pejabat_sp_2;
        }

        // Hapus dd() yang menghentikan eksekusi
        // dd($laporan);

        Carbon::setLocale('id');

        $tglBaSegelOriginal = $segelctp->tgl_ba_segel_ctp ?? null;
        // Gabungkan data yang sudah ada dengan hasil formatDates
        $formattedData = $this->formatDates(array_diff_key($segelctp->toArray(), ['tgl_ba_segel_ctp' => '']));
        $data = array_merge($data, $formattedData); // Gabungkan data, jangan timpa
        $data['tgl_ba_segel_ctp'] = $tglBaSegelOriginal;
        $data['tgl_ba_segel_ctpp'] = $this->formatDates(['tgl_ba_segel_ctp' => $tglBaSegelOriginal])['tgl_ba_segel_ctp'] ?? '-';

        $pejabatKeys = ['pejabat_pertama_ctp', 'pejabat_kedua_ctp', 'id_pejabat_sp_2'];

        foreach ($pejabatKeys as $key) {
            if ($key === 'id_pejabat_sp_2') {
                // Khusus untuk id_pejabat_sp_2, ambil dari laporan
                $pejabatId = $laporan->id_pejabat_sp_2 ?? null;
                if ($pejabatId) {
                    // Gunakan model yang sesuai untuk akses data pejabat
                    $pejabat = $laporan->pejabat($key)->first(); // Sesuaikan nama model
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
            } elseif ($segelctp->$key) {
                // Untuk pejabat lain, gunakan data dari segelctp
                $pejabat = $segelctp->pejabat($key)->first();
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

        if ($sbpData) {
            $sbpArray = $sbpData->toArray();
            $formattedSbpData = $this->formatDates($sbpArray);

            $data['nama_jenis_sarkut'] = $formattedSbpData['nama_jenis_sarkut'] ?? '-';
            $data['kapasitas_muatan'] = $formattedSbpData['kapasitas_muatan'] ?? '-';
            $data['no_polisi'] = $formattedSbpData['no_polisi'] ?? '-';
            $data['jumlah_barang'] = $formattedSbpData['jumlah_barang'] ?? '-';
            $data['jenis_barang'] = $formattedSbpData['jenis_barang'] ?? '-';
            $data['jenis_no_tgl_dok'] = $formattedSbpData['jenis_no_tgl_dok'] ?? '-';
            $data['tgl_dokumen'] = $formattedSbpData['tgl_dokumen'] ?? '-';
            $data['nama_saksi'] = $formattedSbpData['nama_saksi'] ?? '-';
            $data['ttl_saksi'] = $formattedSbpData['ttl_saksi'] ?? '-';
            $data['kewarganegaraan_saksi'] = $formattedSbpData['kewarganegaraan_saksi'] ?? '-';
            $data['no_identitas_saksi'] = $formattedSbpData['no_identitas_saksi'] ?? '-';
            $data['bendera'] = $formattedSbpData['bendera'] ?? '-';
            $data['pengemudi'] = $formattedSbpData['pengemudi'] ?? '-';
            $data['no_identitas_pengemudi'] = $formattedSbpData['no_identitas_pengemudi'] ?? '-';
            $data['jumlah_jenis_ukuran_no'] = $formattedSbpData['jumlah_jenis_ukuran_no'] ?? '-';
            $data['no_identitas_pemilik'] = $formattedSbpData['no_identitas_pemilik'] ?? '-';
            $data['alamat_bangunan'] = $formattedSbpData['alamat_bangunan'] ?? '-';
            $data['no_bangunan'] = $formattedSbpData['no_bangunan'] ?? '-';
            $data['nama_pemilik_bangunan'] = $formattedSbpData['nama_pemilik_bangunan'] ?? '-';
            $data['no_identitas_pemilik_bangunan'] = $formattedSbpData['no_identitas_pemilik_bangunan'] ?? '-';
            $data['jenis_segel_ba_segel'] = $formattedSbpData['jenis_segel_ba_segel'] ?? '-';
            $data['jumlah_segel_ba_segel'] = $formattedSbpData['jumlah_segel_ba_segel'] ?? '-';
            $data['nomor_segel_ba_segel'] = $formattedSbpData['nomor_segel_ba_segel'] ?? '-';
            $data['peletakan_segel_ba_segel'] = $formattedSbpData['peletakan_segel_ba_segel'] ?? '-';
            $data['pemilik'] = $formattedSbpData['pemilik'] ?? '-';
            $data['no_flight'] = $formattedSbpData['no_flight'] ?? '-';
            $data['kapasitas_muatan'] = $formattedSbpData['kapasitas_muatan'] ?? '-';
        } else {
            $data['nama_jenis_sarkut'] = '-';
            $data['kapasitas_muatan'] = '-';
            $data['no_polisi'] = '-';
            $data['jumlah_barang'] = '-';
            $data['jenis_barang'] = '-';
            $data['jenis_no_tgl_dok'] = '-';
            $data['tgl_dokumen'] = '-';
            $data['nama_saksi'] = '-';
            $data['ttl_saksi'] = '-';
            $data['kewarganegaraan_saksi'] = '-';
            $data['no_identitas_saksi'] = '-';
            $data['bendera'] = '-';
            $data['pengemudi'] = '-';
            $data['no_identitas_pengemudi'] = '-';
            $data['jumlah_jenis_ukuran_no'] = '-';
            $data['no_identitas_pemilik'] = '-';
            $data['alamat_bangunan'] = '-';
            $data['no_bangunan'] = '-';
            $data['nama_pemilik_bangunan'] = '-';
            $data['no_identitas_pemilik_bangunan'] = '-';
            $data['jenis_segel_ba_segel'] = '-';
            $data['jumlah_segel_ba_segel'] = '-';
            $data['nomor_segel_ba_segel'] = '-';
            $data['peletakan_segel_ba_segel'] = '-';
            $data['pemilik'] = '-';
            $data['kapasitas_muatan'] = '-';
        }

        if (!empty($data['tgl_ba_segel_ctp']) && $this->isValidDate($data['tgl_ba_segel_ctp'])) {
            $tglBastInstansi = Carbon::parse($data['tgl_ba_segel_ctp']);
            $namaHari = $tglBastInstansi->translatedFormat('l');
            $tanggal = $tglBastInstansi->translatedFormat('d');
            $bulan = $tglBastInstansi->translatedFormat('F');
            $tahun = $tglBastInstansi->translatedFormat('Y');

            $data['formatBaCtp'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBaCtp'] = '';
        }

        $tglctp = $segelctp->tgl_ba_segel_ctp;
        $tahunctp = !empty($tglctp) ? date('Y', strtotime($tglctp)) : '-';
        $data['tahun_ctp'] = $tahunctp;

        $data = array_map(fn($value) => $value ?? '-', $data);

        // Debugging - uncomment jika perlu
        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Pengawasanlainnya/ba-segel-ctp.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $fileName = "Dokumen_Pengawasan_Lain_Berita_Acara_Segel_CTP_No_{$segelctp->no_ba_segel_ctp}.docx";
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
