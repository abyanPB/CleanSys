@extends('layouts.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Area Kerja</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data area</li>
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
        <h6 class="card-title">Tambah Data Area Kerja Pekerjaan Cleaning Service</h6>
        <form class="forms-sample" action="{{route('area.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="nama_area">Nama Area Kerja</label>
            <input type="text" class="form-control" id="nama_area" name="nama_area" autocomplete="off" placeholder="Nama Area Kerja : J 1.1">
            <span class="form-bar text-danger">@error('nama_area'){{$message}}@enderror</span>
          </div>
          <div class="form-group">
            <label for="desc_area">Keterangan Area Kerja</label>
            <input type="text" class="form-control" id="desc_area" name="desc_area" placeholder="Keterangan Area Kerja : Lobby">
            <span class="form-bar text-danger">@error('desc_area'){{$message}}@enderror</span>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
