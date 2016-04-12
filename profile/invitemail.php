<?php 
session_start();
if(!empty($_SESSION['detail']) && !empty($_POST['email'])){
	$arr = explode(',',$_POST['email']);
	if(count($arr) > 0){
		foreach($arr as $e){
			$to = trim($e);
			$from = trim($_SESSION['detail']['email']);
			$subject = 'Invite to MDDCConnect on MillionDollarDesiClub by '.$from;

			$headers = "From: admin@milliondollardesiclub.com\r\n";
			$headers .= "Reply-To: ".$from."\r\n";
			$headers .= "MIME-Version: 1.0\r\n";

			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


			$message = '<html>
			<head>
				<meta charset="utf-8" />
				<title>Invite to MDDCConnect on MillionDollarDesiClub by <span style="color:#D8DB43 !important;">'.$from.'</span></title>
			</head>
			<body style="color:#D8DB43;font-family:Geneva, Arial, Helvetica, sans-serif;width:100%;padding-bottom:20px;background-color:#000;">
				<table style="background:#000; color:#D8DB43;">
					<tr>
						<td><a style="color:#D8DB43; text-decoration:none;" target="_blank" href="http://milliondollardesiclub.com/"><img alt="Million Dollar Desi Club" src="http://milliondollardesiclub.com/logo.jpg"></a></td>
					</tr>
					<tr>
						<td>
							<p style="margin-left:25px;">hi '.$to.',</p>
							<p style="margin-left:25px;"><span style="color:#D8DB43 !important;">'.$from.'</span> would like to add you to MDDCConnect on <a style="color:#D8DB43; text-decoration:none;" target="_blank" href="http://milliondollardesiclub.com/">MillionDollarDesiClub</a>.</p>
						</td>
					</tr>
					<tr>
						<td>
							<a style="text-decoration:none; margin-left:25px;background-color:#D8DB43; color: #000; width: 400px; display: block; padding:5px; border-radius:5px; font-weight:bold; text-align:center;" href="http://milliondollardesiclub.com/register/register.php" target="_blank">Confirm to register that you know '.$from.'</a>
						</td>
					</tr>
				</table>
			</body>
			</html>';

			mail($to, $subject, $message, $headers);
		}
		$_SESSION['alert'] = "Successfully!";
		header("Location: http://milliondollardesiclub.com/profile/invite.php");
		exit;
	}else{
		$_SESSION['alert'] = "Error, Please try again";
		header("Location: http://milliondollardesiclub.com/profile/invite.php");
		exit;
	}
}else{
	header("Location: http://milliondollardesiclub.com/connect");
	exit;
}
?>