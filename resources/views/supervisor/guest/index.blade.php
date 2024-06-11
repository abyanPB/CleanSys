@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pelayanan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Laporan Pelayanan Supervisor</li>
  </ol>
</nav>

@if (session('success'))
<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif
@if (session('danger'))
<div class="alert alert-danger" role="alert">
    {{session('danger')}}
</div>
@endif

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Daftar Laporan Pelayanan</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Waktu Laporan</th>
                <th>Area Kerja</th>
                <th>Nama Visitor</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($laporanGuestSpv  as $lGs)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#supervisorGuestReport{{$lGs->id_guest}}">Info</button>
                    <!-- Modal -->
                    @include('modals')
                </td>
                <td>{{$lGs->tgl_guest}}</td>
                <td>
                    <span class="badge badge-primary">{{ $lGs->area->nama_area }} {{ $lGs->area->desc_area }}  </span>
                <td>{{$lGs->nama_guest}}</td>
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
