<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kota;
use App\Pesanan;
use App\Resi;

class CustomerController extends Controller
{
    public function index() {
        $page = 'index';
        return view('customer.index', compact('page'));
    }

    public function order() {
        $listKota = Kota::getAll()->get(); 
        $page = 'pesan';
        return view('customer.order', compact('listKota', 'page'));
    }

    public function inputPesanan(Request $request) {
        $request = $request->all();
        $request['id'] = Resi::getNextId();
        $request['verifikasi'] = 0;
        $request['status_perjalanan'] = 'perjalanan';

        //ganti
        $request['harga'] = 15000;
        //

        date_default_timezone_set("Asia/Jakarta");
        Resi::create($request);  

        return redirect('/pesanselesai');
    }

    public function pesanSelesai(Request $request) {
        $page = 'none';
        return view('customer.pesanselesai', compact('page'));
    }
}
