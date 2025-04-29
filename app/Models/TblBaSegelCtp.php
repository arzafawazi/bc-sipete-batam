<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblBaSegelCtp extends Model
{
    use HasFactory;

    protected $table = 'tbl_ba_segel_ctp';

    // protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $guarded = [];

    public function getPejabat($key)
    {
        return $this->belongsTo(User::class, $key, 'id_admin');
    }

    public function pejabat($key)
    {
        return $this->belongsTo(User::class, $key, 'id_admin');
    }

    public function penyidikan()
    {
        return $this->belongsTo(TblPenyidikan::class, 'id_penyidikan_ref', 'id_penyidikan');
    }

    // Relasi ke TblPascaPenindakan melalui TblPenyidikan
    public function pascapenindakan()
    {
        return $this->hasOneThrough(
            TblPascaPenindakan::class,
            TblPenyidikan::class,
            'id_penyidikan',           // Foreign key di TblPenyidikan
            'id_pasca_penindakan',     // Foreign key di TblPascaPenindakan
            'id_penyidikan_ref',       // Local key di TblPelanggaranKetentuanLain
            'id_pasca_penindakan_ref'  // Local key di TblPenyidikan
        );
    }

    // Relasi ke TblSbp melalui TblPenyidikan dan TblPascaPenindakan
    public function penindakan()
    {
        return $this->hasOneThrough(
            TblSbp::class,
            TblPascaPenindakan::class,
            'id_pasca_penindakan', // Foreign key di TblPascaPenindakan
            'id_penindakan',       // Foreign key di TblSbp
            'id_penyidikan_ref',   // Local key di TblPelanggaranKetentuanLain
            'id_penindakan_ref'    // Local key di TblPascaPenindakan
        );
    }

    // Relasi ke TblLaporanInformasi melalui TblSbp
    public function laporanInformasi()
    {
        return $this->hasManyThrough(
            TblLaporanInformasi::class,
            TblSbp::class,
            'id_penindakan',        // Foreign key di TblSbp
            'id_pra_penindakan',    // Foreign key di TblLaporanInformasi
            'id_penyidikan_ref',    // Local key di TblPelanggaranKetentuanLain
            'id_pra_penindakan_ref' // Local key di TblSbp
        );
    }
}
