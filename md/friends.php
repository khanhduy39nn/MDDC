<?php
session_start();
ini_set('display_errors', 1);

include "md-config.php";
include "functions.php";
$id=$_GET['id'];
$logged=false;
$hadResult=true;
if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes'){
  $logged=true;
}
$query="select * from register where id = '".$id."'";
$resultuser=mysql_query($query);
if(mysql_num_rows($resultuser)==0)
{
  $hadResult=false;
}

$user_detail = mysql_fetch_assoc($resultuser);
$user_id=$user_detail['id'];

if($_SESSION['detail']['id']==$user_id)
  $owner=true;
else $owner=false;


$candidate_summary = mysql_fetch_assoc(mysql_query("select * from candidate_cv where user_id = ".$user_id));
if(!empty($candidate_summary['country'])){
  $country = mysql_fetch_assoc(mysql_query("select nicename from country where iso = '".$candidate_summary['country']."'"));
}


if(isset($_POST['post-status-btn'])){
  postStatus($user_id,$_POST['input-status-content'],"2");
}


$count=3;
$start=0;
$sql="select * from status where user_id=$user_id ORDER BY id asc limit $start,$count";


$sql=mysql_query($sql);
include_once "header.php";
$notif=getNotification($_SESSION['detail']['id']);
?>

  <div style="display:block; float:right; top:5px;right:5px; position:absolute;">
  	<div class="menu_bar" style="margin-top:5px !important;" >
			<?php include 'notif.php'; ?>
  	<?php if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes'){ ?>
  	 <a class='menu_bar' href="<?php echo working_domain; ?>?id=<?php echo $_SESSION['detail']['id']; ?>" style="color:#D8DB43; cursor:default;text-transform: uppercase;" >Hello <?php echo $_SESSION['detail']['name']; ?>,</a><a href='../logout.php' class='menu_bar'>LOG OUT</a>
  	<?php }else{ ?>
  	 <a href='../login.php' class='menu_bar'>LOG IN</a>
  	| <a href='../register/register.php' class='menu_bar'>REGISTER</a>
  	<?php } ?>
  </div>
  </div>
  <div style="clear:both;"></div>
  </div>
  <input type="hidden" id="user_id" value="<?php echo $user_id; ?>" />
  <input type="hidden" id="userlogged" value="<?php echo $logged; ?>" />
  <input type="hidden" id="userloggedid" value="<?php echo $_SESSION['detail']['id']; ?>" />
  <input type="hidden" id="userloggedname" value="<?php echo $_SESSION['detail']['name']; ?>" />
  <!--/.top-->
  <!-- multistep form -->
  <div class="menu_bar" style="text-align:center;">
  <?php include '../menu_layout.php'; ?>
  </div>

<link rel="stylesheet" href="md-style.css">

  <div class="content-million center-div" style="">
    <div class="time-line">
      <div class="profile-topcard">
        <div class="avatar-profile-topcard">
          <img  src=" <?php if(!empty($candidate_summary['profile_picture'])) echo 'http://milliondollardesiclub.com/upload_files/candidate_cv/'.$candidate_summary['profile_picture']; else echo  "nopic_192.gif";  ?> " /><br/>

          <?php


          if($owner==false):
            if(isset($_SESSION['detail']['id']))
            {
              $friendStatus=getAddFriendStatus($_SESSION['detail']['id'],$user_id);
              $countRowFriendStatus=mysql_num_rows($friendStatus);
              $friendStatus=mysql_fetch_assoc($friendStatus);
            }else {$countRowFriendStatus=0;
              $disable='disabled';
            }


            $value="";

            if($countRowFriendStatus>0){
              switch ($friendStatus['status'])
              {
                case "0": $value="Add Friend";
                          $class="addfriend-btn";
                 break;
                case "1": $value="Pending request";
                          $disable="disabled";
                          $class="addfriend-btn";
                break;
                case "2": $value="Unfriend";
                          $class="unfriend-btn";
                ;
                 break;
              }
            }else{
              $value="Add Friend";
              $class="addfriend-btn";
            }
          ?>

          <input type="button"  <?php echo $disable; ?> class="<?php echo $class; ?>" value="<?php echo $value; ?>" />
          <?php endif; ?>
          <input type="hidden" id="user_id" value="<?php echo $user_id; ?>" />
          <input type="hidden" id="userlogged" value="<?php echo $logged; ?>" />
          <input type="hidden" id="userloggedid" value="<?php echo $_SESSION['detail']['id']; ?>" />
          <input type="hidden" id="userloggedname" value="<?php echo $_SESSION['detail']['name']; ?>" />
        </div>
        <div class="info-profile-topcard">
          <p class="name-profile-topcard name "><?php echo $user_detail['name']; ?></p>
          <?php if($user_detail['address']!=""):?>
          <p class="decription-profile-topcard name"><span class="ths">Address:</span><?php echo " ".$user_detail['address']; ?></p>
        <?php endif; ?>
        <?php if($user_detail['email']!=""):?>
          <p class="decription-profile-topcard name"><span class="ths">Email:</span><?php echo " ".$user_detail['email']; ?></p>
        <?php endif; ?>
        <?php if($user_detail['business_areas_of_interest']!=""):?>
          <p class="decription-profile-topcard name"><span class="ths">Interest:</span><?php echo " ".$user_detail['business_areas_of_interest']; ?></p>
        <?php endif; ?>

        </div>

        <div class="md-menu-box">
          <ul class="md-menu">
              <li>
                <a href="<?php echo working_domain.'?id='.$user_id; ?>">Timeline</a>
              </li>
              <li>
                <a href="#">About</a>
              </li>
              <li>
                <a href="<?php echo working_domain.'friends.php?id='.$user_id; ?>">Friends</a>
              </li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>



      <div class="profile-topcard ">
        <div class="search-result-box">
          <h3>Friends list</h3>
          <u class="search-result-list">
          <?
         if(isset($_GET['id'])){
        $resultc=  friendslist($_GET['id']);
          while ($row =  mysql_fetch_array($resultc)){
          ?>
            <li><a href="<?php echo working_domain.'?id='.$row['id']; ?>" > <?php echo $row['name']; ?> </a></li>
          <?php
            }
          }
          ?>
        </ul>
      </div>
      <div class="clear"></div>
    </div>
    </div>
  </div>
  <?php include_once "sidebar.php";?>
  <div class="clear"></div>
</div>
<?php include '../footer.php'; ?>
