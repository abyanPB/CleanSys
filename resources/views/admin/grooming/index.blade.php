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
                @foreach ($adminGroomingReport as $aGr)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$aGr->laporanGrooming->user->name}}</td>
                <td>{{$aGr->user->level == 'spv' ? $aGr->user->name : 'Tidak Ada Penanggung Jawab' }}</td>
                <td>{{$aGr->laporanGrooming->tgl_lg}}</td>
                <td>{{$aGr->tgl_tg}}</td>
                <td>{{$aGr->laporanGrooming->status_lg}}</td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#adminGroomingReportDetail{{$aGr->id_lg}}"><i data-feather="info"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#adminDeleteGroomingReport{{$aGr->id_lg}}"><i data-feather="trash-2"></i></button>

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
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script>
    setTimeout(function() {
        location.reload();
    }, 60000);
    </script>
@endpush
