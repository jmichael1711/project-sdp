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
        return view('master.pegawai.create',compact('allKota'));
    }

    public function index(){
        $allPegawai = Pegawai::get();
        return view('master.pegawai.index', compact('allPegawai'));
    }

    public function edit($id){
        $pegawai = Pegawai::findOrFail($id);
        $kotaNow = $pegawai->kantor->getKota->nama;
        $allKota = Kota::getAll()->get();
        return view('master.pegawai.edit', compact('pegawai','allKota','kotaNow'));
    }

    public function update($id, Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $pegawai = Pegawai::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $pegawai->update($request);
        $success = 'Data pegawai '.$id.' berhasil diubah.';
        Session::put('success', $success);
        return redirect('/admin/pegawai');
    }

    public function store(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $user = Session::get('id');
        
        $request['id'] = Pegawai::getNextId();
        $request['password'] = md5($request['password']);
        $request['user_created'] = $user;
        $request['user_updated'] = $user;

        Pegawai::create($request);
        $success = "Data pegawai berhasil didaftarkan.";

        return redirect('/admin/pegawai')->with(['success' => $success]);
    }

    public function isiKantor(Request $request){
        $kota = Kota::getAll()
        ->where('nama', $request->kota)
        ->first();
        
        $kantor = $kota->kantor;
        $response = '<option value="">-- TIDAK ADA KANTOR --</option>';
        if(count($kantor) != 0){
            $response = '';
            foreach($kantor as $i){
                $response .= '<option value="' . $i->id . '">' . $i->alamat . '</option>';
            }
        }
                
        return $response;
    }
}
