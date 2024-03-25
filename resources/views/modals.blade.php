{{-- Start Laporan Grooming --}}
@if(isset($lg))
{{-- Modal Detail --}}
<div class="modal fade" id="detailLaporanGrooming{{$lg->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="detailLaporanGrooming" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="detailLaporanGrooming">Detail Laporan Grooming</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        Nama Petugas : {{$lg->laporanGrooming->user->name}}
        <hr>
        Area Kerja : {{$lg->laporanGrooming->area->nama_area}}
        <hr>
        Sop Kerja : {{$lg->laporanGrooming->sop->nama_sop}}
        <hr>
        Nama Supervisor : {{ $lg->user->level == 'spv' ? $lg->user->name : 'Tidak Ada Penanggung Jawab' }}
        <hr>
        Isi Tanggapan : {{$lg->tanggapan_grooming}}
        <hr>
        Waktu Masuk : {{$lg->laporanGrooming->tgl_lg}}
        <hr>
        Waktu Ditanggapi : {{$lg->tgl_tg}}
        <hr>
        Status : {{$lg->laporanGrooming->status_lg}}
        <hr>
        Foto :
        <img src="{{asset('images/laporan_grooming/'.$lg->laporanGrooming->image_lg)}}" alt="Foto SOP" style="width: 80%; height: auto;">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="hapusLaporanGrooming{{$lg->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="hapusLaporanGrooming" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="hapusLaporanGrooming">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{route('laporan-grooming.destroy',$lg->id_lg)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
        </div>
    </div>
    </div>
</div>
@endif
{{-- End Laporan Grooming --}}


{{-- Start Profile --}}
@if(isset($user))
{{-- Modal Detail --}}
<div class="modal fade" id="detailPengguna{{$user->id_users}}" tabindex="-1" role="dialog" aria-labelledby="detailPengguna" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="detailPengguna">Detail Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        Nama : {{$user->name}}
        <hr>
        Email : {{$user->email}}
        <hr>
        Nomor Telepon : {{$user->no_telepon}}
        <hr>
        Jenis Kelamin : {{$user->jk}}
        <hr>
        Jabatan : {{$user->level}}
        <hr>
        Foto :
        @if ($user->image == null)
            <img src="{{ url('https://ui-avatars.com/api/?name='.$user->name)}}" alt="Foto Pengguna" style="width: 50%; height: auto;">
        @else
            <img src="{{asset('images/pengguna/'.$user->image)}}" alt="Foto Pengguna" style="width: 50%; height: auto;">
        @endif
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
    </div>
</div>
{{-- Modal Hapus --}}
<div class="modal fade" id="hapusPengguna{{$user->id_users}}" tabindex="-1" role="dialog" aria-labelledby="hapusPengguna" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="hapusPengguna">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{route('user.destroy',$user->id_users)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
        </div>
    </div>
    </div>
</div>
@endif
{{-- End Profile --}}


{{-- Start Area Kerja --}}
@if(isset($area))
{{-- Modal Hapus --}}
<div class="modal fade" id="hapusArea{{$area->id_area}}" tabindex="-1" role="dialog" aria-labelledby="hapusAreaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="hapusAreaLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{route('area.destroy',$area->id_area)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
        </div>
    </div>
    </div>
</div>
@endif
{{-- End Area Kerja --}}


{{-- Start SOP --}}
@if(isset($sop))
{{-- Modal Hapus --}}
<div class="modal fade" id="hapusSOP{{$sop->id_sop}}" tabindex="-1" role="dialog" aria-labelledby="hapusSOPLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="hapusSOPLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        Apakah anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{route('sop.destroy',$sop->id_sop)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
        </div>
    </div>
    </div>
</div>
@endif
{{-- End SOP --}}
