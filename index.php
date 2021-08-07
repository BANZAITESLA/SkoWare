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
        .ket {
            margin-top: 20px;
        }
        .ket td {
            background-color: #F5F5F5;
            font-weight: bold;
        }
        .table {
            position: absolute;
            display: block;
        }
        thead, tr {
            display:table;
            table-layout:fixed;
            width: 67vw;
        }
        tbody {
            display:block;
            overflow-y:auto;
            max-height:17vw; /* ubah untuk menyesuaikan tinggi tabel */
            width: 100%;
        }
        th {
            height: 40px;
            background: #F5F5F5;
        }
        td {
            height: 30px;
        }
        tr:nth-of-type(odd) {
            background : #C4C4C4;
        }
        tr:nth-of-type(even) {
            background : white;
        }
        .form {
            margin-top: 40px;
        }
        .form-control {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-top: 15px;
        }
        .form-control input {
            border: 0 solid;
            border-radius: 10px;
            width: 30%;

            font-family: inherit;
            padding: 10px;
            background-color: #C4C4C4;
        }
        .form-control .cek {
            padding: 10px;
            margin-left: 20px;
            border: 0 solid;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            width: 10%;

            background-color: #6A6363;
            color: #FFFFFF;
            font-family: inherit;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="isi">
        <div class="judul">
            CEK LIST PESANAN
        </div>
        <div class="form-control">
            <input id="id" type="text" name="id"  placeholder="Input ID Pesanan Anda">
            <input id="cek" class="cek" name="cek" type="submit" value="Cek">
        </div>
        
        <div class="table" id="table"> <!-- table --></div>
    </div>
    <script>
        $('#cek').click(function(){
            var pencarian = $("#id").val();
            if(pencarian != '') {
                load_data(pencarian);
            }

            function load_data(query) { /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url:"PL-konfir-pesanan.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data) {
                        $('#table').html(data);
                    }
                });
            }
        });
    </script>
</body>
</html>