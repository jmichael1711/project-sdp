<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Resi;
use App\Kota;
use App\Pegawai;

class ResiController extends Controller
{
    public function create(){
        $nextId = Resi::getNextId();
        $allKota = Kota::getAll()->get();
        return view('master.resi.create', compact('nextId', 'allKota'));
    }

    public function store(Request $request){
        $request = $request->all();
        $user = Pegawai::findOrFail(Session::get('id'));
        $request['user_created'] = $user->id;
        $request['user_updated'] = $user->id;
        $request['verifikasi'] = 1;
        $request['kantor_asal_id'] = $user->kantor->id;
        $request['harga'] = 0;
        Resi::create($request);
        $success = "Data resi berhasil didaftarkan.";
        Session::put('success-pesanan', $success);
        return redirect('/admin/resi');
    }

    public function index(){
        $user = Pegawai::findOrFail(Session::get('id'));
        $allResi = "";
        if($user->jabatan == "admin"){
            $allResi = Resi::getAll()->get();
        }else if($user->jabatan == "kasir"){
            $allResi = Resi::where("kantor_asal_id","=",$user->kantor_id);
        }
        return view('master.resi.index',compact('allResi'));
    }

    public function edit($id){
        $resi = Resi::findOrFail($id);
        $status = "";
        if($resi->status_perjalanan == "CANCEL" || $resi->status_perjalanan == "SELESAI"){$status = "disabled";}
        $allKota = Kota::getAll()->get();
        return view('master.resi.edit',compact('resi','status','allKota'));
    }

    public function update($id, Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $resi = Resi::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $resi->update($request);
        $success = 'Resi ' . '"' . $id .  '"' . 'berhasil diubah.';
        Session::put('success-resi', $success);
        return redirect('/admin/resi');
    }
    
}
