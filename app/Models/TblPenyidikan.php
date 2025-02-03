<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblPenyidikan extends Model
{
    use HasFactory;

    protected $table = 'tbl_penyidikan';

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


    public function pascapenindakan()
    {
        return $this->belongsTo(TblPascaPenindakan::class, 'id_pasca_penindakan_ref', 'id_pasca_penindakan');
    }


    public function penindakan()
    {
        return $this->hasOneThrough(
            TblSbp::class,
            TblPascaPenindakan::class,
            'id_pasca_penindakan', // Foreign key di TblPascaPenindakan
            'id_penindakan',       // Foreign key di TblPenindakan
            'id_pasca_penindakan_ref', // Local key di TblPenyidikan
            'id_penindakan_ref'    // Local key di TblPascaPenindakan
        );
    }

    // Relasi ke TblLaporanInformasi melalui TblSbp
    public function laporanInformasi()
    {
        return $this->hasManyThrough(
            TblLaporanInformasi::class,
            TblSbp::class,
            'id_penindakan',        // Foreign key di TblSbp, bagian ini kuubah untuk penyidikan nanti cek lagi dibagian index penyidikan
            'id_pra_penindakan',        // Foreign key di TblLaporanInformasi
            'id_pasca_penindakan_ref',  // Local key di TblPenyidikan
            'id_pra_penindakan_ref'     // Local key di TblSbp
        );
    }
}