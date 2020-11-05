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

{{--<title>Material Distribusi export Excel</title>--}}
{{--</head>--}}
{{--<body>--}}
<style>
    #distribusies {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #distribusies td, #distribusies th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #distribusies tr:nth-child(even){background-color: #f2f2f2;}

    #distribusies  tr:hover {background-color: #ddd;}

    #distribusies  th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="distribusies " width="100%">
    <thead>
    <tr>
        <td><b>Nama Material</b></td>
        <td><b>Satuan</b></td>
        <td><b>Harga Satuan</b></td>
        <td><b>Transportasi dan Asuransi</b></td>
        <td><b>Jenis Material</b></td>
    </tr>
    </thead>
    @foreach($distribusies  as $c)
        <tbody>
        <tr>
            <td>{{ $c->nama_material_distribusi}}</td>
            <td>{{ $c->satuan_distribusi }}</td>
            <td>{{ $c->harga_satuan_distribusi}}</td>
            <td>{{ $c->transportasi_dan_asuransi_distribusi }}</td>
            <td>{{ $c->jenis_material_distribusi }}</td>
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


