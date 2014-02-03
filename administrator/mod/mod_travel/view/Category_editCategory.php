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
  
  if((isset($_REQUEST['cat_id']))&&(@$_REQUEST['cat_id'] != '')){ 
                 				 $cat_id = (int)@$_REQUEST['cat_id']; 
								 $CatDb_OB = new JDatabaseMySQL();
								 $CatDb_OB->sql = "SELECT * FROM categories WHERE id = '$cat_id'";	
						 		 $CatDb_OB->query();
								 $PAGE_SEC_SET = $CatDb_OB->getArray();
	$model_gallery_editgallery = new model_gallery_editgallery();
	$gallery = $model_gallery_editgallery->getPageData($_REQUEST);

}          
?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_gallery&view=editgallery&d=5&cat_id=<?php echo $cat_id;?>" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onsubmit="return checkAddgallery();">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th valign="top"><?php echo galleryTITLE;?><span class="red">*</span> :</th>
                <td><input type="text"  name="gallery_title" class="textbox"  id="gallery_title" value="<?php echo $gallery['gallery_name'];?>" maxlength="70"/></td>
            </tr>
            
            <tr>
               <th valign="top">&nbsp;</th>
               <td>&nbsp;</td>
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
                  <input type="hidden" name="cat_id" value="<?php echo $cat_id ;?>"  />
                <input type="hidden" name="controller" value="edit_gallery"  />
                <input type="hidden" name="mod" value="mod_gallery"  />
                <input type="button" value="<?php echo Update;?>"  name="button" onclick="checkAddgallery();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>"   onclick="window.location.href='./index.php?mod=mod_gallery&view=default&m=4&d=5'"  style="cursor:pointer;width:70px;height:30px;"/>
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
		