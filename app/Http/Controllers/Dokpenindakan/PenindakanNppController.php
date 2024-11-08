<?php

namespace App\Http\Controllers\Dokpenindakan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenindakanNppController extends Controller
{
    public function index()
    {
        return view('Dokpenindakan.penindakan-npp.index');
    }
}
