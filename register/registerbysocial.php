<?php
session_start();
require "../config.php";


function full_path()
{
    $s = &$_SERVER;
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    $uri = $protocol . '://' . $host . $s['REQUEST_URI'];
    $segments = explode('?', $uri, 2);
    $url = $segments[0];
    return $url;
}
?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="../users/style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="en" />
<meta name="description" content="Million Dollar Desi Club" />
<meta name="keywords" content="Million Dollar Desi Club" />
<script type="text/javascript" src="script.js"></script>
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



			$num = mysql_num_rows(mysql_query("SELECT * FROM register WHERE email = '".$data['email']."'"));
			if($num == 1){
				echo "<p style='color:red; font-style: italic;'>Email exist</p>";
				$flag = 1;
			}

			if($flag == 0){
				$pass=md5($_SESSION["social_id"].'duy');
				$sql="INSERT INTO register (name, address, email,password,dateadded,phone,salary_bracket_from,salary_bracket_to,occupation,business_areas_of_interest,social_type,social_id) VALUES ('".$data['name']."', '".$data['address']."', '".$data['email']."','".$pass."','".time()."', '".$data['phone']."','".$data['salary_bracket_from']."','".$data['salary_bracket_to']."','".$data['occupation']."','".$data['business_areas_of_interest']."','".$_SESSION["social_type"]."','".$_SESSION["social_id"]."')";
				$res = mysql_query($sql);
				if($res){
					$sql="SELECT * FROM register WHERE social_type='".$_SESSION["social_type"]."' and social_id = '".$_SESSION["social_id"]."'";

					$login_detail = mysql_query($sql);
					$_SESSION['login_register'] = 'yes';
					$_SESSION['detail'] = mysql_fetch_assoc($login_detail);
          $_SESSION['social_name']='';
          $_SESSION['social_email']='';
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
	<table width="100%"  border="0" cellspacing="3" cellpadding="0">
		<tr>
			<td width="25%"  ><span >Name*: </span></td>

			<td width="86%">
				<input name="name" style="width:400px;" value="<?php if(isset($_SESSION["social_name"])) echo $_SESSION["social_name"]?>" type="text" id="firstname">
			</td>
		</tr>

		<tr>
			<td width="25%" >Email*: </td>
			<td><input name="email" style="width:400px;" type="text" id="email" value="<?php if(isset($_SESSION["social_email"])) echo $_SESSION["social_email"]?>" size="30"/></td>
		</tr>
		</table>
		<div align="center">
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
