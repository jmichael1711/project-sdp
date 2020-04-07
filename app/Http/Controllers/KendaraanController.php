<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kendaraan;
use App\Kota;
use Illuminate\Support\Facades\Session;

class KendaraanController extends Controller
{
    public function index() {
        $kendaraans = Kendaraan::all();
        return view('master.kendaraan.index', compact('kendaraans'));
    }

    public function create() {
        $listKota = Kota::getAll()->get();
        return view('master.kendaraan.create', compact('listKota'));
    }

    public function store(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $request['id'] = Kendaraan::getNextId();
        $user = Session::get('id');
        
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        Kendaraan::create($request);   
        $success = "Data kendaraan berhasil didaftarkan.";

        Session::put('success-kendaraan', $success);
        return redirect('/admin/kendaraan');
    }

    public function edit($id) {
        $listKota = Kota::getAll()->get();
        $kendaraan = Kendaraan::findOrFail($id);
        return view('master.kendaraan.edit', compact('listKota', 'kendaraan'));
    }

    public function update($id, Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $request['updated_at'] = Session::get('id');
        $kantor = Kendaraan::findOrFail($id);
        $kantor->update($request);
        $success = "Data kendaraan $id berhasil diubah.";
        Session::put('success-kendaraan', $success);
        return redirect('/admin/kendaraan');
    }
}
