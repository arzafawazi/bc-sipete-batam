<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblLog extends Model
{
    use HasFactory;

    protected $table = 'tbl_log';

    // protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $guarded = [];
}
