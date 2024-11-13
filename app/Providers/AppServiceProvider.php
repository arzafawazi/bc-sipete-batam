<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\TblMenu;
use App\Models\TblAksesMenu;
use Illuminate\Support\Facades\Log;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    View::composer('layouts.partials.sidebar', function ($view) {
        $user = auth()->user();
        if (!$user) {
            return;
        }

        $userId = $user->id_admin;

        // Ambil semua menu yang memiliki akses 'YES' dan tidak merupakan sub-menu, urutkan berdasarkan 'id'
        $menus = TblMenu::with(['subMenus' => function ($query) use ($userId) {
            $query->whereHas('akses', function ($subQuery) use ($userId) {
                $subQuery->where('id_admin', $userId)
                    ->where('opsi', 'YES');
            })
            ->orderBy('id'); // Urutkan sub-menu berdasarkan 'id'
        }])
            ->whereHas('akses', function ($query) use ($userId) {
                $query->where('id_admin', $userId)
                    ->where('opsi', 'YES');
            })
            ->where('sub', 'NO')
            ->orderBy('id') // Urutkan menu utama berdasarkan 'id'
            ->get();

        $view->with('menus', $menus);
    });
}

}
