<?php
    include_once("sidebar-header.php");
    sidehead("skasir.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <style>
        body {
            background-color: #F5F5F5;
        }
        .isi {
            position: absolute;
            display: block;
            top: 155px;
            left: 29%;
            width: 67vw;
            height: 35vw;
        }
        .judul {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;

            font-weight: bold;
            font-size: 18px;
            letter-spacing: 10px;
        }
		judul2 {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;

            font-weight: bold;
            font-size: 18px;
            letter-spacing: 10px;
        }
        
        .
        .cari a {
            padding: 10px;
            border-radius: 0px 10px 10px 0px;
            background-color: #C4C4C4;

            font-size: 14px;
            color: black;
        }
        .tambah {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100px;
            padding: 5px;

            background-color: #6A6363;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .tambah a {
            text-decoration: none;
            color: white;
            font-size: 14px;
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
        .simpan {
            position: fixed;
            padding: 8px;
            bottom: 50px;
            right: 50px;

            background-color: #6A6363;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            
        }
        .simpan a {
            text-decoration: none;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="isi">
        <div class="judul"> <!-- judul page -->
           LAPORAN PENDAPATAN PERIODIK RESTORAN
						TANGGAL
        </div>
        <div class="table"> <!-- table -->
            <table cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th width="50px">ID Pesanan</th>
                        <th width="90px">Kas Masuk</th>

                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="right" width="70px">1</td>
                        <td align="right" width="170px">0</td>
                        <td align="center" width="120px">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
       
    </div
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>