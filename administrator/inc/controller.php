<?php
$theme_mod = isset($_GET['mod'])?$_GET['mod']:'mod_dashboard';
$mod_view = isset($_GET['view'])?$_GET['view']:'default';
// file to be included 
$mod_path = explode("_",$theme_mod);
$template_file  =  $config_var->ADMIN_ROOT.'mod/'.$theme_mod."/".$mod_path[1].".php"; // modlule absolute path
$theme_vars = new stdClass(); // stores the temparory objetcs vars
$theme_vars->theme_mod_url = $template_file; // initialization of statnadard class vitual members 
$themeClass = new getTheme();                //controller class instance    
$themeClass->setThemeVar($theme_vars);		 //Module path initialization to the controller class

// classs controll the module section of the admin panel
class getTheme
{		    var $_theme_mod_url = '';
			
			function __construct(){}
			 
			function setThemeVar($vars)
			{	
				$this->_theme_mod_url = $vars->theme_mod_url;							
											}
			
			function getThemeModule(){		
			    include $this->_theme_mod_url;							
										}	
}
?>
