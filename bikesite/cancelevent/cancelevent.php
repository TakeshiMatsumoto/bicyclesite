<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="../bootstrap/js/bootstrap.min.js"></script>
	
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

$_SESSION['userName']=$_COOKIE['userName'];
$_SESSION['threadNumber']=$_POST['threadNumber'];
$_SESSION['eventName']=$_POST['eventName'];


$pre=$db->prepare("SELECT * FROM event WHERE threadNumber=".$_SESSION['threadNumber']);
$pre->execute();

while ($name=$pre->fetch()) {
	
	if($name['userName']==$_SESSION['userName'])//イベント登録をしていたら
{   
		$confirm=1;
}

                            }

	if($confirm==1){

	$_SESSION['eventUrl']=$_POST['eventUrl'];
	print("<h1>".$_SESSION['eventName']."へのイベント参加を中止しますか？<h1><br/>");
	print("<form action='deletename.php' method='post'/> <input type='hidden' name='confirm' value='OK'><input type='hidden' name='userName' value=".$_SESSION['userName']."><input type='submit' class='btn btn-danger' value='はい'></form>");

} else{
   	print("あなたはイベントに参加していません");
	print($confirm);
   }