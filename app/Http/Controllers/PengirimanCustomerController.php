<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Pengiriman_customer;
use App\Kurir_customer;
use App\Bon_Muat;
use App\Kota;
use App\Resi;
use App\Sejarah;
use App\Pegawai;
use App\Kantor;

class PengirimanCustomerController extends Controller
{
    public function create() {
        $allKota = Kota::getAll()->get();
        $allResi = Resi::getAll()->get();
        $resi = "null";
        return view('master.pengirimanCustomer.create',compact('allKota', 'allResi','resi'));
    }

    public function createBaru($id) {
        $resi = Resi::find($id);
        if($resi == null){
            $fail = "Resi tidak terdaftar.";
            Session::put('success-failresi', $fail);
            return redirect('/admin/resi');
        }else{
            $allKota = Kota::getAll()->get();
            $allResi = Resi::getAll()->get();
            $resi = Resi::find($id);
            return view('master.pengirimanCustomer.create',compact('allKota', 'allResi','resi'));
        }
    }

    public function lihatPesanan(Request $request){
        $str = '';
        $idPesanan = $request['pesanan'];
        $allResi = Resi::getAll()->where("kantor_asal_id",$request->kota)->where("verifikasi","0")->get();
        if(count($allResi) > 0) {
            $hitung = 0;
            foreach ($allResi as $resi) {
                $ada = "0";
                $allPengirimanCust = Pengiriman_customer::join('d_pengiriman_customers', 'd_pengiriman_customers.pengiriman_customer_id', '=', 'pengiriman_customers.id')->get();
                foreach ($allPengirimanCust as $pengirimanCust) {
                    if($pengirimanCust->resi_id == $resi->id) $ada = "1";
                }
                if($idPesanan == $resi->id) $ada = "2";
                if($ada == "0" || $ada == "2"){
                    if($ada == "2"){
                        $str .= '<option selected class="form-control" value="'.$resi->id.'">'.$resi->alamat_asal.'</option>';    
                    }
                    else{
                        $str .= '<option class="form-control" value="'.$resi->id.'">'.$resi->alamat_asal.'</option>';
                    }
                    $hitung = $hitung + 1;
                }
            }
            if($hitung == 0){
                $str = '<option class="form-control" value="">-- TIDAK ADA PESANAN --</option>';
            }
        }
        else{
            $str = '<option class="form-control" value="">-- TIDAK ADA PESANAN --</option>';
        }
        return $str;
    }

    public function isiCombobox($id, Request $request){
        $str = '';
        $allPengirimanCust = Pengiriman_customer::getAll()->where("waktu_sampai_kantor","=",null)->get();
        $kotaId = $request["kota"];
        $kantorId = $request["kantor"];
        $kantorCurrID = $request["kantorCurr"];
        $kurirCurrID = $request["kurirCurr"];
        $kota = Kota::findOrFail($kotaId);
        if($kantorId == 'null'){
            $allKantor = $kota->kantor->where("is_warehouse","0");
            if(count($allKantor) > 0){
                $now = 0;
                $currentKantor = null;
                foreach ($allKantor as $kantor) {
                    if($kantorCurrID != "null"){
                        if($kantor->id == $kantorCurrID){
                            $currentKantor = $kantor;
                            $str .= '<option selected class="form-control" value="'.$kantor->id.'">'.$kantor->alamat.'</option>';
                        }
                        else{
                            $str .= '<option class="form-control" value="'.$kantor->id.'">'.$kantor->alamat.'</option>';
                        }
                    }
                    else if($now == 0){
                        $currentKantor = $kantor;
                        $str .= '<option selected class="form-control" value="'.$kantor->id.'">'.$kantor->alamat.'</option>';
                    }
                    else{
                        $str .= '<option class="form-control" value="'.$kantor->id.'">'.$kantor->alamat.'</option>';
                    }
                    $now = $now + 1;
                }
                $str .= '|';
                
                if(count($currentKantor->kurir_customer) > 0){
                    $count = 0;
                    foreach ($currentKantor->kurir_customer as $kurir) {
                        $boleh = true;
                        foreach ($allPengirimanCust as $i) {
                            if($i->kurir_customer_id == $kurir->id && $i->id != $id) $boleh = false;
                        }
                        if($boleh == true){
                            if($kurirCurrID != "null"){
                                if($kurir->id == $kurirCurrID){
                                    $str .= '<option selected class="form-control" value="'.$kurir->id.'">'.$kurir->nama .' ('. $kurir->nopol .')</option>';
                                }
                                else{
                                    $str .= '<option class="form-control" value="'.$kurir->id.'">'.$kurir->nama .' ('. $kurir->nopol .')</option>';
                                }
                            }
                            else{
                                $str .= '<option class="form-control" value="'.$kurir->id.'">'.$kurir->nama .' ('. $kurir->nopol .')</option>';
                            }
                            $count++;
                        }
                    }
                    if($count == 0){
                        $str .= '<option value="">-- TIDAK ADA KURIR --</option>';    
                    }
                }
                else{
                    $str .= '<option value="">-- TIDAK ADA KURIR --</option>';
                }
            }
            else{
                $str = '<option value="">-- TIDAK ADA KANTOR --</option>|<option value="">-- TIDAK ADA KURIR --</option>';
            }
        }
        else{
            $allKurir = Kantor::findOrFail($kantorId)->kurir_customer->where("status","1");
            $count = 0;
            if(count($allKurir) > 0){
                foreach ($allKurir as $kurir) {
                    $boleh = true;
                    foreach ($allPengirimanCust as $i) {
                        if($i->kurir_customer_id == $kurir->id) $boleh = false;
                    }
                    if($boleh == true){
                        $count++;
                        $str .= '<option class="form-control" value="'.$kurir->id.'">'.$kurir->nama  .'('. $kurir->nopol .')</option>';
                    }
                }
                if($count == 0){
                    $str = '<option value="">-- TIDAK ADA KURIR --</option>';    
                }
            }
            else{
                $str = '<option value="">-- TIDAK ADA KURIR --</option>';
            }
        }
        return $str;
    }

