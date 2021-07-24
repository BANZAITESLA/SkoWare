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
        small {
            font-size: 12px;
            font-weight: normal;
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

        .tambahmeja {
            justify-content: right;
            align-items: right;
            font-size: 22px;
            font-weight: bold;
           margin-left: 20%;
            padding-top: 60px;
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
            EDIT MEJA DAN KURSI
        </div>      
        
        <form class="form" action="UpdateL015.php" method="post" enctype="multipart/form-data">
        <?php
            if(isset($_GET["no_meja"]) or (isset($_GET["error"]))) { /* agar ketika error kembali ke form edit dgn id yg sama */
                $db=dbConnect();
                $sql = "SELECT m.no_meja, m.status, p.id_pelanggan, p.nama_pelanggan, p.jml_pelanggan
                FROM meja_dan_kursi m LEFT JOIN pelanggan p ON m.id_pelanggan=p.id_pelanggan";
                if (isset($_GET["no_meja"])) {
                    $no_meja = $db->escape_string($_GET['no_meja']);
                } else if ($_GET["error"]){
                    $subno_meja = substr($_GET["error"], 0, -1); /* manipulasi link error untuk mendapatkan id */
                    $no_meja = $db->escape_string($subno_meja);
                }
                if($datamejadankursi=getDataMejaDanKursi($no_meja)){
        ?>
        <div class="form-control">
                <label for="no_meja">No Meja</label>
                <input type="text" name="no_meja" value="<?php echo $datamejadankursi["no_meja"];?>" readonly></input>
            </div>
            <div class="form-control">
                <input type="hidden" name="id_pelanggan" value="<?php echo $datamejadankursi["id_pelanggan"];?>"></input>
            </div>
            <div class="form-control">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" value="<?php echo $datamejadankursi["nama_pelanggan"];?>"></input>
            </div>
            <div class="form-control">
                <label for="jml_pelanggan">Jumlah Pelanggan </label>
                <input type="text" name="jml_pelanggan" value="<?php echo $datamejadankursi["jml_pelanggan"];?>"></input>
            </div>

            <div class="simpan-control">
                <input class="simpan" type="submit" value="Simpan Data" name="TblUpdate"></input>
            </div>
            </form>
        <?php
                } else {
                    $url = 'L012.php?error=2';  //data tidak ditemukan
                    redirect($url);
                }
            }
        ?>
</div>

</body>
</html>