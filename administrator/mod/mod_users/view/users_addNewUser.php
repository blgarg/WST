<?php 
global $config_var;  
global $DataSet;

//echo "<pre>"; print_r($_SESSION['return']); 

$firstname = $lastname =$email =$phonenum = $address = $facebook_URL = $twitter_URL ='';
if(isset($_REQUEST['first_name']) && $_REQUEST['first_name']!=''){
	
	$firstname = $_REQUEST['first_name'];
}
if(isset($_REQUEST['last_name']) && $_REQUEST['last_name']!=''){
	$lastname = $_REQUEST['last_name'];
}
if(isset($_REQUEST['email_add']) && $_REQUEST['email_add']!=''){
	$email = $_REQUEST['email_add'];
}
if(isset($_REQUEST['phone_number']) && $_REQUEST['phone_number']!=''){
	$phonenum = $_REQUEST['phone_number'];
}
if(isset($_REQUEST['address']) && $_REQUEST['address']!=''){
	$address = $_REQUEST['address'];
}
if(isset($_REQUEST['facebook_URL']) && $_REQUEST['facebook_URL']!=''){
	$facebook_URL = $_REQUEST['facebook_url'];
}
if(isset($_REQUEST['twitter_URL']) && $_REQUEST['twitter_URL']!=''){
	$twitter_URL = $_REQUEST['twitter_URL'];
}

$model_users_addNewUser = new model_users_addNewUser();
$countryList = $model_users_addNewUser->countryList($_REQUEST);
$membership_plans = $model_users_addNewUser->membership_list();

 

?>


<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_users&view=addNewUser&m=1" method="post" id="adddUserFrm" name="adddUserFrm" enctype="multipart/form-data"  autocomplete="off" onsubmit="return checkAddUser();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th valign="top">First Name<span class="red">*</span> :</th>
                <td><input type="text"  name="first_name"  id="first_name" maxlength="70" class="textbox" value="<?php if(@$_SESSION['return']['first_name']==""){echo $firstname;}else{ echo $_SESSION['return']['first_name']; }?>"/></td>
            </tr>
          <tr>
            <th valign="top">Last Name <span class="red">*</span>:</th>
            <td><input type="text"  name="last_name"  id="last_name" maxlength="70" class="textbox" value="<?php if(@$_SESSION['return']['last_name']==""){ echo $firstname; }else{ echo @$_SESSION['return']['last_name'] ;}?>" /></td>
          </tr>
          
          <tr>
            <th valign="top">Email / Username<span class="red">*</span> :</th>
            <td><input type="text"  name="email_add"  id="email_add" maxlength="70" class="textbox" value="<?php if(@$_SESSION['return']['email_add']==""){ echo $email; }else{ echo @$_SESSION['return']['email_add'] ;}?>"/></td>
          </tr>
        
          <tr>
            <th valign="top">Password<span class="red">*</span> :</th>
            <td><input type="password"  name="password"  id="password" maxlength="20" class="textbox" value="<?php if(@$_SESSION['return']['password']==""){ echo ""; }else{ echo @$_SESSION['return']['password'] ;} ?>" /></td>
          </tr>
          
           <tr>
            <th valign="top">Country<span class="red">*</span> :</th>
            <td>
            <select name="country"  id="country" maxlength="70" class="selectbox" />
            <option value="0">Select Country</option>
            <?php for($i=0;$i<count($countryList);$i++){ ?>
            <option value="<?php echo $countryList[$i]['country_name']; if($countryList[$i]['country_name'] == $_SESSION['return']['country']) {?>"selected="<?php $countryList[$i]['country_name'];} ?>"><?php echo $countryList[$i]['country_name']; ?></option>
            <?php } ?>
            </select>
            </td>
          </tr>
          
           <tr>
            <th valign="top">State<span class="red">*</span> :</th>
            <td id="statetd">
            <input type="text" name="state" id="state" maxlength="70" class="textbox" value="<?php if(@$_SESSION['return']['state'] ==""){ echo ""; }else{ echo @$_SESSION['return']['state'];} ?>"/>
            </td>
          </tr>
           <tr>
            <th valign="top">Phone Number<span class="red">*</span> :</th>
            <td><input type="text"  name="phone_number"  id="phone_number" maxlength="20" class="textbox" value="<?php if(@$_SESSION['return']['phone_number'] == ""){echo $phonenum; }else{ echo @$_SESSION['return']['phone_number']; }?>"/></td>
          </tr>
          <tr>
            <th valign="top">Address:</th>
            <td><textarea name="address" id="address"><?php if(@$_SESSION['return']['address'] == ""){echo $address;}else{echo @$_SESSION['return']['address'];}?></textarea></td>
          </tr>
        <tr>
        <tr>
			<th valign="top">Membership<span class="red">*</span> :</th>
			<td>
				<select name="membership" id="membership" class="selectbox">
					<option value="0">select Plan</option>
					<?php foreach($membership_plans as $plans){ ?>
					<option value="<?php echo $plans['id']?>"<?php if(@$_SESSION['return']['membership'] == $plans['id']){ ?> selected="<?php $plans['id'];} ?>"><?php echo ucfirst(strtolower($plans['title']));?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th valign="top">Payment status<span class="red">*</span> :</th>
			<td>
				<select name="payment_type" id="payment_type" class="selectbox">
					<option value="0" <?php if(@$_SESSION['return']['payment_type']=='0'){?> selected="<?php echo "0"; }?> ">select </option>
					<option value="pending" <?php if(@$_SESSION['return']['payment_type']=='pending'){?> selected="<?php echo "pending"; }?> ">Pending</option>
					<option value="complete" <?php if(@$_SESSION['return']['payment_type']=='complete'){?> selected="<?php echo "complete"; }?> ">Complete</option>
				</select>
			</td>
		</tr>	
		<?php unset($_SESSION['return']);?>
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_new_user"  />
                     <input type="hidden" name="user_id" value=""  />
                <input type="hidden" name="mod" value="mod_users"  />
               <br> <input type="submit" value="Save" style="height: 30px;
    width: 70px;cursor:pointer;" title="Save" name="button" onclick="checkAddUser();" />
                <input type="button" value="Cancel" title="Cancel" style="height: 30px;
    width: 70px;cursor:pointer;"  onclick="window.location.href='./index.php?mod=mod_users&view=default&m=1'"  />
            </td>
            </tr>
        </table>
      
	<!-- end id-form  -->

	</td>
	<td align="left">
  
	
		
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
		