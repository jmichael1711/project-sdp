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

use App\Kota;
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

Route::get('/try', function () {
    
});

Route::get('/tryemail', function () {
    //EMAIL
    require_once(app_path() . '\Classes\mailer2\class.phpmailer.php');
		
    //-----------------EMAIL-----------------
    
    $mail             = new PHPMailer(true);
    $address 		  = 'johannesmichael8@gmail.com';
    $mail->Subject    = "TEAMATE EXPEDITION - Pengiriman Barang";
    $body			  = "Ini adalah test email.";

    $mail->IsSMTP(); // telling the class to use SMTP

    //==========================================================================================
    //ini settingan untuk gmail
    $mail->Host       = "mail.google.com"; // SMTP server
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                               // 1 = errors and messages
                                               // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
    //ini settingan untuk gmail
    //==========================================================================================
    
    $mail->Username   = "4team.ate@gmail.com";  // GMAIL username
    $mail->Password   = "fourteamate4";     // GMAIL password

    //$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

    $mail->MsgHTML($body);
    $mail->AddAddress($address, 'Johannes Michael');

    //$mail->AddAttachment("result/".$file);      // attachment
    
    if($mail->Send()) {  
        echo "[SEND TO:] " . $address . "<br>";
    } else {
        echo "gak kekirim";
    }
    //END EMAIL
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
Route::get('/track', 'CustomerController@track');
Route::get('/verify', 'CustomerController@emailVerification');
Route::post('/countCost', 'CustomerController@countCost');

//INSIDE GUEST GROUP
Route::group(['middleware' => ['checkstatus:guest']], function () {
    //LOGIN
    Route::get('/login', 'LoginController@index');
    Route::post('/attemptlogin', 'LoginController@attemptLogin');
});

Route::group(['middleware' => ['checkstatus:kurir']], function () {
    Route::get('/kurir', 'KurirController@indexKurir');
    Route::post('/kurir/input', 'KurirController@cariResi');
    Route::post('/kurir/setwaktuberangkat', 'KurirController@setWaktuBerangkat');
    Route::post('/kurir/selesai', 'KurirController@pesananSelesaiDiantar');
    Route::post('/kurir/updatepesanan', 'KurirController@updatePesanan');
    Route::post('/kurir/cancelpengiriman', 'KurirController@cancelPengiriman');
    Route::get('/kurir/history', 'KurirController@history');
    Route::post('/kurir/countCost', 'KurirController@countCost');
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
    Route::post('/admin/pengirimanCustomer/isiCombobox/{id}', 'PengirimanCustomerController@isiCombobox');
    Route::post('/admin/pengirimanCustomer/lihatPesanan', 'PengirimanCustomerController@lihatPesanan');
    Route::post('/admin/pengirimanCustomer/store', 'PengirimanCustomerController@store');
    Route::get('/admin/pengirimanCustomer/edit/{id}', 'PengirimanCustomerController@edit');
    Route::post('/admin/pengirimanCustomer/update/{id}', 'PengirimanCustomerController@update');
    Route::post('/admin/pengirimanCustomer/startPengiriman/{id}', 'PengirimanCustomerController@startPengiriman');
    Route::post('/admin/pengirimanCustomer/finishPengiriman/{id}', 'PengirimanCustomerController@finishPengiriman');
    Route::get('/admin/pengirimanCustomer/editPenerima/{id}', 'PengirimanCustomerController@editPenerima');
    Route::post('/admin/pengirimanCustomer/addDetail/{id}', 'PengirimanCustomerController@addDetail');
    Route::post('/admin/pengirimanCustomer/deleteDetail/{id}', 'PengirimanCustomerController@deleteDetail');
    Route::post('/admin/pengirimanCustomer/deleteAll/{id}', 'PengirimanCustomerController@deleteAll');
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

    //ADMIN - Resi
    Route::get('/admin/resi', 'ResiController@index');
    Route::get('/admin/resi/create', 'ResiController@create');
    Route::post('/admin/resi/store', 'ResiController@store');
    Route::get('/admin/resi/edit/{id}', 'ResiController@edit');
    Route::post('/admin/resi/update/{id}', 'ResiController@update');
    Route::post('/admin/resi/countCost', 'ResiController@countCost');

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




