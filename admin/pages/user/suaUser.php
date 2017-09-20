<?php
	require("../../../thuvien/database.php");
	require("../../../thuvien/trangadmin.php");
?>

<?php

	$idUser=$_GET['idUser'];
	$cap=$_GET['cap'];
	$ngaysua = date("Y-m-d");
	capnhatuser($idUser,$ngaysua,$cap);
	
	
?>