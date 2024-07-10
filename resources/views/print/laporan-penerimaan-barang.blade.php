<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Laporan Penerimaan Stock</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo-dewata.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.6/datatables.min.css" rel="stylesheet">

    <!-- plugin css -->
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

        <style>
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            th {
                background-color: #f2f2f2;
            }
            </style>
</head>
<body>
    {{-- dd($data); --}}
    <div class="header d-flex justify-content-center align-items-center">
        <h2>DEWATA WATERPROOFING NUSANTARA</h2>
        <h2>Laporan Penerimaan Stock</h2>
    </div>
    
    
    
    <table>
        <thead>
            <tr>
            <td colspan="2" style="text-align: left; border:none"><span style="text-align: left">Bulan : {{ $bulan }}, Tahun : {{ $tahun }}</span></td>
            <td colspan="2" style="text-align: right; border:none"><span style="text-align: right">Tanggal : {{ now()->format('d F Y') }}</span></td>
        </tr>
            <tr>
                <th>No</th>
                <th>Nama Warehouse</th>
                <th>Stock Masuk</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $history)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $history->warehouse_name}}</td>
                <td>{{ $history->stock }}</td>
                <td>{{ $history->tanggal_masuk }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
