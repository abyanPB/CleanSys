<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>{{$title}}</title>
    <style>
        @media print {
            table {
                page-break-after: auto;
                width: 100%;
                table-layout: fixed;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            td, th {
                page-break-inside: avoid;
                page-break-after: auto;
                word-wrap: break-word;
                white-space: normal;
            }
            thead {
                display: table-header-group;
            }
            tfoot {
                display: table-footer-group;
            }
        }
        table {
            width: 100%;
            table-layout: fixed;
        }
        td, th {
            word-wrap: break-word;
            white-space: normal;
        }
    </style>

</head>
<body>
    <h5 class="text-center text-uppercase">{{$title}}</h5>
    <h6 class="text-center text-uppercase">{{$currentMonthYear}}</h6>

    <div>
        <table class="table table-bordered">
            <thead class="table-active">
                <tr>
                    <th>No</th>
                    <th>Nama Cleaner</th>
                    <th>Area Tanggungan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($printData as $printData)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$printData->name}}</td>
                        <td>
                            @if ($printData->areaResponsibilities->isEmpty())
                                Belum Memasukan Penanggung Jawab Area
                            @else
                                @foreach ($printData->areaResponsibilities as $ar)
                                    <span class="badge badge-primary">{{ $ar->area->nama_area }} {{ $ar->area->desc_area }}  </span>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
