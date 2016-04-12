<?php
session_start();
include ("../config.php");
 require_once ( '../phpmailer/class.phpmailer.php' );

$Mail = new PHPMailer();
  $Mail->IsSMTP(); // Use SMTP
  $Mail->Host        = "smtp.gmail.com"; // Sets SMTP server
  $Mail->SMTPDebug   = 2; // 2 to enable SMTP debug information
  $Mail->SMTPAuth    = TRUE; // enable SMTP authentication
  $Mail->SMTPSecure  = "tsl"; //Secure conection
  $Mail->Port        = 587; // set the SMTP port
  $Mail->Username    = 'php2195@gmail.com'; // SMTP account username
  $Mail->Password    = 'Honghoapn1'; // SMTP account password  
  $Mail->Subject     = 'Test Email Using Gmail'; 
  $Mail->From        = 'php2195@gmail.com';
  $Mail->FromName    = 'GMail Test'; 

  $Mail->AddAddress('huongthien1993@gmail.com'); // To:
  $Mail->Body    = "amc";
  $Mail->AltBody = "def";
  $Mail->Send();
  $Mail->SmtpClose();

  if ( $Mail->IsError() ) { 
    echo "ERROR<br /><br />";
  }
  else {
    echo "OK<br /><br />";
  }
exit;

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
		if(send_apply_job($mail_row)){
			echo "oke<br>";
		}else{			
			echo "fail<br>";		
		}
	}
	
	//send to feedsite
	if(!empty($data['to_emails_feedsite'])){
		$mail_row['to_address'] = $data['to_emails_feedsite'];		
		if(send_apply_job($mail_row)){
			echo "oke<br>";
		}else{
			echo "fail<br>";		
		}
	}
}

?>