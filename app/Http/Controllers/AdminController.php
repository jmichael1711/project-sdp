<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Resi;
use App\Kota;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard() {
        //query MINGGUAN
        $resiTerbentukMingguanQuery = Resi::getAll()
        ->select(DB::raw('COUNT(resis.created_at) as countResi'), 'created_at')
        ->whereDate('created_at', '>=', now()->subDays(7))
        ->groupBy("created_at")
        ->get()
        ;

        $resiTerverifikasiMingguanQuery = Resi::getAll()
        ->select(DB::raw('SUM(resis.verifikasi) as countResi'), 'created_at')
        ->whereDate('created_at', '>=', now()->subDays(7))
        ->groupBy("created_at")
        ->get()
        ;

        $resiCancelMingguanQuery = Resi::getAll()
        ->select(DB::raw('SUM(IF(resis.verifikasi, 0, 1)) as countResi'), 'created_at')
        ->whereDate('created_at', '>=', now()->subDays(7))
        ->where('created_at', '<=', now()->subMinutes(30))
        ->groupBy("created_at")
        ->get()
        ;

        //dd($resiCancelMingguanQuery);

        //ini variabel yang dipassing nanti
        $resiTerbentukMingguan = [];
        $resiTerverifikasiMingguan = [];
        $resiCancelMingguan = [];

        //ngisi yang kosong-kosong
        $index = 0;
        for ($i = 0; $i <= 7; $i++) {
            if (count($resiTerbentukMingguanQuery) != $index) {
                $dateResi = strtotime($resiTerbentukMingguanQuery[$index]->created_at);
                $dateResi = date('d', $dateResi);
                $dateSub = now()->subDays(7-$i)->isoFormat('DD');
                
                if ($dateResi == $dateSub) {
                    //disini artinya ketemu
                    $resiTerbentukMingguan[] = $resiTerbentukMingguanQuery[$index]->countResi;
                    $resiTerverifikasiMingguan[] = intval($resiTerverifikasiMingguanQuery[$index]->countResi);
                    $resiCancelMingguan[] = intval($resiCancelMingguanQuery[$index]->countResi);
                    
                    $index++;
                    continue;
                }
            } 
            //artinya hari itu gada resi
            $resiTerbentukMingguan[] = 0;
            $resiTerverifikasiMingguan[] = 0;
            $resiCancelMingguan[] = 0;
        }

        //dd($resiTerverifikasiMingguan);

        $resiTerbentukMingguanLabel = [];
        for ($i = 0; $i <= 7; $i++) {
            $resiTerbentukMingguanLabel[] = now()->subDays(7-$i)->isoFormat('dddd');
        }

        //dd($resiCancelMingguan);

        //query BULANAN
        $resiTerbentukBulananQuery = Resi::getAll()
        ->select(DB::raw('COUNT(resis.created_at) as countResi'), 'created_at')
        ->whereDate('created_at', '>=', now()->subDays(30))
        ->groupBy("created_at")
        ->get()
        ;

        $resiTerverifikasiBulananQuery = Resi::getAll()
        ->select(DB::raw('SUM(resis.verifikasi) as countResi'), 'created_at')
        ->whereDate('created_at', '>=', now()->subDays(30))
        ->groupBy("created_at")
        ->get()
        ;

        $resiCancelBulananQuery = Resi::getAll()
        ->select(DB::raw('SUM(IF(resis.verifikasi, 0, 1)) as countResi'), 'created_at')
        ->whereDate('created_at', '>=', now()->subDays(30))
        ->where('created_at', '<=', now()->subMinutes(30))
        ->groupBy("created_at")
        ->get()
        ;

        //dd($resiCancelMingguanQuery);

        //ini variabel yang dipassing nanti
        $resiTerbentukBulanan = [];
        $resiTerverifikasiBulanan = [];
        $resiCancelBulanan = [];

        //ngisi yang kosong-kosong
        $index = 0;
        for ($i = 0; $i <= 30; $i++) {
            if (count($resiTerbentukBulananQuery) != $index) {
                $dateResi = strtotime($resiTerbentukBulananQuery[$index]->created_at);
                $dateResi = date('d', $dateResi);
                $dateSub = now()->subDays(30-$i)->isoFormat('DD');
                
                if ($dateResi == $dateSub) {
                    //disini artinya ketemu
                    $resiTerbentukBulanan[] = $resiTerbentukBulananQuery[$index]->countResi;
                    $resiTerverifikasiBulanan[] = intval($resiTerverifikasiBulananQuery[$index]->countResi);
                    $resiCancelBulanan[] = intval($resiCancelBulananQuery[$index]->countResi);
                    
                    $index++;
                    continue;
                }
            } 
            //artinya hari itu gada resi
            $resiTerbentukBulanan[] = 0;
            $resiTerverifikasiBulanan[] = 0;
            $resiCancelBulanan[] = 0;
        }

        //dd($resiTerverifikasiMingguan);

        $resiTerbentukBulananLabel = [];
        for ($i = 0; $i <= 30; $i++) {
            $resiTerbentukBulananLabel[] = now()->subDays(30-$i)->isoFormat('D-MM-Y');
        }

        //dd($resiTerbentukBulananLabel);

        //query TAHUN
        $resiTerbentukTahunanQuery = Resi::getAll()
        ->select(DB::raw('COUNT(resis.created_at) as countResi'), DB::raw("date_format(resis.created_at, '%M-%Y') as date"))
        ->whereDate('created_at', '>=', now()->subYear())
        ->groupBy(DB::raw("date_format(resis.created_at, '%M-%Y')"))
        ->get()
        ;

        //dd($resiTerbentukTahunanQuery);

        $resiTerverifikasiTahunanQuery = Resi::getAll()
        ->select(DB::raw('SUM(resis.verifikasi) as countResi'), DB::raw("date_format(resis.created_at, '%M-%Y') as date"))
        ->whereDate('created_at', '>=', now()->subYear())
        ->groupBy(DB::raw("date_format(resis.created_at, '%M-%Y')"))
        ->get()
        ;

        $resiCancelTahunanQuery = Resi::getAll()
        ->select(DB::raw('SUM(IF(resis.verifikasi, 0, 1)) as countResi'), DB::raw("date_format(resis.created_at, '%M-%Y') as date"))
        ->whereDate('created_at', '>=', now()->subYear())
        ->where('created_at', '<=', now()->subMinutes(30))
        ->groupBy(DB::raw("date_format(resis.created_at, '%M-%Y')"))
        ->get()
        ;

        //dd($resiCancelTahunanQuery[0]->date);

        //ini variabel yang dipassing nanti
        $resiTerbentukTahunan = [];
        $resiTerverifikasiTahunan = [];
        $resiCancelTahunan = [];

        //ngisi yang kosong-kosong
        $index = 0;
        for ($i = 0; $i <= 12; $i++) {
            if (count($resiTerbentukTahunanQuery) != $index) {
                $dateResi = $resiTerbentukTahunanQuery[$index]->date;
                $dateSub = now()->subMonths(12-$i)->isoFormat('MMMM-YYYY');
                
                if ($dateResi == $dateSub) {
                    //disini artinya ketemu
                    $resiTerbentukTahunan[] = $resiTerbentukTahunanQuery[$index]->countResi;
                    $resiTerverifikasiTahunan[] = intval($resiTerverifikasiTahunanQuery[$index]->countResi);
                    $resiCancelTahunan[] = intval($resiCancelTahunanQuery[$index]->countResi);
                    
                    $index++;
                    continue;
                }
            } 
            //artinya hari itu gada resi
            $resiTerbentukTahunan[] = 0;
            $resiTerverifikasiTahunan[] = 0;
            $resiCancelTahunan[] = 0;
        }

        //dd($resiTerverifikasiMingguan);

        $resiTerbentukTahunanLabel = [];
        for ($i = 0; $i <= 12; $i++) {
            $resiTerbentukTahunanLabel[] = now()->subMonths(12-$i)->isoFormat('MMMM-YYYY');
        }

        //dd($resiTerbentukTahunan);

        return view('master.index', compact('resiTerbentukMingguan', 'resiTerbentukMingguanLabel', 
        'resiTerverifikasiMingguan', 'resiCancelMingguan', 'resiTerbentukBulananLabel',
        'resiTerbentukBulanan', 'resiTerverifikasiBulanan', 'resiCancelBulanan', 'resiTerbentukTahunanLabel',
        'resiTerbentukTahunan', 'resiTerverifikasiTahunan', 'resiCancelTahunan'));


    }

    public function waktuPesanan(){
        $allKota = Kota::getAll()->get();
        return view('master.reports.waktuPesanan',compact('allKota'));
    }

    public function reportWaktuPesanan(){
        // $allPengirimanCustomer = DB::table('d_pengiriman_customers')->select('resi_id');
        // $allResiBaru = Resi::getAll()
        // ->where("kantor_asal_id","=",$user->kantor_id)
        // ->where("user_created","CUSTOMER")
        // ->whereIn('id', $allPengirimanCustomer)
        // ->get();
    }
}
