
<?php
define("working_domain", "http://milliondollardesiclub.com/md/");

function postStatus($userid="1",$content, $prevacy="2",$filename){
  $create_time=date("Y-m-d h:i:s");
  $query="insert status(user_id,content,image,privacy_status,delete_status,create_time) value($userid,'$content','$filename','$prevacy','0','$create_time')";
//  return $query;
  return mysql_query($query);

}

function postComment($userloggedid, $statusid, $content,$sendNotif,$userNotif,$fileName){
  $create_time=date("Y-m-d h:i:s");

  $query="insert status_comments(user_id,status_id,content,delete_status,create_time,image) value($userloggedid,'$statusid','$content','0','$create_time','$fileName')";
  if($sendNotif)
    sendNotification($userNotif,$userloggedid,"",working_domain.'permarklink.php?post='.$statusid,3);

  return mysql_query($query);

}

function notificationString($userId,$link,$type){
  return "insert notifications(user_id,link,type,status) value($userId,'$link',$type,1);";;
}


function sendNotification($userId,$senderid,$sendername,$link,$type){
  $query="insert notifications(user_id,sender_id,sender_name,link,type,status) value($userId,$senderid,'$sendername','$link',$type,1)";
  mysql_query($query);
  return mysql_insert_id();
}

function getNotification($userId){
  $query="select * from notifications,register  where user_id=$userId and sender_id=register.id and status!=0";
  return mysql_query($query);

}
function getNotificationWithType($userId,$type){
  if($type==1)
  {
    $query="select  notifications.id AS notif_id, name, register.id AS user_id, notifications.status,user_id_request from notifications, friends,register where notifications.id=friends.notif_id and friends.user_id_request=register.id and user_id_recieve=$userId and notifications.status!=0 and notifications.status!=3 order by notifications.id desc limit 0,10";
  }else
  {
    $query="select notifications.id AS notif_id, name, register.id AS user_id, status,link  from notifications,register where notifications.user_id=$userId and notifications.sender_id=register.id and type=$type and status!=0 and status!=3 order by notifications.id desc limit 0,10";
  }
return  mysql_query($query);
}


function updateNotificationStatus($id,$status){
  $query="update notifications set status=$status where id=$id";
  echo $query;
  return mysql_query($query);
}

function addFriend($friend_id,$userloggedid,$notif_id){
  $query="insert friends(user_id_request,user_id_recieve,notif_id,status) value($userloggedid,$friend_id,$notif_id,1)";
  //echo $query;
  return mysql_query($query);
}

function unFriend($friend_id,$userloggedid,$notif_id){
  $query="DELETE FROM friends WHERE (user_id_request= $friend_id and user_id_recieve=$userloggedid) or (user_id_request=$userloggedid and user_id_recieve=$friend_id)";
  echo $query;
  return mysql_query($query);
}




function getErrorString($errorCode){
  $age = array(
    "1"=>"Please enter your input ",
    "2"=>"Please enter your comment",
    "Joe"=>"43");
}

function getComment($statusid){
  $query="select * from status_comments, register where status_comments.user_id=register.id and status_id=$statusid order by status_comments.id asc";
  return  mysql_query($query);
}

function getAddFriendStatus($user_id_going, $user_id_coming){
  $query="select * from friends where (user_id_request=$user_id_going and user_id_recieve=$user_id_coming) or (user_id_request=$user_id_coming and user_id_recieve=$user_id_going)";
    return  mysql_query($query);
}

function acceptRequestFriend($userRequest,$userRecieve){
  $query="update friends set status=2 where user_id_request=$userRequest and user_id_recieve=$userRecieve";
  //echo $query;
  return mysql_query($query);
}
function rejectRequestFriend($userRequest,$userRecieve){
  $query="update friends set status=0 where user_id_request=$userRequest and user_id_recieve=$userRecieve";
  //echo $query;
  return mysql_query($query);
}

function friendslist($userID){
  $query="select * from register where id in(select IF( friends.user_id_request= $userID,friends.user_id_recieve,friends.user_id_request) as a from friends,register where friends.user_id_request=$userID or friends.user_id_recieve=$userID  and friends.status=2 group by friends.id)";
  return mysql_query($query);
}

function getPost($statusID){
  $query="select register.id as id,name, address, email, status.id as stattus_id, content, privacy_status, delete_status, create_time, update_time from status,register where status.id=$statusID and status.user_id= register.id";

  return mysql_query($query);
}

function search($key){
  $query="select * from register where name like '%$key%'";
//  echo $query;
  return mysql_query($query);
}

function getRequestFriendList($userId){
  $query="select notifications.id AS notif_id, name, register.id AS user_id, notifications.status,user_id_request from notifications, friends,register where notifications.id=friends.notif_id and friends.user_id_request=register.id and user_id_recieve=$userId and notifications.status!=0 and notifications.status!=3 order by notifications.id desc";
  return mysql_query($query);
}

