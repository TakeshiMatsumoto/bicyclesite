<?php
    try{
	$db= new PDO('mysql:host=mysql009.phy.lolipop.lan;dbname=LAA0433996-bikesite;charset=utf8','LAA0433996','8754693');
}
	catch(PDOExeption $e)
{
	die('エラーメッセージ'.$e->getMessage());	
}

$stt = $db->prepare('INSERT INTO threadres(threadid,username,comment)VALUES(:threadid,:username,:comment)');

$stt->bindvalue(':threadid',$_POST['threadid']);
$stt->bindvalue(':username',$_POST['username']);
$stt->bindvalue(':comment',$_POST['eventcomm']);
$stt->execute();


?>