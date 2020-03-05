<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantor;
use App\Bon_Muat;

class Bon_MuatController extends Controller
{

    public function create() {
        $nextId = Bon_Muat::getNextId();
        $allKantor = Kantor::getAll()->get();

        return view('master.bonmuat.create',compact('nextId','allKantor'));
    }


    public function store(Request $request) {
        $request = $request->all();
        Bon_muat::insert($request);
        $success = "Bon muat berhasil di-inputkan.";

        return redirect('/admin/bonmuat/create')->with(['success-bonmuat' => $success]);
    }
}
