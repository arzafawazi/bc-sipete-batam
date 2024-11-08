<?php

namespace App\Http\Controllers\Pengawasanlain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaPembukaanSegelController extends Controller
{
    public function index(){
        return view('Pengawasanlain.ba-pembukaan-segel.index');
    }
}
