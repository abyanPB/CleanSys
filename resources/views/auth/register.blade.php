@extends('layouts.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pr-md-0">
            <div class="auth-left-wrapper" style="background-image: url({{ url('https://via.placeholder.com/219x452') }})">

            </div>
          </div>
          <div class="col-md-8 pl-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">Provice<span>Group</span></a>
              <h5 class="text-muted font-weight-normal mb-4">Silahkan Membuat Akun</h5>
              <form class="forms-sample" action="{{route('register')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name">Nama Lengkap</label>
                  <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" name="name" value="{{old('name')}}" required autofocus autocomplete="name">
                  <span class="form-bar text-danger">@error('name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{old('email')}}" required autofocus autocomplete="email">
                  <span class="form-bar text-danger">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" placeholder="Password">
                  <span class="form-bar text-danger">@error('password'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                  <label for="password_confirmation">Konfirmasi Password</label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="current-password" placeholder="Password">
                  <span class="form-bar text-danger">@error('password_confirmation'){{$message}}@enderror</span>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                    Login
                  </button>
                </div>
                <a href="{{ url('/') }}" class="d-block mt-3 text-muted">Already a user? Sign in</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection