<?php
    session_start(); /* session login dimulai */
    include_once('functions.php');

    $db = dbConnect(); /* cek koneksi db */
    if($db-> connect_errno == 0) {  /* jika koneksi success */
        if(isset($_POST['masuk'])) { /* jika button masuk diklik */
            $username = $db->escape_string($_POST['username']);
            $password = $db->escape_string($_POST['password']);

            $sql = "SELECT id_pegawai, nama_pegawai FROM pegawai WHERE id_pegawai = '$username' and `password` = md5('$password')";
            $res = $db->query($sql);

            if($res) { /* jika ada hasil dari query */
                if($res -> num_rows == 1) { /* hasil berisi 1 baris */
                    $data = $res -> fetch_assoc();
                    $_SESSION['id_pegawai'] = $data['id_pegawai'];
                    $_SESSION['nama_pegawai'] = $data['nama_pegawai'];
                    
                    $parse = substr($_SESSION['id_pegawai'], 0, 2);
                    if ($parse == 'KK') {
                        $url = 'dkoki.php'; /* dashboard koki */
                    } else if($parse == 'KS'){
                        $url = ''; /* dashboard kasir */
                    } else if($parse == 'PL'){
                        $url = 'L012.php'; /* dashboard pelayan */
                    } else {
                        $url = ''; /* dashboard pemilik*/
                    }
                    redirect($url);
                    
                } else {
                    /* notif password uname salah */
                    $url = 'login.php?error=1';
                    redirect($url);
                }
            }
        } else {
            /* notif login terlebih dahulu */
            $url = 'login.php?error=2';
            redirect($url);
        }
    } else {
        /* notif db eror */
        $url = 'login.php?error=3';
        redirect($url);
    }
?>

