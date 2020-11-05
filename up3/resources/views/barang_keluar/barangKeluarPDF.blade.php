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
                            <img src="" style="width:100%; max-width:300px;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


        <table border="0" id="table-data" width="80%">
            <tr>
                <td width="70px">Invoice ID</td>
                <td width="">: {{ $barang_keluar->id }}</td>
                <td width="30px">Created</td>
                <td>: {{ $barang_keluar->tanggal }}</td>
            </tr>

            <tr>
                <td>Telepon</td>
                <td>: {{ $barang_keluar->pemakai->telepon }}</td>
                <td>Alamat</td>
                <td>: {{ $barang_keluar->pemakai->alamat }}</td>
            </tr>

            <tr>
                <td>Nama</td>
                <td>: {{ $barang_keluar->pemakai->nama }}</td>
                <td>Email</td>
                <td>: {{ $barang_keluar->pemakai->email }}</td>
            </tr>

            <tr>
                <td>Barang</td>
                <td >: {{ $barang_keluar->barang->name }}</td>
                <td>Quantity</td>
                <td >: {{ $barang_keluar->barang_keluar_total }}</td>
            </tr>

        </table>

        {{--<hr  size="2px" color="black" align="left" width="45%">--}}


       
</div>
