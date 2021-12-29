<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ config('app.name') }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/izitoast/css/iziToast.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/select2/dist/css/select2.min.css') }}">
  @yield('css')

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/components.css') }}">
</head>

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <a href="{{ url('/') }}" class="navbar-brand sidebar-gone-hide">{{ config('app.name') }}</a>
        <div class="navbar-nav">
          <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        </div>
        <div class="nav-collapse">
          <ul class="navbar-nav">
          </ul>
        </div>
        <form class="form-inline" action="{{ route('landing') }}">
          <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" name="q" value="{{ $q ?? '' }}" placeholder="Cari Paket" aria-label="Search" data-width="500">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
          </div>
        </form>
        <ul class="navbar-nav navbar-right ml-auto">
          @auth
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              @if (is_null(Auth::user()->avatar))
              <img alt="image" src="{{ asset('assets/stisla/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
              @else
              <img alt="image" src="{{asset('uploads/images/avatars/'.Auth::user()->avatar)}}" class="rounded-circle mr-1">
              @endif
              <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile.show') }}" class="dropdown-item has-icon">
                  <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item has-icon text-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          @endauth
          @guest
            <li class="nav-item mr-2"><a href="{{ route('login') }}" class="btn btn-outline-light">Login</a></li>
            <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-outline-light">Register</a></li>
          @endguest
        </ul>
      </nav>

      @auth
        @if (Auth::user()->role == 'member')    
          <nav class="navbar navbar-secondary navbar-expand-lg">
            <div class="container">
              <ul class="navbar-nav">
                <li class="nav-item {{ setActive('home') }}">
                  <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item {{ setActive('profile.show') }}">
                  <a href="{{ route('profile.show') }}" class="nav-link"><i class="fa fa-user"></i><span>Akun</span></a>
                </li>
                <li class="nav-item {{ setActive('jamaah.index') }}">
                  <a href="{{ route('jamaah.index') }}" class="nav-link"><i class="fa fa-user-tag"></i><span>Data Jama'ah</span></a>
                </li>
                <li class="nav-item {{ setActive(['transaction.index', 'transaction.show', 'transaction.edit']) }}">
                  <a href="{{ route('transaction.index') }}" class="nav-link"><i class="fa fa-receipt"></i><span>Transaksi</span></a>
                </li>
                <li class="nav-item {{ setActive(['smart-order.index', 'smart-order.process']) }}">
                  <a href="{{ route('smart-order.index') }}" class="nav-link"><i class="fas fa-lightbulb"></i><span>SMART Order</span></a>
                </li>
                {{-- <li class="nav-item">
                  <a href="" class="nav-link"><i class="fa fa-arrow-circle-right"></i><span>Checkout</span></a>
                </li> --}}
              </ul>
            </div>
          </nav>
        @else
          <nav class="navbar navbar-secondary navbar-expand-lg">
            <div class="container">
              <ul class="navbar-nav">
                <li class="nav-item {{ setActive('home') }}">
                  <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
              </ul>
            </div>
          </nav>
        @endif
      @else
        <nav class="navbar navbar-secondary navbar-expand-lg">
          <div class="container">
            <ul class="navbar-nav">
              <li class="nav-item {{ setActive('landing') }}">
                <a href="{{ route('landing') }}" class="nav-link"><i class="fas fa-home"></i><span>Beranda</span></a>
              </li>
              <li class="nav-item {{ setActive('smart-order.index') }}">
                <a href="{{ route('smart-order.index') }}" class="nav-link"><i class="fas fa-lightbulb"></i><span>SMART Order</span></a>
              </li>
              <li class="nav-item {{ setActive('page.about') }}">
                <a href="{{ route('page.about') }}" class="nav-link"><i class="fas fa-info"></i><span>Tentang Kami</span></a>
              </li>
            </ul>
          </div>
        </nav>
      @endauth

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> {{ config('app.name') }}
        </div>
        <div class="footer-right">
          Bandung - Indonesia
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/stisla/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/chart.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/stisla.js') }}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('assets/stisla/modules/izitoast/js/iziToast.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/jscolor.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/sweetalert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/select2/dist/js/select2.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('assets/stisla/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/custom.js') }}"></script>
  @include('partials._toast');
  @yield('script');
  <script>
    $(document).ready(function(){
      $('.c-booking-count').text($('#count-cart').val());
    });
  </script>
</body>
</html>