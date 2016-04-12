<?php

	
	include ("../config.php");
	$sql="select * from user_invites where Status=0 and UserID='".$_POST['userID']."' LIMIT 5";
	$mailsList = mysql_query($sql);
	$a=mysql_num_rows ( $mailsList );
	if($a==0){
		echo "done";
	}else{
		while ($row = mysql_fetch_assoc($mailsList)) {
			//$sql = 'INSERT INTO TestSendMail (Email) VALUES ("'.$row['FriendMail'].'")';
			$sql = 'update user_invites set Status=1 where ID='.$row['ID'];
			mysql_query($sql);
			$regcode=$row['RegCode'];
			sendMail($row['FriendMail'],$regcode,$_POST['emailContent']);
		}
	}
	

  function sendMail($to,$regcode,$content){
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
          <p style="margin-left:25px;">'.$content.'</p>
        </td>
      </tr>
      <tr>
        <td>
          <a style="text-decoration:none; margin-left:25px;background-color:#D8DB43; color: #000; width: 400px; display: block; padding:5px; border-radius:5px; font-weight:bold; text-align:center;" href="http://milliondollardesiclub.com/register/registerbyinvite.php?regcode='.$regcode.'" target="_blank">Confirm to register that you know '.$from.'</a>
        </td>
      </tr>
    </table>
  </body>
  </html>';

  mail($to, $subject, $message, $headers);
}
?>
