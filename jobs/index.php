<?php
session_start();


include ("../config.php");
include ("login_functions.php");
$page_title = "index_job";
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

#pagination {
	/*display: inline-flex !important;*/
	list-style-type: none !important;	
}
#pagination li {
	display: inline-block !important;
	margin:4px !important;
}
#pagination li a {
	text-decoration: none !important;
	border:1px solid #CBC35F;
	padding:3px;
}
.content-million option {
	color: #000 !important;
}
</style>

<?php include 'search_job.php'; ?>
<div style="clear:both;"></div>
<?php 
		
	$where = " ";
	$cv = " ";
	//job
	if(!empty($_GET['job_candidate']) && $_GET['job_candidate'] == 2){
		
		//location
		if(!empty($_GET['s_location'])){
			$cv .=  " and country like '%".$_GET['s_location']."%' ";
		}else if(!empty($_GET['location'])){
			$cv .=  " and country like '%".$_GET['location']."%' ";
		}
		//title - desc
		if(!empty($_GET['title'])){
			$cv .=  " and (title like '%".$_GET['title']."%' or short_description like '%".$_GET['title']."%') ";
		}
		//bussiness_type
		if(!empty($_GET['s_type'])){
			$cv .=  " and business_type like '".$_GET['s_type']."' ";
		}else if(!empty($_GET['type'])){
			$cv .=  " and business_type = '".$_GET['type']."' ";
		}
		
		$arrS = explode(',',$_GET['skill']);
					
		$arrSkill = array();
		foreach($arrS  as $sk){
			$row = mysql_fetch_assoc(mysql_query("SELECT id FROM skills WHERE name = '".$sk."'"));
			$arrSkill[] = $row['id'];
		}		
				
		$sql = mysql_query("SELECT * FROM candidate_cv WHERE 1 ".$cv);	
		$strCVFilterCountry = "";
		while($row = mysql_fetch_assoc($sql)){
			if(!empty($_GET['skill'])){
				if(compare_array($arrSkill,explode(',',$row['skills']))){
					$strCVFilterCountry .= $row['id'].",";
				}
			}else{
				$strCVFilterCountry .= $row['id'].",";
			}
		}							
		
		$sql = "select * from candidate_cv where id IN (".trim($strCVFilterCountry,",").")";		
		
		$tong = mysql_num_rows(mysql_query($sql));
		$limit = 20;
		$offset = 0;
		
		if(!empty($_GET['page'])){
			$offset = ($_GET['page']-1)*$limit;
		}	
		
		$tong_page = ceil($tong/$limit);
		
		$sql = "SELECT * FROM candidate_cv WHERE id IN (".trim($strCVFilterCountry,',').") order by dateadded DESC LIMIT ".$offset.','.$limit;			
		$result = mysql_query($sql);
		$type_result = 'cv';
	}else{
		if(!empty($_GET['s'])){
			$where .=  "and (title like '%".$_GET['s']."%' or job like '%".$_GET['s']."%') ";
		}
		//location
		if(!empty($_GET['s_location'])){
			$where .=  " and location like '%".$_GET['s_location']."%' ";
		}else if(!empty($_GET['location'])){
			$where .=  " and location like '%".$_GET['location']."%' ";
		}
		//buss type
		if(!empty($_GET['s_type'])){
			$where .=  "and type like '%".$_GET['s_type']."%'  ";
		}else if(!empty($_GET['type'])){
			$where .=  "and type like '%".$_GET['type']."%'  ";
		}
		if(!empty($_GET['pay_from'])){
			$where .=  "and pay >= ".$_GET['pay_from']." ";
		}
		if(!empty($_GET['pay_to'])){
			$where .=  "and pay <= ".$_GET['pay_to']." ";
		}
		$where .=  "and lfj = 1 ";
		$sql = "SELECT * FROM jobs WHERE status = 1 ".$where;	
	
		$tong = mysql_num_rows(mysql_query($sql));
		$limit = 20;
		$offset = 0;
		if(!empty($_GET['page'])){
			$offset = ($_GET['page']-1)*$limit;
		}	
		$tong_page = ceil($tong/$limit);
		
		$sql = "SELECT * FROM jobs WHERE status =1 ".$where." order by dateadded DESC LIMIT ".$offset.','.$limit;	
		$result = mysql_query($sql);
		$type_result = 'job';
	}
	
	
	
	$uri = $_SERVER['QUERY_STRING'];
	$arr_uri = explode('&',$uri);
	
	$last_uri = array();
	foreach($arr_uri as $item){
		$tmp = explode('=',$item);
		if($tmp['0'] != 'page'){
			$last_uri[] = $item;
		}
	}

	$last_uri = implode('&',$last_uri);
	switch($type_result){
		case "cv":
		while($row = mysql_fetch_assoc($result)){		
?>
<div class="block">
	<div class="content-left" style="margin-bottom:10px;">
		<a href="http://milliondollardesiclub.com/candidate/<?php echo $row['url']; ?>"><h2 style="color:#fff !important;"><?php echo $row['first_name']." ".$row['last_name']; ?><?php if($row['title'] != ''){ echo " - ".$row['title']; } ?></h2></a>
		<div class="sharebutton">					
			<span style="width:55px;display:block;float:left;"><div class="g-plus" data-action="share" data-annotation="none" data-height="20" data-href="http://milliondollardesiclub.com/candidate/<?php echo $row['url']; ?>"></div></span>
			<div style="display:block;float:left;width:53px;margin-left:5px;margin-right:5px;" class="fb-share-button" data-href="http://milliondollardesiclub.com/candidate/<?php echo $row['url']; ?>" data-layout="button"></div>					
			<a style="display:block;float:left;width:63px;" class="twitter-share-button" href="https://twitter.com/share" data-url="http://milliondollardesiclub.com/candidate/<?php echo $row['url']; ?>" data-text="<?php echo $row['title']." - ".$row['business_type']." - ".SITE_NAME; ?>" >Tweet</a>
			<span style="margin-top:0px;width:63px;display:block;float:left;margin-left: 2px;margin-right: 1px;"><script type="IN/Share" data-url="http://milliondollardesiclub.com/candidate/<?php echo $row['url']; ?>"></script></span>
		</div>
		<img src="http://milliondollardesiclub.com/<?php if(!empty($row['profile_picture'])){ echo "upload_files/candidate_cv/".$row['profile_picture']; }else{ echo "logo.gif"; } ?>" style="float:right; max-width:100px;" />			
		<span class="author" ><?php echo $row['country']; ?></span>
	</div>
	<div style="margin-bottom:10px;">
		<span class="author" >Added: <?php echo date('m-d-Y',$row['dateadded']); ?> </span>
	</div>	
	<div style="clear:both;"></div>
</div>	
<hr style="margin-top:15px;margin-bottom:15px;">
<?php } 
		break;
case "job":		
	while($row = mysql_fetch_assoc($result)){
		$sql = mysql_query("SELECT * from ads where user_id = ".$row['id_user']." && user_id != 0");
		$img = "";
		if(mysql_num_rows($sql) == 1){
			$image = mysql_fetch_assoc($sql);
			$img = $image['3'];			
		}
?>
<div class="block">
	<div class="content-left" style="margin-bottom:10px;">
		<a href="http://milliondollardesiclub.com/job/<?php echo $row['url']; ?>"><h2 style="color:#fff !important;"><?php echo $row['title']; ?></h2></a>
		<div class="sharebutton" style="width:100%;display:block;">
			<span style="width:55px;display:block;float:left;"><div class="g-plus" data-action="share" data-annotation="none" data-height="20" data-href="http://milliondollardesiclub.com/job/<?php echo $row['url']; ?>"></div></span>
			<div style="display:block;float:left;width:53px;margin-left:5px;margin-right:5px;" class="fb-share-button" data-href="http://milliondollardesiclub.com/job/<?php echo $row['url']; ?>" data-layout="button"></div>
			<a style="display:block;float:left;width:63px;" class="twitter-share-button" href="https://twitter.com/share" data-url="http://milliondollardesiclub.com/job/<?php echo $row['url']; ?>" data-text="<?php echo $row['title']." - ".$row['job']." - ".SITE_NAME; ?>">Tweet</a>
			<span style="margin-top:0px;width:63px;display:block;float:left;margin-left: 2px;margin-right: 1px;"><script type="IN/Share" data-url="http://milliondollardesiclub.com/job/<?php echo $row['url']; ?>"></script></span>
		</div>
		<?php if(!empty($img)){ ?>
		<img src="../upload_files/images/<?php echo $img; ?>" style="float:right; max-width:100px;" />	
		<?php } ?>
		<span class="author" ><?php echo $row['location']; ?></span> | <span class="dateadded" style="color: #fff !important;"><?php echo $row['job']; ?></span>	| <span class="author" ><?php echo $row['currency'].$row['pay_from']." - ".$row['currency'].$row['pay_to']." ".$row['frequency']; ?> </span>					
	</div>
	<div style="margin-bottom:10px;">
		<span class="author" >Added: <?php echo date('m-d-Y',$row['dateadded']); ?> <?php if($row['expiry'] != 0){ ?>- Expiry: <?php echo date('m-d-Y',$row['expiry']); ?></span> <?php } ?>| <span class="author"  ><?php echo $row['views']; ?> Views</span>
	</div>
	<div class="block-content"><?php echo substr(strip_tags($row['description']),0,300); ?></div>
	<a href="http://milliondollardesiclub.com/job/<?php echo $row['url']; ?>#apply_form"><h3>Apply Now</h3></a>
	<div style="clear:both;"></div>
</div>	
<hr style="margin-top:15px;margin-bottom:15px;">
<?php } 
	break;
	}?>
