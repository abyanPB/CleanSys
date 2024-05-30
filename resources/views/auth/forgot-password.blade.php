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
              <h5 class="text-muted font-weight-normal mb-4">Silahkan Reset Password Anda</h5>
              <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="Email">
                  <span class="form-bar text-danger">@error('email'){{$message}}@enderror</span>
                  <span class="form-bar text-success">{{ session('status') }}</span>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                    Email Password Reset Link
                  </button>
                </div>
                  <a href="{{ url('/') }}" class="d-block mt-3 text-muted">Tiba-Tiba Ingat? Login!</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
