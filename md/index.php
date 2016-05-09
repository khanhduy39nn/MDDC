<?php
session_start();
ini_set('display_errors', 1);

include "md-config.php";
include "functions.php";
//$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $email = end((explode('/', $url)));
if(!isset($_GET['id'])){
  if(isset($_SESSION['detail']['id']))
  {
    echo '<script>';
    echo 'location.href = "'.working_domain.'?id='.$_SESSION['detail']['id'].'";';
    echo '</script>';
  }
  else{
    echo '<script>';
    echo 'location.href = "http://milliondollardesiclub.com/login.php";';
    echo '</script>';
  }
}



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

//}

if($_SESSION['detail']['id']==$user_id)
  $owner=true;
else $owner=false;



$candidate_summary = mysql_fetch_assoc(mysql_query("select * from candidate_cv where user_id = ".$user_id));;
if(!empty($candidate_summary['country'])){
  $country = mysql_fetch_assoc(mysql_query("select nicename from country where iso = '".$candidate_summary['country']."'"));
}

/*
if(isset($_POST['post-status-btn'])){

  postStatus($user_id,$_POST['input-status-content'],"2");
}
*/

$count=3;
$start=0;
$sql="select * from status where user_id=$user_id ORDER BY id desc limit $start,$count";


$sql=mysql_query($sql);
include_once "header.php";
$notif=getNotification($_SESSION['detail']['id']);
?>
<!---script src="script.js"></script-->
  <div style="display:block; float:right; top:5px;right:5px; position:absolute;">
  	<div class="menu_bar" style="margin-top:5px !important;" >
			<?php include 'notif.php'; ?>
  	<?php if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes'){ ?>
  	 <a class='menu_bar' href="http://milliondollardesiclub.com/md/?id=<?php echo $_SESSION['detail']['id']; ?>" style="color:#D8DB43;text-transform: uppercase;" >Hello <?php echo $_SESSION['detail']['name']; ?>,</a><a href='../logout.php' class='menu_bar'>LOG OUT</a>
  	<?php }else{ ?>
  	 <a href='../login.php' class='menu_bar'>LOG IN</a>
  	| <a href='../register/register.php' class='menu_bar'>REGISTER</a>
  	<?php } ?>
  </div>
  </div>
  <div style="clear:both;"></div>
  </div>
  <!--/.top-->
  <!-- multistep form -->
  <div class="menu_bar" style="text-align:center;">
  <?php include '../menu_layout.php'; ?>
  </div>

