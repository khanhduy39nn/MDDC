<?php
session_start();
include ("../config.php");

if(!empty($_POST)){
	$data = $_POST;
	if($data['to_emails'] != ''){
		$arr_email = explode(',',$data['to_emails']);
	}	

	$attachments = "";
	if(!empty($_FILES['attach'])){                   			
		$name = time().$_FILES['attach']['name'];					
		if(move_uploaded_file($_FILES['attach']['tmp_name'], '../upload_attachs/'.$name)){
			$attachments = $name;		
		}			
	}
	
	$name_apply = $data['name'];
	$email_apply = $data['email'];	
	$phone_apply = $data['phone'];	
	
	$content .= 'Name: '.$data['name'];
	$content .= "\n".'Email: '.$data['email'];
	
	if(!empty($data['address'])){
		$content .= "\n".'Home address: '.$data['address'];
	}
	if(!empty($data['phone'])){
		$content .= "\n".'Phone number: '.$data['phone'];
	}
	if(!empty($data['salary_bracket'])){
		$content .= "\n".'Salary Bracket: '.$data['salary_bracket'];
	}
	if(!empty($data['occupation'])){
		$content .= "\n".'Occupation: '.$data['occupation'];
	}
	if(!empty($data['bussiness_areas_of_interest'])){
		$content .= "\n".'Business Areas of Interest: '.$data['bussiness_areas_of_interest']."\n";
	}	
	
	$save_email = "";
	foreach($arr_email as $email){
		$save_email .= $email."-";
		send_email( $email, 'Million Dollar Desi Club', $email_apply, $name_apply, $data['subject'], $content);		
	}
	
	//send to feedsite
	if(!empty($data['to_emails_feedsite'])){
		$subject = mysql_fetch_assoc(mysql_query("Select subject_email from websites_feed where id = ".$data['feedsite_id']));
		$mail = $data['to_emails_feedsite'];	
		$save_email .= $mail."-";
		send_email( $mail, 'IRM Solutions', $email_apply, $name_apply, str_replace('[id_jobs_feedsite]',$data['id_jobs_feedsite'],$subject['subject_email']), $content);		
	}
	
	$sql = "INSERT INTO apply_jobs (name_apply,email_apply,phone_apply,email_to,cv,address,salary_bracket,occupation,bussiness_areas_of_interest, subject, message) VALUES ('".$name_apply."','".$email_apply."','".$phone_apply."','".$save_email."','".$attachments."','".$data['address']."','".$data['salary_bracket']."','".$data['occupation']."','".$data['bussiness_areas_of_interest']."','".$data['subject']."','".$content."')";	
	
	$rs = mysql_query($sql);
	if($rs){
		header("Location: /jobs/thanks.php");		
	}else{
		header("Location: /jobs/");		
	}
	
	
}
		

?>