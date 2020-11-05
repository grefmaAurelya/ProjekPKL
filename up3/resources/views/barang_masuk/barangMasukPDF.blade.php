<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>export per id</title>


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
                            <img src="">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <table border="0" id="table-data" width="80%">
        <tr>
            <td width="70px">Invoice ID</td>
            <td width="">: {{ $barang_masuk->id }}</td>
            <td width="30px">Created</td>
            <td>: {{ $barang_masuk->tanggal }}</td>
        </tr>

        <tr>
            <td>Telepon</td>
            <td>: {{ $barang_masuk->pemasok->telepon }}</td>
            <td>Alamat</td>
            <td>: {{ $barang_masuk->pemasok->alamat }}</td>
        </tr>

        <tr>
            <td>Nama</td>
            <td>: {{ $barang_masuk->pemasok->nama }}</td>
            <td>Email</td>
            <td>: {{ $barang_masuk->pemasok->email }}</td>
        </tr>

        <tr>
            <td>Material</td>
            <td >: {{ $barang_masuk->barang->name }}</td>
            <td>Total</td>
            <td >: {{ $barang_masuk->barang_masuk_total }}</td>
        </tr>

    </table>

    {{--<hr  size="2px" color="black" align="left" width="45%">--}}


    
</div>
