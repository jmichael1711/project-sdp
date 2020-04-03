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
            // if ($status == 2) {
            //     //if not admin
            //     if ($pageType == "admin" || $pageType == "guest") {
            //         //and the page is admin's or guest's
            //         return redirect("/user");
            //     }
            // } else if ($status == 1) {
            //     //if admin
            //     if ($pageType == "guest") {
            //         return redirect("/admin");
            //     }
            // }
            if ($status == 0) {
                //admin
                //admin can access anything except login
                if ($pageType == 'guest') {
                    return redirect('/admin');
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
