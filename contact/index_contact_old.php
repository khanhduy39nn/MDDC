<?php
session_start();
include ("../config.php");
include ("login_functions.php");

require ("../header_page.php");
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<style type="text/css">
.block-img {
    display: block;
    float: left;
    max-width:300px; 
    max-height:300px;
    margin-right:10px;
    margin-bottom:10px;
}
.content-lef {
   width: 700px;
  display: block;   
}

h1 {
 font-size:30px;  
 margin-bottom:25px;
}
.content-million .author i {
    color: #3D05E4 !important;
}
</style>
<style>
  #map-canvas {
	width: 500px;
	height: 350px;
	margin-left: auto;
   margin-right: auto;
  }
</style>
<?php 
$sql = "select contact,glong, glat from settings where id = 1";
$result = mysql_query($sql) or die(mysql_error());
$contact = mysql_fetch_assoc($result);
?>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
  function initialize() {
	var mapCanvas = document.getElementById('map-canvas');
	var mapOptions = {
	  <?php if(!empty($contact['glat']) && !empty($contact['glong'])){ ?>
		center: new google.maps.LatLng(<?php echo $contact['glat']; ?>, <?php echo $contact['glong']; ?>),
	  <?php }else{ ?>
		  center: new google.maps.LatLng(44.5403, -78.5463),
	  <?php } ?>
	  zoom: 14,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(mapCanvas, mapOptions)
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php 
$sql = "select contact from settings";
$result = mysql_query($sql) or die(mysql_error());
$contact = mysql_fetch_assoc($result);
?>
<div class="block">
<h1>Contact Us</h1>
<br>
<div><?php echo $contact['contact']; ?></div>
<!-- COntact -->
<!--<div style="width:600px; margin-left:auto; margin-right:auto;">	
		<form method="post" action="send_contact.php">
			<table id="form_contact" border="0" cellspacing="5" cellpadding="5" style="float:left; margin-left: auto;margin-right: auto; width:700px;">		
				<tr>
					<td width="20%" style="text-align:right !important; font-size:1.3em;">First Name: </td>
					<td width="80%"><input name="FirstName" style="width:400px;color:#000 !important;" value="" type="text" id="firstname"></td>
				</tr>
				<tr>
					<td width="20%" style="text-align:right !important; font-size:1.3em;">Last Name: </td>
					<td width="80%"><input name="LastName" style="width:400px;color:#000 !important;" value="" type="text" id="lastname"></td>
				</tr>				
				<tr>
					<td width="20%" style="text-align:right !important; font-size:1.3em;">E-mail: </td>
					<td><input name="Email" style="width:400px;color:#000 !important;" type="text" id="email" value="" size="30"></td>
				</tr>
				<tr>
					<td width="20%" style="text-align:right !important;font-size:1.3em;">Message: </td>
					<td><textarea name="message" style="width:400px;color:#000 !important;" ></textarea></td>
				</tr>
				
				<tr>
					<td width="20%" style="text-align:right !important;font-size:1.3em;">Captcha</td>
					<td style="vertical-align:top;">						
						<input name="captcha" style="width:200px;color:#000 !important;" type="text" placeholder="Type captcha code" value="" size="30">
						<?php 
							include("simple-php-captcha.php");
							$_SESSION['captcha'] = simple_php_captcha();
							echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
						?>						
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center !important;"><input type="submit" name="btnsm" value="Send" style="background-color:#BEAA4B; width:80px; height:20px;"	/></td>				
				</tr>			
			</table>		
		</form>	
</div>-->
<div style="clear:both;"></div>
<!-- /.COntact -->
</div>
<?php
require ("../users/footer.php");
?>