<?php
session_start();
//ini_set('display_errors', 1);
include ("../config.php");
include ("login_functions.php");
require ("../header_page.php");
?>

<link href="css/style.css" type="text/css" rel="Stylesheet" />
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>	 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
		}
		return "";
	}
	FB.init({
		appId:'1519815598316380',
		cookie:true,
		status:true,
		xfbml:true
	});
	var name="";
	function getUsername(id){
		
		FB.api(
			"/"+id,
			function (response) {
			  if (response && !response.error) {
					/* handle the result */
					var json=JSON.stringify(response);
					var obj=jQuery.parseJSON(json);
					document.cookie="tempfb="+obj.name;
				
				}
			}
		);
		
		//return name;
	}
	function FBInvite(){
			FB.ui({
				method: 'apprequests',
				message: 'Invite your Facebook Friends'
			},function(response) {
				if (response) {
					var json=JSON.stringify(response);
					
					var obj=jQuery.parseJSON(json);
					var to= obj.to.toString();
					//console.log(to);
					//to=to.replace(",", "-");
					//var kq= to.split("-");
					
					//getUsername(kq[0]);
					// var user = getCookie("tempfb");
					//alert(user);
					/*
					var jx2="{";
					for(var i=0;i<kq.length;i++){
						
						var name=getUsername(kq[0]);
						jx2+="'"+kq[0]+"':'"+name+"',";
					}
					jx2+="}";
					*/
					document.cookie="facebooklist="+JSON.stringify(to);
					window.location.href = "http://milliondollardesiclub.com/connect/facebook-success.php";
				} else {
				alert('Failed To Invite');
				}
			});
	}
	

	
   
   
</script>
<div class="block">
	<div id="fb-root"></div>
	<a  href="#" onclick="FBInvite()">Click to invite your friend</a>
	<!--a  href="#" onclick="getUsername()">Click to invite your friend</a-->
</div>
<?php

require ("../users/footer.php");
?>
