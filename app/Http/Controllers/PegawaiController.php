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

    public function index(){
        $allPegawai = Pegawai::getAll()->get();
        return view('master.pegawai.index', compact('allPegawai'));
    }

    public function edit($id){
        $pegawai = Pegawai::findOrFail($id);
        $kotaNow = $pegawai->kantor->getKota->nama;
        $allKota = Kota::getAll()->get();
        return view('master.pegawai.edit', compact('pegawai','allKota','kotaNow'));
    }

    public function update($id, Request $request){
        $request = $request->all();
        $pegawai = Pegawai::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $pegawai->update($request);
        $success = 'Pegawai berhasil diubah.';
        Session::put('success', $success);
        return redirect('/admin/pegawai');
    }

    public function store(Request $request){
        $request = $request->all();
        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;

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
