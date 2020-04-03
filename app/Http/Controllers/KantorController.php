<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantor;
use App\Kota;
use Illuminate\Support\Facades\Session;

class KantorController extends Controller
{
    public function getListKota() {
        $list = [
            'KABUPATEN BANGKALAN',
            'KABUPATEN BANYUWANGI',
            'KABUPATEN BLITAR',
            'KABUPATEN BOJONEGORO',
            'KABUPATEN BONDOWOSO',
            'KABUPATEN GRESIK',
            'KABUPATEN JEMBER',
            'KABUPATEN JOMBANG',
            'KABUPATEN KEDIRI',
            'KABUPATEN LAMONGAN',
            'KABUPATEN LUMAJANG',
            'KABUPATEN MADIUN',
            'KABUPATEN MAGETAN',
            'KABUPATEN MALANG',
            'KABUPATEN MOJOKERTO',
            'KABUPATEN NGANJUK',
            'KABUPATEN NGAWI',
            'KABUPATEN PACITAN',
            'KABUPATEN PAMEKASAN',
            'KABUPATEN PASURUAN',
            'KABUPATEN PONOROGO',
            'KABUPATEN PROBOLINGGO',
            'KABUPATEN SAMPANG',
            'KABUPATEN SIDOARJO',
            'KABUPATEN SITUBONDO',
            'KABUPATEN SUMENEP',
            'KABUPATEN TRENGGALEK',
            'KABUPATEN TUBAN',
            'KABUPATEN TULUNGAGUNG',
            'KOTA BATU',
            'KOTA BLITAR',
            'KOTA KEDIRI',
            'KOTA MADIUN',
            'KOTA MALANG',
            'KOTA MOJOKERTO',
            'KOTA PASURUAN',
            'KOTA PROBOLINGGO',
            'KOTA SURABAYA'
        ];
        return $list;
    }

    public function index() {
        $kantors = Kantor::all();
        return view('master.kantor.index', compact('kantors'));
    }

    public function create() {
        $nextId = Kantor::getNextId();
        $listKota = Kota::getAll()->get();
        return view('master.kantor.create', compact('listKota', 'nextId'));
    }

    public function store(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $request['id'] = Kantor::getNextId();
        $user = Session::get('id');
        
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        Kantor::create($request);   
        $success = "Kantor berhasil didaftarkan.";
        Session::put('success-kantor', $success);
        return redirect('/admin/kantor/create');
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
        $success = 'Kantor berhasil diubah.';
        Session::put('success-kantor', $success);
        return redirect('/admin/kantor');
    }
}
