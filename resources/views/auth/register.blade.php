<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; {{ config('app.name') }}</title>

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
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-8 offset-2">
            <div class="login-brand">
              {{-- <img alt="image" src="{{ asset('assets/stisla/img/logo.jpg') }}" style="width: 170px;"> --}}
              {{ config('app.name') }}
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                  {{ csrf_field() }}

                  <div class="row">
                    <div class="form-group col-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="name">Nama Lengkap</label>
                      <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" autofocus>
                      @if ($errors->has('name'))
                          <div class="invalid-feedback">
                              <strong>{{ $errors->first('name') }}</strong>
                          </div>
                      @endif
                    </div>
                    
                    <div class="form-group col-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}">
                      @if ($errors->has('email'))
                        <div class="invalid-feedback">
                          <strong>{{ $errors->first('email') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="form-group col-5 {{ $errors->has('phone') ? ' has-error' : '' }}">
                      <label for="phone">Nomor Hp</label>
                      <input id="phone" type="text" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone"  placeholder="Nomor Hp" value="{{ old('phone') }}">
                      @if ($errors->has('phone'))
                        <div class="invalid-feedback">
                          {{ $errors->first('phone') }}
                        </div>
                      @endif
                    </div>
  
                    <div class="form-group col-7 {{ $errors->has('identity_card') ? ' has-error' : '' }}">
                      <label for="identity_card">Nomor KTP</label>
                      <input id="identity_card" type="number" maxlength="16" minlength="16" class="form-control @if ($errors->has('identity_card')) is-invalid @endif" placeholder="NIK" name="identity_card"  value="{{ old('identity_card') }}">
                      @if ($errors->has('identity_card'))
                        <div class="invalid-feedback">
                          {{ $errors->first('identity_card') }}
                        </div>
                      @endif
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                      @if ($errors->has('password'))
                        <div class="invalid-feedback">
                          <strong>{{ $errors->first('password') }}</strong>
                        </div>
                      @endif
                    </div>
                    <div class="form-group col-6">
                      <label for="password-confirm" class="d-block">Konfirmasi Password</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <div class="mt-5 text-muted text-center">
              Sudah punya akun? <a href="{{ route('login') }}">Login</a>
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
</body>
</html>