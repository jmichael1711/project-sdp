<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Pengiriman_customer;
use App\Kota;
use App\Kantor;

class PengirimanCustomerController extends Controller
{
    public function create() {
        $nextId = Pengiriman_customer::getNextId();
        $allKota = Kota::getAll()->get();
        return view('master.pengirimanCustomer.create',compact('nextId','allKota'));
    }

    public function index(){
        $allPengirimanCust = Pengiriman_customer::getAll()->get();
        return view('master.pengirimanCustomer.index',compact('allPengirimanCust'));
    }

    public function store(Request $request){
        $request = $request->all();
        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;

        Pengiriman_customer::create($request);
        $success = "Pengiriman Customer berhasil di-inputkan.";

        return redirect('/admin/pengirimanCustomer/create')->with(['success' => $success]);
    }

    public function edit($id){
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $kotaNow = $pengirimanCust->kantor->kota;
        $allKota = Kota::getAll()->get();
        
        return view('master.pengirimanCustomer.edit', compact('pengirimanCust','allKota', 'kotaNow'));
    }

    public function update($id, Request $request) {
        $request = $request->all();
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $pengirimanCust->update($request);
        $success = 'Pengiriman Customer berhasil diubah.';
        Session::put('success', $success);
        return redirect('/admin/pengirimanCustomer');
    }

}
