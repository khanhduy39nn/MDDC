<?php
session_start();
require "config.php";

if(!isset($_SESSION['login_register']) && $_SESSION['login_register'] != 'yes'){
	header("Location: http://milliondollardesiclub.com/index1.php");
	exit;
}

if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes'){
	unset($_SESSION['login_register']);
	unset($_SESSION['login_register_info']);
}
?>		
<html>
<head>

<link rel="stylesheet" type="text/css" href="../users/style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="en" />
<meta name="description" content="Million Dollar Desi Club" />
<meta name="keywords" content="Million Dollar Desi Club" />
</head>
<body>
<center><a href="http://milliondollardesiclub.com/" title="Million Dollar Desi Club"><img alt="Million Dollar Desi Club" src="<?php echo SITE_LOGO_URL; ?>"/></a><br/>
      <h3>You are log out!</h3></center> 
<script>
	function redirect(){
	   window.location = "http://milliondollardesiclub.com/index1.php";
	}
	setTimeout(redirect, 3000);
</script>
<?php 
    include 'footer.php';
?>
</body>

</html>

