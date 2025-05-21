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
use App\Http\Controllers\tools\logActivityController;

use App\Http\Controllers\Dokintelijen\LaporanPengawasanControllers;

use App\Http\Controllers\Dokpenindakan\PenindakanController;
use App\Http\Controllers\Dokpenindakan\PraPenindakanController;
use App\Http\Controllers\Dokpenindakan\KesimpulanDokpenindakan\KesimpulanLappPraPenindakanController;
use App\Http\Controllers\Dokpenindakan\PascaPenindakanController;
use App\Http\Controllers\Dokpenindakan\PascaPenindakanNppController;
use App\Http\Controllers\Dokpenindakan\PraPenindakanNppController;

use App\Http\Controllers\Dokpenindakan\PenindakanNppController;
use App\Http\Controllers\Dokpenyidikan\DaftarDokLppController;
use App\Http\Controllers\Dokpenyidikan\LembarMonitoringBarangController;
use App\Http\Controllers\Dokpenyidikan\BarangController;
use App\Http\Controllers\Tindaklanjut\PelanggaranAdministrasiController;
use App\Http\Controllers\Tindaklanjut\PelanggaranUnsurPidanaPenyidikanController;
use App\Http\Controllers\Tindaklanjut\PelanggaranUnsurPidanaUrController;
use App\Http\Controllers\Tindaklanjut\PelanggaranKetentuanLainController;

