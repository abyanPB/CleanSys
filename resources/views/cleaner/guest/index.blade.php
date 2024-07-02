@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pelayanan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Laporan Pelayanan Cleaner</li>
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
                <th>Status</th>
                <th>Aksi</th>
                <th>Waktu Laporan Masuk</th>
                <th>Area Kerja</th>
                <th>Nama Visitor</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($laporanGuestCleaner  as $lGc)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>
                    @if ($lGc->status_laporan == 'belum')
                        <button type="button" class="btn btn-warning" title="Cleaner belum memeriksa laporan"><i data-feather="alert-circle"></i></button>
                    @else
                        <button type="button" class="btn btn-success" title="Cleaner sudah memeriksa laporan"><i data-feather="check"></i></button>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cleanerGuestReport{{$lGc->id_guest}}">Periksa</button>
                    <!-- Modal -->
                    @include('modals')
                </td>
                <td>{{$lGc->tgl_guest}}</td>
                <td>
                    <span class="badge badge-primary">{{ $lGc->area->nama_area }} {{ $lGc->area->desc_area }}  </span>
                <td>{{$lGc->nama_guest}}</td>
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
