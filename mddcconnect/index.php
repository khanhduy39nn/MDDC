<?php
session_start();
if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes'){
	header("Location: ../profile/");
	exit;
}else{
	include 'require_login.php';
}
?>