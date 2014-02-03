<?php 
global $config_var;  
global $DataSet;
//config URL 
//$config_var->ADMIN_TPL_URL

$model_type_editType = new model_type_editType();
	$type = $model_type_editType->getPageData($_REQUEST['type_id']);

?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_type&view=editType&d=5&cat_id=<?php echo $_REQUEST['type_id'];?>" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onsubmit="return checkAddType();">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th valign="top">TITLE<span class="red">*</span> :</th>
                <td><input type="text"  name="type_title" class="textbox"  id="type_title" value="<?php echo $type['type_name'];?>" maxlength="50"/></td>
            </tr>
            
            
                      
        <!--   <tr>
            <th valign="top"><?php echo DESCRIPTION;?> :</th>
            <td><?php
	  include("$config_var->ADMIN_ROOT"."FCKeditor/fckeditor.php");
	  $obj=new FCKEditor("galleryText");
	  $obj->BasePath="FCKeditor/";
	  $obj->Height=400;
	  $obj->Width=800;
	  $obj->Value= @$gallery['cat_content'];
	  $obj->Create();
	  ?><?php //echo $code = $CKEditor->editor("galleryText", @$gallery['cat_content'],$config);?></td>
           </tr>
        -->
          
          
          
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                  <input type="hidden" name="type_id" value="<?php echo $_REQUEST['type_id'] ;?>"  />
                <input type="hidden" name="controller" value="edit_type"  />
                <input type="hidden" name="mod" value="mod_type"  />
                <input type="button" value="Update"  title="Update" name="button" onclick="checkAddType();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="Cancel"  title="Cancel" onclick="window.location.href='./index.php?mod=mod_type&view=default&m=4&d=4'"  style="cursor:pointer;width:70px;height:30px;"/>
            </td>
            </tr>
        </table>
      
	<!-- end id-form  -->

	</td>
	<td align="left">

	<!--  start related-activities -->
	
		
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
		