<?php 
	include 'config.php';
	header('Content-Type: text/html; charset=utf-8');
	if(isset($_GET['bmbp']) && $_GET['bmbp'] != 'NULL'){
		$bmbp = $_GET['bmbp'];		
		$nhan_vien = mysql_query("SELECT MVC, Ho, Ten FROM nhan_vien WHERE MdvBpBm = ".$bmbp." ORDER BY Ten ASC");		
		if(mysql_num_rows($nhan_vien) > 0){
			$chuoi = '<option value="NULL">--Chọn Tên Giáo Viên/Nhân Viên</option>';
			while($row = mysql_fetch_assoc($nhan_vien)){
				$chuoi .= '<option value="'.$row['MVC'].'">'.$row['Ho'].' '.$row['Ten'].'</option>';
			}
			echo $chuoi;			
		}		
	}		
  ?>