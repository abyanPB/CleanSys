@extends('layouts.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">SOP</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data SOP Pekerjaan</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Tambah Data SOP Pekerjaan Cleaning Service</h6>
        <form class="forms-sample" action="{{route('sop.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="nama_sop">Nama SOP<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_sop" name="nama_sop" placeholder="Nama SOP : PENYAPUAN">
            <span class="form-bar text-danger">@error('nama_sop'){{$message}}@enderror</span>
          </div>
          <div class="form-group">
            <label for="tujuan_sop">Tujuan SOP<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tujuan_sop" name="tujuan_sop" placeholder="Tujuan SOP : Membersihkan permukaan lantai yang luas, kering dan rata, dari kotoran dan debu untuk with broom untuk lantai tidak rata ( basah dan kering )">
            <span class="form-bar text-danger">@error('tujuan_sop'){{$message}}@enderror</span>
          </div>
          <div class="form-group">
            <label for="cara_penggunaan_sop">Cara Melakukan SOP<span class="text-danger">*</span></label></label>
            <textarea class="form-control" id="cara_penggunaan_sop" name="cara_penggunaan_sop" rows="3" placeholder="Mohon diisi dengan langkah-langkah cara melakukan pekerjaan SOP"></textarea>
            <span class="form-bar text-danger">@error('cara_penggunaan_sop'){{$message}}@enderror</span>
          </div>
          <div class="form-group">
            <label for="perawatan_peralatan_sop">Perawatan Peralatan<span class="text-danger">*</span></label></label>
            <textarea class="form-control" id="perawatan_peralatan_sop" name="perawatan_peralatan_sop" rows="3" placeholder="Mohon diisi dengan langkah-langkah cara melakukan perawatan peralatan"></textarea>
            <span class="form-bar text-danger">@error('perawatan_peralatan_sop'){{$message}}@enderror</span>
          </div>
          <div class="form-group">
            <label for="keselamatan_kerja_sop">Keselamatan Kerja<span class="text-danger">*</span></label></label>
            <textarea class="form-control" id="keselamatan_kerja_sop" name="keselamatan_kerja_sop" rows="3" placeholder="Mohon diisi dengan langkah-langkah cara melakukan keselamatan kerja dalam melakukan SOP"></textarea>
            <span class="form-bar text-danger">@error('keselamatan_kerja_sop'){{$message}}@enderror</span>
          </div>
          <div class="form-group">
            <label>File upload<span class="text-danger">*</span></label>
            <input type="file" name="image_sop" id="photoInput" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
            <span class="form-bar text-danger">@error('image_sop'){{$message}}@enderror</span>
          </div>
          <div id="photoPreview" class="form-group">
            <label>Hasil Foto</label>
            <figure>
            <img id="previewImage" src="#" alt="Foto" class="img-fluid">
            </figure>
        </div>
          <button type="submit" id="btnSubmit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{route('sop.index')}}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('custom-scripts')
  <script src="{{ asset('assets/js/file-upload.js') }}"></script>
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
