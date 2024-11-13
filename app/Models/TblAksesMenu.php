<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblAksesMenu extends Model
{
    use HasFactory;

    protected $table = 'tbl_akses_menu'; // Nama tabel

    protected $primaryKey = 'id_admin'; // Set primary key ke 'id_admin'

    public $incrementing = false; // Menonaktifkan auto-increment pada primary key

    protected $fillable = [
        'id_admin',
        'username',
        'kode_menu',
        'opsi',
        'tgl_insert',
        'wkt_insert',
    ];

    // Relasi ke model User (pastikan Anda memiliki model User yang sesuai)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_admin');
    }

    // Relasi ke model TblMenu
    public function menu()
    {
        return $this->belongsTo(TblMenu::class, 'kode_menu', 'kode');
    }

    public static function getMenus()
{
    $userId = auth()->user()->id_admin; // Ambil ID admin yang sedang login
    $menuItems = TblMenu::with(['subMenus', 'aksesMenu']) // Ambil menu dan sub-menu
        ->whereNull('sub') // Ambil hanya menu yang tidak memiliki sub
        ->orWhere('sub', 'NO') // Atau yang memiliki sub = 'NO'
        ->orderBy('id') // Urutkan berdasarkan id
        ->get();

    // Tambahkan informasi akses ke setiap item menu
    $menuItems->map(function ($menu) {
        $menu->hasAccess = $menu->aksesMenu->isNotEmpty(); // Cek apakah ada akses 'YES'
        $menu->sub = $menu->subMenus->isNotEmpty() ? $menu->subMenus->sortBy('id') : collect(); // Urutkan sub-menu berdasarkan id

        // Cek sub-menu
        $menu->sub->map(function ($subMenu) {
            // Pastikan subMenu memiliki aksesMenu sebelum memanggil isNotEmpty()
            $subMenu->hasAccess = $subMenu->aksesMenu ? $subMenu->aksesMenu->where('opsi', 'YES')->isNotEmpty() : false;
            return $subMenu;
        });

        return $menu;
    });

    return $menuItems; 
}

}
