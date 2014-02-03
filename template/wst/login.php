<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print($site->siteData[0]['websitename']);?></title>
<link rel="stylesheet" type="text/css" href="<?php echo  $config_var->WEB_TPL_URL; ?>css/style.css"/>
</head>
<script src="<?php echo  $config_var->WEB_TPL_URL; ?>js/jquery-latest.js"></script>
  <script type="text/javascript" src="<?php echo  $config_var->WEB_TPL_URL; ?>js/jquery.validate.js"></script>
<style type="text/css">
* { font-family: Verdana; font-size: 96%; }
label { width: 10em; float: left; }
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>
  <script>
  $(document).ready(function(){
    $("#site_info").validate();
  });
  </script>
  

<body>
<div id="wrapper">
	<div class="maindiv">
   	 	<div class="container">        
        <!--hearder START-->
            <div class="header">
            	<div class="logo">
             		<a href="javascript:;">ChiroPro Magazine</a>
            	</div>
                <div class="fr">
                	<ul class="top_nav fr"> 
                     <li><a href="javascript:;">Log in</a></li>
                       <li>|</li>
                      <li><a href="javascript:;">Sign Up</a></li>
                    </ul>
                    <div class="clear fr"><input type="text" class="search fl" /> <input type="text" class="S_btn fl" /></div>
                </div>
            </div>            
        <!--hearder END-->
        <!--main MENU START-->
         <div class="clear menu">               
       	   <ul class="main_menu"> 
                <li><a href="javascript:;"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/home_icon.gif" border="0" alt="#" /></a></li>
                         <li><a href="javascript:;">Features</a></li>                     
                         <li><a href="javascript:;"> Who Else Using the ChiroPro Magazine</a></li>
                         <li><a href="javascript:;">Pricing </a></li>
                         <li><a href="javascript:;">Join Now</a></li>
                         <li><a href="javascript:;">F.A.Q</a></li>
           </ul>
           <div class="clear"></div>  
         </div>
        <!--main MENU END-->
        <!--Header Banner  START-->
         
        <!--Header Banner END-->
         <!--Content Container-->
<div class="content_container"> 
         	<div class="content_innner">
                <!--Content left contariner-->
                <div class="left_content fl">
                                   
                    
                    
               
                <!--SIGNUP START-->
                   <div class="signUp pB20">
                    <div class="sign_up">Please Login here!!!!!!</div>                
                    
                    <form method="post" action="login_logout.php" id="login_form" autocomplete="off">
                    <div class="signUp_box">
        <table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Username</th>
			<td><input name="username" type="text" id="username"  class="login-inp" maxlength="18" /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input name="password" type="password" id="password" onfocus="this.value=''" class="login-inp"  maxlength="18"/></td>
		</tr>
		<tr>
			<th></th>
			<td valign="top"><input type="checkbox" class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
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
                     <div class="clear"></div>  
                   </div>
                <!--SIGNUP END-->
                </div>  
<!--Left Contariner END-->
                <!--RIGHT Contariner START-->
               	<?php if(function_exists('get_RightSideBar')) get_RightSideBar();?>	
                <!--RIGHT Contariner END-->
               </div> 
             <div class="clear"></div>  
         </div>
    	</div>
    </div>
</div>
 <!--FOOTER Contariner START-->
<div class="footer">
<div class="footer_inner">

<div class="left_content fl">
	<ul class="footer_menu"> 
          <li><a href="javascript:;">Features</a></li>                     
          <li><a href="javascript:;"> Who Else Using the ChiroPro Magazine</a></li>
          <li><a href="javascript:;">Pricing </a></li>
          <li><a href="javascript:;">Join Now</a></li>
           <li><a href="javascript:;">F.A.Q</a></li>
    </ul>
</div>
<div class="right_con fr" align="center">
 <a class="fl" style="line-height:25px; display:inline-block;">FolloW Us On:</a> <a href="javascript:;"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/tw_icon.jpg"  border="0" alt="twitter" /></a> <a href="javascript:;"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/fb_icon.jpg" alt="Facebook"  border="0" /></a>
</div>
<p align="center" class="clear pT10">Copyright © 2011 ChiroPro Magazine. All rights reserved</p>
</div>
 <!--FOOTER Contariner START-->
</div>
</body>
</html>
<?php
/*include '../../settings.php';
mysql_connect($config_var->HOST_NAME, $config_var->HOST_USER,$config_var->HOST_PASS) or die(mysql_error());
mysql_select_db($config_var->DB_NAME) or die(mysql_error());
 $email = $_REQUEST['email'];
 $password= $_REQUEST['password'];
 $qry = "SELECT * FROM mgl_users WHERE user_email ='".$email."' and password   = '".md5($password)."' and is_active  = '1'"; 
 
 $row= mysql_query($qry)
or die(mysql_error()); 

$data = mysql_fetch_array($row); 
if($data[0]!='')
{

echo'<script>window.location.href = "'.$config_var->WEB_URL.'?userId='.$data[user_id].'"</script>';
}
else
{
  
  echo'<script>window.location.href = "../log.php"?error="error"; </script>';
}

if(isset($_REQUEST['activationKey']))
{
   $sql= "UPDATE  mgl_users  SET is_active=1 WHERE user_activation_key ='".$_REQUEST['activationKey']."'";
   $row= mysql_query($sql)
or die(mysql_error());
}*/
?>