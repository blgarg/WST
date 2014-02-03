<?php 
include '../settings.php';
include $config_var->WEB_ROOT.'administrator/inc/load.php';
$Session = new session();
$JDatabaseMySQL = new JDatabaseMySQL();

		
if(isset($_REQUEST['controller']) && @$_REQUEST['controller']=='DoLogin')
{

if(isset($_REQUEST['remember']) && $_REQUEST['remember'] == '1'){
		setcookie("frontcookname", $_REQUEST['user_name'], time()+60*60*24*100, "/");
        setcookie("frontcookpass", base64_encode($_REQUEST['password']), time()+60*60*24*100, "/");
		}else{
		 setcookie("frontcookname", $_REQUEST['user_name'], time()-60*60*24, "/");
         setcookie("frontcookpass", base64_encode($_REQUEST['password']), time()-60*60*24, "/");
        }
		$_POST['user_name'] = trim($_POST['user_name']);
	$user_name=htmlspecialchars($_POST['user_name'],ENT_QUOTES);
	$pass=md5($_POST['password']);
	$qry = "SELECT * FROM admin WHERE username ='$user_name' and password = '$pass' ";
	$JDatabaseMySQL->sql = $qry;
	$JDatabaseMySQL->query();
	$Rcdrs =  $JDatabaseMySQL->getNumRows();
	$Rows = $JDatabaseMySQL->getArray();
	//if username exists
	if($Rcdrs >0)
	{	
		
		if(strcmp($Rows['password'],$pass)==0)
		{   echo "yes";
			$Session->setSessionVar('admin_login',$user_name);
			$Session->setSessionVar('user_Id',$Rows['id']);
			
			$Session->setSessionId('isAdminId');
			$_SESSION['CREATED'] = time();
		}
		else{
			echo "no"; 
		}
	}else{
		echo "no"; //Invalid Login
		}
	
}
if(isset($_REQUEST['controller']) && @$_REQUEST['controller']=='DoLogOut')
{
	$Session->unsetSessionVar('admin_login');
	$Session->unsetSessionVar('isAdminId');
	session_destroy();
	@header('location:login.php?Id=logged out');
	exit();
	
}


if(isset($_REQUEST['controller']) && @$_REQUEST['controller']=='ResetPass')
{
	$Mail = new Mail();
	$user_email = htmlspecialchars($_POST['UserEmail'],ENT_QUOTES);
	$randPas = Helper::createPassword(6);
	$qry = "SELECT * FROM admin WHERE email ='$user_email' ";
	$JDatabaseMySQL->sql = $qry;
	$JDatabaseMySQL->query();
	$IsUser =  $JDatabaseMySQL->getNumRows();
	$userData = $JDatabaseMySQL->getArray();
	if($IsUser >='1')
	{ 		$qryP = "UPDATE admin  SET password='".md5($randPas)."' WHERE id=1 ";
			$JDatabaseMySQL->sql = $qryP;
			if($JDatabaseMySQL->query())
			{
				
			$message = '<p>Hello '.ucfirst($userData['user_firstname']).', </p>
								<p>Your password has been reset successfully,The new password is :&nbsp;<strong>'.$randPas.'</strong></p>
								<p>Thanks <br />HGA</p>';
				
				$Mail->to  = $user_email;
				$Mail->message =$message;
				if($Mail->send())
				{ echo "yes";}else{echo"no";}
				
			}
	}
	else{ echo "no";}
   
}

?>