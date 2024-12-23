<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblKategoriPenindakan extends Model
{
    use HasFactory;

    protected $table = 'tbl_kategori_penindakan';

    // protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $guarded = [];
}