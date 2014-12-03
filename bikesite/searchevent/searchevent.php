<html>
	
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="../jquery-ui-1.10.2.custom.min.js"></script>
<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../timepicker/jquery.ui.datepicker-ja.js"</script>	
<script type="text/javascript" src="jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="../timepicker/jquery.timepicker.min.js"</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link type="text/css" href="../timepicker/jquery.timepicker.css" rel="stylesheet" />
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<link type="text/css" href="../css/background.css" rel="stylesheet" />
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
</head>
<body style="padding-top: 60px">
<script>
$(function(){
　$("#eventdate").datepicker({dateFormat: 'yy-mm-dd'});
});
$(function(){
　$("#eventdate2").datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
<div class="container">

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">

        <a href="/index.html" class="brand" class="active">のるりんＴＯＰ</a>
        <ul class="nav">
            <li><a href="http://bikeoffsite.lolipop.jp/login/logincheck.php">イベント作成</a></li>
            <li><a href="http://bikeoffsite.lolipop.jp/searchevent/serchevent.php">イベント検索</a></li>
        </ul>
    </div>

</div>

<h1>イベントの検索</h1>
イベントの開催場所
<form method="post" action="searchresult.php" > <select name="prefecture">
	<option value="北海道">北海道</option>
	<option value="青森県">青森県</option>
	<option value="秋田県">秋田県</option>
	<option value="岩手県">岩手県</option>
	<option value="山形県">山形県</option>
	<option value="宮城県">宮城県</option>
	<option value="福島県">福島県</option>
	<option value="茨城県">茨城県</option>
	<option value="栃木県">栃木県</option>
	<option value="群馬県">群馬県</option>
	<option value="埼玉県">埼玉県</option>
	<option value="神奈川県">神奈川県</option>
	<option value="千葉県">千葉県</option>
	<option value="東京都">東京都</option>
	<option value="山梨県">山梨県</option>
	<option value="長野県">長野県</option>
	<option value="新潟県">新潟県</option>
	<option value="富山県">富山県</option>
	<option value="石川県">石川県</option>
	<option value="福井県">福井県</option>
	<option value="岐阜県">岐阜県</option>
	<option value="静岡県">静岡県</option>
	<option value="愛知県">愛知県</option>
	<option value="三重県">三重県</option>
	<option value="滋賀県">滋賀県</option>
	<option value="京都府">京都府</option>
	<option value="大阪府">大阪府</option>
	<option value="兵庫県">兵庫県</option>
	<option value="奈良県">奈良県</option>
	<option value="和歌山県">和歌山県</option>
	<option value="鳥取県">鳥取県</option>
	<option value="島根県">島根県</option>
	<option value="岡山県">岡山県</option>
	<option value="広島県">広島県</option>
	<option value="山口県">山口県</option>
	<option value="徳島県">徳島県</option>
	<option value="香川県">香川県</option>
	<option value="愛媛県">愛媛県</option>
	<option value="高知県">高知県</option>
	<option value="福岡県">福岡県</option>
	<option value="佐賀県">佐賀県</option>
	<option value="長崎県">長崎県</option>
	<option value="熊本県">熊本県</option>
	<option value="大分県">大分県</option>
	<option value="宮崎県">宮崎県</option>
	<option value="鹿児島県">鹿児島県</option>
	<option value="沖縄県">沖縄県</option>
</select>
日程（フォームをクリック）
<input type="text" id="eventdate" name="eventdate" value="<?php print($_SESSION['eventdate']); ?>"/>～～<input type="text" id="eventdate2" name="eventdate2" value="<?php print($_SESSION['eventdate']); ?>"/>
<input type="submit" class="btn btn-primary"/>
</form>
</body>	
</html>

    
