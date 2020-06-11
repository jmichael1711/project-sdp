<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kantor;
use App\Kota;
use App\Kurir_non_customer;
use Illuminate\Support\Facades\Session;

class Kurir_noncustomerController extends Controller
{
    public function index(){
        $kurnoncust = Kurir_non_customer::all();
        return view('master.kurirNoncustomer.index',['kurnoncust' => $kurnoncust]);
    }

    public function create(){
        $allKota = Kota::getAll()->get();
        return view('master.kurirNoncustomer.create',compact('allKota'));
    }

    public function store(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $request['id'] = Kurir_non_customer::getNextId();

        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;

        $request['status'] = 1;

        if($request['kantor_1_id'] != $request['kantor_2_id']){
            Kurir_non_customer::create($request);
            $success = "Data kurir non customer berhasil didaftarkan.";
            Session::put('success-kurir_noncustomer', $success);
            return redirect('/admin/kurir_noncustomer');
        }else {
            $failed = "Data kurir non customer gagal didaftarkan. Alamat kantor 1 dan alamat kantor 2 sama.";
            Session::put('failed-kurir_noncustomer', $failed);
            return redirect('/admin/kurir_noncustomer/create');
        }
    }

    public function edit($id) {
        $kurcust = Kurir_non_customer::findOrFail($id);
        $kotaNow1 = $kurcust->kantor_1->getKota->nama;
        $kotaNow2 = $kurcust->kantor_2->getKota->nama;
        $allKota = Kota::getAll()->get();
        return view('master.kurirNoncustomer.edit', compact('kurcust','kotaNow1', 'kotaNow2', 'allKota'));
    }

    public function update($id, Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $kurnoncust = Kurir_non_customer::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $kurnoncust->update($request);
        $success = "Data kurir non customer $id berhasil diubah.";
        Session::put('success-kurir_noncustomer', $success);
        return redirect('/admin/kurir_noncustomer');
    }
}
