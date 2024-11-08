<?php

namespace App\Http\Controllers\Dokpenyidikan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarDokLppController extends Controller
{
    public function index()
    {
        return view('Dokpenyidikan.daftar-dok-lpp.index');
    }
}
