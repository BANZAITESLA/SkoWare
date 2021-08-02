<?php
    include_once("sidebar-header.php");
    include_once("functions.php");
    sidehead("skoki.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Minuman</title>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
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
            margin-bottom: 5px;
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

            margin-top: 10px;
        }
        .simpan {
            padding: 10px;
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
            EDIT MENU MINUMAN
        </div>
        <?php
            if(isset($_GET["id_menu"]) or (isset($_GET["error"]))) { /* agar ketika error kembali ke form edit dgn id yg sama */
                $db=dbConnect();
                if (isset($_GET["id_menu"])) {
                    $idmenu = $db->escape_string($_GET['id_menu']);
                } else if ($_GET["error"]){
                    $subidmenu = substr($_GET["error"], 0, -1); /* manipulasi link error untuk mendapatkan id */
                    $idmenu = $db->escape_string($subidmenu);
                }
                if($menu=getMenu($idmenu)){
        ?>
                    <form class="form" action="KK-konfir-editmenu.php" method="post" enctype="multipart/form-data">
                        <div class="form-control">
                            <label for="id">ID Menu Minuman</label>
                            <input type="text" name="id" value="<?php echo $menu["id_menu"];?>" readonly></input>
                        </div>
                        <div class="form-control">
                            <label for="nama">Nama Menu Minuman</label>
                            <input type="text" name="nama" value="<?php echo $menu["nama_menu"];?>"></input>
                        </div>
                        <div class="form-control">
                            <label for="harga">Harga Item</label>
                            <input type="text" name="harga" id="harga" value="<?php echo $menu["harga_item"];?>"></input>
                        </div>
                        <div class="form-control">
                            <label for="stok">Stok</label>
                            <input type="text" name="stok" id="stok" value="<?php echo $menu["stok"];?>"></input>
                        </div>
                        <div class="form-control">
                            <label for="file">Upload Gambar <small><br>Type Gambar : .png .jpg. jpeg<br>Ukuran Maks. 5MB</small></label>
                            <input type="file" name="file" accept="image/png, image/jpeg">
                            <input type="hidden" name="file_lama" value="<?php echo $menu["gambar"];?>">
                            </input>
                        </div>
                        <div class="simpan-control">
                            <input class="simpan" type="submit" value="Simpan Menu Minuman" name="simpan"></input>
                        </div>
                    </form>
        <?php
                } else {
                    $url = 'dkoki.php?error=2';  //data tidak ditemukan
                    redirect($url);
                }
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <script>
        new AutoNumeric('#harga', {
            currencySymbol: 'Rp ',
            decimalPlaces: '0',
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            minimumValue : '0'
        })
        new AutoNumeric('#stok', {
            decimalPlaces: '0',
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            minimumValue : '0',
            maximumValue : '50'
        })
    </script>
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>