<?php
ini_set('display_errors', 1);
require_once('twitter/twitteroauth.php');
require_once('config-tw.php');
function Login($content){

echo "<pre>"; var_dump($content); echo "</pre>";
}
function sendMessage($id,$mess,$connection){
			$url="direct_messages/new";
			$params = array(
				'text' => $mess,
				'user_id' => $id
			);
			$content = $connection->post($url,$params);
			Login($content);
}

if (isset($_REQUEST['oauth_token'])){
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	$_SESSION['access_token'] = $access_token;
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);
	if (200 == $connection->http_code) {
		sendMessage('4673657832','chao Duy 1',$connection);
		die('DONE');
	}else {
					echo '<script>';
			echo 'window.location.assign("twitter/clearsessions.php")';
			echo '</script>';
			exit();

		//header('Location: ./twitter/clearsessions.php');
	}
}elseif (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
	/* If access tokens are not available redirect to connect page. */
  //  header('Location: ./twitter/clearsessions.php');
				echo '<script>';
			echo 'window.location.assign("twitter/clearsessions.php")';
			echo '</script>';
			exit();

}else{
	$access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

	sendMessage('4673657832','chao Duy 1',$connection);
	//Login($content);
	die('DONE');

}
?>
