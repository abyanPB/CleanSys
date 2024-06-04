{{-- START ADMIN --}}
    {{-- Start Laporan Grooming --}}
        @if(isset($aGr))
            {{-- Start Cetak Pdf --}}
                <div class="modal fade" id="adminPrintGroomingReport" tabindex="-1" role="dialog" aria-labelledby="adminPrintGroomingReport" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="adminPrintGroomingReport">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{ route('cetakpdfGrooming') }}" method="POST" >
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Pilih Nama Pekerja :</label>
                                        <br>
                                        <select class="js-example-basic-multiple" style="width: 100%" name="selected_users[]" multiple>
                                            @foreach ($Users as $user)
                                                <option value="{{$user->id_users}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <span class="text-danger">*kosongkan kolom ini jika ingin cetak semua</span>
                                    </div>
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                        <label for="startdate">Dari Tanggal :</label>
                                        <input type="date" name="start_date" class="form-control mb-2" id="start_date">
                                        </div>
                                        <div class="col-auto">
                                        <label for="enddate">Hingga Tanggal :</label>
                                        <input type="date" name="end_date" class="form-control mb-2" id="end_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="cancelButtonGrooming" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger" id="print_button">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- End Cetak Pdf --}}
            @foreach ($adminGroomingReport as $aGr)
            {{-- Modal Detail --}}
                <div class="modal fade" id="adminGroomingReportDetail{{$aGr->lg_id}}" tabindex="-1" role="dialog" aria-labelledby="adminGroomingReportDetail{{$aGr->lg_id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="adminGroomingReportDetail{{$aGr->lg_id}}">Detail Laporan Grooming</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        Nama Petugas : {{$aGr->laporanGrooming->user->name}}
                        <hr>
                        Area Kerja : {{$aGr->laporanGrooming->area->nama_area}} {{$aGr->laporanGrooming->area->desc_area}}
                        <hr>
                        Sop Kerja : {{$aGr->laporanGrooming->sop->nama_sop}}
                        <hr>
                        Nama Supervisor : {{ $aGr->user->level == 'spv' ? $aGr->user->name : 'Tidak Ada Penanggung Jawab' }}
                        <hr>
                        Isi Tanggapan : {{$aGr->tanggapan_grooming}}
                        <hr>
                        Waktu Masuk : {{$aGr->laporanGrooming->tgl_lg}}
                        <hr>
                        Waktu Ditanggapi : {{$aGr->tgl_tg}}
                        <hr>
                        Status : {{$aGr->laporanGrooming->status_lg}}
                        <hr>
                        Foto :
                        <img src="{{asset('images/laporan_grooming/'.$aGr->laporanGrooming->image_lg)}}" alt="Foto SOP" style="width: 80%; height: auto; border-radius:5%">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                    </div>
                </div>
            {{-- End Modal Detail --}}

            {{-- Modal Hapus --}}
                <div class="modal fade" id="adminDeleteGroomingReport{{$aGr->lg_id}}" tabindex="-1" role="dialog" aria-labelledby="adminDeleteGroomingReport{{$aGr->lg_id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="adminDeleteGroomingReport{{$aGr->lg_id}}">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        Apakah anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="{{route('laporan-grooming.destroy',$aGr->lg_id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            {{-- End Modal Hapus --}}
            @endforeach
        @endif
    {{-- End Laporan Grooming --}}

    {{-- Start Laporan Pjkp --}}
        @if(isset($aPr))
            {{-- Start Cetak Pdf --}}
                <div class="modal fade" id="adminPrintPjkpReport" tabindex="-1" role="dialog" aria-labelledby="adminPrintPjkpReport" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="adminPrintPjkpReport">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{ route('cetakpdfPjkp') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Pilih Nama Pekerja :</label>
                                        <br>
                                        <select class="js-example-basic-multiple" style="width: 100%" name="selected_users[]" multiple>
                                            @foreach ($Users as $user)
                                                <option value="{{$user->id_users}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <span class="text-danger">*kosongkan kolom ini jika ingin cetak semua</span>
                                    </div>
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                        <label for="startdate">Dari Tanggal :</label>
                                        <input type="date" name="start_date" class="form-control mb-2" id="start_date">
                                        </div>
                                        <div class="col-auto">
                                        <label for="enddate">Hingga Tanggal :</label>
                                        <input type="date" name="end_date" class="form-control mb-2" id="end_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="cancelButtonPjkp" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger" id="print_button">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- End Cetak Pdf --}}

            @foreach ($adminPjkpReport as $aPr)
            {{-- Modal Detail --}}
                <div class="modal fade" id="adminPjkpReportDetail{{$aPr->lp_id}}" tabindex="-1" role="dialog" aria-labelledby="adminPjkpReportDetail{{$aPr->lp_id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="adminPjkpReportDetail{{$aPr->lp_id}}">Detail Laporan Pjkp</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Nama Petugas : {{$aPr->laporanPjkp->user->name}}
                                <hr>
                                Area Kerja : {{$aPr->laporanPjkp->area->nama_area}} {{$aPr->laporanPjkp->area->desc_area}}
                                <hr>
                                Sop Kerja : {{$aPr->laporanPjkp->sop->nama_sop}}
                                <hr>
                                Nama Supervisor : {{ $aPr->user->level == 'spv' ? $aPr->user->name : 'Tidak Ada Penanggung Jawab' }}
                                <hr>
                                Isi Tanggapan : {{$aPr->tanggapan_pjkp}}
                                <hr>
                                Waktu Masuk : {{$aPr->laporanPjkp->tgl_lp}}
                                <hr>
                                Waktu Ditanggapi : {{$aPr->tgl_tp}}
                                <hr>
                                Status : {{$aPr->laporanPjkp->status_lp}}
                                <hr>
                                Foto :
                                <img src="{{asset('images/laporan_pjkp/'.$aPr->laporanPjkp->image_lp)}}" alt="Foto SOP" style="width: 80%; height: auto; border-radius:1px">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- End Modal Detail --}}

            {{-- Modal Hapus --}}
                <div class="modal fade" id="adminDeletePjkpReport{{$aPr->lp_id}}" tabindex="-1" role="dialog" aria-labelledby="adminDeletePjkpReport{{$aPr->lp_id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="adminDeletePjkpReport{{$aPr->lp_id}}">Konfirmasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{route('laporan-pjkp.destroy',$aPr->lp_id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- End Modal Hapus --}}
            @endforeach
        @endif
    {{-- End Laporan Pjkp --}}

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
                            @if ($user->level == 'cleaner' && $user->supervisor)
                                <p>Supervisor: {{ $user->supervisor->name }}</p>
                            @else
                                <p>Supervisor: Tidak ada</p>
                            @endif
                            <hr>
                            Foto :
                            @if ($user->image_profile == null)
                                <img src="{{ url('https://ui-avatars.com/api/?name='.$user->name)}}" alt="Foto Pengguna" style="width: 50%; height: auto; border-radius:5%">
                            @else
                                <img src="{{asset('images/pengguna/'.$user->image_profile)}}" alt="Foto Pengguna" style="width: 50%; height: auto; border-radius:5%">
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                        </div>
                    </div>
                </div>
            {{-- End Modal Detail --}}

            {{-- Modal Reset --}}
                <div class="modal fade" id="resetPengguna{{$user->id_users}}" tabindex="-1" role="dialog" aria-labelledby="resetPengguna" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="resetPengguna">Konfirmasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin mereset password akun ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{route('user.reset',$user->id_users)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- End Modal Reset --}}

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
                                Apakah anda yakin ingin menghapus akun ini?
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
            {{-- End Modal Hapus --}}
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
            {{-- Modal Hapus --}}
        @endif
    {{-- End Area Kerja --}}

    {{-- Start Area Responsibilities --}}
        @if(isset($cleanersArea))
            {{-- Start Cetak Pdf --}}
                <div class="modal fade" id="adminPrintAreaResponsibilities" tabindex="-1" role="dialog" aria-labelledby="adminPrintAreaResponsibilities" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="adminPrintAreaResponsibilities">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{ route('cetakpdfAreaResponsibilities') }}" method="POST" >
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Pilih Nama Pekerja :</label>
                                        <br>
                                        <select class="js-example-basic-multiple" style="width: 100%" name="selected_users[]" multiple>
                                            @foreach ($cleanersArea as $user)
                                                <option value="{{$user->id_users}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <span class="text-danger">*kosongkan kolom ini jika ingin cetak semua</span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="cancelButtonGrooming" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger" id="print_button">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- End Cetak Pdf --}}
            {{-- Modal Hapus --}}
                <div class="modal fade" id="deleteAreaResponsibilities" tabindex="-1" role="dialog" aria-labelledby="deleteAreaResponsibilities" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteAreaResponsibilities">Konfirmasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin mereset semua data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{route('Penanggung-Jawab-Area.reset')}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- Modal Hapus --}}
        @endif
    {{-- End Area Responsibilities --}}

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
            {{-- End Modal Hapus --}}
        @endif
    {{-- End SOP --}}
{{-- END ADMIN --}}

