<?php
session_start();
$eventUrl="http://bikeoffsite.lolipop.jp/event/".$_SESSION['threadNumber'].".php";
$twitterpostcontents=$_SESSION['eventDate']."  ".$_SESSION['eventName']."  ".$eventUrl;

require_once('twitteroauth.php');
define('CONSUMER_KEY', 'Lxwou8zNqRuCEF9lf7dFQ');
define('CONSUMER_SECRET', 'VTVRjVliSlHQ6hQDptJxAdNtwinrOYbcR3NRarbmCc');



$tw = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
$_COOKIE['oauth_token'], $_COOKIE['oauth_token_secret']);


$result=$tw->post('statuses/update', array('status' => $twitterpostcontents));
print_r($result);

header("Location:../event/".$_SESSION['threadNumber'].".php");	


?>