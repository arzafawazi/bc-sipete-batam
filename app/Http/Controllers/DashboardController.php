<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblLaporanInformasi;
use App\Models\TblSbp;
use App\Models\TblLaporanPengawasan;
use App\Models\TblPascaPenindakan;
use App\Models\TblPenyidikan;
use App\Models\TblPelanggaranAdministrasi;
use App\Models\TblPelanggaranUnsurPidanaPenyidikan;
use App\Models\TblPelanggaranUnsurPidanaUr;
use App\Models\TblPelanggaranKetentuanLain;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        // Get total count from TblLaporanInformasi
        $totalLaporanInformasi = TblLaporanInformasi::count();

        // Define the date ranges
        $now = Carbon::now();
        $sevenDaysAgo = $now->copy()->subDays(7);
        $fourteenDaysAgo = $now->copy()->subDays(14);

        // Get the counts for the last 7 days and the previous 7 days
        $lastSevenDaysCount = TblLaporanInformasi::where('created_at', '>=', $sevenDaysAgo)->count();
        $previousSevenDaysCount = TblLaporanInformasi::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

        // Calculate the percentage change
        $percentageChange = $previousSevenDaysCount > 0 
            ? (($lastSevenDaysCount - $previousSevenDaysCount) / $previousSevenDaysCount) * 100 
            : ($lastSevenDaysCount > 0 ? 100 : 0);

        // Fetch data from TblSbp for Dok. Penindakan
        $totalDokPenindakan = TblSbp::count();
        $dokPenindakanLastSevenDays = TblSbp::where('created_at', '>=', $sevenDaysAgo)->count();
        $dokPenindakanPreviousSevenDays = TblSbp::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

        // Calculate the percentage change for Dok. Penindakan
        $dokPenindakanPercentageChange = $dokPenindakanPreviousSevenDays > 0 
            ? (($dokPenindakanLastSevenDays - $dokPenindakanPreviousSevenDays) / $dokPenindakanPreviousSevenDays) * 100 
            : ($dokPenindakanLastSevenDays > 0 ? 100 : 0);

        // Fetch data from TblLaporanPengawasan for Pengawasan
        $totalPengawasan = TblLaporanPengawasan::count();
        $pengawasanLastSevenDays = TblLaporanPengawasan::where('created_at', '>=', $sevenDaysAgo)->count();
        $pengawasanPreviousSevenDays = TblLaporanPengawasan::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

        // Calculate the percentage change for Pengawasan
        $pengawasanPercentageChange = $pengawasanPreviousSevenDays > 0 
            ? (($pengawasanLastSevenDays - $pengawasanPreviousSevenDays) / $pengawasanPreviousSevenDays) * 100 
            : ($pengawasanLastSevenDays > 0 ? 100 : 0);

        // Fetch data from TblPascaPenindakan for Pasca Penindakan
        $totalPascaPenindakan = TblPascaPenindakan::count();
        $pascaPenindakanLastSevenDays = TblPascaPenindakan::where('created_at', '>=', $sevenDaysAgo)->count();
        $pascaPenindakanPreviousSevenDays = TblPascaPenindakan::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

        // Calculate the percentage change for Pasca Penindakan
        $pascaPenindakanPercentageChange = $pascaPenindakanPreviousSevenDays > 0 
            ? (($pascaPenindakanLastSevenDays - $pascaPenindakanPreviousSevenDays) / $pascaPenindakanPreviousSevenDays) * 100 
            : ($pascaPenindakanLastSevenDays > 0 ? 100 : 0);

        // Fetch data from TblPenyidikan for Dok Penyidikan
        $totalDokPenyidikan = TblPenyidikan::count();
        $dokPenyidikanLastSevenDays = TblPenyidikan::where('created_at', '>=', $sevenDaysAgo)->count();
        $dokPenyidikanPreviousSevenDays = TblPenyidikan::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

        // Calculate the percentage change for Dok Penyidikan
        $dokPenyidikanPercentageChange = $dokPenyidikanPreviousSevenDays > 0 
            ? (($dokPenyidikanLastSevenDays - $dokPenyidikanPreviousSevenDays) / $dokPenyidikanPreviousSevenDays) * 100 
            : ($dokPenyidikanLastSevenDays > 0 ? 100 : 0);

        // Fetch data from TblPelanggaranAdministrasi for Pelanggaran Administrasi
        $totalPelanggaranAdministrasi = TblPelanggaranAdministrasi::count();
        $pelanggaranAdministrasiLastSevenDays = TblPelanggaranAdministrasi::where('created_at', '>=', $sevenDaysAgo)->count();
        $pelanggaranAdministrasiPreviousSevenDays = TblPelanggaranAdministrasi::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

        // Calculate the percentage change for Pelanggaran Administrasi
        $pelanggaranAdministrasiPercentageChange = $pelanggaranAdministrasiPreviousSevenDays > 0 
            ? (($pelanggaranAdministrasiLastSevenDays - $pelanggaranAdministrasiPreviousSevenDays) / $pelanggaranAdministrasiPreviousSevenDays) * 100 
            : ($pelanggaranAdministrasiLastSevenDays > 0 ? 100 : 0);

        // Fetch data from TblPelanggaranUnsurPidanaPenyidikan for Unsur Pidana Penyidikan
        $totalUnsurPidanaPenyidikan = TblPelanggaranUnsurPidanaPenyidikan::count();
        $unsurPidanaPenyidikanLastSevenDays = TblPelanggaranUnsurPidanaPenyidikan::where('created_at', '>=', $sevenDaysAgo)->count();
        $unsurPidanaPenyidikanPreviousSevenDays = TblPelanggaranUnsurPidanaPenyidikan::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

        // Calculate the percentage change for Unsur Pidana Penyidikan
        $unsurPidanaPenyidikanPercentageChange = $unsurPidanaPenyidikanPreviousSevenDays > 0 
            ? (($unsurPidanaPenyidikanLastSevenDays - $unsurPidanaPenyidikanPreviousSevenDays) / $unsurPidanaPenyidikanPreviousSevenDays) * 100 
            : ($unsurPidanaPenyidikanLastSevenDays > 0 ? 100 : 0);

        // Fetch data from TblPelanggaranUnsurPidanaUr for Unsur Pidana UR
        $totalUnsurPidanaUr = TblPelanggaranUnsurPidanaUr::count();
        $unsurPidanaUrLastSevenDays = TblPelanggaranUnsurPidanaUr::where('created_at', '>=', $sevenDaysAgo)->count();
        $unsurPidanaUrPreviousSevenDays = TblPelanggaranUnsurPidanaUr::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

        // Calculate the percentage change for Unsur Pidana UR
        $unsurPidanaUrPercentageChange = $unsurPidanaUrPreviousSevenDays > 0 
            ? (($unsurPidanaUrLastSevenDays - $unsurPidanaUrPreviousSevenDays) / $unsurPidanaUrPreviousSevenDays) * 100 
            : ($unsurPidanaUrLastSevenDays > 0 ? 100 : 0);

        // Fetch data from TblPelanggaranKetentuanLain for Pelanggaran Ketentuan Lain
        $totalPelanggaranKetentuanLain = TblPelanggaranKetentuanLain::count();
        $pelanggaranKetentuanLainLastSevenDays = TblPelanggaranKetentuanLain::where('created_at', '>=', $sevenDaysAgo)->count();
        $pelanggaranKetentuanLainPreviousSevenDays = TblPelanggaranKetentuanLain::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

        // Calculate the percentage change for Pelanggaran Ketentuan Lain
        $pelanggaranKetentuanLainPercentageChange = $pelanggaranKetentuanLainPreviousSevenDays > 0 
            ? (($pelanggaranKetentuanLainLastSevenDays - $pelanggaranKetentuanLainPreviousSevenDays) / $pelanggaranKetentuanLainPreviousSevenDays) * 100 
            : ($pelanggaranKetentuanLainLastSevenDays > 0 ? 100 : 0);

        return view('dashboard.index', compact(
            "totalLaporanInformasi",
            "lastSevenDaysCount",
            "percentageChange",
            "totalDokPenindakan",
            "dokPenindakanLastSevenDays",
            "dokPenindakanPercentageChange",
            "totalPengawasan",
            "pengawasanLastSevenDays",
            "pengawasanPercentageChange",
            "totalPascaPenindakan",
            "pascaPenindakanLastSevenDays",
            "pascaPenindakanPercentageChange",
            "totalDokPenyidikan",
            "dokPenyidikanLastSevenDays",
            "dokPenyidikanPercentageChange",
            "totalPelanggaranAdministrasi",
            "pelanggaranAdministrasiLastSevenDays",
            "pelanggaranAdministrasiPercentageChange",
            "totalUnsurPidanaPenyidikan",
            "unsurPidanaPenyidikanLastSevenDays",
            "unsurPidanaPenyidikanPercentageChange",
            "totalUnsurPidanaUr",
            "unsurPidanaUrLastSevenDays",
            "unsurPidanaUrPercentageChange",
            "totalPelanggaranKetentuanLain",
            "pelanggaranKetentuanLainLastSevenDays",
            "pelanggaranKetentuanLainPercentageChange"
        ));
    }
}