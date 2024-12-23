<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblJenisDok extends Model
{
    use HasFactory;

    protected $table = 'tbl_jenis_dok_kepabeanan';

    // protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $guarded = [];
}