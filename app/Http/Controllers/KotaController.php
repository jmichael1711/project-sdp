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
        $request = $request->all();
        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        $boleh = kota::cek($request['nama']);
        if($boleh == true){
            Kota::create($request);
            $success = "kota berhasil di-tambahkan";
            Session::put('success-kota', $success);
        }else {
            $failed = "kota gagal di-tambahkan";
            Session::put('failed-kota', $failed);
        }

        return redirect('/admin/kota/create');
    }

    public function edit($id) {
        $listKota = Kota::getAll()->get();
        $kota = Kota::findOrFail($id);
        return view('master.kota.edit', compact('listKota', 'kota'));
    }

    public function update($id, Request $request) {
        $request = $request->all();
        $kantor = Kantor::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $kantor->update($request);
        $success = 'Kantor berhasil diubah.';
        Session::put('success-kantor', $success);
        return redirect('/admin/kantor');
    }
}
