<?php
	include_once("functions.php");
	$idmenu=$_GET["id_menu"];
	$db=dbConnect();
    hapus($idmenu);
	$sql			    ="DELETE FROM menu_minuman WHERE id_menu ='".$db->escape_string($idmenu)."'"; /* hapus data menu */
	$res			    =$db->query($sql);
	$data			    =$res->fetch_all(MYSQLI_ASSOC);

    function hapus($idmenu) { /* function untuk menghapus gambar sesuai id */
        $db=dbConnect();
        $sqlgambar      ="SELECT gambar FROM menu_minuman WHERE id_menu='".$db->escape_string($idmenu)."'";
        $resgambar      =$db->query($sqlgambar);
        $datagambar     =$resgambar->fetch_row();
        unlink('gambar/'.$datagambar[0]);
    }
?>