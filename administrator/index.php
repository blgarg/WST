<?php
 
ob_start();
include '../settings.php';
include $config_var->WEB_ROOT.'administrator/inc/load.php';
$Session = new session();
$isLogin = $Session->getSessionVar('isAdminId');
if($isLogin == NULL){ @header('location:login.php');}
global $config_var;
include $config_var->WEB_ROOT.'administrator/inc/controller.php';
include $config_var->ADMIN_ROOT.'mod/'.$theme_mod."/".'model/'.$mod_path[1]."_".$mod_view.".php";
include $config_var->ADMIN_ROOT.'mod/'.$theme_mod."/".'controller/'.$mod_path[1].".php";
include $config_var->ADMIN_ROOT.'mod/'.$theme_mod."/"."controller.php";
include $config_var->ADMIN_ROOT.'mod/'.$theme_mod."/".'lang/'."lang.php";
include $config_var->ADMIN_ROOT.'mod/'.$theme_mod."/"."toobar.php";
include $config_var->ADMIN_ROOT.'mod/'.$theme_mod."/js/"."js.php";
$renderUrl = $config_var->ADMIN_ROOT.'mod/'.$theme_mod."/".'view/'.$mod_path[1]."_".$mod_view.".php";
$jsPath = $config_var->ADMIN_URL.'mod/'.$theme_mod."/js/";
$common_js = $config_var->WEB_URL.jsApp."/common.js";
if(isset($mod_path[1]))
{ 	
	
	$modleClassName = 'model_'.$mod_path[1].'_'.$mod_view;
	$controllerClassName = $mod_path[1]."_"."controller";
	$toolBarClassName = $mod_path[1]."_"."toolbar";
	$model =  new $modleClassName($dbVar);
	$toolBar = new $toolBarClassName();
	
	}
		
$model->initialize();
$DataSet = $model->getvarp();
//$Controller = new $controllerClassName();
//die('dfsdfd');
ob_clean();

include 'theme.php';
//echo $template_file ;
?>
