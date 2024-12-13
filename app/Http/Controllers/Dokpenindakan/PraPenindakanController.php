<?php

namespace App\Http\Controllers\Dokpenindakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TblNoRef;
use App\Models\TblLaporanInformasi;
use App\Models\TblSbp;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PraPenindakanController extends Controller
{
    public function index()
    {
        $praPenindakans = TblLaporanInformasi::all();
        // dd($praPenindakans);
        return view('Dokpenindakan.pra-penindakan.index', compact('praPenindakans'));
    }


    public function create()
    {
        $users = User::all();
        $no_ref = TblNoRef::first();
        return view('Dokpenindakan.pra-penindakan.create', compact('users', 'no_ref'));
    }

    public function store(Request $request)
    {
        TblLaporanInformasi::create($request->all());


        $no_ref = TblNoRef::first();
        $no_ref->no_li += 1;
        $no_ref->no_urut_lap += 1;
        $no_ref->no_npi += 1;
        $no_ref->no_print += 1;
        $no_ref->save();

        return redirect()->route('pra-penindakan.index')->with('success', 'Data berhasil disimpan dan nomor referensi telah diperbarui.');
    }

    public function edit($id)
    {

        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $no_ref = TblNoRef::first();
        $users = User::all();
        return view('Dokpenindakan.pra-penindakan.edit', compact('praPenindakan', 'no_ref', 'users'));
    }

    public function update($id)
    {
        // Mengambil data dari input form
        $data = request()->all();

        // Mencari data berdasarkan ID dan melakukan update
        $item = TblLaporanInformasi::find($id);
        if ($item) {
            $item->update($data);
            return redirect()->route('pra-penindakan.index')->with('success', 'Data berhasil diperbarui.');
        }

        return redirect()->route('pra-penindakan.index')->with('error', 'Data tidak ditemukan.');
    }

    public function destroy($id)
    {
        $praPenindakan = TblLaporanInformasi::find($id);
        if ($praPenindakan) {
            $praPenindakan->delete();
            return redirect()->route('pra-penindakan.index')->with('success', 'Data berhasil dihapus.');
        }
        return redirect()->route('pra-penindakan.index')->with('error', 'Data tidak ditemukan.');
    }

    public function print_laporan_informasi($id)
    {

        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        $pejabatKeys = [
            'id_pejabat_li_1',
            'id_pejabat_li_2',
            'id_pejabat_li_3',
        ];


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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


        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-laporan-informasi.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglLi = $praPenindakan->tgl_li;

        if (!empty($tglLi)) {
            $tahunSuratLi = date('Y', strtotime($tglLi));
        } else {
            $tahunSuratLi = '-';
        }

        $templateProcessor->setValue('tahun_li', $tahunSuratLi);



        $fileName = 'Dokumen_Pra_Penindakan_Laporan_Informasi_Nomor_' . $praPenindakan->no_li . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_surat_npi($id)
    {
        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        $pejabatKeys = [
            'id_pejabat_npi',
        ];


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-npi.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglNpi = $praPenindakan->tgl_npi;

        if (!empty($tglNpi)) {
            $tahunSuratNpi = date('Y', strtotime($tglNpi));
        } else {
            $tahunSuratNpi = '-';
        }

        $templateProcessor->setValue('tahun_npi', $tahunSuratNpi);

        $fileName = 'Dokumen_Pra_Penindakan_Surat_NPI_Nomor_' . $praPenindakan->no_npi . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_lapp($id)
    {
        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        $pejabatKeys = [
            'id_pejabat_sp_1',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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

        if ($praPenindakan->pelaku === 'YA') {
            $data['p_d'] = '✔';
            $data['p_t'] = '✘';
        } else {
            $data['p_d'] = '✘';
            $data['p_t'] = '✔';
        }

        if ($praPenindakan->dugaan_pelanggaran === 'YA') {
            $data['d_p'] = '✔';
            $data['d_t'] = '✘';
        } else {
            $data['d_p'] = '✘';
            $data['d_t'] = '✔';
        }

        if ($praPenindakan->locus === 'YA') {
            $data['l_y'] = '✔';
            $data['l_t'] = '✘';
        } else {
            $data['l_y'] = '✘';
            $data['l_t'] = '✔';
        }

        if ($praPenindakan->tempus === 'YA') {
            $data['t_y'] = '✔';
            $data['t_t'] = '✘';
        } else {
            $data['t_y'] = '✘';
            $data['t_t'] = '✔';
        }

        if ($praPenindakan->layak_penindakan === 'YA') {
            $data['lp'] = '✔';
        } else {
            $data['lp'] = '✘';
        }

        if ($praPenindakan->layak_patroli === 'YA') {
            $data['lpt'] = '✔';
        } else {
            $data['lpt'] = '✘';
        }

        if ($praPenindakan->tidak_layak === 'YA') {
            $data['tl'] = '✔';
        } else {
            $data['tl'] = '✘';
        }

        $data['tahun_sekarang'] = date('Y');


        $data = $this->formatDates($data);

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-lapp.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglLap = $praPenindakan->tgl_li;

        if (!empty($tglLap)) {
            $tahunSuratLap = date('Y', strtotime($tglLap));
        } else {
            $tahunSuratLap = '-';
        }

        $templateProcessor->setValue('tahun_lap', $tahunSuratLap);

        $fileName = 'Dokumen_Pra_Penindakan_Surat_LAP_Nomor_' . $praPenindakan->no_lap . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function print_surat_perintah($id)
    {
        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        $pejabatKeys = [
            'id_pejabat_sp_1',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-perintah.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglPrint = $praPenindakan->tgl_print;

        if (!empty($tglPrint)) {
            $tahunSuratPrint = date('Y', strtotime($tglPrint));
        } else {
            $tahunSuratPrint = '-';
        }

        $templateProcessor->setValue('tahun_print', $tahunSuratPrint);

        $fileName = 'Dokumen_Pra_Penindakan_Surat_Perintah_Nomor_' . $praPenindakan->no_print . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    public function print_surat_mpp($id)
    {
        $praPenindakan = TblLaporanInformasi::findOrFail($id);
        $data = $praPenindakan->toArray();

        $pejabatKeys = [
            'id_pejabat_sp_1',
            'id_pejabat_sp_2',
        ];


        foreach ($pejabatKeys as $key) {
            if ($praPenindakan->$key) {
                $pejabat = $praPenindakan->pejabat($key)->first();
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

        // dd($data);

        $templateProcessor = new TemplateProcessor(resource_path('templates/Dokpenindakan/surat-perintah.docx'));

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $templateProcessor->setValue($key, $value);
            }
        }

        $tglPrint = $praPenindakan->tgl_print;

        if (!empty($tglPrint)) {
            $tahunSuratPrint = date('Y', strtotime($tglPrint));
        } else {
            $tahunSuratPrint = '-';
        }

        $templateProcessor->setValue('tahun_print', $tahunSuratPrint);

        $fileName = 'Dokumen_Pra_Penindakan_Surat_Perintah_Nomor_' . $praPenindakan->no_print . '.docx';

        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->saveAs($filePath);


        return response()->download($filePath)->deleteFileAfterSend(true);
    }



    private function formatDates($data)
    {
        foreach ($data as $key => $value) {
            if ($this->isValidDate($value)) {
                $date = \DateTime::createFromFormat('Y-m-d', $value);
                $data[$key] = $date->format('d F Y');
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