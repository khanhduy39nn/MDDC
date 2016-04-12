<?php

$sql="SELECT * FROM register WHERE social_type='google' and social_id = '".$_POST['id']."'";
$login_detail = mysql_query($sql);
if(mysql_num_rows($login_detail) == 1){
  $_SESSION['login_register'] = 'yes';
  $_SESSION['detail'] = mysql_fetch_assoc($login_detail);

$url='http://milliondollardesiclub.com/connect';
  echo(
  '<script>
  window.opener.location.assign("'.$url.'");
  window.close();
  </script>'
  );
}else{
  $_SESSION['social_type']='google';
  $_SESSION['social_id']=$user;
  if(isset($_POST['name']))
    $_SESSION['social_name']=$_POST['name'];
  if(isset($_POST['email']))
    $_SESSION['social_email']=$_POST['email'];
  echo(
  '<script>
  window.opener.location.assign("http://milliondollardesiclub.com/register/registerbysocial.php");
  window.close();
  </script>'
  );
  die();
}
