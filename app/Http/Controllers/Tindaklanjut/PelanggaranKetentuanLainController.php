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
use App\Models\TblPelanggaranKetentuanLain;

class PelanggaranKetentuanLainController extends Controller
{
    public function index()
    {
        $pelanggaranlain = TblPelanggaranKetentuanLain::select('id', 'tgl_bast_instansi_lain_pkl')->get();


        $pelanggaranlain = $pelanggaranlain->map(function ($item) {
            $item->tgl_bast_instansi_lain_pkl = $this->formatDates(['tgl_bast_instansi_lain_pkl' => $item->tgl_bast_instansi_lain_pkl])['tgl_bast_instansi_lain_pkl'];
            return $item;
        });
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

        // dd($sbpData);

        return view('Tindaklanjut.pelanggaran-ketentuan-lain.index', compact('pelanggaranlain', 'pascapenindakan', 'sbpData', 'penyidikan'));
    }


    public function create(Request $request)
    {
        $id_penyidikan = $request->query('id_penyidikan');

        // Ambil data penyidikan berdasarkan ID yang dikirim
        $penyidikan = TblPenyidikan::where('id_penyidikan', $id_penyidikan)->first();
        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();

        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', $pascapenindakan->id_penindakan_ref)
            ->first();


        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))
            ->get();


        $users = User::all();
        $no_ref = TblNoRef::first();


        return view('Tindaklanjut.pelanggaran-ketentuan-lain.create', compact(
            'users',
            'no_ref',
            'id_penyidikan',
            'pascapenindakan',
            'penyidikan', // Menambahkan data TblPenyidikan
            'sbpData', // Menambahkan data TblSbp
            'laporanInformasi', // Menambahkan data TblLaporanInformasi
        ));
    }

    public function store(Request $request)
    {
        TblPelanggaranKetentuanLain::create($request->all());
        $no_ref = TblNoRef::first();
        $no_ref->no_bast_instansi_lain_pkl += 1;
        $no_ref->save();

        return redirect()->route('pelanggaran-ketentuan-lain.index')->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');
    }


    public function edit($id)
    {
        $pelanggaranlain = TblPelanggaranKetentuanLain::where('id', $id)->first();
        if (!$pelanggaranlain) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $penyidikan = TblPenyidikan::where('id_penyidikan', $pelanggaranlain->id_penyidikan_ref)->first();

        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', $penyidikan->id_pasca_penindakan_ref)->first();

        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', $pascapenindakan->id_penindakan_ref)
            ->first();

        $laporanInformasi = TblLaporanInformasi::where('id_pra_penindakan', $sbpData->pluck('id_pra_penindakan_ref'))
            ->get();

        $users = User::all();

        $no_ref = TblNoRef::first();

        return view('Tindaklanjut.pelanggaran-ketentuan-lain.edit', compact(
            'pelanggaranlain',
            'users',
            'no_ref',
            'penyidikan',
            'pascapenindakan',
            'sbpData',
            'laporanInformasi',
        ));
    }


    public function update($id)
    {
        $data = request()->all();

        $item = TblPelanggaranKetentuanLain::find($id);
        if ($item) {
            $item->update($data);
            return redirect()->route('pelanggaran-ketentuan-lain.index')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->route('pelanggaran-ketentuan-lain.index')->with('error', 'Data tidak ditemukan.');
    }

    public function destroy($id)
    {
        $pelanggaranlain = TblPelanggaranKetentuanLain::find($id);
        if ($pelanggaranlain) {
            $pelanggaranlain->delete();
            return redirect()->route('pelanggaran-ketentuan-lain.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('pelanggaran-ketentuan-lain.index')->with('error', 'Data tidak ditemukan.');
    }


    public function print_surat_bast_instansi_lain_pkl($id)
    {
        $pelanggaranlain = TblPelanggaranKetentuanLain::where('id', $id)->first();
        if (!$pelanggaranlain) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        $penyidikan = TblPenyidikan::where('id_penyidikan', $pelanggaranlain->id_penyidikan_ref)->first();

        $pascapenindakan = TblPascaPenindakan::where('id_pasca_penindakan', optional($penyidikan)->id_pasca_penindakan_ref)->first();

        $sbpData = TblSbp::with('laporanInformasi')
            ->where('id_penindakan', optional($pascapenindakan)->id_penindakan_ref)
            ->first();

        Carbon::setLocale('id');

        $tglBastinstansiOriginal = $pelanggaranlain->tgl_bast_instansi_lain_pkl ?? null;
        $data = $this->formatDates(array_diff_key($pelanggaranlain->toArray(), ['tgl_bast_instansi_lain_pkl' => '']));
        $data['tgl_bast_instansi_lain_pkl'] = $tglBastinstansiOriginal;
        $data['tgl_bast_instansi_lain_pkll'] = $this->formatDates(['tgl_bast_instansi_lain_pkl' => $tglBastinstansiOriginal])['tgl_bast_instansi_lain_pkl'] ?? '-';

        $pejabatKeys = [
            'pejabat_menyerahkan_bast_instansi_pkl',
            'saksi_pertama_bast_instansi_pkl',
            'saksi_kedua_bast_instansi_pkl',
        ];

        foreach ($pejabatKeys as $key) {
            if ($pelanggaranlain->$key) {
                $pejabat = $pelanggaranlain->pejabat($key)->first();
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
        }

        if (!empty($data['tgl_bast_instansi_lain_pkl']) && $this->isValidDate($data['tgl_bast_instansi_lain_pkl'])) {
            $tglBastInstansi = Carbon::parse($data['tgl_bast_instansi_lain_pkl']);
            $namaHari = $tglBastInstansi->translatedFormat('l');
            $tanggal = $tglBastInstansi->translatedFormat('d');
            $bulan = $tglBastInstansi->translatedFormat('F');
            $tahun = $tglBastInstansi->translatedFormat('Y');

            $data['formatBastInstansi'] = "$namaHari tanggal $tanggal bulan $bulan tahun $tahun";
        } else {
            $data['formatBastInstansi'] = '';
        }

        $tglinstansi = $pelanggaranlain->tgl_bast_instansi_lain_pkl;
        $tahuninstansi = !empty($tglinstansi) ? date('Y', strtotime($tglinstansi)) : '-';
        $data['tahun_instansi'] = $tahuninstansi;

        $data = array_map(fn($value) => $value ?? '-', $data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Tindaklanjut/pelanggaran-ketentuan-lain/surat-bast-instansi-lain.docx'));
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        // dd($data);

        $fileName = "Dokumen_Tindak_Lanjut_Berita_Acara_Serah_Terima_Instansi_Lain_Nomor_{$pelanggaranlain->no_bast_instansi_lain_pkl}.docx";
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
