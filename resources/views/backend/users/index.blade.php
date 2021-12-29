@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Pengguna</h1>
    </div>

    <div class="d-sm-flex align-items-center justify-content-start mb-4">
      <a class="btn btn-sm btn-primary mr-auto" href="{{ route('user.create') }}"><i class="fa fa-plus"></i> Buat Akun</a> 
      <div class="form-inline">
        <label>Filter Role</label>
        <select name="role" class="form-control-sm ml-2">
          <option value="all">Semua</option>
          <option value="admin">Admin</option>
          <option value="member">Member</option>
        </select>
        <button class="btn btn-sm btn-primary ml-2" id="btn-filter"><i class="fas fa-filter"></i></button>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">

        <!-- Basic Card Example -->
        <div class="card card-primary">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">List Pengguna</h6>
          </div>
          <div class="card-body">

          <div class="table-responsive">
            <table class="table table-striped datatable">
              <thead>                                 
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Email</th>
                  <th>Telepon</th>
                  <th>Role</th>
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
            url: '{{ route('user.index') }}',
            data: function (d) {
              d.role = $('select[name=role]').val()
            }
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'identity_card', name: 'identity_card'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: null, name: 'role', render: function ( data, type, row ) {
              var badge = 'badge-primary';
              if (data.role == 'member') badge = 'badge-primary';
              return '<span class="badge '+badge+'">'+capitalize(data.role)+'</span>';
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
            title: 'Apakah anda yakin ingin nonaktifkan?',
            // text: 'Data yang sudah dihapus, tidak dapat dikembalikan!',
            text: 'Data yang sudah di nonaktifkan, tidak akan bisa dipakai!',
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
      $(document).on('click','.js-submit-confirm-active', function(e){
          e.preventDefault();
          swal({
            title: 'Apakah anda yakin ingin mengaktifkan data?',
            // text: 'Data yang sudah dihapus, tidak dapat dikembalikan!',
            text: 'Data yang sudah diaktifkan, akan dapat dipakai kembali!',
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

  const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
  }
</script>
@endsection
