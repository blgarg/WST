<?php 
//include $config_var->WEB_ROOT.'/lib/session/session.php';
include $config_var->WEB_ROOT.'/lib/mysql/mysql.php';
include $config_var->WEB_ROOT.'/lib/users/users.php';
include $config_var->WEB_ROOT.'/lib/Helper.php';
include $config_var->WEB_ROOT.'/lib/webSettings.php';
include $config_var->WEB_ROOT.'/lib/mail.php';

$dbVar = new stdClass();
$dbVar->host = $config_var->HOST_NAME;
$dbVar->user = $config_var->HOST_USER;
$dbVar->password = $config_var->HOST_PASS;
$dbVar->database = $config_var->DB_NAME;
$dbVar->prefix = $config_var->DB_PREFIX;
$dbVar = (array)$dbVar;
$mdb = new JDatabaseMySQL($dbVar);
?>
