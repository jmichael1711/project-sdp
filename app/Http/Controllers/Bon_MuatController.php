<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantor;
use App\Bon_Muat;
use App\Kota;
use App\Kurir_non_customer;
use App\Resi;
use App\Kendaraan;
use Illuminate\Support\Facades\Session;
class Bon_MuatController extends Controller
{

    public function create() {
        $nextId = Bon_Muat::getNextId();
        $allKota = Kota::getAll()->get();
        return view('master.bonmuat.create',compact('nextId','allKota'));
    }

    public function store(Request $request) {
        $request = $request->all();
        $request['id'] = Bon_muat::getNextId();
        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        $success = "Bon muat berhasil di-inputkan.";
        Bon_muat::create($request);
        return redirect('/admin/bonmuat/create')->with(['success-bonmuat' => $success]);
    }

    public function find(Request $request){
        $allKurir = Kurir_non_customer::sortKurir($request->kantorAsal,$request->kantorTujuan);
        $allKendaraan = Kendaraan::sortKendaraan($request->kantorAsal,$request->kantorTujuan);
        $str = '';
        if($allKurir->count() > 0){
            foreach($allKurir as $kurir){
                if($kurir->id == $request->kurir){
                    $str .= '<option selected class="form-control" value="'.$kurir->id.'">'.$kurir->nama.'</option>';
                }else{
                    $str .= '<option class="form-control" value="'.$kurir->id.'">'.$kurir->nama.'</option>';
                }
            }
        }else $str .= '<option class="form-control" value="">-- TIDAK ADA KURIR --</option>';
        
        $str .= '|';
        if($allKendaraan->count() > 0){    
            foreach($allKendaraan as $kendaraan){
                if($kendaraan->id == $request->kendaraan){
                    $str .='<option selected class="form-control" value="'.$kendaraan->id.'">'.$kendaraan->nopol.'</option>';
                }else{
                    $str .='<option class="form-control" value="'.$kendaraan->id.'">'.$kendaraan->nopol.'</option>';
                }
            }
        }else $str .= '<option class="form-control" value="">-- TIDAK ADA KENDARAAN --</option>';
        return $str;
    }


    public function index() {
        $allBonMuat = Bon_muat::getAll()->get();
        $allResi = Resi::getAll()->get();
        return view('master.bonmuat.index',compact('allBonMuat','allResi'));
    }

    public function edit($id) {
        $allKota = Kota::getAll()->get();
        $bonmuat = Bon_Muat::findOrFail($id);
        return view('master.bonmuat.edit', compact('allKota', 'bonmuat'));
    }

    public function update($id, Request $request) {
        $request = $request->all();
        $bonmuat = Bon_Muat::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $bonmuat->update($request);
        $success = 'Bon Muat berhasil diubah.';
        Session::put('success-bonmuat', $success);
        return redirect('/admin/bonmuat');
    }

    public function addSuratJalan($id,Request $request){
        $bonmuat = Bon_Muat::findorFail($id);
        $resi = Resi::find($request["resi_id"]);
        $found = false;
        foreach($bonmuat->resis as $i){if($i->id == $request["resi_id"]) $found = true;}
        if($resi == null){
            $fail = "Resi tidak terdaftar";
            Session::put('success-failsuratjalan', $fail);
            return redirect('/admin/bonmuat/edit/'.$id);
        }else if($found == true){
            $fail = "Resi telah terdaftar";
            Session::put('success-failsuratjalan', $fail);
            return redirect('/admin/bonmuat/edit/'.$id);
        }
        else if($found == false){
            $user = Session::get('id');
            $bonmuat->resis()->attach($request["resi_id"],['user_created' => $user]);
            $bonmuat->resis()->updateExistingPivot($request["resi_id"],['user_updated' => $user]);
            $bonmuat->update(['total_muatan' => ($bonmuat->total_muatan+$resi->pesanan->berat_barang)]);
            $bonmuat->update(['user_updated' => $user]);
            $success = 'Surat Jalan berhasil ditambahkan.';
            Session::put('success-suratjalan', $success);
            return redirect('/admin/bonmuat/edit/'.$id);
        }
    }
}
