<?php
global $config_var;
$model_joinus_signup = new model_joinus_signup();
$country_list = $model_joinus_signup->getCountryList();
		switch($_REQUEST['join']){
		case '1' :
			$_SESSION['price']='19.95' ;
		break;
		case '2' :
			$_SESSION['price']='39.95';
		break;
		case '3' :
			$_SESSION['price']='59.95';
		break;
		case 'default' :
		break;
		}
?>
<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/membership-details-txt.png" alt="" />
        </div>
    	<!--Content Text-->
    	<div class="content-txt" style="width:100%; padding:0;">
        
           <div class="mship-form-details2">
             <div class="safe-secure">
                <img src="<?php echo $config_var->WEB_TPL_URL;?>images/safe-secure2.png" alt="" />
             </div>
             
            <div class="mship-form-details-txt2">
			
			<div id="content-table-inner"  style="background-color: green; font-size: 12pt; color: white; text-align: center; padding-left: 0px; padding-right: 0px; width: 730px; border-left-width: 0px; margin-left: 165px;" >
			</div>
			<div id="err_mess"  style="background-color: red; font-size: 12pt; color: white; text-align: center; padding-left: 0px; padding-right: 0px; width: 730px; border-left-width: 0px; margin-left: 165px;" >
			
			</div>
			<?php if(isset($_SESSION['error']) && $_SESSION['error']!=''){?>
				<div id="server_mess"  style="background-color: red; font-size: 12pt; color: white; text-align: center; padding-left: 0px; padding-right: 0px; width: 730px; border-left-width: 0px; margin-left: 165px;" >
					<?php echo str_replace('%20',' ',$_SESSION['error']);?>
				</div>
			<?php $_SESSION['error']="";unset($_SESSION['error']);}?>
			
              <form id="signup" name="signup" method="post" autocomplete="off" action="./?mod=mod_joinus&view=signup&join=<?php echo $_REQUEST['join'];?>&s=6" onsubmit="return validation();" >  
				<input type="hidden" id="controller" name="controller" value="insertUser" />
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="150" height="55" align="right" valign="middle">First Name<span style="color:red;">*</span>:</td>
                    <td width="210" align="left"  valign="middle"><input type="text" maxlength="30" id="username" name="username" value="<?php echo @$_SESSION['details']['username'];?>" /></td>
                    <td width="100" align="right"  valign="middle">Last Name<span style="color:red;">*</span>:</td>
                    <td align="left"  valign="middle"><input type="text" maxlength="30" id="lastname" name="lastname" value="<?php echo @$_SESSION['details']['lastname'];?>" /></td>
                  </tr>
                 <tr>
                    <td  height="55" align="right" valign="middle">Address:</td>
                    <td  align="left"  valign="middle"><input id="address" name="address" maxlength="100" type="text" value="<?php echo @$_SESSION['details']['address'];?>" /></td>
                    <td  align="right"  valign="middle">City:</td>
                    <td align="left"  valign="middle"><input type="text" maxlength="100" id="city" name="city"  value="<?php echo @$_SESSION['details']['city'];?>" /></td>
                  </tr>
                   <tr>
                    <td  height="55" align="right" valign="middle">State:</td>
                    <td  align="left"  valign="middle"><input type="text" maxlength="30" id="state" name="state" value="<?php echo @$_SESSION['details']['state'];?>" />
                    </td>
                    <td  align="right"  valign="middle">Phone No.<span style="color:red;">*</span>:</td>
                    <td align="left"  valign="middle"><input type="text" maxlength="20" id="phone_no" name="phone_no"  value="<?php echo @$_SESSION['details']['phone_no'];?>" /></td>
                  </tr>
                   <tr>
                    <td  height="55" align="right" valign="middle">Country<span style="color:red;">*</span>:</td>
                    <td  align="left"  valign="middle" colspan="0">
                        <select name="country_name" id="country_name">
                            <option value="0">Select Country</option>
							<?php for($i = 0;$i<count($country_list);$i++){ ?>
                <option value="<?php echo $country_list[$i]['country_name']; ?>" <?php if($country_list[$i]['country_name']==@$_SESSION['details']['country_name']){ ?> selected="selected" <?php } ?> ><?php echo $country_list[$i]['country_name']; ?></option>
				<?php }?>
                        </select>
                    </td>
					<td  height="55" align="right" valign="middle">Email ID<span style="color:red;">*</span>:</td>
                    <td  align="left"  valign="middle"><input type="text" maxlength="60" id="emailid" name="emailid" value="<?php echo @$_SESSION['details']['emailid'];?>" />
                    </td>
                  </tr>
				  
				  <tr>
                    <td  height="55" align="right" valign="middle">Password<span style="color:red;">*</span>:</td>
                    <td  align="left"  valign="middle"><input type="password" maxlength="20" id="password" name="password" value="<?php echo @$_SESSION['details']['password'];?>" />
                    </td>
				
                    <td  height="55" align="right" valign="middle">Confirm Password<span style="color:red;">*</span>:</td>
                    <td  align="left"  valign="middle"><input type="password" maxlength="20" id="confirm_password" name="confirm_password" value="<?php echo @$_SESSION['details']['confirm_password'];?>" />
                    </td>
				</tr>
				
                   <tr>
                    <td  height="55" align="right" valign="middle">Payment Options<span style="color:red;">*</span> :</td>
                    <td  align="left"  valign="middle" colspan="3">
                        <select class="select-740" name="payment_type" id="payment_type">
						    <option value="0">Please select card type</option>
							<option value="Visa" <?php if("Visa"==@$_SESSION['details']['payment_type']){ ?> selected="selected" <?php } ?> >Visa</option>
							<option value="American Express" <?php if("American Express"==@$_SESSION['details']['payment_type']){ ?> selected="selected" <?php } ?> >American Express</option>
							<option value="Master Card" <?php if("Master Card"==@$_SESSION['details']['payment_type']){ ?> selected="selected" <?php } ?> >Master Card</option>
							<option value="Discover" <?php if("Discover"==@$_SESSION['details']['payment_type']){ ?> selected="selected" <?php } ?> >Discover</option>
                        </select>
                    </td>
                  </tr>
                   <tr>
                    <th  height="55" align="right" valign="middle">We Accept :</th>
                    <td  align="left"  valign="middle" colspan="3">
                        <a href="javascript:;"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/card1.jpg" alt="" /></a>
                        <a href="javascript:;"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/card2.jpg" alt="" /></a>
                        <a href="javascript:;"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/card3.jpg" alt="" /></a>
                        <a href="javascript:;"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/card4.jpg" alt="" /></a>
                    </td>
                  </tr>
                   <tr>
                    <td  height="55" align="right" valign="middle">Card Number<span style="color:red;">*</span>:</td>
                    <td  align="left"  valign="middle"><input type="text"  id="card_number" name="card_number" maxlength="16"  value="<?php echo @$_SESSION['details']['card_number'];?>" /></td>
                    <td  align="right"  valign="middle">Name on Card<span style="color:red;">*</span>:</td>
                    <td align="left"  valign="middle"><input type="text"  id="name_on_card" name="name_on_card"  value="<?php echo @$_SESSION['details']['name_on_card'];?>" /></td>
                  </tr>
                   <tr>
                    <td  height="55" align="right" valign="middle">Expiry<span style="color:red;">*</span>:</td>
                    <td  align="left"  valign="middle">
					<select name="month"  id="month" style="width:115px;">
						<option value="0">Select Month</option>
						<?php for($i=1;$i<=12;$i++){?>
							<option value="<?php echo $i?>" <?php if($i==@$_SESSION['details']['month']){ ?> selected="selected" <?php } ?>><?php echo $i;?></option>
						<?php }?>
					</select>
					&nbsp;
					<select name="year"  id="year" style="width:115px;">
						<option value="0">Select Year</option>
						<?php for($i=2013;$i<=2060;$i++){?>
							<option value="<?php echo $i?>" <?php if($i==@$_SESSION['details']['year']){ ?> selected="selected" <?php } ?> ><?php echo $i;?></option>
						<?php }?>
					</select>
					
                    <td  align="right"  valign="middle">CVV<span style="color:red;">*</span>:</td>
                    <td align="left"  valign="middle"><input type="text"  id="cvv" name="cvv" maxlength="3"  value="<?php echo @$_SESSION['details']['cvv'];?>" /></td>
                  </tr>
                   <tr>
                    <th  height="40" align="right" valign="middle">&nbsp;</th>
                    <td  align="left"  valign="middle" colspan="3">
                        <input type="checkbox"  id="agreement" name="agreement"  /> I agree to the <a href="?mod=mod_index&view=termspage&s=7" target="_blank" class="color-blue">Terms and Conditions</a>
                        
                    </td>
                  </tr>
				  <?php unset($_SESSION['details']); ?>
				  <tr>
                    <th  height="60" align="right" valign="middle">&nbsp;</th>
                    <td  align="left"  valign="middle" colspan="3">
                       
                            
							<input type="submit" href="javascript:;" class="submit-btn" style="border:none;" onclick="validation();"  id="btn_submit" name="btn_submit"  title="SUBMIT" value="SUBMIT" />
                       
                        <div class="submit-btn">
                            <a href="?mod=mod_joinus&view=default&s=6" title="CANCEL" >CANCEL</a>
                        </div>
                    </td>
                  </tr>
                  
                </table>
			</form>
            </div>
            <div class="clr"></div>
        </div>
            
            
           
            
             
             
          
             
            
        </div>
        <!--//Content Text-->
    </div>
     <!--//ConTent-->
 </div>
     <!--//ConTent-->
	
<div class="clr"></div>    
</div>