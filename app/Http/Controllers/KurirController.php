<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengiriman_customer;
use Illuminate\Support\Facades\Session;

class KurirController extends Controller
{
    public function indexKurirCustomer() {
        $pengiriman = Pengiriman_customer::getAll()
        ->where('kurir_customer_id', Session::get('id'))
        ->whereNull('waktu_sampai_kantor')
        ->first()
        ;

        return view('kurir.kurircustomerindex', compact('pengiriman'));
    }

    public function cariResi(Request $data) {
        

        // dd($data);
        $pengiriman_id = $data->id_pengiriman;
        $pesanan_id = $data->id_pesanan;
        $pass = $data->pass;

        $pengiriman = Pengiriman_customer::getAll()
        ->where('id', $pengiriman_id)->first();

        if ($pengiriman) {
            $pesanan = "";

            foreach ($pengiriman->resis as $i) {
                if ($i->d_pengiriman_customer->password == $pass && $i->id == $pesanan_id) {
                    $pesanan = $i;
                    return json_encode($resi);
                }
            }
    
            
        }

        return view('kurir.error', compact('Terdapat kesalahan ID atau OTP'));
    }
}
