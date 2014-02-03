<?php 
class themeSettings extends JDatabaseMySQL{

function callThemeFunction(){
 	$config_var = new config();
	
	if(!file_exists($config_var->WEB_TPL_ROOT.'functions.php')){
	echo "<script>alert('function.php does not exist in theme folder');</script>";
	}else{
	include $config_var->WEB_TPL_ROOT.'functions.php';
	}
 }

function siteHeader(){
 	$config_var = new config();
	if(!file_exists($config_var->WEB_TPL_ROOT.'siteHeader.php')){
	echo "<script>alert('siteHeader.php does not exist in theme folder');</script>";
	}else{
	include $config_var->WEB_TPL_ROOT.'siteHeader.php';
	}
 }

function get_bookLists(){
 $config_var = new config();
 if(!file_exists($config_var->WEB_TPL_ROOT.'booklist.php')){
	echo "<script>alert('boolist.php does not exist in theme folder');</script>";
	}else{
	include $config_var->WEB_TPL_ROOT.'booklist.php';
	}
 
}
function get_writerLists(){
 $config_var = new config();
 if(!file_exists($config_var->WEB_TPL_ROOT.'writerlist.php')){
	echo "<script>alert('writerlist.php does not exist in theme folder');</script>";
	}else{
	include $config_var->WEB_TPL_ROOT.'writerlist.php';
	}
 
}

function get_siteFooter(){
 	$config_var = new config();
	if(!file_exists($config_var->WEB_TPL_ROOT.'siteFooter.php')){
	echo "<script>alert('siteFooter.php does not exist in theme folder');</script>";
	}else{
	include $config_var->WEB_TPL_ROOT.'siteFooter.php';
	}
 }
 
}
$themeSettings = new themeSettings();
$themeSettings->callThemeFunction();

function siteHeader(){
global $themeSettings;
$themeSettings->siteHeader();
}
function get_writerlists()
{
global $themeSettings;
$themeSettings->get_writerLists();
}
function get_bookLists(){
global $themeSettings;
$themeSettings->get_bookLists();
}

function get_siteFooter(){
global $themeSettings;
$themeSettings->get_siteFooter();
}




?>
