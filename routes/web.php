<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Kantor;
use App\Kendaraan;
use App\Pengiriman_customer;
use App\Resi;
use App\Bon_muat;
use App\Pesanan;
use App\Kurir_customer;
use App\Kurir_non_customer;
use App\Pegawai;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $kantor['id'] = "aaaaa";
    $kantor['alamat'] = "a";
    $kantor['kota'] = "a";
    $kantor['no_telp'] = "a";
    $kantor['is_warehouse'] = 1;
    $kantor['longitude'] = 1;
    $kantor['latitude'] = 1;
    $kantor['is_deleted'] = 0;

    Kantor::create($kantor);
});

Route::post('/ghajd', function (Request $request) {
    Kantor::create($request);
});

Route::get('/try', function () {
    // echo Pengiriman_customer::getNextId();

    // Pesanan::select('id', 'created_at')->get();
    // $bonmuats = Bon_muat::all();

    // foreach ($bonmuats as $b) {
    //     echo $b->id;
    // }

    // $a = "false";

    // $bonmuat = Bon_muat::where('is_deleted', 0)
    // ->select('id as kampret', DB::raw('count(*) as jum'))
    // // ->when($a == "true", function($query) {
    // //     $query->where('id', 'a');
    // // })
    // ->orwhere(function($query) {
    //     $query->where('')
    //     ->orwhere('')
    // })
    // ->groupBy('id')
    // ->get()
    // ;
    //where a AND (b or c)

    //dd($bonmuat);

    //dd(Bon_muat::findorfail('B00000001030220')->kendaraan);

    // $bonmuat = Bon_muat::first();
    // foreach ($bonmuat->resis as $r) {
    //     dd($r->surat_jalan);
    // }

    //Session::put('he', 'A');
    //echo Session::get('he');
});

Route::get('/form', function () {
    return view('form');
});

Route::post('/formterima', function (Request $request) {
    dd($request->all());
});

Route::get('/admin', function () {
    return view('testadmin');
});


//ADMIN - KANTOR
Route::get('/admin/kantor', 'KantorController@index');
Route::get('/admin/kantor/create', 'KantorController@create');
Route::post('/admin/kantor/store', 'KantorController@store');
Route::get('/admin/kantor/edit', 'KantorController@edit');
Route::post('/admin/kantor/update', 'KantorController@update');

//ADMING - BON MUAT
Route::get('/admin/bonmuat','Bon_MuatController@index');
Route::get('/admin/bonmuat/create', 'Bon_MuatController@create');
Route::post('/admin/bonmuat/store', 'Bon_MuatController@store');
Route::get('/admin/bonmuat/edit', 'Bon_MuatController@edit');
Route::post('/admin/bonmuat/update', 'Bon_MuatController@update');

//ADMIN - PENGIRIMAN CUSTOMER
Route::get('/admin/pengirimanCustomer', 'PengirimanCustomerController@index');
Route::get('/admin/pengirimanCustomer/create', 'PengirimanCustomerController@create');
Route::post('/admin/pengirimanCustomer/store', 'PengirimanCustomerController@store');
Route::get('/admin/pengirimanCustomer/edit', 'PengirimanCustomerController@edit');
Route::post('/admin/pengirimanCustomer/update', 'PengirimanCustomerController@update');

