@extends('layouts.front')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Checkout Pemesanan Paket Umrah</h6>
      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Informasi Paket Umrah</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-8 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Nama Paket</label>
                    <input id="name" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" tabindex="1" value="{{ $package->name }}" readonly>
                  </div>
                  
                  <div class="form-group col-4 {{ $errors->has('quota') ? ' has-error' : '' }}">
                    <label for="quota">Kuota</label>
                    <input id="quota" type="number" class="form-control @if ($errors->has('quota')) is-invalid @endif" name="quota" tabindex="1" value="{{ $package->quota }}" readonly>
                  </div>
                </div>
  
                <div class="row">
                  <div class="form-group col-6 {{ $errors->has('start_date') ? ' has-error' : '' }}">
                    <label for="start_date">Tanggal Berangkat</label>
                    <input id="start_date" type="date" class="form-control @if ($errors->has('start_date')) is-invalid @endif" name="start_date" tabindex="1" value="{{ $package->start_date}}" readonly>
                  </div>
  
                  <div class="form-group col-6 {{ $errors->has('end_date') ? ' has-error' : '' }}">
                    <label for="end_date">Tanggal Pulang</label>
                    <input id="end_date" type="date" class="form-control @if ($errors->has('end_date')) is-invalid @endif" name="end_date" tabindex="1" value="{{ $package->end_date }}" readonly>
                  </div>
                </div>
  
                <div class="row">
                  <div class="form-group col-4 {{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price">Durasi</label>
                    <input id="price" type="text" class="form-control @if ($errors->has('price')) is-invalid @endif" name="price" tabindex="1" value="{{ diff_days($package->start_date, $package->end_date) }} Hari" readonly>
                  </div>

                  <div class="form-group col-8 {{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price">Harga</label>
                    <input id="price" type="text" class="form-control @if ($errors->has('price')) is-invalid @endif" name="price" tabindex="1" value="Rp {{ rupiah($package->price) }}" readonly>
                  </div>
                </div>
              </div>
            </div>

            <div class="card card-primary">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Informasi Jama'ah</h6>
              </div>
              <div class="card-body">
                @if ($member == null)
                  <div class="alert alert-warning" role="alert">
                    <i class="fa fa-info"></i> &nbsp Anda belum melakukan pengisian data Jama'ah. Silahkan isi terlebih dahulu pada menu Data Jama'ah atau klik tombol dibawah.
                  </div>
                  <a href="{{ route('jamaah.index', 'returnPath=/checkout/'.$package->id) }}" class="btn btn-primary btn-block">Isi Data Jama'ah</a>
                @else
                  <div class="cont-member">
      
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="full_name">Nama Lengkap</label>
                        <input id="full_name" type="text" class="form-control @if ($errors->has('full_name')) is-invalid @endif" name="full_name" value="{{ ($member == null) ? $user->name : $member->full_name }}" readonly>
                      </div>
      
                      <div class="form-group col-6 {{ $errors->has('father_name') ? ' has-error' : '' }}">
                        <label for="father_name">Nama Ayah Kandung</label>
                        <input id="father_name" type="text" class="form-control @if ($errors->has('father_name')) is-invalid @endif" name="father_name" value="{{ ($member == null) ? old('father_name') : $member->father_name }}" readonly>
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
                        <input id="identity_card" type="text" class="form-control @if ($errors->has('identity_card')) is-invalid @endif" name="identity_card" value="{{ ($member == null) ? $user->identity_card : $member->identity_card }}" readonly>
                        @if ($errors->has('identity_card'))
                          <div class="invalid-feedback">
                            {{ $errors->first('identity_card') }}
                          </div>
                        @endif
                      </div>
                    
                      <div class="form-group col-4 {{ $errors->has('birth_place') ? ' has-error' : '' }}">
                        <label for="birth_place">Tempat Lahir</label>
                        <input id="birth_place" type="text" class="form-control @if ($errors->has('birth_place')) is-invalid @endif" name="birth_place" value="{{ ($member == null) ? old('birth_place') : $member->birth_place }}" readonly>
                        @if ($errors->has('birth_place'))
                          <div class="invalid-feedback">
                            {{ $errors->first('birth_place') }}
                          </div>
                        @endif
                      </div>
      
                      <div class="form-group col-4 {{ $errors->has('birth_date') ? ' has-error' : '' }}">
                        <label for="birth_date">Tanggal Lahir</label>
                        <input id="birth_date" type="date" class="form-control @if ($errors->has('birth_date')) is-invalid @endif" name="birth_date" value="{{ ($member == null) ? old('birth_date') : $member->birth_date }}" readonly>
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
                        <input id="passport_number" type="text" class="form-control @if ($errors->has('passport_number')) is-invalid @endif" name="passport_number" value="{{ ($member == null) ? old('passport_number') : $member->passport_number }}" readonly>
                        @if ($errors->has('passport_number'))
                          <div class="invalid-feedback">
                            {{ $errors->first('passport_number') }}
                          </div>
                        @endif
                      </div>
      
                      <div class="form-group col-6 {{ $errors->has('passport_place') ? ' has-error' : '' }}">
                        <label for="passport_place">Tempat Dikeluarkan Paspor</label>
                        <input id="passport_place" type="text" class="form-control @if ($errors->has('passport_place')) is-invalid @endif" name="passport_place" value="{{ ($member == null) ? old('passport_place') : $member->passport_place }}" readonly>
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
                        <textarea class="form-control @if ($errors->has('address')) is-invalid @endif" name="address" rows="2" readonly>{{ ($member == null) ? old('address') : $member->address }}</textarea>
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
                        <input id="phone" type="text" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone" value="{{ ($member == null) ? $user->phone : $member->phone }}" readonly>
                        @if ($errors->has('phone'))
                          <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                          </div>
                        @endif
                      </div>
      
                      <div class="form-group col-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ ($member == null) ? $user->email : $member->email }}" readonly>
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
                        <input id="profession" type="text" class="form-control @if ($errors->has('profession')) is-invalid @endif" name="profession" value="{{ ($member == null) ? old('profession') : $member->profession }}" readonly>
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
                        <select name="is_already_umrah" class="form-control select2 @if ($errors->has('is_already_umrah')) is-invalid @endif" id="is_already_umrah" disabled>
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
                        <select name="last_education" class="form-control select2 @if ($errors->has('last_education')) is-invalid @endif" id="last_education" disabled>
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
    
                    <div class="row">
                      <div class="col-md-12">
                        <hr><h6 class="m-0 font-weight-bold">Kontak Keluarga Yang Tidak Serumah Dan Dapat Dihubungi</h6><hr>
                      </div>
                    </div>
    
                    <div class="row">
                      <div class="form-group col-6 {{ $errors->has('emergency_name') ? ' has-error' : '' }}">
                        <label for="emergency_name">Nama Lengkap</label>
                        <input id="emergency_name" type="text" class="form-control @if ($errors->has('emergency_name')) is-invalid @endif" name="emergency_name" value="{{ ($member == null) ? old('emergency_name') : $member->emergency_name }}" readonly>
                        @if ($errors->has('emergency_name'))
                          <div class="invalid-feedback">
                            {{ $errors->first('emergency_name') }}
                          </div>
                        @endif
                      </div>
      
                      <div class="form-group col-6 {{ $errors->has('emergency_identity_card') ? ' has-error' : '' }}">
                        <label for="emergency_identity_card">Nomor KTP (NIK)</label>
                        <input id="emergency_identity_card" type="text" class="form-control @if ($errors->has('emergency_identity_card')) is-invalid @endif" name="emergency_identity_card" value="{{ ($member == null) ? old('emergency_identity_card') : $member->emergency_identity_card }}" readonly>
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
                        <input id="emergency_phone" type="text" class="form-control @if ($errors->has('emergency_phone')) is-invalid @endif" name="emergency_phone" value="{{ ($member == null) ? old('emergency_phone') : $member->emergency_phone }}" readonly>
                        @if ($errors->has('emergency_phone'))
                          <div class="invalid-feedback">
                            {{ $errors->first('emergency_phone') }}
                          </div>
                        @endif
                      </div>
      
                      <div class="form-group col-6 {{ $errors->has('emergency_relationship') ? ' has-error' : '' }}">
                        <label for="emergency_relationship">Hubungan</label>
                        <input id="emergency_relationship" type="text" class="form-control @if ($errors->has('emergency_relationship')) is-invalid @endif" name="emergency_relationship" value="{{ ($member == null) ? old('emergency_relationship') : $member->emergency_relationship }}" readonly>
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
                        <textarea class="form-control @if ($errors->has('emergency_address')) is-invalid @endif" name="emergency_address" rows="2" readonly>{{ ($member == null) ? old('emergency_address') : $member->emergency_address }}</textarea>
                        @if ($errors->has('emergency_address'))
                          <div class="invalid-feedback">
                            {{ $errors->first('emergency_address') }}
                          </div>
                        @endif
                      </div>
                    </div> 
                    
                  </div>
                @endif

              </div>
            </div>
  
          </div>
          <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                <h6 class="m-0 font-weight-bold">Checkout</h6>
              </div>
              <div class="card-body">
                <form action="{{ route('page.checkout.store') }}" method="POST">
                  <div class="row">
                    <div class="form-group col-12 {{ $errors->has('payment_type') ? ' has-error' : '' }}">
                      <label for="payment_type">Pilih opsi pembayaran</label>
                      <select name="payment_type" class="form-control select2 @if ($errors->has('payment_type')) is-invalid @endif" id="payment_type" data-placeholder="Pilih Pembayaran">
                        <option value=""></option>
                        <option value="lumpsum" {{ (old('payment_type') == "lumpsum") ? 'selected' : '' }}>Bayar Sekaligus</option>
                        <option value="parsial" {{ (old('payment_type') == "parsial") ? 'selected' : '' }}>Cicilan</option>
                      </select>
                      @if ($errors->has('payment_type'))
                        <div class="invalid-feedback">
                          {{ $errors->first('payment_type') }}
                        </div>
                      @endif
                    </div>
                  </div>
                  @csrf
                  <input type="hidden" name="package_id" value="{{ $package->id }}">
                  <button class="btn btn-success btn-block" {{ $member == null ? "disabled" : "" }}>Proses Pesanan</button>
                </form>
              </div>
            </div>

            <div class="alert alert-warning" role="alert">
              <i class="fa fa-info"></i> &nbsp Jika memilih cicilan silahkan membayar Uang Muka sebesar minimal Rp 10.000.000
            </div>

            <div class="alert alert-info" role="alert">
              <i class="fa fa-info"></i> &nbsp Setelah melakukan checkout silahkan melakukan konfirmasi pembayaran di halaman transaksi. Pendaftaran dianggap sah jika telah melakukan transfer dan memberikan bukti pembayaran!
            </div>
            
            <div class="card card-primary">
              <div class="card-header">
                <h6 class="m-0 font-weight-bold">Rekening Pembayaran</h6>
              </div>
              <div class="card card-body">
                <ul class="list-group">
                  <li class="list-group-item"><strong>BANK MANDIRI</strong><br />131 00 5950 5950</li>
                  <li class="list-group-item"><strong>BANK MANDIRI SYARIAH</strong><br />007 026 4567</li>
                  <li class="list-group-item"><strong>BANK BNI</strong><br />271 6545</li>
                  <li class="list-group-item"><strong>BANK BJB</strong><br />00000 1000 100 1</li>
                  <li class="list-group-item"><strong>BANK MUAMALAT</strong><br />129 000 1090</li>
                  <li class="list-group-item"><strong>BANK PERMATA SYARIAH</strong><br />377 101 1410</li>
                  <li class="list-group-item"><strong>BANK BRI</strong><br />035401001506301</li>
                  </ul>
              </div>
            </div>

          </div>
        </div>
            
            
      </div>
    </div>
  </section>

@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('assets/stisla/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script>
    function numberFormat(x) {
      return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
    }

    function diffDays(start, end) {
      var a = new Date(start),
      b = new Date(end),
      c = 24*60*60*1000,
      diffDays = Math.round(Math.abs((a - b)/(c)));
      return diffDays;
    }

    @if(Session::has('swal_notification.message'))
      var type = "{{ Session::get('swal_notification.level', 'info') }}";
      switch(type){
        case 'success':
          swal(
            'Sukses!',
            '{{ Session::get('swal_notification.message') }}',
            'success'
          );
          break;

        case 'error':
          swal(
            'Gagal!',
            '{{ Session::get('swal_notification.message') }}',
            'error'
          );
          break;
      }
    @endif
  </script>
@endsection