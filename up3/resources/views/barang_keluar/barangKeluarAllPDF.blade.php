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

{{--<title>Barang Masuk Exports All PDF</title>--}}
{{--</head>--}}
{{--<body>--}}
<style>
    #barang-masuk {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #barang-masuk td, #barang-masuk th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #barang-masuk tr:nth-child(even){background-color: #f2f2f2;}

    #barang-masuk tr:hover {background-color: #ddd;}

    #barang-masuk th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>

<table id="barang-masuk" width="100%">
    <thead>
    <tr>
        
        <td>Barang</td>
        <td>Pemakai</td>
        <td>Quantity</td>
        <td>Date</td>
    </tr>
    </thead>
    @foreach($barang_keluar as $p)
        <tbody>
        <tr>
            
            <td>{{ $p->barang->name }}</td>
            <td>{{ $p->pemakai->nama }}</td>
            <td>{{ $p->barang_keluar_total }}</td>
            <td>{{ $p->tanggal }}</td>
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


