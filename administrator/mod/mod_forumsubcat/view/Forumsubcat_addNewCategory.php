<?php 
global $config_var;  
global $DataSet;

$CatDb_OB = new JDatabaseMySQL();
$CatDb_OB->sql = "SELECT * FROM forum_categories";	
$CatDb_OB->query();
$CatDb_OB->getNumRows();
$PAGE_SEC_SET = $CatDb_OB->loadAssoc();
?>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_forumsubcat&view=addNewCategory&d=3&type=forum" onsubmit=" return checkAddCategory();" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkAddmodel();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           
            <tr>
              <th valign="top">Category</th>
			  <td>
                    	<select name="cat" style="width:90%;border: 1px solid #D7D7D7;font-size: 14px;height: 25px;line-height: 24px;">
                        	<?php foreach($PAGE_SEC_SET as $cat_data){?>
							
							<option value="<?php echo $cat_data['cat_id']; ?>"><?php echo $cat_data['cat_name']; ?></option>
							<?php }?>
                        </select>
                    </td>
            </tr>
			 <tr>
                <th width="153" valign="top">Sub Category Title<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="category_title" value="<?php //echo $modelName; ?>"  id="category_title" maxlength="50" class="textbox"/></td>
            </tr>
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_new_category"  />
                <input type="hidden" name="mod" value="mod_Category"  />
             <input type="button" value="<?php echo SAVE;?>" title="Save" name="button" onclick="checkAddCategory();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>" title="Cancel"  onclick="window.location.href='./?mod=mod_forumcat&view=default&d=2&type=forum'"  style="cursor:pointer;width:70px;height:30px;"/>          </td>
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
		