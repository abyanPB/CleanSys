@extends('layouts.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
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
    <h4 class="mb-3 mb-md-0">Selamat Datang Visitor</h4>
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

@if (Auth::check())
    @php
        header("Location: " . route('dashboard'));
        exit();
    @endphp
@else
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h6 class="card-title">Silahkan Inputkan Laporan Anda</h6>
                <form class="forms-sample" action="{{ route('Guest.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Jenis Laporan<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" id="jenis_laporan" name="jenis_laporan">
                                <option value="">Laporan Yang Akan Dikirimkan</option>
                                <option value="pelayanan">Laporan Pelayanan (Bantuan / Kebersihan)</option>
                                <option value="pengaduan">Laporan Pengaduan (Jika terdapat pelanggaran dengan petugas Cleaning Service) </option>
                            </select>
                            <span class="form-bar text-danger">@error('jenis_laporan'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Pilih Area<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" id="area_id" name="area_id">
                                <option value="">Tempat Yang Ingin Di Laporankan</option>
                                @foreach ($areas as $area)
                                    <option value="{{$area->id_area}}">{{$area->nama_area}} {{$area->desc_area}}</option>
                                @endforeach
                            </select>
                            <span class="form-bar text-danger">@error('area_id'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nama Visitor<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Anda" name="nama_guest" id="nama_guest" value="{{ old('nama_guest') }}">
                            </div>
                            <span class="form-bar text-danger">@error('nama_guest'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Jabatan Visitor</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Masukkan Posisi Anda, Contoh: Dosen/Mahasiswa" name="level_guest" id="level_guest" value="{{ old('level_guest') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Keterangan<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <textarea id="ket_guest" name="ket_guest" class="form-control" maxlength="100" rows="8" placeholder="Masukan Keterangan Laporan, Contoh: Mas Galon Habis" value="{{ old('ket_guest') }}"></textarea>
                            </div>
                            <span class="form-bar text-danger">@error('ket_guest'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Bukti Foto<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="file" accept="image/*" capture="camera" id="photoInput" name="image_guest" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled="" placeholder="Masukan Foto">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                <span class="form-bar text-danger">@error('image_guest'){{$message}}@enderror</span>
                            </div>
                        </div>
                    </div>
                    <div id="photoPreview" class="form-group">
                        <label>Hasil Foto</label>
                        <figure>
                        <img id="previewImage" src="#" alt="Foto" class="img-fluid">
                        </figure>
                    </div>
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                    <span class="form-bar text-danger">@error('g-recaptcha-response'){{$message}}@enderror</span>
                    <br>
                <button type="submit" id="btnSubmit" class="btn btn-primary me-2">Kirim</button>
                </form>
            </div>
            </div>
        </div>
    </div>
@endif

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script>
        $(".js-example-basic-single").select2({
            tags: true
        });
    </script>
    <script>
        // Function to show submit button and photo preview after selecting photo
        function showSubmitButtonAndPreview() {
            var btnSubmit = document.getElementById("btnSubmit");
            var photoPreview = document.getElementById("photoPreview");
            btnSubmit.classList.remove("is-hidden");
            photoPreview.classList.remove("is-hidden");

            // Show preview of selected photo
            var previewImage = document.getElementById("previewImage");
            var photoInput = document.getElementById("photoInput");
            var file = photoInput.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }

        // Event listener to show submit button and photo preview when photo is selected
        var photoInput = document.getElementById("photoInput");
        photoInput.addEventListener("change", showSubmitButtonAndPreview);
    </script>
@endpush
