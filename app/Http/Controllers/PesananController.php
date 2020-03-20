<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pesanan;
use App\kota;
use App\Kurir_customer;
use App\Resi;
use Illuminate\Support\Facades\Session;

class PesananController extends Controller
{

    public function index(){
        $orders = Pesanan::all();
        return view('master.pesanan.index',['orders' => $orders]);
    }

    public function create(){
        $listKota = Kota::getAll()->get();
        $listKurID = Kurir_customer::getAll()->get();
        $listResiID = Resi::getAll()->get();
        return view('master.pesanan.create', compact('listKota','listKurID','listResiID'));
    }

    public function store(Request $request) {
        $request = $request->all();
        $user = Session::get('id');
        $request['id'] = Pesanan::getNextId();
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        $boleh = Pesanan::cek($request['id']);
        if($boleh == true){
            Pesanan::create($request);
            $success = "Pesanan berhasil di-tambahkan";
            Session::put('success-pesanan', $success);
        }else {
            $failed = "Pesanan gagal didaftarkan";
            Session::put('failed-pesanan', $failed);
        }

        return redirect('/admin/pesanan');
    }

    public function edit($id) {
        $listpesanan = pesanan::getAll()->get();
        $pesanan = pesanan::findOrFail($id);
        return view('master.pesanan.edit', compact('listpesanan', 'pesanan'));
    }

    public function update($id, Request $request) {
        $request = $request->all();
        $orders = Pesanan::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $orders->update($request);
        $success = "Pesanan dengan id $id berhasil diupdate.";
        Session::put('success-pesanan', $success);
        return redirect('/admin/pesanan');
    }

}
