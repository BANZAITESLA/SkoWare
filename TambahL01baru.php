<?php
    include_once("functions.php");
    $db = dbConnect();

    if ($db->connect_errno == 0) {
        $id = $_POST["id_pesanan"];
        $meja = $_POST["no_meja"];
        $menu = $_POST["id_menu"];
        $qty = $_POST["qty"];
        if(isset($_POST["tambah"])) {
            $sql = "UPDATE detail_pesanan, pesanan, meja_dan_kursi SET qty = '$qty', sub_total = $qty*(SELECT harga_item FROM menu_minuman WHERE id_menu = '$menu') WHERE detail_pesanan.id_pesanan = pesanan.id_pesanan AND pesanan.id_pesanan = meja_dan_kursi.id_pesanan AND no_meja = '$meja' AND id_menu = '$menu'";
        } else {
            $status = getStatus($id, $menu);
            if($status['status'] == 'Selesai') {
                $sql = "INSERT INTO detail_pesanan VALUES ('$id', '$menu', '$qty', $qty*(SELECT harga_item FROM menu_minuman WHERE id_menu = '$menu'), 'Belum')";
            } else {
                $sql = "UPDATE detail_pesanan SET qty = qty + '$qty', sub_total = qty*(SELECT harga_item FROM menu_minuman WHERE id_menu = '$menu') WHERE id_pesanan = '$id' AND id_menu = '$menu'";
            }
            
        }

        $kurang = "UPDATE menu_minuman SET stok = stok - $qty WHERE id_menu = '$menu'";
        $res=$db->query($sql);
        $reskurang=$db->query($kurang);
        if($res) {
            $url = "L01baru.php?meja=$meja&success=1";
            redirect($url);
        } else {
            $url = "L01baru.php?meja=$meja&error=3";
            redirect($url);
        }
    } else {
        $url = "L01baru.php?meja=$meja&error=1";
        redirect($url);
    }
?>