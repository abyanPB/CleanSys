@extends('layouts.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">SOP</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Data SOP</li>
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
        <h6 class="card-title">Tambah Data SOP Pekerjaan Cleaning Service</h6>
        <form class="forms-sample" action="{{route('sop.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="nama_sop">Nama SOP</label>
            <input type="text" class="form-control" id="nama_sop" name="nama_sop" placeholder="Nama SOP : Swipping">
            <span class="form-bar text-danger">@error('nama_sop'){{$message}}@enderror</span>
          </div>
          <div class="form-group">
            <label for="ket_sop">Keterangan SOP</label>
            <input type="text" class="form-control" id="ket_sop" name="ket_sop" placeholder="Keterangan SOP : Melakukan pembersihan pada lantai dengan sapu">
            <span class="form-bar text-danger">@error('ket_sop'){{$message}}@enderror</span>
          </div>
          <div class="form-group">
            <label>File upload</label>
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
