<?php
	require("../../thuvien/database.php");
	require("../../thuvien/trangadmin.php");
	
?>
<?php
	$idloaiSP = $_GET["idloaiSP"];
	settype($idloaiSP,"int");
	xoaloaisp($idloaiSP);
	header("location:../../index.php?p=listlsp");
?>