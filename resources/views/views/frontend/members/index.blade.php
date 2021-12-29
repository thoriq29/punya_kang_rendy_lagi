@extends('layouts.front')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Data Jama'ah</h1>
    </div>

    <form method="POST" action="{{ route('jamaah.store') }}" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-8">
          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Informasi Jama'ah</h6>
            </div>
            <div class="card-body">
              @csrf

              <div class="row">
                <div class="form-group col-6 {{ $errors->has('full_name') ? ' has-error' : '' }}">
                  <label for="full_name">Nama Lengkap</label>
                  <input id="full_name" type="text" class="form-control @if ($errors->has('full_name')) is-invalid @endif" name="full_name" value="{{ ($member == null) ? $user->name : $member->full_name }}">
                  @if ($errors->has('full_name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('full_name') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-6 {{ $errors->has('father_name') ? ' has-error' : '' }}">
                  <label for="father_name">Nama Ayah Kandung</label>
                  <input id="father_name" type="text" class="form-control @if ($errors->has('father_name')) is-invalid @endif" name="father_name" value="{{ ($member == null) ? old('father_name') : $member->father_name }}">
                  @if ($errors->has('father_name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('father_name') }}
                    </div>
                  @endif
                </div>
                
              </div>

              <div class="row">
                <div class="form-group col-4 {{ $errors->has('identity_card') ? ' has-error' : '' }}">
                  <label for="identity_card">Nomor KTP (NIK)</label>
                  <input id="identity_card" type="text" class="form-control @if ($errors->has('identity_card')) is-invalid @endif" name="identity_card" value="{{ ($member == null) ? $user->identity_card : $member->identity_card }}">
                  @if ($errors->has('identity_card'))
                    <div class="invalid-feedback">
                      {{ $errors->first('identity_card') }}
                    </div>
                  @endif
                </div>
              
                <div class="form-group col-4 {{ $errors->has('birth_place') ? ' has-error' : '' }}">
                  <label for="birth_place">Tempat Lahir</label>
                  <input id="birth_place" type="text" class="form-control @if ($errors->has('birth_place')) is-invalid @endif" name="birth_place" value="{{ ($member == null) ? old('birth_place') : $member->birth_place }}">
                  @if ($errors->has('birth_place'))
                    <div class="invalid-feedback">
                      {{ $errors->first('birth_place') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-4 {{ $errors->has('birth_date') ? ' has-error' : '' }}">
                  <label for="birth_date">Tanggal Lahir</label>
                  <input id="birth_date" type="date" class="form-control @if ($errors->has('birth_date')) is-invalid @endif" name="birth_date" value="{{ ($member == null) ? old('birth_date') : $member->birth_date }}">
                  @if ($errors->has('birth_date'))
                    <div class="invalid-feedback">
                      {{ $errors->first('birth_date') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-6 {{ $errors->has('passport_number') ? ' has-error' : '' }}">
                  <label for="passport_number">Nomor Paspor</label>
                  <input id="passport_number" type="text" class="form-control @if ($errors->has('passport_number')) is-invalid @endif" name="passport_number" value="{{ ($member == null) ? old('passport_number') : $member->passport_number }}">
                  @if ($errors->has('passport_number'))
                    <div class="invalid-feedback">
                      {{ $errors->first('passport_number') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-6 {{ $errors->has('passport_place') ? ' has-error' : '' }}">
                  <label for="passport_place">Tempat Dikeluarkan Paspor</label>
                  <input id="passport_place" type="text" class="form-control @if ($errors->has('passport_place')) is-invalid @endif" name="passport_place" value="{{ ($member == null) ? old('passport_place') : $member->passport_place }}">
                  @if ($errors->has('passport_place'))
                    <div class="invalid-feedback">
                      {{ $errors->first('passport_place') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-12 {{ $errors->has('address') ? ' has-error' : '' }}">
                  <label for="address">Alamat Rumah</label>
                  <textarea class="form-control @if ($errors->has('address')) is-invalid @endif" name="address" rows="2">{{ ($member == null) ? old('address') : $member->address }}</textarea>
                  @if ($errors->has('address'))
                    <div class="invalid-feedback">
                      {{ $errors->first('address') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label for="phone">Nomor Handphone</label>
                  <input id="phone" type="text" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone" value="{{ ($member == null) ? $user->phone : $member->phone }}">
                  @if ($errors->has('phone'))
                    <div class="invalid-feedback">
                      {{ $errors->first('phone') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ ($member == null) ? $user->email : $member->email }}">
                  @if ($errors->has('email'))
                    <div class="invalid-feedback">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-12 {{ $errors->has('profession') ? ' has-error' : '' }}">
                  <label for="profession">Pekerjaan</label>
                  <input id="profession" type="text" class="form-control @if ($errors->has('profession')) is-invalid @endif" name="profession" value="{{ ($member == null) ? old('profession') : $member->profession }}">
                  @if ($errors->has('profession'))
                    <div class="invalid-feedback">
                      {{ $errors->first('profession') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-6 {{ $errors->has('is_already_umrah') ? ' has-error' : '' }}">
                  <label for="is_already_umrah">Pernah Pergi Umrah?</label>
                  <select name="is_already_umrah" class="form-control select2 @if ($errors->has('is_already_umrah')) is-invalid @endif" id="is_already_umrah">
                    <option value="0" {{ ($member == null) ? ((old('is_already_umrah') == "0") ? 'selected' : '') : (( $member->is_already_umrah == '0') ? 'selected' : '') }}>Belum</option>
                    <option value="1" {{ ($member == null) ? ((old('is_already_umrah') == "1") ? 'selected' : '') : (( $member->is_already_umrah == '1') ? 'selected' : '') }}>Pernah</option>
                  </select>
                  @if ($errors->has('is_already_umrah'))
                    <div class="invalid-feedback">
                      {{ $errors->first('is_already_umrah') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-6 {{ $errors->has('last_education') ? ' has-error' : '' }}">
                  <label for="last_education">Pendidikan Terakhir</label>
                  <select name="last_education" class="form-control select2 @if ($errors->has('last_education')) is-invalid @endif" id="last_education">
                    <option {{ ($member == null) ? ((old('last_education') == 'SD / Sederajat') ? 'selected' : '') : (( $member->last_education == 'SD / Sederajat') ? 'selected' : '') }}>SD / Sederajat</option>
										<option {{ ($member == null) ? ((old('last_education') == 'SMP / Sederajat') ? 'selected' : '') : (( $member->last_education == 'SMP / Sederajat') ? 'selected' : '') }}>SMP / Sederajat</option>
										<option {{ ($member == null) ? ((old('last_education') == 'SMA / Sederajat') ? 'selected' : '') : (( $member->last_education == 'SMA / Sederajat') ? 'selected' : '') }}>SMA / Sederajat</option>
										<option {{ ($member == null) ? ((old('last_education') == 'Diploma') ? 'selected' : '') : (( $member->last_education == 'Diploma') ? 'selected' : '') }}>Diploma</option>
										<option {{ ($member == null) ? ((old('last_education') == 'Sarjana') ? 'selected' : '') : (( $member->last_education == 'Sarjana') ? 'selected' : '') }}>Sarjana</option>
										<option {{ ($member == null) ? ((old('last_education') == 'Magister') ? 'selected' : '') : (( $member->last_education == 'Magister') ? 'selected' : '') }}>Magister</option>
										<option {{ ($member == null) ? ((old('last_education') == 'Doktor') ? 'selected' : '') : (( $member->last_education == 'Doktor') ? 'selected' : '') }}>Doktor</option>
										<option {{ ($member == null) ? ((old('last_education') == 'Lainnya') ? 'selected' : '') : (( $member->last_education == 'Lainnya') ? 'selected' : '') }}>Lainnya</option>
                  </select>
                  @if ($errors->has('last_education'))
                    <div class="invalid-feedback">
                      {{ $errors->first('last_education') }}
                    </div>
                  @endif
                </div>
              </div>
              
            </div>
          </div>

          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Kontak Keluarga Yang Tidak Serumah Dan Dapat Dihubungi</h6>
            </div>
            <div class="card-body">
              @csrf

              <div class="row">
                <div class="form-group col-6 {{ $errors->has('emergency_name') ? ' has-error' : '' }}">
                  <label for="emergency_name">Nama Lengkap</label>
                  <input id="emergency_name" type="text" class="form-control @if ($errors->has('emergency_name')) is-invalid @endif" name="emergency_name" value="{{ ($member == null) ? old('emergency_name') : $member->emergency_name }}">
                  @if ($errors->has('emergency_name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('emergency_name') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-6 {{ $errors->has('emergency_identity_card') ? ' has-error' : '' }}">
                  <label for="emergency_identity_card">Nomor KTP (NIK)</label>
                  <input id="emergency_identity_card" type="text" class="form-control @if ($errors->has('emergency_identity_card')) is-invalid @endif" name="emergency_identity_card" value="{{ ($member == null) ? old('emergency_identity_card') : $member->emergency_identity_card }}">
                  @if ($errors->has('emergency_identity_card'))
                    <div class="invalid-feedback">
                      {{ $errors->first('emergency_identity_card') }}
                    </div>
                  @endif
                </div>              
              </div>

              <div class="row">
                <div class="form-group col-6 {{ $errors->has('emergency_phone') ? ' has-error' : '' }}">
                  <label for="emergency_phone">Nomor Handphone</label>
                  <input id="emergency_phone" type="text" class="form-control @if ($errors->has('emergency_phone')) is-invalid @endif" name="emergency_phone" value="{{ ($member == null) ? old('emergency_phone') : $member->emergency_phone }}">
                  @if ($errors->has('emergency_phone'))
                    <div class="invalid-feedback">
                      {{ $errors->first('emergency_phone') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-6 {{ $errors->has('emergency_relationship') ? ' has-error' : '' }}">
                  <label for="emergency_relationship">Hubungan</label>
                  <input id="emergency_relationship" type="text" class="form-control @if ($errors->has('emergency_relationship')) is-invalid @endif" name="emergency_relationship" value="{{ ($member == null) ? old('emergency_relationship') : $member->emergency_relationship }}">
                  @if ($errors->has('emergency_relationship'))
                    <div class="invalid-feedback">
                      {{ $errors->first('emergency_relationship') }}
                    </div>
                  @endif
                </div>
              </div>
             
              <div class="row">
                <div class="form-group col-12 {{ $errors->has('emergency_address') ? ' has-error' : '' }}">
                  <label for="emergency_address">Alamat Rumah</label>
                  <textarea class="form-control @if ($errors->has('emergency_address')) is-invalid @endif" name="emergency_address" rows="2">{{ ($member == null) ? old('emergency_address') : $member->emergency_address }}</textarea>
                  @if ($errors->has('emergency_address'))
                    <div class="invalid-feedback">
                      {{ $errors->first('emergency_address') }}
                    </div>
                  @endif
                </div>
              </div>     
              
            </div>
          </div>

          <div class="card card-body">
            <div class="form-group mb-0">
              <button type="submit" class="btn btn-primary btn-block">
                Simpan
              </button>
            </div>
          </div>

        </div>

        <div class="col-lg-4">
          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Pas Foto 4x6</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="text-center">
                  @if ($member == null)
                  <img src="{{ asset('assets/stisla/img/example-image.jpg') }}" class="rounded" id="image-prev" width="200" height="200" alt="image">
                  @else
                    @if ($member->image != null)  
                      <img alt="image" src="{{asset('uploads/images/members/'.$member->image)}}" class="rounded-circle" id="images-prev" width="200" height="200" alt="images">
                    @endif
                  @endif
                </div>
              </div>
              <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }} custom-file mb-3">
                <input id="image" type="file" class="custom-file-input @if ($errors->has('image')) is-invalid @endif" name="image">
                <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                @if ($errors->has('image'))
                  <div class="invalid-feedback">
                    <strong>{{ $errors->first('image') }}</strong>
                  </div>
                @endif
              </div>
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
        $('#image-prev').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#image").change(function() {
      readURL(this);
    });
  </script>
@endsection