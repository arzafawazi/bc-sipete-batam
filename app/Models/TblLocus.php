<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblLocus extends Model
{
    use HasFactory;
    protected $table = 'tbl_locus';

    // protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $guarded = [];
}