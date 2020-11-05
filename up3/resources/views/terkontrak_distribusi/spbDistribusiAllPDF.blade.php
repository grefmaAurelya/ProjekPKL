{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta name="viewport"--}}
          {{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    {{--<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">--}}
    {{--<!-- Font Awesome -->--}}
    {{--<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">--}}
    {{--<!-- Ionicons -->--}}
    {{--<link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">--}}

    {{--<title>RKAP MATERIAL DISTRIBUSI</title>--}}
{{--</head>--}}
{{--<body>--}}
    <style>
        #spbDist {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 11 ;
            border-collapse: collapse;
            width: 100%;
        }

        #spbDist td, #spbDist th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #spbDist tr:nth-child(even){background-color: #f2f2f2;}

        #spbDist tr:hover {background-color: #ddd;}

        #spbDist th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    .center 
    {
        text-align:center;
    }
    </style>
    <h1 class="center">SPB DISTRIBUSI</h1>
    <table id="spbDist" width="100%">
        <thead>
        <tr>
                    <th>Tanggal</th>
                    <th>No. PRK</th>
                    <th>No. SPB</th>
                    <th>Nama Material</th>
                    <th>Satuan</th>
                    <th>Jenis Material</th>
                    <th>Pabrikan</th>
                    <th>Harga Satuan</th>
                    <th>Transportasi dan Asuransi</th>
                    <th>Total</th>
        </tr>
        </thead>
        @foreach($spb_distribusi as $p)
            <tbody>
            <tr>
                <td>{{ $p->tanggal_spb_dist }}</td>
                <td>{{ $p->prk->noPrk }}</td>
                <td>{{ $p->spb->no_spb_mstr }}</td>
                <td>{{ $p->distribusi->nama_material_distribusi}}</td>
                <td>{{ $p->distribusi->satuan_distribusi }}</td>
                <td>{{ $p->distribusi->jenis_material_distribusi }}</td>
                <td>{{ $p->pabrikan->pabrikan_mstr }}</td>
                <td>{{ $p->distribusi->harga_satuan_dist}}</td>
                <td>{{ $p->distribusi->asuransi_dan_transportasi_dist}}</td>
                <td>{{ $p->total_spb_dist }}</td>
            </tr>
            </tbody>
        @endforeach

    </table>


    {{--<!-- jQuery 3 -->--}}
    {{--<script src="{{  asset('assets/bower_components/jquery/dist/jquery.min.js') }} "></script>--}}
    {{--<!-- Bootstrap 3.3.7 -->--}}
    {{--<script src="{{  asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>--}}
    {{--<!-- AdminLTE App -->--}}
    {{--<script src="{{  asset('assets/dist/js/adminlte.min.js') }}"></script>--}}
{{--</body>--}}
{{--</html>--}}

