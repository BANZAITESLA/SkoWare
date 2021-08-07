<?php
    session_start();
    include_once("functions.php");

    $db = dbConnect();
    $sql = "SELECT m.no_meja, m.status, p.id_pelanggan, p.nama_pelanggan, p.jml_pelanggan
            FROM meja_dan_kursi m LEFT JOIN pelanggan p ON m.id_pelanggan=p.id_pelanggan";
    if($db-> connect_errno == 0) {
        if(isset($_POST['TblUpdate'])) {
            $no_meja = $db->escape_string($_POST["no_meja"]);
			$id_pelanggan = $db->escape_string($_POST["id_pelanggan"]);
			$nama_pelanggan = $db->escape_string($_POST["nama_pelanggan"]);
			$jml_pelanggan = $db->escape_string($_POST["jml_pelanggan"]);

			$sql = "UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', jml_pelanggan = '$jml_pelanggan' WHERE id_pelanggan = '$id_pelanggan'";

            $update= $db->query($sql);
            if($update) {
                $url = 'L012.php?success=1';
                redirect($url);
            } else {
                $url = 'L015.php?error='.$no_meja.'1';  //tambah data gagal. sql
                redirect($url);
            }
        } 
    } else {
        $url = 'L012.php?error=1';  /* koneksi db gagal */
        redirect($url);
    }
?>