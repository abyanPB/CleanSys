@extends('layouts.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data Pengguna Provice Group</li>
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
        <h6 class="card-title">Tambah Data Pengguna Provice Group</h6>
        <form class="forms-sample" action="{{route('user.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" name="name" value="{{old('name')}}" required autofocus autocomplete="name">
                <span class="form-bar text-danger">@error('name'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="email">Email address<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{old('email')}}" required autofocus autocomplete="email">
                <span class="form-bar text-danger">@error('email'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="no_telepon">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_telepon" placeholder="Nomor Telepon" name="no_telepon" value="{{old('no_telepon')}}">
                <span class="form-bar text-danger">@error('no_telepon'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select class="form-control" id="jk" name="jk">
                  <option selected disabled>Pilih Jenis Kelamin</option>
                  <option value="laki-laki">Laki-Laki</option>
                  <option value="perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="level">Jabatan</label>
                <select class="form-control" id="level" name="level">
                  <option selected disabled>Pilih Jabatan Pekerja, Jika dikosongkan otomatis terisi "Cleaner"</option>
                  <option value="admin">Admin</option>
                  <option value="cleaner">Cleaner</option>
                  <option value="spv">Supervisor</option>
                </select>
            </div>
            <div class="form-group">
                <label for="supervisor_id">Supervisor <span class="text-danger">(Hanya untuk Cleaner)</span></label>
                <select class="form-control" id="supervisor_id" name="supervisor_id">
                    <option value="" selected disabled>Pilih Supervisor</option>
                    @foreach ($supervisors as $supervisor)
                        <option value="{{ $supervisor->id_users }}">{{ $supervisor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="Text" class="form-control" placeholder='Password Awal Otomatis Terisi "12345678"' readonly>
            </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{route('user.index')}}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('custom-scripts')
  <script src="{{ asset('assets/js/file-upload.js') }}"></script>
@endpush
