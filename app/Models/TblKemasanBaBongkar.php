<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblKemasanBaBongkar extends Model
{
    use HasFactory;

    protected $table = 'tbl_kemasan_ba_bongkar';

    // protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $guarded = [];
}