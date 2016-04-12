<?php 
	include '../config.php';
	
	$user_id = $_GET['user_id'];
	$check = mysql_query("select id from candidate_cv  where user_id = ".$user_id);
	
	if(!empty($_GET['id'])){
		mysql_query("delete from certification where id = ".$_GET['id']);
	}
	
	if(mysql_num_rows($check) == 0){
		exit;
	}
	
	$candidate_cv = mysql_fetch_assoc($check);
	
	$certificationList = mysql_query("select * from certification where cv_id = ".$candidate_cv['id']." order by id");
	
	$arrCertification = array();
	while($certification = mysql_fetch_assoc($certificationList)){
		$arrCertification[] = $certification;
	}
	
	$list = "";
	for($i = 2; $i < 20; $i++){				
		$anhien = '';
		if(isset($arrCertification[($i-1)])){ 
			$anhien = 'style="display:block !important;"'; 
		}		
		
		$themmoi = "";
		if(isset($arrCertification[$i])){ 
			$themmoi = 'display:none !important;'; 
		}
		
		$list .= '
		<div id="certification_'.$i.'" '.$anhien.'>				
			<hr style="width:100%;border-color:#D8DB43;">
			<input type="hidden" value="'.$arrCertification[($i-1)]['id'].'" id="id_certification'.$i.'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Certification Name</h5>
			<input type="text" name="certification[name'.$i.']" placeholder="Certification Name" value="'.$arrCertification[($i-1)]['name'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Certification Authority</h5>
			<input type="text" name="certification[authory'.$i.']" placeholder="Certification Authority" value="'.$arrCertification[($i-1)]['authory'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">License Number</h5>
			<input type="text" name="certification[license_number'.$i.']" placeholder="License Number" value="'.$arrCertification[($i-1)]['license_number'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Certification URL</h5>
			<input type="text" name="certification[url'.$i.']" placeholder="Certification URL" value="'.$arrCertification[($i-1)]['certification_url'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Date From</h5>
			<input type="text" id="date_certification_from'.$i.'" name="certification[date_from'.$i.']" value="'.$arrCertification[($i-1)]['date_from'].'" placeholder="Date From" style="float:left;width:20%;" />
			<input type="text" id="date_certification_to'.$i.'" name="certification[date_to'.$i.']" value="'.$arrCertification[($i-1)]['date_to'].'" placeholder="Date To" style="float:left;width:20%;margin-left:10px;" />			
			<script>			  
				$( "#date_certification_from'.$i.'" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: "mm-dd-yy",
				  yearRange: "1930:2020"
				});
				$( "#date_certification_to'.$i.'" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: "mm-dd-yy",
				  yearRange: "1930:2020"
				});
			 
			</script>
			<div id="next-button" >';				
				if($i < 19){
					$list .=	'<input type="button" id="add_certification'.($i+1).'" class="action-button" style="float:left;" value="+ Add Certification" />';		
				}				
				$list .= 	'<input type="button" id="remove_certification'.$i.'" class="action-button" style="float:left;" value="Remove Certification" />			
			</div>	
		</div>';
	}			
	$arr = array();
	$arr['hien'] = 0;
	$arr['data'] = $list;
	if(empty($arrCertification[1])){
		$arr['hien'] = 1;
	}
	echo json_encode($arr);
	exit;			
	
?>