<?php
	session_start();
	//ini_set('display_errors', 1);
	require 'config_yahoo.php';
	require("yahoo/Yahoo.inc");  

	define('OAUTH_CONSUMER_KEY', CLIENT_ID);
	define('OAUTH_CONSUMER_SECRET', CLIENT_SECRET);
	define('OAUTH_DOMAIN', 'http://milliondollardesiclub.com/');
	define('OAUTH_APP_ID', APP_ID);
	
	//for converting xml to array
	function XmltoArray($xml) {
        $array = json_decode(json_encode($xml), TRUE);
       
        foreach ( array_slice($array, 0) as $key => $value ) {
            if ( empty($value) ) $array[$key] = NULL;
            elseif ( is_array($value) ) $array[$key] = XmltoArray($value);
        }

        return $array;
    }


	if(array_key_exists("logout", $_GET)) {
	  // if a session exists and the logout flag is detected
	  // clear the session tokens and reload the pag.
	  YahooSession::clearSession();
	
	 echo(
        '<script>
        location.reload();
        </script>'
        );
	}

	$hasSession = YahooSession::hasSession(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_APP_ID);

	// pass the credentials to initiate a session
	$session = YahooSession::requireSession(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET, OAUTH_APP_ID);

	// if the in_popup flag is detected,
	// the pop-up has loaded the callback_url and we can close this window.
	if(array_key_exists("in_popup", $_GET)) {
		close_popup();
		exit;
	}

	// if a session is initialized, fetch the user's profile information
	if($session) {
		// Get the currently sessioned user.
		$user = $session->getSessionedUser();
		//$profile=$user->getProfile();
		//$Contacts=$user->getContacts();
		//$contactsync=$user->getContactSync();
		//$contact=$contactsync->contactsync->contacts[0];
		//foreach($contactsync->contactsync->contacts[0])
		
		  $profile_contacts=XmltoArray($user->getContactSync());
		   $contacts=array();
		   foreach($profile_contacts['contactsync']['contacts'] as $key=>$profileContact){
			   foreach($profileContact['fields'] as $contact){
				  $contacts[$key][$contact['type']]=$contact['value'];
			   }
		   }
		   
		$str="";
		foreach($contacts as $email){
			if($email['email']!='')
				$str= $str.','.$email['email'];
		}
		//echo $str;
			if($str!=''){
		$sql = 'INSERT INTO user_contactlists_temp (UserID,ContactList) VALUES ("'.$_SESSION['detail']['id'].'","'.$str.'")';
		
		
		mysql_query($sql);
		$id=mysql_insert_id();
		echo('<script> window.opener.parent.location.href="' .$base_url. '/?step=2&data='.$id.'&provider=yahoo"; window.close();</script>');
	}

	}
	
	