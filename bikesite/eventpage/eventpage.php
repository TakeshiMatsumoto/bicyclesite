<html>
<head>
<link href="../css/googlemap.css" rel="stylesheet" type="text/css" />
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../doublepost/doublepost.js"></script>
<link type="text/css" href="../css/background.css" rel="stylesheet" />
<title>自転車オフ支援サイト　のるりん！</title>

<?php
session_start();
require_once("../db/dbpass.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {//post送信されたらページをリロードする。
	header("Location: " . $_SERVER['PHP_SELF']);

}

$threadNumber=basename($_SERVER["PHP_SELF"],".php");//開こうとしているファイル名を所得。このファイル名がデータベースからデータを取ってくるときのキー

try{
	$db= new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'].';charset=utf8',$db['user'],$db['passwd']);
}
	catch(PDOExeption $e)
{
	die('エラーメッセージ'.$e->getMessage());	
}


$pre=$db->prepare("SELECT * FROM eventthread WHERE threadId=$threadNumber");
$pre->execute();
$eventInfo = array();

while($dbeventInfo=$pre->fetch())
{
	$eventInfo['threadId']=$dbeventInfo['threadId'];
	$eventInfo['userName']=$dbeventInfo['userName'];;
	$eventInfo['lat']=$dbeventInfo['lat'];
	$eventInfo['lng']=$dbeventInfo['lng'];
	$eventInfo['location']=$dbeventInfo['location'];
	$eventInfo['eventName']=$dbeventInfo['eventName'];
	$eventInfo['eventDate']=$dbeventInfo['eventDate'];
	$eventInfo['eventTime']=$dbeventInfo['eventTime'];
	$eventInfo['distance']=$dbeventInfo['distance'];
	$eventInfo['pace']=$dbeventInfo['pace'];
	$eventInfo['comment']=$dbeventInfo['comment'];
	
	
}


?>

<script>//地図を描画する
var lat=<?php echo $eventInfo['lat'];?>;//緯度経度を保存
var lng=<?php echo $eventInfo['lng'];?>;


function ini() {//地図の初期化
	
	 markerlatlng = new google.maps.LatLng(lat,lng);
	 
    var Options = {
    center: markerlatlng,
    zoom: 16,
    zoomControl:true,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoomControlOptions: {
    style: google.maps.ZoomControlStyle.SMALL
    },
    mapTypeId: google.maps.MapTypeId.ROADMAP
};
  
var gmap = new google.maps.Map(document.getElementById('area2'), Options);
  	// マーカーを生成
	var gmarker = new google.maps.Marker({
		position: markerlatlng,       // 緯度・経度は地図の中心
		title: "maker-test"     // ツールチップ
	});
	// マーカーを地図の中心に表示
    gmarker.setMap(gmap);
}

</script>
	
	<title><?php print($eventInfo['eventName']); ?></title>
</head>
	
<body style="padding-top: 60px" onload="ini()">
		
<div class="container">

	<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
    <div class="container">
    <a href="http://bikeoffsite.lolipop.jp/" class="brand">のるりんＴＯＰ</a>
    <ul class="nav">
        <li><a href="http://bikeoffsite.lolipop.jp/login/logincheck.php">イベント作成</a></li>
        <li><a href="http://bikeoffsite.lolipop.jp/searchevent/serchevent.php">イベント検索</a></li>
    </ul>
    </div>
    </div>
</div>
</div>


<div class="row">
	<div class="span4">　</div>

	<div class="span8">
		<h1><?php  echo $eventInfo['eventName'] ?></h1>
	</div>

	<div class="span4">　</div>

</div>


<div class="row">
	<div class="span4"> </div>
	<div class="span8">
		<h3>待ち合わせポイント</h3>
	</div>
	<div class="span4"> </div>
</div>

<div id="area2"> </div>

<div style="padding-top: 40px"></div>

<div class="row">
	<div class="span4">　</div>

	<div class="span8">
		<table class="table table-condensed table-bordered table-nonfluid">

			<tr><td>開催日：<?php echo $eventInfo['eventDate'];?></td><td>集合時間:<?php echo $eventInfo['eventTime']; ?></td></tr>
		</table>
</div>

	<div class="span4"> </div>	
</div>


<table class="table table-bordered size">
	<div class="row">
		<div class="span4"> </div>
<div class="span8">
	<tr><td>イベント作成者</td><td><?php echo $eventInfo['userName'];?></td></tr>
	<tr><td colspan="2">待ち合わせ住所:<?php echo $eventInfo['location']; ?></td></tr>
</div>

<div class="span4"> </div>
	</div>

	<tr><td>走行距離:<?php echo $eventInfo['distance']; ?> </td><td>ペース:<?php echo $eventInfo['pace']; ?></td></tr>
	<tr><td colspan="2"　><div　style="text-align: center">　　　　　　　　　　　　　　　　　　　　　　　　　イベント概要</div></td></tr>
	<tr><td colspan="2"><?php echo $eventInfo['comment']; ?></td></tr>

</table>

	<div class="span4">　</div>

</div>

<div class="row">
	<div class="span4">  </div>	
<div class="span8">
<table id="participanttable" class="table table-bordered">
<tr><td>現時点でのイベント参加者</td></tr>	</div>
<tr><td><?php 
$pre=$db->prepare("SELECT * FROM event WHERE threadNumber=$threadNumber");
$pre->execute();
while ($name=$pre->fetch()) {
print($name['userName']." ,");
}
?></td></tr>		
</table>