    public function index(){
        if(Session::has('loginstatus')){
            if(Session::get('loginstatus') == 3){
                $kantor = Session::get('pegawai')->kantor->id;
                $allPengirimanCust = Pengiriman_customer::where('kantor_id',$kantor)->get();
                $pengirimanCustPengirim = Pengiriman_customer::getAll()->where("menuju_penerima","0")->where('kantor_id',$kantor)->get();
                $pengirimanCustPenerima = Pengiriman_customer::getAll()->where("menuju_penerima","1")->where('kantor_id',$kantor)->get();
            }
            else{
                $allPengirimanCust = Pengiriman_customer::get();
                $pengirimanCustPengirim = Pengiriman_customer::getAll()->where("menuju_penerima","0")->get();
                $pengirimanCustPenerima = Pengiriman_customer::getAll()->where("menuju_penerima","1")->get();
            }
        }
        return view('master.pengirimanCustomer.index',compact('allPengirimanCust','pengirimanCustPengirim','pengirimanCustPenerima'));
    }

    public function store(Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $panjang = count($request);

        if($request['menuju_penerima'] == "0"){
            $idResi = $request["resi_id"];
            $request['total_muatan'] = Resi::find($idResi)->berat_barang;
        }
        unset($request["resi_id"]);

        if(Session::has('loginstatus')){
            if(Session::get('loginstatus') == 3){
                $request['kantor_id'] = Session::get('pegawai')->kantor->id;
            }
        }

        $user = Session::get('id');
        $request['id'] = Pengiriman_customer::getNextId();
        $request['user_created'] = $user;
        $request['user_updated'] = $user;

        $pengirimanCust = Pengiriman_customer::create($request);

        if($request['menuju_penerima'] == "0"){
            $pengirimanCust->resis()->attach($idResi, ['user_created' => $user, 'user_updated' => $user]);
        }

        $success = "Data pengiriman customer berhasil didaftarkan.";
        return redirect('/admin/pengirimanCustomer')->with(['success' => $success]);
    }

    public function edit($id){
        $pengirimanCust = Pengiriman_customer::find($id);
        if($pengirimanCust == null){
            $fail = "Pengiriman Customer tidak terdaftar";
            Session::put('success-failpengirimancustomer', $fail);
            return redirect('/admin/pengirimanCustomer');
        }else{
            $kotaNow = $pengirimanCust->kantor->kota;
            $allKota = Kota::getAll()->get();
            return view('master.pengirimanCustomer.edit', compact('pengirimanCust','allKota', 'kotaNow'));
        }
    }

