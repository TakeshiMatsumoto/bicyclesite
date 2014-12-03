<html>
	<head>
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>
<body>
<?php

require_once("../db/dbpass.php");
try{
	$db= new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'].';charset=utf8',$db['user'],$db['passwd']);
}
	catch(PDOExeption $e)
{
	die('エラーメッセージ'.$e->getMessage());	
}


if($_POST['eventdate2']!=NULL&&$_POST['eventdate']!=NULL&&$_POST['prefecture']!=NULL){
$pre=$db->prepare("SELECT * FROM eventthread WHERE location LIKE '%{$_POST['prefecture']}%' AND eventDate  BETWEEN '{$_POST['eventdate']}' AND '{$_POST['eventdate2']}'");
$pre->execute();

while ($searchresult=$pre->fetch()) {
	
	print("<table class='table table-bordered'>");
	print("<tr><td>".$searchresult['eventDate']."</td><td>"."<A Href=http://bikeoffsite.lolipop.jp/createevent/".$searchresult['threadId'].".php>".$searchresult['eventName']."</A></td></tr>");
	print("</table>");
$emptycheck=$searchresult['eventName'];

}
}


if($_POST['eventdate']==NULL||$_POST['eventdate2']==NULL){

	print("日付を範囲の終わりと始まり両方入力してください");
}

if($_POST['prefecture']==NULL){
	print("場所を入力してください。");
}

if($emptycheck==NULL)
{
	print("見つかりませんでした。");
}
?>
</body>
</html>