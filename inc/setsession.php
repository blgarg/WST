<?php
session_start();
if(isset($_REQUEST['en']))
{
	$_SESSION['en']='en';
	$url_path=$_SERVER['HTTP_REFERER'];
 echo "<script>document.location.href='".$url_path."';</script>";	
	}
else if(isset($_REQUEST['hin']))	
{
unset($_SESSION['en']);	
$url_path=$_SERVER['HTTP_REFERER'];
 echo "<script>document.location.href='".$url_path."';</script>";	
	}
?>
