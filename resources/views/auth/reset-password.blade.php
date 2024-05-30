@extends('layouts.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pr-md-0">
            <div class="auth-left-wrapper" style="background-image: url({{asset('images/logo/provice_group.jpeg')}}); background-size: contain; background-position: center; background-repeat: no-repeat; height:  100%; border:2px solid #000062; border-right:none">
            </div>
          </div>
          <div class="col-md-8 pl-md-0">
            <div class="auth-form-wrapper px-4 py-5" style="border:2px solid #000062;">
              <a href="#" class="noble-ui-logo d-block mb-2">Provice<span>Group</span></a>
              <h5 class="text-muted font-weight-normal mb-4">Silahkan Masukan Sandi Baru</h5>
              <form class="forms-sample" action="{{route('password.store')}}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{old('email', $request->email)}}">
                  <span class="form-bar text-danger">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password Baru Anda" required autofocus autocomplete="new-password">
                  <span class="form-bar text-danger">@error('password'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Konfirmasi Password</label>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Masukan Password Yang Sama" required autocomplete="new-password">
                  <span class="form-bar text-danger">@error('password_confirmation'){{$message}}@enderror</span>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                    Reset Password
                  </button>
                </form>
                <a href="{{ url('/') }}" class="d-block mt-3 text-muted">Sudah Ingat? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
