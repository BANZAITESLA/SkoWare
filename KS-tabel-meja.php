<?php
    include_once("functions.php");
    $db = dbConnect();
?>
<div class="table" id="table"> <!-- table -->
    <?php
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT m.no_meja, b.id_pesanan FROM meja_dan_kursi m LEFT JOIN pesanan b ON m.id_pesanan = b.id_pesanan WHERE m.status = 'Penuh'";
            $res = $db->query($sql);
            if ($res) {
    ?>
                <table cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th width="">No Meja</th>
                            <th width="">Id Pesanan</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
                        $data = $res->fetch_all(MYSQLI_ASSOC); // ambil seluruh baris data
                        foreach ($data as $barisdata) { // telusuri satu per satu
    ?>
                            <tr>
                                <td align=center width="60px"><?php echo $barisdata["no_meja"];?></td>
                                <td align=center width="60px"><?php echo $barisdata["id_pesanan"];?></td>
                                <td align="center" width="10px">
                                    <a href="detail-bayar.php?pesan=<?php echo $barisdata["id_pesanan"];?>&meja=<?php echo $barisdata["no_meja"];?>">
                                        <button class="button">Bayar</button>
                                    </a>
                                </td>
                            </tr>
    <?php
                        }
    ?>
                </table>
    <?php
                $res->free();
            }
        }
    ?>
</div>