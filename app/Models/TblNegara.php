<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblNegara extends Model
{
    use HasFactory;

    protected $table = 'tbl_negara';

    // protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $guarded = [];
}