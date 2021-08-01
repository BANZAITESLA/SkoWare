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
        .form {
            margin-top: 40px;
            width: 100%;
        }
        .form-control {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;

            margin-top: 15px;
        }
        .form-control label {
            
            width: 25%;

            font-weight: bold;
            font-size: 16px;
        }
        .form-control input {
            border: 0 solid;
            border-radius: 10px;
            width: 50%;

            background-color: #C4C4C4;

            font-family: inherit;
            padding: 10px;
        }
        .simpan-control {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .simpan {
            padding: 10px;
            margin-left: 55%;
            margin-top: 15px;
            border: 0 solid;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            width: 20%;

            background-color: #6A6363;
            color: #FFFFFF;
            font-family: inherit;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_GET["error"])) { /* ketika terdapat error */
            $error = $_GET["error"];
            if ($error == 1) {
                echo '<script type="text/javascript">','sqlerror();','</script>'; /* alert tambah data gagal */
            } else {
                echo '<script type="text/javascript">','unknownerror();','</script>'; /* alert error tdk diketahui */
            }
        }
    ?>
    <div class="isi">
        <div class="judul"> <!-- judul page -->
            TAMBAH WAITING LIST
        </div>

        <form class="form" action="PL-simpan-wl.php" method="post">
                         <div class="form-control">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan"></input>
                        </div>
                        
                        <div class="form-control">
                            <label for="no_telp">No Telepone</label>
                            <input type="text" name="no_telp"></input>
                        </div>
                        <div class="form-control">
                            <input type="hidden" name="waktu_datang"></input>
                        </div>


                        <div class="form-control">
                            <label for="jml_pelanggan">Jumlah Pelanggan </label>
                            <input type="text" name="jml_pelanggan"></input>
                        </div>

                        <div class="simpan-control">
                            <input class="simpan" type="submit" value="Simpan Waiting List" name="TblSimpan"></input>
                        </div>
        </form>
            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <script>
        new AutoNumeric('#jml', { /* live format angka */
            decimalPlaces: '0',
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            minimumValue : '0'
        })
    </script>
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>