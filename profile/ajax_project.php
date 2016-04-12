<?php 
	include '../config.php';
	
	$user_id = $_GET['user_id'];
	$check = mysql_query("select id from candidate_cv  where user_id = ".$user_id);
	
	if(!empty($_GET['id'])){
		mysql_query("delete from projects where id = ".$_GET['id']);
	}
	
	if(mysql_num_rows($check) == 0){
		exit;
	}
	
	$candidate_cv = mysql_fetch_assoc($check);
	
	$projectList = mysql_query("select * from projects where cv_id = ".$candidate_cv['id']." order by id");
	
	$arrProject = array();
	while($project = mysql_fetch_assoc($projectList)){
		$arrProject[] = $project;
	}
	
	$list = "";
	for($i = 2; $i < 20; $i++){		
		
		$anhien = '';
		if(isset($arrProject[$i-1])){ 
			$anhien = 'style="display:block !important;"'; 
		}		
		
		$themmoi = "";
		if(isset($arrProject[$i])){ 
			$themmoi = 'display:none !important;'; 
		}
		
		$list .= '
		<div id="project_'.$i.'" '.$anhien.'>				
			<hr style="width:100%;border-color:#D8DB43;">
			<input type="hidden" value="'.$arrProject[($i-1)]['id'].'" id="id_project'.$i.'"
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Name</h5>
			<input type="text" name="project[name'.$i.']" placeholder="Name" value="'.$arrProject[($i-1)]['name'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Occupation</h5>			
			<input type="text" name="project[occupation'.$i.']" value="'.$arrProject[($i-1)]['occupation'].'" placeholder="Occupation" style="float:left;width:30%;" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Dates</h5>
			<input type="text" id="date_project'.$i.'" name="project[date'.$i.']" value="'.$arrProject[$i-1]['date'].'" placeholder="Dates" style="float:left;width:30%;" />
			<script>
				$( "#date_project'.$i.'" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: "mm-dd-yy",
				  yearRange: "1930:2020"
				});			 
			</script>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Project URL</h5>
			<input type="text" name="project[url'.$i.']" placeholder="Project URL" value="'.$arrProject[($i-1)]['project_url'].'" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Description</h5>					
			<textarea name="project[description'.$i.']" rows="6">'.$arrProject[($i-1)]['description'].'</textarea>
			<div id="next-button" >';
				if($i < 19){
					$list .='<input type="button" id="add_project'.($i+1).'" class="action-button" style="float:left;" value="+ Add Project" />';			
				}
				$list .= '<input type="button" id="remove_project'.$i.'" class="action-button" style="float:left;" value="Remove Project" />			
			</div>	
		</div>';
	}			
	$arr = array();
	$arr['hien'] = 0;
	$arr['data'] = $list;
	if(empty($arrProject[$i-1])){
		$arr['hien'] = 1;
	}
	echo json_encode($arr);
	exit;			
	
?>