<div class="about_fan_bg_top">
                    Change Password
                    </div>
<div class="about_fan_bg_cen"> 
<form action="#" method="post"  name="change_fan_pass"   id="change_fan_pass"  onsubmit="return change_pass_FanUser();">               
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td colspan="3"  id="error" class="errror_msg" style="font-size:13px;font-weight:normal;text-align:center;" align="center">
    <span id="msgbox" style="display:''; margin-top:33px; left:2px;"></span></td>
</tr>
<tr class="row_bg">
    <td width="170" height="45" align="left" valign="middle" style="padding-left:12px;">Old Password:<span class="red">*</span>:</td>
    <td width="1044" align="left" valign="middle">
    <input type="password"  name="oldpass"  id="oldpass" maxlength="30" class="Sign_up-input" value=""/>    </td>
</tr>
<tr class="row_bg">
    <td width="170"  height="45" align="left" valign="middle" style="padding-left:12px;">New Password:<span class="red">*</span></td>
    <td align="left" valign="middle">
    <input type="password"  name="newPass"  id="newPass" maxlength="30" class="Sign_up-input" value="" />    </td>
</tr>
<tr class="row_bg">
    <td width="170"  height="45" align="left" valign="middle" style="padding-left:12px;">Verify Password:<span class="red">*</span></td>
    <td align="left" valign="middle">
    <input type="password"  name="verifyPass"  id="verifyPass" maxlength="30"  value="" />    
    <input type="hidden" name="Fan_arrayFields" value="oldpass,newPass,verifyPass" id="Fan_arrayFields"  /></td>
</tr>
<tr>
    <td colspan="2">&nbsp;</td>
</tr>
<tr>  <td>&nbsp;</td>
    <td align="left"><input type="submit" name="mod" value=" Change Paasword "   id="changePasswordBtn" style="cursor:pointer;"/></td>
</tr>
<tr>
    <td colspan="2">&nbsp;</td>
</tr>
</table>

</form>
</div>