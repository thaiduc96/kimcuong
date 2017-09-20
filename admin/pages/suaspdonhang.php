<?php
require("../../thuvien/database.php");
require("../../thuvien/trangadmin.php");
if(isset($_GET['idSP']))
{
	$idSP=$_GET['idSP'];
	$idDH=$_GET['idDH'];
	$soluong=$_GET['sl'];
	capnhatsoluongchitiet($idSP,$soluong,$idDH);
	header("Location: {$_SERVER['HTTP_REFERER']}");}		
?>	