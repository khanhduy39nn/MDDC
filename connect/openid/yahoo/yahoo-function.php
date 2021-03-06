<?php
function sign_url( $url, $secret ) {
  $parts = parse_url( $url );

  $ts = time();
  $relative_uri = "";
  if ( isset( $parts["path"] ) ){
    $relative_uri .= $parts["path"];
  }
  if ( isset ( $parts["query" ] ) ) {
    $relative_uri .= "?" . $parts["query"] . "&ts=$ts";
  }

  $sig = md5( $relative_uri . $secret );

  $signed_url = $parts["scheme"] . "://" .  $parts["host"] . $relative_uri . "&sig=$sig";

  return $signed_url;
}
function getUniqueCode($length = "10") {
	$code = md5(uniqid(rand(), true));
	if ($length != "") return substr($code, 0, $length);
	else return $code;
}
function CallToYahoo($url = ''){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}
function ExplodeUrl($url=''){
	$responses = explode("&", $url);
	$rt = array();
	foreach($responses as $item) {
		$items = explode("=", $item);
		//$rt[$items[0]] = preg_replace('/\<\!\-\s*\d+\s*\-+>/','',$items[1]);
		$rt[$items[0]] = strip_tags($items[1]);
	}
	return $rt;
}
function callcontact($consumer_key, $consumer_secret, $guid, $access_token, $access_token_secret, $usePost=false, $passOAuthInHeader=true)
{
	require_once 'OAuth_helper.php';
	$retarr = array();  // return value
	$response = array();
	
	$url = 'http://social.yahooapis.com/v1/user/' . $guid . '/profile';
	$nonce = getUniqueCode();
	$timestamp = time()+600;
	$params['format'] = 'json';
	$params['view'] = 'compact';
	//$params['oauth_version'] = '1.0';
	//$params['oauth_nonce'] = $nonce;
	//$params['oauth_timestamp'] = $timestamp;
	//$params['oauth_consumer_key'] = $consumer_key;
	//$params['oauth_token'] = $access_token;

	// compute hmac-sha1 signature and add it to the params list
	//$params['oauth_signature_method'] = 'HMAC-SHA1';
	//$params['oauth_signature'] = oauth_compute_hmac_sig($usePost? 'POST' : 'GET', $url, $params, $consumer_secret, $access_token_secret);

	// Pass OAuth credentials in a separate header or in the query string
	if ($passOAuthInHeader) {
		$query_parameter_string = oauth_http_build_query($params, true);
		$header = build_oauth_header($params, "yahooapis.com");
		$headers[] = $header;
	} else {
		$query_parameter_string = oauth_http_build_query($params);
	}

	// POST or GET the request
	if ($usePost) {
		$request_url = $url;
		logit("callcontact:INFO:request_url:$request_url");
		logit("callcontact:INFO:post_body:$query_parameter_string");
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		$response = do_post($request_url, $query_parameter_string, 80, $headers);
	} else {
		$request_url = $url . ($query_parameter_string ?
							   ('?' . $query_parameter_string) : '' );
		logit("callcontact:INFO:request_url:$request_url");
		$response = do_get($request_url, 80, $headers);
	}

	// extract successful response
	if (! empty($response)) {
		list($info, $header, $body) = $response;
		if ($body) {
			logit("callcontact:INFO:response:");
			print(json_pretty_print($body));
		}
		$retarr = $response;
	}
	return $retarr;
}
?>