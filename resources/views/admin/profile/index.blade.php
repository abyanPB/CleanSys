@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar Pengguna Provice Gruop</li>
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
        <a href="{{route('user.create')}}">
            <button type="submit" class="btn btn-primary float-right">+ Buatkan Akun Karyawan</button>
        </a>
        <h6 class="card-title">Daftar Pengguna</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Posisi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->level}}</td>
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailPengguna{{$user->id_users}}"><i data-feather="info"></i></button>
                    <a href="{{route('user.edit', $user->id_users)}}" class="btn btn-info"><i data-feather="edit"></i></a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resetPengguna{{$user->id_users}}"><i data-feather="refresh-cw"></i></button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusPengguna{{$user->id_users}}"><i data-feather="trash-2"></i></button>

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
