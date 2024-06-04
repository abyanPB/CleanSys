@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">SOP</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar SOP</li>
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
        <a href="{{route('sop.create')}}">
            <button type="submit" class="btn btn-primary float-right">+ Tambah SOP</button>
        </a>
        <h6 class="card-title">Daftar SOP</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($sops as $sop)
              <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>
                    @if ($sop->image_sop == null)
                        <i>Empty</i>
                    @else
                        <img src="{{asset('images/sop/'.$sop->image_sop)}}" alt="Foto SOP" style="height: 75px; width:75px; border-radius:5%">
                    @endif
                </td>
                <td>{{$sop->nama_sop}}</td>
                <td>{{$sop->ket_sop}}</td>
                <td>
                    <a href="{{route('sop.edit', $sop->id_sop)}}" class="btn btn-info"><i data-feather="edit"></i></a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusSOP{{$sop->id_sop}}"><i data-feather="trash-2"></i></button>

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
