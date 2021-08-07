<?php
    session_start();
    include_once("functions.php");

    $db = dbConnect();
    if($db-> connect_errno == 0) { /* ketika koneksi db sukses */
        if(isset($_POST['TblSimpan'])) { /* ketika tombol simpan diklik */
            $nama_pelanggan = $db->escape_string($_POST["nama_pelanggan"]);
            $jml_pelanggan = $db->escape_string($_POST["jml_pelanggan"]);
            $no_telp = $db->escape_string($_POST["no_telp"]);
            $waktu_datang = $_POST["tanggal"]." ".$_POST["waktu"];

            $sql1 = "INSERT INTO pelanggan(nama_pelanggan, jml_pelanggan) VALUES ('$nama_pelanggan','$jml_pelanggan')";
            $sql2 = "INSERT INTO pesanan(id_pelanggan) SELECT MAX(id_pelanggan) FROM pelanggan";
            $sql3 = "UPDATE pesanan SET no_telp = '$no_telp', waktu_datang = '$waktu_datang' WHERE id_pesanan = (SELECT MAX(id_pesanan) FROM pesanan)";
            $sql4 = "INSERT INTO detail_pesanan(id_menu) SELECT menu_minuman.id_menu FROM menu_minuman";
            $sql5 = "UPDATE detail_pesanan SET id_pesanan = (SELECT MAX(id_pesanan) FROM pesanan) WHERE id_pesanan IS NULL";

            $insert1 = $db->query($sql1);
            $insert2 = $db->query($sql2);
            $insert3 = $db->query($sql3);
            $insert4 = $db->query($sql4);
            $insert5 = $db->query($sql5);

            if($insert1 && $insert2 && $insert3 && $insert4 && $insert5) {
                $url = 'L016.php?success=1';
                redirect($url);
            }
        } 
    } else {
        $url = 'L016.php?error=1';  /* koneksi db gagal */
        redirect($url);
    }
?>