<?php
	include_once("functions.php");
	$pesan=$_GET["pesan"];
    $meja = $_GET["meja"];
	$db=dbConnect();
	$update				= "UPDATE pesanan SET tgl_bayar = CURRENT_TIMESTAMP WHERE id_pesanan = '$pesan'";
	$hapus 				= "DELETE FROM detail_pesanan WHERE qty = 0 AND id_pesanan = '$pesan'";
	$sql			    = "UPDATE meja_dan_kursi SET id_pesanan = NULL, `status`='Tersedia' WHERE no_meja = '$meja'"; /* hapus data menu */
	$resupdate			= $db->query($update);
	$reshapus 			= $db->query($hapus);
	$res			    = $db->query($sql);
	$data			    = $res->fetch_all(MYSQLI_ASSOC);
?>