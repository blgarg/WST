<script type="text/javascript">
function valid(){
if($('.server_error')){
$('.server_error').hide();
$('.server_succ').hide();
}
}
</script>
<?php
global $config_var;
if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')
{
	header("Location:".$config_var->WEB_URL."?mod=mod_index&view=tour&form=agree&s=1");
}
$model_index_login = new model_index_login();
?>
<!--Content Text-->
<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/members-login-txt.png" alt="" />
        </div>
    	<div class="content-txt">
        	<form method="post" action="?mod=mod_index&view=login&s=5" id="login">
			<input type="hidden" id="controller" name="controller" value="login" />
			<div class="login-outer">
                 <table width="100%" border="0" cellspacing="0" cellpadding="10">
                 <tr><td colspan="2" align="center" >
				<?php if(isset($_SESSION['succ']) && $_SESSION['succ']!=""){?>
					<span class="server_succ"><?php echo $_SESSION['succ'];?></span>
				<?php $_SESSION['succ']="";unset($_SESSION['succ']);}
				else if(isset($_SESSION['error']) && $_SESSION['error']!=""){?>
				<span class="server_error"><?php echo @$_SESSION['error'];?></span>
				<?php $_SESSION['error']="";unset($_SESSION['error']);} ?>
                  </td></tr>

				  <tr>
                    <td width="390" align="right">Email ID <span style="color:red;">*</span>:</td>
                    <td><input type="text" name="email" onfocus="valid();" value="<?php echo @$_COOKIE['useremail'];?>"/></td>
                  </tr>
                 <tr>
                    <td width="390" align="right">Password <span style="color:red;">*</span>:</td>
                    <td><input type="password" name="password" onfocus="valid();" value="<?php echo @$_COOKIE['userpass'];?>" /></td>
                  </tr>
                   <tr>
                    <td width="390" align="right">&nbsp;</td>
                    <td><input type="checkbox" name="remember" id="remember" 
					<?php if($_COOKIE['useremail']!="" && $_COOKIE['userpass']!=""){ ?>
					checked="checkted"
					<?php }else { ?>
					
					<?php }?> /> Remember me</td>
                  </tr>
                   <tr>
                    <td width="390" align="right">&nbsp;</td>
					
                    <td><img src="securimage_show.php" alt="" /></td>
					
                  </tr>
                   <tr>
                    <td width="390" align="right">Enter the secret word shown in the image <span style="color:red;">*</span>:</td>
                    <td><input type="text" value="" onfocus="valid();" id="captcha_code" name="captcha_code" />
						
					</td>
                  </tr>
                   <tr>
                    <td width="390" align="right">&nbsp;</td>
                    <td><input type="submit" value="Login" class="grey-btn" title="Login"/>
					<a href="<?php echo $config_var->WEB_URL ;?>?mod=mod_index&view=forgot&s=5">Forgot Password</a>
					</td>
                  </tr>
			<tr>
				  <td colspan="2" align="center" >
<!--<div  style=" text-align: center; color: #3B3B3B; font-size: 19px;font-weight: bold;">For billing support</div>-->
  <div style=" text-align: center; color: #6F7777; font-size: 17px;font-weight: bold;">
For billing support please visit 
<a style="color:background !important;" target="_blank" href="http://www.epoch.com">EPOCH.COM</a>
, our authorized sales agent. One and or three month memberships re-bill at their initial price either monthly or every 3 months respectively if not canceled.
</div>
 </td>
				  </tr>
				  <tr>
                    <td colspan="2" align="center">
                    	  IP address and access time recorded for security purposes. <br />
Unauthorized access attempts will be emailed to your service provider for immediate suspension and cancellation. 
                    </td>
                  </tr>
                </table>
                
            </div>
			</form>
        </div>
        <!--//Content Text-->
	 </div>
     <!--//ConTent-->
	
<div class="clr"></div>    
</div>