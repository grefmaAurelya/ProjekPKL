<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export per Id</title>


</head>

<style>
    #table-data {
        border-collapse: collapse;
        padding: 3px;
    }

    #table-data td, #table-data th {
        border: 1px solid black;
    }
</style>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Logo_PLN.svg" style="width:100%; max-width:300px;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <p>Category : {{ $category->categories_name}}</p>
    <p></p>
    <table border="0" id="table-data" width="100%" align="center">
    <thead>
    <tr>
            <td><b>Material</b></td>
            <td><b>SPB Distribusi</b></td>
            <td><b>SPB Niaga</b></td>
            <td><b>Datang</b></td>
            <td><b>Terkontrak</b></td>
            <td><b>Stok</b></td>
    </tr>
    </thead>

    @foreach ($datas as $s)
    <tbody>
    <tr>
        <td>{{ $s->name}}</td>
        <td>{{ $s->spbdist_total}}</td>
        <td>{{ $s->spbniaga_total}}</td>
        <td>{{ $s->barang_masuk_total}}</td>
        <td>{{ $s->barang_keluar_total}}</td>
        <td>{{ $s->total}}</td>
    </tr>
    </tbody>
    @endforeach
    </table>

    {{--<hr  size="2px" color="black" align="left" width="65%">--}}

</div>
