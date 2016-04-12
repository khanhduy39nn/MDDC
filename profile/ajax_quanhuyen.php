<?php 
	include 'config.php';
	header('Content-Type: text/html; charset=utf-8');
	if(isset($_GET['tinhthanh']) && $_GET['tinhthanh'] != 'NULL'){
		$tinhthanh = $_GET['tinhthanh'];			
		$quan_huyen = mysql_query("SELECT MaQuanHuyen, TenQuanHuyen FROM quanhuyen WHERE MaTinhThanh = '".$tinhthanh."' ORDER BY TenQuanHuyen ASC");		
		if(mysql_num_rows($quan_huyen) > 0){
			$chuoi = '<option value="NULL">--Chọn Quận Huyện</option>';
			while($row = mysql_fetch_assoc($quan_huyen)){				
				$chuoi .= '<option value="'.$row['MaQuanHuyen'].'">'.$row['TenQuanHuyen'].'</option>';
			}
			echo $chuoi;			
		}		
	}		
  ?>