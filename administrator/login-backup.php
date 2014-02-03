<?Php 
include '../settings.php';
include $config_var->WEB_ROOT.'administrator/inc/load.php';
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
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>HGA</title>
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
</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
		
		<h1><a href="<?php echo $config_var->ADMIN_URL;?>" style="color:#FFFFFF;line-height:36px;">Ha<font color="#FF3300">r</font>tron</a></h1>
	  
  </div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
   <div id="login-inner">
   
		<form method="post" action="login_logout.php" id="login_form" autocomplete="off">
        <table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Username</th>
			<td><input name="username" type="text" id="username" value="<?php echo $email; ?>"  class="login-inp" maxlength="18" /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input name="password" type="password" value="<?php echo $password; ?>" id="password" onfocus="this.value=''" class="login-inp"  maxlength="18"/></td>
		</tr>
		<tr>
			<th></th>
			<td valign="top"><input type="checkbox" name="remember" <?php if(isset($checked) && $checked=='1') { echo 'checked="checked"'; }?> class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
		</tr>
		<tr>
			<th></th>
			<td><input  type="submit" name="Submit" id="submit" value="Login" class="submit-login"  /><span id="msgbox" style="display:none"></span></td>
		</tr>
        <tr>
			
			<td align="left" colspan="2" id="msgbox"></td>
		</tr>
		</table>
        </form>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<a href="" class="forgot-pwd">Forgot Password?</a>
 </div>
 <!--  end loginbox -->
 
	<!--  start forgotbox ................................................................................... -->
	<div id="forgotbox">
		<div id="forgotbox-text">Please enter your email to reset your password.</div>
		<!--  start forgot-inner -->
		<div id="forgot-inner">
        <form method="post" action="login_logout.php" id="forget_password_form" autocomplete="off">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Email address:</th>
			<td><input type="text" value=""   class="login-inp" id="UserEmail"  /></td>
		</tr>
		<tr>
			<th> </th>
			<td><input type="submit"  id="forget-password" value="Send" class="submit-login"  /><span id="messa" style="display:none"></span></td>
		</tr>
		</table>
        </form>
		</div>
		<!--  end forgot-inner -->
		<div class="clear"></div>
		<a href="" class="back-login">Back to login</a>
	</div>
	<!--  end forgotbox -->

</div>
<!-- End: login-holder -->
</body>
</html>