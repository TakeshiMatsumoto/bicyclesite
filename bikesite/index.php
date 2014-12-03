<html>
	<head>
<title>自転車オフ支援サイト　のるりん！</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="./css/index.css" rel="stylesheet" type="text/css"><link />
	</head>
	<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">

        <a href="/index.html" class="brand" class="active">のるりんＴＯＰ</a>
        <ul class="nav">
            <li><a href="http://bikeoffsite.lolipop.jp/login/logincheck.php">イベント作成</a></li>
            <li><a href="http://bikeoffsite.lolipop.jp/searchevent/serchevent.php">イベント検索</a></li>
        </ul>
    </div>
</div>
<div style="padding-top: 100px"> </div>
<div align="center" class="second">自転車乗りのためのオフ会支援サイト</div></br>
<div align="center" id="title">のるりん！</div></br>
<div style="padding-top: 50px"> </div>
<img height="100px" width="500px"src="./tourdefrance.jpg">
<div style="padding-bottom: 30px"> </div>



<A href="./login/logincheck.php" class="menu">・サイクリングイベントを発案する</A>（Twitter認証）</br></br>
<A href="./searchevent/searchevent.php" class="menu">・登録されているイベントを検索する</A></br></br>
</br></br>
<a href="http://bikeoffsite.lolipop.jp/createevent/91513420.php" class="menu">【サンプルイベント】江田島サイクリング</a></br></br>

<h2>最新イベント</h2>

<?php
require_once("./db/dbpass.php");
try{
	$db= new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'].';charset=utf8',$db['user'],$db['passwd']);
}
	catch(PDOExeption $e)
{
	die('エラーメッセージ'.$e->getMessage());	
}

$recentEvent=$db->prepare('select * from eventthread order by eventDate desc limit 5');
$recentEvent->execute();

while ($recentEventData=$recentEvent->fetch()){

        $threadNumber=$recentEventData['threadId'];
        $eventDate=$recentEventData['eventDate'];
        $eventName=$recentEventData['eventName'];

        echo '・<a href=./event/'. $threadNumber .'.php>'.$eventDate.'  '.$eventName.'</a></br></br>';

}

?>
</br>
<div align="center" class="second">サイト概要</div></br>
のるりんは自転車の乗りのためのサイクリングオフ会支援サイトです。<br></br>

利用法は大きく分けて二つです。</br></br>

<h4>１　自分でイベントを発案する。</h3></br>

<h4>２　既にあるイベントに参加する。</h3></br>


<h3>それぞれの流れ</h2></br></br>

<h3>１　自分でイベントを発案する</h3></br></br>

<A href="./login/logincheck.php" class="menu">イベント登録</A></br></br>
↓</br></br>
イベント参加者が来るのを待つor twitter等で宣伝する</br></br>
↓</br></br>
イベント当日</br></br>

<h3>2 既にあるイベントに参加する。</h3></br></br>

<A href="./searchevent/searchevent.php" class="menu">イベント検索</A></br></br>
↓</br></br>
興味があるイベントを見つけたらイベントに参加をクリック</br></br>
↓</br></br>
イベントページで交流など</br></br>
↓</br></br>
イベント当日</br></br>

イベント登録、イベント参加はtwitter認証が必要です。
イベント検索とイベントを見るのはtwitterアカウントがなくてもできます

	</body>
</html>