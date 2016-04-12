<?php

session_start();
include ("../config.php");
include ("login_functions.php");

if(isset($_POST)){	
		if(!empty($_POST['captcha']) && !empty($_SESSION['captcha']['code']) && strtolower($_POST['captcha']) ==  strtolower($_SESSION['captcha']['code']) ){
			  $from = $_POST['Email'];
			  //$to = 	'huongthien1993@gmail.com';
			  $to = 	'admin@milliondollardesiclub.com';
			  $subject = 'Email contact from user';
			  $message = $_POST['message'];
			  $header = "From: ".$from." rn Reply-to: ".$from;	   
			  if ( mail($to, $subject, $message, $header) ) {
				header('Location: '.BASE_HTTP_PATH.'contact');
				exit;
			  } else {
				header('Location: '.BASE_HTTP_PATH.'contact');
				exit;
			  }	
		}else{
			header('Location: '.BASE_HTTP_PATH.'contact');
			exit;
		}
}else{	
		header('Location: '.BASE_HTTP_PATH.'contact');
		exit;
}

?>