<?php
session_start();
//ini_set('display_errors', 1);
include ("../config.php");
include ("../login_functions.php");
require ("../header_page.php");

if(!isset($_COOKIE['facebooklist'])) {
    echo "Error!";
} else {
  $list=$_COOKIE['facebooklist'];
  $list= str_replace('\"',"",$list);
  $kq= explode(",", $list);
	$count=count($kq);
	$regCode=md5('pizza'.time());
	 $sql="INSERT INTO user_invites (UserID, Provider, FriendMail, Status, RegCode) VALUES ";
	for($i=0;$i<$count;$i++){
		$sql.= "('".$_SESSION['detail']['id']."','facebook','".$kq[$i]."',0,'".$regCode."'), ";
	}
	 $sql=trim($sql);
    $sql=substr($sql, 0, strlen($sql) - 1);
	mysql_query($sql);
	
}

?>

<link href="css/style.css" type="text/css" rel="Stylesheet" />
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script>
 setTimeout(function(){window.location.href="http://milliondollardesiclub.com/connect/";  }, 3000);
</script>
<div class="block">
Your MDDC Connect Invitation has been send to your friends successfully, please wait or click <a href="http://milliondollardesiclub.com/connect/"> here</a> to  redirect to MDDC Connect main page
</div>
<?php
require ("../../users/footer.php");
?>