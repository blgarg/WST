<?php
$session = new session();
$model_fan_default = new model_fan_default();
//$sessionVar = $session->printSession();
$idUser = @$session->getVar("userAccountID");
$fan = $model_fan_default->getFanData($idUser);

$dobVar = $fan['dateofbirth'];
$dobVar = @explode("-",$dobVar);
$obj = new JDatabaseMySQL();
$obj->sql = "SELECT * FROM country";	
$obj->query();
$countryList = $obj->loadAssoc();
			
			
?>
<div class="about_fan_bg_top">MY Profile</div>
<div class="about_fan_bg_cen" style="height:750px;"> 
<form action="#" method="post"  name="Edit_fan_User"   id="Edit_fan_User"  onsubmit="return edit_FanUser();">               
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td colspan="3"  id="error" class="errror_msg" style="font-size:13px;font-weight:normal;text-align:center;" align="center">
    <span id="msgbox" style="display:''; margin-top:33px; left:2px;"></span>    </td>
</tr>
<tr class="row_bg">
    <td width="170" height="45" align="left" valign="middle" style="padding-left:12px;">Name<span class="red">*</span>:</td>
    <td width="1044" align="left" valign="middle">
    <input type="text"  name="first_name"  id="first_name" maxlength="70" class="Sign_up-input" value="<?php echo $fan['user_firstname'];?>"/>    </td>
</tr>
<tr class="row_bg" style="display:none;">
    <td width="170" height="45" align="left" valign="middle" style="padding-left:12px;">Email<span class="red">*</span>:</td>
    <td align="left" valign="middle">
    <input type="text"  name="email_add"  id="email_add" maxlength="70" class="Sign_up-input" value="<?php echo $fan['user_email'];?>"/>    </td>
</tr>
<tr class="row_bg">
    <td width="170" height="45" align="left" valign="middle" style="padding-left:12px;">Date of Birth<span class="red">*</span>:</td>
    <td>
    <select id="birth_year" onchange="getDays()"  style="width:100px;">
    <option value="0">YY</option>
    <?php
    echo Helper::getYears(date("Y"),100,'DESC',$dobVar['0']);
    ?>
    </select>
    <select id="birth_month" style="margin-left:10px; margin-right:10px; width:115px;" onchange="getDays()"   >
    <option value="0">MM</option>
    <?php
    echo  Helper::getMonths($dobVar['1']);
    ?>
    </select>
    <select id="birth_day"  style="width:100px;">
    <option value="0">DD</option>
    <?php
    echo Helper::getDays($dobVar['2']);
    ?>
    </select>    </td>
</tr>
<tr class="row_bg">
    <td width="170" height="45" align="left" valign="middle" style="padding-left:12px;">Gender<span class="red">*</span>:</td>
    <td align="left" valign="middle">
    <input type="radio" value="m"  name="gender" id="male" <?php if($fan['gender'] =='m'){?> checked="checked"<?php } ?> /> Male   <input type="radio" value="f"  name="gender" id="female" <?php if($fan['gender'] =='f'){?> checked="checked"<?php } ?>/> Female    </td>
</tr>
<tr class="row_bg">
    <td width="170" height="45" align="left" valign="middle" style="padding-left:12px;">Country<span class="red">*</span>:</td>
    <td align="left" valign="middle">
    <select name="country"  id="country" maxlength="70" class="selectbox"  style="width:183px;">
    <option value="0">Select Country</option>
    <?php for($i=0;$i<count($countryList);$i++){?>
    <option value="<?php echo $countryList[$i]['id']; ?>" <?php if($fan['country'] == $countryList[$i]['id']){?>  selected="selected" <?php  } ?>>
	<?php echo $countryList[$i]['name']; ?></option>
    <?php } ?>
    </select>    </td>
</tr>
<tr class="row_bg">
    <td width="170" height="45" align="left" valign="middle" style="padding-left:12px;">City<span class="red">*</span>:</td>
    <td align="left" valign="middle" id="statetd">
    <input type="text" name="stateText" id="stateText" maxlength="70" class="Sign_up-input"  value="<?php echo $fan['stateText'];?>">    </td>
</tr>
<tr class="row_bg" id="userBio" >
    <td width="170" height="45" align="left" valign="middle" style="padding-left:12px;">Bio:</td>
    <td align="left" valign="middle"><textarea name="bio" id="bio" style="width:280px;height:80px;"><?php echo $fan['bio'];?></textarea></td>
</tr>
<tr class="row_bg" id="userBio" >
    <td width="170" height="45" align="left" valign="middle" style="padding-left:12px;">Account Status:</td>
    <td align="left" valign="middle"><?php if($fan['is_active'] == '1'){echo "<b style='color:#008000'>Active</b>";}else{echo "<b style='color:#FB002B'>Deactivated</b>";}?></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td align="left"><input type="hidden" name="Fan_arrayFields" value="first_name,last_name,email_add,birth_year,birth_month,birth_day,country,stateText,bio" id="Fan_arrayFields"  />
    <input type="submit" name="mod" value=" Save "   id="editFanbutton" style="cursor:pointer"/></td>
</tr>
<tr>
    <td colspan="2">&nbsp;</td>
</tr>
<tr> <td align="left">&nbsp;</td>
    <td align="left"><a href="#" onclick="loadFanHTML('changepass');">Change Password</a></td>
</tr>
<tr> <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
</tr>
<tr> <td align="left">&nbsp;</td>
    <td align="left"><a href="#" onclick="loadFanHTML('chageProfilePic');">Change Profile Picture</a></td>
</tr>
<tr>
    <td colspan="2">&nbsp;</td>
</tr>
<tr>
    <td colspan="2">&nbsp;</td>
</tr>
</table>

</form>
</div>