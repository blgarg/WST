<?php

class partygirls_controller extends JDatabaseMySQL
{
var $modName  = '';
	   function runController(){
	   global $config_var;
		if(!isset($_SESSION['user_id']) || $_SESSION['user_id']=="")
			{
				header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5");
			}
	   }
	   
}
