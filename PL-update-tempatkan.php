<?php
    session_start();
    include_once("functions.php");
    $db = dbConnect();

    if($db-> connect_errno == 0) {
        if(isset($_POST['TblUpdate'])) {
            $id_pesanan = $db->escape_string($_POST["id_pesanan"]);
            $no_meja    = $db->escape_string($_POST["no_meja"]);

            if($no_meja != 0) {
                $sql1 = "UPDATE meja_dan_kursi SET id_pesanan = '$id_pesanan', status = 'Penuh' WHERE no_meja = '$no_meja'";
                $sql2 = "UPDATE pesanan SET waktu_datang = NULL WHERE id_pesanan = '$id_pesanan'";

                $update1 = $db->query($sql1);
                $update2 = $db->query($sql2);
                if($update1 && $update2) {
                    $url = 'L016.php?success=1';
                    redirect($url);
                }
            } else {
                $url = 'L016.php?error=3';  /* koneksi db gagal */
                redirect($url);
            }
        } 
    } else {
        $url = 'L016.php?error=1';  /* koneksi db gagal */
        redirect($url);
    }
?>