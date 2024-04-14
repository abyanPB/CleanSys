{{-- START ADMIN --}}
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

    {{-- Start Laporan Pjkp --}}
    @if(isset($lp))
    {{-- Modal Detail --}}
    {{-- <div class="modal fade" id="detailLaporanGrooming{{$lg->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="detailLaporanGrooming" aria-hidden="true">
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
    </div> --}}
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
{{-- END ADMIN --}}


{{-- START SUPERVISOR --}}
    {{-- Start Laporan Grooming --}}
        @if(isset($laporan))
        {{-- Modal Tanggapan --}}
            <div class="modal fade" id="tanggapanLaporanGroomingSpv{{$laporan->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="tanggapanLaporanGroomingSpv" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="tanggapanLaporanGroomingSpv">Detail Laporan Grooming</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{route('inputTanggapanGrooming',$laporan->id_lg)}}" method="POST">
                    @csrf
                        <input type="hidden" name="id_lg" value="{{$laporan->id_lg}}">

                        @php
                            $tanggapanData = json_decode($laporan->tanggapanGrooming, true);
                        @endphp

                        @if (!empty($tanggapanData))
                            @php
                                $firstTanggapan = $tanggapanData[0]; // Mengambil elemen pertama dari array
                                $tanggapan_grooming = $firstTanggapan['tanggapan_grooming'];
                            @endphp

                            <div class="mb-3">
                                <label for="tanggapan_grooming" class="form-label">Isi Tanggapan:</label>
                                <textarea class="form-control" id="tanggapan_grooming" name="tanggapan_grooming" readonly>{{ $tanggapan_grooming }}</textarea>
                            </div>
                        @else
                            <div class="mb-3">
                                <label for="tanggapan_grooming" class="form-label">Masukan Tanggapan:</label>
                                <textarea class="form-control" id="tanggapan_grooming" name="tanggapan_grooming"></textarea>
                            </div>
                        @endif
                        <hr>
                        Nama Petugas : {{$laporan->user->name}}
                        <hr>
                        Area Kerja : {{$laporan->area->nama_area}}
                        <hr>
                        Sop Kerja : {{$laporan->sop->nama_sop}}
                        <hr>
                        Waktu Masuk : {{$laporan->tgl_lg}}
                        <hr>
                        Status : {{$laporan->status_lg}}
                        <hr>
                        Foto :
                        <img src="{{asset('images/laporan_grooming/'.$laporan->image_lg)}}" alt="Foto SOP" style="width: 80%; height: auto;">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Kirim</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>

        {{-- Modal Hapus --}}
            <div class="modal fade" id="hapusLaporanGroomingSpv{{$laporan->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="hapusLaporanGroomingSpv" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="hapusLaporanGroomingSpv">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    Apakah anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{route('laporan-grooming.destroy',$laporan->id_lg)}}" method="POST">
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
{{-- END SUPERVISOR --}}


{{-- START CLEANER --}}
    {{-- Start Laporan Grooming --}}
        @if(isset($lc))
        {{-- Modal Laporan --}}
        <div class="modal fade" id="detailLaporanGroomingCleaner{{$lc->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="detailLaporanGroomingCleaner" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="detailLaporanGroomingCleaner">Detail Laporan Grooming Cleaner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                            @php
                                $tanggapanData = json_decode($lc->tanggapanGrooming, true);
                                // Periksa apakah array $tanggapanData memiliki elemen
                                if (!empty($tanggapanData)) {
                                    $firstTanggapan = $tanggapanData[0]; // Mengambil elemen pertama dari array
                                    $tanggapan_grooming = $firstTanggapan['tanggapan_grooming'];
                                    $waktu_tanggapan = $firstTanggapan['tgl_tg'];
                                }
                            @endphp

                    Nama Petugas : {{$lc->user->name}}
                    <hr>
                    Area Kerja : {{$lc->area->nama_area}}
                    <hr>
                    Sop Kerja : {{$lc->sop->nama_sop}}
                    <hr>
                    Waktu Masuk : {{$lc->tgl_lg}}
                    <hr>
                    Waktu Tanggapan : @if (isset($waktu_tanggapan)){{ $waktu_tanggapan }} @else Belum ditanggapi @endif
                    <hr>
                    Status : {{$lc->status_lg}}
                    <hr>
                    Isi Tanggapan : @if (isset($tanggapan_grooming)){{ $tanggapan_grooming }} @else Belum ditanggapi @endif
                    <hr>
                    Foto :
                    <img src="{{asset('images/laporan_grooming/'.$lc->image_lg)}}" alt="Foto SOP" style="width: 80%; height: auto;">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Kirim</button>
                </form>
                </div>
            </div>
            </div>
        </div>

        {{-- Modal Hapus Laporan --}}
            <div class="modal fade" id="hapusLaporanGroomingCleaner{{$lc->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="hapusLaporanGroomingCleaner" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="hapusLaporanGroomingCleaner">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    Apakah anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{route('destroyLaporanGroomingCleaner',$lc->id_lg)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
        @endif
{{-- END CLEANER --}}
