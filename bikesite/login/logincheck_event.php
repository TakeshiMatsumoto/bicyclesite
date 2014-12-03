<?php

if($_COOKIE['userName']==null)//ログインがまだならログインページへ、ログインしているならイベント作成ページへ
{
	
	header("Location:./login.php");	
}else{
	
	header("Location:../createevent/createevent.php");	
	
}



?>