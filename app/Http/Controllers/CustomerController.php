<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kota;
use App\Pesanan;
use App\Resi;
use App\Kantor;
use App\Sejarah;
use Illuminate\Support\Facades\Session;
use Validator;

class CustomerController extends Controller
{
    public function index() {
        $page = 'index';
        return view('customer.index', compact('page'));
    }

    public function order() {
        $listKota = Kota::getAll()->get(); 
        $page = 'pesan';
        return view('customer.order', compact('listKota', 'page'));
    }
    
    function findDistance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
        
            if ($unit == "K") {
            return ($miles * 1.609344);
            } else if ($unit == "N") {
            return ($miles * 0.8684);
            } else {
            return $miles;
            }
        }
    }

    public function inputPesanan(Request $request) {

        //pengecekan form
        $validator = Validator::make($request->all(), [
            'nama_pengirim' => 'required|max:255',
            'alamat_asal' => 'required|max:255',
            'kode_pos_pengirim' =>'required|max:99999',
            'kota_asal' => 'exists:App\Kota,nama',
            'no_telp_pengirim' => 'required|max:20',
            'email_pengirim' =>'required|email|max:255',

            'nama_penerima' => 'required|max:255',
            'alamat_tujuan' => 'required|max:255',
            'kode_pos_penerima' =>'required|max:99999',
            'kota_tujuan' => 'exists:App\Kota,nama',
            'no_telp_penerima' => 'required|max:20',
            'email_penerima' =>'required|email|max:255',

            'panjang' => 'required|min:1|max:999',
            'lebar' => 'required|min:1|max:999',
            'tinggi' => 'required|min:1|max:999',
            'berat_barang' => 'required|min:0.001|max:99.00',
            'is_fragile' => 'required',
        ]);

        $request = $request->all();

        //dd($request);

        if ($validator->fails() || ($request['is_fragile'] != 1 && $request['is_fragile'] != 0)) {
            Session::put('error', 'Terdapat kesalahan data pada form.');
            return redirect('/pesan')
            ->withInput();
        }

        $request['id'] = Resi::getNextId();
        $request['verifikasi'] = 0;
        $request['kode_verifikasi_email'] = rand(1000, 9999) * 10000 + rand(1000, 9999);
        $request['status_verifikasi_email'] = 0;

        $allKantor = Kantor::getAll()->where('kota',$request['kota_asal'])->where('is_warehouse','0')->get();
        $lon1 = $request['longitude_pengirim'];
        $lat1 = $request['latitude_pengirim'];
        $lon2 = $allKantor[0]->longitude;
        $lat2 = $allKantor[0]->latitude;
        $idKantor = $allKantor[0]->id;
        $minimal = $this->findDistance($lat1, $lon1, $lat2, $lon2, 'K');
        foreach ($allKantor as $kantor) {   
            $lon2 = $kantor->longitude;
            $lat2 = $kantor->latitude;
            $valueBaru = $this->findDistance($lat1, $lon1, $lat2, $lon2, 'K');
            if($valueBaru < $minimal){
                $minimal = $valueBaru;
                $idKantor = $kantor->id;
            }
        }

        $request["kantor_asal_id"] = $idKantor;
        $request["user_created"] = "CUSTOMER";
        $request["user_updated"] = "CUSTOMER";

        //ganti jadi pakai raja ongkir
        $request['harga'] = $this->countCostNoRequest($request['kota_asal'], $request['kota_tujuan'], $request['berat_barang']);
        $request['harga'] = preg_replace("/[^0-9]/", "", $request['harga'])/100;
        //

        //
        //NAMA WEBSITE
        $webDomain = "https://sdp.test";
        //

        $verificationLink = $webDomain . "/verify?" ."id=" . $request['id'] . "&otp=" . $request['kode_verifikasi_email'];

        //EMAIL
        require_once(app_path() . '\Classes\mailer2\class.phpmailer.php');

        $mail             = new \PHPMailer(true);
        $address 		  = $request['email_pengirim'];
        $mail->Subject    = "TeamAte Expedition - Verifikasi Email - " . $request['id'];
        //$body			  = view('customer.emailverifikasi', compact('request', 'verificationLink'));
        $body = view('customer.emailverifikasi', compact('request', 'verificationLink'));
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
        $mail->AddAddress($address, $request['nama_pengirim']);

        if($mail->Send()) {  
            date_default_timezone_set("Asia/Jakarta");
            $resi = Resi::create($request);  

            $keterangan = "Email verifikasi telah dikirimkan ke " . $request['email_pengirim'].".";

            $sejarah = [
                'resi_id' => $resi->id,
                'keterangan' => $keterangan,
                'waktu' => $resi->created_at
            ];

            Sejarah::create($sejarah);
            $page = "none";
            return redirect('/pesanselesai');
        } else {
            Session::put('error', 'Email tidak terkirim.');
            return redirect('/pesan');
        }
        
    }

    public function pesanSelesai() {
        $page = 'none';
        return view('customer.pesanselesai', compact('page'));
    }

    public function track(Request $request) {
        $request = $request->all();

        $sejarah = Sejarah::where('resi_id', $request['resi_id'])
        ->orderBy('waktu', 'desc')
        ->get();

        $page = 'track';

        $resi = Resi::find($request['resi_id']);
        if($resi == null){
            $fail = "Resi ". $request["resi_id"] ." tidak terdaftar.";
            Session::put('fail-resi', $fail);
            return redirect('/');
        }else{
            return view('customer.track', compact('sejarah', 'page', 'resi'));
        }
    }

    public function emailVerification(Request $request) {
        $request = $request->all();
        date_default_timezone_set("Asia/Jakarta");
        //dd(now()->subMinutes(30));
        
        $pass = $request['otp'];
        $resi_id = $request['id'];

        $resi = Resi::where('id', $resi_id)
        ->where('kode_verifikasi_email', $pass)
        ->where('status_verifikasi_email', 0)
        ->where('created_at', '>', now()->subMinutes(30))
        ->first();

        $page = 'none';
        if ($resi) {
            $resi->status_verifikasi_email = true;
            $resi->status_perjalanan = 'PERJALANAN';
            $resi->save();

            $keterangan = "Email telah di-verifikasi, dan pesanan diproses oleh kantor.";

            $sejarah = [
                'resi_id' => $resi->id,
                'keterangan' => $keterangan,
                'waktu' => $resi->created_at
            ];

            Sejarah::create($sejarah);
            //KIRIM KE KANTOR YANG BERSANGKUTAN DISINI
                        


            return view('customer.verifikasiselesai', compact('page'));
        } else {
            //TIDAK BERHASIL
            Session::put('error', 'Halaman yang diakses tidak valid.');
            return view('customer.error', compact('page'));
        }
    }

    public function countCost(Request $request){
        $kotaAsal = Kota::findOrFail($request->kotaAsal);
        $kotaTujuan = Kota::findOrFail($request->kotaTujuan);
        $berat = $request->berat*1000;
        $courier = "jne";
        if($kotaAsal->nama == "SIDOARJO") $courier = "tiki";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$kotaAsal->id&destination=$kotaTujuan->id&weight=$berat&courier=$courier",
            CURLOPT_HTTPHEADER => array(
              "content-type: application/x-www-form-urlencoded",
              "key: 49768eb68a44d897fd2e9c80a576d8b9"
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        $data = json_decode($response, true); 
        $harga = $data["rajaongkir"]["results"][0]["costs"][0]["cost"][0]["value"];
        $hasil =  number_format($harga, 2, ".", ",");
        return $hasil;
    }

    public function countCostNoRequest($kotaAsal, $kotaTujuan, $berat) {
        $kotaAsal = Kota::findOrFail($kotaAsal);
        $kotaTujuan = Kota::findOrFail($kotaTujuan);
        $berat = $berat*1000;
        $courier = "jne";
        if($kotaAsal->nama == "SIDOARJO") $courier = "tiki";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$kotaAsal->id&destination=$kotaTujuan->id&weight=$berat&courier=$courier",
            CURLOPT_HTTPHEADER => array(
              "content-type: application/x-www-form-urlencoded",
              "key: 49768eb68a44d897fd2e9c80a576d8b9"
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        $data = json_decode($response, true); 
        $harga = $data["rajaongkir"]["results"][0]["costs"][0]["cost"][0]["value"];
        $hasil =  number_format($harga, 2, ".", ",");
        return $hasil;
    }
}
