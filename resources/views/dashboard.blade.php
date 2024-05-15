@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

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

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Selamat Datang, {{request()->user()->name}}</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    @php
    // Set locale ke bahasa Indonesia
    \Carbon\Carbon::setLocale('id');
    @endphp
    <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex">
      <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control" value="{{ \Carbon\Carbon::now()->translatedFormat('l, d-m-Y') }}" readonly>
    </div>
  </div>
</div>

@if (request()->user()->default_pass == 1)
@if (request()->user()->level == 'admin')
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Laporan Grooming Bulan {{$dataAdmin['monthYearNow']}}</h6>
              <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item d-flex align-items-center" href="{{route('laporan-grooming.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$dataAdmin['totalSelesaiGrooming']}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Laporan PJKP Bulan {{$dataAdmin['monthYearNow']}}</h6>
              <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <a class="dropdown-item d-flex align-items-center" href="{{route('laporan-pjkp.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$dataAdmin['totalSelesaiPjkp']}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Akun Cleaner {{$dataAdmin['monthYearNow']}}</h6>
              <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <a class="dropdown-item d-flex align-items-center" href="{{route('user.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$dataAdmin['totalAkunCleaner']}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@elseif (request()->user()->level == 'spv')
<h4 style="text-align: center;" >LAPORAN GROOMING</h4>
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow">
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Laporan Grooming (Sebelum) Hari Ini</h6>
                <div class="dropdown mb-2">
                  <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item d-flex align-items-center" href="{{route('laporan-grooming.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">{{$dataSpv['laporanGroomingSebelum']}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-0">Total Laporan Grooming (Proses) Hari Ini</h6>
                <div class="dropdown mb-2">
                  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item d-flex align-items-center" href="{{route('laporan-pjkp.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-12 col-xl-5">
                  <h3 class="mb-2">{{$dataSpv['laporanGroomingProses']}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Total Laporan Grooming (Hasil) Hari Ini</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <a class="dropdown-item d-flex align-items-center" href="{{route('laporan-pjkp.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{$dataSpv['laporanGroomingHasil']}}</h3>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Laporan Grooming Belum Ditanggapi Hari Ini</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <a class="dropdown-item d-flex align-items-center" href="{{route('user.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{$dataSpv['laporanGroomingBelumDitanggapi']}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>

<h4 style="text-align:center">LAPORAN PJKP</h4>
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Total Laporan PJKP (Sebelum) Hari Ini</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item d-flex align-items-center" href="{{route('laporan-grooming.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{$dataSpv['laporanPjkpSebelum']}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Total Laporan PJKP (Proses) Hari Ini</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <a class="dropdown-item d-flex align-items-center" href="{{route('laporan-pjkp.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{$dataSpv['laporanPjkpProses']}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Total Laporan PJKP (Hasil) Hari Ini</h6>
                    <div class="dropdown mb-2">
                      <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <a class="dropdown-item d-flex align-items-center" href="{{route('laporan-pjkp.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 col-md-12 col-xl-5">
                      <h3 class="mb-2">{{$dataSpv['laporanPjkpHasil']}}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Laporan PJKP Belum Ditanggapi Hari Ini</h6>
                      <div class="dropdown mb-2">
                        <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <a class="dropdown-item d-flex align-items-center" href="{{route('user.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">{{$dataSpv['laporanPjkpBelumDitanggapi']}}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
      </div>
    </div>
</div>

<h4 style="text-align: center">Akun Cleaner</h4>
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Total Akun Cleaner {{$dataAdmin['monthYearNow']}}</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <a class="dropdown-item d-flex align-items-center" href="{{route('user.index')}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">{{$dataSpv['totalAkunCleaner']}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>


      </div>
    </div>
</div>


  @elseif (request()->user()->level == 'cleaner')

@endif




@elseif(request()->user()->default_pass == 0)
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <h6 class="card-title">Silakan ubah kata sandi default Anda.</h6>
            <form class="forms-sample" action="{{ route('defaultpass') }}" method="POST">
                @csrf
                @if (request()->user()->jk == null)
                <div class="form-group row">
                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="jk" name="jk">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                        <span class="form-bar text-danger">@error('jk'){{$message}}@enderror</span>
                    </div>
                </div>
                @endif
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Password Lama</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Masukkan Password Lama" name="current_password" id="current_password" value="{{ old('current_password') }}" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password' )">
                                <i data-feather="eye"></i>
                            </button>
                        </div>
                        <span class="form-bar text-danger">@error('current_password'){{$message}}@enderror</span>
                    </div>
                </div>
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password Baru</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="password" class="form-control" autocomplete="off" placeholder="Masukkan Password Baru" name="new_password" id="new_password" value="{{ old('new_password') }}" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password' )">
                            <i data-feather="eye"></i>
                        </button>
                    </div>
                  <span class="form-bar text-danger">@error('new_password'){{$message}}@enderror</span>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Ulangi Password Baru</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Ulangi Password Lama" name="confirm_password" id="confirm_password" value="{{ old('confirm_password') }}" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password' )">
                            <i data-feather="eye"></i>
                        </button>
                    </div>
                  <span class="form-bar text-danger">@error('confirm_password'){{$message}}@enderror</span>
                </div>
              </div>
              {{-- <button type="button" class="btn btn-sm btn-outline-secondary" onclick="togglePassword('current_password', 'new_password', 'confirm_password' )">Show Password</button> --}}
              <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
            </form>
          </div>
        </div>
    </div>
</div>
@endif


@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
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
