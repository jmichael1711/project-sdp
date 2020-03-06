<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Pengiriman_customer;
use App\Kota;

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
        $request['user_created'] = 'testUser';
        $request['user_updated'] = 'testUser';

        Pengiriman_customer::create($request);
        $success = "Pengiriman Customer berhasil di-inputkan.";

        return redirect('/admin/pengirimanCustomer/create')->with(['success' => $success]);
    }
}
