@extends('layouts.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Edit Paket Umrah</h1>
    </div>

    <form method="POST" action="{{ route('package.update', $package->id) }}" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-8">
          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Informasi Paket Umrah</h6>
            </div>
            <div class="card-body">
              {{ csrf_field() }} @method('PUT')

              <div class="row">
                <div class="form-group col-8 {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Nama Paket</label>
                  <input id="name" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" tabindex="1" value="{{ $package->name }}">
                  @if ($errors->has('name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>
                
                <div class="form-group col-4 {{ $errors->has('quota') ? ' has-error' : '' }}">
                  <label for="quota">Kuota</label>
                  <input id="quota" type="number" class="form-control @if ($errors->has('quota')) is-invalid @endif" name="quota" tabindex="1" value="{{ $package->quota }}">
                  @if ($errors->has('quota'))
                    <div class="invalid-feedback">
                      {{ $errors->first('quota') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-6 {{ $errors->has('start_date') ? ' has-error' : '' }}">
                  <label for="start_date">Tanggal Berangkat</label>
                  <input id="start_date" type="date" class="form-control @if ($errors->has('start_date')) is-invalid @endif" name="start_date" tabindex="1" value="{{ $package->start_date}}">
                  @if ($errors->has('start_date'))
                    <div class="invalid-feedback">
                      {{ $errors->first('start_date') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-6 {{ $errors->has('end_date') ? ' has-error' : '' }}">
                  <label for="end_date">Tanggal Pulang</label>
                  <input id="end_date" type="date" class="form-control @if ($errors->has('end_date')) is-invalid @endif" name="end_date" tabindex="1" value="{{ $package->end_date }}">
                  @if ($errors->has('end_date'))
                    <div class="invalid-feedback">
                      {{ $errors->first('end_date') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-12 {{ $errors->has('price') ? ' has-error' : '' }}">
                  <label for="price">Harga</label>
                  <input id="price" type="number" class="form-control @if ($errors->has('price')) is-invalid @endif" name="price" tabindex="1" value="{{ $package->price }}">
                  @if ($errors->has('price'))
                    <div class="invalid-feedback">
                      {{ $errors->first('price') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description">Deskripsi Paket</label>
                  <textarea id="description" class="summernote @if ($errors->has('description')) is-invalid @endif" name="description" tabindex="1" >{{ $package->description }}</textarea>
                  @if ($errors->has('description'))
                    <div class="invalid-feedback">
                      {{ $errors->first('description') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                  Simpan
                </button>
              </div>
              
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Gambar Paket</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="text-center">
                  @if (is_null($package->image))
                  <img src="{{ asset('assets/stisla/img/example-image.jpg') }}" class="rounded-circle" id="image-prev" width="200" height="200" alt="image">
                  @else
                  <img alt="image" src="{{asset('uploads/images/packages/'.$package->image)}}" class="rounded-circle" id="images-prev" width="200" height="200" alt="images">
                  @endif
                </div>
              </div>
              <div class="form-group custom-file mb-3">
                <input id="image" type="file" class="custom-file-input {{ $errors->has('image') ? ' has-error' : '' }}" name="image">
                <label class="custom-file-label" for="customFile">Pilih Gambar</label>
              </div>
              @if ($errors->has('image'))
                <div class="invalid-feedback">
                  <strong>{{ $errors->first('image') }}</strong>
                </div>
              @endif
            </div>
          </div>

          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Status Paket</h6>
            </div>
            <div class="card-body">
              <div class="form-group col-12 {{ $errors->has('status') ? ' has-error' : '' }}">
                <select name="status" id="" class="form-control select2 @if ($errors->has('status')) is-invalid @endif">
                  <option value="100" {{ ($package->status == 100 ? "selected" : "") }}>Aktif</option>
                  <option value="10" {{ ($package->status == 10 ? "selected" : "") }}>Non Aktif</option>
                </select>
                @if ($errors->has('status'))
                  <div class="invalid-feedback">
                    {{ $errors->first('status') }}
                  </div>
                @endif
              </div>
            </div>
          </div>

        </div>
      </div>
    </form>
  </section>
@endsection

@section('script')
<script src="{{ asset('assets/stisla/modules/summernote/summernote-bs4.js') }}"></script>
  <script type="text/javascript">
    $(".summernote").summernote({
        dialogsInBody: true,
        minHeight: 250,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture']],
          ['view', ['codeview', 'help']],
        ],
    });
    
    $(document).ready(function () {
      bsCustomFileInput.init()
      $('.select2').select2();
    })

    function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#image-prev').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#image").change(function() {
      readURL(this);
    });
  </script>
@endsection