<?php
session_start();
require "config.php";
if(!empty($_POST)){
	$data = $_POST;
	if($data['email'] == ''){
		echo "<p style='color:red; font-style: italic;'>Username is empty</p>";
	}
	if($data['pwrd'] == ''){
		echo "<p style='color:red; font-style: italic;'>Password is empty</p>";
	}
	$fail = "";
	$login_detail = mysql_query("SELECT * FROM register WHERE email = '".trim($data['email'])."' and password = '".md5($data['pwrd'])."'");
	if(mysql_num_rows($login_detail) == 1){
		$_SESSION['login_register'] = 'yes';
		$_SESSION['detail'] = mysql_fetch_assoc($login_detail);
		if(isset($_GET['red']) && $_GET['red'] == 'mddcconnect'){
			header("Location: /".$_GET['red']);
			exit;
		}else{
			header("Location: /profile");
			exit;
		}
	}else{

		$fail = "<p style='color:red; font-style: italic;'>Login Fail</p>";
	}
}
?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="../users/style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="en" />
<meta name="description" content="Million Dollar Desi Club" />
<meta name="keywords" content="Million Dollar Desi Club" />

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<style>
	TD {
	border:0px solid #D8E378;
	padding:5px;
}
table {
	background-color: none !important;
}
</style>
</head>
<body>
<center><a href="http://milliondollardesiclub.com/" title="Million Dollar Desi Club"><img alt="Million Dollar Desi Club" src="logo.png" style="max-width:250px;margin-top:20px;margin-bottom:20px;"/></a><br/>
      <h3>Welcome to Million Dollar Desi Club</h3></center>
<center><?php if(!empty($fail)){ echo $fail; } ?></center>
<table width="40%" align="center" width="100%"  border="0" cellspacing="0" cellpadding="0" style="border-s" >
	<tr>
		<td width="35">&nbsp;</td>
		<td>
		<!--register-->
			<form name="form1" method="post" action="">
		<table width="100%"  border="0" cellspacing="3" cellpadding="0">
			<tr>
				<td width="30%" ><p style="float:right !important;">Email:</p></td>
				<td width="50%"><input name="email" style="width:200px;" value="" type="text" ></td>
			</tr>
			<tr>
				<td width="30%" ><p style="float:right !important;">Password:</p></td>
				<td width="50%"><input name="pwrd" style="width:200px;" value="" type="password" ></td>
			</tr>
		</table>
		<div align="center">
			<p>Or Login by:</p>

				<script type="text/javascript" src="register/script.js"></script>
				<div class="social-login">
				<style>
				.social-login img{
					width:42px;
				}
				</style>
				<a href="#" onclick="openSocialPopup(2,'<?php echo base64_encode('http://milliondollardesiclub.com/mddcconnect/'); ?>')"><img src="http://milliondollardesiclub.com/connect/images/google.png"></a>
				<a href="#" onclick="openSocialPopup(3,'<?php echo base64_encode('http://milliondollardesiclub.com/mddcconnect/'); ?>')"><img src="http://milliondollardesiclub.com/connect/images/facebook.png"></a>
				<a href="#" onclick="openSocialPopup(5,'<?php echo base64_encode('http://milliondollardesiclub.com/mddcconnect/'); ?>')"><img src="http://milliondollardesiclub.com/connect/images/linkein.png"></a>
				<a href="#" onclick="openSocialPopup(1,'<?php echo base64_encode('http://milliondollardesiclub.com/mddcconnect/'); ?>')"><img src="http://milliondollardesiclub.com/connect/images/twitter.png"></a>

			</div>
		<p style="width:180px;margin-left:auto; margin-right:auto;"><input type="submit" class="form_submit_button" name="Submit" style="background: #CFCE68; border: #CFCE68; width:80px; height: 25px; border-radius:3px; float:left;" value="Login">
		<a href="register/register.php" class="form_submit_button" style="display:block; background: #CFCE68; border: #CFCE68; width:80px;  border-radius:3px; margin-left:10px; float:left; color:#000 !important; text-decoration: none; font-size: 11px;padding-top: 5px;padding-bottom: 7px;" >Register</a>
		</p>
		</div>
		</form>
		<!--/.register-->
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
