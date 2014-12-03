<?php 
session_start();

setcookie("userName",$_POST['userName'],time()+60*60*24*30*10,'/');
setcookie("oauth_token",$_SESSION['oauth_token'],time()+60*60*24*30*10,'/');
setcookie("oauth_token_secret",$_SESSION['oauth_token_secret'],time()+60*60*24*30*10,'/');
header("Location:".$_SESSION['eventUrl']);	


?>