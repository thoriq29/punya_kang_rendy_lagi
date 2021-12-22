<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; {{ config('app.name') }}</title>

  <link rel="shortcut icon" href="{{ asset('assets/stislaend/img/favicon.png') }}" type="image/x-icon" />
  
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  {{-- <link rel="stylesheet" href="../dist/modules/bootstrap-social/bootstrap-social.css"> --}}

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/izitoast/css/iziToast.min.css') }}">

  <script src="{{ asset('assets/stisla/modules/izitoast/js/iziToast.min.js') }}"></script>
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              {{-- <img alt="image" src="{{ asset('assets/stisla/img/logo.jpg') }}" style="width: 170px;"> --}}
              {{ config('app.name') }}
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}

                  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control  @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                    @if ($errors->has('email'))
                      <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                      </div>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    @if ($errors->has('password'))
                      <input id="password" type="password" class="form-control is-invalid " name="password" tabindex="2" required>
                      <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                      </div>
                    @else
                      <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    @endif
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Belum punya akun? <a href="{{ route('register') }}">Register</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/stisla/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/stisla.js') }}"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{ asset('assets/stisla/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/stisla/js/custom.js') }}"></script>
  @include('partials._toast');
</body>
</html>