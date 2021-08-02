<?php
    include_once("sidebar-header.php");
    sidehead("skasir.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
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
        .ket {
            margin-top: 20px;
        }
        .ket td {
            background-color: #F5F5F5;
            font-weight: bold;
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
        td .button {
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
        .form {
            display: inherit;
        }
        .selesai button {
            position: fixed;
            padding: 8px;
            bottom: 40px;
            right: 50px;

            background-color: #6A6363;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            color: white;
            border: 0 solid;
            font-family: inherit;
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
            }
        }
    ?>
    <div class="isi">
        <div class="judul"> <!-- judul page -->
            DETAIL PEMBAYARAN
        </div>
        <div class="table" id="table"> <!-- table -->
            <?php
                $db = dbConnect();
                if ($db->connect_errno == 0) {
                    if(isset($_GET['pesan'])) { /* ketika ada input cari */
                        $pesan = $_GET["pesan"]; 
                        $meja = $_GET["meja"];
                        $total = "UPDATE pesanan SET total = (SELECT SUM(sub_total) FROM detail_pesanan WHERE id_pesanan = '$pesan') WHERE id_pesanan = '$pesan'";
                        $hapus = "DELETE FROM detail_pesanan WHERE qty = 0 AND id_pesanan = '$pesan'";
                        $sql = "SELECT detail_pesanan.id_menu, nama_menu, harga_item, qty, sub_total FROM detail_pesanan, menu_minuman WHERE detail_pesanan.id_menu = menu_minuman.id_menu AND detail_pesanan.id_pesanan = '$pesan'";
                        $restotal = $db->query($total);
                        $reshapus = $db->query($hapus);
                        $res = $db->query($sql);
                        if ($res) {
                            if($datapesanan=getDataPesanan($pesan)) {
            ?>
                                <table class="ket" cellspacing="0" cellpadding="5">
                                    <tr>
                                        <td width="140px">No Meja</td>
                                        <td width="5px">:</td>
                                        <td><?php echo $meja;?></td>
                                        <td width="140px">Atas Nama</td>
                                        <td width="5px">:</td>
                                        <td><?php echo $datapesanan["nama_pelanggan"];?></td>
                                    </tr>
                                    <tr>
                                        <td width="140px">ID Pesanan</td>
                                        <td width="5px">:</td>
                                        <td><?php echo $datapesanan["id_pesanan"];?></td>
                                        <td width="140px">Jumlah Pelanggan</td>
                                        <td width="5px">:</td>
                                        <td><?php echo $datapesanan["jml_pelanggan"];?></td>
                                    </tr>
                                </table>
                                <table class="table" cellspacing="0" cellpadding="5">
                                    <thead>
                                        <tr>
                                            <th>Nama Menu</th>
                                            <th width="150px">Harga Item</th>
                                            <th width="50px">Qty</th>
                                            <th width="150px">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            <?php
                                        $data = $res->fetch_all(MYSQLI_ASSOC); // ambil seluruh baris data
                                        foreach ($data as $barisdata) { // telusuri satu per satu
            ?>
                                            <tr>
                                                <td align=left><?php echo $barisdata["nama_menu"];?></td>
                                                <td align=right width="150px"><?php echo "Rp ".number_format($barisdata["harga_item"],0,",",".");?></td>
                                                <td align=right width="50px"><?php echo $barisdata["qty"];?></td>
                                                <td align=right width="150px"><?php echo "Rp ".number_format($barisdata["sub_total"],0,",",".");?></td>
                                            </tr>
                                    </tbody>
            <?php
                                        }
            ?>
                                    <tfoot>
                                        <tr>
                                            <td align=right colspan="4" style='background-color:#998F8F'><strong>Total</strong></td>
                                            <td align=right width="150px" style='background-color:#998F8F'><strong><?php echo "Rp ".number_format($datapesanan["total"],0,",",".");?></strong></td>
                                        </tr>
                                    </tfoot>
            <?php
                            }
            ?>
                                </table>
                                <div class="selesai" id="selesai">
                                    <button>Pembayaran Selesai</button>
                                </div>
            <?php
                        }
                        $res->free();
                    }
                }
            ?>
        </div>
    </div>
    <script>
        document.getElementById("selesai").addEventListener('click', function() { /* ketika button hapus diklik */
            Swal.fire({ /* validasi hapus data */
                icon : 'question',
                title : 'Konfirmasi',
                text : 'Pembayaran Selesai?',
                confirmButtonText: 'Ya',
                confirmButtonColor: '#DA4453',
                showCancelButton : true,
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#6A6363'
            }).then((result) => {
                if (result.isConfirmed) { /* jika user mengklik 'Hapus' */
                    $(function(){
                        $.ajax ({ /* ajax hapus sesuai id menu */
                            type: 'POST',
                            url : "KS-konfir-bayar.php?pesan=<?php echo $pesan;?>&meja=<?php echo $meja;?>"
                        })
                    })
                    Swal.fire({
                        icon : 'success',
                        title : 'Berhasil',
                        text : 'Data telah diupdate.',
                        confirmButtonText : 'Ok',
                        confirmButtonColor : '#6A6363'
                    }).then((result) => { /* jika proses berhasil maka load table kembali */
                        window.location.replace("pembayaran.php");
                    })
                }
            })
        })
    </script>
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
