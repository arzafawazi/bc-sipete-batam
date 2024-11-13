<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblLaporanInformasi;
use App\Models\TblSbp;
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

    return view('dashboard.index', compact(
        "totalLaporanInformasi",
        "lastSevenDaysCount",
        "percentageChange",
        "totalDokPenindakan",
        "dokPenindakanLastSevenDays",
        "dokPenindakanPercentageChange"
    ));
}


}