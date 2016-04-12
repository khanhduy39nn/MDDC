 <?php
	session_start();
	//ini_set('display_errors', 1);
	require dirname( __FILE__ ).'/config_facebook.php';
	require dirname( __FILE__ ).'/Fb/facebook.php';

  if(isset($_GET['connect'])){
    $_SESSION['getType']='connect';
  }else if(isset($_GET['login'])){
    $_SESSION['getType']='login';
  }


  $url=base64_decode($_GET['url']);



	$facebook = new Facebook(array(
	'appId' => '1519815598316380',
	'secret' => '7b0c175b1bd903a70d21add45c9d9860',
	'cookie' => true
	));


		$user = $facebook->getUser();
		$loginUrl = $facebook->getLoginUrl();

	if ( !isset($_GET['code']) ) {
		echo("<script> top.location.href='" . $loginUrl . "'</script>");
		exit();
	}else{

    //for login
    if($_SESSION['getType']=='login'){
      $fail = "";
      $sql="SELECT * FROM register WHERE social_type='facebook' and social_id = '".$user."'";
      $login_detail = mysql_query($sql);
      if(mysql_num_rows($login_detail) == 1){
        $_SESSION['login_register'] = 'yes';
        $_SESSION['detail'] = mysql_fetch_assoc($login_detail);

        echo(
        '<script>
        window.opener.location.assign("'.$url.'");
        window.close();
        </script>'
        );
      }else{
        $_SESSION['social_type']='facebook';
        $_SESSION['social_id']=$user;
        echo(
        '<script>
        window.opener.location.assign("http://milliondollardesiclub.com/register/registerbysocial.php");
        window.close();
        </script>'
        );
        die();
      }
      echo $user;
    }//for login
    else if($_SESSION['getType']=='connect'){
  		echo(
  		'<script>
  		window.opener.location.assign("http://milliondollardesiclub.com/connect/facebook-invite.php");
  		window.close();
  		</script>'
  		);
  		die();
    }
	}
	?>