    public function update($id, Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();

        $panjang = count($request);
        if($request['menuju_penerima'] == "0"){
            $idResi = $request["resi_id"];
            unset($request["resi_id"]);
        }

        $user = Session::get('id');
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $request['user_updated'] = $user;

        $pengirimanCust->update($request);

        if($request['menuju_penerima'] == "0"){
            $detachId = $pengirimanCust->resis()->first()->id;
            $pengirimanCust->resis()->detach($detachId);
            $pengirimanCust->resis()->attach($idResi, ['user_created' => $user, 'user_updated' => $user]);
        }

        $success = "Data pengiriman customer $id berhasil diubah.";
        Session::put('success', $success);
        return redirect('/admin/pengirimanCustomer');
    }

    public function startPengiriman($id){
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        
        if($pengirimanCust->resis()->count() > 0){
            date_default_timezone_set("Asia/Jakarta");
            $user = Session::get('id');

            $pengirimanCust->update(['user_updated' => $user]);
            $pengirimanCust->update(['waktu_berangkat' => now()]);
            
            $kurir = Kurir_customer::findOrFail($pengirimanCust->kurir_customer_id);
            $kurir->status = "0";
            $kurir->save();

            require_once(app_path() . '\Classes\mailer2\class.phpmailer.php');

            if ($pengirimanCust->menuju_penerima) {
                foreach ($pengirimanCust->resis as $resi) {
                    $password = rand(1000, 9999) * 10000 + rand(1000, 9999);
    
                    $detailPengiriman = $resi->d_pengiriman_customer;
                    $detailPengiriman->password = $password;
                    $detailPengiriman->save();
    
                    $idResi = $resi->id;
                    $linkQrCode = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$idResi&choe=UTF-8";
    
                    $mail             = new \PHPMailer(true);
                    $address 		  = $resi->email_penerima;
                    $mail->Subject    = "TeamAte Expedition - One Time Password - " . $idResi;
                    $body = view('customer.emailotppengirim', compact('linkQrCode', 'password'));
                    $mail->IsSMTP(); // telling the class to use SMTP
                    $mail->Host       = "mail.google.com"; // SMTP server
                    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                    $mail->SMTPAuth   = true;                  // enable SMTP authentication
                    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
                    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
                    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
                    $mail->Username   = "4team.ate@gmail.com";  // GMAIL username
                    $mail->Password   = "sttsteam4";     // GMAIL password
                    $mail->MsgHTML($body);
                    $mail->AddAddress($address, $resi->nama_penerima);
    
                    if(!$mail->Send()) {  
                        //ERROR
                    } 

                    //kirim ke pengirim jg

                    $mail             = new \PHPMailer(true);
                    $address 		  = $resi->email_pengirim;
                    $mail->Subject    = "TeamAte Expedition - One Time Password - " . $idResi;
                    $body = view('customer.emailotppengirim', compact('linkQrCode', 'password'));
                    $mail->IsSMTP(); // telling the class to use SMTP
                    $mail->Host       = "mail.google.com"; // SMTP server
                    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                    $mail->SMTPAuth   = true;                  // enable SMTP authentication
                    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
                    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
                    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
                    $mail->Username   = "4team.ate@gmail.com";  // GMAIL username
                    $mail->Password   = "sttsteam4";     // GMAIL password
                    $mail->MsgHTML($body);
                    $mail->AddAddress($address, $resi->nama_pengirim);
    
                    if(!$mail->Send()) {  
                        //ERROR
                    } 
                }
            } else {
                $password = rand(1000, 9999) * 10000 + rand(1000, 9999);

                $detailPengiriman = $resi->d_pengiriman_customer;
                $detailPengiriman->password = $password;
                $detailPengiriman->save();

                $idResi = $resi->id;
                $linkQrCode = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$idResi&choe=UTF-8";

                $mail             = new \PHPMailer(true);
                $address 		  = $resi->email_pengirim;
                $mail->Subject    = "TeamAte Expedition - One Time Password - " . $idResi;
                $body = view('customer.emailotppengirim', compact('linkQrCode', 'password'));
                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->Host       = "mail.google.com"; // SMTP server
                $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;                  // enable SMTP authentication
                $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
                $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
                $mail->Username   = "4team.ate@gmail.com";  // GMAIL username
                $mail->Password   = "sttsteam4";     // GMAIL password
                $mail->MsgHTML($body);
                $mail->AddAddress($address, $resi->nama_pengirim);

                if(!$mail->Send()) {  
                    //ERROR
                } 
            }
            

            foreach ($pengirimanCust->resis as $i) {
                $keterangan = "Kurir ". strtoupper($kurir->nama) ." telah berangkat dari kantor " . strtoupper($kurir->kantor->alamat) . ", " . strtoupper($kurir->kantor->kota);
                if ($pengirimanCust->menuju_penerima) {
                    $keterangan = $keterangan . " untuk mengantar barang ke penerima di " . strtoupper($i->alamat_tujuan) . ", " . strtoupper($i->kota_tujuan);
                } else {
                    $keterangan = $keterangan . " untuk mengambil barang dari pengirim di " . strtoupper($i->alamat_asal) . ", " . strtoupper($i->kota_asal);
                }
                $sejarah = [
                    'resi_id'=>$i->id,
                    'keterangan'=>$keterangan,
                    'waktu'=>now()
                ];
                Sejarah::create($sejarah);
            }

            $success = 'Pengiriman Customer ' . '"' . $id .  '"' . ' telah berangkat.';
            Session::put('success', $success);
            return redirect('/admin/pengirimanCustomer');
        }else{
            $fail = "Pengiriman Customer tidak terdapat resi";
            Session::put('fail-detail', $fail);
            return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
        }
    }

