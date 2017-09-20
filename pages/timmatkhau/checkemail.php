<?php
require("../thuvien/database.php");
require("../thuvien/trangchu.php");

$email=$_GET['emailtao'];

$e=checkemail($email);
$row=mysql_num_rows($e);
echo $row;
?>