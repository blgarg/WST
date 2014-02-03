<?php 
global $config_var;  
global $DataSet;


?>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_type&view=addNewtype&m=4&d=1" onsubmit="return checkAddType();" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkAddgallery();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th width="143" valign="top"> Title<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="type_title"  id="type_title" maxlength="50" class="textbox"/></td>
            </tr>
		
		
		
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="addNewtype"  />
                <input type="hidden" name="mod" value="mod_type"  />
             <input type="button" value="SAVE"  name="button" title="Save" onclick="checkAddType();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="CANCEL"  title="Cancel" onclick="window.location.href='./?mod=mod_type&view=default&m=4&d=4'"  style="cursor:pointer;width:70px;height:30px;"/>          </td>
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
		