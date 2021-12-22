@extends('layouts.main')

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/stisla/modules/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Tambah Alternatif Kriteria</h1>
    </div>

    <form method="POST" action="{{ route('alternative-criteria.store') }}" enctype="multipart/form-data">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Informasi Alternatif Kriteria</h6>
            </div>
            <div class="card-body">
              {{ csrf_field() }}

              @if ($errors->has('data_exist'))
                <div class="alert alert-warning">{{ $errors->first('data_exist') }}</div>
              @endif

              <div class="row">
                <div class="form-group col-12 {{ $errors->has('alternative_id') ? ' has-error' : '' }}">
                  <label for="alternative_id">Alternatif</label>
                  <select name="alternative_id" id="" class="form-control select2 @if ($errors->has('alternative_id')) is-invalid @endif" data-placeholder="Pilih Alternatif">
                    <option value=""></option>
                    @foreach ($packages as $item)
                      <option value="{{ $item->id }}" {{ (old('alternative_id') == $item->id) ? 'selected' : "" }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('alternative_id'))
                    <div class="invalid-feedback">
                      {{ $errors->first('alternative_id') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-12 {{ $errors->has('criteria_id') ? ' has-error' : '' }}">
                  <label for="criteria_id">Kriteria</label>
                  <select name="criteria_id" id="" class="form-control select2 @if ($errors->has('criteria_id')) is-invalid @endif" data-placeholder="Pilih Kriteria">
                    <option value=""></option>
                    @foreach ($criterias as $item)
                      <option value="{{ $item->id }}" {{ (old('criteria_id') == $item->id) ? 'selected' : "" }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('criteria_id'))
                    <div class="invalid-feedback">
                      {{ $errors->first('criteria_id') }}
                    </div>
                  @endif
                </div>
                
                <div class="form-group col-12 {{ $errors->has('score') ? ' has-error' : '' }}">
                  <label for="score">Nilai</label>
                  <input id="score" type="number" class="form-control @if ($errors->has('score')) is-invalid @endif" name="score" tabindex="1" value="{{ old('score') }}" max="100" onkeyup="checkMax(this)">
                  @if ($errors->has('score'))
                    <div class="invalid-feedback">
                      {{ $errors->first('score') }}
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
        alert('Maximum nilai adalah 100');
        $(ini).val(100);
      }

      if (val < 0) {
        alert('Nilai tidak boleh minus');
        $(ini).val(1);
      }
    }
  </script>
@endsection