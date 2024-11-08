<?php

namespace App\Http\Controllers\Dokpenindakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PascaPenindakanNppController extends Controller
{
    public function index()
    {
        return view('Dokpenindakan.pasca-penindakan-npp.index');
    }
}
