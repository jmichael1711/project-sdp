<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengiriman_customer;
use App\Resi;
use Illuminate\Support\Facades\Session;

class KurirController extends Controller
{
    public function indexKurir() {
        $pengiriman = Pengiriman_customer::getAll()
        ->where('kurir_customer_id', Session::get('id'))
        ->whereNull('waktu_sampai_kantor')
        ->first()
        ;

        return view('kurir.kuririndex', compact('pengiriman'));
    }

    public function cariResi(Request $data) {
        // dd($data);
        $pengiriman_id = $data->id_pengiriman;
        $resi_id = $data->id_resi;
        $pass = $data->pass;

        $pengiriman = Pengiriman_customer::getAll()
        ->where('id', $pengiriman_id)->first();

        $menuju_penerima = $pengiriman->menuju_penerima;

        if ($pengiriman) {
            $pesanan = "";

            foreach ($pengiriman->resis as $i) {
                if ($i->is_deleted == 0 && $i->d_pengiriman_customer->password == $pass && $i->id == $resi_id) {
                    if ($i->d_pengiriman_customer->telah_sampai) {
                        $msg = "Pesanan ini sudah ditangani";
                        return view('kurir.error', compact('msg'));
                    } else {
                        $pesanan = $i;
                        return view('kurir.kurirform', compact('pesanan', 'menuju_penerima', 'pengiriman_id'));
                    }
                }
            }
            $msg = "Terdapat kesalahan ID atau OTP";
        } else {
            $msg = "Pengiriman ini sudah tidak valid.";
        }

        return view('kurir.error', compact('msg'));
    }

    public function pesananSelesaiDiantar(Request $request) {
        $request = $request->all();
        $pengiriman_id = $request['pengiriman_id'];
        $resi_id = $request['resi_id'];

        $pengirimanCustomer = Pengiriman_customer::getAll()
        ->where('id', $pengiriman_id)
        ->first()
        ;

        date_default_timezone_set("Asia/Jakarta");
        foreach ($pengirimanCustomer->resis as $i) {
            if ($i->id == $resi_id && !$i->d_pengiriman_customer->telah_sampai) {
                $i->d_pengiriman_customer->waktu_sampai_cust = now();
                $i->d_pengiriman_customer->telah_sampai = 1;
                $i->d_pengiriman_customer->user_updated = Session::get('id');
                $i->d_pengiriman_customer->save();
            }
        }

        //TAMBAH TABEL HISTORY JGN LUPA
        //SET HISTORY PESANAN SAMPAI

        return redirect('/kurir');
    }

    public function setWaktuBerangkat(Request $request) {
        $request = $request->all();
        $pengiriman = Pengiriman_customer::getAll()
        ->where('id', $request['id'])
        ->first();

        date_default_timezone_set("Asia/Jakarta");
        $pengiriman->waktu_berangkat = now();
        $pengiriman->save();

        //SET HISTORY WAKTU BERANGKAT

        return redirect('/kurir');
    }

    public function updatePesanan(Request $request) {
        $request = $request->all();

        $resi = Resi::getAll()
        ->where('id', $request['resi_id'])
        ->first()
        ;

        $resi->panjang = $request['panjang'];
        $resi->lebar = $request['lebar'];
        $resi->tinggi = $request['tinggi'];
        $resi->berat_barang = $request['berat_barang'];
        $resi->is_fragile = $request['is_fragile'];

        $resi->user_updated = Session::get('id');
        
        $resi->save();
        
        $pengiriman = Pengiriman_customer::getAll()
        ->where('id', $request['pengiriman_id'])
        ->first()
        ;

        $pengiriman->total_muatan = $resi->berat_barang;
        $pengiriman->user_updated = Session::get('id');

        $pengiriman->save();

        date_default_timezone_set("Asia/Jakarta");
        foreach ($pengiriman->resis as $i) {
            if ($i->id == $request['resi_id']) {
                $i->d_pengiriman_customer->waktu_sampai_cust = now();
                $i->d_pengiriman_customer->telah_sampai = 1;
                $i->d_pengiriman_customer->user_updated = Session::get('id');
                $i->d_pengiriman_customer->save();
                break;
            }
        }

        //SET HISTORY SAMPAI DAN AMBIL BARANG

        return redirect('/kurir');
    }

    public function cancelPengiriman(Request $request) {
        date_default_timezone_set("Asia/Jakarta");
        $request = $request->all();
        $resi_id = $request['resi_id'];
        $pengiriman_id = $request['pengiriman_id'];

        $pengiriman = Pengiriman_customer::getAll()
        ->where('id', $pengiriman_id)
        ->first();

        foreach ($pengiriman->resis as $i) {
            if ($i->id == $resi_id && !$i->d_pengiriman_customer->is_canceled) {
                $i->d_pengiriman_customer->is_canceled = 1;
                $i->d_pengiriman_customer->telah_sampai = 1;
                $i->d_pengiriman_customer->waktu_sampai_cust = now();
                $i->user_updated = Session::get('id');
                $i->d_pengiriman_customer->save();
            break;
            }
        }

        //HISTORY CANCEL

        return redirect('/kurir');
    }
}
