<?php
  ini_set('display_errors', 1);

  // You'll probably use a database
  session_start();

  define ('API_KEY', '757qgfh0b01xem');
  define ('API_SECRET', '9SuYV5W0gL9zVBiY');
  define('REDIRECT_URI', 'http://milliondollardesiclub.com/connect/openid/?serviceid=5');
  define('SCOPE',        'r_basicprofile');


if(!isset($_SESSION['url_redirect'])||$_SESSION['url_redirect']=='')
  $_SESSION['url_redirect']=base64_decode($_GET['url']);


  if(!isset($_GET['code'])&&!isset($_GET['error'])){
      getAuthorization();
  }
  else{
    $token=getToken();
    //$result=fetch('','https://api.linkedin.com/v1/people/~/connections:(headline,first-name,last-name)');
    $result=fetch('https://api.linkedin.com/v1/people/~',$token);

    $json=json_decode($result);
    $sql="SELECT * FROM register WHERE social_type='linkedin' and social_id = '".$json->id."'";
    $login_detail = mysql_query($sql);
    if(mysql_num_rows($login_detail) == 1){
      $_SESSION['login_register'] = 'yes';
      $_SESSION['detail'] = mysql_fetch_assoc($login_detail);
      echo(
      '<script>
      window.opener.location.assign("'.$_SESSION['url_redirect'].'");
      window.close();
      </script>'
      );
    }else{
      $_SESSION['social_fullname']=$json->firstName.' '.$json->lastName;
      $_SESSION['social_type']='linkedin';
      $_SESSION['social_id']=$json->id;
      echo(
      '<script>
      window.opener.location.assign("http://milliondollardesiclub.com/register/registerbysocial.php");
      window.close();
      </script>'
      );
      die();
    }
  }



  function getAuthorization(){
    $_SESSION['state']=md5(time());
    $url='https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id='.API_KEY.'&redirect_uri='.urlencode(REDIRECT_URI).'&state='.$_SESSION['state'].'&scope='.urlencode(SCOPE);

    echo '<script>';
    echo 'window.location.assign("'.$url.'")';
    echo '</script>';
    exit();
  }
  function getToken(){
    $params = array('grant_type' => 'authorization_code',
                    'client_id' => API_KEY,
                    'client_secret' => API_SECRET,
                    'code' => $_GET['code'],
                    'redirect_uri' => REDIRECT_URI,
              );

    // Access Token request
    $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
    //echo $url;
    $token=get_fcontent($url);
    $token=json_decode($token);
    return $token->access_token;

  }

  function fetch($resource, $token) {
    $params = array('oauth2_access_token' => $token,
                    'format' => 'json',
              );

    // Need to use HTTPS
    //$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
    $url = $resource . '?' . http_build_query($params);
    $response = get_fcontent($url);
    // Native PHP object, please
    return $response;
  }
function get_fcontent( $url,  $javascript_loop = 0, $timeout = 5 ) {
    $url = str_replace( "&amp;", "&", urldecode(trim($url)) );

    $cookie = tempnam ("/tmp", "CURLCOOKIE");
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch, CURLOPT_ENCODING, "" );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
    curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
    $content = curl_exec( $ch );
    $response = curl_getinfo( $ch );
    curl_close ( $ch );

    if ($response['http_code'] == 301 || $response['http_code'] == 302) {
        ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");

        if ( $headers = get_headers($response['url']) ) {
            foreach( $headers as $value ) {
                if ( substr( strtolower($value), 0, 9 ) == "location:" )
                    return get_url( trim( substr( $value, 9, strlen($value) ) ) );
            }
        }
    }

    if (    ( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value) || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value) ) && $javascript_loop < 5) {
        return get_url( $value[1], $javascript_loop+1 );
    } else {
        return $content;
    }
}

?>