<style>
	.select_page {
		background-color: #CBC35F;
		color: #000 !important;
		font-weight: bold;
	}
</style>
<div style="clear:both;"></div>
<?php if($tong_page > 1){ 
$curr_page = 1;
if(!empty($_GET['page'])){
	$curr_page = $_GET['page'];
}
	
?>
<ul id="pagination">
	<?php for($i = 1; $i <= $tong_page; $i++ ){ ?>
	<li><a class="<?php if($curr_page == $i){ echo "select_page"; } ?>" href="?page=<?php echo $i; ?><?php if($last_uri != ''){ echo "&".$last_uri; } ?>"><?php echo $i; ?></a></li>	
	<?php } ?>
</ul>
<?php } ?>
<div style="clear:both;"></div>
<?php
require ("../users/footer.php");
function compare_array($child, $parent){
	if(empty($child)){
		return true;
	}
	if(empty($parent)){
		return false;
	}			
	
	
	
	$flag = array();
	foreach($child as $row){
		if(in_array($row,$parent)){
			$flag[] = '1';
		}else{
			$flag[] = '0';
		}
	}	
	if(in_array('0',$flag)){				
		return false;
	}else{							
		return true;
	}
}
?>
<!-- linkedin -->
<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
<!-- google plus -->
 <script>
      window.___gcfg = {
        lang: 'en-US',
        parsetags: 'onload'
      };
    </script>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>