@extends('layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">PJKP</a></li>
          <li class="breadcrumb-item active" aria-current="page">Laporan PJKP</li>
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
            <div style="padding-bottom: 1%">
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#adminPrintPjkpReport"><i data-feather="printer"></i> Cetak Pdf</button>
            </div>
          <h6 class="card-title">Daftar Laporan PJKP</h6>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Petugas</th>
                  <th>Nama Supervisor</th>
                  <th>Waktu Laporan Masuk</th>
                  <th>Waktu Laporan di Tanggapi</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($adminPjkpReport as $aPr)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{$aPr->laporanPjkp->user->name}}</td>
                  <td>{{ $aPr->user->level == 'spv' ? $aPr->user->name : 'Tidak Ada Penanggung Jawab' }}</td>
                  <td>{{$aPr->laporanPjkp->tgl_lp}}</td>
                  <td>{{$aPr->tgl_tp}}</td>
                  <td>{{$aPr->laporanPjkp->status_lp}}</td>
                  <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#adminPjkpReportDetail{{$aPr->lp_id}}">Info</button>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#adminDeletePjkpReport{{$aPr->lp_id}}">Hapus</button>

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
  <script>
    setTimeout(function() {
        location.reload();
    }, 300000);
    </script>
    <script>
        $(document).ready(function () {
            // Reset isian nama pekerja dan rentang tanggal saat tombol "Batal" diklik
            $('#cancelButtonPjkp').on('click', function () {
                $('#start_date').val('');
                $('#end_date').val('');
            });
            // Reset isian nama pekerja dan rentang tanggal saat halaman direfresh
            $(window).on('beforeunload', function () {
                $('.js-example-basic-multiple').val(null).trigger('change');
                $('#start_date').val('');
                $('#end_date').val('');
            });
        });
    </script>
@endpush
