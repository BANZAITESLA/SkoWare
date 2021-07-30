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
                $sql = "SELECT detail_pesanan.id_menu, nama_menu, harga_item FROM detail_pesanan, menu_minuman WHERE detail_pesanan.id_menu = menu_minuman.id_menu AND detail_pesanan.id_pesanan = '$cari'";
                $res = $db->query($sql);
                if ($res) {
                    ?>
                    <div class="b1">
                        <div class="tgl">Tanggal Bayar :</div>
                        <div class="atasnama">Atas Nama :</div>
                    </div>
                    <div class="b2">
                        <div class="tgl">Waktu kedatangan :</div>
                        <div class="tlp">No. Telepon :</div>
                    </div>
                    <table cellspacing="0" cellpadding="5">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>Harga Item</th>
                                <th width="50px">Qty</th>
                                <th width="300px">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                            $data = $res->fetch_all(MYSQLI_ASSOC); // ambil seluruh baris data
                            foreach ($data as $barisdata) { // telusuri satu per satu
                    ?>
                                <tr>
                                    <td align=center><?php echo $barisdata["nama_menu"];?></td>
                                    <td align=center ><?php echo $barisdata["harga_item"];?></td>
                                    <td align=center class="status"><?php echo $barisdata["status"];?></td>
                                    <td align="center" width="70px">
                                        <form action="L014.php" method="post" class="form">
                                            <input type="hidden" name="no_meja" value="<?php echo $barisdata["no_meja"];?>"></input>
                                            <input class="button" name="isi" type="submit" <?php echo ($barisdata["id_pelanggan"] != ""? "disabled style='background-color:#998F8F'" : "") ;?> value="Isi Meja">
                                        </form>
                                    </td>
                                    <td align="center" width="70px">
                                        <a href="#" id="kosong=<?php echo $barisdata["no_meja"];?>">
                                            <button class="button" <?php echo ($barisdata["id_pelanggan"] == ""? "disabled style='background-color:#998F8F'" : "") ;?>>Kosongkan</button>
                                        </a>
                                    </td>
                                    <td align="center" width="70px">
                                        <form action="L015.php" method="post" class="form">
                                            <input type="hidden" name="no_meja" value="<?php echo $barisdata["no_meja"];?>"></input>
                                            <input type="hidden" name="id_pelanggan" value="<?php echo $barisdata["id_pelanggan"];?>"></input>
                                            <input class="button" name="edit" type="submit" <?php echo ($barisdata["id_pelanggan"] == ""? "disabled style='background-color:#998F8F'" : "") ;?> value="Edit">
                                        </form>
                                    </td>
                                    <td align="center" width="70px">
                                        <a href="#" id="hapus=<?php echo $barisdata["no_meja"];?>">
                                            <button class="button">Hapus</button>
                                        </a>
                                    </td>
                                </tr>
    <?php
                                }
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