<?php
session_start();
//Thien added check logged in user 29122015
if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes'){ 	
	switch ($_GET['step']) {
		  case '1':
			require 'step1.php';
			break;
		  case '2':
				require 'step2.php';
				break;
		  case '3':
				require 'step3.php';
				break;
		 case '4':
			  require 'step4.php';
			  break;
		 case 'success':
			  require 'step4.php';
			  break;	  
		  default:
			  require 'step1.php';
			  break;
	}
	die();
}else{
	header("Location: ../mddcconnect/");
	exit;
}
?>
