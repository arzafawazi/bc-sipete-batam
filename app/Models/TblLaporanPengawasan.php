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
}