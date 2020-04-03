<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pesanan;
use App\kota;
use App\Kurir_customer;
use App\Resi;
use App\Pegawai;
use Illuminate\Support\Facades\Session;

class PesananController extends Controller
{

    public function index(){
        $orders = Pesanan::all();
        return view('master.pesanan.index',['orders' => $orders]);
    }

    public function create(){
        $pegawai = Pegawai::findorFail(Session::get('id'));
        $idkan = $pegawai->kantor->id;
        $listKota = Kota::getAll()->get();
        $listKurID = Kurir_customer::getKurKantor($idkan)->get();
        $listResiID = Resi::getAll()->get();
        return view('master.pesanan.create', compact('listKota','listKurID','listResiID'));
    }

    public function store(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $user = Session::get('id');
        $request['id'] = Pesanan::getNextId();
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        $request['waktu_berangkat_kurir'] = date("Y-m-d H:i:s");
        Pesanan::create($request);
        $success = "Pesanan berhasil di-tambahkan";
        Session::put('success-pesanan', $success);
        return redirect('/admin/pesanan');
    }

    public function edit($id) {
        $listpesanan = pesanan::getAll()->get();
        $pesanan = pesanan::findOrFail($id);
        return view('master.pesanan.edit', compact('listpesanan', 'pesanan'));
    }

    public function update($id, Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $orders = Pesanan::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $orders->update($request);
        $success = "Pesanan dengan id $id berhasil diupdate.";
        Session::put('success-pesanan', $success);
        return redirect('/admin/pesanan');
    }

}
