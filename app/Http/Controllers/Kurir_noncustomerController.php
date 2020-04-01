<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kantor;
use App\Kurir_non_customer;
use Illuminate\Support\Facades\Session;

class Kurir_noncustomerController extends Controller
{
    public function index(){
        $kurnoncust = Kurir_non_customer::all();
        return view('master.kurirNoncustomer.index',['kurnoncust' => $kurnoncust]);
    }

    public function create(){
        $listKanID = Kantor::getAll()->get();
        return view('master.kurirNoncustomer.create',['listKanID' => $listKanID]);
    }

    public function store(Request $request) {
        $request = $request->all();
        $request['id'] = Kurir_non_customer::getNextId();

        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        $request['status'] = 1;
        $request['posisi_di_kantor_1'] = 0;

        if($request['kantor_1_id'] != $request['kantor_2_id']){
            Kurir_non_customer::create($request);
            $success = "kurir Non Customer berhasil di-tambahkan";
            Session::put('success-kurir_noncustomer', $success);
        }else {
            $failed = "kurir Non Customer gagal di-tambahkan karena id kantor 1 dan id kantor 2 sama";
            Session::put('failed-kurir_noncustomer', $failed);
        }

        return redirect('/admin/kurir_noncustomer');
    }

    public function edit($id) {
        $listKurnoncust = Kurir_non_customer::getAll()->get();
        $listKanID = Kantor::getAll()->get();
        $kurnoncust = Kurir_non_customer::findOrFail($id);
        return view('master.kurirNoncustomer.edit', compact('listKurnoncust', 'kurnoncust','listKanID'));
    }

    public function update($id, Request $request) {
        $request = $request->all();
        $kurnoncust = Kurir_non_customer::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $kurnoncust->update($request);
        $success = "Kurir Non Customer dengan id: $id berhasil diupdate.";
        Session::put('success-kurir_noncustomer', $success);
        return redirect('/admin/kurir_noncustomer');
    }
}
