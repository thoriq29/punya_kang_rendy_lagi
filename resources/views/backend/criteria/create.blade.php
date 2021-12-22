@extends('layouts.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Tambah Kriteria</h1>
    </div>

    <form method="POST" action="{{ route('criteria.store') }}" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Informasi Kriteria</h6>
            </div>
            <div class="card-body">
              {{ csrf_field() }}

              <div class="row">
                <div class="form-group col-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Nama Kriteria</label>
                  <input id="name" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" tabindex="1" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>
                
                <div class="form-group col-12 {{ $errors->has('weight') ? ' has-error' : '' }}">
                  <label for="weight">Bobot</label>
                  <input id="weight" type="number" class="form-control @if ($errors->has('weight')) is-invalid @endif" name="weight" tabindex="1" value="{{ old('weight') }}" max="100" onkeyup="checkMax(this)">
                  @if ($errors->has('weight'))
                    <div class="invalid-feedback">
                      {{ $errors->first('weight') }}
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
  </script>
@endsection