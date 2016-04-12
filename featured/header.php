<?php 
include 'counter.php';
?>
<html>

<head>
<link rel='StyleSheet' type="text/css" href="http://milliondollardesiclub.com/users/style.css" >

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="en" />
<meta name="description" content="Million Dollar Desi Club" />
<meta name="keywords" content="Million Dollar Desi Club" />
<style type="text/css">


</style>

<title>Million Dollar Desi Club</title>

</head>

<body>
<?php

if (USE_AJAX=='SIMPLE') {
	$order_page = 'order_pixels.php';
} else {
	$order_page = 'select.php';
}

?>
<a href="http://milliondollardesiclub.com/"><img alt="Million Dollar Desi Club" src="<?php echo SITE_LOGO_URL; ?>"></a>
<div class="content-million" style='background-color: #ffffff; border-color:#C0C0C0; border-style:solid;padding:10px; color:#000;'>
<div class="menu_bar">
<a href="../" class="menu_bar">Home</a> | <a href="../users/order_pixels.php" class="menu_bar">Order Pixels</a>  
<form id="form-search" action="users/search.php"><input type="text" name="s" placeholder="search for business..."><input type="submit" class="btn-search" value=""></form>
</div>