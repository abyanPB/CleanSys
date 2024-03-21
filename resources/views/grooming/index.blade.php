@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Grooming</a></li>
    <li class="breadcrumb-item active" aria-current="page">Laporan Grooming</li>
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
        <a href="{{route('laporan-grooming.create')}}">
            <button type="submit" class="btn btn-primary float-right">+ Tambah Laporan Grooming</button>
        </a>
        <h6 class="card-title">Daftar Laporan Grooming</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Nama Supervisor</th>
                <th>Waktu Laporan</th>
                <th>Waktu Ditanggapi</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($tanggapan_grooming as $data)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{$data->laporanGrooming->user->name}}</td>
                <td>{{ $data->user->level == 'spv' ? $data->user->name : 'Tidak Ada Penanggung Jawab' }}</td>
                <td>{{$data->laporanGrooming->tgl_lg}}</td>
                <td>{{$data->tgl_tg}}</td>
                <td>{{$data->laporanGrooming->status_lg}}</td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{$data->id_lg}}">Detail</button>
                    <a href="{{route('laporan-grooming.edit', $data->id_lg)}}" class="btn btn-secondary">Edit</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal{{$data->id_lg}}">Hapus</button>

                    {{-- Modal Detail --}}
                    <div class="modal fade" id="detailModal{{$data->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Detail Laporan Grooming</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            Nama Petugas : {{$data->laporanGrooming->user->name}}
                            <hr>
                            Area Kerja : {{$data->laporanGrooming->area->nama_area}}
                            <hr>
                            Sop Kerja : {{$data->laporanGrooming->sop->nama_sop}}
                            <hr>
                            Nama Supervisor : {{ $data->user->level == 'spv' ? $data->user->name : 'Tidak Ada Penanggung Jawab' }}
                            <hr>
                            Isi Tanggapan : {{$data->tanggapan_grooming}}
                            <hr>
                            Waktu Masuk : {{$data->laporanGrooming->tgl_lg}}
                            <hr>
                            Waktu Ditanggapi : {{$data->tgl_tg}}
                            <hr>
                            Status : {{$data->laporanGrooming->status_lg}}
                            <hr>
                            Foto :
                            <img src="{{asset('images/laporan_grooming/'.$data->laporanGrooming->image_lg)}}" alt="Foto SOP" style="width: 100%; height: auto;">
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="hapusModal{{$data->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            Apakah anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <form action="{{route('laporan-grooming.destroy',$data->id_lg)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
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
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
