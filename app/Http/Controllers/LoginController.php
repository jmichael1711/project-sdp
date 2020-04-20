<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Pegawai;
use App\Kurir_customer;
use App\Kurir_non_customer;

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

        $username = strtoupper($input['username']);
        $password = md5($input['password']);

        if ($username != "" && $password != "") {
            //THIS IS TO BE CHANGED
            //id is for the person's ID
            //loginstatus is for the person's role
            //0 = admin
            //1 = kurir customer
            //3 = kasir
            //4 = pegawai

            if (substr($username, 0, 2) == "PE") {
                $pegawai = Pegawai::getAll()
                ->where('id', $username)
                ->where('password', $password)
                ->first();

                if (!$pegawai) {
                    Session::put('status', 'Username / Password salah.');
                    return redirect("/login");
                }

                //found
                $jabatan = $pegawai->jabatan;

                if ($jabatan == "admin") {
                    Session::put('loginstatus', 0);
                    Session::put('id', $username);
                    Session::put('name',$pegawai->nama);
                    return redirect("/admin");

                } else if ($jabatan == "pegawai") {
                    Session::put('loginstatus', 4);
                    Session::put('id', $username);
                    Session::put('pegawai',$pegawai);
                    Session::put('name',$pegawai->nama);
                    return redirect("/admin");
                } else if ($jabatan == "kasir") {
                    Session::put('loginstatus', 3);
                    Session::put('id', $username);
                    Session::put('name',$pegawai->nama);
                    Session::put('pegawai',$pegawai);
                    return redirect("/admin");
                } else {
                    Session::put('status', 'Ada masalah pada jabatan anda.');
                    return redirect("/login");
                }
            } else if (substr($username, 0, 2) == "KC") {
                $kurir = Kurir_customer::getAll()
                ->where('id', $username)
                ->where('password', $password)
                ->first();

                if (!$kurir) {
                    Session::put('status', 'Username / Password salah.');
                    return redirect("/login");
                }

                Session::put('loginstatus', 1);
                Session::put('id', $username);
                Session::put('name',$kurir->nama);
                return redirect("/kurir");

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
