@extends('layouts.front')

@section('content')
  {{-- <div class="col-12 mb-4">
    <div class="hero bg-primary text-white">
      <div class="hero-inner">
        <h2>Selamat datang di {{ config('app.name') }}</h2>
        <p class="lead">Solusi penyewaan bus sesama penyedia. Mudah, aman dan murah.</p>
      </div>
    </div>
  </div> --}}
  <section class="section">
    <h2 class="section-title">Paket Umrah</h2>
    <div class="row">
      @forelse ($packages as $item)
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <article class="article article-style-b">
            <div class="article-header">
              <div class="article-image" data-background="{{ asset('uploads/images/packages/'.$item->image) }}">
              </div>
            </div>
            <div class="article-details">
              <div class="article-title">
                <h2><a href="javascript:void(0)" onclick="showDetail({{ $item->id }})">{{ $item->name }}</a></h2>
              </div>
              <strong class="text-danger">Rp {{ rupiah($item->price) }}</strong> <br>
              <p>
                <i class="fa fa-fw fa-clock"></i> <small>{{ diff_days($item->start_date, $item->end_date) }} Hari</small> <br>
                <i class="fa fa-fw fa-calendar"></i> <small>{{ date_dmy($item->start_date) }} - {{ date_dmy($item->end_date) }}</small> 
              </p>
              <div class="article-cta">
                <a href="javascript:void(0)" onclick="showDetail({{ $item->id }})"><i class="fa fa-eye"></i> Detail</a>
              </div>
            </div>
          </article>
        </div>
      @empty
        <div class="col-md-4 offset-md-5">
          Tidak ada paket tersedia :(
        </div>
      @endforelse
      <div class="col-12">
        {{ $packages->links() }}
      </div>
    </div>
  </section>

    <!-- Modal -->
  <div class="modal fade" tabindex="-1" id="detailModal" role="dialog" aria-labelledby="detailModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Paket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <img src="" class="rounded" id="image-package" width="200" height="200" alt="image">
              <div class="mt-2">
                <strong class="text-primary txt-name">AAA</strong> <br>
                <strong class="text-danger txt-price">Rp 100000 -hari</strong> <br>
                {{-- <p>
                  <i class="fa fa-fw fa-user"></i> <span id="txt-company">aaaa</span> <br>
                  <i class="fa fa-fw fa-map-marker-alt"></i> <span id="txt-location">xxxx</span> <br>
                </p> --}}
              </div>
            </div>
            <div class="col-md-8">
              <strong>Deksripsi</strong>
              <div id="txt-description">

              </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <a href="javascript:void(0)" type="button" onclick="checkout()" id="btn-a2c" class="btn btn-primary">Pesan</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <form id="booking-form" action="#" method="POST" style="display: none;">
      @csrf
      <input type="hidden" id="package-id" name="package_id">
  </form>
@endsection

@section('script')
  <script>
    function showDetail(id) {
      $.ajax({
         type:'POST',
         url:'{{ route("pg.detail") }}',
         headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
         data: {id:id},
         success:function(data){
            console.log(data)

            $('.txt-name').html(data.name);
            $('.txt-price').text('Rp ' + numberFormat(parseInt(data.price)));
            $('#txt-description').html(data.description);
            $('#package-id').val(data.id);

            var img = '{{ asset('uploads/images/packages') }}/' + data.image;
            if (img != null) {
              $('#image-package').attr('src', img);
            }

            $('#detailModal').modal('show');
         }
      });
    }

    function numberFormat(x) {
      return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
    }

    function checkout() {
      var p_id = $("#package-id").val();
      window.location.href = "{{ url('/') }}/checkout/" + p_id;
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