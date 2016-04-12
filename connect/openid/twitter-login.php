<?php
//ini_set('display_errors', 1);
session_start();
require_once('twitter/twitteroauth.php');
require_once('config-tw.php');



if (isset($_REQUEST['oauth_token'])){
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	$_SESSION['access_token_tw'] = $access_token;
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);
	if (200 == $connection->http_code) {
		GetLogin($connection);

	}else {
			echo '<script>';
			echo 'window.location.assign("twitter/clearsessions.php")';
			echo '</script>';
			exit();

		//header('Location: ./twitter/clearsessions.php');
	}
}elseif (empty($_SESSION['access_token_tw']) || empty($_SESSION['access_token_tw']['oauth_token']) || empty($_SESSION['access_token_tw']['oauth_token_secret'])) {
	/* If access tokens are not available redirect to connect page. */
  //  header('Location: ./twitter/clearsessions.php');
	echo '<script>';
	echo 'window.location.assign("twitter/clearsessions.php")';
	echo '</script>';
	exit();
}else{
	$access_token = $_SESSION['access_token_tw'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	GetLogin($connection);
}
?>
