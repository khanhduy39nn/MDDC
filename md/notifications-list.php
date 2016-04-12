<?php
session_start();
ini_set('display_errors', 1);

include "md-config.php";
include "functions.php";
$id=$_GET['id'];
$logged=false;
if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes'){
  $logged=true;
}
$user_id=$_SESSION['detail']['id'];

$candidate_summary = mysql_fetch_assoc(mysql_query("select * from candidate_cv where user_id = ".$user_id));
if(!empty($candidate_summary['country'])){
  $country = mysql_fetch_assoc(mysql_query("select nicename from country where iso = '".$candidate_summary['country']."'"));
}


if(isset($_POST['post-status-btn'])){
  postStatus($user_id,$_POST['input-status-content'],"2");
}

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
          <?php   $resultc=  getNotificationList($user_id); ?>
          <h3>Your notifications</h3>
          <u class="search-result-list add_friend_request_list ">
          <?
          while ($row =  mysql_fetch_array($resultc)){
            echo '<li class="li-'.$row['notif_id'].'"><a onclick=updateStatusNotif("'.$row['notif_id'].'") class="notif-status-'.$row['status'].'" href="'.$row['link'].'">'.$row['name'].' comment on your post</a></li>';

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
<script src="script.js"></script>
</body>

</html>
