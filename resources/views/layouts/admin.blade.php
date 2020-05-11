<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admin Page for TeamAte Expedition</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->

    <link href="{{asset('css/libs.css')}}" rel="stylesheet">
    <link href="{{asset('DataTables/datatables.min.css')}}" rel="stylesheet">
    @yield('styles')
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow bg-dark header-text-light">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            {{-- <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div> --}}

            <div class="app-header__content">
                <div class="app-header-left">
                    <!-- <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div> -->
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Go to Website
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <!-- User name -->
                                        {{Session::get('name') ?? ''}}
                                    </div>
                                    <div class="widget-subheading">
                                        TeamAte Expedition System
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <form action="/logout" method="get">
                                        <button class="btn btn-danger">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>
        <!-- Theme Settings -->
        <div class="ui-theme-settings">
            <!-- uncomment to use theme settings -->
            <!-- <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
            </button> -->
            <div class="theme-settings__inner">
                <div class="scrollbar-container">
                    <div class="theme-settings__options-wrapper">
                        <h3 class="themeoptions-heading">Layout Options
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class" data-class="fixed-header">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Header
                                                </div>
                                                <div class="widget-subheading">Makes the header top fixed, always visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class" data-class="fixed-sidebar">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Sidebar
                                                </div>
                                                <div class="widget-subheading">Makes the sidebar left fixed, always visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class" data-class="fixed-footer">
                                                    <div class="switch-animate switch-off">
                                                        <input type="checkbox" data-toggle="toggle" data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Footer
                                                </div>
                                                <div class="widget-subheading">Makes the app footer bottom fixed, always visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Page Section Tabs
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div role="group" class="mt-2 btn-group">
                                            <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line">
                                                Line
                                            </button>
                                            <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow">
                                                Shadow
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Theme Setting End-->
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow bg-midnight-bloom sidebar-text-light">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>
                    <!-- SCROLLBAR -->
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                @if (Session::has('loginstatus'))
                                    @if (Session::get('loginstatus') != 3 && Session::get('loginstatus') != 4)
                                <li class="app-sidebar__heading">Dashboards</li>
                                <li>
                                    <a id="header-dashboard" href="{{ url('/admin') }}">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                        Dashboard Page
                                    </a>
                                </li>
                                    @endif
                                @endif
                                <li class="app-sidebar__heading">CUSTOMER</li>

                                @if (Session::has('loginstatus'))
                                    @if (Session::get('loginstatus') != 4)
                                {{-- SIDEBAR - Resi --}}
                                <li id="upperlist-resi">
                                    <a id="btn-resi" href="">
                                        <i class="metismenu-icon pe-7s-note2"></i>
                                            Resi
                                            <span class="badge badge-pill badge-danger pull-right mt-2 mr-2" id="countResi" ></span>     
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul id="list-resi">
                                        <li>
                                            <a id="header-resi" href="{{ url('/admin/resi') }}">
                                                <i class="metismenu-icon"></i>
                                                Semua Resi
                                                <span class="badge badge-pill badge-danger ml-5" id="countSemuaResi"></span>   
                                            </a>
                                        </li>
                                        <li>
                                            <a id="header-tambah-resi" href="{{ url('/admin/resi/create') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tambah Resi
                                            </a>
                                        </li>
                                        <li>
                                            <a id="header-track-resi" href="{{ url('/admin/resi/trackResi') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tracking Resi
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                    @endif
                                @endif
                                
                                {{-- SIDEBAR - BON MUAT --}}
                                <li id="upperlist-bonmuat">
                                    <a id="btn-bonmuat" href="">
                                        <i class="metismenu-icon pe-7s-box1"></i>
                                            Bon Muat
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul id="list-bonmuat">
                                        <li>
                                            <a id="header-bonmuat" href="{{ url('/admin/bonmuat') }}">
                                                <i class="metismenu-icon"></i>
                                                Semua Bon Muat
                                            </a>
                                        </li>
                                        @if (Session::has('loginstatus'))
                                            @if (Session::get('loginstatus') != 4)
                                        <li>
                                            <a id="header-tambah-bonmuat" href="{{ url('/admin/bonmuat/create') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tambah Bon Muat
                                            </a>
                                        </li>
                                            @endif
                                        @endif
                                    </ul>
                                </li>
                                
                                {{-- SIDEBAR - PENGIRIMAN CUSTOMER --}}
                                <li id="upperlist-pengirimanCustomer">
                                    <a id="btn-pengirimanCustomer" href="">
                                        <i class="metismenu-icon pe-7s-gift"></i>
                                            Pengiriman Cust
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul id="list-pengirimanCustomer">
                                        <li>
                                            <a id="header-pengirimanCustomer" href="{{ url('/admin/pengirimanCustomer') }}">
                                                <i class="metismenu-icon"></i>
                                                Semua Pengiriman Cust
                                            </a>
                                        </li>
                                        @if (Session::has('loginstatus'))
                                            @if (Session::get('loginstatus') != 4)
                                        <li>
                                            <a id="header-tambah-pengirimanCustomer" href="{{ url('/admin/pengirimanCustomer/create') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tambah Pengiriman Cust
                                            </a>
                                        </li>
                                            @endif
                                        @endif
                                    </ul>
                                </li>

                                @if (Session::has('loginstatus'))
                                    @if (Session::get('loginstatus') != 3 && Session::get('loginstatus') != 4)
                                <li class="app-sidebar__heading">PEGAWAI</li>

                                {{-- SIDEBAR - PEGAWAI --}}
                                <li id="upperlist-pegawai">
                                    <a id="btn-pegawai" href="">
                                        <i class="metismenu-icon pe-7s-users"></i>
                                            Pegawai
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul id="list-pegawai">
                                        <li>
                                            <a id="header-pegawai" href="{{ url('/admin/pegawai') }}">
                                                <i class="metismenu-icon"></i>
                                                Semua Pegawai
                                            </a>
                                        </li>
                                        <li>
                                            <a id="header-tambah-pegawai" href="{{ url('/admin/pegawai/create') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tambah Pegawai
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- SIDEBAR - Kurir Customer --}}
                                <li id="upperlist-kurir_customer">
                                    <a id="btn-kurir_customer" href="">
                                        <i class="metismenu-icon pe-7s-bicycle"></i>
                                            Kurir Customer
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul id="list-kurir_customer">
                                        <li>
                                            <a id="header-kurir_customer" href="{{ url('/admin/kurir_customer') }}">
                                                <i class="metismenu-icon"></i>
                                                Semua Kurir Customer
                                            </a>
                                        </li>
                                        <li>
                                            <a id="header-tambah-kurir_customer" href="{{ url('/admin/kurir_customer/create') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tambah Kurir Customer
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- SIDEBAR - Kurir Non Customer --}}
                                <li id="upperlist-kurir_noncustomer">
                                    <a id="btn-kurir_noncustomer" href="">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                            Kurir Non Cust
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul id="list-kurir_noncustomer">
                                        <li>
                                            <a id="header-kurir_noncustomer" href="{{ url('/admin/kurir_noncustomer') }}">
                                                <i class="metismenu-icon"></i>
                                                Semua Kurir Non Cust
                                            </a>
                                        </li>
                                        <li>
                                            <a id="header-tambah-kurir_noncustomer" href="{{ url('/admin/kurir_noncustomer/create') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tambah Kurir Non Cust
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="app-sidebar__heading">PERUSAHAAN</li>
                                {{-- SIDEBAR - KOTA --}}
                                <li id="upperlist-kota">
                                    <a id="btn-kota" href="">
                                        <i class="metismenu-icon pe-7s-map-2"></i>
                                            Kota
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul id="list-kota">
                                        <li>
                                            <a id="header-kota" href="{{ url('/admin/kota') }}">
                                                <i class="metismenu-icon"></i>
                                                Semua Kota
                                            </a>
                                        </li>
                                        <li>
                                            <a id="header-tambah-kota" href="{{ url('/admin/kota/create') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tambah kota
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- SIDEBAR - KANTOR --}}
                                <li id="upperlist-kantor">
                                    <a id="btn-kantor" href="">
                                        <i class="metismenu-icon pe-7s-home"></i>
                                            Kantor
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul id="list-kantor">
                                        <li>
                                            <a id="header-kantor" href="{{ url('/admin/kantor') }}">
                                                <i class="metismenu-icon"></i>
                                                Semua Kantor
                                            </a>
                                        </li>
                                        <li>
                                            <a id="header-tambah-kantor" href="{{ url('/admin/kantor/create') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tambah Kantor
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- SIDEBAR - KENDARAAN --}}
                                <li id="upperlist-kendaraan">
                                    <a id="btn-kendaraan" href="">
                                        <i class="metismenu-icon pe-7s-car"></i>
                                            Kendaraan
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul id="list-kendaraan">
                                        <li>
                                            <a id="header-kendaraan" href="{{ url('/admin/kendaraan') }}">
                                                <i class="metismenu-icon"></i>
                                                Semua Kendaraan
                                            </a>
                                        </li>
                                        <li>
                                            <a id="header-tambah-kendaraan" href="{{ url('/admin/kendaraan/create') }}">
                                                <i class="metismenu-icon">
                                                </i>
                                                Tambah Kendaraan
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- SIDEBAR - Report --}}
                                <li class="app-sidebar__heading">REPORT</li>
                                <li>
                                    <a id="header-ProsesPesanan" href="{{ url('/admin/reports/waktuPesanan') }}">
                                        <i class="metismenu-icon pe-7s-file"></i>
                                        Jangka Waktu Pesanan Diproses
                                    </a>
                                </li>
                                <li>
                                    <a id="header-reportpendapatan" href="{{ url('/admin/reports/reportpendapatan') }}">
                                        <i class="metismenu-icon pe-7s-file"></i>
                                        Pendapatan Kantor
                                    </a>
                                </li>
                                <li>
                                    <a id="header-tambah-kendaraan" href="{{ url('/admin/kendaraan/create') }}">
                                        <i class="metismenu-icon pe-7s-file">
                                        </i>
                                        Intensitas Pesanan Kantor
                                    </a>
                                </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Scrollbar End -->
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        @yield('title-icon')
                                    </div>
                                    <div>
                                        @yield('title')
                                        <div class="page-title-subheading">
                                            @yield('subtitle')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('content')

                    </div>
                    <div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <!-- <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 1
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 2
                                            </a>
                                        </li>
                                    </ul> -->
                                </div>
                                <div class="app-footer-right">
                                    <!-- <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 3
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <div class="badge badge-success mr-1 ml-0">
                                                    <small>NEW</small>
                                                </div>
                                                Footer Link 4
                                            </a>
                                        </li>
                                    </ul> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="{{asset('js/libs.js')}}"></script>
                <script src="{{asset('js/jquery.js')}}"></script>
                <script src="{{asset('js/formvalidationadmin.js')}}"></script>
                <script src="{{asset('DataTables/datatables.min.js')}}" ></script>
                <script src="{{asset('js/instascan.min.js')}}"></script> 
                <script>
                    var timer = setInterval(count(),5000);
                    function count(){
                            $.ajax({
                            method : "POST",
                            url : '/admin/resi/countResi',
                            datatype : "json",
                            data : {  _token : "{{ csrf_token() }}" },
                            success: function(result){
                                if(result > 0){
                                    $("#countResi").html("&nbsp");
                                    $("#countSemuaResi").html(result);
                                }else{
                                    $("#countResi").html("");
                                    $("#countSemuaResi").html("");
                                }
                            },
                            error: function(){
                                console.log('error');
                            }
                        });
                    }
                    
                    
                </script>
                @yield('scripts')
        </div>
    </div>
</body>
</html>




