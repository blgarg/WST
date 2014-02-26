<?php 
global $config_var;  
global $DataSet;
//config URL 
//$config_var->ADMIN_TPL_URL
include("$config_var->ADMIN_ROOT"."ckeditor/ckeditor.php");
// Create class instance.
/*$CKEditor = new CKEditor();
$CKEditor->returnOutput = true;
$CKEditor->basePath = './ckeditor/';
$CKEditor->config['width'] =700;
$CKEditor->textareaAttributes = array("cols" => 80, "rows" => 10);
$initialValue = '<p>This is some <strong>sample text</strong>. You are using <a href="http://ckeditor.com/">CKEditor</a>.</p>';*/
$config['toolbar'] = array(
	array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	array( 'Image', 'Link', 'Unlink', 'Anchor' )
);
$config['skin'] = 'v2';

$CatDb_OB = new JDatabaseMySQL();
$CatDb_OB->sql = "SELECT * FROM forum_categories";	
$CatDb_OB->query();
$CatDb_OB->getNumRows();
$PAGE_SEC_SET = $CatDb_OB->loadAssoc();


$CatDb_OB1 = new JDatabaseMySQL();
$CatDb_OB1->sql = "SELECT * FROM forum_sub_categories where cat_id='".$PAGE_SEC_SET[0]['cat_id']."'";	
$CatDb_OB1->query();
$CatDb_OB1->getNumRows();
$PAGE_SUB_CAT = $CatDb_OB1->loadAssoc();
?>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_forum&view=addNewForum&d=1&type=forum" onsubmit=" return checkAddCategory();" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"   >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th width="153" valign="top">Forum Title<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="title" value="<?php //echo $modelName; ?>"  id="category_title" maxlength="50" class="textbox"/></td>
            </tr>
			 <tr>
              <th valign="top">Category</th>
			  <td>
                    	<select name="cat" style="width:90%;border: 1px solid #D7D7D7;font-size: 14px;height: 25px;line-height: 24px;" id="cat" onchange="return subcatfun(this.value);">
                        	<?php foreach($PAGE_SEC_SET as $cat_data){?>
							
							<option value="<?php echo $cat_data['cat_id']; ?>"><?php echo $cat_data['cat_name']; ?></option>
							<?php }?>
                        </select>
                    </td>
            </tr>
        <tr>
		 <tr>
              <th valign="top">Sub Category</th>
			  <td id="subcat">
                    	<select name="sub_cat" style="width:90%;border: 1px solid #D7D7D7;font-size: 14px;height: 25px;line-height: 24px;" id="sub_cat">
                        	<?php foreach($PAGE_SUB_CAT as $sub_cat_data){?>
							
							<option value="<?php echo $sub_cat_data['sub_cat_id']; ?>"><?php echo $sub_cat_data['sub_cat_name']; ?></option>
							<?php }?>
                        </select>
                    </td>
            </tr>
            <tr>
              <th valign="top"><?php echo DESCRIPTION;?>:</th>
                <td><?php
	  include("$config_var->ADMIN_ROOT"."FCKeditor/fckeditor.php");
	  $obj=new FCKEditor("categoryText");
	  $obj->BasePath="FCKeditor/";
	  $obj->Height=400;
	  $obj->Width=800;
	  $obj->Value= @$Category['cat_content'];
	  $obj->Create();
	  ?><?php //echo $code = $CKEditor->editor("categoryText", @$page_content,$config);?></td>
            </tr> 
			
			<tr>
              <th valign="top">Attachments</th>
			  <td><table width="100%">
					<tr>
					<td><input type="file" name="image_load[]" class="textbox"> </td>
				  </tr>
					<tr>
					<td><input type="file" name="image_load[]" class="textbox"> </td>
				  </tr>
					<tr>
					<td><input type="file" name="image_load[]" class="textbox"> </td>
				  </tr>
					<tr>
					<td><input type="file" name="image_load[]" class="textbox"> </td>
				  </tr>
				  <tr>
					<td><input type="file" name="image_load[]" class="textbox"> </td>
				  </tr>
			</table>
			</td>
            </tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_newForum"  />
                <input type="hidden" name="mod" value="mod_Forum"  />
             <input type="button" value="<?php echo SAVE;?>" title="Save" name="button" onclick="checkAddCategory();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>" title="Cancel"  onclick="window.location.href='./?mod=mod_forum&view=default&d=1&type=forum'"  style="cursor:pointer;width:70px;height:30px;"/>          </td>
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
