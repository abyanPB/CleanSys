<div>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">PJKP</a></li>
          <li class="breadcrumb-item active" aria-current="page">Laporan PJKP</li>
        </ol>
      </nav>

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

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <a href="{{route('createLaporanPJKP')}}" class="btn btn-primary float-right">
                    Tambah Laporan Grooming
                </a>
              <h6 class="card-title">Daftar Laporan PJKP</h6>
              <div class="table-responsive">
                <table id="dataTableExample" class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Petugas</th>
                      <th>Nama Supervisor</th>
                      <th>Waktu Laporan Masuk</th>
                      <th>Waktu Laporan di Tanggapi</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php
                          $no=1;
                      @endphp
                      @foreach ($laporan_pjkp as $lp)
                    <tr>
                      <th scope="row">{{ $no++ }}</th>
                      <td>
                        @if($lp->user)
                            {{$lp->user->name}}
                        @else
                            Pengguna tidak ditemukan
                        @endif
                    </td>
                      {{-- <td>{{ $lp->user->level == 'spv' ? $lp->user->name : 'Tidak Ada Penanggung Jawab' }}</td> --}}
                      {{-- <td>{{$lp->laporanPjkp->tgl_lp}}</td> --}}
                      {{-- <td>{{$lp->tgl_tp}}</td> --}}
                      {{-- <td>{{$lp->laporanPjkp->status_lp}}</td> --}}
                      <td>
                          {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailLaporanGrooming{{$lp->id_lp}}">Info</button>
                          <a href="{{route('laporan-grooming.edit', $lp->id_lp)}}" class="btn btn-secondary">Edit</a>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusLaporanGrooming{{$lp->id_lp}}">Hapus</button> --}}

                          <!-- Modal -->
                          @include('modals')

                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
