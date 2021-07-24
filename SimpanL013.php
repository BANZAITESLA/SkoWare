<?php
    session_start();
    include_once("functions.php");

    $db = dbConnect();
    if($db-> connect_errno == 0) { /* ketika koneksi db sukses */
        if(isset($_POST['simpan'])) { /* ketika tombol simpan diklik */
            $no_meja = $db->escape_string($_POST["no_meja"]);
            $status = $db->escape_string("Tersedia");
                
            $sql = "INSERT INTO meja_dan_kursi(no_meja, status) VALUES( '$no_meja', '$status')";
                $res = $db->query($sql);

                if($res) {
                    $url = 'L012.php?success=1';
                    redirect($url);
                } else {
                    $url = 'L013.php?error=1';  //tambah data gagal. sql
                    redirect($url);
                }
            
            } 
        }
     else {
        $url = 'L012.php?error=1';  /* koneksi db gagal */
        redirect($url);
    }
 
?>