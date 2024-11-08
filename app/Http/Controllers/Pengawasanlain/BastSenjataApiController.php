<?php

namespace App\Http\Controllers\Pengawasanlain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BastSenjataApiController extends Controller
{
    public function index(){
        return view('Pengawasanlain.bast-senjata-api.index');   
       }
}
