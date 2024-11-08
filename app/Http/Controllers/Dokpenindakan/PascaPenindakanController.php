<?php

namespace App\Http\Controllers\Dokpenindakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PascaPenindakanController extends Controller
{
    public function index(){
        return view('Dokpenindakan.pasca-penindakan.index');
    }
}

