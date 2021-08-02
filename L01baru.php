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
    <title>Dashboard Pelayan</title>
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

        .no {
            display: flex;
            align-items: center;
            text-align: center;

            margin-top: 20px;
        }

        .no label {
            font-weight: bold;
        }

        .no input {
            margin-left: 10px;
            padding: 10px;
            border: 0 solid;
            border-radius: 10px;
            background-color: #C4C4C4;

            font-family: inherit;
        }

        .table {
            margin-top: 15px;
        }

        thead,
        tr {
            display: table;
            table-layout: fixed;
            width: 67vw;
        }

        tbody {
            display: block;
            overflow-y: auto;
            max-height: 21vw;
            /* ubah untuk menyesuaikan tinggi tabel */
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
            background: #C4C4C4;
        }

        tr:nth-of-type(even) {
            background: white;
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

        .swal2-input[type=number] {
            max-width: 100em;
        }

        .menu {
            background-color: inherit;
            width: 100px;
            border: 0 solid;
        }

        .qty {
            background-color: rgba(0, 0, 0, 0.1);
            width: 60px;
            border: 0 solid;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET["error"])) { /* ketika terdapat error */
        $error = $_GET["error"];
        if ($error == 1) {
            echo '<script type="text/javascript">', 'dberror();', '</script>'; /* alert koneksi db error */
        } else if ($error == 2) {
            echo '<script type="text/javascript">', 'nodata();', '</script>'; /* alert untuk data tidak ditemukan */
        } else if ($error == 3) {
            echo '<script type="text/javascript">', 'sqlerror();', '</script>'; /* alert untuk data tidak ditemukan */
        } else {
            echo '<script type="text/javascript">', 'unknownerror();', '</script>'; /* alert error tdk diketahui */
        }
    }

    if (isset($_GET["success"])) { /* ketika proses berhasil */
        $success = $_GET["success"];
        if ($success == 1) {
            echo '<script type="text/javascript">', 'tambahsuccess();', '</script>'; /* alert berhasil tambah data */
        }
    }
    ?>
    <?php
    if ($db->connect_errno == 0) { /* ketika koneksi db success */
        if (isset($_GET['meja'])) { /* ketika ada input cari */
    ?>
            <div class="isi">
                <div class="judul">
                    <!-- judul page -->
                    DETAIL PESANAN
                </div>

                <div class="no">
                        <label for="no_meja">No Meja</label>
                        <input type="text" name="no_meja" value="<?php echo $_GET["meja"]; ?>" readonly></input>
                </div>

                <div class="table" id="table">
                    <!-- table -->
                    <table cellspacing="0" cellpadding="5">
                        <thead>
                            <!-- header table -->
                            <tr>
                                <th width="100px">ID Menu</th>
                                <th>Nama Menu</th>
                                <th width="70px">Qty</th>
                                <th width="70px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- body table -->
                            <?php
                            if ($db->connect_errno == 0) { /* ketika koneksi db success */
                                $meja = $_GET["meja"];
                                $detail = "SELECT * FROM detail_pesanan, menu_minuman, meja_dan_kursi WHERE no_meja = '$meja' AND detail_pesanan.id_menu = menu_minuman.id_menu AND meja_dan_kursi.id_pesanan = detail_pesanan.id_pesanan";
                                $resmenu = $db->query($detail);
                                if ($resmenu) {
                                    $data = $resmenu->fetch_all(MYSQLI_ASSOC);
                                    foreach ($data as $barisdata) { /* looping untuk menampilkan hasil query */
                            ?>
                                        <tr>
                                            <td align="center" width="100px"><?php echo $barisdata["id_menu"]; ?></td>
                                            <td><?php echo $barisdata["nama_menu"]; ?></td>
                                            <td align="center" width="70px"><?php echo $barisdata["qty"]; ?></td>
                                            <td align="center" width="70px"><a href="L01baru-qty.php?no=<?php echo $meja;?>&menu=<?php echo $barisdata["id_menu"];?>&qty=<?php echo $barisdata["qty"]; ?>"><button>Tambah</button></a></td>
                                        </tr>
                            <?php
                                    }
                                    $resmenu->free();
                                }
                            } else {
                                $url = 'dkoki.php?error=1';  /* koneksi db gagal */
                                redirect($url);
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    <?php
        }
    }
    ?>
</body>

</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>