<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Bon_MuatController extends Controller
{


    public function create() {
        return view('master.bonmuat.create');
    }


    public function store(Request $request) {
        $request = $request->all();
        Bon_muat::insert($request);
        $success = "Bon muat berhasil di-inputkan.";

        return redirect('/admin/bonmuat/create')->with(['success-bonmuat' => $success]);
    }
}
