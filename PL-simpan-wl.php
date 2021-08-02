<?php
    session_start();
    include_once("functions.php");

    $db = dbConnect();
    if($db-> connect_errno == 0) { /* ketika koneksi db sukses */
        if(isset($_POST['TblSimpan'])) { /* ketika tombol simpan diklik */
         
            $nama_pelanggan = $db->escape_string($_POST["nama_pelanggan"]);
            $jml_pelanggan = $db->escape_string($_POST["jml_pelanggan"]);
            $no_telp = $db->escape_string($_POST["no_telp"]);
            $waktu_datang = $db->escape_string($_POST.date('d-m-Y H:i:s'));
                
           
            $sql1 = "INSERT INTO pelanggan(nama_pelanggan, jml_pelanggan) VALUES ('$nama_pelanggan','$jml_pelanggan')";
            $sql2 = "INSERT INTO pesanan(id_pelanggan) SELECT MAX(id_pelanggan) FROM pelanggan";
           // $sql3 = "INSERT INTO pesanan(no_telp, waktu_datang) VALUES ('$no_telp','$waktu_datang')";
           
            $insert1 = $db->query($sql1);
            $insert2 = $db->query($sql2);
           //$insert3 = $db->query($sql3);

            if($insert1 && $insert2) {
                $url = 'L016.php?success=1';
                redirect($url);
            } else {
                $url = 'PL-tambah-wl.php?error=1';  //tambah data gagal. sql
                redirect($url);
            }
        } 
    } else {
        $url = 'L016.php?error=1';  /* koneksi db gagal */
        redirect($url);
    }
?>