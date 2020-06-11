<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kota;
use App\Kantor;
use App\Kurir_customer;
use Illuminate\Support\Facades\Session;

class Kurir_customerController extends Controller
{
    public function index(){
        $kurcust = Kurir_customer::all();
        return view('master.kurirCustomer.index',['kurcust' => $kurcust]);
    }

    public function create(){
        $allKota = Kota::getAll()->get();
        return view('master.kurirCustomer.create',compact('allKota'));
    }

    public function store(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $request['id'] = Kurir_customer::getNextId();
        $request['status'] = 1;
        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        $request['password'] = md5($request['password']);
        Kurir_customer::create($request);
        $success = "Data kurir customer berhasil didaftarkan.";
        Session::put('success-kurir_customer', $success);
        return redirect('/admin/kurir_customer');
    }

    public function edit($id) {
        $kurcust = Kurir_customer::findOrFail($id);
        $kotaNow = $kurcust->kantor->getKota->nama;
        $allKota = Kota::getAll()->get();
        return view('master.kurirCustomer.edit', compact('kurcust', 'allKota', 'kotaNow'));
    }

    public function update($id, Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $kurcust = Kurir_customer::findOrFail($id);

        if($kurcust->password != $request['password'])
        {
            $request['password'] = md5($request['password']);
        }

        $request['user_updated'] = Session::get('id');
        $kurcust->update($request);
        $success = "Data kurir customer $id berhasil diubah.";
        Session::put('success-kurir_customer', $success);
        return redirect('/admin/kurir_customer');
    }
}
