@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Pembayaran</h1>
    </div>

    <div class="d-sm-flex align-items-center justify-content-start mb-4">
      <strong><i class="fa fa-info-circle"></i> Info :</strong> &nbsp; Proses verifikasi dapat dilakukan di halaman detail.
      <div class="form-inline ml-auto">
        <label>Filter Verifikasi</label>
        <select name="verification" class="form-control-sm ml-2">
          <option value="all">Semua</option>
          <option value="1">Terverifikasi</option>
          <option value="0">Menunggu Verifikasi</option>
        </select>
        <button class="btn btn-sm btn-primary ml-2" id="btn-filter"><i class="fas fa-filter"></i></button>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">

        <!-- Basic Card Example -->
        <div class="card card-primary">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">List Pembayaran</h6>
          </div>
          <div class="card-body">

          <div class="table-responsive">
            <table class="table table-striped datatable">
              <thead>                                 
                <tr>
                  <th>#</th>
                  <th>Invoice</th>
                  <th>Dari Bank</th>
                  <th>Atas Nama</th>
                  <th>Total Bayar</th>
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
            url: '{{ route('payment.index') }}',
            data: function (d) {
              d.verification = $('select[name=verification]').val()
            }
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'order.invoice', name: 'order.invoice'},
            {data: 'method', name: 'method'},
            {data: 'account_holder', name: 'account_holder'},
            {data: null, name: 'paid', render: function ( data, type, row ) {
              return 'Rp ' + numberFormat(parseInt(data.paid));
            }},
            {data: null, name: 'is_verification', render: function ( data, type, row ) {
              var badge = 'badge-warning';
              if (data.is_verification == 1){
                badge = 'badge-success';  
                return '<span class="badge '+badge+'">Terverifikasi</span>';
              } else {
                return '<span class="badge '+badge+'">Menunggu Verifikasi</span>';
              }
            }},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

      $('#btn-filter').click(function(){
         $('.datatable').DataTable().draw(true);
      });

      function numberFormat(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
      }

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

</script>
@endsection
