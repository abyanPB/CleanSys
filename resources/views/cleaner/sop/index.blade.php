@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">SOP</a></li>
    <li class="breadcrumb-item active" aria-current="page">Daftar SOP Cleaner</li>
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
        <h6 class="card-title">Daftar SOP</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Tujuan</th>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailSopCleaner{{$sop->id_sop}}">Detail</i></button>
                    <!-- Modal -->
                    @include('modals', ['sop' => $sop])
                </td>
                <td>
                    @if ($sop->image_sop == null)
                    <i>Empty</i>
                    @else
                    <img src="{{asset('images/sop/'.$sop->image_sop)}}" alt="Foto SOP" class="p-1 bg-light" style="height: 75px; width:75px; border-radius:5%">
                    @endif
                </td>
                <td>{{$sop->nama_sop}}</td>
                <td>{{ \Illuminate\Support\Str::words($sop->tujuan_sop, 5, '...') }}</td>
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
