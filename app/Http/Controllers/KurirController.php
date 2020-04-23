<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengiriman_customer;
use App\Resi;
use Illuminate\Support\Facades\Session;
use App\Sejarah;
use App\Kurir_customer;

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
        $kurir = Kurir_customer::findOrFail(Session::get('id'));

        $keterangan = "Penerima telah menerima barang";
        $sejarah = [
            'resi_id'=>$resi_id,
            'keterangan'=>$keterangan,
            'waktu'=>now()
        ];
        Sejarah::create($sejarah);

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

        $kurir = Kurir_customer::findOrFail(Session::get('id'));

        foreach ($pengiriman->resis as $i) {
            $keterangan = "Kurir ". strtoupper($kurir->nama) ." telah berangkat dari kantor " . strtoupper($kurir->kantor->alamat) . ", " . strtoupper($kurir->kantor->kota);
            if ($pengiriman->menuju_penerima) {
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
        $resi->verifikasi = 1;

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
                $i->d_pengiriman_customer->waktu_sampai_cust = now()->toDateTimeString();
                $i->d_pengiriman_customer->telah_sampai = 1;
                $i->d_pengiriman_customer->user_updated = Session::get('id');
                $i->d_pengiriman_customer->save();
                break;
            }
        }

        //SET HISTORY SAMPAI DAN AMBIL BARANG
        $kurir = Kurir_customer::findOrFail(Session::get('id'));

        $keterangan = "Kurir ".strtoupper($kurir->nama)." telah melakukan verifikasi resi, ";
        $keterangan = $keterangan . "mengambil bayaran, serta barang dari pengirim di ". strtoupper($resi->alamat_asal);
        $keterangan = $keterangan . ", " . strtoupper($resi->kota_asal);

        $sejarah = [
            'resi_id'=>$resi->id,
            'keterangan'=>$keterangan,
            'waktu'=>now()
        ];
        Sejarah::create($sejarah);

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
                $i->d_pengiriman_customer->waktu_sampai_cust = now()->toDateTimeString();
                $i->d_pengiriman_customer->user_updated = Session::get('id');
                $i->d_pengiriman_customer->save();
            break;
            }
        }

        //HISTORY CANCEL
        $kurir = Kurir_customer::findOrFail(Session::get('id'));

        $resi = Resi::findOrFail($resi_id);

        $keterangan = "Kurir ".strtoupper($kurir->nama)." telah melakukan cancel pengiriman karena tidak ada orang yang ";
        $keterangan = $keterangan . "bisa melayani pengiriman di alamat ";

        if ($resi->menuju_penerima) {
            $keterangan = $keterangan . strtoupper($resi->alamat_tujuan) . ", " . strtoupper($resi->kota_tujuan);
        } else {
            $keterangan = $keterangan . strtoupper($resi->alamat_asal) . ", " . strtoupper($resi->kota_asal);
        }

        $sejarah = [
            'resi_id'=>$resi_id,
            'keterangan'=>$keterangan,
            'waktu'=>now()
        ];
        Sejarah::create($sejarah);

        return redirect('/kurir');
    }

    public function history() {
        $pengirimans = Pengiriman_customer::getAll()
        ->where('kurir_customer_id', Session::get('id'))
        ->whereDate('created_at', '>', now()->subMonths(1))
        ->orderBy('id', 'desc')
        ->get()
        ;

        return view('kurir.history',compact('pengirimans'));
    }
}
