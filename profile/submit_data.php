<?php 	
	session_start();
	include "../config.php";	
	if(isset($_POST)){	
		echo "abc";
		$user_id = $_SESSION['detail']['id'];
		
		$check = mysql_query("select id,user_id from candidate_cv where user_id = ".$user_id);
		if(mysql_num_rows($check) == 0){
			$rs = mysql_query("insert into candidate_cv (user_id) values (".$user_id.")");
			if(!$rs){
				header("Location: index.php");
				exit;
			}
		}	
echo "def";		
		$candidate_cv = mysql_fetch_assoc($check);
		$summary = $_POST['summary'];
		$education = $_POST['education'];
		
		$certification = $_POST['certification'];
		$experience = $_POST['experience'];
		$project = $_POST['project'];
		$publication = $_POST['publication'];	
		
		echo "ghi";
		
		$path = "../upload_files/candidate_cv/";			
		
			
        if (!empty($_FILES['profile_picture']))
        {           			
            if ($_FILES['profile_picture']['error'] == 0 && $_FILES['profile_picture']['name'] != "")
            {     		
				$ext_name = explode('.',$_FILES['profile_picture']['name']);
				$image_name = $_FILES['profile_picture']['name'].time().'.'.$ext_name[count($ext_name)-1];
             
                move_uploaded_file($_FILES['profile_picture']['tmp_name'], $path.'/'.$image_name);                
				mysql_query("update candidate_cv set profile_picture = '".$image_name."' where user_id = ".$user_id);			
            }
        }							
		echo "klm";		
		
		$url= $this->makeSlugs($summary['title'],200)."-".$candidate_cv['id'];
		$sql = "update candidate_cv set url = '".$url."', dateadded = ".time().", first_name = '".$summary['first_name']."',last_name = '".$summary['last_name']."', dob = '".$summary['dob']."', sex = ".$summary['sex'].", email = '".$summary['email']."', phone = '".$summary['phone']."', address = '".$summary['address']."', country = '".$summary['country']."', postal_code = '".$summary['postal_code']."', title = '".$summary['title']."', short_description = '".$summary['short_description']."', business_type = '".$summary['business_type']."' where user_id = ".$user_id;		
		mysql_query($sql);
		
		
		
		if(!empty($candidate_cv['id'])){
			mysql_query("delete from educations where cv_id = ".$candidate_cv['id']);
			
			if(!empty($education['school'])){
				$sql = "insert into educations (school,date_attend_from,date_attend_to,degree,field_of_study,grade,activities_and_societies,description,cv_id,dateadded) values ('".$education['school']."' , ".$education['date_attend_from']." , ".$education['date_attend_to']." , '".$education['degree']."','".$education['field_of_study']."','".$education['grade']."' , '".$education['activities_and_societies']."' , '".$education['description']."', ".$candidate_cv['id'].",".time().")";						
				mysql_query($sql);
			}
			
			for($i = 2; $i < 20; $i++){
				if(!empty($education['school'.$i])){
					$sql = "insert into educations (school,date_attend_from,date_attend_to,degree,field_of_study,grade,activities_and_societies,description,cv_id,dateadded) values ('".$education['school'.$i]."' , ".$education['date_attend_from'.$i]." , ".$education['date_attend_to'.$i]." , '".$education['degree'.$i]."','".$education['field_of_study'.$i]."','".$education['grade'.$i]."' , '".$education['activities_and_societies'.$i]."' , '".$education['description'.$i]."', ".$candidate_cv['id'].",".time().")";						
					mysql_query($sql);
				}
			}
		}
		
		
		echo "gfd";
		if(!empty($_POST['skills'])){
			$arrSkills = explode(",",$_POST['skills']);
			$list = "";
			foreach($arrSkills as $skill){				
				$rs = mysql_query("select id,name from skills where name = '".$skill."'");
				if(mysql_num_rows($rs) == 0){
					mysql_query("insert into skills (name,dateadded) values ('".ucfirst($skill)."','".time()."')");
					$id = mysql_insert_id();
					$skill_res = mysql_fetch_assoc(mysql_query("select id,name from skills where id = ".$id));
				}else{
					$skill_res = mysql_fetch_assoc($rs);					
				}				
				$list .= $skill_res['id'].",";
			}
			if($list != ""){
				$list = trim($list,",");
				mysql_query("update candidate_cv set skills = '".$list."' where user_id = ".$user_id);			
			}
		}
		echo "asdfgds";
			
		if(!empty($candidate_cv['id'])){
			mysql_query("delete from projects where cv_id = ".$candidate_cv['id']);
			
			if(!empty($project['name'])){
				$sql = "insert into projects (name,occupation,date,project_url,description,cv_id,dateadded) values ('".$project['name']."' , '".$project['occupation']."' , '".$project['date']."' , '".$project['url']."','".$project['description']."', ".$candidate_cv['id'].",".time().")";													
				mysql_query($sql);
			}
			
			for($i = 2; $i < 20; $i++){				
				if(!empty($project['name'.$i])){
					$sql = "insert into projects (name,occupation,date,project_url,description,cv_id,dateadded) values ('".$project['name'.$i]."' , '".$project['occupation'.$i]."' , '".$project['date'.$i]."' , '".$project['url'.$i]."','".$project['description'.$i]."', ".$candidate_cv['id'].",".time().")";						
					mysql_query($sql);
				}
			}
		}
		echo "111";
						
		if(!empty($candidate_cv['id'])){
			mysql_query("delete from publications where cv_id = ".$candidate_cv['id']);
						
			
			if(!empty($publication['title'])){
				$sql = "insert into publications (title,publication_publisher,publication_date,publication_url,description,cv_id,dateadded) values ('".$publication['title']."' , '".$publication['publication_publisher']."' , '".$publication['publication_date']."' , '".$publication['url']."','".$publication['description']."', ".$candidate_cv['id'].",".time().")";																	
				mysql_query($sql);
			}
			
			for($i = 2; $i < 20; $i++){				
				
				if(!empty($publication['title'.$i])){
					$sql = "insert into publications (title,publication_publisher,publication_date,publication_url,description,cv_id,dateadded) values ('".$publication['title'.$i]."' , '".$publication['publication_publisher'.$i]."' , '".$publication['publication_date'.$i]."' , '".$publication['url'.$i]."','".$publication['description'.$i]."', ".$candidate_cv['id'].",".time().")";													
					mysql_query($sql);
				}
			}
		}
		
		echo "222";			
		if(!empty($candidate_cv['id'])){			
			mysql_query("delete from certification where cv_id = ".$candidate_cv['id']);
						
			
			if(!empty($certification['name'])){
				$sql = "insert into certification (name,authory,license_number,date_from,date_to,certification_url,cv_id,dateadded) values ('".$certification['name']."','".$certification['authory']."','".$certification['license_number']."','".$certification['date_from']."','".$certification['date_to']."','".$certification['url']."',".$candidate_cv['id'].",".time().")";																					
				mysql_query($sql);
			}
			
			for($i = 2; $i < 20; $i++){
			
				
				if(!empty($certification['name'.$i])){
					$sql = "insert into certification (name,authory,license_number,date_from,date_to,certification_url,cv_id,dateadded) values ('".$certification['name'.$i]."','".$certification['authory'.$i]."','".$certification['license_number'.$i]."','".$certification['date_from'.$i]."','".$certification['date_to'.$i]."','".$certification['url'.$i]."',".$candidate_cv['id'].",".time().")";																					
					mysql_query($sql);
				}
			}
		}
		
			echo "333";			
		if(!empty($candidate_cv['id'])){			
			mysql_query("delete from experience where cv_id = ".$candidate_cv['id']);
			
			
			if(!empty($experience['company_name'])){
				$sql = "insert into experience (company_name,title,location,time_period_from,time_period_to,description,cv_id,dateadded) values ('".$experience['company_name']."','".$experience['title']."','".$experience['location']."','".$experience['time_period_from']."','".$experience['time_period_to']."','".$experience['description']."',".$candidate_cv['id'].",".time().")";																									
				mysql_query($sql);
			}
			
			for($i = 2; $i < 20; $i++){								
				
				if(!empty($experience['company_name'.$i])){
					$sql = "insert into experience (company_name,title,location,time_period_from,time_period_to,description,cv_id,dateadded) values ('".$experience['company_name'.$i]."','".$experience['title'.$i]."','".$experience['location'.$i]."','".$experience['time_period_from'.$i]."','".$experience['time_period_to'.$i]."','".$experience['description'.$i]."',".$candidate_cv['id'].",".time().")";																					
					mysql_query($sql);
				}
			}
		}
		
		header("Location: index.php");
		exit;		
	}else{
		header("Location: index.php");
		exit;	
	}
?>