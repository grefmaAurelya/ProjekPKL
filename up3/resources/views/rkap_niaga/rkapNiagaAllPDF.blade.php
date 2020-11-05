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

    {{--<title>RKAP MATERIAL NIAGA</title>--}}
{{--</head>--}}
{{--<body>--}}
    <style>
        #rkapDist {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #rkapDist td, #rkapDist th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #rkapDist tr:nth-child(even){background-color: #f2f2f2;}

        #rkapDist tr:hover {background-color: #ddd;}

        #rkapDist th {
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
    <h1 class="center">RKAP NIAGA</h1>
    <table id="rkapDist" width="100%">
    <thead>
        <tr>
            <td>Tanggal</td>
            <td>Nama Material</td>
            <td>Satuan</td>
            <td>Jenis Material</td>
            <td>No PRK</td>
            <td>Total</td>
        </tr>
        </thead>
        @foreach($rkap_niaga as $p)
            <tbody>
            <tr>
                <td>{{ $p->tanggal_rkap_dist }}</td>
                <td>{{ $p->niaga->nama_material_niaga}}</td>
                <td>{{ $p->niaga->satuan_niaga }}</td>
                <td>{{ $p->niaga->jenis_material_niaga }}</td>
                <td>{{ $p->prk->noPrk }}</td>
                <td>{{ $p->total_rkap_niaga }}</td>
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


