<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblKemasan extends Model
{
    use HasFactory;

    protected $table = 'tbl_kemasan';

    protected $primaryKey = 'id_kemasan';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_kemasan',
        'nama_kemasan',
    ];
}
