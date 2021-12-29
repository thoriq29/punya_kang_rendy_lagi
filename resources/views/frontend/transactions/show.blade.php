@extends('layouts.front')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
  <section class="section">

    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-money-check-alt"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Harga Paket</h4>
            </div>
            <div class="card-body">
              Rp {{ rupiah($paid_data["price"]) }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-money-bill-alt"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Telah Dibayar</h4>
            </div>
            <div class="card-body">
              Rp {{ rupiah($paid_data["paid_off"]) }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-money-bill-wave"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Sisa Pembayaran</h4>
            </div>
            <div class="card-body">
              Rp {{ rupiah($paid_data["paid_remain"]) }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Order</h6>
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
                  Kode Invoice<br>
                  <strong>{{ $order->invoice }}</strong>
                </div>
                <hr>
                <div>
                  Nama Peserta<br>
                  <strong>{{ $order->customer->name }}</strong>
                </div>
                <hr>
                <div>
                  Paket Umroh <br>
                  <strong>{{ $order->package->name }}</strong>
                </div>
                <hr>
                <div>
                  Tanggal Berangkat <br>
                  <strong>{{ $order->package->start_date }}</strong>
                </div>
                <hr>
                <div>
                  Tanggal Pulang <br>
                  <strong>{{ $order->package->end_date }}</strong>
                </div>
                <hr>
                <div>
                  Cara Pembayaran <br>
                  <span class="badge badge-primary">
                    <strong>{{ $order->payment_type_name }}</strong>
                  </span>
                </div>
                <hr>
                <div>
                  Status Order <br>
                  <span class="badge badge-primary">
                    {{ $order->display_status }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                Informasi Harga
              </div>
              <div class="card-body">
                <div>
                  Harga Paket<br>
                  <strong>Rp {{ rupiah($order->price) }}</strong>
                </div>
                <hr>
                <div>
                  Biaya Tambahan \ Denda<br>
                  <strong>Rp {{ rupiah($order->additional_fee) }}</strong>
                </div>
                <hr>
                <div>
                  Total Harga <br>
                  <strong>Rp {{ rupiah($order->price_total) }}</strong>
                </div>
                <hr>
              </div>
            </div>
            @if ($order->status == 10)
              <div class="alert alert-danger alert-has-icon">
                <div class="alert-icon"><i class="fa fa-info"></i></div>
                <div class="alert-body">
                  <div class="alert-title">Order ini Dibatalkan</div>
                </div>
              </div>
            @endif
          </div>

          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                Histori Pembayaran
              </div>
              <div class="card-body p-0">
                <table class="table table-striped table-md">
                  <thead>
                    <tr>
                      <th>#</th>
                      @if ($order->payment_type == "parsial")  
                        <th>Jenis Bayar</th>
                      @endif
                      <th>Metode Bayar</th>
                      <th>Transfer Atas Nama</th>
                      <th>Jumlah Ditransfer</th>
                      <th>Tanggal Transfer</th>
                      <th>Bukti Pembayaran</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($order->payment as $key => $item)    
                      <tr>
                        <td>{{ ++$key }}</td>
                        @if ($order->payment_type == "parsial")  
                          <td><span class="badge badge-success">{{ ($item->is_down_payment == 1) ? "Down Payment (DP)" : "Pembayaran Ke-" . $item->payment_count }}</span></td>
                        @endif
                        <td>{{ $item->method }}</td>
                        <td>{{ $item->account_holder }}</td>
                        <td>Rp {{ rupiah($item->paid) }}</td>
                        <td>{{ date_dmy($item->created_at) }}</td>
                        <td><img class="mr-3 rounded" width="80" src="{{asset('uploads/images/payments/'.$item->image)}}" alt="img"></td>
                        <td><div class="badge badge-info">{{ $item->display_status }}</div></td>
                      </tr>
                    @empty
                      <tr><td colspan="7" class="text-center">Belum Ada Pembayaran</td></tr>
                    @endforelse
                  </tbody>
                </table>
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