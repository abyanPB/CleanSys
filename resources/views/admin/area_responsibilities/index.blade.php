@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Area Kerja</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Area Kerja</li>
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
        <a href="{{route('Penanggung-Jawab-Area.create')}}">
            <button type="submit" class="btn btn-primary float-right">+ Tambah Penanggung Jawab</button>
        </a>
        <h6 class="card-title">Daftar Penanggung Jawab Area Kerja</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Cleaner</th>
                <th>Area Tanggungan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($cleaners  as $cleaner)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{$cleaner->name}}</td>
                <td>
                    @foreach ($cleaner->areaResponsibilities as $area)
                        <span class="badge badge-primary">{{ $area->nama_area }} {{ $area->desc_area }} </span>
                    @endforeach
                </td>
                {{-- <td>
                    <a href="{{route('area.edit', $area->id_area)}}" class="btn btn-info"><i data-feather="edit"></i></a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusArea{{$area->id_area}}"><i data-feather="trash-2"></i></button>

                    <!-- Modal -->
                    @include('modals')

                </td> --}}
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