{{-- START SUPERVISOR --}}
    {{-- Start Laporan Grooming --}}
        @if(isset($sGrt))
            {{-- Modal Tanggapan --}}
                <div class="modal fade" id="supervisorGroomingReportResponse{{$sGrt->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="supervisorGroomingReportResponse" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="supervisorGroomingReportResponse">Detail Laporan Grooming</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('inputTanggapanGrooming',$sGrt->id_lg)}}" method="POST">
                                    @csrf
                                        <input type="hidden" name="id_lg" value="{{$sGrt->id_lg}}">

                                        @php
                                            $tanggapanData = json_decode($sGrt->tanggapanGroomings, true);
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
                                        Nama Petugas : {{$sGrt->user->name}}
                                        <hr>
                                        Area Kerja : {{$sGrt->area->nama_area}} {{$sGrt->area->desc_area}}
                                        <hr>
                                        Sop Kerja : {{$sGrt->sop->nama_sop}}
                                        <hr>
                                        Waktu Masuk : {{$sGrt->tgl_lg}}
                                        <hr>
                                        Status : {{$sGrt->status_lg}}
                                        <hr>
                                        Foto :
                                        <img src="{{asset('images/laporan_grooming/'.$sGrt->image_lg)}}" alt="Foto SOP" style="width: 60%; height: 45%; border-radius:5%">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-danger">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- End Modal Tanggapan --}}
         @endif
    {{-- End Laporan Grooming --}}

    {{-- Start Laporan Pjkp --}}
        @if(isset($sPrt))
            {{-- Modal Tanggapan --}}
                <div class="modal fade" id="supervisorPjkpReportResponse{{$sPrt->id_lp}}" tabindex="-1" role="dialog" aria-labelledby="supervisorPjkpReportResponse" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="supervisorPjkpReportResponse">Detail Laporan Pjkp</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('inputTanggapanPjkp',$sPrt->id_lp)}}" method="POST">
                                @csrf
                                    <input type="hidden" name="id_lp" value="{{$sPrt->id_lp}}">

                                    @php
                                        $tanggapanData = json_decode($sPrt->tanggapanPjkps, true);
                                    @endphp

                                    @if (!empty($tanggapanData))
                                        @php
                                            $firstTanggapan = $tanggapanData[0]; // Mengambil elemen pertama dari array
                                            $tanggapan_pjkp = $firstTanggapan['tanggapan_pjkp'];
                                        @endphp

                                        <div class="mb-3">
                                            <label for="tanggapan_pjkp" class="form-label">Isi Tanggapan:</label>
                                            <textarea class="form-control" id="tanggapan_pjkp" name="tanggapan_pjkp" readonly>{{ $tanggapan_pjkp }}</textarea>
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <label for="tanggapan_pjkp" class="form-label">Masukan Tanggapan:</label>
                                            <textarea class="form-control" id="tanggapan_pjkp" name="tanggapan_pjkp"></textarea>
                                        </div>
                                    @endif
                                    <hr>
                                    Nama Petugas : {{$sPrt->user->name}}
                                    <hr>
                                    Area Kerja : {{$sPrt->area->nama_area}} {{$sPrt->area->desc_area}}
                                    <hr>
                                    Sop Kerja : {{$sPrt->sop->nama_sop}}
                                    <hr>
                                    Waktu Masuk : {{$sPrt->tgl_lp}}
                                    <hr>
                                    Status : {{$sPrt->status_lp}}
                                    <hr>
                                    Foto :
                                    <img src="{{asset('images/laporan_pjkp/'.$sPrt->image_lp)}}" alt="Foto SOP" style="width: 60%; height: 45%; border-radius:5%">
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-danger">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- End Modal Tanggapan --}}
        @endif
    {{-- End Laporan Pjkp --}}

    {{-- Start Laporan Pelayanan --}}
        @if(isset($lGs))
            {{-- Modal Detail --}}
                <div class="modal fade" id="supervisorGuestReport{{$lGs->id_guest}}" tabindex="-1" role="dialog" aria-labelledby="supervisorGuestReport" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="supervisorGuestReport">Detail Laporan Pelayanan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    Area Kerja : {{$lGs->area->nama_area}} {{$lGs->area->desc_area}}
                                    <hr>
                                    Nama Visitor : {{$lGs->nama_guest}}
                                    <hr>
                                    Posisi Visitor : {{$lGs->level_guest}}
                                    <hr>
                                    Keterangan : {{$lGs->ket_guest}}
                                    <hr>
                                    Waktu Pengaduan : {{$lGs->tgl_guest}}
                                    <hr>
                                    Foto :
                                    <img src="{{asset('images/laporan_guest/'.$lGs->image_guest)}}" alt="Foto SOP" style="width: 60%; height: 45%; border-radius:5%">
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- End Modal Detail --}}
        @endif
    {{-- End Laporan Pelayanan --}}
{{-- END SUPERVISOR --}}

