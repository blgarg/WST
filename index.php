<?php 
ob_start();
ini_set('include_path',ini_get('include_path').':/WST/lib/library:'); 
ini_get('include_path');

include 'settings.php';

global $config_var;
include $config_var->WEB_ROOT.'inc/load.php';
//$Session = new session();

//$config_var->WEB_ROOT.'inc/controller.php';
include $config_var->WEB_ROOT.'inc/controller.php';
$jsPath = $config_var->WEB_URL.'mod/'.$theme_mod."/js/";
include $config_var->WEB_ROOT.'mod/'.$theme_mod."/".'model/'.$mod_path[1]."_".$mod_view.".php";
include $config_var->WEB_ROOT.'mod/'.$theme_mod."/".'controller/'.$mod_path[1].".php";
include $config_var->WEB_ROOT.'mod/'.$theme_mod."/"."controller.php";
//include $config_var->WEB_ROOT.'mod/'.$theme_mod."/".'lang/'."lang.php";

$renderUrl = $config_var->WEB_ROOT.'mod/'.$theme_mod."/".'view/'.$mod_path[1]."_".$mod_view.".php";

$common_js = $config_var->WEB_URL."jsApp/common.js";
$mod_path[1]; 

if(isset($mod_path[1]))
{  	 

     $modleClassName = 'model_'.$mod_path[1].'_'.$mod_view;
     $controllerClassName = $mod_path[1]."_"."controller";
	
	 //$toolBarClassName = $mod_path[1]."_"."toolbar";
	 $model =  new $modleClassName($dbVar);
	 
	//$toolBar = new $toolBarClassName();
	}
$model->initialize();
$DataSet = $model->getvarp();
$Controller = new $controllerClassName();

ob_clean();

include 'theme.php';

 //$template_file ;

?>
