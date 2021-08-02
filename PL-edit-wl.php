<?php
      include_once("sidebar-header.php");
      sidehead("spelayan.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelayan</title>
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
            margin-top: 10px;
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
        if (isset($_GET["error"])) { /* jika terdapar error */
            $error = $_GET["error"];
            if (substr($error, -1) == 1) {
                echo '<script type="text/javascript">','sqlerror();','</script>'; /* alert tambah data gagal */
            } else if (substr($error, -1) == 2) {
                echo '<script type="text/javascript">','uploaderror();','</script>'; /* alert upload gambar gagal */
            } else {
                echo '<script type="text/javascript">','unknownerror();','</script>'; /* alert error tdk diketahui */
			}
		}
    ?>

	<div class="isi">
        <div class="judul"> <!-- judul page -->
            EDIT WAITING LIST
        </div>      
        
        <form class="form" action="PL-update-editwl.php" method="post">
            <?php
                if (isset($_GET["id_pesanan"]) or (isset($_GET["error"]))) { /* agar ketika error kembali ke form edit dgn id yg sama */
                    $db=dbConnect();
                    
                    if (isset($_GET["id_pesanan"])) {
                        $id_pesanan = $db->escape_string($_GET['id_pesanan']);
                    } else if ($_GET["error"]){
                        $subid_pesanan = substr($_GET["error"], 0, -1); /* manipulasi link error untuk mendapatkan id */
                        $id_pesanan = $db->escape_string($subid_pesanan);
                    }
                    
                    if($datapesanan=getDataPesanan($id_pesanan)){
            ?>
                        <div class="form-control">
                            <label for="nama_pelanggan">ID Pesanan</label>
                            <input type="text" name="id_pesanan" value="<?php echo $datapesanan["id_pesanan"];?>" readonly></input>
                        </div>
                        <div class="form-control">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" value="<?php echo $datapesanan["nama_pelanggan"];?>"></input>
                        </div>
                        <div class="form-control">
                            <label for="no_telp">No Telepon</label>
                            <input type="number" name="no_telp" value="<?php echo $datapesanan["no_telp"];?>"></input>
                        </div>
                        <div class="form-control">
                            <label for="waktu_datang">Tanggal Datang</label>
                            <input type="date" name="tanggal" value="<?php echo $datapesanan["tanggal"];?>"></input>
                        </div>
                        <div class="form-control">
                            <label for="waktu_datang">Waktu Datang</label>
                            <input type="time" name="waktu" value="<?php echo $datapesanan["waktu"];?>"></input>
                        </div>
                        <div class="form-control">
                            <label for="jml_pelanggan">Jumlah Pelanggan </label>
                            <input type="text" name="jml_pelanggan" value="<?php echo $datapesanan["jml_pelanggan"];?>"></input>
                        </div>

                        <div class="simpan-control">
                            <input class="simpan" type="submit" value="Simpan Waiting List" name="TblUpdate"></input>
                        </div>
        </form>
            <?php
                    }
                }
        ?>
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