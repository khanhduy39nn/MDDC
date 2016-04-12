<?php
session_start();
include ("../config.php");

if(!empty($_POST)){
	$data = $_POST;
	if($data['to_emails'] != ''){
		$arr_email = explode(',',$data['to_emails']);
	}		
	
	echo "1<br>";	
	$mail_row['subject'] = $data['subject'];	
	if(!empty($_FILES['attach'])){                   
			echo "2<br>";		
			$name = time().$_FILES['attach']['name'];
			$url_attach = 'http://milliondollardesiclub.com/upload_attachs/'.$name;		
			try {
				move_uploaded_file($_FILES['attach']['tmp_name'], './upload_attachs/'.$_FILES['attach']['name']);			
				echo $url_attach."<br>";
			} catch (Exception $e) {
				die ('File did not upload: ' . $e->getMessage()); 
			}			
	}
	echo "3<br>";
	exit;
	$mail_row['attachments'] = "";
	$mail_row['message'] = "";
	foreach($arr_email as $email){		
		$mail_row['to_address'] = $email;		
		send_apply_job($mail_row);
	}
}

?>