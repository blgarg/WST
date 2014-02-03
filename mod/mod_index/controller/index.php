<?php
//global $config_var;

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : 'phpBB3/';

$phpEx = substr(strrchr(__FILE__, '.'), 1);
require_once($phpbb_root_path . 'common.' . $phpEx);
require_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
require_once($phpbb_root_path . 'includes/functions_module.' . $phpEx);

include_once 'securimage.php';

class index_controller extends JDatabaseMySQL
{
var $modName  = '';
	   function runController(){
	   global $config_var;
	   global $user;
	   global $auth;
	   $securimage = new Securimage();
	   switch(@$_REQUEST['controller'])
		  {	
				case 'forgot':
					$model_index_forgot = new model_index_forgot();
					$checkemail = $model_index_forgot->checkEmail(@$_REQUEST['email']);
				break;
				case 'resetpass':
					$model_index_resetpass = new model_index_resetpass();
					$resetpass = $model_index_resetpass->resetPass();
				break;
				case 'contactus':
				$model_contact = new model_index_contactus();
				$model_contact->sendMail();
				case 'login':
					$config_var->title="Login";
					
					if(isset($_REQUEST['remember']) && $_REQUEST['remember']!=""){
						setcookie('useremail', $_REQUEST['email'], time()+60*60*24*365);
						setcookie('userpass', $_REQUEST['password'], time()+60*60*24*365);
					}else{
						setcookie('useremail', $_REQUEST['email'], time()-60*60*24*365);
						setcookie('userpass', $_REQUEST['password'], time()-60*60*24*365);
					}
					if ($securimage->check($_REQUEST['captcha_code']) == false) {
                    $_SESSION['error'] = "Secret code doesn't match with image code.";
						header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5"); die;
					}
                    else{
						$model_index_login = new model_index_login();
						$userlogin = $model_index_login->userLogin($_REQUEST['email'],$_REQUEST['password']);
						$user_pay_status = $model_index_login->userPaymentStatus($userlogin[0]['id']);
					if(count($userlogin)!=1){
							$_SESSION['error'] = "Please enter valid Email ID and Password";
							header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5"); die;
						}else if($user_pay_status[0]['payment_status'] == 'pending' || $user_pay_status[0]['payment_status'] ==""){
							$_SESSION['error'] = "Your payment is pending.";
							header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5"); die;
						}
						else if($userlogin[0]['status']==0 || $userlogin[0]['status']=="")
						{
							$_SESSION['error'] = "Your account has been deactivated";
							header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5"); die;
						}
						else{
							//$_SESSION['succ'] = "successfully login.";
							$_SESSION['user_id'] = $userlogin[0]['id'];
							/*$username = explode('@',$_REQUEST['email']);
							define('IN_LOGIN', true);
							$user->session_begin();
							$auth->acl($user->data);
							$user->setup('ucp');
							$result = $auth->login($username[0], $_REQUEST['password'], $autologin=0, 1, 0);
							if ($result['status'] == LOGIN_SUCCESS) {
								//echo "You're logged in";die;
							} else {

							  echo $user->lang[$result['error_msg']];
							  die;

							}*/
							
							header("Location:".$config_var->WEB_URL."?mod=mod_index&view=home&form=agree&s=1"); die;
							}
							
						}
				break;
		}
	 }
	  
	  function unlink_function($id){
		
		$this->sql ='SELECT imagehdpi,imageshdpi,imageldpi,imagemdpi,imagexhdpi FROM mgl_models WHERE cat_id= "'.$id.'" ';
			$this->query();
			return $this->loadAssoc();
		}
	  function chklogin()
	  {
		if(!isset($_SESSION['user_id']) && $_SESSION['user_id']="")
		{
			header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5");
		}
	  }
  
	  
}
