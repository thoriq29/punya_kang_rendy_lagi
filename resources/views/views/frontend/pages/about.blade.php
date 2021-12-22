@extends('layouts.front')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="row">
      <div class="card col-md-8 mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">About</h6>
        </div>
        <div class="card-body">
          <h2><strong>SMART CHOICE</strong></h2>
          <div>
            <h2>Apa itu SMART Choice</h2>
            <p><strong>SMART CHOICE</strong>&nbsp; SMART CHOICE adalah pemilihan paket berdasarkan algoritma yang sistematis yang dapat membuat anda membantu memilihkan paket yang cocok sesuai dengan kebutuhan paket wisata yang anda butuhkan saat ini</p>
            </div>
            <div>
            <h2>Kenapa memakai SMART CHOICE?</h2>
            <p>Smart Choice atau pilihan pintar membantu anda untuk memilih paket yang tepat dan sesuai dengan kebutuhan anda, dan dengan pilihan yang mudah</p>
            </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Alamat Kami</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <p><strong>Alamat</strong><br><strong>Kantor pusat :<br></strong>  Jl. Tm. Cibeunying Sel. No.15, Cihapit, Kec. Bandung Wetan, Kota Bandung, Jawa Barat 40114<br> (022) 7271409</p>
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

    $(document).ready(function () {
      bsCustomFileInput.init()
      $('.select2').select2();
    })

    function validate() {
      var valid = true;
			if (valid) {
					swal({
              title: "Konfirmasi",
              text: "Apakah anda yakin data yang diinput sudah benar?",
              icon: 'warning',
              buttons: {
              cancel: "Tidak",
              confirm: "Ya"
          }})
          .then((value) => {
              if(value == true){
                $('#form-payment').submit();
              }
          });
			}
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