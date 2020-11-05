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

{{--<title>Material Niaga export Excel</title>--}}
{{--</head>--}}
{{--<body>--}}
<style>
    #niagas {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #niagas td, #niagas th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #niagas tr:nth-child(even){background-color: #f2f2f2;}

    #niagas  tr:hover {background-color: #ddd;}

    #niagas  th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="niagas " width="100%">
    <thead>
    <tr>
        <td><b>Nama Material</b></td>
        <td><b>Satuan</b></td>
        <td><b>Jenis Material</b></td>
        <td><b>Harga Satuan</b></td>
        <td><b>Transportasi dan Asuransi</b></td>
        
    </tr>
    </thead>
    @foreach($niagas as $c)
        <tbody>
        <tr>
            <td>{{ $c->nama_material_niaga}}</td>
            <td>{{ $c->satuan_niaga }}</td>
            <td>{{ $c->jenis_material_niaga }}</td>
            <td>{{ $c->harga_satuan_niaga}}</td>
            <td>{{ $c->transportasi_dan_asuransi_niaga }}</td>     
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