<link rel="stylesheet" href="md-style.css">
<?php if($hadResult): ?>
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
        <input type="hidden" id="indexpage" value="true" />
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
              <a href="http://milliondollardesiclub.com/profile/?id=<?php echo $user_id; ?>">About</a>
            </li>
            <li>
              <a href="<?php echo working_domain.'friends.php?id='.$user_id; ?>">Friends</a>
            </li>
        </ul>
      </div>
      <div class="clear"></div>
    </div>
    <?php if($owner==true): ?>
    <div class="status-box emoticons">
      <form method="post" class="post-status" name="post-status-form"  id="post-status-form">
        <div class="status-content">
          <textarea class="input-status-content" name="input-status-content" id="input-status-content"></textarea>
        </div>
        <div class="status-toolbox">
          <input type="file" name="img-cmnt" id="file_234x" statusid="234x" class="status-images inputfile inputfile-5"  accept="image/*" data-multiple-caption="{count} files selected" />
            <label for="file_234x"><i class="fa fa-upload" aria-hidden="true"></i></label>
          <input type="submit" name="post-status-btn" class="post-status-btn" id="post-status-btn" value="Post">

          <div class="clearfix"></div>
          <p id="filename2-234x" class="filename2"> </p>
          <div class="clearfix"></div>
        </div>
        <div class="clear"></div>
      </form>
    </div>
    <?php
      endif;
      //$result=mysql_query($sql);
        while ($row =  mysql_fetch_array($sql)):
          $datetime=$row['create_time'];
          $datetime=explode(" ",$datetime);
          $year= date("j F, Y", strtotime($datetime[0]));
          $hours= date("H:i", strtotime($datetime[1]));
    ?>
        <div class="status-box emoticons">
            <div class="content-status-box">

              <a href="<?php echo working_domain.'permarklink.php?post='. $row['id']; ?>"><p class="status-time"><?php echo $year. ' at '.$hours; ?></p></a>
              <p class="status-text-content"><?php echo $row['content'] ?>


              </p>
              <?php
                  if($row['image']!=''){
                    echo '<img class="status-image-post" src="'.working_domain.'../upload_files/images/'.$row['image'].'"/>';
                  }
               ?>
              <div class="social-tool">
                <?php

                $likeList= getLikeList($row['id']);
                $countLikeList=mysql_num_rows($likeList);
                if($countLikeList==0):
                ?>
                  <a class="like like-text" id="like-<?php echo $row['id']; ?>" href="#" status-id="<?php echo $row['id']; ?>" >Like</a>
                <?php else: ?>
                  <a class="like like-text" id="like-<?php echo $row['id']; ?>" href="#" status-id="<?php echo $row['id']; ?>" >Unlike)</a>
                <?php endif; ?>
                <div class="social-share">
                  <ul>
                      <li>
                        <a href="javascript:window.open('http://www.facebook.com/sharer.php?u=<?php echo working_domain.'permarklink.php?post='. $row['id']; ?>','Share','width=500,height=150')"><img src="<?php echo working_domain.'img/fb.png'?>" /></a>
                      </li>
                      <li>
                        <a href="javascript:window.open('https://plus.google.com/share?url=<?php echo working_domain.'permarklink.php?post='. $row['id']; ?>','Share','width=500,height=150')"><img src="<?php echo working_domain.'img/gg.png'?>" /></a>
                      </li>
                  </ul>
                </div>

              </div>

            </div>
            <div class="comment-box" id="comment-box-<?php echo $row['id']; ?>">
              <?php if($countLikeList>0):?>

                <div class="like-names">
                  <a href="javascript:void(0)" class="like-text">
                    <?php
                      $str="";
                      if($countLikeList>3)
                      {
                        $i=1;

                        while ($like =  mysql_fetch_array($likeList)):
                            $str.= $like['name'].', ';
                            $i++;
                            if($i==3)
                              break;
                        endwhile;
                          $str=substr($str,0,-2);
                        $str.= ' and '. ($countLikeList-3) . " others like this post";

                      }else{
                        while ($like =  mysql_fetch_array($likeList)):
                          $str .= $like['name'] .', ' ;

                        endwhile;
                        $str=substr($str,0,-2);
                      }

                      echo $str;
                    ?>
                  </a>
                </div>

              <?php endif; ?>
              <div class="clear"></div>
              <?php
                  $showCmt=false;
                  $c=1;
                  $resultCmt=getComment($row['id']);

                  $numrowCmt=mysql_num_rows($resultCmt);
                  if($numrowCmt>3) echo '<a href="#" id="view-more-commtents-'.$row['id'].'" class="view-more-commtents" onclick=viewmorcomment("'.$row['id'].'")>View more comments</a>';

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
                    <?php
                        if($rowCmt['image']!='')
                        {
                          echo '<img src="'.working_domain.'../upload_files/images/'.$rowCmt['image'].'"/>';
                        }
                     ?>
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
              <form  id="input-comment-form-<?php echo $row['id']; ?>">
                <div class="input-cmnt-wrap">
                  <input name="input-comment" id="input-comment-<?php echo $row['id']; ?>" class="input-comment" />
                  <div class="upload-cmt">
                    <input type="file" name="img-cmnt" id="img-cmnt-<?php echo $row['id']; ?>" statusid="<?php echo $row['id']; ?>" accept="image/*" class="inputfile inputfile-5" data-multiple-caption="{count} files selected" />
    					      <label for="img-cmnt-<?php echo $row['id']; ?>"><i class="fa fa-upload" aria-hidden="true"></i></span></label>
                  </div>
                </div>

                <a href="javascript:void(0)" class="send-comment-btn btn" onclick=sendComment("<?php echo $row['id']; ?>") > Send </a>
                <div class="clearfix"></div>
                <div class="filename">
                  <p id="filename2-<?php echo $row['id']; ?>" class="filename2" ></p>
                </div>
                <div class="spinner" id="spinner-<?php echo $row['id']; ?>">
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
    <?
        endwhile;
    ?>
    <img src="ajax-loader.gif" class="loadimg" />
  </div>
<?php include_once "sidebar.php";?>
<?php else: ?>
  <div class="content-million center-div" style="">
    <div class="time-line">
      No result
    </div>
  </div>
<?php endif; ?>
  <div class="clear"></div>
</div>
  <?php include 'footer.php'; ?>
