<?php 
	include '../config.php';
	
	$user_id = $_GET['user_id'];
	$check = mysql_query("select id from candidate_cv  where user_id = ".$user_id);
	
	if(!empty($_GET['id'])){
		mysql_query("delete from experience where id = ".$_GET['id']);
	}
	
	if(mysql_num_rows($check) == 0){
		exit;
	}
	
	$candidate_cv = mysql_fetch_assoc($check);
	
	$experienceList = mysql_query("select * from experience where cv_id = ".$candidate_cv['id']." order by id");
	
	$arrExperience = array();
	while($experience = mysql_fetch_assoc($experienceList)){
		$arrExperience[] = $experience;
	}
	
	$list = "";
	for($i = 2; $i < 20; $i++){		
		
		$anhien = '';
		if(isset($arrExperience[($i-1)])){ 
			$anhien = 'style="display:block !important;"'; 
		}
			
		
		$themmoi = "";
		if(isset($arrExperience[$i])){ 
			$themmoi = 'display:none !important;'; 
		}
		
		$list .= '
		<div id="experience_'.$i.'" '.$anhien.'>				
			<hr style="width:100%;border-color:#D8DB43;">
			<input type="hidden" value="'.$arrExperience[($i-1)]['id'].'" id="id_experience'.$i.'"
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Company Name</h5>
			<input type="text" name="experience[company_name'.$i.']" placeholder="Company Name" value="'.$arrExperience[($i-1)]['company_name'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Title</h5>
			<input type="text" name="experience[title'.$i.']" placeholder="Title" value="'.$arrExperience[($i-1)]['title'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Location</h5>
			<input type="text" name="experience[location'.$i.']" placeholder="Location" value="'.$arrExperience[($i-1)]['location'].'" />
			<h5 style="font-weight:normal;width:30%;float:left;text-align:left;">Time Period</h5>
			<h5 style="font-weight:normal;width:70%;float:left;text-align:left;">&nbsp;</h5>
			<input type="text" id="time_period_from'.$i.'" name="experience[time_period_from'.$i.']" value="'.$arrExperience[($i-1)]['time_period_from'].'" placeholder="Time Period From" style="float:left;width:30%;" />
			<script>			
				$( "#time_period_from'.$i.'" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: "mm-dd-yy",
				  yearRange: "1930:2020"
				});			  
			</script>
			<input type="text" id="time_period_to'.$i.'" name="experience[time_period_to'.$i.']" value="'.$arrExperience[($i-1)]['time_period_to'].'" placeholder="Time Period To" style="float:left;width:30%;margin-left:10px;" />
			<script>			  
				$( "#time_period_to'.$i.'" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: "mm-dd-yy",
				  yearRange: "1930:2020"
				});			  
			</script>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Description</h5>					
			<textarea name="experience[description'.$i.']" rows="6">'.$arrExperience[($i-1)]['description'].'</textarea>
			<div id="next-button" >';				
				if($i < 19){
					$list .=	'<input type="button" id="add_experience'.($i+1).'" class="action-button" style="float:left;" value="+ Add Experience" />';		
				}	
				$list .= '<input type="button" id="remove_experience'.$i.'" class="action-button" style="float:left;" value="Remove Experience" />			
			</div>	
		</div>';
	}			
	$arr = array();
	$arr['hien'] = 0;
	$arr['data'] = $list;
	if(empty($arrExperience[($i-1)])){
		$arr['hien'] = 1;
	}
	echo json_encode($arr);
	exit;			
	
?>