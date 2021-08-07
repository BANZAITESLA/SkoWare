<?php
	include_once("functions.php");
	$nomeja=$_GET["no_meja"];
	$db=dbConnect();
	$sql    = "UPDATE meja_dan_kursi SET id_pesanan = NULL, status='Tersedia' WHERE no_meja='$nomeja'"; /* hapus data menu */
	$hapus 	= "DELETE FROM detail_pesanan, meja_dan_kursi WHERE detail_pesanan.id_pesanan = meja_dan_kursi.id_pesanan AND no_meja = '$nomeja' AND qty = '0'";
	$reshapus = $db->query($hapus);
	$res	= $db->query($sql);
	$data	= $res->fetch_all(MYSQLI_ASSOC);
?>