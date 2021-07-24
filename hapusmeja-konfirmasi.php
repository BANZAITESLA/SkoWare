<?php
	include_once("functions.php");
	$no_meja=$_GET["no_meja"];
	$db=dbConnect();
	$sql			    ="DELETE FROM meja_dan_kursi WHERE no_meja='$no_meja'"; /* hapus data meja */
	$res			    =$db->query($sql);

	if($res) {
		$url = 'L012.php?success=2';
		redirect($url);
	} else {
$url = 'L012.php?error=1';  /* koneksi db gagal */
redirect($url);
}

?>