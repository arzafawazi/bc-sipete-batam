<?php

namespace App\Providers;

use App\Models\Barang;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\TblMenu;
use App\Models\TblAksesMenu;
use App\Models\TblBaBukaSegelCtp;
use App\Models\TblBaCacahAmunisi;
use App\Models\TblBaPembukaanSegel;
use App\Models\TblBaPengawasanBongkar;
use App\Models\TblBaSegelCtp;
use App\Models\TblBastSenjataApi;
use App\Models\TblKemasanBaBongkar;
use App\Models\TblLaporanInformasi;
use App\Models\TblLaporanPengawasan;
use App\Models\TblNoRef;
use App\Models\TblPascaPenindakan;
use App\Models\TblPelanggaranAdministrasi;
use App\Models\TblPelanggaranUnsurPidanaPenyidikan;
use App\Models\TblPelanggaranUnsurPidanaUr;
use App\Models\TblPemasukanAmunisiSenjataApi;
use App\Models\TblPenyidikan;
use App\Models\TblSbp;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Observers\GenericObserver;



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

    User::observe(GenericObserver::class);
    TblAksesMenu::observe(GenericObserver::class);
    TblNoRef::observe(GenericObserver::class);
    TblLaporanPengawasan::observe(GenericObserver::class);
    TblLaporanInformasi::observe(GenericObserver::class);
    TblSbp::observe(GenericObserver::class);
    TblPascaPenindakan::observe(GenericObserver::class);
    TblPenyidikan::observe(GenericObserver::class);
    TblPelanggaranAdministrasi::observe(GenericObserver::class);
    TblPelanggaranUnsurPidanaPenyidikan::observe(GenericObserver::class);
    TblPelanggaranUnsurPidanaUr::observe(GenericObserver::class);
    TblBaPembukaanSegel::observe(GenericObserver::class);
    TblBaSegelCtp::observe(GenericObserver::class);
    TblBaBukaSegelCtp::observe(GenericObserver::class);
    TblBaPengawasanBongkar::observe(GenericObserver::class);
    TblBaCacahAmunisi::observe(GenericObserver::class);
    TblBastSenjataApi::observe(GenericObserver::class);;
    // bagian dalam
    Barang::observe(GenericObserver::class);
    TblPemasukanAmunisiSenjataApi::observe(GenericObserver::class);
    TblKemasanBaBongkar::observe(GenericObserver::class);
    $this->app->singleton(GenericObserver::class);
}

}
