<?php 
	session_start();
	include "../config.php";
	
	if(!empty($_POST)){	
		$user_id = $_SESSION['detail']['id'];
		
		$check = mysql_query("select id,user_id from candidate_cv where user_id = ".$user_id);
		if(mysql_num_rows($check) == 0){
			$rs = mysql_query("insert into candidate_cv (user_id) values (".$user_id.")");
			if(!$rs){
				header("Location: index.php");
				exit;
			}
		}			
		$candidate_cv = mysql_fetch_assoc($check);
		$summary = $_POST['summary'];
		$education = $_POST['education'];
		
		$certification = $_POST['certification'];
		$experience = $_POST['experience'];
		$project = $_POST['project'];
		$publication = $_POST['publication'];	
		
		/*echo "<pre>";
		print_r($_POST);
		echo "</pre>";*/
		
		$path = "../upload_files/candidate_cv/";			
		
		//upload		
        if (!empty($_FILES['profile_picture']))
        {           			
            if ($_FILES['profile_picture']['error'] == 0 && $_FILES['profile_picture']['name'] != "")
            {     		
				$ext_name = explode('.',$_FILES['profile_picture']['name']);
				$image_name = $_FILES['profile_picture']['name'].time().'.'.$ext_name[count($ext_name)-1];
                // Upload file
                move_uploaded_file($_FILES['profile_picture']['tmp_name'], $path.'/'.$image_name);                
				mysql_query("update candidate_cv set profile_picture = '".$image_name."' where user_id = ".$user_id);			
            }
        }							
				
		//summary	
		$url= makeSlugs($summary['title'],200)."-".$candidate_cv['id'];
		$sql = "update candidate_cv set url = '".$url."', dateadded = ".time().", first_name = '".$summary['first_name']."',last_name = '".$summary['last_name']."', dob = '".$summary['dob']."', sex = ".$summary['sex'].", email = '".$summary['email']."', phone = '".$summary['phone']."', address = '".$summary['address']."', country = '".$summary['country']."', postal_code = '".$summary['postal_code']."', title = '".$summary['title']."', short_description = '".$summary['short_description']."', business_type = '".$summary['business_type']."' where user_id = ".$user_id;		
		mysql_query($sql);
		
		
		//educations
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
		
		//skills
		
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
		
		//projects		
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
		
		//publications				
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
		
		//certification				
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
		
		//experience				
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
	}
//create slug function
function my_str_split($string)
{
  $slen=strlen($string);
  for($i=0; $i<$slen; $i++)
  {
	 $sArray[$i]=$string{$i};
  }
  return $sArray;
}

function noDiacritics($string)
{
  //cyrylic transcription
  $cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
  $cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia'); 

  
  $from = array("Á", "À", "Â", "Ä", "Ă", "Ā", "Ã", "Å", "Ą", "Æ", "Ć", "Ċ", "Ĉ", "Č", "Ç", "Ď", "Đ", "Ð", "É", "È", "Ė", "Ê", "Ë", "Ě", "Ē", "Ę", "Ə", "Ġ", "Ĝ", "Ğ", "Ģ", "á", "à", "â", "ä", "ă", "ā", "ã", "å", "ą", "æ", "ć", "ċ", "ĉ", "č", "ç", "ď", "đ", "ð", "é", "è", "ė", "ê", "ë", "ě", "ē", "ę", "ə", "ġ", "ĝ", "ğ", "ģ", "Ĥ", "Ħ", "I", "Í", "Ì", "İ", "Î", "Ï", "Ī", "Į", "Ĳ", "Ĵ", "Ķ", "Ļ", "Ł", "Ń", "Ň", "Ñ", "Ņ", "Ó", "Ò", "Ô", "Ö", "Õ", "Ő", "Ø", "Ơ", "Œ", "ĥ", "ħ", "ı", "í", "ì", "i", "î", "ï", "ī", "į", "ĳ", "ĵ", "ķ", "ļ", "ł", "ń", "ň", "ñ", "ņ", "ó", "ò", "ô", "ö", "õ", "ő", "ø", "ơ", "œ", "Ŕ", "Ř", "Ś", "Ŝ", "Š", "Ş", "Ť", "Ţ", "Þ", "Ú", "Ù", "Û", "Ü", "Ŭ", "Ū", "Ů", "Ų", "Ű", "Ư", "Ŵ", "Ý", "Ŷ", "Ÿ", "Ź", "Ż", "Ž", "ŕ", "ř", "ś", "ŝ", "š", "ş", "ß", "ť", "ţ", "þ", "ú", "ù", "û", "ü", "ŭ", "ū", "ů", "ų", "ű", "ư", "ŵ", "ý", "ŷ", "ÿ", "ź", "ż", "ž");
  $to   = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");
  
  
  $from = array_merge($from, $cyrylicFrom);
  $to   = array_merge($to, $cyrylicTo);
  
  $newstring=str_replace($from, $to, $string);   
  return $newstring;
}

function makeSlugs($string, $maxlen=0)
{
  $newStringTab=array();
  $string=strtolower(noDiacritics($string));
  if(function_exists('str_split'))
  {
	 $stringTab=str_split($string);
  }
  else
  {
	 $stringTab=my_str_split($string);
  }

  $numbers=array("0","1","2","3","4","5","6","7","8","9","-");
  //$numbers=array("0","1","2","3","4","5","6","7","8","9");

  foreach($stringTab as $letter)
  {
	 if(in_array($letter, range("a", "z")) || in_array($letter, $numbers))
	 {
		$newStringTab[]=$letter;
		//print($letter);
	 }
	 elseif($letter==" ")
	 {
		$newStringTab[]="-";
	 }
  }

  if(count($newStringTab))
  {
	 $newString=implode($newStringTab);
	 if($maxlen>0)
	 {
		$newString=substr($newString, 0, $maxlen);
	 }
	 
	 $newString = removeDuplicates('--', '-', $newString);
  }
  else
  {
	 $newString='';
  }      
  
  return $newString;
}


function checkSlug($sSlug)
{
  if(ereg ("^[a-zA-Z0-9]+[a-zA-Z0-9\_\-]*$", $sSlug))
  {
	 return true;
  }
  
  return false;
}

function removeDuplicates($sSearch, $sReplace, $sSubject)
{
  $i=0;
  do{
  
	 $sSubject=str_replace($sSearch, $sReplace, $sSubject);         
	 $pos=strpos($sSubject, $sSearch);
	 
	 $i++;
	 if($i>100)
	 {
		die('removeDuplicates() loop error');
	 }
	 
  }while($pos!==false);
  
  return $sSubject;
}	
?>
