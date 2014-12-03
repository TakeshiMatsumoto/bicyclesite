<?php

require_once("../db/dbpass.php");
try{
	$db= new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'].';charset=utf8',$db['user'],$db['passwd']);
}
	catch(PDOExeption $e)
{
	die('エラーメッセージ'.$e->getMessage());	
}


$dbUserName=$db->prepare('select * from event where threadNumber='.$_POST['threadNumber']);
echo $_POST['threadNumber'];
$dbUserName->execute();

while($dbUserNameResult=$dbUserName->fetch()){
echo $dbUserNameResult['userName'];
		if($_COOKIE['userName']==$dbUserNameResult['userName']){//既にイベントに参加してＤＢに登録していたら

           	$participant="YES";
          }
	
}


If($participant!="YES"){
	$stt = $db->prepare('INSERT INTO event(threadNumber,userName)VALUES(:threadNumber,:userName)');
	$stt->bindvalue(':threadNumber',$_POST['threadNumber']);
	$stt->bindvalue(':userName',$_POST['userName']);
	$stt->execute();
	print("イベントに参加登録しました。");
}else
{
	print("あなた既に参加しています");
}
$url = $_POST['eventUrl'];
echo '<a href='. $url .'>元のページへ</a>';
?>