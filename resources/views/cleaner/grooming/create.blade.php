@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Grooming</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Laporan Grooming</li>
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
        <h6 class="card-title">Tambah Laporan Grooming Pekerjaan Cleaning Service</h6>
        <form id="take" class="forms-sample" action="{{route('storeLaporanGroomingCleaner')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id_users }}">
            <label>Area Kerja<span class="text-danger">*</span></label>
            <div class="form-group">
                <select class="js-example-basic-single" id="area_id" name="area_id">
                    <option value="">Pilih Area Kerja</option>
                    @foreach ($areas as $area)
                    <option value="{{$area->id_area}}">{{$area->nama_area}} {{$area->desc_area}}</option>
                    @endforeach
                </select>
            </div>
            <label>Sop Kerja<span class="text-danger">*</span></label>
            <div class="form-group">
                <select class="js-example-basic-single" id="sop_id" name="sop_id">
                    <option value="">Pilih Sop Kerja</option>
                    @foreach ($sops as $sop)
                    <option value="{{$sop->id_sop}}">{{$sop->nama_sop}} </option>
                    @endforeach
                </select>
            </div>
            <label>Status Pekerjaan<span class="text-danger">*</span></label>
            <div class="form-group">
                <select class="js-example-basic-single" id="status_lg" name="status_lg">
                    <option value="">Pilih Status Pekerjaan</option>
                    <option value="sebelum">Sebelum</option>
                    <option value="proses">Proses</option>
                    <option value="hasil">Hasil</option>
                </select>
            </div>
            <div class="form-group">
                <label>Foto Pekerjaan<span class="text-danger">*</span></label>
                <input type="file" accept="image/*" capture="camera" id="photoInput" name="image_lg" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled="" placeholder="Masukan Foto">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                  </span>
                </div>
            </div>
            {{-- <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" checked class="form-check-input" id="locationCheckbox" onclick="getLocation()">
                    Get Location
                </label>
            </div> --}}
            <div id="photoPreview" class="form-group">
                <label>Hasil Foto</label>
                <figure>
                <img id="previewImage" src="#" alt="Foto" class="img-fluid">
                </figure>
            </div>

          <button type="submit" id="btnSubmit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{route('showLaporanGroomingCleaner')}}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/js/file-upload.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush

@push('custom-scripts')
    <script>
        $(".js-example-basic-single").select2({
            tags: false
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
