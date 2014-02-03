<?php
class joinus_controller extends JDatabaseMySQL
{
var $modName  = '';
	   function runController(){
	   global $config_var;
	    switch(@$_REQUEST['controller'])
		  {
			case 'insertUser':
				$model_joinus_signup = new model_joinus_signup();
				$email = @mysql_real_escape_string(stripslashes($_REQUEST['emailid']));
				if($model_joinus_signup->emailExist($email))
				{
					switch($_SESSION['price']){
						case '19.95' :
							$join = "1" ;
						break;
						case '39.95' :
							$join = "2" ;
						break;
						case '59.95' :
							$join = "3" ;
						break;
						case 'default' :
						break;
						}
					$_SESSION['error'] = "Email already exists";
					$_SESSION['details'] = $_REQUEST ;
					@header('Location:index.php?mod=mod_joinus&view=signup&join='.$join.'&s=6');
					die;
				}
				$insertUser = $model_joinus_signup->insertUser();
				
			break;
		  }
	   }
}
