<?php
session_start();

include ("../config.php");
include ("login_functions.php");

if(empty($_GET['id'])){
	header('Location: '.BASE_HTTP_PATH.'jobss/');
	exit;
}
$result = mysql_query("SELECT * FROM jobs WHERE status = 1 and id = ".$_GET['id']);
if(mysql_num_rows($result) == 0){
	echo $_GET['id'];
	header('Location: '.BASE_HTTP_PATH.'jobsx/');
	exit;
}

mysql_query("update jobs set views = views + 1 Where id = ".$_GET['id']);
$page_title = "detail_job";
$detail_jobs = mysql_fetch_assoc($result);

$sql = mysql_query("SELECT * from ads where user_id = ".$detail_jobs['id_user']." && user_id != 0");
$img = "";
if(mysql_num_rows($sql) == 1){	
	$image = mysql_fetch_assoc($sql);
	$img = $image['3'];			
}

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
	display: inline-flex !important;
	list-style-type: none !important;	
}
#pagination li {
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
<div class="block">
	<div class="content-left" style="margin-bottom:10px;">
		<h2 style="color:#fff !important;"><?php if($detail_jobs['lfj'] == 0){ ?>Title: <?php } ?><?php echo $detail_jobs['title']; ?></h2>		
		<div class="sharebutton" style="margin-bottom:5px;">
			<span style="width:55px;display:block;float:left;"><div class="g-plus" data-action="share" data-annotation="none" data-height="20" data-href="http://milliondollardesiclub.com/job/<?php echo $detail_jobs['url']; ?>"></div></span>
			<div style="display:block;float:left;width:53px;margin-left:5px;margin-right:5px;" class="fb-share-button" data-href="http://milliondollardesiclub.com/job/<?php echo $detail_jobs['url']; ?>" data-layout="button"></div>
			<a style="display:block;float:left;width:63px;" class="twitter-share-button" href="https://twitter.com/share" data-url="http://milliondollardesiclub.com/candidate/<?php echo $detail_jobs['url']; ?>" data-text="<?php echo $detail_jobs['title']." - ".$detail_jobs['business_type']." - ".SITE_NAME; ?>" >Tweet</a>
			<span style="margin-top:0px;width:63px;display:block;float:left;margin-left: 2px;margin-right: 1px;"><script type="IN/Share" data-url="http://milliondollardesiclub.com/job/<?php echo $detail_jobs['url']; ?>"></script></span>
		</div>
		<?php if($img != ''){ ?>
		<img src="../upload_files/images/<?php echo $img; ?>" style="float:right; max-width:100px;" />	
		<?php } ?>
		<span class="author" >Location: <?php echo $detail_jobs['location']; ?></span><br>
		<span class="dateadded" style="color: #fff !important;">Business Type: <?php echo $detail_jobs['type']; ?></span> <br>
		<span class="author" >Pay from: <?php echo $detail_jobs['currency'].$detail_jobs['pay_from']." - Pay to: ".$detail_jobs['currency'].$detail_jobs['pay_to']." ".$detail_jobs['frequency']; ?></span>											
	</div>
	<div style="margin-bottom:10px;">
		<span class="author" >Added: <?php echo date('m-d-Y',$detail_jobs['dateadded']); ?><?php if($detail_jobs['lfj'] == 1 && $detail_jobs['expiry'] != 0){ ?> - Expiry: <?php echo date('m-d-Y',$detail_jobs['expiry']); ?> </span> <?php } ?>  | <span class="author"  ><?php echo $detail_jobs['views']; ?> Views</span>
	</div>
	<?php if($detail_jobs['lfj'] == 1){ ?>
	<div style="margin-bottom:10px;">

	<a href="#apply_form"><h3>Apply Now</h3></a>
	</div>
	<?php } ?>
	<div class="block-content"><?php echo nl2br($detail_jobs['description']); ?></div>
	<div class="sharebutton" style="margin-top:5px;margin-bottom:5px;">
		<span style="width:55px;display:block;float:left;"><div class="g-plus" data-action="share" data-annotation="none" data-height="20" data-href="http://milliondollardesiclub.com/job/<?php echo $detail_jobs['url']; ?>"></div></span>
		<div style="display:block;float:left;width:53px;margin-left:5px;margin-right:5px;" class="fb-share-button" data-href="http://milliondollardesiclub.com/job/<?php echo $detail_jobs['url']; ?>" data-layout="button"></div>
		<a style="display:block;float:left;width:63px;" class="twitter-share-button" href="https://twitter.com/share" data-url="http://milliondollardesiclub.com/candidate/<?php echo $detail_jobs['url']; ?>" data-text="<?php echo $detail_jobs['title']." - ".$detail_jobs['business_type']." - ".SITE_NAME; ?>" >Tweet</a>
		<span style="margin-top:0px;width:63px;display:block;float:left;margin-left: 2px;margin-right: 1px;"><script type="IN/Share" data-url="http://milliondollardesiclub.com/job/<?php echo $detail_jobs['url']; ?>"></script></span>
	</div>
	<div style="clear:both;"></div>
