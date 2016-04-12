<?php
session_start();
//ini_set('display_errors', 1);
include ("../config.php");
include ("login_functions.php");
require ("../header_page.php");

require_once ("openid/twitter-friendlist.php");
if(isset($_POST['submit'])){
	$msg=base64_encode($_POST['tw-message']);

	$str=GetFriendListString($_POST['scr_name']);
	if($str!=''){
		$sql = 'INSERT INTO user_contactlists_temp (UserID,	ContactList) VALUES ("'.$_SESSION['detail']['id'].'","'.$str.'")';

		mysql_query($sql);
		$id=mysql_insert_id();
		echo('<script> window.location.href="' .$base_url. '/connect/?step=2&data='.$id.'&provider=twitter&msg='.$msg.'";</script>');
	}
}
?>

<link href="css/style.css" type="text/css" rel="Stylesheet" />
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<!--script type="text/javascript" src="js/script.js"></script-->
<div class="block">
	<form name="sendmail"  method="post" >
		<p>Enter your Screen name</p>
		<input id="scr_name" type="text" name="scr_name" class="text" /></br>
		<p>Enter your message</p>
		<textarea type="text" id="tw-message" name ="tw-message" class="text">Lets join in MDDC with me</textarea></br></br>
		<input id="submit" name="submit" class="button" style="width:auto !important;" type="submit" value="Search your friends"  />
	</form>
</div>
<?php
require ("../users/footer.php");
?>
