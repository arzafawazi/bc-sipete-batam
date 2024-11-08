<?php

namespace App\Http\Controllers\Pengawasanlain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaSegelCtpController extends Controller
{
    public function index(){
        return view('Pengawasanlain.ba-segel-ctp.index');
    }
}
