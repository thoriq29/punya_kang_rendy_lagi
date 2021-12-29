@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-body">

      <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-box"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Paket</h4>
              </div>
              <div class="card-body">
                {{ \App\Package::count() }}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-info">
              <i class="fas fa-receipt"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Order</h4>
              </div>
              <div class="card-body">
                {{ \App\Order::count() }}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-money-check"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Transaksi Pembayaran</h4>
              </div>
              <div class="card-body">
                Rp {{ rupiah(\App\Payment::all()->sum('paid')) }}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">

          <!-- Basic Card Example -->
          <div class="card mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Selamat datang</h6>
            </div>
            <div class="card-body">
              
              @if (session('status'))
                  <div class="alert alert-primary" role="alert">
                      {{ session('status') }}
                  </div>
              @endif
              Anda login sebagai <i>{{Auth::user()->name}}</i> <br>
            
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection