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
    color: #fff !important;
}
</style>
<p style="text-align:justify;">MDDC features exclusive interviews & business tips and insights from business leaders & entrepreneurs from our corporate partners on a monthly basis. Access insights & perspectives from some of the leading figures in their business field:</p>
<?php 
$sql = "select * from featured";
$result = mysql_query($sql) or die(mysql_error());
while($featured = mysql_fetch_assoc($result)){
?>
<hr>
<div class="block">
<img class="block-img" src="../upload_files/images/<?php echo $featured['image']; ?>"  />
<div class="content-left">
<h1><?php echo $featured['title'];?></h1>
<span class="author" style="color: #fff !important;" ><i><?php echo $featured['author']; ?></i></span>, <span class="dateadded"><?php echo date('m-d-Y',$featured['dateadded']); ?></span>
<br>
</div>
<div class="block-content"><?php echo $featured['content']; ?></div>
<div>

</div>
</div>
<?php
}
require ("../users/footer.php");
?>