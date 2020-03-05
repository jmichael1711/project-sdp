<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantor;
use App\Kendaraan;
use App\Kurir_non_customer;
use App\Bon_Muat;

class Bon_MuatController extends Controller
{


    public function create() {
        $nextId = Bon_Muat::getNextId();
        $allKurir = Kurir_non_customer::getAll();
        $allKantor = Kantor::getAll();

        return view('master.bonmuat.create',compact('nextId','allKurir','allKantor'));
    }


    public function store(Request $request) {
        $request = $request->all();
        Bon_muat::insert($request);
        $success = "Bon muat berhasil di-inputkan.";

        return redirect('/admin/bonmuat/create')->with(['success-bonmuat' => $success]);
    }
}
