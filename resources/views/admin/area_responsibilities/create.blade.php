@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Penanggung Jawab Area</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Penanggung Jawab Area Kerja</li>
  </ol>
</nav>


@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Tambah Data Penanggung Jawab Area Kerja Cleaning Service</h6>
        <form class="forms-sample" action="{{route('Penanggung-Jawab-Area.store')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="user_id">Nama Pekerja</label>
            <select class="js-example-basic-single w-100" id="user_id" name="user_id">
                <option value="">Pilih Nama Pekerja</option>
                @foreach ($cleaners as $cleaner)
                    <option value="{{$cleaner->id_users}}">{{$cleaner->name}}</option>
                @endforeach
            </select>
            <span class="form-bar text-danger">@error('user_id'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
            <label for="area_id">Area Tanggungan</label>
            <select class="js-example-basic-multiple" style="width: 100%" name="area_id[]" id="area_id" multiple>
                <option value="">Pilih Area Tanggungan</option>
                @foreach ($areas as $area)
                    <option value="{{$area->id_area}}">{{$area->nama_area}} {{$area->desc_area}}</option>
                @endforeach
            </select>
            <span class="form-bar text-danger">@error('area_id'){{ $message }}@enderror</span>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{route('Penanggung-Jawab-Area.index')}}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script>
    $(".js-example-basic-multiple").select2({
        tags: true,
    });
  </script>
  <script>
    $(".js-example-basic-single").select2({
        tags: false
    });
  </script>
@endpush
