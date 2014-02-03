<?php
ini_set('include_path', '/inc');



  include '../../settings.php';
  include '../../inc/load.php';
include '../../inc/templateVar.php';
include '../../inc/controller.php';
include $config_var->WEB_TPL_ROOT.'siteHeader.php';
session_start();

mysql_connect($config_var->HOST_NAME, $config_var->HOST_USER,$config_var->HOST_PASS) or die(mysql_error());
mysql_select_db($config_var->DB_NAME) or die(mysql_error());

$site_name= @$_REQUEST['site_Name'];
$domain_name= @$_REQUEST['domain_Name'];
$first_name= @$_REQUEST['first_name'];
$last_name= @$_REQUEST['last_name'];
$user_name= @$_REQUEST['user_name'];
$address1= @$_REQUEST['address1'];
$address2= @$_REQUEST['address2'];
$country= @$_REQUEST['country'];
$State= @$_REQUEST['State'];
$city= @$_REQUEST['city'];
$phone= @$_REQUEST['phone'];
$zip= @$_REQUEST['zip'];
$activationKey=  mt_rand() . mt_rand() . mt_rand();
$Uid= @$_SESSION['new_user_address'];


$new_user_id = @$_SESSION['new_user_address'];

 $sql = "UPDATE mgl_users  SET `user_firstname`= '".$_REQUEST[first_name]."',`user_lastname`= '".$_REQUEST[last_name]."' ,`user_address`= '".$_REQUEST[address1]."' ,`country`= '".$_REQUEST[country]."' ,`stateText`= '".$_REQUEST[State]."' ,`user_phonenum`= '".$_REQUEST[phone]."',`user_role`= 'user', `user_activation_key`= '".$activationKey. "', `site_name`= '$site_name', `site_domain`= '$domain_name'
  WHERE `user_id` in(".$Uid.") "; 
mysql_query($sql)
or die(mysql_error());  

$userEmail = @$_SESSION['new_user_email'];

$to= $userEmail;
$subject = "Activate site Automated Blog";

$message = "
<html>
<head>
<title>User Site Activation</title>
</head>
<body>
<p>Hi,</p>
<p></p>
<p>
Thanks For Registersation
You have successfully registered on site Automated Blog
</p>
<p>
Please click following url for activate your site
<a href='".$config_var->WEB_URL."users/login.php?activationKey=".$activationKey."&userId=".$new_user_id."'>".$config_var->WEB_URL."AutomatedBog/".$domain_name."</a>
</p>
<p>
Your site url is <b/>
<a href='".$config_var->WEB_URL."?userblog=".$domain_name."'>".$config_var->WEB_URL."AutomatedBog/".$domain_name."</a>
</p>
<p>
Thanks,<br/>
Automated Blog
</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";


$headers .= 'From: <automated@blog.com>' . "\r\n";

if(mail($to,$subject,$message,$headers)){  }

?>

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
                    <div class="sign_up">Your site is successfully created.!!!!!!!! </div>                
                    <span class="skyblue">Please check your mail for activation your account. </span>
                    
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
<?php if(function_exists('get_siteFooter')) get_siteFooter(); ?>
</div>
</body>
</html>