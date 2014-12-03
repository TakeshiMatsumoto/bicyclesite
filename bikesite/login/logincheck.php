<?php

if($_COOKIE['userName']==null)
{
	
	header("Location:./login.php");	
}else{
	
	header("Location:../createevent/createevent.php");	
	
}



?>