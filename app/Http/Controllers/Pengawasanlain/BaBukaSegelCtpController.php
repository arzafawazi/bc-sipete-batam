<?php

namespace App\Http\Controllers\Pengawasanlain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaBukaSegelCtpController extends Controller
{
    public function index(){
     return view('Pengawasanlain.ba-buka-segel-ctp.index');   
    }
}
