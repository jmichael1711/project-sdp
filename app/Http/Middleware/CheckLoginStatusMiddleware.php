<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckLoginStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $pageType)
    {
        if (Session::has("loginstatus")) {
            $status = Session::get("loginstatus");

            //loginstatus is for the person's role
            //0 = admin
            //1 = kurir customer
            //3 = kasir
            //4 = pegawai
            if ($status == 0) {
                //admin
                //admin can access anything except login and kurir
                if ($pageType == 'guest' || $pageType == 'kurir') {
                    return redirect('/admin');
                }
            } else if ($status == 1) {
                //kurir can only access kurir page
                if ($pageType != 'kurir') {
                    return redirect('/kurir');
                }
            } else if ($status == 3){
                //kasir can only access
                if ($pageType != "kasir" && $pageType != "pegawai") {
                    return redirect('/admin/resi');
                }
            } else if ($status == 4){
                //kasir can only access
                if ($pageType != "pegawai") {
                    return redirect('/admin/bonmuat');
                }
            }
        } else {
            if ($pageType != "guest") {
                return redirect("/");
            }
        }
        return $next($request);
    }
}
