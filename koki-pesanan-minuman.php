<?php
    include_once("sidebar-header.php");
    sidehead("skoki.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Minuman</title>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <style>
    .list{
            position: absolute;
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
            letter-spacing: 5px;
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
            background-color: red;
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
    <div class="list">
        <div class="judul"> <!-- judul page -->
            PESANAN MINUMAN
        </div>
        <div class="container-isi">
            <div class="grid-container" id="grid">
                <div class="grid-menu">
                    <div class="isi-menu">apa aja</div>
                    <div class="tulisan">
                        <div class="isi-menu" id="nama">asifnasifnasf</div>
                        <div class="isi-menu">okayyy</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <script>
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
    </script> --> <!-- ada link ke koki-list-pesanan (belum beres) -->
    </div>
</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
</html>