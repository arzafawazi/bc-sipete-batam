<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'tbl_penyidikan_item_cacah';

    protected $fillable = [
        'id_penyidikan',
        'kategori_barang',
        'kode_komoditi',
        'jenis_barang',
        'merk_pabean',
        'tipe_pabean',
        'ukuran_kapasitas',
        'jumlah',
        'satuan',
        'negara_asal',
        'kondisi_pabean',
        'keterangan',
        'kategori_lartas'
    ];
}
