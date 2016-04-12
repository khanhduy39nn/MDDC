<?php
session_start();
require "../config.php";
?>

<?php include('login_functions.php'); ?>
<html>
<head>

<link rel="stylesheet" type="text/css"
href="style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="en" />
<meta name="description" content="Million Dollar Desi Club" />
<meta name="keywords" content="Million Dollar Desi Club" />
<?php

$label["advertiser_signup_heading1"] = str_replace ("%SITE_NAME%", SITE_NAME , $label["advertiser_signup_heading1"]);

?>
</head>
<body>
<center><a href="http://milliondollardesiclub.com/" title="Million Dollar Desi Club"><img alt="Million Dollar Desi Club" src="<?php echo SITE_LOGO_URL; ?>"/></a><br/>
      <h3 ><?php echo $label["advertiser_signup_heading1"]; ?></h3></center> 
<table width="60%" align="center" width="100%"  border="0" cellspacing="0" cellpadding="0" >
	<tr>
		<td width="35" height="26">&nbsp;</td>
		<td height="26" valign="bottom"><div align="center"><h3 ><?php echo $label["advertiser_signup_heading2"]; ?></h3> </div></td>
		<td width="35" height="26">&nbsp;</td>
	</tr>
	<tr>
		<td width="35">&nbsp;</td>
		<td>
			<?php
				if ($_REQUEST['form']=="filled") {

					$success = process_signup_form();
					
				} // end submit

				if (!$success) {
					//Signup form is shown below

					display_signup_form($_REQUEST['FirstName'], $_REQUEST['LastName'], $_REQUEST['CompName'], $_REQUEST['Username'], $_REQUEST['Password'], $_REQUEST['Password2'], $_REQUEST['Email'], $_REQUEST['Newsletter'], $_REQUEST['Notification1'], $_REQUEST['Notification2'], $_REQUEST['lang']);
					
				} else {


				}

				
			?>

		</td>
		<td width="35">&nbsp;</td>
	</tr>
	<tr>
		<td width="35" height="26">&nbsp;</td>
		<td height="26"></td>
		<td width="35" height="26">&nbsp;</td>
	</tr>
</table>
<?php 
    include 'footer.php';
?>
</body>

</html>
