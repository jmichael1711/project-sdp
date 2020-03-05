<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantor;

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
        $listKota = $this->getListKota();
        return view('master.kantor.create', compact('listKota'));
    }

    public function store(Request $request) {
        $request = $request->all();
        Kantor::insert($request);
        $success = "Kantor berhasil di-inputkan.";
        $listKota = $this->getListKota();

        return redirect('/admin/kantor/create')->with(['success' => $success]);
    }

    public function edit($id) {
        $listKota = $this->getListKota();
        $kantor = Kantor::findOrFail($id);
        return view('master.kantor.edit', compact('listKota', 'kantor'));
    }

    public function update($id, Request $request) {
        $request = $request->all();
        $kantor = Kantor::findOrFail($id);
        $kantor->update($request);
        return redirect('/admin/kantor');
    }
}
