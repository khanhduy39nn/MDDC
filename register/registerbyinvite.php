<?php
session_start();
require "../config.php";
	if(isset($_GET['regcode'])){

		$sql="select * from user_invites where RegCode='".$_GET['regcode']."'";
		$mailsList = mysql_query($sql);
		$a=mysql_num_rows ( $mailsList );
		$email="";

		if($a!=0){
			while ($row = mysql_fetch_assoc($mailsList)) {
				$inviteby=$row['UserID'];
				$provider=$row['Provider'];
					$email=$row['FriendMail'];
				if($provider=='twitter')
				$email='';
			}
		}
	}
?>
<html>
<head>

<!--<link rel="stylesheet" type="text/css" href="../style_fix.css" />-->
<link rel="stylesheet" type="text/css" href="../users/style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="en" />
<meta name="description" content="Million Dollar Desi Club" />
<meta name="keywords" content="Million Dollar Desi Club" />
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
<center><a href="http://milliondollardesiclub.com/" title="Million Dollar Desi Club"><img alt="Million Dollar Desi Club" src="../logo.png" style="max-width:250px;margin-top:20px;margin-bottom:20px;"/></a><br/>
      <h3>Welcome to Million Dollar Desi Club</h3></center>
<center>
	  <?php
		if(!empty($_POST)){

			$data = $_POST;
			$flag = 0;
			if($data['name'] == ''){
				echo "<p style='color:red; font-style: italic;'>Name is required</p>";
				$flag = 1;
			}
			if($data['email'] == ''){
				echo "<p style='color:red; font-style: italic;'>Email is required</p>";
				$flag = 1;
			}

			if($data['password'] == '' || $data['password_again'] == ''){
				echo "<p style='color:red; font-style: italic;'>Password is required</p>";
				$flag = 1;
			}

			if($data['password'] != $data['password_again']){
				echo "<p style='color:red; font-style: italic;'>Password is not correct</p>";
				$flag = 1;
			}

			$num = mysql_num_rows(mysql_query("SELECT * FROM register WHERE email = '".$data['email']."'"));
			if($num == 1){
				echo "<p style='color:red; font-style: italic;'>Email exist</p>";
				$flag = 1;
			}

			if($flag == 0){
				$sql="INSERT INTO register (name, address, email,password,dateadded,phone,salary_bracket_from,salary_bracket_to,occupation,business_areas_of_interest,invite_by,provider) VALUES ('".$data['name']."', '".$data['address']."', '".$data['email']."','".md5($data['password_again'])."','".time()."', '".$data['phone']."',".$data['salary_bracket_from'].",".$data['salary_bracket_to'].",'".$data['occupation']."','".$data['business_areas_of_interest']."','".$data['inviteby']."','".$data['provider']."')";
				$res = mysql_query($sql);
				if($res){
					$login_detail = mysql_query("SELECT * FROM register WHERE email = '".trim($data['email'])."' and password = '".md5($data['password_again'])."'");
					$_SESSION['login_register'] = 'yes';
					$_SESSION['detail'] = mysql_fetch_assoc($login_detail);
					echo(
					'<script>
					window.location.href=  "http://milliondollardesiclub.com/mddcconnect";
					window.close();
					</script>'
					);
					exit;
				}else{
					echo "<p style='color:red; font-style: italic;'>Fail. Please try again</p>";
				}
			}
			$_POST = NULL;
		}
	  ?>
</center>
<table width="60%" align="center" width="100%"  border="0" cellspacing="0" cellpadding="0" style="border-s" >
	<tr>
		<td width="35">&nbsp;</td>
		<td>
		<!--register-->
	<form name="form1" method="post" action="">

	<input name="inviteby" style="width:400px;" value="<?php echo $inviteby;?>" type="hidden" id="inviteby">
	<input name="provider" style="width:400px;" value="<?php echo $provider;?>" type="hidden" id="firstname">
	<table width="100%"  border="0" cellspacing="3" cellpadding="0">
		<tr>
			<td width="25%"  ><span >Name*: </span></td>
			<td width="86%"><input name="name" style="width:400px;" value="<?php echo stripslashes($FirstName);?>" type="text" id="firstname"></td>
		</tr>

		<tr>
			<td width="25%" >Email*: </td>
			<td><input name="email" style="width:400px;" type="text" id="email" value="<?php if($email!='') echo $email; ?>" size="30"/></td>
		</tr>
		<tr>
			<td width="25%" >Password*: </td>
			<td><input name="password" style="width:400px;" type="password" id="email" value="" size="30"/></td>
		</tr>
		<tr>
			<td width="25%" >Password again*: </td>
			<td><input name="password_again" style="width:400px;" type="password" id="email" value="" size="30"/></td>
		</tr>
		<tr>
			<td width="25%" >Address: </td>
			<td width="86%"><input name="address" style="width:400px;" value="" type="text" id="lastname"></td>
		</tr>
		<tr>
			<td width="25%" >Phone number: </td>
			<td width="86%"><input name="phone" style="width:400px;" value="" type="text" id="lastname"></td>
		</tr>

		<tr>
			<td width="25%" >Salary Bracket: </td>
			<td width="86%">From: <input name="salary_bracket_from" style="width:160px;" value="" type="text" id="lastname">&nbsp;To: <input name="salary_bracket_to" style="width:160px;" value="" type="text" id="lastname"></td>
		</tr>
		<tr>
			<td width="25%" >Occupation: </td>
			<td width="86%"><input name="occupation" style="width:400px;" value="" type="text" id="lastname"></td>
		</tr>
		<tr>
			<td width="25%" >Business Areas of Interest: </td>
			<td width="86%"><input name="business_areas_of_interest" style="width:400px;" value="" type="text" id="lastname"></td>
		</tr>

		</table>
		<div align="center">
		<p>Or Login by:</p>

				<script type="text/javascript" src="script.js"></script>
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
		<p><input type="submit" class="form_submit_button" name="Submit" style="background: #CFCE68; border: #CFCE68; width:80px; height: 25px; border-radius:3px;" value="Register">
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
