@extends('layouts.main')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Pembayaran</h6>
      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header">
                Informasi Order
              </div>
              <div class="card-body">
                <div>
                  Order Invoice<br>
                  <strong>{{ $payment->order->invoice }}</strong>
                </div>
                <hr>
                <div>
                  Nama Peserta<br>
                  <strong>{{ $payment->order->customer->name }}</strong>
                </div>
                <hr>
                <div>
                  Paket Umroh <br>
                  <strong>{{ $payment->order->package->name }}</strong>
                </div>
                <hr>
                <div>
                  Harga Paket<br>
                  <strong>Rp {{ rupiah($payment->order->price) }}</strong>
                </div>
                <hr>
                <div>
                  Biaya Tambahan \ Denda <br>
                  <strong>Rp {{ rupiah($payment->order->additional_fee) }}</strong>
                </div>
                <hr>
                <div>
                  Total Harga <br>
                  <strong>Rp {{ rupiah($payment->order->price_total) }}</strong>
                </div>
                <hr>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                Verifikasi Pembayaran
              </div>
              <div class="card-body">
                @if ($payment->order->payment_type == "parsial")  
                  <div>
                    Jenis Bayar<br>
                    <strong><span class="badge badge-light"><strong>{{ ($payment->is_down_payment == 1) ? "Down Payment (DP)" : "Pembayaran Ke-" . $payment->payment_count }}</strong></span></strong>
                  </div>
                  <hr>
                @endif
                <div>
                  Metode Pembayaran<br>
                  <strong>{{ $payment->method }}</strong>
                </div>
                <hr>
                <div>
                  Transfer Atas Nama <br>
                  <strong>{{ $payment->account_holder }}</strong>
                </div>
                <hr>
                <div>
                  Total Transfer <br>
                  <strong>Rp {{ rupiah($payment->paid) }}</strong>
                </div>
                <hr>
                <label for="">Bukti Pembayaran</label>
                <div class="form-group">
                  <div class="text-left">
                    @if (is_null($payment->image))
                    <img src="{{ asset('assets/stisla/img/example-image.jpg') }}" class="rounded" id="image-prev" width="200" alt="image">
                    @else
                    <img alt="image" src="{{asset('uploads/images/payments/'.$payment->image)}}" class="rounded" id="images-prev" width="200" alt="images">
                    @endif
                  </div>
                </div>
                <hr>
                <div>
                  Status Verifikasi <br>
                  @if ($payment->is_verification == 1)
                    <span class="badge badge-success">Terverifikasi</span>
                  @else
                    <span class="badge badge-warning">Belum diverifikasi</span>
                  @endif
                  <hr>
                  @if ($payment->is_verification == 0 && $payment->order->status != 10)  
                    <form id="frm-reject" action="{{ route('payment.update', $payment->id) }}" method="post">
                      @csrf
                      @method('patch')
                      <button class="btn btn-success btn-sm" id="btn-verification"><i class="fa fa-check"></i> Klik untuk verifikasi</button>
                    </form>
                  @endif
                </div>
              </div>
            </div>
            @if ($payment->order->status == 10)
              <div class="alert alert-danger alert-has-icon">
                <div class="alert-icon"><i class="fa fa-info"></i></div>
                <div class="alert-body">
                  <div class="alert-title">Order ini Dibatalkan</div>
                </div>
              </div>
            @endif
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