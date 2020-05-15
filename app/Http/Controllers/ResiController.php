<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Resi;
use App\Kota;
use App\Pegawai;
use App\Pengiriman_customer;
use App\Sejarah;

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
            $request['status_verifikasi_email'] = 1;
            $request['kantor_asal_id'] = $user->kantor->id;
            $request['kantor_sekarang_id'] = $user->kantor->id;
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

            //untuk select resi yang dipesan oleh customer dari web dan belum diproses di pengiriman_customer
            $allPengirimanCustomer = DB::table('d_pengiriman_customers')->select('resi_id');
            $allResiBaru = Resi::getAll()
            ->where("verifikasi",0)
            ->whereNotIn('id', $allPengirimanCustomer)
            ->get();
            //
        }else if($user->jabatan == "kasir"){
            $allResi = Resi::where("kantor_asal_id","=",$user->kantor_id)
            ->where(function ($q) {
                $q->where("status_perjalanan","=","PERJALANAN");
                $q->orWhere("status_perjalanan","=","BATAL");
            })
            ->get();

            //untuk select resi yang dipesan oleh customer dari web dan belum diproses di pengiriman_customer
            $allPengirimanCustomer = DB::table('d_pengiriman_customers')->select('resi_id');
            $allResiBaru = Resi::getAll()
            ->where("kantor_asal_id","=",$user->kantor_id)
            ->where("verifikasi",0)
            ->whereNotIn('id', $allPengirimanCustomer)
            ->get();
            //
        }
       
    
        //untuk select resi yang sekarang posisi nya dikantor ini tetapi kantor asalnya bukan dari kantor ini dan status perjalanan nya masih perjalanan
        $allResiSedangDiKantorIni = Resi::getAll()
        ->where("kantor_sekarang_id","=",$user->kantor_id)
        ->where("kantor_asal_id","<>",$user->kantor_id)
        ->where(function ($q) {
            $q->where("status_perjalanan","=","PERJALANAN");
            $q->orWhere("status_perjalanan","=","BATAL");
        })
        ->get();
        //

        return view('master.resi.index',compact('allResi','allResiBaru','allResiSedangDiKantorIni'));
    }

    public function edit($id){
        $resi = Resi::find($id);
        if($resi == null){
            $fail = "Resi tidak terdaftar.";
            Session::put('success-failresi', $fail);
            return redirect('/admin/resi');
        }else{
            $resi = Resi::findOrFail($id);
            $resi->harga = "Rp " . number_format($resi->harga, 2, ".", ",");
            
            $user = Pegawai::findOrFail(Session::get('id'));

            $status = "";
            if($resi->status_perjalanan == "SELESAI"){$status = "disabled";}

            $selesai = 0;
            if($user->jabatan != "admin"){
                if($resi->status_perjalanan == "PERJALANAN") 
                {
                    if($resi->kantor_asal_id != $user->kantor_id && $resi->kantor_sekarang_id != null && $user->kantor->kota == $resi->kantor_sekarang->kota)
                    {$selesai = 1;}
                }else if($resi->status_perjalanan == "BATAL"){
                    if($resi->kantor_sekarang_id != null && $user->kantor->kota == $resi->kantor_sekarang->kota)
                    {$selesai = 1;}
                }
            }else if($user->jabatan == "admin" && ($resi->status_perjalanan == "PERJALANAN" ||$resi->status_perjalanan == "BATAL")) $selesai = 1;
            $allKota = Kota::getAll()->get();
            return view('master.resi.edit',compact('resi','status','allKota','selesai'));
        }
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

    public function trackResi(){
        return view('master.resi.trackResi');
    }

    public function isiSejarah(Request $request){
        $id = $request['id'];
        $resi = Resi::find($id);
        if($resi == null){
            return "null";
        }
        else{
            return redirect('/admin/resi/trackingField/'.$id);
        }
    }

    public function trackingField($id){
        $resi = Resi::find($id);
        $allSejarah = $resi->sejarahs;
        return view('master.resi.trackingField', compact('resi', 'allSejarah'));
    }

    public function print($id){
        $resi = Resi::find($id);
        $user = Pegawai::findOrFail(Session::get('id'));
        $harga =  "Rp " . number_format($resi->harga, 2, ".", ",");
        return view('master.resi.print', compact('resi','user','harga'));
    }

    public function selesai($id,$otp){
        date_default_timezone_set("Asia/Jakarta");
        $resi = Resi::find($id);

        $pengirimanCustomer = Pengiriman_customer::
        join('d_pengiriman_customers', 'd_pengiriman_customers.pengiriman_customer_id', '=', 'pengiriman_customers.id')
        ->where('pengiriman_customers.menuju_penerima',1)
        ->where('pengiriman_customers.is_deleted',0)
        ->where('d_pengiriman_customers.resi_id','=',$id)
        ->orderBy('d_pengiriman_customers.created_at','desc')        
        ->first();

        $errorPassword = false;
        if($pengirimanCustomer != null){
            if($pengirimanCustomer->password == $otp){
                if($resi->status_perjalanan == "PERJALANAN"){$keterangan = "Penerima telah menerima barang";}
                else if($resi->status_perjalanan == "BATAL"){$keterangan = "Pengirim telah menerima barang";}
                
                $resi->status_perjalanan = "SELESAI";
                $resi->user_updated = Session::get('id');
                $resi->save();
                
                $sejarah = [
                    'resi_id'=>$resi->id,
                    'keterangan'=>$keterangan,
                    'waktu'=>now()
                ];
                Sejarah::create($sejarah);


                //untuk ganti status detail menjadi sampai
                $p = DB::table('d_pengiriman_customers')
                ->select('telah_sampai','waktu_sampai_cust')
                ->where('resi_id',$id)
                ->where('pengiriman_customer_id',$pengirimanCustomer->id)
                ->get();

                $p ->telah_sampai = 1;
                $p->waktu_sampai_cust = now();
                //
            }else{$errorPassword = true;}
        }else{$errorPassword = true;}

        if($errorPassword){
            $fail = "Password tidak valid.";
            Session::put('success-failresi', $fail);
            return redirect('/admin/resi');
        }

        $success = 'Resi ' . '"' . $id .  '"' . 'berhasil diubah.';
        Session::put('success-resi', $success);
        return redirect('/admin/resi');
    }

    public function batal($id){
        date_default_timezone_set("Asia/Jakarta");
        $resi = Resi::find($id);
        $resi->status_perjalanan = "BATAL";
        $resi->user_updated = Session::get('id');
        $resi->save();
        $user = Pegawai::findOrFail(Session::get('id'));
        $keterangan = "Kasir " . $user->nama. " dari kantor ". $user->kantor->alamat. " telah membatalkan resi";
        $sejarah = [
            'resi_id'=>$resi->id,
            'keterangan'=>$keterangan,
            'waktu'=>now()
        ];
        Sejarah::create($sejarah);

        $success = 'Resi ' . '"' . $id .  '"' . 'berhasil diubah.';
        Session::put('success-resi', $success);
        return redirect('/admin/resi');
    }
}
