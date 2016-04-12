<?php
session_start();

include ("../config.php");
include ("login_functions.php");

if(empty($_GET['id'])){
	header('Location: '.BASE_HTTP_PATH.'jobs/');
	exit;
}
$result = mysql_query("SELECT * FROM candidate_cv WHERE id = ".$_GET['id']." && user_id != 0");
if(mysql_num_rows($result) == 0){
	header('Location: '.BASE_HTTP_PATH.'jobs/');
	exit;
}

/*mysql_query("update candidate_cv set views = views + 1 Where id = ".$_GET['id']);*/
$page_title = "detail_candidate";
$detail_candidate = mysql_fetch_assoc($result);
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
.content-left p { font-size:14px; }
.content-left h2 { font-size:20px; }
</style>


<?php include 'search_job.php'; ?>


<div style="clear:both;"></div>
<div class="block">
	<div class="content-left" style="margin-bottom:10px;">
		<h1 style="display: inline-block;"><?php echo $detail_candidate['first_name']." ".$detail_candidate['last_name']; ?></h1>&nbsp;<h2 style="display: inline-block;"  class="author" ><?php if($detail_candidate['title'] != ''){ echo " - ".$detail_candidate['title']; } ?></h2>		
		<div class="sharebutton" style="margin-bottom:5px;">
			<span style="width:55px;display:block;float:left;"><div class="g-plus" data-action="share" data-annotation="none" data-height="20" data-href="http://milliondollardesiclub.com/job/<?php echo $detail_candidate['url']; ?>"></div></span>
			<div style="display:block;float:left;width:53px;margin-left:5px;margin-right:5px;" class="fb-share-button" data-href="http://milliondollardesiclub.com/candidate/<?php echo $detail_candidate['url']; ?>" data-layout="button"></div>
			<a style="display:block;float:left;width:63px;" class="twitter-share-button" href="https://twitter.com/share" data-url="http://milliondollardesiclub.com/candidate/<?php echo $row['url']; ?>" data-text="<?php echo $detail_candidate['title']." - ".$detail_candidate['business_type']." - ".SITE_NAME; ?>" >Tweet</a>
			<span style="margin-top:0px;width:63px;display:block;float:left;margin-left: 2px;margin-right: 1px;"><script type="IN/Share" data-url="http://milliondollardesiclub.com/job/<?php echo $detail_candidate['url']; ?>"></script></span>
		</div>
		<p><?php echo nl2br($detail_candidate['short_description']); ?></p>
		<img src="http://milliondollardesiclub.com/<?php if(!empty($detail_candidate['profile_picture'])){ echo "upload_files/candidate_cv/".$detail_candidate['profile_picture']; }else{ echo "logo.gif"; } ?>" style="float:right; max-width:100px;" />			
		<h2 class="author" >Summary</h2>
		<p>Sex: <?php if($detail_candidate['sex'] == 0){ echo "Male"; }else{ echo "Female"; } ?></p>		
		<p>Email: <?php echo $detail_candidate['email']; ?></p>		
		<?php if($detail_candidate['phone'] != ""){ ?><p>Phone: <?php echo $detail_candidate['phone']; ?></p><?php }  ?>		
		<?php if($detail_candidate['dob'] != '0'){ ?><p>Date of Birth: <?php echo date('m-d-Y',$detail_candidate['dob']); ?></p><?php } ?>		
		<p>Address: <?php echo $detail_candidate['address'].', '.$detail_candidate['country']; ?></p>				
		<br>
		<hr>
		<hr>
		<!--education-->
		<?php if(isset($detail_candidate['id'])){ ?>
		<?php $list_edu = mysql_query("select * from educations where cv_id = ".$detail_candidate['id']); ?>
		<?php if(mysql_num_rows($list_edu) > 0){ ?>
				<h2 class="author" >Education</h2>		
			
				<?php while($edu = mysql_fetch_assoc($list_edu)){ ?>
					<p>School: <?php echo $edu['school']; ?></p>		
					<p>From: <?php echo date('m-d-Y',$edu['date_attend_from']); ?> - To: <?php echo date('m-d-Y',$edu['date_attend_to']); ?></p>		
					<p>Degree: <?php echo $edu['degree']; ?></p>		
					<p>Field of Study: <?php echo $edu['field_of_study']; ?></p>		
					<p>Grade: <?php echo $edu['grade']; ?></p>				
					<p>Activities and Societies: <?php echo $edu['activities_and_societies']; ?></p>
					<p>Desciption: <?php echo $edu['description']; ?></p>				
					<hr>
				<?php } ?>
				<hr>
			<?php } ?>
		<?php } ?>
		
		<!-- Skills -->
		<?php if(isset($detail_candidate['id']) && $detail_candidate['skills'] != ""){ ?>
		<?php $list_skills = mysql_query("select * from skills where id IN (".$detail_candidate['skills'].")"); ?>
		<?php if(mysql_num_rows($list_skills) > 0){ ?>
		<br>
		<h2 class="author" >Skills</h2>
		<p>Skills: <?php 
		$lk = "";
		while($skill = mysql_fetch_assoc($list_skills)){ 
			$lk .= $skill['name'].",";
		} 
		if($lk != ""){
			echo trim($lk,',');	
		}
		?></p>	
		<hr>
		<hr>		
		<?php } ?>
		<?php } ?>
		
		<!--Project-->
		<?php if(isset($detail_candidate['id'])){ ?>
		<?php $list_project = mysql_query("select * from projects where cv_id = ".$detail_candidate['id']); ?>
		<?php if(mysql_num_rows($list_project) > 0){ ?>
		<h2 class="author" >Project</h2>		
			<?php while($project = mysql_fetch_assoc($list_project)){ ?>
				<p>Name: <?php echo $project['name']; ?></p>						
				<p>Occupation: <?php echo $project['occupation']; ?></p>		
				<p>Dates: <?php echo date('m-d-Y',$project['date']); ?></p>		
				<p>Project URL: <?php echo $project['project_url']; ?></p>						
				<p>Desciption: <?php echo $project['description']; ?></p>				
				<hr>
			<?php } ?>
		<hr>
		<?php } ?>
		<?php } ?>
		
		<!--Publications-->
		<?php if(isset($detail_candidate['id'])){ ?>
		<?php $list_publication = mysql_query("select * from publications where cv_id = ".$detail_candidate['id']); ?>
		<?php if(mysql_num_rows($list_publication) > 0){ ?>
		<h2 class="author" >Publications</h2>		
			<?php while($publication = mysql_fetch_assoc($list_publication)){ ?>
				<p>Title: <?php echo $publication['title']; ?></p>						
				<p>Publications/Publisher: <?php echo $publication['publication_publisher']; ?></p>		
				<p>Publications Dates: <?php echo date('m-d-Y',$publication['publication_date']); ?></p>		
				<p>Publications URL: <?php echo $publication['publication_url']; ?></p>						
				<p>Desciption: <?php echo $publication['description']; ?></p>				
				<hr>
			<?php } ?>
		<hr>
		<?php } ?>
		<?php } ?>
		
		<!--Certifications-->
		<?php if(isset($detail_candidate['id'])){ ?>
		<?php $list_certification = mysql_query("select * from certification where cv_id = ".$detail_candidate['id']); ?>
		<?php if(mysql_num_rows($list_certification) > 0){ ?>
		<h2 class="author" >Certifications</h2>		
			<?php while($certification = mysql_fetch_assoc($list_certification)){ ?>
				<p>Certification Name: <?php echo $certification['name']; ?></p>	
				<p>Certification Authority: <?php echo $certification['authory']; ?></p>				
				<p>License Number: <?php echo $certification['license_number']; ?></p>				
				<p>Certification URL: <?php echo $certification['certification_url']; ?></p>								
				<p>Date from: <?php echo date('m-d-Y',$certification['date_from']); ?> - To: <?php echo date('m-d-Y',$publication['date_to']); ?></p>						
				<p>Desciption: <?php echo $certification['description']; ?></p>				
				<hr>
			<?php } ?>
		<hr>
		<?php } ?>
		<?php } ?>
		
		<!--Experiences-->
		<?php if(isset($detail_candidate['id'])){ ?>
		<?php $list_experience = mysql_query("select * from experience where cv_id = ".$detail_candidate['id']); ?>
		<?php if(mysql_num_rows($list_experience) > 0){ ?>
		<h2 class="author" >Experiences</h2>		
			<?php while($experience = mysql_fetch_assoc($list_experience)){ ?>
				<p>Company Name: <?php echo $experience['company_name']; ?></p>	
				<p>Title: <?php echo $experience['title']; ?></p>				
				<p>Location: <?php echo $experience['location']; ?></p>								
				<p>Time period from: <?php echo date('m-d-Y',$experience['time_period_from']); ?> - To: <?php echo date('m-d-Y',$experience['time_period_to']); ?></p>						
				<p>Desciption: <?php echo $experience['description']; ?></p>				
				<hr>
			<?php } ?>
		<?php } ?>
		<?php } ?>
	</div>	
	<div class="sharebutton" style="margin-top:5px;margin-bottom:5px;">
		<span style="width:55px;display:block;float:left;"><div class="g-plus" data-action="share" data-annotation="none" data-height="20" data-href="http://milliondollardesiclub.com/job/<?php echo $detail_candidate['url']; ?>"></div></span>
		<div style="display:block;float:left;width:53px;margin-left:5px;margin-right:5px;" class="fb-share-button" data-href="http://milliondollardesiclub.com/candidate/<?php echo $detail_candidate['url']; ?>" data-layout="button"></div>
		<a style="display:block;float:left;width:63px;" class="twitter-share-button" href="https://twitter.com/share" data-url="http://milliondollardesiclub.com/candidate/<?php echo $row['url']; ?>" data-text="<?php echo $detail_candidate['title']." - ".$detail_candidate['business_type']." - ".SITE_NAME; ?>" >Tweet</a>
		<span style="margin-top:0px;width:63px;display:block;float:left;margin-left: 2px;margin-right: 1px;"><script type="IN/Share" data-url="http://milliondollardesiclub.com/job/<?php echo $detail_candidate['url']; ?>"></script></span>
	</div>
	<div style="clear:both;"></div>
</div>
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

