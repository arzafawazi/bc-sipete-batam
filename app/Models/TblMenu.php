<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class TblMenu extends Model
{
    use HasFactory;

    protected $table = 'tbl_menu';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'sub',
        'sub_sub',
        'uraian_menu',
        'fd',
        'dt',
        'icon',
    ];

    public function akses()
    {
        return $this->hasMany(TblAksesMenu::class, 'kode_menu', 'kode');
    }

    public function subMenus()
    {
        return $this->hasMany(TblMenu::class, 'sub', 'kode');
    }

    public function aksesMenu()
    {
        return $this->hasMany(TblAksesMenu::class, 'kode_menu', 'kode')->where('opsi', 'YES'); // Hanya ambil akses 'YES'
    }



    public static function getMenus()
    {
        $userId = auth()->user()->id_admin; // Ambil ID admin yang sedang login
        $menuItems = TblMenu::with('subMenus') // Ambil menu dengan sub-menu
            ->whereNull('sub') // Ambil hanya menu yang tidak memiliki sub
            ->orWhere('sub', 'NO') // Atau yang memiliki sub = 'NO'
            ->get();

        // Filter menu berdasarkan akses
        // $menuItems = $menuItems->filter(function ($menu) use ($userId) {
        //     return $menu->akses()->where('id_admin', $userId)->exists(); // Cek apakah admin memiliki akses
        // });

        // Tambahkan sub-menu ke setiap item menu
        $menuItems->map(function ($menu) {
            // Menyimpan sub-menu di properti yang tepat
            $menu->sub = $menu->subMenus->isNotEmpty() ? $menu->subMenus : collect(); // Gunakan collect() untuk membuat koleksi kosong

            return $menu;
        });

        return $menuItems; // Kembalikan koleksi menu
    }
}