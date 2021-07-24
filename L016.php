<?php
      include_once("sidebar-header.php");
      sidehead("spelayan.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
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
            font-size: 24px;
            letter-spacing: 10px;
        }
        .caridantambah {
            display: flex;
            flex-direction: row;
            justify-content: space-between;

            margin-top: 20px;
        }
        .cari input {
            padding: 10px;
            border: 0 solid;
            border-radius: 10px 0px 0px 10px;
            background-color: #C4C4C4;

            font-family: inherit;
        }
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
            width: 70px;

            background-color: #6A6363;
            border-radius: 10px;
            border: 0 solid;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);

            text-decoration: none;
            color: white;
            font-family: inherit;
            font-size: 12px;
        }
     
    </style>
</head>
<body> 
<div class="isi">
        <div class="judul"> <!-- judul page -->
            WAITING LIST
        </div>
    
        <div class="caridantambah">
            
        <div class="cari"> <!-- cari item -->
                <input type="text" placeholder="Cari Menu" name="username">
                <a href="#"><i class="fas fa-search"></i></a>
                </input>
            </div>
        </div>

        <div table> <!--nunggu kang ardi -->
    </div>
    </div>
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
