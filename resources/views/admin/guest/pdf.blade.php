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
                    <th >No</th>
                    <th>Waktu Pengaduan</th>
                    <th>Lokasi Pengaduan</th>
                    <th>Nama Visitor</th>
                    <th>Jabatan Visitor</th>
                    <th>Keterangan Laporan</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($printData as $lGa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$lGa->tgl_guest}}</td>
                        <td> <span class="badge badge-primary"> {{$lGa->area->nama_area}} {{$lGa->area->desc_area}} </span></td>
                        <td>{{$lGa->nama_guest}}</td>
                        <td>{{$lGa->level_guest}}</td>
                        <td>{{$lGa->ket_guest}}</td>
                        <td><img src="{{public_path('images/laporan_guest/'.$lGa->image_guest)}}" alt="" class="p-1 bg-light" style="width: 80%; height: auto;border-radius:5%"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
