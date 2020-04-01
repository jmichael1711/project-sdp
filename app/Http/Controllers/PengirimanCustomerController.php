<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Pengiriman_customer;
use App\Bon_Muat;
use App\Kota;
use App\Resi;
use App\Kantor;

class PengirimanCustomerController extends Controller
{
    public function create() {
        $nextId = Pengiriman_customer::getNextId();
        $allKota = Kota::getAll()->get();
        return view('master.pengirimanCustomer.create',compact('nextId','allKota'));
    }

    public function index(){
        $allPengirimanCust = Pengiriman_customer::getAll()->get();
        return view('master.pengirimanCustomer.index',compact('allPengirimanCust'));
    }

    public function store(Request $request){
        $request = $request->all();
        $user = Session::get('id');
        $request['user_created'] = $user;
        $request['user_updated'] = $user;

        Pengiriman_customer::create($request);
        $success = "Pengiriman Customer berhasil di-inputkan.";

        return redirect('/admin/pengirimanCustomer/create')->with(['success' => $success]);
    }

    public function edit($id){
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $kotaNow = $pengirimanCust->kantor->kota;
        $allKota = Kota::getAll()->get();
        
        return view('master.pengirimanCustomer.edit', compact('pengirimanCust','allKota', 'kotaNow'));
    }

    public function update($id, Request $request) {
        $request = $request->all();
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $request['user_updated'] = Session::get('id');
        $pengirimanCust->update($request);
        $success = 'Pengiriman Customer berhasil diubah.';
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

}
