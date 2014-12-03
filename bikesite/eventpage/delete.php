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

$pre=$db->prepare("DELETE FROM threadres WHERE postnum=".$_SESSION['postnum']);
$pre->execute();
print("正常に削除されました。");
$url=$_SESSION['eventurl'];
echo '<a href='. $url .'>元のページへ</a>';

   
?>