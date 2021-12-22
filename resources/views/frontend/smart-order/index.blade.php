@extends('layouts.front')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="row">
      <div class="card col-md-12 mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">SMART Order</h6>
        </div>
        <div class="card-body">

          <div class="alert alert-info" role="alert">
            <i class="fa fa-info"></i> &nbsp Silahkan mengisi Kriteria dan Paket yang diinginkan kemudian klik tombol proses. Sistem secara otomatis akan menampilkan saran terbaik sesuai kriteria yang cocok untuk anda.
          </div>
          
          <form action="{{ route('smart-order.process') }}" method="POST" id="form-submit">
            @csrf
            <h4># KRITERIA</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama Kriteria</th>
                  <th>Persentase</th>
                </tr>
              </thead>
              <tbody>
                <!-- @foreach ($criterias as $key => $item)  
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td><input id="bobot{{ $item->id }}" name="bobot{{ $item->id }}" type="number" class="form-control" value="{{ $item->weight }}" onkeyup="checkMax(this)"></td>
                  </tr>
                @endforeach -->
                @foreach ($criterias as $key => $item)  
                  <tr>
                    <td>{{ $item->name }}</td>
                    <td>
                      <select class="form-control" name="bobot{{ $item->id }}" data-live-search="true" style="width:100%">
                        <option value="0"> --Silahkan Pilih-- </option>
                        @foreach ($alternatif as $key => $alt)
                          @if($item->name == $key) {
                            @foreach ($alternatif[$key] as $key => $itm)
                              <option value="{{ $key }}">{{ $itm }}</option>
                            @endforeach
                          }
                          @endif
                        @endforeach
                      </select>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            <h4># PILIH PAKET UMRAH</h4>
            <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>Nama Paket</th>
                  <th>Tanggal Berangkat</th>
                  <th>Tanggal Pulang</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($packages as $key => $item)  
                <tr>
                  <td style="display:none;" class="text-center"><input id="alternatif{{ $item->id }}" name="alternatif{{ $item->id }}" class="cb-paket" type="checkbox" value="true" checked></td>
                  <td><input id="alternatif{{ $item->id }}" name="alternatif{{ $item->id }}" class="cb-paket" type="hidden" value="true" checked>  {{ $item->name }}</td>
                  <td>{{ date_dmy($item->start_date) }}</td>
                  <td>{{ date_dmy($item->end_date) }}</td>
                  <td>Rp {{ rupiah($item->price) }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5" class="text-center">
                    <button type="button" class="btn btn-success px-4" onclick="validate()">Proses</button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </form>
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

      if ($('.cb-paket:checked').length < 1) {
        valid = false;
      }

			if (!valid) {
					swal({
              title: "Perhatian",
              text: "Maaf setidaknya harus ada 1 paket yang diceklis!",
              icon: 'warning'
          });
			} else {
        $('#form-submit').submit();
      }
		}

    function checkMax(ini) {
      var val = $(ini).val();

      if (val > 100) {
        alert('Maximum bobot adalah 100');
        $(ini).val(100);
      }

      if (val < 0) {
        alert('Nilai bobot tidak boleh minus');
        $(ini).val(1);
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