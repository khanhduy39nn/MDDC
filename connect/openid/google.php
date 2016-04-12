<?php
	session_start();
	//ini_set('display_errors', 1);
	if(isset($_GET['connect'])){
		$_SESSION['getType']='connect';
	  }else if(isset($_GET['login'])){
		$_SESSION['getType']='login';
	  }
	if(isset($_GET['url']))
		$_SESSION['url']=base64_decode($_GET['url']);

try {
	require_once dirname( __FILE__ ).'/config-gg.php';
	require_once dirname( __FILE__ ).'/Google/Client.php';
	require_once dirname( __FILE__ ).'/Google/Service/Oauth2.php';

	$client = new Google_Client();
	$client->setApplicationName(APP_NAME);
	$client->setClientId(CLIENT_ID);
	$client->setClientSecret(CLIENT_SECRET);
	$client->setRedirectUri(REDIRECI_URL);
	$client->addScope("https://www.googleapis.com/auth/plus.me");
	$client->addScope("https://www.google.com/m8/feeds");

	//Send Client Request

	//echo filter_var($redirect_uri, FILTER_SANITIZE_URL);
	//die();
	$objOAuthService = new Google_Service_Oauth2($client);
	if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token_gg'] = $client->getAccessToken();
		 echo(
        '<script>
        window.location.assign("'.REDIRECI_URL.'");
        </script>'
        );
	}

	//Set Access Token to make Request
	if (isset($_SESSION['access_token_gg']) && $_SESSION['access_token_gg']) {
		
		try{
			$client->setAccessToken($_SESSION['access_token_gg']);
		} catch (Exception $e) {
			$result =json_decode($_SESSION['access_token_gg']);
			$client->setAccessToken($result->access_token);
		}

	}

	//Get User Data from Google Plus
	//If New, Insert to Database
	if ($client->getAccessToken()) {
		$userData = $objOAuthService->userinfo->get();

		$_SESSION['access_token_gg'] = $client->getAccessToken();



	} else {
		$authUrl = $client->createAuthUrl();
	}
	if (isset($authUrl)){
		  echo(
        '<script>
        window.location.assign("'.$authUrl.'");
        </script>'
        );
		die();
	}else{
		if($_SESSION['getType']=='connect'){
			GetContact();
		}else if($_SESSION['getType']=='login'){
			GetLogin($userData);
		}


	}
} catch(ErrorException $e) {
    echo $e->getMessage();
}
function GetLogin($userData){

	$id=$userData->id;
	 $sql="SELECT * FROM register WHERE social_type='".$_SESSION['social_type']."' and social_id = '".$id."'";

		  $login_detail = mysql_query($sql);
      if(mysql_num_rows($login_detail) == 1){
        $_SESSION['login_register'] = 'yes';
        $_SESSION['detail'] = mysql_fetch_assoc($login_detail);
        echo(
        '<script>
        window.opener.location.assign("'.$_SESSION['url'].'");
        window.close();
        </script>'
        );
      }else{
        $_SESSION['social_type']='google';
        $_SESSION['social_id']=$id;
        $_SESSION['social_name']=$userData->name;
        echo(
        '<script>
        window.opener.location.assign("http://milliondollardesiclub.com/register/registerbysocial.php");
        window.close();
        </script>'
        );
        die();
      }
}
function GetContact(){
		$result =json_decode($_SESSION['access_token_gg']);
		$url = 'https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=500&oauth_token=' .$result->access_token;
		$content=file_get_contents($url);
		$json=json_decode($content);
		$count=count($json->feed->entry);
		$strd="";
		for($i=0;$i<$count;$i++){
			$str=json_encode($json->feed->entry[$i]);
			str_replace("gd$email","email",$str);
			$array=json_decode($str);
			$o=0;
			foreach($array as $ix){
				if($o==5){
				if($ix[0]->address!='')
				{
					//echo $ix[0]->address;
					$strd= $strd.','.$ix[0]->address;
				}
				break;
				}
				$o++;
			}

		}
		if($strd!=''){
		$sql = 'INSERT INTO user_contactlists_temp (UserID,	ContactList) VALUES ("'.$_SESSION['detail']['id'].'","'.$strd.'")';

			mysql_query($sql);
			$id=mysql_insert_id();
			echo('<script> window.opener.parent.location.href="http://milliondollardesiclub.com/connect/?step=2&data='.$id.'&provider=google"; window.close();</script>');
		}
}
?>
