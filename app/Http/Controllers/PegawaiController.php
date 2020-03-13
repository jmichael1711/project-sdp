<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Kota;
use App\Kantor;
use App\Pegawai;

class PegawaiController extends Controller
{
    public function create(){
        $allKota = Kota::getAll()->get();
        $nextId = Pegawai::getNextId();
        return view('master.pegawai.create',compact('allKota','nextId'));
    }

    public function store(Request $request){
        $request = $request->all();
        $user = Session::get('id');

        Pegawai::create($request);
        $success = "Pegawai berhasil di-inputkan.";

        return redirect('/admin/pegawai/create')->with(['success' => $success]);
    }

    public function isiKantor(Request $request){
        $kota = Kota::getAll()
        ->where('nama', $request->kota)
        ->first();
        
        $kantor = $kota->kantor;
        $response = '';
        if(count($kantor) == 0){
            $response = '<option value="">-- TIDAK ADA KANTOR --</option>';
        }
        else{
            foreach($kantor as $i){
                $response .= '<option value="' . $i->id . '">' . $i->alamat . '</option>';
            }
        }
                
        return $response;
    }
}
