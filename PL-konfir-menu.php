<?php
    include_once("functions.php");
    $db = dbConnect();

    if($db->connect_errno==0){ /* ketika koneksi db success */
        if(isset($_POST['query'])) { /* ketika ada input cari */
            $cari = $db->escape_string($_POST["query"]); 
            $sql = "SELECT * FROM menu_minuman WHERE stok > 0 AND nama_menu LIKE '%".$cari."%'";
        } else { /* ketika tidak ada input cari */
            $sql = "SELECT * FROM menu_minuman WHERE stok > 0";
        }
        $res=$db->query($sql);
        if($res) {
            $data=$res->fetch_all(MYSQLI_ASSOC);
            foreach($data as $barisdata){ /* looping untuk menampilkan hasil query */
?>
                <div class="grid-menu">
                    <div class="isi-menu"><img src="gambar/<?php echo $barisdata['gambar'];?>" width="100" height="100"></div>
                    <div class="tulisan">
                        <div class="isi-menu" id="nama"><?php echo $barisdata["nama_menu"];?></div>
                        <div class="isi-menu"><?php echo "Rp ".number_format($barisdata["harga_item"],0,",",".");?></div>
                    </div>
                </div>
<?php
            }
        } else {
            echo '<script type="text/javascript">','nodata();','</script>'; /* alert untuk data tidak ditemukan */
        }
        $res->free();
    } else {
        echo '<script type="text/javascript">','dberror();','</script>'; /* alert koneksi db error */
    }
?>