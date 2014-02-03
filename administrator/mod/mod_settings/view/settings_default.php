<?php 
global $config_var;  
global $DataSet;


$model_settings_default = new model_settings_default();
$Pages=$model_settings_default->getPageData();
$wesiteName=$logoText=$emailSubject=$emailAddress=$contactNumber=$footerText=$logoImage=$display=$displayLogo='';  
$displayCancel='style="display:none;"';  
$TitleText='Logo Image :';
if(isset($Pages['logotext'])){
$logoText=$Pages['logotext'];
}if(isset($Pages['websitename'])){
$wesiteName=$Pages['websitename'];
}if(isset($Pages['emailsubject'])){
$emailSubject=$Pages['emailsubject'];
}if(isset($Pages['emailaddress'])){
$emailAddress=$Pages['emailaddress'];
}if(isset($Pages['contactnumber'])){
$contactNumber=$Pages['contactnumber'];
}if(isset($Pages['footertext'])){
$footerText=$Pages['footertext'];
}if(isset($Pages['displayLogo'])){
$displayLogo=$Pages['displayLogo'];
}
if(isset($Pages['billheading'])){
$billheading=$Pages['billheading'];
}
if(isset($Pages['billaddress'])){
$billaddress=$Pages['billaddress'];
}

if(isset($Pages['logotext_en'])){
$logotext_en=$Pages['logotext_en'];
}
if(isset($Pages['billaddressenglish'])){
$billaddressenglish=$Pages['billaddressenglish'];
}
if(isset($Pages['billheadingenglish'])){
$billheadingenglish=$Pages['billheadingenglish'];
}
if(isset($Pages['logoimage']) && trim($Pages['logoimage']) !=''){
$logoImage=$Pages['logoimage'];
$display='style="display:none;"';
$TitleText='&nbsp;';
$displayCancel='';

}
?>
<script src="<?php $config_var->ADMIN_ROOT;?>mod/mod_settings/js/validateForms.js" type="text/javascript"></script>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_settings&view=default&d=4" method="post" id="adddPageFrm" name="adddSettingtFrm" enctype="multipart/form-data" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td width="78%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th valign="top" style="width:150px;"><?php echo WEBSITENAME;?><span class="red">*</span> :</th>
                <td><input type="text"  name="website_name"  id="website_name" maxlength="70" class="textbox" value="<?php echo $wesiteName; ?>"/></td>
            </tr>
          
            <tr>
                <th valign="top"><?php echo ADMINLOGOTEXTINHINDI;?><span class="red">*</span> :</th>
                <td><input type="text"  name="logo_text"  id="logo_text" maxlength="70" class="textbox" value="<?php echo $logoText; ?>"/></td>
            </tr>
            <tr>
                <th valign="top"><?php echo ADMINLOGOTEXTINENGLISH;?><span class="red">*</span> :</th>
                <td><input type="text"  name="logo_text2"  id="logo_text2" maxlength="70" class="textbox" value="<?php echo $logotext_en; ?>"/></td>
            </tr>
          <?php /* if($logoImage!=''){ ?>
           <tr>
            <th valign="top">Front End Logo Image :</th>
            <td><img src="<?php echo $config_var->UPLOAD_URL.'logo/thumb_'.$logoImage;?>" alt="logo image" /> &nbsp;<a href="#" id="showchangeLink" onclick="showUploader()">Change Logo</a></td>
           </tr>
           <?php } */?>
           
            <tr <?php echo $display; ?>  id="imageuploader">
            <th valign="top"><?php echo $TitleText; ?> </th>
            <td><input type="file" name="logo_image" id="logo_image" /> <a href="#" onclick="hideUploader()" <?php echo $displayCancel; ?> >Cancel</a></td>
           </tr>
        
          <tr>
            <th valign="top"><?php echo EMAILSUBJECT;?><span class="red">*</span> :</th>
            <td><input type="text"  name="email_subject"  id="email_subject" maxlength="70" class="textbox" value="<?php echo $emailSubject; ?>"/></td>
          </tr>
          
                 
         <tr>
            <th valign="top"><?php echo EMAILADDRESS;?><span class="red">*</span> :</th>
            <td><input type="text"  name="email_address"  id="email_address" maxlength="70" class="textbox" value="<?php echo $emailAddress; ?>"/></td>
          </tr>
          
          <tr>
            <th valign="top"><?php echo CONTACTNUMBER;?> <span class="red">*</span> :</th>
            <td><input type="text"  name="contact_number"  id="contact_number" maxlength="70" class="textbox" value="<?php echo $contactNumber; ?>"/></td>
          </tr>
          
           <tr>
            <th valign="top"><?php echo FOOTERTEXT2;?><span class="red">*</span> :</th>
            <td><input type="text"  name="footer_text"  id="footer_text" maxlength="70" class="textbox" value="<?php echo $footerText; ?>"/></td>
          </tr>
          
          <tr>
            <th valign="top"><?php echo BILLHEADINGINHINDI;?><span class="red">*</span> :</th>
            <td><input type="text"  name="billheading"  id="billheading" maxlength="70" class="textbox" value="<?php echo $billheading; ?>"/></td>
          </tr>
          
          <tr>
            <th valign="top"><?php echo BILLHEADINGINENGLISH;?><span class="red">*</span> :</th>
            <td><input type="text"  name="billheadingenglish"  id="billheadingenglish" maxlength="70" class="textbox" value="<?php echo $billheadingenglish; ?>"/></td>
          </tr>
          
          <tr>
            <th valign="top"><?php echo ADDRESSINHINDI;?><span class="red">*</span> :</th>
            <td><input type="text"  name="addresshindi"  id="addresshindi" maxlength="70" class="textbox" value="<?php echo $billaddress; ?>"/></td>
          </tr>
          
          <tr>
            <th valign="top"><?php echo ADDRESSINENGLISH;?><span class="red">*</span> :</th>
            <td><input type="text"  name="addressenglish"  id="addressenglish" maxlength="70" class="textbox" value="<?php echo $billaddressenglish; ?>"/></td>
          </tr>
          
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="global_setting"  />
                  <input type="hidden"  name="displayLogo"  id="displayLogo"  value="0" />
                <input type="hidden" name="mod" value="mod_cms"  />
                <input type="button" value="<?php echo SAVE;?>"   name="button" onclick="checkSettings();" style="cursor:pointer;width:70px;height:30px;"/>
             
            </td>
            </tr>
        </table>
      
	<!-- end id-form  -->

	</td>
	<td align="left">

	<!--  start related-activities -->
	<!--<div id="related-activities">
		
		
		<div id="related-act-top">
		
        </div>
		<div id="related-act-bottom">
		
			<div id="related-act-inner" style="float:left">
			 		<?php 
						  /*$JDatabaseMySQL = new JDatabaseMySQL();
						  $JDatabaseMySQL->sql = "SELECT * FROM mgl_users WHERE user_role ='admin'";
						  $JDatabaseMySQL->query();
						  $users = $JDatabaseMySQL->loadAssoc();
						   
						 $userName= $users[0]['user_display_name'];
						 if(strlen($userName)>50){
						 $userName=substr($userName,0,50).'....';
						 }*/
						//  $users = @explode(",",$PAGE_SEC_SET['categories']);
						 ?>
					<ul>
                   
							<li><div id="cat_name" class="breakword"><?php  //echo ucfirst(@$userName);?></div></li> 
                        
                                           
										                      
					</ul>
				</div>
				
			</div>
		
			<div class="clear"></div>
		
		</div>-->
		
</td>
</tr>
<tr>
<td><img src="<?php echo $config_var->ADMIN_TPL_URL;?>/images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 </form>
 
<div class="clear"></div>
 

</div>
		