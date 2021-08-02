<?php
    include_once("functions.php");
    $db = dbConnect();

    if ($db->connect_errno == 0) {
        if(isset($_POST["tambah"])) {
            $meja = $_POST["no_meja"];
            $menu = $_POST["id_menu"];
            $qty = $_POST["qty"];
    
            $tambah = "UPDATE detail_pesanan, pesanan, meja_dan_kursi SET qty = '$qty', sub_total = $qty*(SELECT harga_item FROM menu_minuman WHERE id_menu = '$menu') WHERE detail_pesanan.id_pesanan = pesanan.id_pesanan AND pesanan.id_pesanan = meja_dan_kursi.id_pesanan AND no_meja = '$meja' AND id_menu = '$menu'";
            $kurang = "UPDATE menu_minuman SET stok = stok - (SELECT qty FROM detail_pesanan, meja_dan_kursi WHERE meja_dan_kursi.id_pesanan = detail_pesanan.id_pesanan AND meja_dan_kursi.no_meja = '$meja' AND id_menu = '$menu') WHERE id_menu = '$menu'";
            $restambah=$db->query($tambah);
            $reskurang=$db->query($kurang);
    
            if($restambah) {
                $url = "L01baru.php?meja=$meja&success=1";
                redirect($url);
            } else {
                $url = "L01baru.php?meja=$meja&error=3";
                redirect($url);
            }
        } else {
            $url = "L01baru.php?meja=$meja&error=2";
            redirect($url);
        }
    } else {
        $url = "L01baru.php?meja=$meja&error=1";
        redirect($url);
    }
?>