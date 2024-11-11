<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblSbp extends Model
{
    use HasFactory;
    protected $table = 'tbl_sbp';

    // protected $primaryKey = 'id';

    // public $incrementing = false;

    protected $guarded = [];


    public function pejabat($key)
    {
        return $this->belongsTo(User::class, $key, 'id_admin');
    }
    
}
