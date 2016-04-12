<?php

/**
* @file
* Check if consumer token is set and if so send user to get a request token.
*/

/**
* Exit with an error message if the CONSUMER_KEY or CONSUMER_SECRET is not defined.
*/
require_once('../config-tw.php');
if (CONSUMER_KEY === '' || CONSUMER_SECRET === '' || CONSUMER_KEY === 'CONSUMER_KEY_HERE' || CONSUMER_SECRET === 'CONSUMER_SECRET_HERE') {
  echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a>';
  exit;
}
header('location: redirect.php');
?>