    public function finishPengiriman($id){
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        if($pengirimanCust->resis()->count() > 0){
            date_default_timezone_set("Asia/Jakarta");
            $user = Session::get('id');

            $pengirimanCust->update(['user_updated' => $user]);
            $pengirimanCust->update(['waktu_sampai_kantor' => now()]);

            $kurir = $pengirimanCust->kurir_customer;
            $kurir->status = "1";
            $kurir->save();
            
            if($pengirimanCust->menuju_penerima == '0'){
                $resi = Resi::findOrFail($pengirimanCust->resis()->first()->id);
                $resi['kantor_sekarang_id'] = Pegawai::find($user)->kantor->id;
                $resi->save();
                $keterangan = 'Barang telah sampai di kantor ' . $kurir->kantor->alamat . ', ' . $kurir->kantor->getKota->nama . '.';
                $sejarah = [
                    'resi_id'=>$pengirimanCust->resis()->first()->id,
                    'keterangan'=>$keterangan,
                    'waktu'=>now()
                ];
                Sejarah::create($sejarah);
            }

            $success = 'Pengiriman Customer ' . '"' . $id .  '"' . ' telah selesai.';
            Session::put('success', $success);
        }

        return redirect('/admin/pengirimanCustomer');
    }

    public function editPenerima($id){
        $pengirimanCust = Pengiriman_customer::find($id);
        if($pengirimanCust == null){
            $fail = "Pengiriman Customer tidak terdaftar";
            Session::put('success-failpengirimancustomer', $fail);
            return redirect('/admin/pengirimanCustomer');
        }else{
            $status = "disabled";
            foreach($pengirimanCust->resis as $i){
                if($i->d_pengiriman_customer->telah_sampai == 0){
                    $status = "";
                }
            }
            if($pengirimanCust->resis->count() == 0) $status = "";
            $tipe = "finish";
            if($pengirimanCust->waktu_berangkat == "") $tipe = "add";
            $kotaNow = $pengirimanCust->kantor->kota;
            $allKota = Kota::getAll()->get();

            return view('master.pengirimanCustomer.editPenerima', compact('pengirimanCust','status','tipe','allKota','kotaNow'));
        }
    }

    public function deleteDetail($id, Request $request){
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $resi = Resi::findorFail($request->id);
        $pengirimanCust->resis()->detach($request->id);
        $pengirimanCust->update(['total_muatan' => ($pengirimanCust->total_muatan-$resi->berat_barang)]);
        return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
    }

