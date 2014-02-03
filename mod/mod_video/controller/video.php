<?php
class video_controller{	

	  var $modName  = '';
	  
	  function runController(){
		if(!isset($_SESSION['user_id']) || $_SESSION['user_id']=="")
			{
				header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5");
			}	
		 switch(@$_REQUEST['controller'])
		  {
				case 'doLogOut':
				$session = new session();
				$config = new config();
				if($session ->destroySession())
				{@header('Location:'.$config->WEB_URL);}else{@header('Location:'.$config->WEB_URL);}
				break; 
			}		
	  
	  
	  }
}

?>