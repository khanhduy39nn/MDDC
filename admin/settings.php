<?php
require("../config.php");
require ('admin_common.php');

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>Settings</title>
<script language="javascript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
</head>
<body>
 <?php 
//uRL 
		if(!empty($_POST['youtube_link'])){		
			$youtube_video_id = '';
			if($_POST['youtube_link'] != ''){
				$str_arr = explode('?',$_POST['youtube_link']);
				$str = $str_arr['1'];
				$str_arr = explode('&',$str);
				foreach($str_arr as $txt){
					$tmp = explode('=',$txt);	
					if($tmp['0'] == 'v'){
						$youtube_video_id = $tmp['1'];
					}
				}
			}	
			
			$sql = 'UPDATE settings SET youtube_url = "'.$youtube_video_id.'", youtube_link = "'.$_POST['youtube_link'].'" WHERE id = 1';			
			$res_url = mysql_query($sql);			   						
		}

//contact
if(!empty($_POST['contact'])){			
	$sql = "UPDATE settings SET contact = '".$_POST['contact']."'  WHERE id = 1";						
	$res_contact = mysql_query($sql);			   				
}		
//scholarship
if(!empty($_POST['scholarship'])){			
	$sql = "UPDATE settings SET scholarship = '".$_POST['scholarship']."'  WHERE id = 1";						
	$res_contact = mysql_query($sql);			   				
}		
//maps
	if(!empty($_POST['glat']) && !empty($_POST['glong'])){			
		$sql = "UPDATE settings SET glat = '".$_POST['glat']."' , glong = '".$_POST['glong']."' WHERE id = 1";						
		$res_map = mysql_query($sql);			   						
	}	
//services
	if(!empty($_POST['services'])){			
		$sql = 'UPDATE settings SET services = "'.$_POST['services'].'" WHERE id = 1';			
		$res_sv = mysql_query($sql);			   				
	}
//popup
	if(!empty($_POST['popup'])){			
		$sql = 'UPDATE settings SET popup = "'.$_POST['popup'].'" WHERE id = 1';			
		$res_popup = mysql_query($sql);			   				
	}	
	
$sql = "SELECT * FROM settings WHERE id = 1";
$res_sql = mysql_query($sql) or die(mysql_error());
$settings = mysql_fetch_assoc($res_sql);
?>
<form method="POST" name="form1" enctype="multipart/form-data">   
<!-- Services -->
  <h2>Youtube URL in Write Ad</h2>
  <?php     
		if(!empty($_POST['youtube_link'])){					
			if($res_url){
				echo "<p style='color:green; font-style: italic;'>Update Youtube URL in Write Ad Success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Update Youtube URL in Write Ad Fail!</p>";
			}
		}		
	?>
  <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">            
    <tr>      
      <td ><font face="Verdana" size="1">
		<input type="text" style="width:400px;"  name="youtube_link" value="<?php if(isset($settings['youtube_link'])){ echo $settings['youtube_link']; } ?>" />
      </font></td>
    </tr>
  </table>
  <!-- scholarship -->
  <h2>Scholarship </h2>	
<?php     
		if(!empty($_POST['scholarship'])){								   		
			if($res_contact){
			   echo "<p style='color:green; font-style: italic;'>Update Scholarship  Success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Update Scholarship  Fail!</p>";
			}
		}		
	?>
	<table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">		
		<tr>		 
		  <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
			<textarea name="scholarship" id="scholarship" cols="30" rows="4"><?php if(isset($settings['scholarship'])){ echo $settings['scholarship']; } ?></textarea>
			<script type="text/javascript"> CKEDITOR.replace('scholarship'); </script>
		  </font></td>
		</tr>
	</table>
  <!-- contact us -->
  <h2>Contact Us </h2>	
