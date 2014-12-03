<html>
<head>
<?php

session_start();


	require_once("../db/dbpass.php");
try{
	$db= new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'].';charset=utf8',$db['user'],$db['passwd']);
}
	catch(PDOExeption $e)
{
	die('エラーメッセージ'.$e->getMessage());	
}

$stt = $db->prepare('INSERT INTO eventthread(threadId,userName,lat,lng,location,eventName,eventDate,
eventTime,distance,pace,comment)VALUES(:threadId,:userName,:lat,:lng,:location,:eventName,:eventDate,
:eventTime,:distance,:pace,:comment)');

$threadNumber=mt_rand(10000000, 99999999);
$_SESSION['threadNumber'] = $threadNumber;
$stt->bindvalue(':threadId',$threadNumber);
$stt->bindvalue(':userName',$_COOKIE['userName']);
$stt->bindvalue(':lat',$_SESSION['lat']);
$stt->bindvalue(':lng',$_SESSION['lng']);
$stt->bindvalue(':location',$_SESSION['mapAddress']);
$stt->bindvalue(':eventName',$_SESSION['eventName']);
$stt->bindvalue(':eventDate',$_SESSION['eventDate']);
$stt->bindvalue(':eventTime',$_SESSION['eventTime']);
$stt->bindvalue(':distance',$_SESSION['distance']);
$stt->bindvalue(':pace',$_SESSION['pace']);
$stt->bindvalue(':comment',$_SESSION['details']);
$stt->execute();

$twitterposturl="http://bikeoffsite.lolipop.jp/createevent/twitterpost.php";

print("登録完了しました。</br></br>");
print("<a href=../event/".$threadNumber.".php>イベントページへ</a></br>");

$html=<<<EOF
<?php
require_once("../eventpage/eventpage.php");
?>
EOF;
   $file=fopen("../event/$threadNumber.php",'ab');
	fputs($file,$html);
	fclose($file);

?>
</head>
<body>
<a href="http://bikeoffsite.lolipop.jp/createevent/twitterpost.php">twitterにイベントを投稿する。</a>
	
</body>
</html>