<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KantorController extends Controller
{
    public function index() {
        
    }

    public function create() {
        return view('master.kantor.create');
    }
}
