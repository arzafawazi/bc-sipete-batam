<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblSbp extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_sbp';

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

    public function laporanInformasi()
    {
        return $this->belongsTo(TblLaporanInformasi::class, 'id_pra_penindakan_ref', 'id_pra_penindakan');
    }
}