@extends('layouts.front')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="row">
      <div class="card col-md-7">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Hasil Analisa</h6>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Ranking</th>
                <th>Alternatif</th>
                <th>Nilai</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            @for ($i = 0; $i < count($hasilrangking); $i++)
              <tr>
                <td class="text-center">{{ ($i+1) }}</td>
                <td>{{ $alternatifrangking[$i] }}</td>
                <td>{{ $hasilrangking[$i] }}</td>
                <td>{{ nilai_text($hasilrangking[$i]) }}</td>
                <td><a href="{{ url('/checkout', $alternatifrangking_id[$i]) }}" class="btn btn-success btn-xs">Pesan</a></td>
              </tr>
            @endfor
          </table>

          <div class="alert alert-info" role="alert">
            <i class="fa fa-trophy"></i> &nbsp Alternatif Paket Umroh Terbaik Adalah : <strong>{{ $alternatifrangking[0] }}</strong> dengan Nilai Terbesar : <strong>{{ $hasilrangking[0] }}</strong>
          </div>
        </div>
      </div>   
      
      <div class="col-md-5">
        <div class="card">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Perhitungan</h6>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">Alternatif</th>
                </tr>
              </thead>
              @foreach ($alternatif as $item)
                <tr> 
                  <td>{{ $item }}</td>
                </tr>
              @endforeach
            </table>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">Kriteria</th>
                </tr>
              </thead>
              @foreach ($kriteria as $item)
                <tr> 
                  <td>{{ $item }}</td>
                </tr>
              @endforeach
            </table>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">Bobot</th>
                </tr>
              </thead>
              @foreach ($bobot as $item)
                <tr> 
                  <td>{{ $item }}</td>
                </tr>
              @endforeach
            </table>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center" colspan="{{ count($alternatifkriteria) }}">Alternatif Kriteria</th>
                </tr>
              </thead>
              @for ($i=0;$i<count($alternatifkriteria);$i++)
                <tr>
                  @for ($j=0;$j<count($alternatifkriteria[$i]);$j++)
                    <td class="text-center">{{ $alternatifkriteria[$i][$j] }}</td>
                  @endfor
                </tr>
              @endfor
            </table>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">Normalisasi Bobot</th>
                </tr>
              </thead>
              @foreach ($normalisasibobot as $item)
                <tr> 
                  <td>{{ $item }}</td>
                </tr>
              @endforeach
            </table>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">Total Nilai</th>
                </tr>
              </thead>
              @foreach ($total_nilai as $item)
                <tr> 
                  <td>{{ $item }}</td>
                </tr>
              @endforeach
            </table>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">Hasil Ranking</th>
                </tr>
              </thead>
              @foreach ($hasilrangking as $item)
                <tr> 
                  <td>{{ $item }}</td>
                </tr>
              @endforeach
            </table>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">Alternatif Ranking</th>
                </tr>
              </thead>
              @foreach ($alternatifrangking as $item)
                <tr> 
                  <td>{{ $item }}</td>
                </tr>
              @endforeach
            </table>

            <div class="alert alert-info" role="alert">
              <i class="fa fa-trophy"></i> &nbsp Alternatif Paket Umroh Terbaik Adalah : <strong>{{ $alternatifrangking[0] }}</strong> dengan Nilai Terbesar : <strong>{{ $hasilrangking[0] }}</strong>
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