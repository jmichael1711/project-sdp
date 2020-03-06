<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengiriman_customer;
use App\Kota;

class PengirimanCustomerController extends Controller
{
    public function create() {
        $nextId = Pengiriman_customer::getNextId();
        $allKota = Kota::getAll()->get();
        return view('master.pengirimanCustomer.create',compact('nextId','allKota'));
    }

    public function store(Request $request){
        dd($request->all());
    }
}
