<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblSegel extends Model
{
    use HasFactory;

    protected $table = 'tbl_segel';

    protected $primaryKey = 'id_segel';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_segel',
        'jenis_segel',
        'nomor_segel',
        'tgl_segel',
    ];
}