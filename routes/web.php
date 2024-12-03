<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Models\User;
use App\Models\TblAksesMenu;
use App\Models\TblMenu;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ResetPasswordController;

use App\Http\Controllers\tools\SetNomorDokumenController;
use App\Http\Controllers\tools\UserController;

use App\Http\Controllers\Dokintelijen\LaporanPengawasanControllers;

use App\Http\Controllers\Dokpenindakan\PenindakanController;
use App\Http\Controllers\Dokpenindakan\PraPenindakanController;
use App\Http\Controllers\Dokpenindakan\PascaPenindakanController;
use App\Http\Controllers\Dokpenindakan\PascaPenindakanNppController;
use App\Http\Controllers\Dokpenindakan\PraPenindakanNppController;

use App\Http\Controllers\Dokpenindakan\PenindakanNppController;
use App\Http\Controllers\Dokpenyidikan\DaftarDokLppController;
use App\Http\Controllers\Dokpenyidikan\LembarMonitoringBarangController;

use App\Http\Controllers\Pengawasanlain\BaBukaSegelCtpController;
use App\Http\Controllers\Pengawasanlain\BaCacahAmunisiController;
use App\Http\Controllers\Pengawasanlain\BaPembukaanSegelController;
use App\Http\Controllers\Pengawasanlain\BaPengawasanBongkarController;
use App\Http\Controllers\Pengawasanlain\BaSegelCtpController;
use App\Http\Controllers\Pengawasanlain\BastSenjataApiController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

// Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
//     Route::get('', [RoutingController::class, 'index'])->name('root');
//     Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
//     Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
//     Route::get('{any}', [RoutingController::class, 'root'])->name('any');
//     Route::get('{first}/{second}/{id}/edit', [RoutingController::class, 'secondLevel'])->name('edit.user');
// });

// Public routes



Route::get('/', function () {
    return redirect()->route('login');
});

// Protected routes with menu access checking
Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('/home', [DashboardController::class, 'index']);
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // tools routes
    Route::resource('tools/users', UserController::class);
    Route::post('/tools/users/toggle-status/{id}', [UserController::class, 'toggleStatus']);
    Route::post('/tools/users/{user}/reset-password', [UserController::class, 'resetPassword'])
        ->name('user.resetPassword');
    Route::get('/tools/users/{id}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::resource('tools/setNomorDokumen', SetNomorDokumenController::class, [
        'names' => [
            'index' => 'tools.setNomorDokumen.index',
            'update' => 'tools.setNomorDokumen.update',
        ]
    ]);

    // Rute untuk menampilkan halaman reset password
    Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

    // Rute untuk memproses reset password
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('password/update', [ResetPasswordController::class, 'updatePassword'])->name('password.update');



    // Pra penindakan routes
    Route::resource('Dokpenindakan/pra-penindakan', PraPenindakanController::class);
    Route::get('Dokpenindakan/pra-penindakan/search', [PraPenindakanController::class, 'search'])->name('users.search');
    Route::get('Dokpenindakan/pra-penindakan/{id}/print', [PraPenindakanController::class, 'print'])->name('pra-penindakan.print');

    // Pra penindakan NPP routes
    Route::resource('Dokpenindakan/pra-penindakan-npp', PraPenindakanNppController::class);

    // Penindakan NPP routes
    Route::resource('Dokpenindakan/penindakan-npp', PenindakanNppController::class);

    // Pasca Penindakan Routes
    Route::resource('Dokpenindakan/pasca-penindakan', PascaPenindakanController::class);

    // Pasca Penindakan NPP routes
    Route::resource('Dokpenindakan/pasca-penindakan-npp', PascaPenindakanNppController::class);

    // Dokpenyidikan routes
    Route::resource('Dokpenyidikan/daftar-dok-lpp', DaftarDokLppController::class);
    Route::get('Dokpenyidikan/daftar-dok-lpp/{id}/print', [DaftarDokLppController::class, 'print'])->name('daftar-dok-lpp.print');

    // Lembar Monitoring Barang Routes
    Route::resource('Dokpenyidikan/lembar-monitoring-barang', LembarMonitoringBarangController::class);


    //DokIntelijen routes
    Route::resource('Dokintelijen/laporan-pengawasan', LaporanPengawasanControllers::class);
    Route::get('Dokintelijen/laporan-pengawasan/{id}/print-surat-tugas', [LaporanPengawasanControllers::class, 'print_surat_tugas'])->name('surat-tugas.print');
    Route::get('Dokintelijen/laporan-pengawasan/{id}/print-surat-lpt', [LaporanPengawasanControllers::class, 'print_surat_lpt'])->name('surat-lpt.print');

    // Dokpenindakan routes
    Route::resource('Dokpenindakan/DaftarSbp', PenindakanController::class);
    Route::get('Dokpenindakan/DaftarSbp/{id}/print', [PenindakanController::class, 'print'])->name('DaftarSbp.print');
    Route::get('/getNomorSegel/{id}', [PenindakanController::class, 'getNomorSegel']);


    //Pengawasan lain routes
    Route::resource('Pengawasanlain/ba-pembukaan-segel', BaPembukaanSegelController::class);
    Route::resource('Pengawasanlain/ba-segel-ctp', BaSegelCtpController::class);
    Route::resource('Pengawasanlain/ba-buka-segel-ctp', BaBukaSegelCtpController::class);
    Route::resource('Pengawasanlain/ba-pengawasan-bongkar', BaPengawasanBongkarController::class);
    Route::resource('Pengawasanlain/ba-cacah-amunisi', BaCacahAmunisiController::class);
    Route::resource('Pengawasanlain/bast-senjata-api', BastSenjataApiController::class);
});






// Route::post('/tools/users/create', [UserController::class, 'storeUsers'])->name('users.storeUsers');