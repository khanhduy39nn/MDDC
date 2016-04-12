<?php 
	include 'PHPMailerAutoload.php';	
$mail  = new PHPMailer();

$mail->IsSMTP(); 
$mail->Host       = "mailout.one.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
										   									   
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "mailout.one.com"; // sets the SMTP server
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = ""; // SMTP account username
$mail->Password   = "";        // SMTP account password

$mail->SetFrom('no_reply@milliondollardesiclub.com', 'First Last');

$mail->AddReplyTo("no_reply@milliondollardesiclub.com","First Last");

$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML("<h1>hello</h1>");

$address = "khanhduy.39n@gmail.com";
$mail->AddAddress($address, "John Doe");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
    
?>