</div>
<?php 
	$emails = "info@milliondollardesiclub.com";
	if($detail_jobs['id_user'] != '0'){
		$user_detail = mysql_fetch_assoc(mysql_query("SELECT Email FROM users WHERE ID = ".$detail_jobs['id_user']));
		if($user_detail['Email'] != ''){
			$emails .= ",".$user_detail['Email'];
		}
	}
	
	
?>
<?php
if($detail_jobs['lfj'] == '1'){
	if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes' ){	
?>
<form id="apply_form" action="/jobs/apply_job.php" enctype="multipart/form-data" method="post">	
	<input type="hidden" name="to_emails" value="<?php echo $emails; ?>" />	
	<input type="hidden" name="to_emails_feedsite" value="<?php if($detail_jobs['consultants_email'] != ''){ echo $detail_jobs['consultants_email']; } ?>" />
	<input type="hidden" name="consultants_surname" value="<?php if($detail_jobs['consultants_surname'] != ''){ echo $detail_jobs['consultants_surname']; } ?>" />
	<input type="hidden" name="consultants_forename" value="<?php if($detail_jobs['consultants_forename'] != ''){ echo $detail_jobs['consultants_forename']; } ?>" />
	<input type="hidden" name="feedsite_id" value="<?php if($detail_jobs['website_id'] != '0'){ echo $detail_jobs['website_id']; } ?>"  />
	<input type="hidden" name="id_jobs_feedsite" value="<?php if($detail_jobs['id_jobs_site'] != '0'){ echo $detail_jobs['id_jobs_site']; } ?>"  />
	<table width="600px" id="form_contact" border="0" cellspacing="5" cellpadding="5" style=" margin-left: auto;margin-right: auto;">		
		<tbody>			
			<tr>
				<td colspan="2">
					<center>
						<h2>Job Applications</h2>
					</center>
				</td>
			</tr>
			<tr>
				<td width="20%" style="text-align:right !important; font-size:1.3em;">Subject:</td>
				<td width="80%"><input type="text" name="subject" value='Apply for <?php echo '"'.$detail_jobs['title'].'"'; ?>' style="width:400px;color: #000 !important;"></td>
			</tr>
			<tr>
				<td width="20%" style="text-align:right !important; font-size:1.3em;">Email:</td>
				<td width="80%"><input type="text" id="email" value="<?php echo $_SESSION['detail']['email']; ?>" name="email" style="width:400px;color: #000 !important;"></td>
			</tr>
			<tr>
				<td width="20%" style="text-align:right !important; font-size:1.3em;">Phone:</td>
				<td width="80%"><input type="text" name="phone" value="<?php echo $_SESSION['detail']['phone']; ?>" style="width:400px;color: #000 !important;"></td>
			</tr>
			<tr>
				<td width="20%" style="text-align:right !important; font-size:1.3em;">Name:</td>
				<td width="80%"><input type="text" id="name" name="name" value="<?php echo $_SESSION['detail']['name']; ?>" style="width:400px;color: #000 !important;"></td>
			</tr>
			<tr>
				<td width="20%" style="text-align:right !important; font-size:1.3em;">Message:</td>
				<td width="80%" ><textarea id="message" style="width:400px;color: #000 !important;" name="message"></textarea></td>
			</tr>	
			<tr>
				<td width="20%" style="text-align:right !important; font-size:1.3em;">Upload Candidate CV:</td>
				<td width="80%"><input type="file" name="attach" value="" placeholder="" style="width:400px;color: #000 !important;"></td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<input type="submit"  value="Apply" style="background-color: #BEAA4B;width: 80px;height: 20px;color:#D8E378 !important;">
					</center>
				</td>
			</tr>						
		</tbody>
	</table>	
</form>	
<?php 
	}else{
		echo "<center id='apply_form'>Click here to <a style='font-weight:bold;' href='../login.php'>login</a></b> or <a style='font-weight:bold;' href='../register/register.php'>register now</a> for applying this job!</center>";
	}
}else{ ?>
	<iframe src="http://docs.google.com/gview?url=http://milliondollardesiclub.com/upload_files/candidate_cv/<?php echo $detail_jobs['cv']; ?>&embedded=true" style="width:100%; max-width:600px; min-height:500px;" frameborder="0"></iframe>
<?php }
?>
<script>
	function checkValues(){		
		if(document.getElementById('email').value == ''){			
			alert('Email is required');
			document.getElementById('email').focus();
			return false;
		}
		
		if(document.getElementById('name').value == ''){
			alert('Name is required');
			document.getElementById('name').focus();
			return false;
		}
		
		if(document.getElementById('message').innerHTML == ''){
			alert('Message is required');
			document.getElementById('message').focus();
			return false;
		}
		
		return true;
	}
</script>
<hr>
<div style="clear:both;"></div>
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
<?php
require ("../users/footer.php");
?>
