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

if(isset($_GET['post'])){
   $resultPostInfo=mysql_fetch_assoc(getPost($_GET['post']));
}

$user_detail=$resultPostInfo;
$user_id=$resultPostInfo['id'];
echo $user_id;
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

      <div class="status-box emoticons">
          <div class="content-status-box">
            <div class="title-post-permarklink">
                <img class="avatar-permarklink"  src=" <?php if(!empty($candidate_summary['profile_picture'])) echo 'http://milliondollardesiclub.com/upload_files/candidate_cv/'.$candidate_summary['profile_picture']; else echo  "nopic_192.gif";  ?> " /><br/>

                <div class="permarklink-tit">
                  <a href="<?php echo working_domain.'md?id='.$user_id; ?>"><p class="name"><?php echo $resultPostInfo['name']; ?></p></a>

                  <p class="status-time"><?php echo $resultPostInfo['create_time']; ?></p>
                </div>
                <div class="clear"></div>
            </div>
            <p class="status-text-content"><?php echo $resultPostInfo['content']; ?></p>
          </div>
          <div class="comment-box" id="comment-box-<?php echo $_GET['post']; ?>">
            <div class="clear"></div>
            <?php
                $showCmt=false;
                $c=1;
                $resultCmt=getComment($_GET['post']);

                $numrowCmt=mysql_num_rows($resultCmt);

                if($numrowCmt>3) echo '<a href="#" id="view-more-commtents-'.$_GET['post'].'" class="view-more-commtents" onclick=viewmorcomment("'.$_GET['post'].'")>View more comments</a>';

                while ($rowCmt =  mysql_fetch_array($resultCmt)):

                  $datecmnt=$rowCmt['create_time'];
                  $datecmnt=explode(" ",$datecmnt);
                  $yearcmt= date("j F, Y", strtotime($datecmnt[0]));
                  $hourscmt= date("H:i", strtotime($datecmnt[1]));
                  $b=$numrowCmt-3;
                  if($c>$b)
                    $showCmt=true;
                ?>

                <div class="comment <?php if($showCmt!=true) echo "hide-comment"; ?>    ">
                  <p><span class="name"><?php echo $rowCmt['name'];?>:</span> <span class="comment-text"><?php echo $rowCmt['content'];?></span><span class="date-cmt"><?php echo $hourscmt.', '.$yearcmt; ?></span></p>
                </div>
                <?php
                $c=$c+1;
                endwhile;

            ?>
            <div class="clear"></div>
          </div>
          <?php
            //if user logged than show comment box
            if($logged):
          ?>
          <div class="input-comment-box">
            <form  id="input-comment-form-<?php echo  $_GET['post']; ?>">
              <div class="input-cmnt-wrap">
                <input name="input-comment" id="input-comment-<?php echo  $_GET['post']; ?>" class="input-comment" />
                <div class="upload-cmt">
                  <input type="file" name="img-cmnt" id="img-cmnt-<?php echo  $_GET['post']; ?>" statusid="<?php echo  $_GET['post']; ?>" accept="image/*" class="inputfile inputfile-5" data-multiple-caption="{count} files selected" />
                  <label for="img-cmnt-<?php echo  $_GET['post']; ?>"><i class="fa fa-upload" aria-hidden="true"></i> <span></span></label>
                </div>
              </div>

              <a href="javascript:void(0)" class="send-comment-btn btn" onclick=sendComment("<?php echo $_GET['post'] ?>") > Send </a>
              <div class="clearfix"></div>
              <div class="filename">
                <p id="filename2-<?php echo  $_GET['post'] ?>" class="filename2"></p>
              </div>
              <div class="spinner" id="spinner-<?php echo  $_GET['post'] ?>">
                <div class="spinner__item1"></div>
                <div class="spinner__item2"></div>
                <div class="spinner__item3"></div>
                <div class="spinner__item4"></div>
              </div>
              <div class="clearfix"></div>
            </form>

          </div>

        <?php endif; ?>
      </div>

      </div>
    </div>
    </div>
  </div>
<?php include_once "sidebar.php";?>
  <div class="clear"></div>
</div>
<script src="script.js"></script>
</body>

</html>
