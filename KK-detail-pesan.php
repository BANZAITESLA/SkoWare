<?php
	include_once("functions.php");
	$idmenu=$_GET["id_menu"];
    $idpesanan = $_GET["pesan"];
	$db=dbConnect();
	$sql1				= "UPDATE detail_pesanan SET `status` = 'Selesai' WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND status = 'Belum'";
	$sql2				= "INSERT into detail_pesanan VALUES ('$idpesanan','$idmenu',0,0,'Belum')";
	$res				= $db->query($sql1);
	$res2				= $db->query($sql2);
	
	$cek				= "SELECT * FROM detail_pesanan, meja_dan_kursi, menu_minuman WHERE detail_pesanan.id_pesanan = meja_dan_kursi.id_pesanan AND menu_minuman.id_menu = detail_pesanan.id_menu AND detail_pesanan.`status` = 'Selesai' AND detail_pesanan.id_pesanan = '$idpesanan' AND detail_pesanan.id_menu = '$idmenu'";
	$rescek				= $db->query($cek);
	if($rescek -> num_rows > 1) {
		$sql3			= "UPDATE detail_pesanan SET `status` = 'Selesai', qty = (SELECT SUM(qty) FROM detail_pesanan, meja_dan_kursi WHERE detail_pesanan.id_pesanan = meja_dan_kursi.id_pesanan AND detail_pesanan.`status` = 'Selesai' AND detail_pesanan.id_pesanan = '$idpesanan' AND detail_pesanan.id_menu = '$idmenu') WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND detail_pesanan.status = 'Selesai'";
		$sql4			= "DELETE FROM detail_pesanan WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND status = 'Selesai' LIMIT 1";	
		$sql5			= "UPDATE detail_pesanan SET sub_total = (SELECT qty FROM detail_pesanan WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND status = 'Selesai')*(SELECT harga_item FROM menu_minuman WHERE id_menu = '$idmenu') WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND status = 'Selesai'";
		$res3			= $db->query($sql3);
		$res4			= $db->query($sql4);
		$res5			= $db->query($sql5);
	}
	$data			    = $res->fetch_all(MYSQLI_ASSOC);
?>