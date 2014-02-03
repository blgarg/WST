<?php 
global $config_var;  
global $DataSet;

//config URL 

if((isset($_REQUEST['user_id']))&&(@$_REQUEST['user_id'] != '')){ 
	$user_id = (int)@$_REQUEST['user_id']; 
	$CatDb_OB = new JDatabaseMySQL();
	$CatDb_OB->sql = "SELECT * FROM users WHERE user_id = '$user_id'";
	$CatDb_OB->query();
	$PAGE_SEC_SET = $CatDb_OB->getArray();
	
	$model_category_editPage = new model_users_editUser();
	$userdata = $model_category_editPage->getUserData($user_id);
	$getMemberShip = $model_category_editPage->getMemberShip($userdata[0]['id']);
	$membership_plans = $model_category_editPage->membership_list();
   $countryList = $model_category_editPage->countryList();
    
}          


?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_users&view=editUser&m=1&user_id=<?php echo $user_id;?>" method="post" id="adddUserFrm" name="adddUserFrm" enctype="multipart/form-data" onsubmit = "return checkEditUser();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                 <th valign="top">First Name<span class="red">*</span> :</th>
                <td><input type="text"  name="first_name"  id="first_name" value="<?php echo $userdata[0]['first_name'];?>" maxlength="70" class="textbox" /></td>
            </tr>
          
          <tr>
            <th valign="top">Last Name <span class="red">*</span>:</th>
            <td><input type="text"  name="last_name"  id="last_name" value="<?php echo $userdata[0]['last_name'];?>" maxlength="70" class="textbox" /></textarea></td>
          </tr>

          <tr>
            <th valign="top">Email / Username<span class="red">*</span> :</th>
            <td><input type="text"  name="email_add"  id="email_add" maxlength="70" class="textbox" value="<?php echo @$userdata[0]['email'];?>"/></td>
          </tr>
		  <tr>
            <th valign="top">Password<span class="red">*</span> :</th>
            <td><input type="password"  name="password"  id="password" maxlength="50" class="textbox" value="<?php echo @base64_decode($userdata[0]['password']);?>"/></td>
          </tr>
          <tr>
            <th valign="top">Phone Number :</th>
            <td><input type="text"  name="phone_number"  id="phone_number" maxlength="20" class="textbox" value="<?php echo $userdata[0]['phone_number'];?>" /></td>
          </tr>
          <tr>
          
           <tr>
            <th valign="top">Country<span class="red">*</span> :</th>
            <td>
            <select name="country"  id="country" maxlength="70" class="selectbox" "/>
            <option value="0">Select Country</option>
            <?php foreach($countryList as $list){  ?>
            <option value="<?php echo $list['country_name']; ?>" <?php if($list['country_name']==$userdata[0]['country']){ ?> selected="selected" <?php } ?>><?php echo $list['country_name']; ?></option>
            <?php } ?>
            </select>
            </td>
          </tr>
           <tr>
            <th valign="top">State<span class="red">*</span> :</th>
            <td  id="statetd">
				<input type="text"  name="state"  id="state" maxlength="20" class="textbox" value="<?php echo $userdata[0]['state'];?>" />
            </td>
          </tr>
        
           <tr>
           <th valign="top">Address :</th>
            <td><textarea name="address" id="address"><?php echo $userdata[0]['address'];?></textarea></td>
          </tr>
		  <tr>
			<th valign="top">Membership<span class="red">*</span> :</th>
			<td>
				<select name="membership" id="membership" class="selectbox">
					<option value="0">select Plan</option>
					<?php foreach($membership_plans as $plans){ ?>
					<option value="<?php echo $plans['title']?>"<?php if(@$getMemberShip[0]['membership_plan'] == $plans['title']){ ?> selected="selected"<?php } ?>><?php echo ucfirst(strtolower($plans['title']));?></option>
					<?php }?>
				</select>
			</td>
		</tr>
		<tr>
			<th valign="top">Payment status<span class="red">*</span> :</th>
			<td>
				<select name="payment_type" id="payment_type" class="selectbox">
					<option value="0" <?php if($getMemberShip[0]['payment_status']=='0'){?> selected="<?php echo "0"; }?> ">select </option>
					<option value="pending" <?php if(@$getMemberShip[0]['payment_status']=='pending'){?> selected="<?php echo "pending"; }?> ">Pending</option>
					<option value="complete" <?php if(@$getMemberShip[0]['payment_status']=='complete'){?> selected="<?php echo "complete"; }?> ">Complete</option>
				</select>
			</td>
		</tr>
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id ;?>"  />
                <input type="hidden" name="controller" value="edit_user"  />
				<?php if(isset($_GET) && $_GET!=''){?>
					<input type="hidden" name="p" value="<?php echo $_GET['p'];?>">
				<?php }?>
               <br> <input type="hidden" name="mod" value="mod_users"  />
                <input type="submit" value="Update" title="Update" style="height: 30px;
    width: 70px;cursor:pointer;"  name="submit" onclick="checkEditUser();" />
                <input type="button" value="Cancel" title="Cancel" style="height: 30px;
    width: 70px;cursor:pointer;" onclick="window.location.href='./index.php?mod=mod_users&view=default&m=1'"  />
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
		