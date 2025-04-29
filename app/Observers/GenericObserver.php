<?php

namespace App\Observers;

use App\Models\TblLog as Log;
use Illuminate\Database\Eloquent\Model;

class GenericObserver
{
    public function created(Model $model)
    {
        $this->logActivity($model, 'created');
    }

    public function updated(Model $model)
    {
        $this->logActivity($model, 'updated');
    }

    public function deleted(Model $model)
    {
        $this->logActivity($model, 'deleted');
    }

    private function logActivity(Model $model, $action)
    {
        $modelName = class_basename($model);
        $modelId = $model->getKey() ?? '[ID belum tersedia]';
        $user = auth()->user();

        $changes = null;
        $targetName = null;
        $extraInfo = null;

        if ($action === 'updated') {
            $original = $model->getOriginal();
            $changes = $this->getChanges($original, $model->getAttributes());
        }

        if (in_array($action, ['created', 'deleted'])) {
            $importantFields = $this->extractImportantFields($modelName, $model);
            $extraInfo = ucfirst($action) . " {$modelName} dengan ID: {$model->id}. Detail: {$importantFields}";
        }

        if ($action === 'deleted') {
            $importantFields = $this->extractImportantFields($modelName, $model);
            $extraInfo = "Deleted {$modelName} dengan ID: {$model->id}. Detail data terhapus: {$importantFields}";
        }

        // Khusus TblAksesMenu
        if ($modelName === 'TblAksesMenu' && $action === 'created') {
            // Hanya log jika akses diberikan
            if ($model->opsi === 'YES') {
                // Load relasi jika belum dimuat
                if (!$model->relationLoaded('menu') || !$model->relationLoaded('user')) {
                    $model->load(['menu', 'user']);
                }

                $menu = $model->menu;
                $userTarget = $model->user;

                if ($menu && $userTarget) {
                    $extraInfo = "Pemberian akses menu '{$menu->uraian_menu}' (Kode: {$menu->kode_menu}) ke user ID: {$userTarget->id}, Nama: {$userTarget->name}";
                } else {
                    $extraInfo = "Pemberian akses menu dengan kode '{$model->kode_menu}' ke user ID: {$model->id_admin}";
                }
            } else {
                // Tidak usah log jika opsi bukan 'YES'
                return;
            }
        }

        Log::create([
            'id_admin' => $user ? $user->id_admin : null,
            'action' => "{$action}_{$modelName}",
            'description' => $this->buildDescription($action, $modelName, $modelId, $changes, $targetName, $extraInfo),
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }

    private function getChanges(array $original, array $current)
    {
        $changes = [];
        foreach ($current as $key => $value) {
            if (!array_key_exists($key, $original)) {
                continue;
            }
            if ($original[$key] != $value) {
                $changes[$key] = [
                    'before' => $original[$key],
                    'after' => $value,
                ];
            }
        }
        return $changes;
    }

    private function buildDescription($action, $modelName, $modelId, $changes = null, $targetName = null, $extraInfo = null)
    {
        $description = "{$action} {$modelName} dengan ID: {$modelId}";

        if ($targetName) {
            $description .= " (Nama: {$targetName})";
        }

        if ($extraInfo) {
            $description .= ". {$extraInfo}";
        }

        if ($changes && !empty($changes)) {
            $description .= '. Perubahan: ';
            foreach ($changes as $field => $change) {
                $description .= "{$field}: '{$change['before']}' → '{$change['after']}', ";
            }
            $description = rtrim($description, ', ');
        }

        return $description;
    }

    private function extractModelName(Model $model)
    {
        $commonFields = ['name', 'nama', 'nama_lengkap', 'nama_user', 'title'];

        foreach ($commonFields as $field) {
            if (isset($model->$field)) {
                return $model->$field;
            }
        }

        return null;
    }

    protected function extractImportantFields($modelName, $model)
    {
        switch ($modelName) {
            case 'User':
                return "Nama: {$model->name}, Nama Lengkap: {$model->nama_admin}";

            case 'TblAksesMenu':
                return "Kode Menu: {$model->kode_menu}, Opsi: {$model->opsi}, ID User: {$model->id_admin}";

            case 'TblLaporanPengawasan':
                return "Nomor ST: {$model->no_st}, Tanggal ST: {$model->tgl_st}, NO_lPT: {$model->no_lpt}";

            case 'TblLaporanInformasi':
                return "Nomor LI: {$model->no_li}, Tanggal LI: {$model->tgl_li}, NO_LAP: {$model->no_lap}";

            case 'TblSbp':
                return "Jenis SBP: {$model->opsi_penindakan}, Nomor SBP: {$model->no_sbp}, Tanggal SBP: {$model->tgl_sbp}";
           
            case 'TblPascaPenindakan':
                return "NO LPHP: {$model->no_lphp}, Tanggal LPHP: {$model->tgl_lphp}, NO BAST Pemilik: {$model->no_bast_pemilik}";

            case 'TblPenyidikan':
                return "NO LPP: {$model->no_lpp}, Tanggal LPP: {$model->tgl_lpp}, NO LPF: {$model->no_lpf}";
            
            case 'TblPelanggaranAdministrasi':
                return "Tanggal Pelanggaran Administrasi: {$model->tgl_pelanggaran_administrasi}, Jenis Pelanggaran: {$model->jenis_pelanggaran_administrasi}";

            case 'TblPelanggaranUnsurPidanaPenyidikan':
                return "NO LK: {$model->no_lk}, Tanggal LK: {$model->tgl_lk}";
            
            case 'TblPelanggaranUnsurPidanaUr':
                return "Surat Perintah Penelitian Tersangka: {$model->surat_perintah_penelitian_ur_tersangka}";
                
            case 'TblPelanggaranKetentuanLain':
                return "NO BAST Instansi lain: {$model->no_bast_instansi_lain_pkl}, Tanggal BAST Instansi lain: {$model->tgl_bast_instansi_lain_pkl}";

            default:
                // fallback semua field sebagai JSON
                return json_encode($model->only(array_slice(array_keys($model->getAttributes()), 0, 5)));
        }
    }
}