{{-- START CLEANER --}}
    {{-- Start Laporan Grooming --}}
        @if(isset($cGrt))
            {{-- Modal Laporan --}}
                <div class="modal fade" id="cleanerGroomingReportDetail{{$cGrt->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="cleanerGroomingReportDetail" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="cleanerGroomingReportDetail">Detail Laporan Grooming Cleaner</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                                    @php
                                        $tanggapanData = json_decode($cGrt->tanggapanGroomings, true);
                                        // Periksa apakah array $tanggapanData memiliki elemen
                                        if (!empty($tanggapanData)) {
                                            $firstTanggapan = $tanggapanData[0]; // Mengambil elemen pertama dari array
                                            $tanggapan_grooming = $firstTanggapan['tanggapan_grooming'];
                                            $waktu_tanggapan = $firstTanggapan['tgl_tg'];
                                        }
                                    @endphp

                            Nama Petugas : {{$cGrt->user->name}}
                            <hr>
                            Area Kerja : {{$cGrt->area->nama_area}} {{$cGrt->area->desc_area}}
                            <hr>
                            Sop Kerja : {{$cGrt->sop->nama_sop}}
                            <hr>
                            Waktu Masuk : {{$cGrt->tgl_lg}}
                            <hr>
                            Waktu Tanggapan : @if (isset($waktu_tanggapan)){{ $waktu_tanggapan }} @else Belum ditanggapi @endif
                            <hr>
                            Status : {{$cGrt->status_lg}}
                            <hr>
                            Isi Tanggapan : @if (isset($tanggapan_grooming)){{ $tanggapan_grooming }} @else Belum ditanggapi @endif
                            <hr>
                            Foto :
                            <img src="{{asset('images/laporan_grooming/'.$cGrt->image_lg)}}" alt="Foto SOP" style="width: 60%; height: 45%; border-radius:5%">
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                    </div>
                </div>
            {{-- End Modal Laporan --}}

            {{-- Modal Hapus Laporan --}}
                <div class="modal fade" id="cleanerDeleteGroomingReport{{$cGrt->id_lg}}" tabindex="-1" role="dialog" aria-labelledby="cleanerDeleteGroomingReport" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="cleanerDeleteGroomingReport">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        Apakah anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="{{route('destroyLaporanGroomingCleaner',$cGrt->id_lg)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            {{-- End Modal Hapus Laporan --}}
        @endif
    {{-- End Laporan Grooming --}}

    {{-- Start Laporan Pjkp --}}
        @if(isset($cPrt))
            {{-- Modal Laporan --}}
                <div class="modal fade" id="cleanerPjkpReportDetail{{$cPrt->id_lp}}" tabindex="-1" role="dialog" aria-labelledby="cleanerPjkpReportDetail" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="cleanerPjkpReportDetail">Detail Laporan Pjkp Cleaner</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                                @php
                                    $tanggapanData = json_decode($cPrt->tanggapanPjkps, true);
                                    // Periksa apakah array $tanggapanData memiliki elemen
                                    if (!empty($tanggapanData)) {
                                        $firstTanggapan = $tanggapanData[0]; // Mengambil elemen pertama dari array
                                        $tanggapan_pjkp = $firstTanggapan['tanggapan_pjkp'];
                                        $waktu_tanggapan = $firstTanggapan['tgl_tp'];
                                    }
                                @endphp

                            Nama Petugas : {{$cPrt->user->name}}
                            <hr>
                            Area Kerja : {{$cPrt->area->nama_area}} {{$cPrt->area->desc_area}}
                            <hr>
                            Sop Kerja : {{$cPrt->sop->nama_sop}}
                            <hr>
                            Waktu Masuk : {{$cPrt->tgl_lp}}
                            <hr>
                            Waktu Tanggapan : @if (isset($waktu_tanggapan)){{ $waktu_tanggapan }} @else Belum ditanggapi @endif
                            <hr>
                            Status : {{$cPrt->status_lp}}
                            <hr>
                            Isi Tanggapan : @if (isset($tanggapan_pjkp)){{ $tanggapan_pjkp }} @else Belum ditanggapi @endif
                            <hr>
                            Foto :
                            <img src="{{asset('images/laporan_pjkp/'.$cPrt->image_lp)}}" alt="Foto SOP" style="width: 60%; height: 45%; border-radius:5%">
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Kirim</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            {{-- End Modal Laporan --}}

            {{-- Modal Hapus Laporan --}}
                <div class="modal fade" id="cleanerDeletePjkpReport{{$cPrt->id_lp}}" tabindex="-1" role="dialog" aria-labelledby="cleanerDeletePjkpReport" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="cleanerDeletePjkpReport">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        Apakah anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="{{route('destroyLaporanPjkpCleaner',$cPrt->id_lp)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            {{-- End Modal Hapus Laporan --}}
        @endif
    {{-- End Laporan Pjkp --}}
{{-- END CLEANER --}}
