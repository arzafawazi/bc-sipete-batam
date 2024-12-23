<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblLaporanPengawasan extends Model
{
    use HasFactory;

    protected $table = 'tbl_pengawasan';

    // protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $guarded = [];


    public function getPejabat($key)
    {
        return $this->belongsTo(User::class, $key, 'id_admin');
    }

    public function laporanPengawasan()
    {
        return $this->belongsTo(TblLaporanPengawasan::class, 'id_pengawasan_ref', 'id_pengawasan');
    }
}