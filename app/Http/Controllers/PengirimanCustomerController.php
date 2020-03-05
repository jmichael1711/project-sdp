<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengiriman_customer;
use App\Kurir_customer;
use App\Kantor;

class PengirimanCustomerController extends Controller
{
    public function create() {
        $nextId = Pengiriman_customer::getNextId();
        $allKantor = Kantor::getAll();
        return view('master.pengirimanCustomer.create',compact('nextId','allKantor'));
    }
}
