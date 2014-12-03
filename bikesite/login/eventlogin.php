<?php
session_start();
require_once('../twitterAuth/twitteroauth.php');
 
// api 登録して取得した文字列を入れます
define('CONSUMER_KEY', 'Lxwou8zNqRuCEF9lf7dFQ');
define('CONSUMER_SECRET', 'VTVRjVliSlHQ6hQDptJxAdNtwinrOYbcR3NRarbmCc');
define('CALLBACK_URL', 'http://bikeoffsite.lolipop.jp/login/templogin.php');
 
// request token取得
$tw = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);//
 
$token = $tw->getRequestToken(CALLBACK_URL);//このコールバックurlでリクエストトークンを作る。
if(! isset($token['oauth_token'])){
    echo "error: getRequestToken\n";
    exit;
}
 
// callback.php で使うので session に突っ込む。
$_SESSION['oauth_token']        = $token['oauth_token'];
$_SESSION['oauth_token_secret'] = $token['oauth_token_secret'];
 $_SESSION['eventUrl']=$_POST['eventUrl'];
// 認証用URL取得してredirect
$authURL = $tw->getAuthorizeURL($_SESSION['oauth_token']);
header("Location: " . $authURL);