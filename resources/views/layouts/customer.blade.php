<!doctype html>
<html lang="en">

  <head>
    <title>TeamAte Expedition</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="depot/fonts/icomoon/style.css">

    <link rel="stylesheet" href="depot/css/bootstrap.min.css">
    <link rel="stylesheet" href="depot/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="depot/css/owl.carousel.min.css">
    <link rel="stylesheet" href="depot/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="depot/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="depot/css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="depot/css/style.css">
    @yield('styles')
  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    

  <div class="site-wrap" id="home-section">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <div class="top-bar">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <a href="#" class=""><span class="mr-2  icon-envelope-open-o"></span> <span class="d-none d-md-inline-block">team.ate@gmail.com</span></a>
            <span class="mx-md-2 d-inline-block"></span>
            <a href="#" class=""><span class="mr-2  icon-phone"></span> <span class="d-none d-md-inline-block">62+ 81234546969</span></a>


            <div class="float-right">
              <a href="https://www.instagram.com/enrichoglenns/" class=""><span class="mr-2  icon-instagram"></span> <span class="d-none d-md-inline-block">Instagram</span></a>
              <span class="mx-md-2 d-inline-block"></span>
              <a href="https://www.facebook.com/enrichoglenns" class=""><span class="mr-2  icon-facebook"></span> <span class="d-none d-md-inline-block">Facebook</span></a>

            </div>

          </div>

        </div>

      </div>
    </div>

    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center position-relative">


          <a href="/" class="site-logo" style="width: 20%;height: 100%;background-image: url('images/TAE Logo.png');background-size: cover"></a>

          <div class="col-12">
            <nav class="site-navigation text-right ml-auto " role="navigation">
              <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                @yield('links')
                
                <li><a href="/pesan" class="{{$page == 'pesan' ? 'active' : ''}} nav-link">Pesan</a></li>
                @if (Session::has('loginstatus'))
                    <li><a href="/admin">Admin Page</a></li>
                    <li><a href="/logout" class="nav-link">Logout</a></li>
                @else
                    <li><a href="/login" class="nav-link">Login</a></li>
                @endif
               
              </ul>
            </nav>

          </div>

          <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>

    </header>
      @yield('content')
      
    <footer class="site-footer">
    
        <div class="row pt-5 text-center">
          <div class="col-md-12">
            <div>
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
          </div>

        </div>
      </div>
    </footer>

  </div>

  <script src="depot/js/jquery-3.3.1.min.js"></script>
  <script src="depot/js/popper.min.js"></script>
  <script src="depot/js/bootstrap.min.js"></script>
  <script src="depot/js/owl.carousel.min.js"></script>
  <script src="depot/js/jquery.sticky.js"></script>
  <script src="depot/js/jquery.waypoints.min.js"></script>
  <script src="depot/js/jquery.animateNumber.min.js"></script>
  <script src="depot/js/jquery.fancybox.min.js"></script>
  <script src="depot/js/jquery.easing.1.3.js"></script>
  <script src="depot/js/aos.js"></script>
  <script src="{{asset('js/instascan.min.js')}}"></script>
  <script src="depot/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <script>
      function alertError(teks){
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: teks,
          })
      }
  </script>
  @yield('scripts')


  </body>

</html>
