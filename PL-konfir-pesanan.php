<?php
    include_once("functions.php");
    $db = dbConnect();
?>
<div class="table" id="table"> <!-- table -->
    <?php
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            if(isset($_POST['query'])) { /* ketika ada input cari */
                $cari = $db->escape_string($_POST["query"]);
                $total = "UPDATE pesanan SET total = (SELECT SUM(sub_total) FROM detail_pesanan WHERE id_pesanan = '$cari') WHERE id_pesanan = '$cari'"; 
                $sql = "SELECT detail_pesanan.id_menu, nama_menu, harga_item, qty, sub_total FROM detail_pesanan, menu_minuman WHERE detail_pesanan.id_menu = menu_minuman.id_menu AND detail_pesanan.id_pesanan = '$cari' AND qty > 0";
                $restotal = $db->query($total);
                $res = $db->query($sql);
                if ($res) {
                    if($datapesanan=getDataPesanan($cari)) {
    ?>
                        <table class="ket" cellspacing="0" cellpadding="5">
                            <tr>
                                <td width="140px">Tanggal Bayar</td>
                                <td width="5px">:</td>
                                <td><?php echo $datapesanan["tgl_bayar"];?></td>
                                <td width="140px">Atas Nama</td>
                                <td width="5px">:</td>
                                <td><?php echo $datapesanan["nama_pelanggan"];?></td>
                            </tr>
                            <tr>
                                <td width="140px">Waktu Kedatangan</td>
                                <td width="5px">:</td>
                                <td><?php echo $datapesanan["tanggal"]." ".$datapesanan["waktu"];?></td>
                                <td width="140px">No. Telepon</td>
                                <td width="5px">:</td>
                                <td><?php echo $datapesanan["no_telp"];?></td>
                            </tr>
                        </table>
                        <table cellspacing="0" cellpadding="5">
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
                                        <td align=center width="50px"><?php echo $barisdata["qty"];?></td>
                                        <td align=right width="150px"><?php echo "Rp ".number_format($barisdata["sub_total"],0,",",".");?></td>
                                    </tr>
    <?php
                                }
    ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td align=right colspan="4" style='background-color:#998F8F'><strong>Total</strong></td>
                                    <td align=right width="150px" style='background-color:#998F8F'><strong><?php echo "Rp ".number_format($datapesanan["total"],0,",",".");?></strong></td>
                                </tr>
                            </tfoot>
    <?php
                    } else {
                        echo '<script type="text/javascript">','nodata();','</script>'; /* alert untuk data tidak ditemukan */
                    }
    ?>
                    </table>
    <?php
                } else {
                    echo '<script type="text/javascript">','nodata();','</script>'; /* alert untuk data tidak ditemukan */
                }
                $res->free();
            }
        } else {
            echo '<script type="text/javascript">','dberror();','</script>'; /* alert koneksi db error */
        }
    ?>
</div>