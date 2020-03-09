<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bon_muat;
use App\Resi;

class suratJalanController extends Controller
{
    public function create() {
        $allBonMuat = Bon_muat::getAll()->get();
        $allResi = Resi::getAll()->get();
        return view('master.suratJalan.create',compact('allBonMuat','allResi'));
    }

    public function fetch(Request $request)
    {
        return response()->json([
            'sdsd' => "assdd"
        ])->setStatusCode(200);
    }
}
