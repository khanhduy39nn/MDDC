<?php $to = 'huongthien1993@gmail.com';

$subject = 'Website Change Reqest';

$headers = "From: php2195tb@gmail.com\r\n";
$headers .= "Reply-To: php2195tb@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


$message = '<html>
<head>
	<meta charset="utf-8" />
	<title>Invite to MDDCConnect</title>
</head>
<body style="color:#D8DB43;font-family:Geneva, Arial, Helvetica, sans-serif;width:100%;padding-bottom:20px;background-color:#000;">
	<table style="background:#000; color:#D8DB43;">
		<tr>
			<td><img alt="Million Dollar Desi Club" src="http://milliondollardesiclub.com/logo.jpg"></td>
		</tr>
		<tr>
			<td>
				<p style="margin-left:25px;">hi [Email_nhan],</p>
				<p style="margin-left:25px;">[Email_gui] would like to add you to MDDCConnect on <a style="color:#D8DB43; text-decoration:none;" target="_blank" href="http://milliondollardesiclub.com/">MillionDollarDesiClub</a>.</p>
			</td>
		</tr>
		<tr>
			<td>
				<a style="text-decoration:none; margin-left:25px;background-color:#D8DB43; color: #000; width: 400px; display: block; padding:5px; border-radius:5px; font-weight:bold; text-align:center;" href="http://milliondollardesiclub.com/register/register.php" target="_blank">Confirm to register that you know [Email_gui]</a>
			</td>
		</tr>
	</table>
</body>
</html>';

mail($to, $subject, $message, $headers);
?>