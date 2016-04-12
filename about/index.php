<?php
session_start();
include ("../config.php");
include ("login_functions.php");

require ("../header_page.php");
?>
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
<?php 
$sql = "select about from settings";
$result = mysql_query($sql) or die(mysql_error());
$about = mysql_fetch_assoc($result);
?>
<div class="block">
<h1>About Us</h1>
<br>
<div><?php echo $about['about']; ?></div>
</div>
<div style="clear:both;"></div>
<?php
require ("../users/footer.php");
?>