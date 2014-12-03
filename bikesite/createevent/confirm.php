<?php
session_start();

?>
<html>
<head>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<link href="../css/eventconfirm.css" rel="stylesheet" type="text/css"/>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.10.2.custom.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>確認画面</title>

<?php  $mapAddress=$_SESSION['mapAddress']; 	?>
<script>
var lat=<?php echo $_SESSION['lat'];?>;
var lng=<?php echo $_SESSION['lng'];?>;


function ini() {
	
	markerlatlng = new google.maps.LatLng(lat,lng);
	 
	var Options = {
	center: markerlatlng,
	zoom: 18,
	mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  
	var gmap = new google.maps.Map(document.getElementById('area2'), Options);
  	// マーカーを生成
	var gmarker = new google.maps.Marker({
		position: markerlatlng,       // 緯度・経度は地図の中心
		title: "maker-test"     // ツールチップ
	});
	// マーカーを地図の中心に表示
    gmarker.setMap(gmap);
}
</script>
</head>
<body onload="ini()">
<h1>以下の内容でよろしいでしょうか？</h1>
<h2>待ち合わせ場所</h2>
    <div id="area2" style="width:50%; height:50%" style="text-align:center"> </div><br>
	</body>
イベント名</br>
<?php  print($_SESSION['eventName']);  ?></br></br>
住所</br>
<?php  print($_SESSION['mapAddress']);  ?></br></br>
日付</br>
<?php  print($_SESSION['eventDate']);?></br></br>
時間 </br>
<?php  print($_SESSION['eventTime']);?></br></br>
ペース</br>
<?php  print($_SESSION['pace']);?></br></br>
距離</br>
<?php  print($_SESSION['distance']);?></br></br>
詳細</br>
<?php  print($_SESSION['details']);?></br></br>
<?php  print($_COOKIE['userName']);?></br></br>
<form>
<input type="button" class="btn btn-primary" onclick="location.href='eventregister.php'" value="登録"/>
<input type="button" class="btn btn-primary" onclick="location.href='createevent.php'" value="修正"/>
</form>
</html>

