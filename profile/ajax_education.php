<?php 
	include '../config.php';
	$user_id = $_GET['user_id'];
	$check = mysql_query("select id from candidate_cv  where user_id = ".$user_id);
	
	if(!empty($_GET['id'])){
		mysql_query("delete from educations where id = ".$_GET['id']);
	}
	
	if(mysql_num_rows($check) == 0){
		exit;
	}
	
	$candidate_cv = mysql_fetch_assoc($check);
	
	$educationList = mysql_query("select * from educations where cv_id = ".$candidate_cv['id']." order by id");
	
	$arrEducation = array();
	while($education = mysql_fetch_assoc($educationList)){
		$arrEducation[] = $education;
	}
	
	function date_from($year = ""){
		$kq = "";
		 for($i = 0; $i <= 250 ; $i++){
			$kq .= '<option value="'.(2045-$i).'"';
			if((2045-$i) == $year){
				$kq .= ' selected="selected" ';
			}
			$kq .= '>'.(2045-$i).'</option>';
		 }
		return $kq;
	}
	
	function date_to($year = ""){
		$kq = "";
		for($i = 0; $i <= 250 ; $i++){
			$kq .= '<option value="'.(2050-$i).'"';
			if((2050-$i) == $year){
				$kq .= ' selected="selected" ';
			}
			$kq .= '>'.(2050-$i).'</option>';
		}
		return $kq;
	}		
			
	$list = "";
	for($i = 2; $i < 20; $i++){
		$date_from = date_from($arrEducation[$i-1]['date_attend_from']);
		$date_to = date_to($arrEducation[$i-1]['date_attend_to']);
		
		$showhide = '';
		if(isset($arrEducation[$i-1])){ 
			$showhide = 'style="display:block !important;"'; 
		}		
		
		$addnew = "";
		if(isset($arrEducation[$i])){ 
			$addnew = 'display:none !important;'; 
		}
		
		$list .= '<div id="education_'.$i.'" '.$showhide.'>				
			<hr style="width:100%;border-color:#D8DB43;">
			<input type="hidden" value="'.$arrEducation[($i-1)]['id'].'" id="id_education'.$i.'"
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">School</h5>
			<input type="text" name="education[school'.$i.']" placeholder="School" value="'.$arrEducation[($i-1)]['school'].'" />
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">Dates Attended</h5>
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">&nbsp;</h5>
			<select name="education[date_attend_from'.$i.']" style="float:left;width:12%;padding:14px 20px;">
				<option value="NULL">From</option>				
				'.$date_from.'
			</select>
			<h5 style="font-weight:normal;width:1%;float:left;text-align:left;">-</h5>		
			<select name="education[date_attend_to'.$i.']" style="float:left;width:12%;padding:14px 20px;margin-left:10px;">
				<option value="NULL">To</option>
				'.$date_to.'	
			</select>
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;margin-left:13px;">Or expected graduation year</h5>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Degree</h5>		
			<input type="text" name="education[degree'.$i.']" placeholder="Degree" value="'.$arrEducation[($i-1)]['degree'].'" style=" float:left;" />																			
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Field of Study</h5>					
			<input type="text" name="education[field_of_study'.$i.']" placeholder="Field of Study" value="'.$arrEducation[($i-1)]['field_of_study'].'" style=" float:left;" />	
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Grade</h5>					
			<input type="text" name="education[grade'.$i.']" placeholder="Grade" value="'.$arrEducation[($i-1)]['grade'].'" style=" float:left;" />	
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Activities and Societies</h5>					
			<textarea name="education[activities_and_societies'.$i.']" rows="4">'.$arrEducation[($i-1)]['activities_and_societies'].'</textarea>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Description</h5>					
			<textarea name="education[description'.$i.']" rows="6">'.$arrEducation[$i-1]['description'].'</textarea>
			<div id="next-button" >';
			if($i < 19){
				$list .=	'<input type="button" id="add_edu'.($i+1).'" class="action-button" style="float:left;'.$addnew.'" value="+ Add Education" />';			
			}			
			$list .=	'<input type="button" id="remove_edu'.$i.'" class="action-button" style="float:left;" value="Remove Education" />			
			</div>	
		</div>';
	}	
	
	$arr = array();
	$arr['hien'] = 0;
	$arr['data'] = $list;
	if(empty($arrEducation[$i-1])){
		$arr['hien'] = 1;
	}
	echo json_encode($arr);
	exit;			
	
?>