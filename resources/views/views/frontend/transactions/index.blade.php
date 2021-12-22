@extends('layouts.front')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Transaksi Saya</h1>
    </div>

    <div class="row">
      <div class="col-lg-12">

        <!-- Basic Card Example -->
        <div class="card card-primary">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">List Transaksi</h6>
          </div>
          <div class="card-body">

          <div class="table-responsive">
            <table class="table table-striped datatable">
              <thead>                                 
                <tr>
                  <th>#</th>
                  <th>Invoice</th>
                  <th>Nama</th>
                  <th>Nama Paket</th>
                  <th>Harga</th>
                  <th>Biaya Tambahan \ Denda</th>
                  <th>Total Harga</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')
<script>
  $(document).ready(function() {
      $('.datatable').DataTable({
          processing: true,
          serverSide: true,
          autoWidth: false,
          language: {
              url: '{{ asset('assets/stisla/modules/datatables/lang/Indonesian.json') }}'
          },
          ajax: {
            url: '{{ route('transaction.index') }}',
            data: function (d) {
              d.status = $('select[name=status]').val()
            }
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'invoice', name: 'invoice'},
            {data: 'customer.name', name: 'customer.name'},
            {data: 'package.name', name: 'package.name'},
            {data: null, name: 'price', render: function ( data, type, row ) {
              return 'Rp ' + numberFormat(parseInt(data.price));
            }},
            {data: null, name: 'additional_fee', render: function ( data, type, row ) {
              return 'Rp ' + numberFormat(parseInt(data.additional_fee));
            }},
            {data: null, name: 'price_total', render: function ( data, type, row ) {
              return 'Rp ' + numberFormat(parseInt(data.price_total));
            }},
            {data: 'display_status', name: 'display_status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      $('#btn-filter').click(function(){
         $('.datatable').DataTable().draw(true);
      });

      $(document).on('click','.js-submit-confirm', function(e){
          e.preventDefault();
          swal({
            title: 'Apakah anda yakin ingin menghapus?',
            text: 'Data yang sudah dihapus, tidak dapat dikembalikan!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $(this).closest('form').submit();
            } 
          });
      });
  });

  function numberFormat(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
  }

  const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
  }
</script>
@endsection
