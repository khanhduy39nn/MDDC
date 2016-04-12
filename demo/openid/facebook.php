 <?php 
	session_start(); 
	//ini_set('display_errors', 1);
	require dirname( __FILE__ ).'/config_facebook.php';
	require dirname( __FILE__ ).'/Fb/facebook.php';

	$facebook = new Facebook(array(
	'appId' => '1519815598316380',
	'secret' => '7b0c175b1bd903a70d21add45c9d9860',
	'cookie' => true
	));
				
	
		$user = $facebook->getUser();
		$loginUrl = $facebook->getLoginUrl();

	if ( !isset($_GET['code']) ) {
		echo("<script> top.location.href='" . $loginUrl . "'</script>");
		exit();
	}else{
		echo(
		'<script>
		window.opener.location.assign("http://milliondollardesiclub.com/connect/facebook-invite.php");
		window.close();
		</script>'
		);
		die();
	}
	
?>
<!doctype html>
<html>
<head>
  <title>Send An Application Request Using The Facebook Graph API</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
		FB.init({
		appId:'1519815598316380',
		cookie:true,
		status:true,
		xfbml:true
		});
		
  function FBInvite(){
  FB.ui({
   method: 'apprequests',
   message: 'Invite your Facebook Friendsaa'
  },function(response) {
   if (response) {
	   console.log( JSON.stringify(response) );
    alert('Successfully Invited');
   } else {
    alert('Failed To Invite');
   }
  });
 }
   
   
</script>
</head>
<body>
 <div id="fb-root"></div>


<a href="#" onclick="FBInvite()">Send Application Request</a>

 </body>
</html>