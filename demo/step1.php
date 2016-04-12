<?php
session_start();
include ("../config.php");
include ("login_functions.php");
require ("../header_page.php");
?>
<link href="css/style.css" type="text/css" rel="Stylesheet" />
<style>	
.content-million {
    position: relative !important;
}	
.content-million a.main_button {
	color: #fff !important;
}	
.provider li img {
	display: block;
	-moz-transition: -moz-transform .4s ease;
	-webkit-transition: -webkit-transform .4s ease;
	transition: transform .4s ease;
}
.provider li > a:hover img {
	-moz-transform: scale(1.05);
	-webkit-transform: scale(1.05);
	transform: scale(1.05);
}
.main_button {
	width:29% !important;
	padding: 15px 5px !important;
	font-size: 17px !important;
	border-radius: 3px !important;
}
</style>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
</script>
 <a class="main_button action-button" style="border-radius: 4px !important;padding: 15px 5px !important;color: #fff !important;border: 0 none;background: #C7A500 !important;font-weight: bold;display:block; width: 80px !important;font-size: 14px !important;text-decoration: none; position:absolute; top:5px; right:10px; padding:3px; text-align:center;" href="../profile/"><img src="images/man-icon.png"  /> <span style="display:block;">Profile</span></a>
<div class="block">
	<h1>See who you already know on this site</h1>
      <br>
      <p>Get started by choosing a service provider</p>
      <ul class="provider">      
        <li>
          <a  href="#" onclick="openSocialPopup(2)">
            <img src="images/google.png" />
            <p>Google</p>
          </a>
        </li>
        <li>
          <a href="#" onclick="openSocialPopup(3)">
            <img src="images/facebook.png" >
            <p>Facebook</p>
          </a>
        </li>
        <li>
          <a href="#" onclick="openSocialPopup(4)">
            <img src="images/yahoo.png" />
            <p>Yahoo</p>
          </a>
        </li>				
		<li>          
			<a href="#" onclick="openSocialPopup(1)">			
				<img src="images/twitter.png" />            
				<p>Twitter</p>          
			</a>        
		</li>		
        <li>
          <a href="#">
            <img src="images/linkein.png" />
            <p>Linkedin</p>
          </a>
        </li>				
      </ul>
	  
	  <p>or Invite by Email</p>
	  
	  <ul class="provider">      
        <li>
          <a  href="../profile/invite.php" >
            <img src="images/email.png" />
            <p>Email</p>
          </a>
        </li>        			
      </ul>
	  
	  <p>We'll import your address book to suggest connections and help you manage your contacts.</p>
	  
	  
</div>
<?php

require ("../users/footer.php");
?>