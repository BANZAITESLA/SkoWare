<?php
	include_once("functions.php");
	$nomeja=$_GET["no_meja"];
	$db=dbConnect();
	$sql    = "UPDATE meja_dan_kursi SET id_pesanan = NULL, status='Tersedia' WHERE no_meja='$nomeja'"; /* hapus data menu */
	$res	= $db->query($sql);
	$data	= $res->fetch_all(MYSQLI_ASSOC);
?>