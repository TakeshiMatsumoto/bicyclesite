<?php
require_once("../db/dbpass.php");


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
	$stt->bindvalue(':userName',$_COOKIE['userName']);
	$stt->bindvalue(':comment',$comment);
	$stt->execute();

header("Location:".$_POST['eventUrl']);

?>