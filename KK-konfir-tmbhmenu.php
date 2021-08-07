<?php
    session_start();
    include_once("functions.php");

    $db = dbConnect();
    if($db-> connect_errno == 0) { /* ketika koneksi db sukses */
        if(isset($_POST['simpan'])) { /* ketika tombol simpan diklik */
            $idmenu = $db->escape_string($_POST['id']);
            $namamenu = $db->escape_string($_POST['nama']);
            $harga = $db->escape_string($_POST['harga']);
            $parseharga = str_replace('.', '', str_replace('Rp', '', $harga));
            $stok = $db->escape_string($_POST['stok']);
            $id_pegawai = $db->escape_string($_SESSION['id_pegawai']);

            if($idmenu == '') {
                $url = 'koki-tambah-menu.php?error=3';  //id kosong
                redirect($url);
            } else {
                $file = cekUpload();
                if($file) {
                    $sql = "INSERT INTO menu_minuman VALUES ('$idmenu', '$namamenu', '$parseharga', '$stok', '$file', '$id_pegawai')";
                    $res = $db->query($sql);

                    if($res) {
                        $url = 'dkoki.php?success=1';
                        redirect($url);
                    } else {
                        $url = 'koki-tambah-menu.php?error=1';  //tambah data gagal. sql
                        redirect($url);
                    }
                } else {
                    $url = 'koki-tambah-menu.php?error=2';  /* upload gagal */
                    redirect($url);
                }
            } 
        } 
    } else {
        $url = 'dkoki.php?error=1';  /* koneksi db gagal */
        redirect($url);
    }

    function cekUpload() { /* function untuk memvalidasi upload gambar */
        $namafile = $_FILES['file']['name'];
        $error = $_FILES['file']['error'];
        $tmpName = $_FILES['file']['tmp_name'];
        $extValid = ['png', 'jpeg', 'jpg'];
        $size = $_FILES['file']['size'];
        $ext = explode('.', $namafile);
        $ext = strtolower(end($ext));

        if(!in_array($ext, $extValid)) {
            return false;
        }

        if($size > 5000000) {
            return false;
        }
        move_uploaded_file($tmpName, 'gambar/'.$namafile);
        return $namafile;
    }
?>