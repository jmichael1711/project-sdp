<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Resi;
use App\Kota;

class ResiController extends Controller
{
    public function create(){
        $nextId = Resi::getNextId();
        $allKota = Kota::getAll()->get();
        return view('master.resi.create', compact('nextId', 'allKota'));
    }

    public function store(Request $request){
        $request = $request->all();
        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        Resi::create($request);
        $success = "Data resi berhasil didaftarkan.";
        Session::put('success-pesanan', $success);
        return redirect('/admin/resi');
    }

    public function index(){
        return view('master.resi.index');
    }

    public function edit(){
        return view('master.resi.edit');
    }
}
