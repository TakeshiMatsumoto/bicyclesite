<?php require_once(dirname(__FILE__) ."/encode.php");
session_start();
?>

<! DOCTYPE html>
<html>	
<head>

<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link type="text/css" href="../css/background.css" rel="stylesheet" />
<script type="text/javascript" src="../jquery-ui-1.10.2.custom.min.js"></script>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<link href="../css/googlemap.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../timepicker/timepicker.js"</script>
<script type="text/javascript" src="../timepicker/jquery.ui.datepicker-ja.js"</script>
<script type="text/javascript" src="createevent.js"</script>
<link type="text/css" href="../timepciker/jquery.timepicker.css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
<script src="../createmap/createmaps.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../timepicker/timepicker.css" rel="stylesheet" type="text/css">
<script src="../createmap/createmaps.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>create event</title>

<script>
$(function(){
$('#eventTime').timepicker();
});

$(function(){
　$("#eventDate").datepicker({dateFormat: 'yy-mm-dd'});
});

</script>


<?php


session_start();
require_once(dirname(__FILE__) .'/twitteroauth.php');



if(isset($_POST['check'])){ //postされた場合に
	$eventName=$_POST['eventName'];
	$eventDate=$_POST['eventDate'];
	$eventTime=$_POST['eventTime'];
	$distance=$_POST['distance'];
	$pace=$_POST['pace'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
    $details=htmlspecialchars($_POST['details'], ENT_QUOTES, 'UTF-8');
	$_SESSION['details']= nl2br($details);
	$_SESSION['mapAddress']=$_POST['mapAddress'];
	$error="";

if($_COOKIE['userName']==null){//クッキーがセットされてなかったら
	
	setcookie("userName",$_POST['userName'],time()+60*60*24*30*10,'/');
	setcookie("oauth_token",$_SESSION['oauth_token'],time()+60*60*24*30*10,'/');
	setcookie("oauth_token_secret",$_SESSION['oauth_token_secret'],time()+60*60*24*30*10,'/');
	setcookie("oauth_verifier",$_SESSION['oauth_verifier'],time()+60*60*24*30*10,'/');
	setcookie("access_token",$_SESSION['access_token'],time()+60*60*24*30*10,'/');	  

}

if($eventName==""){//入力されてなかったらエラーメッセージ、されていたらエスケープ処理
	
	print("<font size='3' color='red'>イベント名を入力してください</font></br>");
	$error=a;

}else{
	
	$_SESSION['eventName']=htmlspecialchars($eventName, ENT_QUOTES, 'UTF-8');	
}

if($eventDate=="")
{
	print("<font size='3' color='red'>日付を入力してください</font></br>");
	$error=a;

}else{
	$_SESSION['eventDate']=htmlspecialchars($eventDate, ENT_QUOTES, 'UTF-8');	
}

if($eventTime=="")
{
	print("<font size='3' color='red'>時間を入力してください</font></br>");
	$error=a;
}else{
	
	$_SESSION['eventTime']=htmlspecialchars($eventTime, ENT_QUOTES, 'UTF-8');	
}

if($distance=="")
{
	print("<font size='3' color='red'>距離を入力してください</font></br>");
	$error=a;
}else{
	$_SESSION['distance']=	htmlspecialchars($distance, ENT_QUOTES, 'UTF-8');
}

if($pace=="")
{
	print("<font size='3' color='red'>ペースを入力してください</font></br>");
	$error=a;
}else{

	$_SESSION['pace']=htmlspecialchars($pace, ENT_QUOTES, 'UTF-8');
}

if($lat==""||$lng=="")
{
	print("<font size='3' color='red'>集合場所を地図から入力してください</font></br>");
	$error=a;
}else{
	$_SESSION['lat']=$lat;
	$_SESSION['lng']=$lng;
}

if($error=="")
{
	header("Location:confirm.php");	
}
}

if($_COOKIE['userName']==null){
	
	
	define('CONSUMER_KEY', 'Lxwou8zNqRuCEF9lf7dFQ');
	define('CONSUMER_SECRET', 'VTVRjVliSlHQ6hQDptJxAdNtwinrOYbcR3NRarbmCc');
 

 
	// access token 取得
	$tw = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
	$_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$access_token = $tw->getAccessToken($_REQUEST['oauth_verifier']);

if ($_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
    unset($_SESSION);
    echo '<a href="../login/login.php">ログインしてください。</a>';
    exit;
}

//screen_name(表示名)
$screen_name = $access_token['screen_name'];
$_SESSION['oauth_verifier']=$_REQUEST['oauth_verifier'];
$_SESSION['userName']=$screen_name;
setcookie("userName",$screen_name,time()+60*60*24*30*10,'/');
setcookie("oauth_token",$access_token['oauth_token'],time()+60*60*24*30*10,'/');
setcookie("oauth_token_secret",$access_token['oauth_token_secret'],time()+60*60*24*30*10,'/');
setcookie("access_token",$access_token,time()+60*60*24*30*10,'/');
}
?>
	</head>
	<body style="padding-top: 60px">

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">

        <a href="http://bikeoffsite.lolipop.jp/index.html" class="brand">のるりんＴＯＰ</a>
        <ul class="nav">
            <li><a href="http://bikeoffsite.lolipop.jp/login/logincheck.php">イベント作成</a></li>
            <li><a href="http://bikeoffsite.lolipop.jp/searchevent/serchevent.php">イベント検索</a></li>
        </ul>
    </div>

</div>


		<h1>イベント情報入力画面</h1><br /><br/><br/>
    <div id="map-canvas" style="width:50%; height:50%" style="text-align:center"> </div><br>
   地図から 集合場所を検索（フォームから検索して、地図のマーカーを集合場所に移動させてください。）
    <div  style="text-align:center">
    <input id="searchTextField" class="span7" type="text" size="1000">

      	</div><br>
<form method="post" action="createevent.php">
	　　　　　　　イベント名（○○サイクリングなど。地名をいれると他のユーザーが見つけやすいです。）<br/>
	<input type="textarea" class="span4" id="eventName" name="eventName"><br/><br/>
	　　　　　　　日付（フォームをクリックすると入力用カレンダーが表示されます）<br/>
	<input type="text" id="eventDate" name="eventDate" value="<?php print($_SESSION['eventDate']); ?>"/><br/><br/>
	　　　　　　　集合時間（フォームをクリックすると入力用プルダウンが表示されます）<br/>
    <input type="textarea" class="input-medium" id="eventTime" name="eventTime" value="<?php print($_SESSION['eventTime']); ?>"/><br/><br/>
    　　　　　距離（おおよそで構いません）<br/>
    <input type="textarea" class="span2" id="distance" name="distance" value="<?php print($_SESSION['distance']); ?>"><br/><br/>
    　　ペース<br/>
    <input type="radio" name="pace" value="20km/h～25km/h"/> 20km/h～25km/h
　　　<input type="radio" name="pace" value="25km/h～30km/h" /> 25km/h～30km/h
    <input type="radio" name="pace" value="30km/h以上" /> 30km/h以上
    <input type="radio" name="pace" value="特に決めない。その場の状況に合わせる" /> 特に決めない。その場の状況に合わせる<br /><br/>
    　　　　　　　　　イベント概要（集合場所の詳細、具体的な目的、ルートなど上記フォームで書ききれなかったこと何でも）<br />
    <textarea  wrap="hard" class="span7"  id="details" name="details" rows="7" cols="90" ><?php print($_SESSION['details']); ?></textarea><br/><br/>
    <input type="hidden" id="lng" name="lng" value="<?php print($_SESSION['lng']); ?>">
    <input type="hidden" id="lat" name="lat" value="<?php print($_SESSION['lat']); ?>">
    <input type="hidden" id="mapaddress" name="mapAddress">
    <input type="text" name="userName" value=<?php print($screen_name); ?>>
    <input type="hidden" id="check" name="check" value="checked">
    <input type="submit" class="btn btn-primary">
</form>
	</body>