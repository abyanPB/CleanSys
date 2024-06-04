@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Penanggung Jawab Ruang</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Penanggung Area Kerja</li>
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

@if (Auth::check())
    @php
        header("Location: " . route('dashboard'));
        exit();
    @endphp
@else
    <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h6 class="card-title">Daftar Penanggung Jawab Area Kerja</h6>
            <div class="table-responsive">
            <table id="dataTableExample" class="table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Cleaner</th>
                    <th>Area Tanggungan</th>
                    <th>No Telepon</th>
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
                        @if ($cleaner->areaResponsibilities->isEmpty())
                            -
                        @else
                            @foreach ($cleaner->areaResponsibilities as $ar)
                                <span class="badge badge-primary">{{ $ar->area->nama_area }} {{ $ar->area->desc_area }}  </span>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if ($cleaner->no_telepon == null)
                            -
                        @else
                            {{$cleaner->no_telepon}}
                        @endif
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
@endif

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
