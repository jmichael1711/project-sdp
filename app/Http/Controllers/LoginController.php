<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view("auth.login");
    }

    public function attemptlogin(Request $request) {
        $input = $request->all();

        $username = $input['username'];
        $password = $input['password'];

        if ($username == "admin" && $password == "admin") {
            //THIS IS TO BE CHANGED
            //id is for the person's ID
            //loginstatus is for the person's role
            //0 = admin
            //1 = kurir customer
            //2 = kurir non customer
            //3 = kasir
            //4 = pegawai

            

            Session::put('id', 'P0000001');
            //find or fail pegawai disini
            //tulis login status berdasarkan rolenya
            Session::put('loginstatus', 0);

            if (Session::get('loginstatus') == 0) {
                return redirect("/admin/kantor");
            }
            
        } 
        Session::put('status', 'Username / Password salah.');
        return redirect("/login");
    }

    public function logout() {
        Session::flush();
        return redirect("/");
    }
}
