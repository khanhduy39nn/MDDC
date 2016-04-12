<?php
session_start();
include ("../config.php");
include ("login_functions.php");
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
<img alt="Million Dollar Desi Club" src="http://milliondollardesiclub.com/logo.gif">
<div class="content-million" style='background-color: #ffffff; border-color:#C0C0C0; border-style:solid;padding:10px; color:#000;'>
<div class="menu_bar">
<a href="index.php" class="menu_bar">Home</a>  | <a href="order_pixels.php"  class="menu_bar">Buy Pixels</a>  <form id="form-search" action="users/search.php"><input type="text" name="s" placeholder="search for business..." ><input type="submit" class="btn-search" value=""></form>
</div>
<h1>Search Result</h1>
<?php
$where = "";	
if(!empty($_GET['s'])){
	$where .=  "and city like '%".$_GET['s']."%' ";
}
if(!empty($_GET['location'])){
	$where .=  " and country like '%".$_GET['location']."%' ";
}
if(!empty($_GET['type'])){
	$where .=  "and buss_type like '%".$_GET['type']."%'  ";
}

$sql = "SELECT * FROM users WHERE 1 ".$where;

$result = mysql_query ($sql) or die (mysql_error().$sql);
if(mysql_num_rows($result) > 0){
    $arr_id = array();
    while($user = mysql_fetch_assoc($result)){
      $arr_id[] =   $user['ID'];
    }
    $sql = "SELECT ad_id FROM orders WHERE user_id IN (".implode(',',$arr_id).") and status = 'completed'";
    $res = mysql_query($sql);
    
    if(mysql_num_rows($res) == 0){ 
         echo '<h4>No result found!</h4>';      
    }else{
        $arr_id = array();
        while($ad = mysql_fetch_assoc($res)){
          $arr_id[] =   $ad['ad_id'];
        }
        $sql = "SELECT ads.*, users.buss_type, users.CompName FROM ads, users WHERE ad_id IN (".implode(',',$arr_id).") and ads.user_id = users.ID";
        $res = mysql_query($sql);
        if(mysql_num_rows($res) == 0){ 
            echo '<h4>No result found!</h4>';
        }else{
       
?>
<table width="100%" cellspacing="1" cellpadding="3" align="center" bgcolor="#d9d9d9" border="0">
    <tbody>
        <tr>
            <td><b><font face="Arial" size="2">Bussiness Type</font></b></td>
            <td><b><font face="Arial" size="2">Bussiness Name</font></b></td>
            <td><b><font face="Arial" size="2">Ad Name</font></b></td>
            <td><b><font face="Arial" size="2">URL</font></b></td>
        	<td><b><font face="Arial" size="2">Pixels</font></b></td>
        </tr>
        <?php 
           while($row = mysql_fetch_assoc($res)) {
        ?>
        <tr onmouseover="old_bg=this.getAttribute('bgcolor');this.setAttribute('bgcolor', '#FBFDDB', 0);" onmouseout="this.setAttribute('bgcolor', old_bg, 0);" bgcolor="#ffffff">
            <td><font face="Arial" size="2"><?php echo $row['buss_type']; ?></font></td>
            <td><font face="Arial" size="2"><?php echo $row['CompName']; ?></font></td>
            <td><font face="Arial" size="2"><?php echo $row['1']; ?></font></td>
        	<td><font face="Arial" size="2"><a target="_blank" href='<?php echo $row['2']; ?>'><?php echo $row['2']; ?></a></font></td>
            <td><font face="Arial" size="2"><img src='get_order_image.php?BID=<?php echo $row['banner_id']; ?>&aid=<?php echo $row['ad_id']; ?>' /></font></td> 
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php
        }
    }
}else{
?>
    <h4>No result found!</h4>
<?php
}

require ("footer.php");
?>