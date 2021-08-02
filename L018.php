<?php
    include_once("sidebar-header.php");
    sidehead("spelayan.php");
    include_once("functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Selesai</title>
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
            margin-bottom: 20px;
            justify-content: center;
            align-items: center;
            text-align: center;

            font-weight: bold;
            font-size: 24px;
            letter-spacing: 10px;
        }
        .container-isi {
            position: absolute;
            display: block;
            width: 67vw;
            height: 31vw;
            overflow-y:auto;
        }
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto auto;
        }
        .grid-menu {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin : 10px;
        }
        .grid-menu a {
            text-decoration: none;
            color: black;
        }
        button {
            padding: 35px;
            border: 0px solid;
            text-align: center;
            background-color: #C4C4C4;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            font-family: inherit;
            font-size: 16px;
            line-height: 20px;
        }
        .isi-menu {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="isi">
        <div class="judul"> <!-- judul page -->
            PESANAN SIAP ANTAR
        </div>
        <div class="container-isi">
            <div class="grid-container" id="grid"></div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            load_data();

            function load_data(query) { /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url:"l018-ajax.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data) {
                        $('#grid').html(data);
                    }
                });
            }
        });
    </script>
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>