<?php
    session_start();
    include_once("functions.php");
    $db = dbConnect();

    if($db-> connect_errno == 0) {
        if(isset($_POST['TblUpdate'])) {
            $id_pesanan = $db->escape_string($_POST["id_pesanan"]);
			$nama_pelanggan = $db->escape_string($_POST["nama_pelanggan"]);
            $no_telp = $db->escape_string($_POST["no_telp"]);
			$jml_pelanggan = $db->escape_string($_POST["jml_pelanggan"]);
            $waktu_datang = $_POST["tanggal"]." ".$_POST["waktu"];

			$sql1 = "UPDATE pesanan, pelanggan SET pelanggan.nama_pelanggan = '$nama_pelanggan', pelanggan.jml_pelanggan = '$jml_pelanggan', pesanan.waktu_datang = '$waktu_datang', pesanan.no_telp = '$no_telp' WHERE pesanan.id_pelanggan = pelanggan.id_pelanggan AND id_pesanan = '$id_pesanan'";

            $update = $db->query($sql1);
			if($update) {
				$url = 'L016.php?success=1';
				redirect($url);
			} else {
				$url = 'PL-edit-wl.php?error='.$id_pesanan.'1';  //tambah data gagal. sql
				redirect($url);
			}  
        } 
    } else {
        $url = 'L016.php?error=1';  /* koneksi db gagal */
        redirect($url);
    }
?>