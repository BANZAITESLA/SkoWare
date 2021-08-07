<?php
    include_once("sidebar-header.php");
    sidehead("skoki.php");
    include_once("functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Koki</title>
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
        .caridantambah {
            display: flex;
            flex-direction: row;
            justify-content: space-between;

            margin-top: 20px;
        }
        .cari input {
            padding: 10px;
            border: 0 solid;
            border-radius: 10px;
            background-color: #C4C4C4;

            font-family: inherit;
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
            max-height:21vw; /* ubah untuk menyesuaikan tinggi tabel */
            width: 100%;
        }
        th {
            height: 40px;
            background: #F5F5F5;
        }
        td {
            height: 30px;
        }
        tr:nth-child(2n+1) {
            background : #C4C4C4;
        }
        tr:nth-of-type(even) {
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
            bottom: 40px;
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
    <?php
        if (isset($_GET["error"])) { /* ketika terdapat error */
            $error = $_GET["error"];
            if ($error == 1) {
                echo '<script type="text/javascript">','dberror();','</script>'; /* alert koneksi db error */
            } else if ($error == 2){ 
                echo '<script type="text/javascript">','nodata();','</script>'; /* alert untuk data tidak ditemukan */
            } else {
                echo '<script type="text/javascript">','unknownerror();','</script>'; /* alert error tdk diketahui */
            }
        }

        if (isset($_GET["success"])) { /* ketika proses berhasil */
            $success = $_GET["success"];
            if ($success== 1) {
                echo '<script type="text/javascript">','tambahsuccess();','</script>'; /* alert berhasil tambah data */
            }
        }
    ?>
    <div class="isi">
        <div class="judul"> <!-- judul page -->
            MENU MINUMAN
        </div>

        <div class="caridantambah">
            <div class="cari"> <!-- cari item -->
                <input type="text" placeholder="Cari Menu" id="cari"></input>
            </div>
            <div class="tambah"> <!-- button tambah -->
                <a href="koki-tambah-menu.php">Tambah Menu</a>
            </div>
        </div>

        <div class="table" id="table"></div> <!-- tempat table -->

        <div class="simpan"> <!-- button simpan -->
            <a href="list-menu.php">Lihat Menu Hari Ini</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            load_data();

            function load_data(query) { /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url:"KK-tabel-menu.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data) {
                        $('#table').html(data);
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