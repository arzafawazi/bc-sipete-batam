<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblJenisPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'tbl_jenis_pelanggaran';

    protected $primaryKey = 'id_jenis_pelanggaran';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_jenis_pelanggaran',
        'alasan_penindakan',
        'jenis_pelanggaran',
    ];
}
