
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
  <?php 
  include '../../settings.php';
  include '../../inc/load.php';
include '../../inc/templateVar.php';
include '../../inc/controller.php';
include $config_var->WEB_TPL_ROOT.'siteHeader.php';

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
<!--                    <div class="sign_up" style="color:#003399; font-size:20px;">You have successfully Registered on site!!! </div>                
-->                    <span class="skyblue">Enter Your Site information. </span>
                    <form name="signUp" method="post" action="user_site_sucess.php" id="site_info"/>
                    <div class="signUp_box">
                    
                    <table width="100%">
	<!--<tr>
		<td class="w70">User Name:</td>
		<td class="w80"><input type="text"   name="user_name"  value="" class="text_box_paypal required"></td>
	</tr>-->
    <tr>
		<td class="w70">First Name:</td>
		<td class="w80"><input type="text"   name="first_name"  value="" class="text_box_paypal required"></td>
	</tr>
    <tr>
		<td class="w70">Last Name:</td>
		<td class="w80"><input type="text"   name="last_name"  value="" class="text_box_paypal "></td>
	</tr>
	<tr>
		<td class="w70">Site Name:</td>
		<td class="w80"><input type="text" size="30" maxlength="32"  name="site_Name" class="text_box_paypal required" value=""></td>
	</tr>
    <tr>
		<td class="w70">Domain Name:</td>
		<td class="w80"><input type="text" size="30" maxlength="32"  name="domain_Name" class="text_box_paypal required" value=""></td>
	</tr>
	
	<tr>
		<td  class="w70">Address 1:</td>
		<td  class="w80"><input type=text size="25" maxlength="100" name="address1"  class="text_box_paypal required" value=""></td>
	</tr>
	
    <?php $theme = new theme(); $countryNames = $theme->country();
	
	 ?>
    <tr>
		<td  class="w70">Country:</td>
  
        
		<td class="w80">
					<select name="country" style="width:162px;" class="text_box_paypal required">
                    <option value="">--Select Country--</option>
                    <?php
					foreach($countryNames as $countries)
					{
					?>
					<option value="<?php echo $countries['id']; ?>"><?php echo $countries['name']; ?></option>
					<?php }?>	
					</select>
				</td>
	</tr>
	
	<tr>
		<td  class="w70">State:</td>
		<td  class="w80">
			<input type=text  size="25" maxlength="100" class="text_box_paypal required"  name="State">
		</td>
	</tr>
    <tr>
		<td  class="w70">City:</td>
		<td  class="w80"><input type=text size="25" maxlength="40" class="text_box_paypal required" name="city"  value=""></td>
	</tr>
	<tr>
		<td  class="w70">ZIP Code:</td>
		<td  class="w80"><input type="text" size="10" maxlength="7" class="text_box_paypal required" name="zip"  value=""></td>
	</tr>
	
	<tr>
		<td  class="w70">Phone Number:</td>
		<td  class="w80"><input type="text" size="4" maxlength="10" class="text_box_paypal required number" name="phone" value=""></td>
	</tr>
	
	<tr>
		
		<td colspan="2" align="right"><input type=Submit class="submit" value=Submit style="margin:10px 284px;"></td>
	</tr>
</table>
                    </div>
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