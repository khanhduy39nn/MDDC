
<?php

include ("../config.php");
require ("../header_page.php");


if(!empty($_POST['friend'])) {
  $sql="INSERT INTO user_invites (UserID, Provider, FriendMail, Status, RegCode) VALUES ";
  $provider=$_POST['provider'];
    foreach($_POST['friend'] as $check) {
		$regCode=md5($check.time());
		$sql.= "('".$_SESSION['detail']['id']."','".$provider."','".$check."',0,'".$regCode."'), ";

    }
    $sql=trim($sql);
    $sql=substr($sql, 0, strlen($sql) - 1);
    mysql_query($sql);
}


?>

<link href="css/style.css" type="text/css" rel="Stylesheet" />
<link href="css/jquery-ui.css" type="text/css" rel="Stylesheet" />
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<p id="waiter" style="display:none">Please wait for a minute to processing</p>
<p id="count"></p>
  <input id="userID" name="userID" type="hidden" value="<?php echo $_SESSION['detail']['id'] ?>" />
  <br/>
  <div id="emailcontent">
	  <p>Type in your message to your friend(s)</p>
	  <textarea id="message" style="background-color:#224f5f;">Let's join in MDDC with me</textarea></br></br>
	  <input type="button" value="Send to your friend(s)" onclick="sendm()" style="background-color: #BEAA4B;width:144px;height: 20px;color:#D8E378 !important;" />
  </div>
<script>
  var count=2;
  var number=2;
function sendm(){
	$("#emailcontent").hide();
	$("#waiter").show();
	var emailContent=$("#message").val();
	//alert(emailContent);
	var userID=$("#userID").val();
	//$("#count").text(count);
	  $.ajax({
		type: "POST",
		url: "mail.php",
		data: { number: number,userID:userID,emailContent:emailContent}
	  }).done(function( msg ) {

    if(msg=="done")
    {
		window.location.assign("?step=4&id="+userID);
    }else{
      setTimeout(function(){
		count+=number;
        sendm();
      }, 1000);
    }

  });
}
 </script>

<?php

require ("../users/footer.php");
 ?>
