<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kantor;
use App\Bon_Muat;
use App\Kota;
use App\Kurir_non_customer;
use App\Resi;
use App\Kendaraan;
use App\Pengiriman_customer;
use Illuminate\Support\Facades\Session;
class Bon_MuatController extends Controller
{

    public function create() {
        $nextId = Bon_Muat::getNextId();
        $allKota = Kota::getAll()->get();
        return view('master.bonmuat.create',compact('nextId','allKota'));
    }

    public function store(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $request['id'] = Bon_muat::getNextId();
        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;
        $success = "Bon muat berhasil didaftarkan.";
        Bon_muat::create($request);
        return redirect('/admin/bonmuat')->with(['success-bonmuat' => $success]);
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
        $allBonMuat = Bon_muat::get();
        return view('master.bonmuat.index',compact('allBonMuat'));
    }

    public function edit($id) {
        $allKota = Kota::getAll()->get();
        $bonmuat = Bon_Muat::findOrFail($id);
        return view('master.bonmuat.edit', compact('allKota', 'bonmuat'));
    }

    public function update($id, Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $bonmuat = Bon_Muat::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $bonmuat->update($request);
        $success = 'Bon Muat ' . '"' . $id .  '"' . 'berhasil diubah.';
        Session::put('success-bonmuat', $success);
        return redirect('/admin/bonmuat');
    }

    public function addSuratJalan($id,Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $bonmuat = Bon_Muat::findorFail($id);
        $allBonMuat = Bon_Muat::getAll()->get();
        $allPengirimanCust = Pengiriman_customer::getAll()->get();
        $resi = Resi::find($request["resi_id"]);
        $found = false;
        $overweight = false;
        if($resi == null){
            $fail = "Resi tidak terdaftar.";
            Session::put('success-failsuratjalan', $fail);
            return redirect('/admin/bonmuat/edit/'.$id);
        }
        if($resi != null){
            foreach($allBonMuat as $i){    
                foreach($i->resis as $j){
                    if($j->id == $request["resi_id"] && $j->surat_jalan->telah_sampai == 0){
                        $fail = "Resi telah terdaftar di Bon muat dengan ID = ". $i->id . ".";
                        Session::put('success-failsuratjalan', $fail);
                        return redirect('/admin/bonmuat/edit/'.$id);
                    }
                }
            }
            
            foreach($allPengirimanCust as $i){
                foreach($i->resis as $j){
                    if($j->id == $request['resi_id'] && $j->d_pengiriman_customer->telah_sampai == 0){
                        Session::put("success-failsuratjalan","Resi telah terdaftar di Pengiriman customer dengan ID = " . $i->id . ".");
                        return redirect('/admin/bonmuat/edit/'.$id);
                    }
                }
            }
            foreach($bonmuat->resis as $i){if($i->id == $request["resi_id"]) $found = true;}
            if($bonmuat->total_muatan+$resi->pesanan->berat_barang > 1000) $overweight = true;
            if($found){
                $fail = "Resi telah terdaftar di Bon muat ini.";
                Session::put('success-failsuratjalan', $fail);
                return redirect('/admin/bonmuat/edit/'.$id);
            }else if(!$found && $overweight){
                $fail = "Berat barang melebihi batas maksimal.";
                Session::put('success-failsuratjalan', $fail);
                return redirect('/admin/bonmuat/edit/'.$id);
            }else if(!$found && !$overweight){
                $user = Session::get('id');
                $bonmuat->resis()->attach($request["resi_id"],['user_created' => $user]);
                $bonmuat->resis()->updateExistingPivot($request["resi_id"],['user_updated' => $user]);
                $bonmuat->update(['total_muatan' => ($bonmuat->total_muatan+$resi->pesanan->berat_barang)]);
                $bonmuat->update(['user_updated' => $user]);
                $success = 'Surat Jalan berhasil didaftarkan.';
                Session::put('success-suratjalan', $success);
                return redirect('/admin/bonmuat/edit/'.$id);
            }
        }
    }

    public function deleteSuratJalan(Request $request){
        $bonmuat = Bon_Muat::findorFail($request->bonmuat);
        $resi = Resi::findorFail($request->id);
        $bonmuat->resis()->detach($request->id);
        $bonmuat->update(['total_muatan' => ($bonmuat->total_muatan-$resi->pesanan->berat_barang)]);
        return redirect('/admin/bonmuat/edit/'.$bonmuat->id);
    }

    public function deleteAll($id){
        $bonmuat = Bon_Muat::findorFail($id);
        $bonmuat->resis()->detach();
        $bonmuat->update(['total_muatan' => 0]);
        return redirect('/admin/bonmuat/edit/'.$id);
    }

    public function incomingbonmuat(){
        // jika admin kota maka harus ambil bon muat yang akan datang ke kota itu saja
        // jika pegawai atau kasir maka harus ambil bon muat yang akan datang ke kantor itu saja
        // jika admin super maka ambil semua bon muat yang ada
        $allBonMuat = Bon_Muat::getAll()->get(); //untuk admin super
        return view('master.bonmuat.incomingbonmuat',compact('allBonMuat'));
    }

    public function editSuratJalan($id) {
        $bonmuat = Bon_Muat::findOrFail($id);
        $status = "disabled";
        foreach($bonmuat->resis as $i){
            if($i->surat_jalan->telah_sampai == 0){
                $status = "";
            }
        } 
        return view('master.bonmuat.editSuratJalan', compact('bonmuat','status'));
    }

    public function updateSuratJalan($id,Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $user = Session::get('id');
        $resi = Resi::find($request["resi_id"]);
        $bonmuat = Bon_Muat::findOrFail($id);
        $sampai =  $bonmuat->resis()->where("resi_id",$request["resi_id"])->first()->surat_jalan->telah_sampai;
        if($sampai == 0){
            $bonmuat->update(['total_muatan' => ($bonmuat->total_muatan-$resi->pesanan->berat_barang)]);
            $bonmuat->update(['user_updated' => $user]); 
            $bonmuat->resis()->updateExistingPivot($request["resi_id"],['telah_sampai' => 1]);
            $bonmuat->resis()->updateExistingPivot($request["resi_id"],['user_updated' => $user]);
            $success = 'Surat Jalan '. $request["resi_id"]. ' telah selesai.';
            Session::put('success-suratjalan', $success);
            return redirect('/admin/bonmuat/editSuratJalan/'.$id);
        }else if($sampai == 1){
            $fail = "Resi ". $request["resi_id"] ." telah discan.";
            Session::put('success-failsuratjalan', $fail);
            return redirect('/admin/bonmuat/editSuratJalan/'.$id);
        }
        
    }
}
