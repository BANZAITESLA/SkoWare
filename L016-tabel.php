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
            $sql = "SELECT * FROM pesanan, pelanggan WHERE waktu_datang IS NOT NULL AND pesanan.id_pelanggan = pelanggan.id_pelanggan 
                    AND (id_pesanan LIKE '%".$cari."%' OR nama_pelanggan LIKE '%".$cari."%' OR waktu_datang LIKE '%".$cari."%' OR no_telp LIKE '%".$cari."%' OR jml_pelanggan LIKE '%".$cari."%')";
        } else { /* ketika tidak ada input cari */
            $sql = "SELECT * FROM pesanan, pelanggan WHERE waktu_datang IS NOT NULL AND pesanan.id_pelanggan = pelanggan.id_pelanggan";
        }
        $res = $db->query($sql);
        if ($res) {
?>
            <table cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                    <th width="60px">ID Pesanan</th>
                    <th width="126px">Nama Pelanggan</th>
                    <th width="128px">Waktu</th>
                    <th width="85px">No Telepon</th> 
                    <th width="55px">Jumlah Pelanggan</th>
                    <th width="173px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
<?php
                    $data = $res->fetch_all(MYSQLI_ASSOC); // ambil seluruh baris data
                    foreach ($data as $barisdata) { // telusuri satu per satu
?>
                        <tr>
                            <td align=center width="70px"><?php echo $barisdata["id_pesanan"];?></td>
                            <td align=center width="150px"><?php echo $barisdata["nama_pelanggan"];?></td>
                            <td align=center width="150px"><?php echo $barisdata["waktu_datang"];?></td>
                            <td align=center width="100px"><?php echo $barisdata["no_telp"];?></td>
                            <td align=center width="60px"><?php echo $barisdata["jml_pelanggan"];?></td>
                        
                            <td align="center" width="60px">
                                <a href="PL-tempatkan.php?id_pesanan=<?php echo $barisdata["id_pesanan"]; ?>">
                                    <button class="button">Tempatkan</button>
                                </a>
                            </td>
                            <td align="center" width="60px">
                                <a href="PL-edit-wl.php?id_pesanan=<?php echo $barisdata["id_pesanan"]; ?>">
                                    <button class="button">Edit</button>
                                </a>
                            </td>
                            <td align="center" width="60px">
                                <a href="#" id="hapus=<?php echo $barisdata["id_pesanan"];?>">
                                    <button class="button">Hapus</button>
                                </a>
                            </td>
                        </tr>

                        <script> 
                            document.getElementById("hapus=<?php echo $barisdata["id_pesanan"];?>").addEventListener('click', function() { /* ketika button kosongkan diklik */
                                Swal.fire({ /* validasi hapus data */
                                    icon : 'question',
                                    title : 'Konfirmasi',
                                    text : 'Yakin Hapus Pesanan?',
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
                                                url : "PL-konfir-hapuswaitinglist.php?id_pesanan=<?php echo $barisdata["id_pesanan"];?>"
                                            })
                                        })
                                        Swal.fire({
                                            icon : 'success',
                                            title : 'Berhasil',
                                            text : 'Pesanan telah dihapus.',
                                            confirmButtonText : 'Ok',
                                            confirmButtonColor : '#6A6363'
                                        }).then((result) => { /* jika proses berhasil maka load table kembali */
                                            $(document).ready(function(){
                                                $('#table').load("L016-tabel.php");
                                            })
                                        })
                                    }
                                })
                            })
                        </script>
<?php
                    }
?>
<?php
            $res->free();
        }
    }
?>
</table>