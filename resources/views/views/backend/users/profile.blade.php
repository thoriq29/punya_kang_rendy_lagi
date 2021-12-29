@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Profile</h1>
    </div>

    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-8">
          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Informasi Pengguna</h6>
            </div>
            <div class="card-body">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="form-group col-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Nama Lengkap</label>
                  <input id="name" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" tabindex="1" value="{{ $user->name }}">
                  @if ($errors->has('name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>
                
                <div class="form-group col-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" tabindex="1" value="{{ $user->email }}">
                  @if ($errors->has('email'))
                    <div class="invalid-feedback">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-5 {{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label for="phone">Nomor Telepon</label>
                  <input id="phone" type="text" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone" tabindex="1" value="{{ $user->phone }}">
                  @if ($errors->has('phone'))
                    <div class="invalid-feedback">
                      {{ $errors->first('phone') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-7 {{ $errors->has('identity_card') ? ' has-error' : '' }}">
                  <label for="identity_card">Nomor KTP</label>
                  <input id="identity_card" type="text" class="form-control @if ($errors->has('identity_card')) is-invalid @endif" name="identity_card" tabindex="1" value="{{ $user->identity_card }}">
                  @if ($errors->has('identity_card'))
                    <div class="invalid-feedback">
                      {{ $errors->first('identity_card') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                  Simpan
                </button>
              </div>
              
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Profil Avatar</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="text-center">
                  @if (is_null($user->avatar))
                    <img src="{{ asset('assets/stisla/img/avatar/avatar.jpg') }}" class="rounded-circle" id="avatar-prev" width="168" height="168" alt="avatar">
                  @else
                    <img alt="image" src="{{asset('uploads/images/avatars/'.$user->avatar)}}" class="rounded-circle" id="avatar-prev" width="168" height="168" alt="avatar">
                  @endif
                </div>
              </div>
              <div class="form-group custom-file mb-3">
                <input id="avatar" type="file" class="custom-file-input {{ $errors->has('avatar') ? ' has-error' : '' }}" name="avatar">
                <label class="custom-file-label" for="customFile">Pilih Gambar</label>
              </div>
              @if ($errors->has('avatar'))
                <div class="invalid-feedback">
                  <strong>{{ $errors->first('avatar') }}</strong>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init()
      $('.select2').select2();
    })

    function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#avatar-prev').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#avatar").change(function() {
      readURL(this);
    });
  </script>
@endsection