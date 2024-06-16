@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Akun Cleaner</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Akun Cleaner</li>
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
        <h6 class="card-title">Daftar Akun Cleaner</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Nama</th>
                <th>No Telepon</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cleanerSpv as $cSpv)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailPenggunaCleanerSpv{{$cSpv->id_users}}">Info</button>
                    <!-- Modal -->
                    @include('modals')
                </td>
                <td>{{$cSpv->name}}</td>
                <td>{{$cSpv->no_telepon ?? '-'}}</td>
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
