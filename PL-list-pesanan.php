<?php
    include_once("sidebar-header.php");
    sidehead("spelanggan.php");
    include_once("functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>
    <style>
        body {
            background-color: #F5F5F5;
        }
        .isi {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;

            font-weight: bold;
            font-size: 24px;
            letter-spacing: 5px;
    }
        .list{
            position: absolute;
            top: 155px;
            left: 29%;
            width: 67vw;
            height: 35vw;
    }
        .tgl {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-weight: bold;
    }
        .atasnama {
            display: flex;
            font-weight: bold;
            margin-left: 50%;
        }
        .b1 {
            display: flex;
            flex-direction: row;
            margin-top:20px;
        }
        .table {
            margin-top: 15px;
        }
        thead, tr {
            display:table;
            table-layout:fixed;
            width: 67vw;
        }
        tbody {
            display:block;
            overflow-y:auto;
            max-height:20vw; /* ubah untuk menyesuaikan tinggi tabel */
            width: 100%;
        }
        th {
            height: 40px;
            background: #F5F5F5;
        }
        td {
            height: 30px;
        }
        tr:nth-child(odd) {
            background : #C4C4C4;
        }
        tr:nth-child(even) {
            background : white;
        }
        td button {
            padding: 3px;
            width: 50px;

            background-color: #6A6363;
            border-radius: 10px;
            border: 0 solid;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);

            text-decoration: none;
            color: white;
            font-family: inherit;
            font-size: 12px;
        }
        .bawah {
            
        }
    </style>
</head>
<body>
    <div class="list">
        <div class="isi">
            CEK LIST PESANAN
        </div>
        <div class="b1">
            <div class="tgl">
                Tanggal Bayar :
            </div>
            <div class="atasnama">
                Atas Nama :
            </div>
        </div>
        <div class="table"> <!-- table -->
            <table cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Harga Item</th>
                        <th width="50px">Qty</th>
                        <th width="300px">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Icad</td>
                        <td align="right">contoh</td>
                        <td align="center" width="50px">oke</td>
                        <td align="right" width="300px">Sip</td>
                    </tr>
                    <tr>
                        <td>Disini</td>
                        <td align="right">contoh</td>
                        <td align="center" width="50px">disini</td>
                        <td align="right" width="300px">disini</td>
                    </tr>
                </tbody>    
            </table>
        </div>
        <div class="bawah">
        </div>
    </div>
</body>
</html>