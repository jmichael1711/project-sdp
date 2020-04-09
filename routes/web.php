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
use Illuminate\Support\Facades\Session;


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

Route::get('/form', function () {
    return view('form');
});

Route::post('/formterima', function (Request $request) {
    dd($request->all());
});

Route::get('/admin', function () {
    return view('testadmin');
});

//FREE ROUTE
Route::get('/', 'CustomerController@index');
Route::get('/logout', 'LoginController@logout');
Route::get('/pesan', 'CustomerController@order');
Route::post('/inputpesanan', 'CustomerController@inputPesanan');
Route::get('/pesanselesai', 'CustomerController@pesanSelesai');

//INSIDE GUEST GROUP
Route::group(['middleware' => ['checkstatus:guest']], function () {
    //LOGIN
    Route::get('/login', 'LoginController@index');
    Route::post('/attemptlogin', 'LoginController@attemptLogin');
});

Route::group(['middleware' => ['checkstatus:kurir_customer']], function () {
    Route::get('/kurir-customer', 'KurirController@indexKurirCustomer');
});

//INSIDE ADMIN GROUP
Route::group(['middleware' => ['checkstatus:admin']], function () {
    //INDEX
    Route::get('/admin', function () {
        return view('master.index');
    });

    //ADMIN - KANTOR
    Route::get('/admin/kantor', 'KantorController@index');
    Route::get('/admin/kantor/create', 'KantorController@create');
    Route::post('/admin/kantor/store', 'KantorController@store');
    Route::get('/admin/kantor/edit/{id}', 'KantorController@edit');
    Route::post('/admin/kantor/update/{id}', 'KantorController@update');

    //ADMIN - KENDARAAN
    Route::get('/admin/kendaraan', 'KendaraanController@index');
    Route::get('/admin/kendaraan/create', 'KendaraanController@create');
    Route::post('/admin/kendaraan/store', 'KendaraanController@store');
    Route::get('/admin/kendaraan/edit/{id}', 'KendaraanController@edit');
    Route::post('/admin/kendaraan/update/{id}', 'KendaraanController@update');

    //ADMING - BON MUAT
    Route::get('/admin/bonmuat','Bon_MuatController@index');
    Route::get('/admin/bonmuat/create', 'Bon_MuatController@create');
    Route::post('/admin/bonmuat/store', 'Bon_MuatController@store');
    Route::get('/admin/bonmuat/edit/{id}', 'Bon_MuatController@edit');
    Route::post('/admin/bonmuat/update/{id}', 'Bon_MuatController@update');
    Route::post('/admin/bonmuat/find', 'Bon_MuatController@find');
    Route::post('/admin/bonmuat/addSuratJalan/{id}', 'Bon_MuatController@addSuratJalan');
    Route::post('/admin/bonmuat/deleteSuratJalan', 'Bon_MuatController@deleteSuratJalan');
    Route::post('/admin/bonmuat/deleteAll/{id}', 'Bon_MuatController@deleteAll');
    Route::get('/admin/bonmuat/editSuratJalan/{id}', 'Bon_MuatController@editSuratJalan');
    Route::post('/admin/bonmuat/updateSuratJalan/{id}', 'Bon_MuatController@updateSuratJalan');
    Route::post('/admin/bonmuat/mulaiBonMuat/{id}', 'Bon_MuatController@mulaiBonMuat');

    //ADMIN - PENGIRIMAN CUSTOMER
    Route::get('/admin/pengirimanCustomer', 'PengirimanCustomerController@index');
    Route::get('/admin/pengirimanCustomer/create', 'PengirimanCustomerController@create');
    Route::post('/admin/pengirimanCustomer/lihatPesanan', 'PengirimanCustomerController@lihatPesanan');
    Route::post('/admin/pengirimanCustomer/store', 'PengirimanCustomerController@store');
    Route::get('/admin/pengirimanCustomer/edit/{id}', 'PengirimanCustomerController@edit');
    Route::post('/admin/pengirimanCustomer/update/{id}', 'PengirimanCustomerController@update');
    Route::post('/admin/pengirimanCustomer/addDetail/{id}', 'PengirimanCustomerController@addDetail');
    Route::post('/admin/pengirimanCustomer/deleteDetail/{id}', 'PengirimanCustomerController@deleteDetail');
    Route::post('/admin/pengirimanCustomer/deleteAll/{id}', 'PengirimanCustomerController@deleteAll');
    Route::get('/admin/pengirimanCustomer/pengirim', 'PengirimanCustomerController@pengirim');
    Route::get('/admin/pengirimanCustomer/penerima', 'PengirimanCustomerController@penerima');
    Route::get('/admin/pengirimanCustomer/editPenerima/{id}', 'PengirimanCustomerController@editPenerima');
    Route::post('/admin/pengirimanCustomer/updateDetailPenerima/{id}', 'PengirimanCustomerController@updateDetailPenerima');

    //ADMIN - PEGAWAI
    Route::get('/admin/pegawai', 'PegawaiController@index');
    Route::get('/admin/pegawai/create', 'PegawaiController@create');
    Route::post('/admin/pegawai/isiKantor', 'PegawaiController@isiKantor');
    Route::post('/admin/pegawai/store', 'PegawaiController@store');
    Route::get('/admin/pegawai/edit/{id}', 'PegawaiController@edit');
    Route::post('/admin/pegawai/update/{id}', 'PegawaiController@update');

    //ADMIN - KOTA
    Route::get('/admin/kota', 'KotaController@index');
    Route::get('/admin/kota/create', 'KotaController@create');
    Route::post('/admin/kota/store', 'KotaController@store');
    Route::get('/admin/kota/edit/{id}', 'KotaController@edit');
    Route::post('/admin/kota/update/{id}', 'KotaController@update');

    //ADMIN - Pesanan
    Route::get('/admin/pesanan', 'PesananController@index');
    Route::get('/admin/pesanan/create', 'PesananController@create');
    Route::post('/admin/pesanan/store', 'PesananController@store');
    Route::get('/admin/pesanan/edit/{id}', 'PesananController@edit');
    Route::post('/admin/pesanan/update/{id}', 'PesananController@update');

     //ADMIN - Kurir Customer
     Route::get('/admin/kurir_customer', 'kurir_customerController@index');
     Route::get('/admin/kurir_customer/create', 'kurir_customerController@create');
     Route::post('/admin/kurir_customer/store', 'kurir_customerController@store');
     Route::get('/admin/kurir_customer/edit/{id}', 'kurir_customerController@edit');
     Route::post('/admin/kurir_customer/update/{id}', 'kurir_customerController@update');

      //ADMIN - Kurir non customer
    Route::get('/admin/kurir_noncustomer', 'kurir_noncustomerController@index');
    Route::get('/admin/kurir_noncustomer/create', 'kurir_noncustomerController@create');
    Route::post('/admin/kurir_noncustomer/store', 'kurir_noncustomerController@store');
    Route::get('/admin/kurir_noncustomer/edit/{id}', 'kurir_noncustomerController@edit');
    Route::post('/admin/kurir_noncustomer/update/{id}', 'kurir_noncustomerController@update');
});




