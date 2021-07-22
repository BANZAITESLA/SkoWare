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
    <title>Menu Minuman</title>
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
            font-size: 24px;
            letter-spacing: 10px;
        }
        .cari input {
            padding: 10px;
            border: 0 solid;
            border-radius: 10px;
            background-color: #C4C4C4;

            font-family: inherit;
        }
        .container-isi {
            position: absolute;
            display: block;
            top: 80px;
            width: 67vw;
            height: 28vw;
            overflow-y:auto;
        }
        .grid-container {
            display: grid;
            margin-top: 15px;
            grid-template-columns: auto auto auto auto auto;
            background-color: #F5F5F5;
        }
        .grid-menu {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
            border: 0px solid;
            font-size: 14px;
            text-align: center;
        }
        .isi-menu {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #nama {
            font-weight: bold;
        }
        .tulisan {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="isi">
        <div class="judul"> <!-- judul page -->
            MENU MINUMAN
        </div>
        <div class="cari"> <!-- cari item -->
            <input type="text" placeholder="Cari Menu" id="cari"></input>
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
                    url:"PL-konfir-menu.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data) {
                        $('#grid').html(data);
                    }
                });
            }

            $('#cari').keyup(function() { /* jquery ketika terdapat input cari */
                var pencarian = $(this).val();
                if(pencarian != '') {
                    load_data(pencarian);
                } else {
                    load_data();
                }
            });
        });
    </script>
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>