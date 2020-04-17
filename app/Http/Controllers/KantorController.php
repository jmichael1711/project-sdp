<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantor;
use App\Kota;
use Illuminate\Support\Facades\Session;

class KantorController extends Controller
{
    public function index() {
        $kantors = Kantor::all();
        return view('master.kantor.index', compact('kantors'));
    }

    public function create() {
        $listKota = Kota::getAll()->get();
        return view('master.kantor.create', compact('listKota'));
    }

    public function store(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $request['id'] = Kantor::getNextId();
        $user = Session::get('id');

        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        Kantor::create($request);   
        $success = "Data kantor berhasil didaftarkan.";
        Session::put('success-kantor', $success);
        return redirect('/admin/kantor');
    }

    public function edit($id) {
        $listKota = Kota::getAll()->get();
        $kantor = Kantor::findOrFail($id);
        return view('master.kantor.edit', compact('listKota', 'kantor'));
    }

    public function update($id, Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $kantor = Kantor::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $kantor->update($request);
        $success = 'Data kantor '.$id.' berhasil diubah.';
        Session::put('success-kantor', $success);
        return redirect('/admin/kantor');
    }
}
