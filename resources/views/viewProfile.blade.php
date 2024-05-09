@extends('layouts.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Profile</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profile Pengguna</li>
  </ol>
</nav>

@if (session('success'))
<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{session('error')}}
</div>
@endif


<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    @if (request()->user()->image_profile == null)
                        <img src="{{ url('https://ui-avatars.com/api/?name='.request()->user()->name)}}" class="rounded-circle p-1 bg-secondary" width="100" alt="user-profile">
                    @else
                        <img src="{{asset('images/pengguna/'.$user->image_profile)}}" class="p-1 bg-light" width="200" alt="user-profile">
                    @endif

                    <div class="mt-3">
                        <h4>{{Auth::guard('web')->user()->name}}</h4>
                        <p class="text-secondary mb-1">{{Str::of(Auth::guard('web')->user()->level)->title()}}</p>
                        <p class="text-secondary mb-1">{{Auth::guard('web')->user()->email}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="alert alert-info text-center"><h5>Anda Dapat Mengubah Profile</h5></div>
            <form class="forms-sample" action="{{route('changeProfile')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Lengkap<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" name="name" value="{{ $user->name }}" required autocomplete="name">
                        <span class="form-bar text-danger">@error('name'){{$message}}@enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $user->email }}" required autocomplete="email">
                        <span class="form-bar text-danger">@error('email'){{$message}}@enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_telepon" placeholder="Nomor Telepon" name="no_telepon" value="{{ $user->no_telepon }}">
                        <span class="form-bar text-danger">@error('no_telepon'){{$message}}@enderror</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="jk" name="jk" disabled>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki" {{ $user->jk == 'laki-laki'?'selected' : '' }}>Laki-Laki</option>
                            <option value="perempuan" {{ $user->jk == 'perempuan'?'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Jabatan</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="level" name="level" disabled>
                            <option value="">Pilih Jabatan</option>
                            <option value="admin" {{ $user->level == 'admin'?'selected' : '' }}>Admin</option>
                            <option value="cleaner" {{ $user->level == 'cleaner'?'selected' : '' }}>Cleaner</option>
                            <option value="spv" {{ $user->level == 'spv'?'selected' : '' }}>Supervisor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">File Upload</label>
                    <input type="file" name="image_profile" class="file-upload-default">
                    <div class="input-group col-sm-9">
                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                    <span class="input-group-append-sm">
                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                    </div>
                    <span class="form-bar text-danger">@error('image_profile'){{$message}}@enderror</span>
                </div>
                <div class="form-group row">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password Lama</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="Masukkan Password Lama" name="current_password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password Baru</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" autocomplete="off" placeholder="Masukkan Password Baru" name="new_password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" placeholder="Ulangi Password Lama" name="confirm_password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan</button>
            </form>
          </div>
        </div>
    </div>
  </div>
@endsection

@push('custom-scripts')
  <script src="{{ asset('assets/js/file-upload.js') }}"></script>
@endpush
