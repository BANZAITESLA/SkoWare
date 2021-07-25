<?php
    session_start();
    include_once("functions.php");

    $db = dbConnect();
    if($db-> connect_errno == 0) { /* ketika koneksi db sukses */
        if(isset($_POST['TblSimpan'])) { /* ketika tombol simpan diklik */
            $no_meja = $db->escape_string($_POST["no_meja"]);
            $nama_pelanggan = $db->escape_string($_POST["nama_pelanggan"]);
            $jml_pelanggan = $db->escape_string($_POST["jml_pelanggan"]);
                
            $sql1 = "INSERT INTO pelanggan(nama_pelanggan, jml_pelanggan) VALUES ('$nama_pelanggan','$jml_pelanggan')";
            $sql2 = "UPDATE meja_dan_kursi SET id_pelanggan = (SELECT MAX(id_pelanggan)
					FROM pelanggan), status='Penuh' WHERE no_meja = $no_meja AND status = 'Tersedia'";
            $insert = $db->query($sql1);
            $update = $db->query($sql2);

			if($insert && $update) {
				$url = 'L012.php?success=1';
				redirect($url);
			} else {
				$url = 'L014.php?error=1';  //tambah data gagal. sql
				redirect($url);
			}
        } 
    } else {
        $url = 'L012.php?error=1';  /* koneksi db gagal */
        redirect($url);
    }
?>