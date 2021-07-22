<?php
    session_start();
    include_once("functions.php");

    $db = dbConnect();
    if($db-> connect_errno == 0) {
        if(isset($_POST['simpan'])) {
            $idmenu = $db->escape_string($_POST['id']);
            $file = cekUpload();
            if($file) {
                $namamenu = $db->escape_string($_POST['nama']);
                $harga = $db->escape_string($_POST['harga']);
                $parseharga = str_replace('.', '', str_replace('Rp', '', $harga));
                $stok = $db->escape_string($_POST['stok']);
                $id_pegawai = $db->escape_string($_SESSION['id_pegawai']);

                $sql = "UPDATE menu_minuman SET nama_menu = '$namamenu', harga_item = '$parseharga', stok = '$stok', gambar = '$file', id_pegawai = '$id_pegawai' WHERE id_menu = '$idmenu'";
                $res = $db->query($sql);

                if($res) {
                    $url = 'dkoki.php?success=1';
                    redirect($url);
                } else {
                    $url = 'KK-edit-menu.php?error='.$idmenu.'1';  //tambah data gagal. sql
                    redirect($url);
                }
            } else {
                $url = 'KK-edit-menu.php?error='.$idmenu.'2';  /* upload gagal */
                redirect($url);
            } 
        } 
    } else {
        $url = 'dkoki.php?error=1';  /* koneksi db gagal */
        redirect($url);
    }

    function cekUpload() {
        $namafile = $_FILES['file']['name'];
        $error = $_FILES['file']['error'];
        $tmpName = $_FILES['file']['tmp_name'];
        $extValid = ['png', 'jpeg', 'jpg'];
        $size = $_FILES['file']['size'];
        $lama=$_POST['file_lama'];
        $ext = explode('.', $namafile);
        $ext = strtolower(end($ext));

        if(!in_array($ext, $extValid)) {
            return false;
        }

        if($size > 5000000) {
            return false;
        }
        unlink("gambar/".$lama);
        move_uploaded_file($tmpName, 'gambar/'.$namafile);
        return $namafile;
    }
?>