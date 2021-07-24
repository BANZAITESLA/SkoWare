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
        .caridantambah {
            display: flex;
            flex-direction: row;
            justify-content: space-between;

            margin-top: 20px;
        }
        .cari input {
            padding: 10px;
            border: 0 solid;
            border-radius: 10px 0px 0px 10px;
            background-color: #C4C4C4;

            font-family: inherit;
        }
        .cari a {
            padding: 10px;
            border-radius: 0px 10px 10px 0px;
            background-color: #C4C4C4;

            font-size: 14px;
            color: black;
        }
        .tambah {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 87%;
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
            max-height:20vw; /* ubah untuk menyesuaikan tinggi tabel */
            width: 100%;
        }
        th {
            height: 40px;
            background: #F5F5F5;
        }
        td {
            height: 30px;
        }
        tr:nth-child(odd) {
            background : #C4C4C4;
        }
        tr:nth-child(even) {
            background : white;
        }
        td button {
            padding: 3px;
            width: 70px;

            background-color: #6A6363;
            border-radius: 10px;
            border: 0 solid;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);

            text-decoration: none;
            color: white;
            font-family: inherit;
            font-size: 12px;
        }
     
    </style>
</head>
<body> 
<?php
        if (isset($_GET["error"])) { /* ketika terdapat error */
            $error = $_GET["error"];
            if ($error == 1) {
                echo '<script type="text/javascript">','dberror();','</script>'; /* alert koneksi db error */
            } else {
                echo '<script type="text/javascript">','unknownerror();','</script>'; /* alert error tdk diketahui */
            }
        }

        if (isset($_GET["success"])) { /* ketika proses berhasil */
            $success = $_GET["success"];
            if ($success== 1) {
                echo '<script type="text/javascript">','tambahsuccess();','</script>'; /* alert berhasil tambah data */
            }if ($success== 2) {
                echo '<script type="text/javascript">','hapussuccess();','</script>'; /* alert berhasil tambah data */
            }
        }
    ?>
<div class="isi">
        <div class="judul"> <!-- judul page -->
            ATUR MEJA DAN KURSI
        </div>
    
        <div class="caridantambah">
            
            <div class="tambah"> <!-- button tambah -->
                <a href="L013.php">Tambah Meja</a>
            </div>
        </div>

        <div class="table"> <!-- table -->
        <?php
                $db = dbConnect();
                if ($db->connect_errno == 0) {
               $sql = "SELECT m.no_meja, m.status, p.id_pelanggan, p.nama_pelanggan, p.jml_pelanggan
               FROM meja_dan_kursi m LEFT JOIN pelanggan p ON m.id_pelanggan=p.id_pelanggan";
                $res = $db->query($sql);
                    if ($res) {
                        ?>
            <table cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th width="60px">No Meja</th>
                        <th width="50px">Id Pelanggan</th>
                        <th width="70px">Status</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                <?php
                            $data = $res->fetch_all(MYSQLI_ASSOC); // ambil seluruh baris data
                            foreach ($data as $barisdata) { // telusuri satu per satu
                            ?>
                             <tr>
                                <td align=center><?php echo $barisdata["no_meja"];?></td>
                                <td align=center><?php echo $barisdata["id_pelanggan"];?></td>
                                <td align=center><?php echo $barisdata["status"];?></td>
                                <td align="center" width="70px">
                                    <a href="L014.php?no_meja=<?php echo $barisdata["no_meja"]; ?>"><button>
                                    Isi Meja</button></a></td>
                                <td align="center" width="70px">
                                    <a href="kosongkan-konfirmasi.php?no_meja=<?php echo $barisdata["no_meja"]; ?>"><button>
                                    Kosongkan</button></a></td>
                                 <td align="center" width="70px">
                                    <a href="L015.php?no_meja=<?php echo $barisdata["no_meja"]; ?>"><button>
                                    Edit</button></a></td>
                                <td align="center" width="70px">
                                <a href="hapusmeja-konfirmasi.php?no_meja=<?php echo $barisdata["no_meja"]; ?>"><button>
                                    Hapus</button></a></td>
                                
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <?php
                        $res->free();
                            } else
                                echo "Gagal Eksekusi SQL" . (DEVELOPMENT ? " : " . $db->error : "") . "<br>";
                            } else
                                echo "Gagal koneksi" . (DEVELOPMENT ? " : " . $db->connect_error : "") . "<br>";
                    ?>
        </div>
    </div>
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
