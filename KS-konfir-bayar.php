<?php
	include_once("functions.php");
	$pesan=$_GET["pesan"];
    $meja = $_GET["meja"];
	$db=dbConnect();
	$sql			    ="UPDATE meja_dan_kursi SET id_pesanan = NULL, `status`='Tersedia' WHERE no_meja = '$meja'"; /* hapus data menu */
	$res			    =$db->query($sql);
	$data			    =$res->fetch_all(MYSQLI_ASSOC);
?>