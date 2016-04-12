<?php
define ('NO_HOUSE_KEEP', 'YES');

require("../config.php");
require ('admin_common.php');

if ($_REQUEST['BID']!='') {
	$BID = $_REQUEST['BID'];
} else {
	$BID = 1;

}


load_banner_constants($BID);

#
# Preload all block

if ($_REQUEST[user_id]!='') {
	$sql = "select block_id, status, user_id, image_data FROM blocks where status='sold' AND user_id=".$_REQUEST[user_id]." AND banner_id=$BID ";
} else {
	$sql = "select block_id, status, user_id, image_data FROM blocks where banner_id=$BID ";

}

$result = mysql_query ($sql) or die (mysql_error().$sql);
while ($row=mysql_fetch_array($result)) {
	$blocks[$row[block_id]] = $row['status'];	
	
	if ($row['image_data']!='') {
		$images[$row['block_id']]=imagecreatefromstring(base64_decode($row['image_data']));	
	}		
}

$cell =0;
if (function_exists("imagecreatetruecolor")) {
	$map = imagecreatetruecolor ( G_WIDTH*BLK_WIDTH, G_HEIGHT*BLK_HEIGHT );
} else {
	$map = imagecreate ( G_WIDTH*BLK_WIDTH, G_HEIGHT*BLK_HEIGHT );

}

	$block = imagecreatefromstring ( GRID_BLOCK );	
	$selected_block = imagecreatefromstring ( USR_SEL_BLOCK );
	$sold_block = imagecreatefromstring ( USR_SOL_BLOCK );
	
	$i=0; $j=0; $x_pos=0; $y_pos=0;

	for ($i=0; $i < G_HEIGHT; $i++) {
		for ($j=0; $j < G_WIDTH; $j++) {

			if ($images[$cell]!='') {
				imagecopy ( $map, $images[$cell], $x_pos, $y_pos, 0, 0, BLK_WIDTH, BLK_HEIGHT );
				imagedestroy($images[$cell]);

			} elseif($blocks[$cell]!='') {
				switch ($blocks[$cell]) {

					case 'reserved':

						imagecopy ( $map, $selected_block, $x_pos, $y_pos, 0, 0, BLK_WIDTH, BLK_HEIGHT );

						break;

					case 'sold':
						default:
						imagecopy ( $map, $sold_block, $x_pos, $y_pos, 0, 0, BLK_WIDTH, BLK_HEIGHT );
						break;
					}					
				
			} else {
				imagecopy ( $map, $block, $x_pos, $y_pos, 0, 0, BLK_WIDTH, BLK_HEIGHT );
			}
	
			$cell++;
			$x_pos += BLK_WIDTH; 		
		}
		$x_pos = 0;
		$y_pos += BLK_HEIGHT;
		
	}
	
	imagedestroy($block);
	imagedestroy($sold_block);
	
	header ("Content-type: image/x-png");
	header("Cache-Control: no-cache, must-revalidate"); 
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	imagepng($map);
	imagedestroy($map);

	foreach ($images as $img) {

		@imagedestroy($img);

	}
?>