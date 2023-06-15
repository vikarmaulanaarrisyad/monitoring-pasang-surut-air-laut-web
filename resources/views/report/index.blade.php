<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Ketinggian Air</title>

    <link rel="stylesheet" href="{{ public_path('/AdminLTE/dist/css/adminlte.min.css') }}">
</head>

<body>

    <h4 class="text-center">Laporan Data Ketinggian Air dan Kecepatan Angin </h4>
    <p class="text-center">
        Tanggal {{ tanggal_indonesia($start) }}
        s/d
        Tanggal {{ tanggal_indonesia($end) }}
    </p>

    <table class="table table-striped table-sm mt-2" style="width: 100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Tanggal</th>
                <th width="20%">Ketinggian</th>
                <th width="10%">Kecepatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $key => $col)
                        <td {!! $key > 1 ? 'class="text-left"' : '' !!}>{!! $col !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
