<html>
<head>

	<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
	<?php


session_start();
require_once('../twitterAuth/twitteroauth.php');



define('CONSUMER_KEY', 'Lxwou8zNqRuCEF9lf7dFQ');
define('CONSUMER_SECRET', 'VTVRjVliSlHQ6hQDptJxAdNtwinrOYbcR3NRarbmCc');
 

 
// access token 取得
$tw = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
$_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
$access_token = $tw->getAccessToken($_REQUEST['oauth_verifier']);
 
// Twitter の user_id + screen_name(表示名)
$user_id     = $access_token['user_id'];
$screen_name = $access_token['screen_name'];

$_SESSION['userName']=$screen_name;
setcookie("userName",$screen_name,time()+60*60*24*30*10,'/');

$_SESSION['oauth_token']=$access_token['oauth_token'];
$_SESSION['oauth_token_secret']=$access_token['oauth_token_secret'];

setcookie("oauth_token",$_SESSION['oauth_token'],time()+60*60*24*30*10,'/');
setcookie("oauth_token_secret",$_SESSION['oauth_token_secret'],time()+60*60*24*30*10,'/');
echo $screen_name;
?>	
	
</head>
	<body>
<form action="templogin2.php" method="post" >
    <input type="hidden" name="userName" value=<?php echo $screen_name; ?>>
<input type="hidden" id="check" name="check" value="checked">
<input type="submit" class="btn btn-praimary" value="元のページに戻る">
</form>		
		
		
		
	</body>
</html>