<div class="span4">
	
</div>
</div>
</div>

<div class="row">
	<div class="span4">　</div>

	<div class="span8">

		<h2>みんなのコメント<h2>
	
	</div>

	<div class="span4">
	
	</div>

</div>


<div class="row">
	<div class="span4">
 
	</div>

<table id="commenttable" class="table table-bordered">
<?php

	$check=0;//コメントがあるかどうかのフラグ。なければcheck=0
	$pre=$db->prepare("SELECT * FROM threadres WHERE threadId=$threadNumber");
	$pre->execute();

	while($commentInfo=$pre->fetch()){
		$check++;
		$_SESSION['eventUrl']=$_SERVER["REQUEST_URI"];
		print("<tr><td width='250' colspan='3'>");print($commentInfo['date']);print("</td></tr>");
		print('<tr><td>名前');print($commentInfo['userName']);print("</td><td colspan='3' width='500'>");
		print($commentInfo['comment']);
		print("</br></br><form action='../eventpage/resdelete.php' method='post'><input type='hidden' name='userName' value=".$commentInfo['userName']."><input type='hidden' name='postNum' value=".$commentInfo['postNum']."><input type='submit' class='btn btn-danger' value='削除'/></form>");
		print('</td></tr>');

	}
	
	if($check==0){
		print("<h3>まだ書き込みはありません</h3>");
}
?>
</table>


<?php
echo $_POST['threadId'];

if($_POST['threadId']!=NULL){//コメント投稿

echo"コメント挿入手続き実行中";

	try{
		$db= new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'].';charset=utf8',$db['user'],$db['passwd']);
}
	catch(PDOExeption $e)
{
		die('エラーメッセージ'.$e->getMessage());	
}

	$date=date("Y年m月d日 H:i:s");
	$stt = $db->prepare('INSERT INTO threadres(threadId,date,userName,comment)VALUES(:threadId,:date,:userName,:comment)');

	$comment=htmlspecialchars($_POST['eventcomm'], ENT_QUOTES, 'UTF-8');
	$comment= nl2br($comment);

	$stt->bindvalue(':threadId',$_POST['threadId']);
	$stt->bindvalue(':date',$date);
	$stt->bindvalue(':userName',$_POST['userName']);
	$stt->bindvalue(':comment',$comment);
	$stt->execute();
echo $_cookie['userName'];
}
?>

<div class="row">
	<div class="span4"></div>

<?php  if(isset($_COOKIE['userName'])){ //ログインしているなら　?>

	<div class="span8">
		<h4>イベントの参加・取りやめ</br></h4>
	</div>
<div class="span4">　</div>

</div>

<div class="row">
	<div class="span4">
 
	</div>
<div class="span4">

	<form action="../eventpage/takepartinevent.php" method="post"　  onsubmit="disableSubmit(this)">
	<input type="hidden" name="eventUrl" value=<?php echo $_SERVER["REQUEST_URI"];?>>
	<input type="hidden"  name="threadNumber" value="<?php print $threadNumber; ?>"/>
	<input type="hidden"  name="userName" value=<?php echo $_COOKIE['userName'];  ?>>
	<input type="submit" class="btn btn-primary" value="イベントに参加" />
	</form>
</div>
<div class="span4">
 	<form action="../cancelevent/cancelevent.php" method="post"　  onsubmit="disableSubmit(this)">
	<input type="hidden" name="eventUrl" value=<?php echo $_SERVER["REQUEST_URI"];?>>
	<input type="hidden"  name="threadNumber" value="<?php print $threadNumber; ?>"/>
	<input type="hidden"  name="userName" value=<?php echo $_COOKIE['userName'];  ?>>
	<input type="hidden"  name="eventName" value="<?php print $eventInfo['eventName'];?>"/>
	<input type="submit" class="btn btn-danger" value="イベント参加を取りやめる" />
	</form>
</div>
</div>

<div class="row">
	<div class="span4">　</div>

	<div class="span8">
		<h4>コメント投稿（イベントへの質問や参加表明など）</h4><br />
	</div>
	<div class="span4">　</div>
	
</div>

<div class="row">
	<div class="span4">
 
	</div>

<div class="row">
	<div class="span2">
 
	</div>
	
	<div class="span3">
		<h4>ユーザー名:<?php echo $_COOKIE['userName'];  ?></h4>
	</div>
	
	<div class="span4">　</div>
</div>



<div class="row">
	<div class="span4">　</div>

	<div class="span8">
		<form action="../eventpage/commentregister.php" method="post"  onsubmit="disableSubmit(this)">
		<textarea wrap="hard" name="eventcomm" style="width:350px"; rows="7" cols="30"></textarea>
		<input type="hidden" name="eventUrl" value=<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>>
                <input type="hidden" name="threadId" value="<?php print $threadNumber; ?>">
		<input type="hidden" name="userName" value=<?php echo $_COOKIE['userName'];  ?>>
	</div>
	
	<div class="span4">　</div>
</div>

<div class="row">
	<div class="span4">　</div>

	<div class="span1"></div>
	<div class="span2">
		<input type="submit" class="btn btn-primary" value="投稿">
	</div>

</div>

</form>
<?php } else {?>
<h4>イベントに参加、またはコメントをする場合はログインしてください。</h4>
<form action="../login/eventlogin.php" method="post" >
	<input type="hidden" name="eventUrl" value=<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>>
	<input type="submit" class="btn btn-primary" value="ログイン">
</form>
<?php }   ?>
	</body>
</html>