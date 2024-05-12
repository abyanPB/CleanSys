<div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">Tambah Laporan PJKP Pekerjaan Cleaning Service</h6>
              <form id="take" class="forms-sample" wire:submit="store()" enctype="multipart/form-data">
                  <input type="hidden" name="id_users" value="{{ auth()->user()->id_users }}">
                  <div class="form-group">
                      <label>Area Kerja</label>
                      <select class="js-example-basic-single w-100" wire:model="id_area">
                          <option value="">Pilih Area Kerja</option>
                          @foreach ($areas as $area)
                          <option value="{{$area->id_area}}">{{$area->nama_area}} {{$area->desc_area}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Sop Kerja</label>
                      <select class="js-example-basic-single w-100" wire:model="id_sop">
                          <option value="">Pilih Sop Kerja</option>
                          @foreach ($sops as $sop)
                          <option value="{{$sop->id_sop}}">{{$sop->nama_sop}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Status Pekerjaan</label>
                      <select class="js-example-basic-single w-100" wire:model="status_lp">
                          <option value="">Pilih Status Pekerjaan</option>
                          <option value="sebelum">Sebelum</option>
                          <option value="proses">Proses</option>
                          <option value="hasil">Hasil</option>
                      </select>
                  </div>
                  {{-- <div class="form-group">
                      <label>Foto Pekerjaan</label>
                      <input type="file" accept="image/*" capture="camera" id="photoInput" name="image_lg" class="file-upload-default" wire:model="image_lp">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Masukan Foto">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                  </div> --}}
                  {{-- <div id="photoPreview" class="form-group">
                      <label>Hasil Foto</label>
                      <figure>
                      <img id="previewImage" src="#" alt="Foto" class="img-fluid">
                      </figure>
                  </div> --}}

                <button type="submit" id="btnSubmit" class="btn btn-primary mr-2">Submit</button>
                {{-- <a href="{{route('showLaporanGroomingCleaner')}}" class="btn btn-light">Cancel</a> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
</div>
