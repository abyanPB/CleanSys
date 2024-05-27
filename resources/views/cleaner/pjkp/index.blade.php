@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Pjkp</a></li>
          <li class="breadcrumb-item active" aria-current="page">Laporan Pjkp Cleaner</li>
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
        <a href="{{route('createLaporanPjkpCleaner')}}">
            <button type="submit" class="btn btn-primary float-right">+ Tambah Laporan</button>
        </a>
        <h6 class="card-title">Daftar Laporan Pjkp</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Foto Pekerjaan</th>
                <th>Area Kerja</th>
                <th>Waktu Laporan</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cleanerPjkpReportToday as $cPrt)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cleanerPjkpReportDetail{{$cPrt->id_lp}}"><i data-feather="info"></i></button>

                    @if ($cPrt->tanggapanPjkps()->exists())

                    @else
                        <a href="{{route('editLaporanPjkpCleaner', $cPrt->id_lp)}}" class="btn btn-secondary"><i data-feather="edit"></i></a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cleanerDeletePjkpReport{{$cPrt->id_lp}}"><i data-feather="trash-2"></i></button>
                    @endif

                    <!-- Modal -->
                    @include('modals')

                </td>
                <td>
                    <img src="{{asset('images/laporan_pjkp/'.$cPrt->image_lp)}}" alt="Foto Pjkp" style="height: 75px; width:75px; border-radius:5%">
                </td>
                <td>{{$cPrt->area->nama_area}}</td>
                <td>{{$cPrt->tgl_lp}}</td>
                <td>{{$cPrt->status_lp}}</td>
                {{-- <td>{{$lp->status_lp}}</td> --}}
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
