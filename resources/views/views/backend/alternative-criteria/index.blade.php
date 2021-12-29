@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Alternatif Kriteria</h1>
    </div>

    <div class="d-sm-flex align-items-center justify-content-start mb-4">
      <a class="btn btn-sm btn-primary mr-auto" href="{{ route('alternative-criteria.create') }}"><i class="fa fa-plus"></i> Tambah Alternatif Kriteria</a> 
      <strong><i class="fa fa-info-circle"></i> Info :</strong> &nbsp; Pastikan data alternatif telah diinput dengan semua kriteria.
    </div>

    <div class="row">
      <div class="col-lg-12">

        <!-- Basic Card Example -->
        <div class="card card-primary shadow">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">List Alternatif Kriteria</h6>
          </div>
          <div class="card-body">

          <div class="table-responsive">
            <table class="table table-striped datatable">
              <thead>                                 
                <tr>
                  <th>#</th>
                  <th>Nama Alternatif</th>
                  <th>Nama Kriteria</th>
                  <th>Nilai</th>
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
          pageLength: 50,
          processing: true,
          serverSide: true,
          autoWidth: false,
          language: {
            url: '{{ asset('assets/stisla/modules/datatables/lang/Indonesian.json') }}'
          },
          ajax: {
            url: '{{ route('alternative-criteria.index') }}'
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'alternative.name', name: 'alternative.name'},
            {data: 'criteria.name', name: 'criteria.name'},
            {data: 'score', name: 'score'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
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
</script>
@endsection
