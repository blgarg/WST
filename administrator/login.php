<?Php 
ob_start();
include '../settings.php';
include $config_var->WEB_ROOT.'administrator/inc/load.php';

$Session = new session();
$isLogin = $Session->getSessionVar('isAdminId');
if($isLogin != NULL){ @header('location:./?mod=mod_dashboard&d=1');}
?>
<?php
	   $email='';
	   $password='';
	   $checked='';
	   if(isset($_COOKIE['frontcookname'])){
	   $email = $_COOKIE['frontcookname'];
	   $password = base64_decode($_COOKIE['frontcookpass']);
	   $checked=1;
	   }
/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WST</title>
<link rel="shortcut icon" href="./template/system/images/favicon.ico">
<link rel="stylesheet" href="<?php echo $config_var->ADMIN_TPL_URL;?>css/screen.css" type="text/css" media="screen" title="default" />
<!--  jquery core -->
<script src="<?php echo $config_var->ADMIN_TPL_URL;?>js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!-- Custom jquery scripts -->
<script src="<?php echo $config_var->ADMIN_TPL_URL;?>js/jquery/custom_jquery.js" type="text/javascript"></script>
<script src="<?php echo $config_var->ADMIN_URL;?>jsAjax/AdminLoginAjax.js" type="text/javascript"></script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="<?php echo $config_var->ADMIN_TPL_URL;?>js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
  <script type="text/javascript">
  function change_language(value){
  document.yourlanguage.selectlanguage.value=value;
  document.yourlanguage.submit();  
  }
  </script>
</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
		
		<h1><a id="hgalogin" href="<?php echo $config_var->ADMIN_URL;?>" style="color:#FFFFFF;line-height:36px;">WST</a><a id="forgotpwd" href="<?php echo $config_var->ADMIN_URL;?>" style="color:#FFFFFF;line-height:36px;"><?php echo "Forgot Password";?></a></h1>
	  
  </div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
		<span id="messa1" class="messageboxok" style="opacity: 1;display:none;"></span>
	<!--  start login-inner -->
   <div id="login-inner" style="width:336px;">
   
		<form method="post" action="login_logout.php" id="login_form" autocomplete="off">
        <table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th style="width:110px;"><?php echo Username?></th>
			<td><input name="username" type="text" id="username" value="<?php echo $email; ?>"  class="login-inp" maxlength="50" /></td>
		</tr>
		<tr>
			<th><?php echo Password;?></th>
			<td><input name="password" type="password" value="<?php echo $password; ?>" id="password" onfocus="this.value=''" class="login-inp"  maxlength="18"/>
				<input type="hidden" name="controller" value="DoLogin">
			</td>
		</tr>
		<tr>
			<th></th>
			<td valign="top"><input type="checkbox" name="remember" <?php if(isset($checked) && $checked=='1') { echo 'checked="checked"'; }?> class="checkbox-size" id="login-check" /><label for="login-check"><?php echo "Remember me";?></label></td>
		</tr>
		<tr>
			<th></th>
			<td><input  type="submit" name="Submit" id="submit" value="<?php echo LOGIN;?>" class="submit-login"  /><span id="msgbox" style="display:none"></span></td>
		</tr>
        <tr>
			
			<td align="left" colspan="2" id="msgbox"></td>
		</tr>
		</table>
        </form>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<a href="login_logout.php?do=forgot" class="forgot-pwd"><?php echo "Forgot Password";?>?</a>
     </div>
 
 <!--  end loginbox -->
	
	<!--  start forgotbox ................................................................................... -->
	<div id="forgotbox">
		<div id="forgotbox-text"><?php echo "Please enter registered Email ID";?>.</div>
		<!--  start forgot-inner -->
		<div id="forgot-inner">
        <form method="post" action="login_logout.php" id="forget_password_form" autocomplete="off">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo "Email ID";?>:</th>
			<td><input type="text" value=""   class="login-inp" id="UserEmail"  /></td>
		</tr>
		<tr>
			<th> </th>
			<td><input type="submit"  id="forget-password" value="<?php echo SEND;?>" class="submit-login"  /><span id="messa" style="display:none"></span></td>
		</tr>
		</table>
        </form>
		</div>
		<!--  end forgot-inner -->
		<div class="clear"></div>
		<a href="" class="back-login"><?php echo "Back to login";?></a>
	</div>
	<!--  end forgotbox -->

</div>
<!-- End: login-holder -->
</body>
</html>