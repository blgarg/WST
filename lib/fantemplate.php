<?php 
 include '../settings.php';
 require_once('session/session.php');
 require_once('Helper.php');
 require_once('users/fan_db.php');
 global $config_var;  

$action_will_perform = isset($_REQUEST['action'])?$_REQUEST['action']:'edit_user';
if($action_will_perform):
	switch($action_will_perform){
	case'edit_user':
		include $config_var->WEB_ROOT.'lib/html/'.$action_will_perform.".php";
	break;
	case'changepass':
		include $config_var->WEB_ROOT.'lib/html/'.$action_will_perform.".php";
	break;
	case'chageProfilePic':
		include $config_var->WEB_ROOT.'lib/html/'.$action_will_perform.".php";
	break;
	case'artist_default':
		include $config_var->WEB_ROOT.'lib/html/'.$action_will_perform.".php";
	break;
	case'fan_default':
		include $config_var->WEB_ROOT.'lib/html/'.$action_will_perform.".php";
	break;
	}
endif;
?>