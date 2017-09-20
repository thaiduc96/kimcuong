<?php

include('kb_database.php');
/**
* 
*/
class trangadmin extends database
{

	function danhsachsanpham()
	{
		$sql="SELECT * FROM sanpham ORDER BY idSP DESC";
		
		return mysql_query($sql);
	}

	function danhsachtheloai()
	{
		$sql="SELECT * FROM theloai";
		return mysql_query($sql);
	}
	function danhsachloaisanpham()
	{
		$sql="SELECT * FROM loaisanpham";
		return mysql_query($sql);
	}

	function danhsachuser()
	{
		$sql="SELECT * FROM users";
		return mysql_query($sql);
	}

	function danhsachloaisanphamtheotheloai($idTL)
	{
		$sql="SELECT * FROM loaisanpham where idTL=$idTL";
		return mysql_query($sql);
	}

	function theloaitheoid($idTL)
	{
		$sql="SELECT * FROM theloai where idTL=$idTL";
		$row=mysql_fetch_array(mysql_query($sql));
		return $row['tenTL'];
	}

	function loaisanphamtheoid($idloaiSP)
	{
		$sql="SELECT * FROM loaisanpham where idloaiSP=$idloaiSP";
		$row=mysql_fetch_array(mysql_query($sql));
		return $row['tenloaiSP'];
	}

	function hinhchitiet($idSP)
	{
		$sql="SELECT * FROM hinh where idSP='$idSP'";
		return mysql_query($sql);
	}

	function xoasp($idSP)
	{
		$sql="DELETE FROM sanpham where idSP='$idSP'";
		return mysql_query($sql);
	}

	function themsp($idTL,$idloaiSP,$tenSP,$gia,$noidung,$khuyenmai,$soluong,$tomtat,$tenhinh,$anhien,$ngay)
	{
		$tenkhongdau=changeTitle($tenSP);
		$sql="INSERT INTO sanpham(idTL,idloaiSP,tenSP,gia,noidung,khuyenmai,soluong,tomtat,hinh,anhien,tenSP_khongdau,ngay)
		VALUES('$idTL','$idloaiSP','$tenSP','$gia','$noidung','$khuyenmai','$soluong','$tomtat','$tenhinh','$anhien','$tenkhongdau','$ngay')";
		return mysql_query($sql);
	}

	function themchitiet($trongluong,$chungloai,$tuoi,$mauchatlieu,$gioitinh,$mota)
	{
		$qr="SELECT * FROM SANPHAM ORDER BY idSP DESC LIMIT 0,1";
		$rt=mysql_fetch_array(mysql_query($qr));
		$idSP=$rt['idSP'];
		$sql="INSERT INTO chitiet(idSP,trongluong,chungloai,tuoi,mauchatlieu,gioitinh,mota) 
		values('$idSP','$trongluong','$chungloai','$tuoi','$mauchatlieu','$gioitinh','$mota')";
		return mysql_query($sql);
	}

	function sanphamvachitiettheoidSP($idSP)
	{
		$sql="SELECT * FROM sanpham join chitiet on sanpham.idSP=chitiet.idSP where sanpham.idSP='$idSP'";
		return mysql_query($sql);
	}

	function suasp($idSP,$idTL,$idloaiSP,$tenSP,$gia,$noidung,$khuyenmai,$soluong,$tomtat,$hinh,$anhien)
	{
		$sql="UPDATE sanpham set idTL='$idTL',idloaiSP='$idloaiSP',tenSP='$tenSP',gia='$gia',noidung='$noidung',khuyenmai='$khuyenmai',soluong='$soluong',tomtat='$tomtat',hinh='$hinh',anhien='$anhien' where idSP='$idSP'";
		return mysql_query($sql);
	}

	function loaisanphamtheotheloai($idTL)
	{
		$sql="SELECT * FROM loaisanpham where idTL='$idTL'";
		return mysql_query($sql);
	}

	function suachitiet($idSP,$trongluong,$chungloai,$tuoi,$mauchatlieu,$gioitinh,$mota)
	{
		$sql="UPDATE chitiet set trongluong='$trongluong',chungloai='$chungloai',tuoi='$tuoi',mauchatlieu='$mauchatlieu',gioitinh='$gioitinh',mota='$mota'
		where idSP='$idSP'";
		return mysql_query($sql);
	}

	function ChiTietTheLoai($idTL)
	{
		$sql="SELECT * FROM theloai where idTL=$idTL";
		return mysql_query($sql);
	}


	function themtheloai($tenTL,$thutu,$anhien,$tomtat)
	{
		$qr="INSERT INTO theloai VALUES('NULL','$tenTL','$thutu','$anhien','$tomtat')";
		return mysql_query($qr);
	}

	function xoatl($idTL)
	{
		$sql="DELETE FROM theloai where idTL='$idTL'";
		return mysql_query($sql);
	}

	function suatl($idTL,$tenTL,$thutu,$anhien,$tomtat)
	{
		$sql="UPDATE theloai set tenTL = '$tenTL',thutu = '$thutu',anhien='$anhien',tomtat ='$tomtat' where idTL = '$idTL'";
		return mysql_query($sql);
	}



	function dathang($xacnhan)
	{
		if($xacnhan==0 or $xacnhan==1)
		{
			$sql="SELECT * FROM dathang WHERE xacnhan='$xacnhan' ORDER BY idDH DESC";
		}
		else
		{
			$sql="SELECT * FROM dathang ORDER BY idDH DESC";
		}
		return mysql_query($sql);
	}
	function sanphamdathangtheoIdDH($idDH)
	{
		$sql="SELECT sanphamdathang.*,sanpham.gia,sanpham.soluong as slspDB FROM sanphamdathang join sanpham on sanphamdathang.idSP=sanpham.idSP where idDH='$idDH'";
		return mysql_query($sql);
	}

