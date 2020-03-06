<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kendaraan;
use App\Kota;

class KendaraanController extends Controller
{
    public function index() {
        $kantors = Kendaraan::all();
        return view('master.kendaraan.index', compact('kantors', 'kantor1'));
    }

    public function create() {
        $listKota = Kota::getAll()->get();
        return view('master.kendaraan.create', compact('listKota'));
    }

    public function store(Request $request) {
        $request = $request->all();
        Kendaraan::insert($request);
        $success = "Kantor berhasil di-inputkan.";

        return redirect('/admin/kendaraan/create')->with(['success' => $success]);
    }

    public function edit($id) {
        $listKota = Kota::getAll()->get();
        $kantor = Kendaraan::findOrFail($id);
        return view('master.kendaraan.edit', compact('listKota', 'kantor'));
    }

    public function update($id, Request $request) {
        $request = $request->all();
        $kantor = Kendaraan::findOrFail($id);
        $kantor->update($request);
        return redirect('/kendaraan/kantor');
    }
}
