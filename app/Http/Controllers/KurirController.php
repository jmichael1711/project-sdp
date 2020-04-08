<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    public function indexKurirCustomer() {
        return view('kurir.kurircustomerindex');
    }
}
