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
  
  if((isset($_REQUEST['page_id']))&&(@$_REQUEST['page_id'] != '')){ 
	$page_id = (int)@$_REQUEST['page_id']; 
	$model_cms_editPage = new model_cms_editPage();
	$Page = $model_cms_editPage->getPageData($_REQUEST);
}          
?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_cms&view=editPage&d=2&page_id=<?php echo $page_id;?>" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onsubmit="return checkAddPage();">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                                  
           <tr>
                <th valign="top">PAGE TITLE<span class="red">*</span> :</th>
                <td><input type="text" name="english_title" maxlength="200" id="english_title"  readonly="true" value="<?php echo $Page[0]['page_title'];?>" maxlength="200" class="textbox" style="width:74%;" /></td>
            </tr>
        <tr>
            <th valign="top"> DESCRIPTION:</th>
            <td><?php
	  include("$config_var->ADMIN_ROOT"."FCKeditor/fckeditor.php");
	  $obj=new FCKEditor("englishText");
	  $obj->BasePath="FCKeditor/";
	  $obj->Height=400;
	  $obj->Width=800;
	  $obj->Value= @$Page[0]['page_content'];
	  $obj->Create();
	  ?><?php //echo $code = $CKEditor->editor("pageText", @$Page['page_content'],$config);?></td>
           </tr>  
           <tr>
            <th valign="top"> META TITLE<span class="red">*</span> :</th>
            <td><textarea name="page_meta_tags" maxlength="70" id="page_meta_tags"  style="width:74%;" ><?php echo $Page[0]['page_meta_tags'];?></textarea></td>
          </tr>
        
         <tr>
            <th valign="top"> META DESCRIPTION<span class="red">*</span> :</th>
            <td><textarea name="meta_desc"  id="meta_desc"  style="width:74%;"><?php echo $Page[0]['meta_desc'];?></textarea> </td>
          </tr>
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                  <input type="hidden" name="page_id" value="<?php echo $page_id ;?>"  />
                <input type="hidden" name="controller" value="edit_page"  />
                <input type="hidden" name="mod" value="mod_cms"  />
                <input type="button" value="<?php echo UPDATE;?>"  title="Update"  name="button" onclick="checkAddPage();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>" title="Cancel" onclick="window.location.href='./index.php?mod=mod_cms&view=default&d=2'"  style="cursor:pointer;width:70px;height:30px;"/>            </td>
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
		