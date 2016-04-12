<?php
ini_set('display_errors', 1);
require_once('twitter/twitteroauth.php');
require_once('config-tw.php');
function Login($user){
	
echo "<pre>"; var_dump($user); echo "</pre>"; 
}

if (isset($_REQUEST['oauth_token'])){
	if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
		$_SESSION['oauth_status'] = 'oldtoken';
		//header('Location: ./twitter/clearsessions.php');
			echo '<script>';
			echo 'window.location.assign("twitter/clearsessions.php")';
			echo '</script>';
			exit();
	}
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	$_SESSION['access_token'] = $access_token;
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);
		var_dump($access_token['oauth_token']);
	var_dump($access_token['oauth_token_secret']);
	if (200 == $connection->http_code) {
		$_SESSION['status'] = 'verified';
			$url="direct_messages/new";
	$params = array(
		'screen_name' => "K8hpm",
		'text' => "chào 8hpm. http://google.com",
		'user_id' => "4673657832"
	);

	$content = $connection->post($url,$params);
		Login($content);
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
	var_dump($access_token['oauth_token']);
	var_dump($access_token['oauth_token_secret']);
	//$content = $connection->get('account/verify_credentials');
	$_SESSION['status'] = 'verified';
		$url="direct_messages/new";
	$params = array(
		'screen_name' => "K8hpm",
		'text' => "chào 8hpm. http://google.com",
		'user_id' => "4673657832"
	);

	$content = $connection->post($url,$params);
	Login($content);
	die('DONE');
	/* Some example calls */
	//$connection->get('users/show', array('screen_name' => 'abraham'));
	//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
	//$connection->post('statuses/destroy', array('id' => 5437877770));
	//$connection->post('friendships/create', array('id' => 9436992));
	//$connection->post('friendships/destroy', array('id' => 9436992));
}
?>