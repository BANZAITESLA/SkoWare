<?php
    session_start();
    include_once("functions.php");

    $db = dbConnect();
    if($db-> connect_errno == 0) { /* ketika koneksi db sukses */
        if(isset($_POST['simpan'])) { /* ketika tombol simpan diklik */
            $file = cekUpload();
            if($file) {
                $id_pesanan = $db->escape_string($_POST['id']);
                $nama_pelanggan = $db->escape_string($_POST['nama']);
                $jml_pelanggan = $db->escape_string($_POST['jumlah']);
                $waktu_datang = $db->escape_string($_POST['waktu']);
                
                
                $sql = "INSERT INTO pelanggan VALUES ('$idmenu', '$namamenu', '$parseharga', '$stok', '$file', '$id_pegawai')INSERT INTO pelanggan VALUES ('','DEA','2');
						INSERT INTO pembayaran(id_pelanggan) SELECT MAX(id_pelanggan) FROM pelanggan;
						INSERT INTO waiting_list(id_pesanan) SELECT MAX(id_pesanan) FROM pembayaran;
						UPDATE waiting_list SET waktu_datang = '2021-03-22 07:00:00', no_telp='08765' WHERE id_pesanan = (SELECT MAX(id_pesanan) FROM pembayaran);";
				
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