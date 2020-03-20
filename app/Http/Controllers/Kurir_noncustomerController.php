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
        $kurcust = Kurir_non_customer::all();
        return view('master.kurirNoncustomer.index',['kurcust' => $kurcust]);
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
        Kurir_non_customer::create($request);
        $success = "kurir customer berhasil di-tambahkan";
        Session::put('success-kurir_customer', $success);
        return redirect('/admin/kurir_customer');
    }

    public function edit($id) {
        $listKurcust = Kurir_non_customer::getAll()->get();
        $listKanID = Kantor::getAll()->get();
        $kurcust = Kurir_non_customer::findOrFail($id);
        return view('master.kurirCustomer.edit', compact('listKurcust', 'kurcust','listKanID'));
    }

    public function update($id, Request $request) {
        $request = $request->all();
        $kurcust = Kurir_non_customer::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $kurcust->update($request);
        $success = "Kurir Customer dengan id: $id berhasil diupdate.";
        Session::put('success-kurir_customer', $success);
        return redirect('/admin/kurir_customer');
    }
}
