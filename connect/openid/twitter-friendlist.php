<?php
	//ini_set('display_errors', 1);

	require_once('twitter/twitteroauth.php');
	require_once('config-tw.php');

	function GetFriendListString($src_name){
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$url="followers/list";
		$params = array(
		'screen_name' => $src_name,
		'count' => '200'
		);

		$content = $connection->get($url,$params);
		  $response_array = json_decode(json_encode($content));
		$str='';
		foreach ($response_array as $row1) {
		//	var_dump ($row1);
			foreach($row1 as $line){
				$str=$str.','.$line->id.'.'.$line->name.'.'.$line->screen_name;
			}
			break;
		}
		return $str;
	}

?>
