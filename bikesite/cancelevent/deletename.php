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


$pre=$db->prepare("DELETE FROM event WHERE threadNumber=".$_SESSION['threadNumber']." AND userName='".$_SESSION['userName']."'");
$pre->execute();
$url = $_SESSION['eventUrl'];
print("正常に削除されました。");
echo '<a href='. $url .'>元のページへ</a>';
?>
