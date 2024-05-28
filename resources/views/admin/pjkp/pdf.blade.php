<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>{{$title}}</title>

</head>
<body>
    <h5 class="text-center text-uppercase">{{$title}}</h5>
    <h6 class="text-center text-uppercase">{{$nameMonthYear}}</h6>


    <div>
        <table class="table table-bordered ">
            <thead class="table-active">
                <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                    <th>Nama Supervisor</th>
                    <th>Waktu Laporan</th>
                    <th>Waktu Ditanggapi</th>
                    <th>Foto</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($printData as $aPr)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $aPr->laporanPjkp->user->name }}</td>
                        <td>{{ $aPr->user->level == 'spv' ? $aPr->user->name : 'Tidak Ada Penanggung Jawab' }}</td>
                        <td>{{ date("d-m-Y", strtotime($aPr->laporanPjkp->tgl_lp)); }}</td>
                        <td>{{ date("d-m-Y", strtotime($aPr->tgl_tp)) }}</td>
                        <td><img src="{{public_path('images/laporan_pjkp/'.$aPr->laporanPjkp->image_lp)}}" alt="" style="width: 80%; height: auto;border-radius:1%"></td>
                        <td>{{ $aPr->tanggapan_pjkp }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
