<?php
	include_once("functions.php");
	$idmenu=$_GET["id_menu"];
    $idpesanan = $_GET["pesan"];
	$db=dbConnect();
	$sql			    ="UPDATE detail_pesanan SET `status` = 'Sampai' WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND `status` = 'Selesai'";
	$res			    =$db->query($sql);

	$cek				= "SELECT * FROM detail_pesanan, meja_dan_kursi, menu_minuman WHERE detail_pesanan.id_pesanan = meja_dan_kursi.id_pesanan AND menu_minuman.id_menu = detail_pesanan.id_menu AND detail_pesanan.`status` = 'Sampai' AND detail_pesanan.id_pesanan = '$idpesanan' AND detail_pesanan.id_menu = '$idmenu'";
	$rescek				= $db->query($cek);
	if($rescek -> num_rows > 1) {
		$sql3			= "UPDATE detail_pesanan SET qty = (SELECT SUM(qty) FROM detail_pesanan, meja_dan_kursi WHERE detail_pesanan.id_pesanan = meja_dan_kursi.id_pesanan AND detail_pesanan.`status` = 'Sampai' AND detail_pesanan.id_pesanan = '$idpesanan' AND detail_pesanan.id_menu = '$idmenu') WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND detail_pesanan.status = 'Sampai'";
		$sql4			= "DELETE FROM detail_pesanan WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND status = 'Sampai' LIMIT 1";	
		$sql5			= "UPDATE detail_pesanan SET sub_total = (SELECT qty FROM detail_pesanan WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND status = 'Sampai')*(SELECT harga_item FROM menu_minuman WHERE id_menu = '$idmenu') WHERE id_pesanan = '$idpesanan' AND id_menu = '$idmenu' AND status = 'Sampai'";
		$res3			= $db->query($sql3);
		$res4			= $db->query($sql4);
		$res5			= $db->query($sql5);
	}
	$data			    =$res->fetch_all(MYSQLI_ASSOC);
?>