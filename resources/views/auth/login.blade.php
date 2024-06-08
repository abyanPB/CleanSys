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
              <h5 class="text-muted font-weight-normal mb-4">Selamat Datang! Silahkan Masuk Ke Akun</h5>
              <form class="forms-sample" action="{{route('store.login')}}" method="POST">
                @csrf
                <div>
                    @if (session('success'))
                    <div class="alert bg-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="Email">
                  <span class="form-bar text-danger">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" autocomplete="password" placeholder="Password">
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password' )">
                        <i data-feather="eye"></i>
                    </button>
                  </div>
                  <span class="form-bar text-danger">@error('password'){{$message}}@enderror</span>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                    Login
                  </button>

                  <a href="{{ route('Guest.create') }}" class="btn btn-info mr-2 mb-2 mb-md-0">
                        Login As Visitor
                  </a>
                </div>
                <a href="{{ url('/forgot-password') }}" class="d-block mt-3 text-muted">Lupa Password?</a>
                {{-- <a href="{{ url('/register') }}" class="d-block mt-3 text-muted">Not a user? Sign up</a> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@push('custom-scripts')
  <script>
    function togglePassword(inputId) {
        var input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
  </script>
@endpush
