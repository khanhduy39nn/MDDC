<?php
session_start();
include ("../config.php");

if(!empty($_POST)){
	$data = $_POST;
	if($data['to_emails'] != ''){
		$arr_email = explode(',',$data['to_emails']);
	}		
		
	$mail_row['subject'] = $data['subject'];	
	$mail_row['attachments'] = "";
	if(!empty($_FILES['attach'])){                   			
			$name = time().$_FILES['attach']['name'];					
			if(move_uploaded_file($_FILES['attach']['tmp_name'], '../upload_attachs/'.$name)){
				$mail_row['attachments'] = 'http://milliondollardesiclub.com/upload_attachs/'.$name;		
			}			
	}			
	$mail_row['message'] = $data['message'];
	foreach($arr_email as $email){		
		$mail_row['to_address'] = $email;		
		send_apply_job($mail_row);
	}
	//send to feedsite
	if(!empty($data['to_emails_feedsite'])){
		$mail_row['to_address'] = $data['to_emails_feedsite'];		
		send_apply_job($mail_row);
	}
}

?>