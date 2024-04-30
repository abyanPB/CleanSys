@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Grooming</a></li>
          <li class="breadcrumb-item active" aria-current="page">Laporan Grooming</li>
        </ol>
      </nav>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
      @php
      // Set locale ke bahasa Indonesia
      \Carbon\Carbon::setLocale('id');
      @endphp
      <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex">
        <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
        <input type="text" class="form-control" value="{{ \Carbon\Carbon::now()->translatedFormat('l, d-m-Y') }}" readonly>
      </div>
    </div>
  </div>

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
                <th>Status Tanggapan</th>
                <th>Nama Petugas</th>
                <th>Waktu Laporan</th>
                <th>Status Pekerjaan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($supervisorGroomingReportToday as $sGrt)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($sGrt->tanggapanGrooming()->exists())
                        <button type="button" class="btn btn-success" title="Supervisor sudah memberikan tanggapan"><i data-feather="check"></i></button>
                    @else
                        <button type="button" class="btn btn-warning" title="Supervisor belum memberikan tanggapan"><i data-feather="alert-circle"></i></button>
                    @endif
                </td>
                <td>{{$sGrt->user->name}}</td>
                <td>{{$sGrt->tgl_lg}}</td>
                <td>{{$sGrt->status_lg}}</td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#supervisorGroomingReportResponse{{$sGrt->id_lg}}"><i data-feather="message-circle"></i></button>

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
@endpush