use App\Http\Controllers\Pengawasanlain\BaBukaSegelCtpController;
use App\Http\Controllers\Pengawasanlain\BaCacahAmunisiController;
use App\Http\Controllers\Pengawasanlain\BaPembukaanSegelController;
use App\Http\Controllers\Pengawasanlain\BaPengawasanBongkarController;
use App\Http\Controllers\Pengawasanlain\BaSegelCtpController;
use App\Http\Controllers\Pengawasanlain\BastSenjataApiController;
use App\Http\Controllers\Pengawasanlain\PemasukanAmunisiSenjataApiController;
use App\Http\Controllers\Pengawasanlain\KemasanBaBongkarController;




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

 Route::get('/api/kesimpulan', [KesimpulanLappPraPenindakanController::class, 'search']);

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

    Route::resource('tools/log-activity', logActivityController::class);

    // Rute untuk menampilkan halaman reset password
    Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

    // Rute untuk memproses reset password
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('password/update', [ResetPasswordController::class, 'updatePassword'])->name('password.update');



    // Pra penindakan routes
    Route::resource('Dokpenindakan/pra-penindakan', PraPenindakanController::class);
    Route::get('Dokpenindakan/pra-penindakan/search', [PraPenindakanController::class, 'search'])->name('users.search');
    Route::get('Dokpenindakan/pra-penindakan/{id}/print-laporan-informasi', [PraPenindakanController::class, 'print_laporan_informasi'])->name('laporan-informasi.print');
    Route::get('Dokpenindakan/pra-penindakan/{id}/print-surat-npi', [PraPenindakanController::class, 'print_surat_npi'])->name('surat-npi.print');
    Route::get('Dokpenindakan/pra-penindakan/{id}/print-surat-lapp', [PraPenindakanController::class, 'print_surat_lapp'])->name('surat-lapp.print');
    Route::get('Dokpenindakan/pra-penindakan/{id}/print-surat-perintah', [PraPenindakanController::class, 'print_surat_perintah'])->name('surat-perintah.print');
    Route::get('Dokpenindakan/pra-penindakan/{id}/print-surat-mpp', [PraPenindakanController::class, 'print_surat_mpp'])->name('surat-mpp.print');

    // Pra penindakan NPP routes
    Route::resource('Dokpenindakan/pra-penindakan-npp', PraPenindakanNppController::class);

    // Penindakan NPP routes
    Route::resource('Dokpenindakan/penindakan-npp', PenindakanNppController::class);

    // Pasca Penindakan Routes
    Route::resource('Dokpenindakan/pasca-penindakan', PascaPenindakanController::class);
    Route::get('Dokpenindakan/pasca-penindakan/{id}/print-surat-lphp', [PascaPenindakanController::class, 'print_surat_lphp'])->name('surat-lphp.print');
    Route::get('Dokpenindakan/pasca-penindakan/{id}/print-surat-lp', [PascaPenindakanController::class, 'print_surat_lp'])->name('surat-lp.print');
    Route::get('Dokpenindakan/pasca-penindakan/{id}/print-surat-np', [PascaPenindakanController::class, 'print_surat_np'])->name('surat-np.print');
    Route::get('Dokpenindakan/pasca-penindakan/{id}/print-surat-bast-pemilik', [PascaPenindakanController::class, 'print_surat_bast_pemilik'])->name('surat-bast-pemilik.print');
    Route::get('Dokpenindakan/pasca-penindakan/{id}/print-surat-bast-instansi', [PascaPenindakanController::class, 'print_surat_bast_instansi'])->name('surat-bast-instansi.print');
    Route::get('Dokpenindakan/pasca-penindakan/{id}/print-surat-bast-penyidik', [PascaPenindakanController::class, 'print_surat_bast_penyidik'])->name('surat-bast-penyidik.print');
    Route::get('Dokpenindakan/pasca-penindakan/{id}/print-surat-lpt', [PascaPenindakanController::class, 'print_surat_lpt'])->name('surat-lpt-pasca-penindakan.print');


    // Pasca Penindakan NPP routes
    Route::resource('Dokpenindakan/pasca-penindakan-npp', PascaPenindakanNppController::class);
    // Dokpenyidikan routes
    Route::resource('Dokpenyidikan/daftar-dok-lpp', DaftarDokLppController::class);
    Route::get('Dokpenyidikan/daftar-dok-lpp/{id}/print-surat-lpp', [DaftarDokLppController::class, 'print_surat_lpp'])->name('surat-lpp.print');
    Route::get('Dokpenyidikan/daftar-dok-lpp/{id}/print-surat-lpf', [DaftarDokLppController::class, 'print_surat_lpf'])->name('surat-lpf.print');
    Route::get('Dokpenyidikan/daftar-dok-lpp/{id}/print-surat-split', [DaftarDokLppController::class, 'print_surat_split'])->name('surat-split.print');
    Route::get('Dokpenyidikan/daftar-dok-lpp/{id}/print-surat-baw', [DaftarDokLppController::class, 'print_surat_baw'])->name('surat-baw.print');
    Route::get('Dokpenyidikan/daftar-dok-lpp/{id}/print-surat-print-cacah', [DaftarDokLppController::class, 'print_surat_print_cacah'])->name('surat-print-cacah.print');
    Route::get('Dokpenyidikan/daftar-dok-lpp/{id}/print-surat-ba-cacah', [DaftarDokLppController::class, 'print_surat_ba_cacah'])->name('surat-ba-cacah.print');
    Route::get('Dokpenyidikan/daftar-dok-lpp/{id}/print-surat-lhp', [DaftarDokLppController::class, 'print_surat_lhp'])->name('surat-lhp.print');
    Route::get('Dokpenyidikan/daftar-dok-lpp/{id}/print-surat-bast-pemilikPenyidikan', [DaftarDokLppController::class, 'print_surat_bast_pemilik_penyidikan'])->name('surat-bast-pemilik-penyidikan.print');


    // Tindak Lanjut Pelanggaran Administrasi Route
    Route::resource('Tindaklanjut/pelanggaran-administrasi', PelanggaranAdministrasiController::class);
    Route::get('Tindaklanjut/pelanggaran-administrasi/{id}/cetak', [PelanggaranAdministrasiController::class, 'print_dokumen'])->name('pelanggaran-administrasi.cetak');
    Route::get('Tindaklanjut/pelanggaran-administrasi/{id}/surat-bast-pemilik-tindak-lanjut', [PelanggaranAdministrasiController::class, 'print_bast_pemilik_tindak_lanjut'])->name('surat-bast-pemilik-tindak-lanjut.print');

    //Tindak Lanjut Pelanggaran Ketentuan Lain Route
    Route::resource('Tindaklanjut/pelanggaran-ketentuan-lain', PelanggaranKetentuanLainController::class);
    Route::get('Tindaklanjut/pelanggaran-ketentuan-lain/{id}/print-surat-bast-instansi-lain-pkl', [PelanggaranKetentuanLainController::class, 'print_surat_bast_instansi_lain_pkl'])->name('surat-bast-instansi-lain-pkl.print');

    //Tindak Lanjut Pelanggaran Unsur Pidana Route
    Route::resource('Tindaklanjut/unsur-pidana-penyidikan', PelanggaranUnsurPidanaPenyidikanController::class);
    Route::resource('Tindaklanjut/unsur-pidana-ur', PelanggaranUnsurPidanaUrController::class);
    Route::post('TindakLanjut/unsur-pidana-ur/delete-file/{id}', [PelanggaranUnsurPidanaUrController::class, 'deleteFile'])->name('unsur-pidana-ur.delete-file');
    Route::get('Tindaklanjut/unsur-pidana-ur/{id}/tes', [PelanggaranUnsurPidanaUrController::class, 'printSuratPerTersangka'])->name('tes.print');

    

    //Barang Controller
    Route::resource('Dokpenyidikan/barang', BarangController::class);
    Route::get('/Dokpenyidikan/barang', [BarangController::class, 'getBarangData']);
    Route::get('/barang/data', [BarangController::class, 'getBarangData'])->name('getBarangData');
    Route::get('/Dokpenyidikan/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit'); // Rute edit
    Route::delete('/Dokpenyidikan/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Rute hapus




    // Lembar Monitoring Barang Routes
    Route::resource('Dokpenyidikan/lembar-monitoring-barang', LembarMonitoringBarangController::class);



    //DokIntelijen routes
    Route::resource('Dokintelijen/laporan-pengawasan', LaporanPengawasanControllers::class);
    Route::get('Dokintelijen/laporan-pengawasan/{id}/print-surat-tugas', [LaporanPengawasanControllers::class, 'print_surat_tugas'])->name('surat-tugas.print');
    Route::get('Dokintelijen/laporan-pengawasan/{id}/print-surat-lpt', [LaporanPengawasanControllers::class, 'print_surat_lpt'])->name('surat-lpt.print');
    Route::get('Dokintelijen/laporan-pengawasan/{id}/print-surat-lpp', [LaporanPengawasanControllers::class, 'print_surat_lpp'])->name('surat-lppi.print');
    Route::get('Dokintelijen/laporan-pengawasan/{id}/print-surat-lkai', [LaporanPengawasanControllers::class, 'print_surat_lkai'])->name('surat-lkai.print');
    Route::get('Dokintelijen/laporan-pengawasan/{id}/print-surat-nhi', [LaporanPengawasanControllers::class, 'print_surat_nhi'])->name('surat-nhi.print');
    Route::get('Dokintelijen/laporan-pengawasan/{id}/print-surat-ni', [LaporanPengawasanControllers::class, 'print_surat_ni'])->name('surat-ni.print');
    Route::get('Dokintelijen/laporan-pengawasan/{id}/print-surat-rekomendasi', [LaporanPengawasanControllers::class, 'print_surat_rekomendasi'])->name('surat-rekomendasi.print');

    // Dokpenindakan routes
    Route::resource('Dokpenindakan/penindakan', PenindakanController::class);
    Route::get('Dokpenindakan/penindakan/{id}/print-ba-riksa', [PenindakanController::class, 'print_ba_riksa'])->name('ba-riksa.print');
    Route::get('Dokpenindakan/penindakan/{id}/print-ba-riksa-badan', [PenindakanController::class, 'print_ba_riksa_badan'])->name('ba-riksa-badan.print');
    Route::get('Dokpenindakan/penindakan/{id}/print-ba-sarkut', [PenindakanController::class, 'print_ba_sarkut'])->name('ba-sarkut.print');
    Route::get('Dokpenindakan/penindakan/{id}/print-ba-contoh', [PenindakanController::class, 'print_ba_contoh'])->name('ba-contoh.print');
    Route::get('Dokpenindakan/penindakan/{id}/print-ba-dokumentasi', [PenindakanController::class, 'print_ba_dokumentasi'])->name('ba-dokumentasi.print');
    Route::get('Dokpenindakan/penindakan/{id}/print-ba-segel', [PenindakanController::class, 'print_ba_segel'])->name('ba-segel.print');
    Route::get('Dokpenindakan/penindakan/{id}/print-ba-titip', [PenindakanController::class, 'print_ba_titip'])->name('ba-titip.print');
    Route::get('Dokpenindakan/penindakan/{id}/print-surat-bukti-penindakan', [PenindakanController::class, 'print_surat_sbp'])->name('sbp.print');
    Route::get('Dokpenindakan/penindakan/{id}/print-ba-tolak-pertama', [PenindakanController::class, 'print_ba_tolak1'])->name('ba-tolak1.print');
    Route::get('Dokpenindakan/penindakan/{id}/print-ba-tolak-kedua', [PenindakanController::class, 'print_ba_tolak2'])->name('ba-tolak2.print');
    Route::get('/getNomorSegel/{id}', [PenindakanController::class, 'getNomorSegel']);


    //Pengawasan lain routes
    Route::resource('Pengawasanlain/ba-pembukaan-segel', BaPembukaanSegelController::class);
    Route::get('Pengawasanlain/ba-pembukaan-segel/{id}/print-ba-pembukaan-segel', [BaPembukaanSegelController::class, 'print_ba_pembukaan_segel'])->name('ba-pembukaan-segel.print');

    Route::resource('Pengawasanlain/ba-segel-ctp', BaSegelCtpController::class);
    Route::get('Pengawasanlain/ba-segel-ctp/{id}/print-ba-segel-ctp', [BaSegelCtpController::class, 'print_ba_segel_ctp'])->name('ba-segel-ctp.print');

    Route::resource('Pengawasanlain/ba-buka-segel-ctp', BaBukaSegelCtpController::class);
    Route::get('Pengawasanlain/ba-buka-segel-ctp/{id}/print-ba-buka-segel-ctp', [BaBukaSegelCtpController::class, 'print_ba_buka_segel_ctp'])->name('ba-buka-segel-ctp.print');

    Route::resource('Pengawasanlain/ba-pengawasan-bongkar', BaPengawasanBongkarController::class);
    Route::get('Pengawasanlain/ba-pengawasan-bongkar/{id}/print-pengawasan-bongkar', [BaPengawasanBongkarController::class, 'print_ba_bongkar'])->name('ba-bongkar.print');
    Route::get('Pengawasanlain/ba-pengawasan-bongkar/{id}/print-lpt-pengawasan-bongkar', [BaPengawasanBongkarController::class, 'print_lpt_ba_bongkar'])->name('lpt-ba-bongkar.print');
    Route::get('Pengawasanlain/ba-pengawasan-bongkar/{id}/print-lpp-pengawasan-bongkar', [BaPengawasanBongkarController::class, 'print_lpp_ba_bongkar'])->name('lpp-ba-bongkar.print');
    Route::resource('Pengawasanlain/kemasan', KemasanBaBongkarController::class);
    Route::get('/Pengawasanlain/kemasan', [KemasanBaBongkarController::class, 'getKemasanData']);
    Route::get('/kemasan/data', [KemasanBaBongkarController::class, 'getKemasanData'])->name('getKemasanData');
    Route::get('/Pengawasanlain/kemasan/{id}/edit', [KemasanBaBongkarController::class, 'edit'])->name('kemasan.edit'); // Rute edit
    Route::delete('/Pengawasanlain/kemasan/{id}', [KemasanBaBongkarController::class, 'destroy'])->name('kemasan.destroy'); // Rute
    
    Route::resource('Pengawasanlain/ba-cacah-amunisi', BaCacahAmunisiController::class);
    Route::get('Pengawasanlain/ba-cacah-amunisi/{id}/print-ba-cacah-amunisi', [BaCacahAmunisiController::class, 'print_ba_cacah_amunisi'])->name('ba-cacah-amunisi.print');
    
    Route::resource('Pengawasanlain/bast-senjata-api', BastSenjataApiController::class);
    Route::get('Pengawasanlain/bast-senjata-api/{id}/print-bast-senjata-api', [BastSenjataApiController::class, 'print_bast_senjata_api'])->name('bast-senjata-api.print');

    Route::resource('Pengawasanlain/bast', PemasukanAmunisiSenjataApiController::class);
    Route::get('/Pengawasanlain/bast', [PemasukanAmunisiSenjataApiController::class, 'getBastData']);
    Route::get('/bast/data', [PemasukanAmunisiSenjataApiController::class, 'getBastData'])->name('getBastData');
    Route::get('/Pengawasanlain/bast/{id}/edit', [PemasukanAmunisiSenjataApiController::class, 'edit'])->name('bast.edit'); // Rute edit
    Route::delete('/Pengawasanlain/bast/{id}', [PemasukanAmunisiSenjataApiController::class, 'destroy'])->name('bast.destroy'); // Rute hapus
});





// Route::post('/tools/users/create', [UserController::class, 'storeUsers'])->name('users.storeUsers');