function getNotificationList($userId){
  $query="select notifications.id AS notif_id, name, register.id AS user_id, status,link  from notifications,register where notifications.user_id=$userId and notifications.sender_id=register.id and type=3 and status!=0 and status!=3 order by notifications.id desc";

  return mysql_query($query);
}



//post status;
if(isset($_POST['postStatus1'])&&$_POST['postStatus1']=='yes'){
  include "md-config.php";

  if( (trim($_POST['content'])=="" ||$_POST['content']== null)&&$_POST['file_name']=="" )
    return;

  $sendNotif=true;
  $result=postStatus($_POST['user_id'], $_POST['content'],2,$_POST['file_name']);
  if($result==false)
  {
     echo $result;
  }
   else{
     echo "ok";
   }

}



//post comment;
if(isset($_POST['postcomment1'])&&$_POST['postcomment1']=='yes'){
  include "md-config.php";

  if( (trim($_POST['content'])=="" ||$_POST['content']== null)&&$_POST['file_name']=="" )
    return;

  $sendNotif=true;
  if($_POST['userloggedid']==$_POST['user_id'])
      $sendNotif=false;
  $result=postComment($_POST['userloggedid'], $_POST['statusid'], $_POST['content'],$sendNotif,$_POST['user_id'],$_POST['file_name']);
  if($result==false)
  {
     echo $result;
  }
   else{
     if($_POST['file_name']=="")
      echo '<div class="comment"><p><span class="name">'.$_POST['userloggedname'].':</span> <span class="comment-text"></span>'.$_POST['content'].'<span class="date-cmt">Now</span></p></div>';
     else
      echo '<div class="comment"><p><span class="name">'.$_POST['userloggedname'].':</span> <span class="comment-text"></span>'.$_POST['content'].'<span class="date-cmt">Now</span></p><img src="'.working_domain.'../upload_files/images/'.$_POST['file_name'].'" /></div>';
   }

}


//addfriend;
if(isset($_POST['addfriend1'])&&$_POST['addfriend1']=='yes'){
  include "md-config.php";
  $notif_id=sendNotification($_POST['friendid'],$_POST['userloggedid'],"","","1");
  $result=addFriend($_POST['friendid'],$_POST['userloggedid'],$notif_id);
  if($result==true)
    return $result;
}


//get notif friend request;
if(isset($_POST['getFriendRequest1'])&&$_POST['getFriendRequest1']=='yes'){
  include "md-config.php";

  $result=getNotificationWithType($_POST['user_id'],$_POST['type']);
  if($result)
  {
    if($_POST['type']==1){
      echo '<ul class="add_friend_request_list notifi_list">';
      while ($row =  mysql_fetch_array($result)):
         echo '<li class="li-'.$row['notif_id'].'"><span>'.$row['name'].'</span> <button class="accept-add-friend-request" onclick=acceptRequest("'.$row['user_id_request'].'",'.$row['notif_id'].') >Accept</button><button class="reject-add-friend-request" onclick=rejectRequest("'.$row['user_id_request'].'",'.$row['notif_id'].') >Reject</button></li>';
      endwhile;
      echo '</ul>';
    }else if($_POST['type']==2){
      echo '<ul class="add_friend_request_list notifi_list">';
      while ($row =  mysql_fetch_array($result)):
         echo '<li class="li-'.$row['notif_id'].'"><a href="#">'.$row['name'].' comment on your post</a></li>';
      endwhile;
      echo '</ul>';
    }
    else if($_POST['type']==3){
      echo '<ul class="add_friend_request_list notifi_list">';
      while ($row =  mysql_fetch_array($result)):
        echo '<li class="li-'.$row['notif_id'].'"><a onclick=updateStatusNotif("'.$row['notif_id'].'") class="notif-status-'.$row['status'].'" href="'.$row['link'].'">'.$row['name'].' comment on your post</a></li>';
       endwhile;
      echo '</ul>';

    }
  }
}

//accept add friend request;
if(isset($_POST['acceptFriendRequest1'])&&$_POST['acceptFriendRequest1']=='yes'){
  include "md-config.php";

  echo $result=acceptRequestFriend($_POST['userRequest'],$_POST['userRecieve']);
  if($result)
    updateNotificationStatus($_POST['notif_id'],3);

}

//reject add friend request;
if(isset($_POST['rejectFriendRequest1'])&&$_POST['rejectFriendRequest1']=='yes'){
  include "md-config.php";

  echo $result=rejectRequestFriend($_POST['userRequest'],$_POST['userRecieve']);
  if($result)
    updateNotificationStatus($_POST['notif_id'],3);

}


//update notification status;
if(isset($_POST['updateStatusNotif1'])&&$_POST['updateStatusNotif1']=='yes'){
  include "md-config.php";
  updateNotificationStatus($_POST['notif_id'],2);
}

//unfriend-btn
if(isset($_POST['unfriend1'])&&$_POST['unfriend1']=='yes'){
  include "md-config.php";
  unFriend($_POST['friendid'],$_POST['userloggedid']);
}


?>