	function xoaspdonhang($idDH,$idSP)
	{
		$qr="UPDATE dathang SET sotien=sotien-(select tonggia from sanphamdathang where idDH='$idDH' AND idSP='$idSP') where idDH='$idDH'";
		if(mysql_query($qr)==TRUE)
		{
			$sql="DELETE FROM sanphamdathang where idDH='$idDH' AND idSP='$idSP'";
			return mysql_query($sql);
		}
	}
	//CREATE TRIGGER `giamtiendonhang` BEFORE DELETE ON `sanphamdathang` FOR EACH ROW UPDATE dathang SET dathang.sotien=dathang.sotien-(SELECT tonggia FROM deleted) WHERE idSP=(SELECT idSP FROM deleted)

	function dathangtheoid($idDH)
	{
		$sql="SELECT * FROM dathang where idDH='$idDH'";
		return mysql_query($sql);
	}

	function suaspdonhang($idDH,$idSP,$soluong)//capnhatsoluongchitiet
	{
		$qr="UPDATE dathang SET sotien=sotien-(select tonggia from sanphamdathang where idDH='$idDH' AND idSP='$idSP') where idDH='$idDH'";
		if(mysql_query($qr)==TRUE)
		{
			$sql="DELETE FROM sanphamdathang where idDH='$idDH' AND idSP='$idSP'";
			return mysql_query($sql);
		}
	}

	function capnhatsoluongchitiet($idSP,$soluong,$idDH)
	{
		$sql="UPDATE sanphamdathang set soluong='$soluong' WHERE idSP='$idSP' AND idDH='$idDH'";
		if(mysql_query($sql)==TRUE)
		{
			$qr="UPDATE sanphamdathang set tonggia=soluong*(select gia from sanpham where idSP='$idSP') where idSP='$idSP' AND idDH='$idDH' ";
			if(mysql_query($qr)==TRUE)
			{
				$zz="UPDATE dathang set sotien=(SELECT sum(tonggia) from sanphamdathang where idDH='$idDH' GROUP BY idDH) where idDH='$idDH'";
				mysql_query($zz);
			}

		}
	}



	function xoaloaisp($idloaiSP)
	{
		$sql="DELETE from loaisanpham where idloaiSP='$idloaiSP'";
		return mysql_query($sql);
	}
	function themloaisp($tenloaiSP,$tenloai_khongdau,$thutu,$anhien,$idTL,$tomtat)
	{
		$qr="INSERT INTO loaisanpham values('NULL','$tenloaiSP','$tenloai_khongdau','$thutu','$anhien','$idTL','$tomtat')";
		return mysql_query($qr);
	}

	function loaisptheoid($idloaiSP)
	{
		$sql="SELECT * FROM loaisanpham where idloaiSP='$idloaiSP'";
		return mysql_query($sql);
	}
	function sualoaisanpham($idloaiSP,$tenloaiSP,$ten_khongdau,$thutu,$anhien,$idTL,$tomtat)
	{
		$qr="UPDATE loaisanpham set
			tenloaiSP = '$tenloaiSP',
			aliasLSP = '$ten_khongdau',
			thutu ='$thutu',
			anhien='$anhien',
			idTL ='$idTL',
			tomtat='$tomtat'
			where idloaiSP = '$idloaiSP'";
		mysql_query($qr);
	}

	function xacnhandonhang($idDH)
	{
		$sql="UPDATE dathang set xacnhan='1' where idDH='$idDH'";
		mysql_query($sql);
	}

	function soluongsanpham($idSP)
	{
		$sql="SELECT soluong from sanpham where idSP='$idSP'";
		$row=mysql_fetch_array(mysql_query($sql));
		return $row['soluong'];
	}

	function soluongsanphamdathang($idDH,$idSP)
	{
		$sql="SELECT * FROM sanphamdathang where idDH='$idDH' AND idSP='$idSP'";
		$row=mysql_fetch_array(mysql_query($sql));
		return $row['soluong'];
	}

	function capnhatsoluongsanpham($idSP,$soluongcu,$soluongmoi)
	{
		if($soluongmoi>$soluongcu)
		{	
			$sl=$soluongmoi-$soluongcu;
			$sql="UPDATE sanpham set soluong=soluong-'$sl' where idSP='$idSP'";
			return mysql_query($sql);
		}
		else
		{
			$sl=$soluongcu-$soluongmoi;
			$sql="UPDATE sanpham set soluong=soluong+'$sl' where idSP='$idSP'";
			return mysql_query($sql);
		}
	}

	function xoauser($idUser)
	{
		$sql="DELETE FROM Users where idUser='$idUser'";
		return mysql_query($sql);
	}

	function capnhatuser($idUser,$ngaysua,$cap)
	{
		$sql="UPDATE users set cap='$cap', ngaysua='$ngaysua' where idUser='$idUser'";
		return mysql_query($sql);
	}


	function danhsachlienhe($xacnhan)
	{
		if($xacnhan==0 or $xacnhan==1)
		{
			$sql="SELECT * FROM lienhe WHERE xacnhan='$xacnhan'";
		}
		else
		{
			$sql="SELECT * FROM lienhe";
		}
		return mysql_query($sql);
	}

	function xacnhanlienhe($idLH,$xacnhan)
	{
		$sql="UPDATE lienhe set xacnhan='$xacnhan' where idLH='$idLH'";
		return mysql_query($sql);
	}

	function xoachitiet($idSP)
	{
		$sql="DELETE FROM chitiet where idSP='$idSP'";
		return mysql_query($sql);
	}

}


?>
