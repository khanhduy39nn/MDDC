<?php 
	include "config.php";
	if(isset($_SESSION['login_qlns']) && isset($_SESSION['id_nv'])){
		unset($_SESSION['login_qlns']);
		unset($_SESSION['id_nv']);
		header("Location: login.php");
		exit;
	}
?>