<?php
	include_once("functions.php");
	$idmenu=$_GET["id_menu"];
    $idpesanan = $_GET["pesan"];
	$db=dbConnect();
	$sql			    ="UPDATE detail_pesanan SET `status` = 'Sampai' WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu'";
	$res			    =$db->query($sql);
	$data			    =$res->fetch_all(MYSQLI_ASSOC);
?>