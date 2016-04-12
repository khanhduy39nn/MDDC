<?php
session_start();
include ("config.php");

$strXML = file_get_contents('http://www.irmsolutions.co.uk/feeds.php');

$xml = simplexml_load_string($strXML, "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$arr_xml = json_decode($json,TRUE);

//Feed xml for webiste http://www.irmsolutions.co.uk/
$website_id = "1";
mysql_query("DELETE FROM jobs WHERE website_id = ".$website_id." && lfj = 1");


foreach($arr_xml['jobs']['job'] as $job){
	$rs = mysql_query("insert into jobs (url,id_jobs_site,id_user,title,description,type,location,views,dateadded,status,job,pay_from,pay_to,currency,frequency,consultants_forename,consultants_surname,consultants_email, website_id, expiry,lfj) values ('".$url."',".$job['id'].",0,'".$job['title']."','".$job['description']."','".$job['sector']."','".$job['country']."',0,".$job['added'].",1,'".$job['sector']."',".$job['price_from'].",".$job['price_to'].",'".$job['currency']."','".$job['frequencies_name']."','".$job['consultants_forename']."','".$job['consultants_surname']."','".$job['consultants_email']."',".$website_id.",".$job['expiry'].",1)");	
}
$sql = mysql_query("select id,title from jobs");
while($row = mysql_fetch_assoc($sql)){
	$url = makeSlugs($row['title'],200).'-'.$row['id'];
	mysql_query("update jobs set url = '".$url."' where id = ".$row['id']);
}
?>
