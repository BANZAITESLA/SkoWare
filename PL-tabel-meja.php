<?php
    include_once("functions.php");
    $db = dbConnect();
?>
<div class="table" id="table"> <!-- table -->
    <?php
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT m.no_meja, m.status, b.id_pesanan FROM meja_dan_kursi m LEFT JOIN pesanan b ON m.id_pesanan = b.id_pesanan";
            $res = $db->query($sql);
            if ($res) {
    ?>
                <table cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th width="">No Meja</th>
                            <th width="">Id Pesanan</th>
                            <th width="91px">Status</th>
                            <th width="503px">Aksi</th>
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
                                <td align=center class="status" width="50px"><?php echo $barisdata["status"];?></td>
                                <td align="center" width="50px">
                                    <form action="L014.php" method="post" class="form">
                                        <input type="hidden" name="no_meja" value="<?php echo $barisdata["no_meja"];?>"></input>
                                        <input class="button" name="isi" type="submit" <?php echo ($barisdata["id_pesanan"] != ""? "disabled style='background-color:#998F8F'" : "") ;?> value="Isi Meja">
                                    </form>
                                </td>
                                <td align="center" width="50px">
                                    <a href="#" id="kosong=<?php echo $barisdata["no_meja"];?>">
                                        <button class="button" <?php echo ($barisdata["id_pesanan"] == ""? "disabled style='background-color:#998F8F'" : "") ;?>>Kosongkan</button>
                                    </a>
                                </td>
                                <td align="center" width="50px">
                                    <a href="L01baru.php?meja=<?php echo $barisdata["no_meja"];?>">
                                        <button class="button" <?php echo ($barisdata["id_pesanan"] == ""? "disabled style='background-color:#998F8F'" : "") ;?>>Pesanan</button>
                                    </a>
                                </td>
                                <td align="center" width="50px">
                                    <form action="L015.php" method="post" class="form">
                                        <input type="hidden" name="no_meja" value="<?php echo $barisdata["no_meja"];?>"></input>
                                        <input type="hidden" name="id_pesanan" value="<?php echo $barisdata["id_pesanan"];?>"></input>
                                        <input class="button" name="edit" type="submit" <?php echo ($barisdata["id_pesanan"] == ""? "disabled style='background-color:#998F8F'" : "") ;?> value="Edit">
                                    </form>
                                </td>
                                <td align="center" width="50px">
                                    <a href="#" id="hapus=<?php echo $barisdata["no_meja"];?>">
                                        <button class="button">Hapus</button>
                                    </a>
                                </td>
                            </tr>

                            <script>
                                document.getElementById("kosong=<?php echo $barisdata["no_meja"];?>").addEventListener('click', function() { /* ketika button kosongkan diklik */
                                    Swal.fire({ /* validasi hapus data */
                                        icon : 'question',
                                        title : 'Konfirmasi',
                                        text : 'Yakin Kosongkan Meja?',
                                        confirmButtonText: 'Kosongkan',
                                        confirmButtonColor: '#DA4453',
                                        showCancelButton : true,
                                        cancelButtonText: 'Tidak',
                                        cancelButtonColor: '#6A6363'
                                    }).then((result) => {
                                        if (result.isConfirmed) { /* jika user mengklik 'Hapus' */
                                            $(function(){
                                                $.ajax ({ /* ajax hapus sesuai id menu */
                                                    type: 'POST',
                                                    url : "PL-konfir-kosongmeja.php?no_meja=<?php echo $barisdata["no_meja"];?>"
                                                })
                                            })
                                            Swal.fire({
                                                icon : 'success',
                                                title : 'Berhasil',
                                                text : 'Meja telah dikosongkan.',
                                                confirmButtonText : 'Ok',
                                                confirmButtonColor : '#6A6363'
                                            }).then((result) => { /* jika proses berhasil maka load table kembali */
                                                $(document).ready(function(){
                                                    $('#table').load("PL-tabel-meja.php");
                                                })
                                            })
                                        }
                                    })
                                })
                                
                                document.getElementById("hapus=<?php echo $barisdata["no_meja"];?>").addEventListener('click', function() { /* ketika button kosongkan diklik */
                                    Swal.fire({ /* validasi hapus data */
                                        icon : 'question',
                                        title : 'Konfirmasi',
                                        text : 'Yakin Hapus Meja?',
                                        confirmButtonText: 'Hapus',
                                        confirmButtonColor: '#DA4453',
                                        showCancelButton : true,
                                        cancelButtonText: 'Tidak',
                                        cancelButtonColor: '#6A6363'
                                    }).then((result) => {
                                        if (result.isConfirmed) { /* jika user mengklik 'Hapus' */
                                            $(function(){
                                                $.ajax ({ /* ajax hapus sesuai id menu */
                                                    type: 'POST',
                                                    url : "PL-konfir-hapusmeja.php?no_meja=<?php echo $barisdata["no_meja"];?>"
                                                })
                                            })
                                            Swal.fire({
                                                icon : 'success',
                                                title : 'Berhasil',
                                                text : 'Data telah dihapus.',
                                                confirmButtonText : 'Ok',
                                                confirmButtonColor : '#6A6363'
                                            }).then((result) => { /* jika proses berhasil maka load table kembali */
                                                $(document).ready(function(){
                                                    $('#table').load("PL-tabel-meja.php");
                                                })
                                            })
                                        }
                                    })
                                })
                            </script>
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