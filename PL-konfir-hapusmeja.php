<?php
	include_once("functions.php");
	$nomeja=$_GET["no_meja"];
	$db=dbConnect();
	$sql    = "DELETE FROM meja_dan_kursi WHERE no_meja = '$nomeja'"; /* hapus data menu */
	$res	= $db->query($sql);
	$data	= $res->fetch_all(MYSQLI_ASSOC);
?>