    public function addDetail($id, Request $request){
        date_default_timezone_set("Asia/Jakarta");
        $pengirimanCust = Pengiriman_customer::findOrFail($id);
        $resi = Resi::find($request['resi_id']);
        $diBonMuat = 'false';
        $diPengirimanCust = 'false';
        if($resi == null){
            Session::put("fail-detail","Resi tidak terdaftar");
            return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
        }
        else{
            $allBonMuat = Bon_muat::getAll()->get();
            foreach($allBonMuat as $i){
                foreach($i->resis as $j){
                    if($j->id == $request['resi_id'] && $j->surat_jalan->telah_sampai == 0){
                        Session::put("fail-detail","Resi telah terdaftar di bon muat dengan ID = " . $i->id);
                        return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
                    }
                }
            }
            $allPengirimanCust = Pengiriman_customer::getAll()->get();
            foreach($allPengirimanCust as $i){
                foreach($i->resis as $j){
                    if($j->id == $request['resi_id'] && $j->d_pengiriman_customer->telah_sampai == 0){
                        Session::put("fail-detail","Resi telah terdaftar di pengiriman customer dengan ID = " . $i->id);
                        return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
                    }
                }
            }
            if($pengirimanCust->total_muatan+$resi->berat_barang > 20){
                Session::put('fail-detail', "Berat melebihi batasan maksimal");
                return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
            }

            $user = Session::get('id');
            $pengirimanCust->resis()->attach($request["resi_id"],['user_created' => $user]);
            $pengirimanCust->resis()->updateExistingPivot($request["resi_id"],['user_updated' => $user]);
            $pengirimanCust->update(['total_muatan' => ($pengirimanCust->total_muatan+$resi->berat_barang)]);
            $pengirimanCust->update(['user_updated' => $user]);
            Session::put('success-detail', 'Detail pengiriman customer berhasil ditambahkan.');
            return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
        }
    }

    public function deleteAll($id){
        $pengirimanCust = Pengiriman_customer::findorFail($id);
        $pengirimanCust->resis()->detach();
        $pengirimanCust->update(['total_muatan' => 0]);
        return redirect('/admin/pengirimanCustomer/editPenerima/'.$id);
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

    

    public function kirimEmailOTP(Request $request) {
        $request = $request->all();

        $pengirimanCust = Pengiriman_customer::findOrFail($request['idPengiriman']);
        $resi = Resi::findOrFail($request['idResi']);

        require_once(app_path() . '\Classes\mailer2\class.phpmailer.php');

        if ($pengirimanCust->menuju_penerima) {
            foreach ($pengirimanCust->resis as $resi) {

                $detailPengiriman = $resi->d_pengiriman_customer;

                $idResi = $resi->id;
                $password = $detailPengiriman->password;
                $linkQrCode = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$idResi&choe=UTF-8";

                $mail             = new \PHPMailer(true);
                $address 		  = $resi->email_penerima;
                $mail->Subject    = "TeamAte Expedition - One Time Password - " . $idResi;
                $body = view('customer.emailotppengirim', compact('linkQrCode', 'password'));
                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->Host       = "mail.google.com"; // SMTP server
                $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;                  // enable SMTP authentication
                $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
                $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
                $mail->Username   = "4team.ate@gmail.com";  // GMAIL username
                $mail->Password   = "sttsteam4";     // GMAIL password
                $mail->MsgHTML($body);
                $mail->AddAddress($address, $resi->nama_penerima);

                if(!$mail->Send()) {  
                    return 0;
                } 

                //kirim ke pengirim jg

                $mail             = new \PHPMailer(true);
                $address 		  = $resi->email_pengirim;
                $mail->Subject    = "TeamAte Expedition - One Time Password - " . $idResi;
                $body = view('customer.emailotppengirim', compact('linkQrCode', 'password'));
                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->Host       = "mail.google.com"; // SMTP server
                $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                $mail->SMTPAuth   = true;                  // enable SMTP authentication
                $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
                $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
                $mail->Username   = "4team.ate@gmail.com";  // GMAIL username
                $mail->Password   = "sttsteam4";     // GMAIL password
                $mail->MsgHTML($body);
                $mail->AddAddress($address, $resi->nama_pengirim);

                if(!$mail->Send()) {  
                    return 0;
                } 
            }
        } else {

            $detailPengiriman = $resi->d_pengiriman_customer;

            $idResi = $resi->id;
            $password = $detailPengiriman->password;
            $linkQrCode = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$idResi&choe=UTF-8";

            $mail             = new \PHPMailer(true);
            $address 		  = $resi->email_pengirim;
            $mail->Subject    = "TeamAte Expedition - One Time Password - " . $idResi;
            $body = view('customer.emailotppengirim', compact('linkQrCode', 'password'));
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->Host       = "mail.google.com"; // SMTP server
            $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
            $mail->Username   = "4team.ate@gmail.com";  // GMAIL username
            $mail->Password   = "sttsteam4";     // GMAIL password
            $mail->MsgHTML($body);
            $mail->AddAddress($address, $resi->nama_pengirim);

            if(!$mail->Send()) {  
                return 0;
            } 
        }

        return 1;
    }

}
