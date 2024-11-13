<?php

namespace App\Http\Controllers\Dokintelijen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LaporanPengawasanControllers extends Controller
{
    public function index(){
        return view('Dokintelijen.laporan-pengawasan.index');
    }

    public function create(){
        $users = User::all();
        return view('Dokintelijen.laporan-pengawasan.create',compact("users"));
    }
}
