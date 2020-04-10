<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kota;
use App\Pesanan;
use App\Resi;
use App\Sejarah;

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

        //ganti jadi pakai raja ongkir
        $request['harga'] = 15000;
        //

        date_default_timezone_set("Asia/Jakarta");
        $resi = Resi::create($request);  

        $keterangan = "Pesanan telah dibuat.";

        $sejarah = [
            'resi_id' => $resi->id,
            'keterangan' => $keterangan,
            'waktu' => $resi->created_at
        ];

        Sejarah::create($sejarah);

        return redirect('/pesanselesai');
    }

    public function pesanSelesai(Request $request) {
        $page = 'none';
        return view('customer.pesanselesai', compact('page'));
    }

    public function track(Request $request) {
        $request = $request->all();

        $sejarah = Sejarah::where('resi_id', $request['resi_id'])
        ->orderBy('waktu', 'asc')
        ->get();

        $page = 'track';

        $resi = Resi::findOrFail($request['resi_id']);

        return view('customer.track', compact('sejarah', 'page', 'resi'));
    }
}
