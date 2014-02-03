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
?>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_Category&view=addNewCategory&m=4" onsubmit=" return checkAddCategory();" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkAddmodel();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th width="153" valign="top">Category Title<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="category_title" value="<?php //echo $modelName; ?>"  id="category_title" maxlength="50" class="textbox"/></td>
            </tr>
            <!--<tr>
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
            </tr> -->
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_new_category"  />
                <input type="hidden" name="mod" value="mod_Category"  />
             <input type="button" value="<?php echo SAVE;?>" title="Save" name="button" onclick="checkAddCategory();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>" title="Cancel"  onclick="window.location.href='./?mod=mod_Category&view=default&m=4'"  style="cursor:pointer;width:70px;height:30px;"/>          </td>
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
		