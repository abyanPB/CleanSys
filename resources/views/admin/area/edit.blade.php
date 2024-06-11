@extends('layouts.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Area Kerja</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Data Area Kerja</li>
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
        <h6 class="card-title">Edit Data Area Kerja Pekerjaan Cleaning Service</h6>
        <form class="forms-sample" action="{{route('area.update',$area->id_area)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="id_area" value="{{$area->id_area}}"> --}}
            <div class="form-group">
                <label for="nama_area">Nama Area Kerja<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_area" name="nama_area" value="{{ $area->nama_area }}" autocomplete="off" placeholder="Nama area kerja : J 1.1" required>
                <span class="form-bar text-danger">@error('nama_area'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="desc_area">Deskripsi Area Kerja<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="desc_area" name="desc_area" value="{{ $area->desc_area }}" placeholder="Deskripsi area kerja : Lobby" required>
                <span class="form-bar text-danger">@error('desc_area'){{$message}}@enderror</span>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <a href="{{route('area.index')}}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('custom-scripts')
  <script src="{{ asset('assets/js/file-upload.js') }}"></script>
@endpush
