<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kota;
use Illuminate\Support\Facades\Session;

class KotaController extends Controller
{
    public function index(){
        $kota = kota::all();
        return view('master.kota.index',['kota' => $kota]);
    }

    public function create(){
        return view('master.kota.create');
    }

    public function store(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        $boleh = kota::cek($request['nama']);
        if($boleh == true){
            Kota::create($request);
            $success = "Data Kota berhasil didaftarkan.";
            Session::put('success-kota', $success);
        }else {
            $failed = "Nama kota telah terdaftar.";
            Session::put('failed-kota', $failed);
            return redirect('/admin/kota/create');
        }

        return redirect('/admin/kota');
    }

    public function edit($id) {
        $listKota = Kota::getAll()->get();
        $kota = Kota::findOrFail($id);
        return view('master.kota.edit', compact('listKota', 'kota'));
    }

    public function update($nama, Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $kota = kota::findOrFail($nama);
        $request['user_updated'] = Session::get('id');
        $boleh = kota::cekedit($nama);

        if($boleh == true){
            $kota->update($request);
            $success = "Data Kota $nama berhasil diubah.";
            Session::put('success-kota', $success);
            return redirect('/admin/kota');
        }else {
            $failed = "Nama kota telah terdaftar.";
            Session::put('failed-kota', $failed);
            return redirect('/admin/kota/edit/' . $nama);
        }
    }
}
