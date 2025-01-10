<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblPascaPenindakan extends Model
{
    use HasFactory;

    protected $table = 'tbl_pasca_penindakan';

    // protected $primaryKey = 'id';

    // public $incrementing = false;


    public function getPejabat($key)
    {
        return $this->belongsTo(User::class, $key, 'id_admin');
    }

    public function pejabat($key)
    {
        return $this->belongsTo(User::class, $key, 'id_admin');
    }

    public function sbp()
    {
        return $this->belongsTo(TblSbp::class, 'id_penindakan_ref', 'id_penindakan');
    }

    public function penindakans()
    {
        return $this->hasMany(TblSbp::class, 'id_penindakan', 'id_penindakan_ref');
    }
}