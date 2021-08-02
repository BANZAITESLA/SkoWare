<?php
	include_once("functions.php");
	$id_pesanan=$_GET["id_pesanan"];
	$db=dbConnect();
	$sql    = "DELETE FROM pesanan WHERE id_pesanan = '$id_pesanan'"; /* hapus data menu */
	$res	= $db->query($sql);
	$data	= $res->fetch_all(MYSQLI_ASSOC);
?>