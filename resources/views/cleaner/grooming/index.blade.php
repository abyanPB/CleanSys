@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Grooming</a></li>
    <li class="breadcrumb-item active" aria-current="page">Laporan Grooming Cleaner</li>
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
        <a href="{{route('createLaporanGroomingCleaner')}}">
            <button type="submit" class="btn btn-primary float-right">+ Tambah Laporan Grooming</button>
        </a>
        <h6 class="card-title">Daftar Laporan Grooming</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Foto Pekerjaan</th>
                <th>Area Kerja</th>
                <th>Waktu Laporan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($laporanCleaner as $lc)
              <tr>
                <td scope="row">{{ $no++ }}</td>
                <td>
                    <img src="{{asset('images/laporan_grooming/'.$lc->image_lg)}}" alt="Foto Grooming" style="height: 75px; width:75px; border-radius:5%">
                </td>
                <td>{{$lc->area->nama_area}}</td>
                <td>{{$lc->tgl_lg}}</td>
                <td>{{$lc->status_lg}}</td>
                {{-- <td>{{$lg->status_lg}}</td> --}}
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailLaporanGroomingCleaner{{$lc->id_lg}}"><i data-feather="info"></i></button>

                    @if ($lc->tanggapanGrooming()->exists())

                    @else
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusLaporanGroomingCleaner{{$lc->id_lg}}"><i data-feather="trash-2"></i></button>
                    @endif

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
