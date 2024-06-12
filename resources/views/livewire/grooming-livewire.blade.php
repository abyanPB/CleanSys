<!-- resources/views/livewire/grooming-livewire.blade.php -->

<div>
    <h6 class="card-title">Daftar Laporan Grooming</h6>
    <div class="table-responsive">
        <table id="dataTableExample" class="table">
            <!-- Table header and body -->
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Waktu Laporan Masuk</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporanHariIni as $laporan)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $laporan->user->name }}</td>
                    <td>{{ $laporan->tgl_lg }}</td>
                    <td>{{ $laporan->status_lg }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tanggapanLaporanGroomingSpv{{ $laporan->id_lg }}"><i data-feather="message-circle"></i></button>
                        <!-- Modal -->
                        @include('modals')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
