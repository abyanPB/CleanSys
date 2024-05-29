@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Penanggung Jawab Area</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Penanggung Jawab Area Kerja</li>
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
        <div style="padding-bottom: 10px">
            <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#deleteAreaResponsibilities"><i data-feather="refresh-cw"></i> RESET ALL DATA</button>
            <button type="button" class="btn btn-primary btn-sm float-right" style="margin-right:10px" data-toggle="modal" data-target="#adminPrintAreaResponsibilities"><i data-feather="printer"></i> CETAK PDF</button>
        </div>
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
                @foreach ($cleanersArea as $cleaner)
              <tr>
                <td scope="row">{{ $no++ }}</td>
                <td>{{$cleaner->name}}</td>
                <td>
                    @if ($cleaner->areaResponsibilities->isEmpty())
                        Belum Memasukan Penanggung Jawab Area
                    @else
                        @foreach ($cleaner->areaResponsibilities as $ar)
                            <span class="badge badge-primary">{{ $ar->area->nama_area }} {{ $ar->area->desc_area }}  </span>
                        @endforeach
                    @endif
                </td>
                <td>
                    <a href="{{route('Penanggung-Jawab-Area.edit', $cleaner->id_users)}}" class="btn btn-info"><i data-feather="edit"></i></a>
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
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script>
    $(".js-example-basic-multiple").select2({
        tags: true,
    });
  </script>
@endpush
