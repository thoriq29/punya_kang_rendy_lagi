<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="_token" content="{{ csrf_token() }}"/>
  <title>{{ config('app.name') }}</title>

  <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />

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

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
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
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('home') }}">
              {{ config('app.name') }}
            </a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">BC</a>
          </div>
           <ul class="sidebar-menu">
            <li class="menu-header" class="">Dashboard</li>
            <li class="{{ setActive('home') }}">
              <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i><span>Home</span></a>
            </li>

            <li class="menu-header">Menu Utama</li>
            @if (Auth::user()->role == 'admin')

              <li class="{{ setActive(['package.index', 'package.show', 'package.create', 'package.edit']) }}">
                <a href="{{ route('package.index') }}"><i class="fas fa-fw fa-box"></i><span>Paket Umrah (Alternatif)</span></a>
              </li>

              <li class="{{ setActive(['order.index', 'order.show', 'order.edit']) }}">
                <a href="{{ route('order.index') }}"><i class="fas fa-fw fa-clipboard"></i><span>Order</span></a>
              </li>

              <li class="{{ setActive(['payment.index', 'payment.show']) }}">
                <a href="{{ route('payment.index') }}"><i class="fas fa-fw fa-credit-card"></i><span>Pembayaran</span></a>
              </li>

              <li class="menu-header">Master SPK</li>
              <li class="{{ setActive(['criteria.index', 'criteria.create', 'criteria.edit']) }}">
                <a href="{{ route('criteria.index') }}"><i class="fas fa-fw fa-clipboard-list"></i><span>Kriteria</span></a>
              </li>

              <li class="{{ setActive(['alternative-criteria.index', 'alternative-criteria.create', 'alternative-criteria.edit']) }}">
                <a href="{{ route('alternative-criteria.index') }}"><i class="fas fa-fw fa-chart-bar"></i><span>Alternatif Kriteria</span></a>
              </li>
              
              <li class="menu-header">Akun</li>
              <li class="{{ setActive('user.index') }}">
                <a href="{{ route('user.index') }}"><i class="fas fa-fw fa-portrait"></i><span>Pengguna</span></a>
              </li> 
            @endif

            <li class="{{ setActive('profile.show') }}">
              <a href="{{ route('profile.show') }}"><i class="far fa-fw fa-user"></i><span>Profile</span></a>
            </li> 
          </ul>
      
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; {{ now()->format('Y') }} <div class="bullet"></div> {{ config('app.name') }}
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

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{ asset('assets/stisla/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/custom.js') }}"></script>
  @include('partials._toast');
  @yield('script');
</body>
</html>