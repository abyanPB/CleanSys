@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pjkp</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Laporan Pjkp</li>
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
        <h6 class="card-title">Edit Laporan Pjkp Pekerjaan Cleaning Service</h6>
        <form id="take" class="forms-sample" action="{{route('updateLaporanPjkpCleaner',$lp->id_lp)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Area Kerja</label>
                <select class="js-example-basic-single w-100" id="area_id" name="area_id">
                    <option value="">Pilih Area Kerja</option>
                    @foreach ($areas as $area)
                    <option value="{{ $area->id_area }}" {{ $area->id_area == $lp->area_id ? 'selected' : '' }}>
                        {{ $area->nama_area }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Sop Kerja</label>
                <select class="js-example-basic-single w-100" id="sop_id" name="sop_id">
                    <option value="">Pilih Sop Kerja</option>
                    @foreach ($sops as $sop)
                    <option value="{{ $sop->id_sop }}" {{ $sop->id_sop == $lp->sop_id ? 'selected' : '' }}>
                        {{ $sop->nama_sop }}</option>
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Status Pekerjaan</label>
                <select class="js-example-basic-single w-100" id="status_lp" name="status_lp">
                    <option value="">Pilih Status Pekerjaan</option>
                    <option value="sebelum" {{ $lp->status_lp == 'sebelum'?'selected' : '' }}>Sebelum</option>
                    <option value="proses" {{ $lp->status_lp == 'proses'?'selected' : '' }}>Proses</option>
                    <option value="hasil" {{ $lp->status_lp == 'hasil'?'selected' : '' }}>Hasil</option>
                </select>
            </div>
            <div class="form-group">
                <label>Foto Pekerjaan</label>
                <input type="file" accept="image/*" capture="camera" id="photoInput" name="image_lp" class="file-upload-default">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled="" value="{{$lp->image_lp}}" placeholder="Masukan Foto">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                  </span>
                </div>
            </div>
            <div id="photoPreview" class="form-group">
                <label>Hasil Foto</label>
                <figure>
                    <img src="{{asset('images/laporan_pjkp/'.$lp->image_lp)}}" alt="Foto SOP" style="width: 30%; height: auto;">
                </figure>
            </div>

          <button type="submit" id="btnSubmit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{route('showLaporanPjkpCleaner')}}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>

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
@endpush
