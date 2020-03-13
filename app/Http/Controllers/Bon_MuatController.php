<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantor;
use App\Bon_Muat;
use App\Kota;
use App\Kurir_non_customer;
use App\Kendaraan;
class Bon_MuatController extends Controller
{

    public function create() {
        $nextId = Bon_Muat::getNextId();
        $allKota = Kota::getAll()->get();
        return view('master.bonmuat.create',compact('nextId','allKota'));
    }

    public function store(Request $request) {
        $request = $request->all();
        Bon_muat::insert($request);
        $success = "Bon muat berhasil di-inputkan.";

        return redirect('/admin/bonmuat/create')->with(['success-bonmuat' => $success]);
    }

    public function findKurir(Request $request){
        $allKurir = Kurir_non_customer::sortKurir($request->kantorAsal,$request->kantorTujuan);
        $allKendaraan = Kendaraan::sortKendaraan($request->kantorAsal,$request->kantorTujuan);
        $str = '';
        foreach($allKurir as $kurir){
            $str .= '<option class="form-control" value="'.$kurir->id.'">'.$kurir->nama.'</option>';
        }
        $str .= '|';
        if($allKendaraan->count() > 0){    
            foreach($allKendaraan as $kendaraan){
                $str .='<option class="form-control" value="'.$kendaraan->id.'">'.$kendaraan->nopol.'</option>';
            }
        }else $str .= '<option class="form-control" value="">-- TIDAK ADA KENDARAAN --</option>';
        
        return $str;
    }

    public function fetch(Request $request)
    {
        return response()->json([
            'sdsd' => "assdd"
        ])->setStatusCode(200);
    }
}