<?php     
		if(!empty($_POST['contact'])){								   		
			if($res_contact){
			   echo "<p style='color:green; font-style: italic;'>Update Contact Us  Success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Update Contact Us  Fail!</p>";
			}
		}		
	?>
	<table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">		
		<tr>		 
		  <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
			<textarea name="contact" id="contact" cols="30" rows="4"><?php if(isset($settings['contact'])){ echo $settings['contact']; } ?></textarea>
			<script type="text/javascript"> CKEDITOR.replace('contact'); </script>
		  </font></td>
		</tr>
	</table>
	<!-- Maps -->
	<h2>Maps</h2>	
	
	<?php     
		if(!empty($_POST['glat']) && !empty($_POST['glong'])){			
			$sql = "UPDATE settings SET glat = '".$_POST['glat']."' , glong = '".$_POST['glong']."' WHERE id = 1";						
			$res = mysql_query($sql);			   			
			if($res_map){
			   echo "<p style='color:green; font-style: italic;'>Update Maps Success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Update Maps Fail!</p>";
			}
		}		
	?>
	<table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">
    <tr>
      <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Latitude</font></td>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <input type="text" name="glat" style="width:400px;" value="<?php if(!empty($settings['glat'])){ echo $settings['glat']; } ?>" /></font></td>
    </tr>
    <tr>
      <td width="20%" bgcolor="#e6f2ea"><font face="Verdana" size="1">Longitude</font></td>
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <input type="text" name="glong" style="width:400px;" value="<?php if(!empty($settings['glong'])){ echo $settings['glong']; } ?>" /></font></td>
    </tr>
	 </table>
	 <style>
      #map-canvas {
        width: 500px;
        height: 400px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
		  <?php if(!empty($settings['glat']) && !empty($settings['glong'])){ ?>
			center: new google.maps.LatLng(<?php echo $settings['glat']; ?>, <?php echo $settings['glong']; ?>),
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
	<div id="map-canvas"></div>
	<br><br>
	<!-- About Us -->
	<h2>About Us</h2>	
	<?php     
		if(!empty($_POST['about'])){			
			$sql = 'UPDATE settings SET about = "'.$_POST['about'].'" WHERE id = 1';			
			$res = mysql_query($sql);			   			
			if($res){
			   echo "<p style='color:green; font-style: italic;'>Update About Success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Update About Fail!</p>";
			}
		}		
	?>
	<table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">            
    <tr>      
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
     <textarea name="about" cols="30" rows="4" id="about" ><?php if(!empty($settings['about'])){ echo $settings['about']; } ?></textarea>
     <script type="text/javascript"> CKEDITOR.replace('about'); </script>
      </font></td>
    </tr>
  </table>
  <br><br>
  <!-- Services -->
  <h2>Services</h2>
	<?php     
		if(!empty($_POST['services'])){									   		
			if($res_sv){
			   echo "<p style='color:green; font-style: italic;'>Update Services Success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Update Services Fail!</p>";
			}
		}		
	?>
  <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">            
    <tr>      
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <textarea name="services" cols="30" rows="4" id="services" ><?php if(!empty($settings['services'])){ echo $settings['services']; } ?></textarea>
      <script type="text/javascript"> CKEDITOR.replace('services'); </script>
      </font></td>
    </tr>
  </table>
  <!-- Popup -->
  <h2>Popup Register</h2>
	<?php     
		if(!empty($_POST['popup'])){									   		
			if($res_popup){
			   echo "<p style='color:green; font-style: italic;'>Update Popup Register Success!</p>";
			}else{
				echo "<p style='color:red; font-style: italic;'>Update Popup Register Fail!</p>";
			}
		}		
	?>
  <table border="0" cellpadding="5" cellspacing="2" style="border-style:groove" id="AutoNumber1" width="100%" bgcolor="#FFFFFF">            
    <tr>      
      <td bgcolor="#e6f2ea"><font face="Verdana" size="1">
      <textarea name="popup" cols="30" rows="4" id="popup" ><?php if(!empty($settings['popup'])){ echo $settings['popup']; } ?></textarea>
      <script type="text/javascript"> CKEDITOR.replace('popup'); </script>
      </font></td>
    </tr>
  </table>
  <p><font size="1" face="Verdana"><input type="submit" value="Save" name="save"></font></p>
  </form>
<p>&nbsp;</p>
</body>