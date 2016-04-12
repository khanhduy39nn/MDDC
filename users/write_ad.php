<?php
session_start();
include ("../config.php");
require_once ("../include/ads.inc.php");



if ($_REQUEST['BID']!='') {
	$BID=$_REQUEST['BID'];
} else {
$BID = 1; # Banner ID. Change this later & allow users to select multiple banners

}

$sql = "select * from temp_orders where session_id='".addslashes(session_id())."' ";

$order_result = mysql_query ($sql) or die(mysql_error());

if (mysql_num_rows($order_result)==0) {
	require ("header.php");
	?>
<h1><?php echo $label['no_order_in_progress']; ?></h1>
<p><?php echo $label['no_order_in_progress_go_here'] = str_replace ('%ORDER_PAGE%', $order_page ,  $label['no_order_in_progress_go_here']); //echo $label['no_order_in_progress_go_here']; ?></p>

	<?php
	require ("footer.php");
	die();

}

require ("header.php");
?>
<div style="width:50%; float:left; display:block;">
<?php
$row = mysql_fetch_array($order_result);


//print_r (unserialize( $row['block_info']));
update_temp_order_timestamp();

$has_packages = banner_get_packages($BID);

//$sql = "select * from banners where banner_id='$BID'";
//$result = mysql_query ($sql) or die (mysql_error().$sql);
//$b_row = mysql_fetch_array($result);


?>
<p>
<?php 
$sStep = mysql_fetch_assoc(mysql_query("select step from temp_orders where session_id='".addslashes(session_id())."'"));
show_nav_status (2, $sStep['step']);

?>
</p>
<h3><?php $label['write_ad_instructions']; ?></h3>
<?php

$_REQUEST['user_id'] = addslashes(session_id());

if ($_REQUEST['save'] != "" ) { // saving
	
	$error = validate_ad_data(1);
	if ($error != '') { // we have an error
		$mode = "edit";
		//display_ad_intro();
		
		display_ad_form (1, $mode, '');
	} else {
	
		$ad_id = insert_ad_data();

		// save ad_id with the temp order...
		$step = mysql_fetch_assoc(mysql_query("select step from temp_orders where session_id='".addslashes(session_id())."'"));
		if($step['step'] >= 2){
			$sql = "UPDATE temp_orders SET ad_id='$ad_id' where session_id='".addslashes(session_id())."' ";
		}else{
			$sql = "UPDATE temp_orders SET ad_id='$ad_id',step = 2 where session_id='".addslashes(session_id())."' ";
		}
		//echo $sql;
		$result = mysql_query($sql) or die(mysql_error());
		

		$prams = load_ad_values ($ad_id);
		//print_r($prams);
		//exit;

		?>
		<center><div class='ok_msg_label'><input type="button"  class='big_button' value="<?php echo $label['write_ad_saved']." ".$label['write_ad_continue_button']; ?>" onclick="window.location='confirm_order.php'"></div></center>
		<p>&nbsp;</p>
		<?php
		display_ad_form (1, "edit", $prams);
	}
} else {

	// get the ad_id form the temp_orders table..
	$sql = "SELECT ad_id FROM temp_orders WHERE session_id='".addslashes(session_id())."' ";
	$result = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($result);
	$ad_id = $row['ad_id'];
	//echo "adid is: ".$ad_id;
	$prams = load_ad_values ($ad_id); // user is not logged in
	//echo "<pre>";
	//print_r($prams);
	//exit;
	display_ad_form (1, 'edit', $prams);
}
?>
</div>
<?php 
	$sql = "SELECT youtube_url FROM settings WHERE id=1";
	$result = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
?>
<div id="oyoutube" style="display:block; text-align:center; padding-top:44px;" >
	<object style="height: 299px; width: 398px; margin-left:auto; margin-right:auto;">
		<param name="movie" value="http://www.youtube.com/v/<?php echo $row['youtube_url']; ?>?version=3&color1=0xb1b1b1&color2=0xcfcfcf&iv_load_policy=3&feature=player_embedded">
		<param name="allowFullScreen" value="true">
		<param name="allowScriptAccess" value="always">
		<param name="wmode" value="transparent">
		<embed src="http://www.youtube.com/v/<?php echo $row['youtube_url']; ?>?version=3&color1=0xb1b1b1&color2=0xcfcfcf&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" wmode="transparent" transparent="true" allowScriptAccess="always" width="398" height="288">
	</object>
</div>
<div style="clear:both;"></div>
<?php
require ("footer.php");
?>