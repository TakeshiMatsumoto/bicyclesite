<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="../jquery-ui-1.10.2.custom.min.js"></script>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
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
$_SESSION['postNum']=$_POST['postNum'];

   if($_SESSION['userName']==$_POST['userName'])//削除しようとしたコメントの投稿主とと消そうと操作しているユーザー名が合致するなら
{
		
	$pre=$db->prepare("SELECT*FROM threadres WHERE postNum=".$_SESSION['postNum']);//消そうとしているレスのレス番号で検索する
	$pre->execute();

	while($all=$pre->fetch()){
		print("以下のレスを削除します。よろしいですか？");
		print("</br>");
		print($all['comment']);
 		print("<form action='delete.php' method='post'/> <input type='hidden' name='confirm' value='OK'><input type='hidden' name='userName' value=".$_SESSION['userName']."><input type='submit' class='btn btn-danger' value='はい'></form>");
}

}else{
	print("投稿したユーザー以外削除できません");
}
  
?>
</head>
</html>
