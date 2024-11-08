<?php

namespace App\Http\Controllers\Dokpenindakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PraPenindakanNppController extends Controller
{
    public function index(){
        return view('Dokpenindakan.pra-penindakan-npp.index');
    }
}

