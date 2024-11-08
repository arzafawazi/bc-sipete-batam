<?php

namespace App\Http\Controllers\Dokpenyidikan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LembarMonitoringBarangController extends Controller
{
    public function index(){
        return view('Dokpenyidikan.lembar-monitoring-barang.index');
    }
}
