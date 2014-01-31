<?php
require_once('settings.php');
$_SESSION['user_id']="";
unset($_SESSION);
session_destroy();
header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5");
?>