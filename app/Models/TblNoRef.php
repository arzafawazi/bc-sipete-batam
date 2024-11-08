<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblNoRef extends Model
{
    use HasFactory;

    protected $table = 'tbl_no_reff';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'no_sbp',
        'no_li',
        'no_npi',
        'no_print',
        'no_sbp_npp',
        'no_ba_segel',
        'no_ba_segel_npp',
        'no_ba_serah',
        'no_ba_serah_npp',
        'no_ba_musnah',
        'no_ba_musnah_npp',
        'no_ba_tengah',
        'no_ba_tengah_npp',
        'no_ba_buka_segel',
        'no_ltp',
        'no_ltp_npp',
        'no_lpp',
        'no_lpp_npp',
        'no_sp_cacah',
        'no_ba_cacah',
        'no_pelekatan',
        'no_pelepasan',
        'no_bapp',
        'no_pbbs',
        'no_menu',
        'no_bapbc',
        'no_patroli',
        'no_bd12',
        'no_ba_riksa',
    ];
}