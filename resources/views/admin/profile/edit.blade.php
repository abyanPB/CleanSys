@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Pengguna Provice Group</li>
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
        <h6 class="card-title">Edit Data Pengguna Provice Group</h6>
        <form class="forms-sample" action="{{route('user.update',$user->id_users)}}" method="POST">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="id_user" value="{{$user->id_user}}"> --}}
            <div class="form-group">
                <label for="name">Nama Lengkap<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" name="name" value="{{ $user->name }}" required autofocus autocomplete="name">
                <span class="form-bar text-danger">@error('name'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="email">Email address<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $user->email }}" required autofocus autocomplete="email">
                <span class="form-bar text-danger">@error('email'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="no_telepon">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_telepon" placeholder="Nomor Telepon" name="no_telepon" value="{{ $user->no_telepon }}">
                <span class="form-bar text-danger">@error('no_telepon'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <br>
                <select class="js-example-basic-single" id="jk" name="jk">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="laki-laki" {{ $user->jk == 'laki-laki'?'selected' : '' }}>Laki-Laki</option>
                    <option value="perempuan" {{ $user->jk == 'perempuan'?'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jk">Jabatan</label>
                <br>
                <select class="js-example-basic-single" id="level" name="level">
                    <option value="">Pilih Jabatan</option>
                    <option value="admin" {{ $user->level == 'admin'?'selected' : '' }}>Admin</option>
                    <option value="cleaner" {{ $user->level == 'cleaner'?'selected' : '' }}>Cleaner</option>
                    <option value="spv" {{ $user->level == 'spv'?'selected' : '' }}>Supervisor</option>
                </select>
            </div>
            @if ($user->level == 'cleaner')
                <div class="form-group">
                    <label for="supervisor_id">Supervisor</label>
                    <br>
                    <select class="js-example-basic-single" id="supervisor_id" name="supervisor_id">
                        <option value="" selected disabled>Pilih Supervisor</option>
                        @foreach ($supervisors as $supervisor)
                            <option value="{{ $supervisor->id_users }}" {{ $user->supervisor_id == $supervisor->id_users ? 'selected' : '' }}>
                                {{ $supervisor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <a href="{{route('user.index')}}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush

@push('custom-scripts')
<script>
    $(".js-example-basic-single").select2({
        tags: false
    });
  </script>
@endpush
