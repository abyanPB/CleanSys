@extends('layouts.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">SOP</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Data SOP Pekerjaan</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Edit Data SOP Pekerjaan Cleaning Service</h6>
        <form class="forms-sample" action="{{route('sop.update',$sop->id_sop)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="id_sop" value="{{$sop->id_sop}}"> --}}
            <div class="form-group">
                <label for="nama_sop">Nama SOP<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_sop" name="nama_sop" value="{{ $sop->nama_sop }}" autocomplete="off" placeholder="Nama SOP  : Swipping">
                <span class="form-bar text-danger">@error('nama_sop'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="tujuan_sop">Tujuan SOP<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="tujuan_sop" name="tujuan_sop" value="{{ $sop->tujuan_sop }}" placeholder="Keterangan SOP : Melakukan pembersihan pada lantai dengan sapu">
                <span class="form-bar text-danger">@error('tujuan_sop'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="cara_penggunaan_sop">Cara Melakukan SOP<span class="text-danger">*</span></label></label>
                <textarea class="form-control" id="cara_penggunaan_sop" name="cara_penggunaan_sop" rows="3" placeholder="Mohon diisi dengan langkah-langkah cara melakukan pekerjaan SOP">{{ $sop->cara_penggunaan_sop }}</textarea>
                <span class="form-bar text-danger">@error('cara_penggunaan_sop'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="perawatan_peralatan_sop">Perawatan Peralatan<span class="text-danger">*</span></label></label>
                <textarea class="form-control" id="perawatan_peralatan_sop" name="perawatan_peralatan_sop" rows="3" placeholder="Mohon diisi dengan langkah-langkah cara melakukan perawatan peralatan">{{ $sop->perawatan_peralatan_sop }}</textarea>
                <span class="form-bar text-danger">@error('perawatan_peralatan_sop'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label for="keselamatan_kerja_sop">Keselamatan Kerja<span class="text-danger">*</span></label></label>
                <textarea class="form-control" id="keselamatan_kerja_sop" name="keselamatan_kerja_sop" rows="3" placeholder="Mohon diisi dengan langkah-langkah cara melakukan keselamatan kerja dalam melakukan SOP">{{ $sop->keselamatan_kerja_sop }}</textarea>
                <span class="form-bar text-danger">@error('keselamatan_kerja_sop'){{$message}}@enderror</span>
            </div>
            <div class="form-group">
                <label>File upload<span class="text-danger">*</span></label>
                <input type="file" name="image_sop" id="photoInput" class="file-upload-default">
                <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" value="{{$sop->image_sop}}">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
                </div>
            </div>
            <div id="photoPreview" class="form-group">
                <label>Hasil Foto</label>
                <figure>
                <img id="previewImage" src="#" alt="Foto" class="img-fluid">
                </figure>
            </div>
            <button type="submit" id="btnSubmit" class="btn btn-primary mr-2">Update</button>
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
