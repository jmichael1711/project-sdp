<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Resi;
use Illuminate\Support\Facades\DB;
use App\Kantor;
use App\Kota;
use Carbon\Carbon;

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

        $resiSelesaiMingguanQuery = Resi::where('resis.is_deleted', '=', 0)
        ->select(DB::raw('NVL(COUNT(pengiriman_customers.waktu_sampai_kantor), 0) as countResi'), 'resis.created_at')
        ->leftjoin('d_pengiriman_customers', 'resis.id', '=', 'd_pengiriman_customers.resi_id')
        ->leftjoin('pengiriman_customers', function ($q) {
            $q->on('d_pengiriman_customers.pengiriman_customer_id', '=', 'pengiriman_customers.id');
            $q->where('pengiriman_customers.menuju_penerima', 1);
            $q->whereNotNull('waktu_sampai_kantor');
        })
        ->whereDate('resis.created_at', '>=', now()->subDays(7))
        ->groupBy("resis.created_at")
        ->get()
        ;

        //dd($resiSelesaiMingguanQuery);

        $resiCancelMingguanQuery = Resi::select(DB::raw('SUM(IF(resis.status_verifikasi_email, 0, 1)) as countResi'), 'created_at')
        ->where(function($q) {
            $q->whereDate('created_at', '>=', now()->subDays(7));
            $q->where('created_at', '<=', now()->subMinutes(30));
        })
        ->orWhere('is_deleted', 1)
        ->groupBy("created_at")
        ->get()
        ;

        //dd($resiCancelMingguanQuery);

        //ini variabel yang dipassing nanti
        $resiTerbentukMingguan = [];
        $resiSelesaiMingguan = [];
        $resiCancelMingguan = [];
        $resiProsesMingguan = [];

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
                    $resiSelesaiMingguan[] = intval($resiSelesaiMingguanQuery[$index]->countResi);
                    $resiCancelMingguan[] = intval($resiCancelMingguanQuery[$index]->countResi);
                    $resiProsesMingguan[] = intval($resiTerbentukMingguanQuery[$index]->countResi) -
                    intval($resiSelesaiMingguanQuery[$index]->countResi) -
                    intval($resiCancelMingguanQuery[$index]->countResi);
                    $index++;
                    continue;
                }
            } 
            //artinya hari itu gada resi
            $resiTerbentukMingguan[] = 0;
            $resiSelesaiMingguan[] = 0;
            $resiCancelMingguan[] = 0;
            $resiProsesMingguan[] = 0;
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

        $resiSelesaiBulananQuery = Resi::where('resis.is_deleted', '=', 0)
        ->select(DB::raw('NVL(COUNT(pengiriman_customers.waktu_sampai_kantor), 0) as countResi'), 'resis.created_at')
        ->leftjoin('d_pengiriman_customers', 'resis.id', '=', 'd_pengiriman_customers.resi_id')
        ->leftjoin('pengiriman_customers', function ($q) {
            $q->on('d_pengiriman_customers.pengiriman_customer_id', '=', 'pengiriman_customers.id');
            $q->where('pengiriman_customers.menuju_penerima', 1);
            $q->whereNotNull('waktu_sampai_kantor');
        })
        ->whereDate('resis.created_at', '>=', now()->subDays(30))
        ->groupBy("resis.created_at")
        ->get()
        ;

        //dd($resiSelesaiMingguanQuery);

        $resiCancelBulananQuery = Resi::select(DB::raw('SUM(IF(resis.status_verifikasi_email, 0, 1)) as countResi'), 'created_at')
        ->where(function($q) {
            $q->whereDate('created_at', '>=', now()->subDays(30));
            $q->where('created_at', '<=', now()->subMinutes(30));
        })
        ->orWhere('is_deleted', 1)
        ->groupBy("created_at")
        ->get()
        ;
        //dd($resiCancelMingguanQuery);

        //ini variabel yang dipassing nanti
        $resiTerbentukBulanan = [];
        $resiProsesBulanan = [];
        $resiSelesaiBulanan = [];
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
                    $resiSelesaiBulanan[] = intval($resiSelesaiBulananQuery[$index]->countResi);
                    $resiCancelBulanan[] = intval($resiCancelBulananQuery[$index]->countResi);
                    $resiProsesBulanan[] = intval($resiTerbentukBulananQuery[$index]->countResi) -
                    intval($resiSelesaiBulananQuery[$index]->countResi) -
                    intval($resiCancelBulananQuery[$index]->countResi);
                    
                    $index++;
                    continue;
                }
            } 
            //artinya hari itu gada resi
            $resiTerbentukBulanan[] = 0;
            $resiSelesaiBulanan[] = 0;
            $resiCancelBulanan[] = 0;
            $resiProsesBulanan[] = 0;
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

        $resiSelesaiTahunanQuery = Resi::where('resis.is_deleted', '=', 0)
        ->select(DB::raw('NVL(COUNT(pengiriman_customers.waktu_sampai_kantor), 0) as countResi'), DB::raw("date_format(resis.created_at, '%M-%Y') as date"))
        ->leftjoin('d_pengiriman_customers', 'resis.id', '=', 'd_pengiriman_customers.resi_id')
        ->leftjoin('pengiriman_customers', function ($q) {
            $q->on('d_pengiriman_customers.pengiriman_customer_id', '=', 'pengiriman_customers.id');
            $q->where('pengiriman_customers.menuju_penerima', 1);
            $q->whereNotNull('waktu_sampai_kantor');
        })
        ->whereDate('resis.created_at', '>=', now()->subYear())
        ->groupBy(DB::raw("date_format(resis.created_at, '%M-%Y')"))
        ->get()
        ;

        //dd($resiSelesaiTahunanQuery);

        $resiCancelTahunanQuery = Resi::select(DB::raw('SUM(IF(resis.status_verifikasi_email, 0, 1)) as countResi'), DB::raw("date_format(resis.created_at, '%M-%Y') as date"))
        ->where(function($q) {
            $q->whereDate('created_at', '>=', now()->subYear());
            $q->where('created_at', '<=', now()->subMinutes(30));
        })
        ->orWhere('is_deleted', 1)
        ->groupBy(DB::raw("date_format(resis.created_at, '%M-%Y')"))
        ->get()
        ;

        //dd($resiCancelTahunanQuery);

        // $resiTerverifikasiTahunanQuery = Resi::getAll()
        // ->select(DB::raw('SUM(resis.verifikasi) as countResi'), DB::raw("date_format(resis.created_at, '%M-%Y') as date"))
        // ->whereDate('created_at', '>=', now()->subYear())
        // ->groupBy(DB::raw("date_format(resis.created_at, '%M-%Y')"))
        // ->get()
        // ;

        // $resiCancelTahunanQuery = Resi::getAll()
        // ->select(DB::raw('SUM(IF(resis.verifikasi, 0, 1)) as countResi'), DB::raw("date_format(resis.created_at, '%M-%Y') as date"))
        // ->whereDate('created_at', '>=', now()->subYear())
        // ->where('created_at', '<=', now()->subMinutes(30))
        // ->groupBy(DB::raw("date_format(resis.created_at, '%M-%Y')"))
        // ->get()
        // ;

        //dd($resiCancelTahunanQuery[0]->date);

        //ini variabel yang dipassing nanti
        $resiTerbentukTahunan = [];
        $resiProsesTahunan = [];
        $resiCancelTahunan = [];
        $resiSelesaiTahunan = [];

        //ngisi yang kosong-kosong
        $index = 0;
        for ($i = 0; $i <= 12; $i++) {
            if (count($resiTerbentukTahunanQuery) != $index) {
                $dateResi = $resiTerbentukTahunanQuery[$index]->date;
                $dateSub = now()->subMonths(12-$i)->isoFormat('MMMM-YYYY');
                
                if ($dateResi == $dateSub) {
                    //disini artinya ketemu
                    $resiTerbentukTahunan[] = $resiTerbentukTahunanQuery[$index]->countResi;
                    $resiSelesaiTahunan[] = intval($resiSelesaiTahunanQuery[$index]->countResi);
                    $resiCancelTahunan[] = intval($resiCancelTahunanQuery[$index]->countResi);
                    $resiProsesTahunan[] = intval($resiTerbentukTahunanQuery[$index]->countResi) -
                    intval($resiSelesaiTahunanQuery[$index]->countResi) -
                    intval($resiCancelTahunanQuery[$index]->countResi);
                    
                    $index++;
                    continue;
                }
            } 
            //artinya hari itu gada resi
            $resiTerbentukTahunan[] = 0;
            $resiProsesTahunan[] = 0;
            $resiCancelTahunan[] = 0;
            $resiSelesaiTahunan[] = 0;
        }

        //dd($resiTerverifikasiMingguan);

        $resiTerbentukTahunanLabel = [];
        for ($i = 0; $i <= 12; $i++) {
            $resiTerbentukTahunanLabel[] = now()->subMonths(12-$i)->isoFormat('MMMM-YYYY');
        }

        //dd($resiTerbentukTahunan);

        // /dd($resiCancelBulanan)

        //REPORT MISC

        $jumlahKantorCabang = Kantor::getAll()->where('is_warehouse', 0)->count();
        $jumlahKantorWarehouse = Kantor::getAll()->where('is_warehouse', 1)->count();

        return view('master.index', compact('resiTerbentukMingguan', 'resiTerbentukMingguanLabel', 
        'resiSelesaiMingguan', 'resiCancelMingguan', 'resiProsesMingguan', 'resiTerbentukBulananLabel',
        'resiTerbentukBulanan', 'resiSelesaiBulanan', 'resiProsesBulanan', 'resiCancelBulanan', 'resiTerbentukTahunanLabel',
        'resiTerbentukTahunan', 'resiProsesTahunan', 'resiCancelTahunan', 'resiSelesaiTahunan',
        'jumlahKantorCabang', 'jumlahKantorWarehouse'));


    }

    public function reportpendapatan() {
        $kotas = Kota::getAll()->get();
        $tahun = now()->isoFormat('Y');
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December'];

        return view('master.reports.reportpendapatan', compact('kotas', 'tahun', 'labels'));
    }

    public function getKantors(Request $request) {
        $request = $request->all();
        $kota = Kota::findOrFail($request['kota']);
        $kantors = $kota->kantor;

        $s = "";
        foreach ($kantors as $k) {
            $s .= '<option class="form-control" value="'.$k->id.'">'.$k->alamat.'</option>';
        }

        return $s;
    }

    public function reportpendapatanGetData(Request $req) {
        $req = $req->all();
        
        $res = Resi::getAll()
        ->select(DB::raw('SUM(harga) as sum'), 
        DB::raw('COUNT(harga) as count'),
        DB::raw("date_format(created_at, '%m') as date") )
        ->where('kantor_asal_id', $req['idKantor'])
        ->where('status_perjalanan', 'SELESAI')
        ->whereRaw("date_format(created_at, '%Y') = ?", [$req['tahun']])
        ->groupBy(DB::raw("date_format(created_at, '%M-%Y')"), DB::raw("date_format(created_at, '%m')"))
        ->orderby(DB::raw("date_format(created_at, '%M-%Y')"), 'asc')
        ->get()
        ;
        
        $data = [];
        for ($i = 0; $i < 12; $i++) {
            $found = false;
            foreach ($res as $r) {
                if (intval($r->date) == $i+1) {
                    $data[] = $r->toArray();
                    $found = true;    
                    break;
                }
            }
            if (!$found) {
                $obj = new \stdClass();
                $obj->sum = 0;
                $obj->count = 0;
                $obj->date = $i+1;
                $data[] = $obj;
            }
        }

        return json_encode($data);
    }

    public function reportpendapatanPrint($idKantor, $tahun) {
        $kantor = Kantor::findOrFail($idKantor);
        $kota = $kantor->kota;

        $res = Resi::getAll()
        ->select(DB::raw('SUM(harga) as sum'), 
        DB::raw('COUNT(harga) as count'),
        DB::raw("date_format(created_at, '%m') as date") )
        ->where('kantor_asal_id', $idKantor)
        ->where('status_perjalanan', 'SELESAI')
        ->whereRaw("date_format(created_at, '%Y') = ?", [$tahun])
        ->groupBy(DB::raw("date_format(created_at, '%M-%Y')"), DB::raw("date_format(created_at, '%m')"))
        ->orderby(DB::raw("date_format(created_at, '%M-%Y')"), 'asc')
        ->get()
        ;

        $totalSum = 0;
        
        $data = [];
        for ($i = 0; $i < 12; $i++) {
            $found = false;
            foreach ($res as $r) {
                if (intval($r->date) == $i+1) {
                    $data[] = $r->toArray();
                    $totalSum += $r['sum'];
                    $found = true;    
                    break;
                }
            }
            if (!$found) {
                $obj = new \stdClass();
                $obj->sum = 0;
                $obj->count = 0;
                $obj->date = $i+1;
                $data[] =  json_decode(json_encode($obj), true);
            }
        }

        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December'];


        return view('master.reports.reportpendapatanprint', compact('data', 'kantor', 'kota', 'tahun', 'totalSum', 'labels'));
    }
}
