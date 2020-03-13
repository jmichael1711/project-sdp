<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kota;
use App\Pegawai;

class PegawaiController extends Controller
{
    public function create(){
        $allKota = Kota::getAll()->get();
        $nextId = Pegawai::getNextId();
        return view('master.pegawai.create',compact('allKota','nextId'));
    }
}
