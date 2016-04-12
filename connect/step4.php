
<?php
include ("../config.php");
require ("../header_page.php");
if(isset($_GET['id'])&&$_GET['id']!="")
{
	$sql = 'delete from user_invites where UserID='.$_SESSION['detail']['id'];
	mysql_query($sql);
}
?>
<link href="css/style.css" type="text/css" rel="Stylesheet" />
<link href="css/jquery-ui.css" type="text/css" rel="Stylesheet" />
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script>
 setTimeout(function(){window.location.href="http://milliondollardesiclub.com/connect/";  }, 3000);
</script>
Your MDDC Connect Invitation has been send to your friends successfully, please wait or click <a href="http://milliondollardesiclub.com/connect/"> here</a> to  redirect to MDDC Connect main page

<?php

require ("../users/footer.php");
 ?>
