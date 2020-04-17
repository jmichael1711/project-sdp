<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Resi;
use App\Kota;
use App\Pegawai;
use App\Pengiriman_customer;

class ResiController extends Controller
{
    public function create(){
        $nextId = Resi::getNextId();
        $allKota = Kota::getAll()->get();
        return view('master.resi.create', compact('nextId', 'allKota'));
    }

    public function store(Request $request){
        $request = $request->all();
        $user = Pegawai::findOrFail(Session::get('id'));
        $request['id'] = Resi::getNextId();
        $request['user_created'] = $user->id;
        $request['user_updated'] = $user->id;

        if(substr($user->id, 0, 2) == "PE"){
            $request['verifikasi'] = 1;
            $request['kantor_asal_id'] = $user->kantor->id;
        }else $request['verifikasi'] = 0;

        $request['harga'] = preg_replace("/[^0-9]/", "", $request['harga'])/100;
        Resi::create($request);
        $success = "Data resi berhasil didaftarkan.";
        Session::put('success-resi', $success);
        return redirect('/admin/resi');
    }

    public function index(){
        $user = Pegawai::findOrFail(Session::get('id'));
        $allResi = "";
        if($user->jabatan == "admin"){
            $allResi = Resi::getAll()->get();
        }else if($user->jabatan == "kasir"){
            $allResi = Resi::where("kantor_asal_id","=",$user->kantor_id)->get();
        }
        return view('master.resi.index',compact('allResi'));
    }

    public function edit($id){
        $resi = Resi::findOrFail($id);
        $resi->harga = "Rp " . number_format($resi->harga, 2, ".", ",");
        $status = "";
        if($resi->status_perjalanan == "CANCEL" || $resi->status_perjalanan == "SELESAI"){$status = "disabled";}
        $allKota = Kota::getAll()->get();
        return view('master.resi.edit',compact('resi','status','allKota'));
    }

    public function update($id, Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $resi = Resi::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $request['harga'] = preg_replace("/[^0-9]/", "", $request['harga'])/100;
        $resi->update($request);
        $success = 'Resi ' . '"' . $id .  '"' . 'berhasil diubah.';
        Session::put('success-resi', $success);
        return redirect('/admin/resi');
    }

    public function countCost(Request $request){
        $kotaAsal = Kota::findOrFail($request->kotaAsal);
        $kotaTujuan = Kota::findOrFail($request->kotaTujuan);
        $berat = $request->berat*1000;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$kotaAsal->id&destination=$kotaTujuan->id&weight=$berat&courier=jne",
            CURLOPT_HTTPHEADER => array(
              "content-type: application/x-www-form-urlencoded",
              "key: 49768eb68a44d897fd2e9c80a576d8b9"
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        $data = json_decode($response, true); 
        $harga = $data["rajaongkir"]["results"][0]["costs"][0]["cost"][0]["value"];
        $hasil =  "Rp " . number_format($harga, 2, ".", ",");
        return $hasil;
    }

    public function countResi(){
        $user = Pegawai::findOrFail(Session::get('id'));
        if($user->jabatan == "kasir"){
            $allResi = Resi::getAll()->where("kantor_asal_id","=",$user->kantor_id)->where("verifikasi",0)->get();
            $allPengirimanCustomer = Pengiriman_customer::getAll()->where("kantor_id","=",$user->kantor_id)->where("menuju_penerima",0)->get();
        }else{
            $allResi = Resi::getAll()->where("verifikasi",0)->get();
            $allPengirimanCustomer = Pengiriman_customer::getAll()->where("menuju_penerima",0)->get();
        }
        $count = 0;
        foreach($allResi as $i){
            $found = false;
            foreach($allPengirimanCustomer as  $j){
                foreach($j->resis as $k){
                    if($i->id == $k->id){
                        $found = true;
                    }
                }
            }
            if($found == false){
                $count += 1;
            }
        }
        return $count;
    }
    
}
