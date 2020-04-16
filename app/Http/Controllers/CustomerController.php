<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kota;
use App\Pesanan;
use App\Resi;
use App\Sejarah;
use Illuminate\Support\Facades\Session;

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

    public function inputPesanan(Request $request) {
        $request = $request->all();

        $request['id'] = Resi::getNextId();
        $request['verifikasi'] = 0;
        $request['status_perjalanan'] = 'perjalanan';
        $request['kode_verifikasi_email'] = rand(1000, 9999) * 10000 + rand(1000, 9999);
        $request['status_verifikasi_email'] = 0;

        $request["kantor_asal_id"] = "null";
        $request["user_created"] = "null";
        $request["user_updated"] = "null";

        //ganti jadi pakai raja ongkir
        $request['harga'] = 15000;
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
        $mail->Password   = "fourteamate4";     // GMAIL password
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
            Session::put('error', 'Email tidak kekirim.');
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
        ->orderBy('waktu', 'asc')
        ->get();

        $page = 'track';

        $resi = Resi::findOrFail($request['resi_id']);

        return view('customer.track', compact('sejarah', 'page', 'resi'));
    }

    public function emailVerification(Request $request) {
        $request = $request->all();
        
        
        $pass = $request['otp'];
        $resi_id = $request['id'];

        $resi = Resi::where('id', $resi_id)
        ->where('kode_verifikasi_email', $pass)
        ->where('status_verifikasi_email', 0)
        ->first();

        $page = 'none';
        if ($resi) {
            $resi->status_verifikasi_email = true;
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
        $hasil =  number_format($harga, 2, ".", ",");
        return $hasil;
    }
}
