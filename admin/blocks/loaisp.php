<?php
require("../../thuvien/database.php");
require("../../thuvien/trangadmin.php");


$idTL=$_GET['idTL'];
$loaisp=danhsachloaisanphamtheotheloai($idTL);

while($row=mysql_fetch_array($loaisp))
{
	?>
	<option value="<?=$row['idloaiSP']?>"><?=$row['tenloaiSP']?></option>
	<?php
}



?>