<?php
    include_once("sidebar-header.php");
    sidehead("sowner.php");
    include_once("functions.php");
    $db = dbConnect();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
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
            display: block;
            text-align: center;

            font-weight: bold;
            font-size: 20px;
            letter-spacing: 10px;
        }
        .tgl {
            margin-top: 10px;
            font-size: 18px;
            letter-spacing: 5px;
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
            max-height:24vw; /* ubah untuk menyesuaikan tinggi tabel */
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
    </style>
</head>
<body>
    <div class="isi">
        <div class="judul"> <!-- judul page -->
            LAPORAN PENDAPATAN PERIODIK RESTORAN<br>
                <div class="tgl">
                    <?php
                        setlocale(LC_ALL, 'id-ID', 'id_ID');
                        $date = strftime("%Y");

                        echo $date;
                    ?>
                </div>
        </div>

        <div class="table" id="table"> <!-- table -->
            <table cellspacing="0" cellpadding="5">
                <thead> <!-- header table -->
                    <tr>
                        <th>Bulan</th>
                        <th>Kas Masuk</th>
                    </tr>
                </thead>
                <tbody> <!-- body table -->
                    <?php
                        if($db->connect_errno==0){ /* ketika koneksi db success */
                            $sql = "SELECT MONTH(tgl_bayar) AS bulan, SUM(total) AS total FROM pesanan WHERE YEAR(tgl_bayar) = '$date' group by MONTH(tgl_bayar)";
                            $res=$db->query($sql);
                            if($res) {
                                $data=$res->fetch_all(MYSQLI_ASSOC);
                                foreach($data as $barisdata){ /* looping untuk menampilkan hasil query */
                    ?>
                                    <tr>
                                        <td><?php echo (strftime("%B", mktime($barisdata["bulan"])));?></td>
                                        <td align="right"><?php echo "Rp ".number_format($barisdata["total"],0,",",".");?></td>
                                    </tr>
                    <?php
                                }
                                $res->free();
                            }
                    ?>
                </tbody>
                <tfoot>
                    <?php
                        $sql2 = "SELECT SUM(total) AS total FROM pesanan WHERE YEAR(tgl_bayar) = '$date'";
                        $res2=$db->query($sql2);
                        if($res2) {
                            $data=$res2->fetch_all(MYSQLI_ASSOC);
                            foreach($data as $barisdata){
                    ?>
                                <tr>
                                    <td align=right colspan="4" style='background-color:#998F8F'><strong>Total</strong></td>
                                    <td align=right width="150px" style='background-color:#998F8F'><strong><?php echo "Rp ".number_format($barisdata["total"],0,",",".");?></strong></td>
                                </tr>
                    <?php
                            }
                        }
                        $res2->free();
                    ?>
                </tfoot>
                    <?php
                        } else {
                            $url = 'OW-lapor-minggu.php?error=1';  /* koneksi db gagal */
                            redirect($url);
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>