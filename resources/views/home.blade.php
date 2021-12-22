@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="section-body">
  
      <div class="row">
        <div class="col-lg-12">

          <!-- Basic Card Example -->
          <div class="card mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Selamat datang</h6>
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