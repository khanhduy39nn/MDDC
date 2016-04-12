<?php
//ini_set('display_errors', 1);
session_start();
require_once('twitter/twitteroauth.php');
require_once('twitter/OAuth.php');
require_once('config-tw.php');
$redirect_url="";
if(isset($_GET['connect'])){
	$_SESSION['getType']='connect';
}else if(isset($_GET['login'])){
	$_SESSION['getType']='login';
}

if(isset($_POST['tw-message'])){
	$_SESSION['msg']=$_POST['tw-message'];
}


//save friendlist into db for send msg
if(!empty($_POST['friend'])) {
  $sql="INSERT INTO user_invites (UserID, Provider, FriendMail, Status, RegCode) VALUES ";
  	$provider='twitter';
    foreach($_POST['friend'] as $check) {
			$regCode=md5($check.time());
			$sql.= "('".$_SESSION['detail']['id']."','".$provider."','".$check."',0,'".$regCode."'), ";
		}
    $sql=trim($sql);
    $sql=substr($sql, 0, strlen($sql) - 1);
    mysql_query($sql);
}


function sendMessage($connection){
	//for login
	if($_SESSION['getType']=='login'){
		$content = $connection->get('account/verify_credentials');
		$sql="SELECT * FROM register WHERE social_type='twitter' and social_id = '".$content->id."'";
		$login_detail = mysql_query($sql);
		if(mysql_num_rows($login_detail) == 1){
			$_SESSION['login_register'] = 'yes';
			$_SESSION['detail'] = mysql_fetch_assoc($login_detail);
			$url='http://milliondollardesiclub.com/mddcconnect';
			echo(
			'<script>
			window.opener.location.assign("'.$url.'");
			window.close();
			</script>'
			);
		}else{
			$_SESSION['social_type']='twitter';
			$_SESSION['social_id']=$content->id;
			echo(
			'<script>
			window.opener.location.assign("http://milliondollardesiclub.com/register/registerbysocial.php");
			window.close();
			</script>'
			);
			die();
		}
		exit();
	}
	else
	//for connecty
	if($_SESSION['getType']=='connect'){

		$sql="select * from user_invites where Status=0 and UserID='".$_SESSION['detail']['id']."'";

		$mailsList = mysql_query($sql);
		$a=mysql_num_rows ( $mailsList );
			while ($row = mysql_fetch_assoc($mailsList)) {
				//$sql = 'INSERT INTO TestSendMail (Email) VALUES ("'.$row['FriendMail'].'")';
				$mess=$_SESSION['msg'].' http://milliondollardesiclub.com/register/registerbyinvite.php/?regcode='.$row['RegCode'];
				$url="direct_messages/new";
				$params = array(
					'text' => $mess,
					'user_id' =>$row['FriendMail']
				);
				$content = $connection->post($url,$params);
				$sql2 = 'update user_invites set Status=1 where ID='.$row['ID'];
				echo $mess;
				mysql_query($sql2);
			}

	}
	echo '<script>';
	echo 'window.location.assign("../?step=4")';
	echo '</script>';
	exit();
}

if(!isset($_GET['oauth_token'])){
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,'','');
	$request_token = $connection->getRequestToken("http://milliondollardesiclub.com/connect/openid/?serviceid=1");
	$_SESSION['oauth_token']=$request_token['oauth_token'];
	$_SESSION['oauth_token_secret']=$request_token['oauth_token_secret'];
	$url=$connection->getAuthorizeURL($request_token);
	echo 'Loading...';
	echo(
		 '<script>
		 window.location.assign("'.$url.'");
		 </script>'
		 );

}else
if (isset($_GET['oauth_token'])){
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

	$access_token = $connection->getAccessToken($_GET['oauth_verifier']);
	$_SESSION['access_token'] = $access_token;

		sendMessage($connection);
		exit();
}

?>
