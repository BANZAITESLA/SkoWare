<?php
    include_once("functions.php");
    $db = dbConnect();

    if($db->connect_errno==0){ /* ketika koneksi db success */
        $sql = "SELECT * FROM detail_pesanan, menu_minuman WHERE detail_pesanan.id_menu = menu_minuman.id_menu AND `status` = 'Belum' AND qty > 0";
        $res=$db->query($sql);
        if($res) {
            $data=$res->fetch_all(MYSQLI_ASSOC);
            foreach($data as $barisdata){ /* looping untuk menampilkan hasil query */
?>
                <div class="grid-menu">
                    <div class="tulisan">
                        <div class="isi-menu">
                            <button id="pesan=<?php echo $barisdata["id_pesanan"];?>">
                                ID Pesanan : <?php echo $barisdata["id_pesanan"];?><br>
                                <strong><?php echo $barisdata["nama_menu"];?></strong><br>
                                Qty : <?php echo $barisdata["qty"];?>
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById("pesan=<?php echo $barisdata["id_pesanan"];?>").addEventListener('click', function() { /* ketika button hapus diklik */
                        Swal.fire({ /* validasi hapus data */
                            icon : 'question',
                            title : 'Konfirmasi',
                            text : 'Pesanan sudah Selesai?',
                            confirmButtonText: 'Ya',
                            confirmButtonColor: '#DA4453',
                            showCancelButton : true,
                            cancelButtonText: 'Belum',
                            cancelButtonColor: '#6A6363'
                        }).then((result) => {
                            if (result.isConfirmed) { /* jika user mengklik 'Hapus' */
                                $(function(){
                                    $.ajax ({ /* ajax hapus sesuai id menu */
                                        type: 'POST',
                                        url : "KK-detail-pesan.php?id_menu=<?php echo $barisdata["id_menu"];?>&pesan=<?php echo $barisdata["id_pesanan"];?>"
                                    })
                                })
                                Swal.fire({
                                    icon : 'success',
                                    title : 'Berhasil',
                                    text : 'Data Telah disimpan.',
                                    confirmButtonText : 'Ok',
                                    confirmButtonColor : '#6A6363'
                                }).then((result) => { /* jika proses berhasil maka load table kembali */
                                    $(document).ready(function(){
                                        $('.grid-container ').load("L009.php");
                                    })
                                })
                            }
                        })
                    })
                </script>
                
<?php
            }
            $res->free();
        }
    }
?>