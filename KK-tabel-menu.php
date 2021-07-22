<?php
    include_once("functions.php");
    $db = dbConnect();
?>
<div class="table" id="table"> <!-- table -->
    <table cellspacing="0" cellpadding="5">
        <thead> <!-- header table -->
            <tr>
                <th>Nama Menu</th>
                <th width="50px">Stok</th>
                <th width="160px">Harga Item</th>
                <th width="120px">Aksi</th>
            </tr>
        </thead>
        <tbody> <!-- body table -->
            <?php
                if($db->connect_errno==0){ /* ketika koneksi db success */
                    if(isset($_POST['query'])) { /* ketika ada input cari */
                        $cari = $db->escape_string($_POST["query"]); 
                        $sql = "SELECT * FROM menu_minuman WHERE nama_menu LIKE '%".$cari."%'";
                    } else { /* ketika tidak ada input cari */
                        $sql = "SELECT * FROM menu_minuman";
                    }
                    $res=$db->query($sql);
                    if($res) {
                        $data=$res->fetch_all(MYSQLI_ASSOC);
                        foreach($data as $barisdata){ /* looping untuk menampilkan hasil query */
            ?>
                            <tr>
                                <td><?php echo $barisdata["nama_menu"];?></td>
                                <td align="right" width="50px"><?php echo $barisdata["stok"];?></td>
                                <td align="right" width="160px"><?php echo $barisdata["harga_item"];?></td>
                                <td align="center" width="120px">
                                    <a href="KK-edit-menu.php?id_menu=<?php echo $barisdata["id_menu"];?>"><button>Edit</button></a>
                                    <a href="#"><button id="hapus">Hapus</button></a>
                                    <input type="hidden" id="id_menu" value="<?php echo $barisdata["id_menu"];?>">
                                </td>
                            </tr>
            <?php
                        }
                        $res->free();
                    }
                } else {
                    $url = 'dkoki.php?error=1';  /* koneksi db gagal */
                    redirect($url);
                }
            ?>
        </tbody>
    </table>
</div>
<script>
    document.querySelector("#hapus").addEventListener('click', function() { /* ketika button hapus diklik */
        Swal.fire({ /* validasi hapus data */
            icon : 'question',
            title : 'Konfirmasi',
            text : 'Yakin Hapus Data?',
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
                        url : "KK-konfir-hapusmenu.php?id_menu=" + document.getElementById("id_menu").value
                    })
                })
                Swal.fire({
                    icon : 'success',
                    title : 'Berhasil',
                    text : 'Data Telah dihapus.',
                    confirmButtonText : 'Ok',
                    confirmButtonColor : '#6A6363'
                }).then((result) => { /* jika proses berhasil maka load table kembali */
                    $(document).ready(function(){
                        $('#table').load("KK-tabel-menu.php");
                    })
                })
            }
        })
    })
</script>