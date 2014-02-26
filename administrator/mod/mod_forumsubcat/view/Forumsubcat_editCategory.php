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
								 $CatDb_OB->sql = "SELECT * FROM forum_sub_categories WHERE sub_cat_id = '$cat_id'";	
						 		 $CatDb_OB->query();
								 $PAGE_SEC_SET = $CatDb_OB->getArray();
	$model_Category_editCategory = new model_forumsubcat_editCategory();
	$Category = $model_Category_editCategory->getPageData($_REQUEST);

}  

$CatDb_OB = new JDatabaseMySQL();
$CatDb_OB->sql = "SELECT * FROM forum_categories";	
$CatDb_OB->query();
$CatDb_OB->getNumRows();
$PAGE_SEC_SET = $CatDb_OB->loadAssoc();        
?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_forumsubcat&view=editCategory&d=3&type=forum&cat_id=<?php echo $cat_id;?>" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onsubmit="return checkAddCategory();">
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
              <th valign="top">Category</th>
			  <td>
                    	<select name="cat" style="width:90%;border: 1px solid #D7D7D7;font-size: 14px;height: 25px;line-height: 24px;">
                        	<?php foreach($PAGE_SEC_SET as $cat_data){?>
							
							<option value="<?php echo $cat_data['cat_id'];?>" <?php if(@$cat_data['cat_id']==$Category['cat_id']){?>selected="selected" <?php }?>><?php echo $cat_data['cat_name']; ?></option>
							<?php }?>
                        </select>
                    </td>
            </tr>
			 <tr>
                <th valign="top">Category Title<span class="red">*</span> :</th>
                <td><input type="text"  name="category_title" class="textbox"  id="category_title" value="<?php echo $Category['sub_cat_name'];?>" maxlength="70"/></td>
            </tr>
            
            <tr>
               <th valign="top">&nbsp;</th>
               <td>&nbsp;</td>
            </tr>
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                  <input type="hidden" name="cat_id" value="<?php echo $cat_id ;?>"  />
                <input type="hidden" name="controller" value="edit_category"  />
                <input type="hidden" name="mod" value="mod_Category"  />
                <input type="button" value="Update" title="Update" name="button" onclick="checkAddCategory();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="Cancel"  title="Cancel" onclick="window.location.href='./index.php?mod=mod_forumcat&view=default&d=2&type=forum'"  style="cursor:pointer;width:70px;height:30px;"/>
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
		