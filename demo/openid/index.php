<?php 
session_start(); 
$base_url="http://milliondollardesiclub.com/connect";
include ("../../config.php");

if(isset($_GET['serviceid']) && $_GET['serviceid']!='')
{
  switch ($_GET['serviceid']) {
    case '1':
      require 'twitter.php';
      break;
    case '2':
          require 'google.php';
          break;
    case '3':
        require 'facebook.php';
        break;
	case '4':
        require 'yahoo.php';
        break;
    default:
        require 'google.php';
        break;
  }
  die();
}
 ?>
