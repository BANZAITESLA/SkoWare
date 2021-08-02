<?php
    session_start();
    include_once("functions.php");

    $db = dbConnect();
    $sql = "SELECT b.id_pesanan, b.tgl_bayar, b.waktu_datang, b.no_telp, b.total, 
    p.id_pelanggan, p.nama_pelanggan, p.jml_pelanggan
    FROM pesanan b LEFT JOIN pelanggan p ON b.id_pelanggan=p.id_pelanggan";
    if($db-> connect_errno == 0) {
        if(isset($_POST['TblUpdate'])) {
            $id_pesanan = $db->escape_string($_POST["id_pesanan"]);
			$id_pelanggan = $db->escape_string($_POST["id_pelanggan"]);
			$nama_pelanggan = $db->escape_string($_POST["nama_pelanggan"]);
            $no_telp = $db->escape_string($_POST["no_telp"]);
			$jml_pelanggan = $db->escape_string($_POST["jml_pelanggan"]);

			$sql1 = "UPDATE pesanan SET no_telp = $no_telp WHERE id_pesanan = '$id_pesanan'";
            $sql2 = "UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', jml_pelanggan = '$jml_pelanggan' WHERE id_pelanggan = '$id_pelanggan'";

            $update = $db->query($sql);
            $updatedua = $db->query($sql2);
			if($update && $updatedua) {
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