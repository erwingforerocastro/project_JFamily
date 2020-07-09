<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

      <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Project Family') }}</title>

  <title>Project Family</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png" rel="icon')}}">
  <link href="{{asset('assets/img/apple-touch-icon.png" rel="apple-touch-icon')}}">

  <!-- Google Fonts -->
  <link href="{{asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700')}}" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  
  @yield('header')

  <!-- =======================================================
  * Author: Erwing FC ~@ erwingforerocastro@gmail.com
  * 2020
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header-transparent">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="{{url('usuario')}}" ><img src="{{asset('assets/img/logo.png')}}" alt=""></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          @guest
          <li class="menu-active"><a href="/">Inicio</a></li>
          <li class="menu-has-children"><a href="#">Comenzar</a>
            <ul>
              <li><a href="{{url('login')}}">Iniciar Sesión</a></li>
              <li><a href="{{url('register')}}">Registrarse</a></li>
            </ul>
          </li>
          @else
          <li class="menu-has-children"><a href="{{url('usuario')}}">{{Auth::user()->name}}</a>
            <li class="menu-has-children"><a href="#">mas..</a>
              <ul>
                <li><a href="{{url('logout')}}">Salir</a></li>
              </ul>
            </li>
          @endguest
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header>
  <!-- End Header -->
 @yield('up-body')
  

     <section id="hero">
      <div class="container">
        <div class="row hero-container-fluid">
          @yield('content') 
          <div class="col-lg-6 background order-lg-2 order-1" data-aos="fade-left" data-aos-delay="100"></div>
        </div>
      </div>
    </section>
  
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        @yield('footer')
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><a href='https://www.linkedin.com/in/erwing-forero-castro-586781133' target='_blank'>EFC</a></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a target='_blank' href="https://getbootstrap.com/">Bootstrap</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  @yield('script')
</body>

</html>