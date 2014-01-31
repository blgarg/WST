<?php
session_start();
if(isset($_REQUEST['selectlanguage']))
{
	if($_REQUEST['selectlanguage']==2)
	{
	$prev_url="http://".$_SERVER['HTTP_HOST'].$_REQUEST['prev_url'];
		$_SESSION['en']='en';
	 echo "<script>document.location.href='".$prev_url."';</script>";	
		}
		else
		{
		$prev_url="http://".$_SERVER['HTTP_HOST'].$_REQUEST['prev_url'];
		unset($_SESSION['en']);
	 echo "<script>document.location.href='".$prev_url."';</script>";	
		}
}
?>
