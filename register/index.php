<!dtype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Visitors Register Page</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="jquery.cookie.js"></script>
	<script>
	 $(function() {		
		if ($.cookie('show_pop_up') != '1') {      		
			$( "#dialog" ).dialog();
			var date = new Date();
			var day = 360;
			date.setTime(date.getTime() + (day * 24 *60 * 60 * 1000));
			$.cookie('show_pop_up', '1', {expires: date});
	   }
	});
	</script>  
  <style type="text/css">
	.ui-dialog {
		width: 700px !important;
	}
	.ui-dialog-content {
		text-align: center !important;
		color: #D5DC71 !important;
	}
	.ui-dialog-title {
		display: none !important; 
	}
	.ui-widget-header{
		border: none !important;
		background: transparent !important;
	}
	.ui-dialog .ui-dialog-titlebar-close {
		background: transparent !important;
		border: none !important;
		outline: none;		
	}
	.ui-dialog {
		border: 4px solid #D5DC71 !important;
		background: #0C0708 !important;
		box-shadow: 3px 3px 10px #797677;
	}
  </style> 
</head>
<body style="background: #0C0708;">
 
<div id="dialog" style="display:none;">
  <p>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
	Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
	<br>
	<br>
	<a style="outline: none;" href="register.php"><img src="../upload_files/images/register.png" /></a>
  </p>
</div>
 
 
</body>
</html>