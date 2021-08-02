<?php
include_once("sidebar-header.php");
sidehead("spelayan.php");
include_once("functions.php");
$db = dbConnect();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        if(isset($_GET["menu"]) &&  isset($_GET["no"])) {
            $meja = $_GET["no"];
            $menu = $_GET["menu"];

            if($detail=getDetail($meja, $menu)){
    ?>
                <div class="isi">
                    <div class="judul">
                        <!-- judul page -->
                        TAMBAH PESANAN
                    </div>

                    <form class="form" action="TambahL01baru.php" method="post">
                        <div class="form-control">
                            <label for="no_meja">No Meja</label>
                            <input type="text" name="no_meja" id="no" value="<?php echo $detail["no_meja"]?>" readonly></input>
                        </div>
                        <div class="form-control">
                            <label for="id_pesanan">ID Pesanan</label>
                            <input type="text" name="id_pesanan" id="no" value="<?php echo $detail["id_pesanan"]?>" readonly></input>
                        </div>
                        <div class="form-control">
                            <label for="id_menu">ID Menu</label>
                            <input type="text" name="id_menu" value="<?php echo $detail["id_menu"]?>" readonly></input>
                        </div>

                        <div class="form-control">
                            <label for="nama_menu">Nama Menu</label>
                            <input type="text" name="nama_menu" value="<?php echo $detail["nama_menu"]?>" readonly></input>
                        </div>

                        <div class="form-control">
                            <label for="stok">Stok</label>
                            <input type="text" name="stok" value="<?php echo $detail["stok"]?>" readonly></input>
                        </div>

                        <div class="form-control">
                            <label for="qty">Qty</label>
                            <input type="number" name="qty" min="0" max="<?php echo $detail["stok"]?>"></input>
                        </div>

                        <div class="simpan-control">
                            <input class="simpan" type="submit" value="Tambah" name="<?php echo ($_GET["qty"] == 0 ? "tambah":"update");?>"></input>
                        </div>
                    </form>
            </div>
    <?php
            }
        }
    ?>
</body>
</html>