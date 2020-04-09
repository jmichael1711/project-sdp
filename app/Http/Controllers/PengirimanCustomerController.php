<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Pengiriman_customer;
use App\Kurir_customer;
use App\Bon_Muat;
use App\Kota;
use App\Pesanan;
use App\Resi;
use App\Kantor;

class PengirimanCustomerController extends Controller
{
    public function create() {
        $nextId = Pengiriman_customer::getNextId();
        $allKota = Kota::getAll()->get();
        $allPesanan = Pesanan::getAll()->get();
        return view('master.pengirimanCustomer.create',compact('nextId','allKota', 'allPesanan'));
    }

    public function lihatPesanan(Request $request){
        $str = '';
        $allPesanan = Pesanan::getAll()->where("kota_asal",$request->kota)->where("resi_id","")->get();
        
        if(count($allPesanan) > 0) {
            foreach ($allPesanan as $pesanan) {
                $ada = "0";
                $allPengirimanCust = Pengiriman_customer::join('d_pengiriman_customers', 'd_pengiriman_customers.pengiriman_customer_id', '=', 'pengiriman_customers.id')->get();
                foreach ($allPengirimanCust as $pengirimanCust) {
                    if($pengirimanCust->resi_id == $pesanan->id) $ada = "1";
                }
                if($ada == "0"){
                    $str .= '<option selected class="form-control" value="'.$pesanan->id.'">'.$pesanan->alamat_asal.'</option>';
                }
                else{
                    $str = '<option class="form-control" value="">-- TIDAK ADA PESANAN --</option>';
                }
            }
        }
        else{
            $str = '<option class="form-control" value="">-- TIDAK ADA PESANAN --</option>';
        }
        return $str;
    }

    public function cheeckPesanan($id){
        
        return $ada;
    }

    public function index(){
        $allPengirimanCust = Pengiriman_customer::getAll()->get();
        $pengirimanCustPengirim = Pengiriman_customer::getAll()->where("menuju_penerima","0")->get();
        $pengirimanCustPenerima = Pengiriman_customer::getAll()->where("menuju_penerima","1")->get();
        return view('master.pengirimanCustomer.index',compact('allPengirimanCust','pengirimanCustPengirim','pengirimanCustPenerima'));
    }

    public function store(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();

        $idResi = $request["resi_id"];
        unset($request["resi_id"]);

        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;

        $kurir = Kurir_customer::findOrFail($request['kurir_customer_id']);
        $kurir->status = "0";
        $kurir->save();

        $pengirimanCust = Pengiriman_customer::create($request); 
        $pengirimanCust->resis()->attach($idResi, ['user_created' => $user, 'user_updated' => $user]);

        $success = "Data pengiriman customer berhasil didaftarkan.";
        return redirect('/admin/pengirimanCustomer')->with(['success' => $success]);
    }

    public function edit($id){
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $kotaNow = $pengirimanCust->kantor->kota;
        $allKota = Kota::getAll()->get();
        
        return view('master.pengirimanCustomer.edit', compact('pengirimanCust','allKota', 'kotaNow'));
    }

    public function update($id, Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $pengirimanCust->update($request);
        $success = "Data pengiriman customer $id berhasil diubah.";
        Session::put('success', $success);
        return redirect('/admin/pengirimanCustomer');
    }

    public function deleteDetail($id, Request $request){
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $resi = Resi::findorFail($request->id);
        $pengirimanCust->resis()->detach($request->id);
        $pengirimanCust->update(['total_muatan' => ($pengirimanCust->total_muatan-$resi->pesanan->berat_barang)]);
        return redirect('/admin/pengirimanCustomer/edit/'.$id);
    }

    public function addDetail($id, Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $resi = Resi::find($request['resi_id']);
        $diBonMuat = 'false';
        $diPengirimanCust = 'false';
        if($resi == null){
            Session::put("fail-detail","Resi tidak terdaftar");
            return redirect('/admin/pengirimanCustomer/edit/'.$id);
        }
        else{
            $allBonMuat = Bon_muat::getAll()->get();
            foreach($allBonMuat as $i){
                foreach($i->resis as $j){
                    if($j->id == $request['resi_id'] && $j->surat_jalan->telah_sampai == 0){
                        Session::put("fail-detail","Resi telah terdaftar di bon muat dengan ID = " . $i->id);
                        return redirect('/admin/pengirimanCustomer/edit/'.$id);
                    }
                }
            }
            $allPengirimanCust = Pengiriman_customer::getAll()->get();
            foreach($allPengirimanCust as $i){
                foreach($i->resis as $j){
                    if($j->id == $request['resi_id'] && $j->d_pengiriman_customer->telah_sampai == 0){
                        Session::put("fail-detail","Resi telah terdaftar di pengiriman customer dengan ID = " . $i->id);
                        return redirect('/admin/pengirimanCustomer/edit/'.$id);
                    }
                }
            }
            if($pengirimanCust->total_muatan+$resi->pesanan->berat_barang > 20){
                Session::put('fail-detail', "Berat melebihi batasan maksimal");
                return redirect('/admin/pengirimanCustomer/edit/'.$id);
            }

            $user = Session::get('id');
            $pengirimanCust->resis()->attach($request["resi_id"],['user_created' => $user]);
            $pengirimanCust->resis()->updateExistingPivot($request["resi_id"],['user_updated' => $user]);
            $pengirimanCust->update(['total_muatan' => ($pengirimanCust->total_muatan+$resi->pesanan->berat_barang)]);
            $pengirimanCust->update(['user_updated' => $user]);
            Session::put('success-detail', 'Detail pengiriman customer berhasil ditambahkan.');
            return redirect('/admin/pengirimanCustomer/edit/'.$id);
        }
    }

    public function deleteAll($id){
        $pengirimanCust = Pengiriman_customer::findorFail($id);
        $pengirimanCust->resis()->detach();
        $pengirimanCust->update(['total_muatan' => 0]);
        return redirect('/admin/pengirimanCustomer/edit/'.$id);
    }

    public function pengirim(){
        $allPengirimanCust = Pengiriman_customer::where("menuju_penerima",0)->get();
        return view('master.pengirimanCustomer.pengirim',compact('allPengirimanCust')); 
    }

    public function penerima(){
        $allPengirimanCust = Pengiriman_customer::where("menuju_penerima",1)->get();
        return view('master.pengirimanCustomer.penerima',compact('allPengirimanCust')); 
    }

    public function editPenerima($id){
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $status = "disabled";
        foreach($pengirimanCust->resis as $i){
            if($i->d_pengiriman_customer->telah_sampai == 0){
                $status = "";
            }
        } 
        return view('master.pengirimanCustomer.editPenerima', compact('pengirimanCust','status'));
    }

    public function updateDetailPenerima($id,Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $user = Session::get('id');
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $sampai =  $pengirimanCust->resis()->where("resi_id",$request["resi_id"])->first()->d_pengiriman_customer->telah_sampai;
        if($sampai == 0){
            $pengirimanCust->update(['user_updated' => $user]); 
            $pengirimanCust->resis()->updateExistingPivot($request["resi_id"],['telah_sampai' => 1]);
            $pengirimanCust->resis()->updateExistingPivot($request["resi_id"],['user_updated' => $user]);
            $success = 'Detail Pengiriman Customer '. $request["resi_id"]. ' telah selesai.';
            Session::put('success', $success);
            return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
        }else if($sampai == 1){
            $fail = "Resi ". $request["resi_id"] ." telah discan.";
            Session::put('success-faildetail', $fail);
            return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
        }
    }

}
