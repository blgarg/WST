<script type="text/javascript">
$(function(){
$('#upload_video').change(function() {
    var filesize = this.files[0].size ;
	var mb = filesize/(1024*1024) ;
	$("#loadfilesize").val(mb);
});
});
</script>
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
	$model_gallery_editgallery = new model_gallery_editgallery();
	$gallery = $model_gallery_editgallery->getPageData($_REQUEST['cat_id']);
	$country_list=$model_gallery_editgallery->countryList();
	$category_list=$model_gallery_editgallery->categoryList();
	$thumbnail = $config_var->img."/".$gallery['image_thumbnail'];
}   

?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_gallery&view=editgallery&d=5&cat_id=<?php echo $gallery['id'];?>" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onsubmit="return checkEditgallery();">
     <input type="hidden" id="loadfilesize" name="loadfilesize" value="" />
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
         	<tr>
                <th width="153" valign="top">Image Title<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="gallery_title"  id="gallery_title" maxlength="50" class="textbox" value="<?php echo $gallery['image_title'] ;?>"/></td>
            </tr>
		<tr><th width="153" valign="top">Country Name<span class="red">*</span> :</th><td>
			<select class="textbox" name="country_name" id="country_name">
				<option value="" >Select Country Name</option>
				<?php for($i = 0;$i<count($country_list);$i++){ ?>
               <option value="<?php echo $country_list[$i]['id'] ;?>" <?php if($country_list[$i]['id']==$gallery['country_id']){?> selected="selected" <?php }?> ><?php echo $country_list[$i]['country_name'];?></option>
				<?php }?>
			</select>
		</td></tr>
		
		<tr><th width="153" valign="top">Category Name<span class="red">*</span> :</th><td>
			<select class="textbox" name="category_name" id="category_name">
				<option value="" >Select Category Name</option>
				<?php for($i = 0;$i<count($category_list);$i++){ ?>
                <option value="<?php echo $category_list[$i]['id']; ?>" <?php if($category_list[$i]['id']==$gallery['category_id']){ ?> selected="selected" <?php } ?> ><?php echo $category_list[$i]['category_name']; ?></option>
				 
				<?php }?>
			</select>
		</td></tr>
		
		<tr><th width="153" valign="top">Image :</th>
		<td><img src="<?php  echo $thumbnail;?>" alt="Smiley face" height="175" width="175"></td>
		</tr>
	<tr>
				<th valign="top">&nbsp;</th>
				<td>
					<div class="">
						<input type="checkbox" id="editVideo" value="1" name="editImage" onclick="showUpload()"> Change image
					</div>
					<div class="" id="activate_upload"><input class="textbox" type="file" id="upload_video" name="upload_video"></div>
			  </td>
			</tr>
       
          
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                
				<input type="hidden" name="old_img_name" value="<?php echo $gallery['image_thumbnail'] ;?>"  />
				<input type="hidden" name="cat_id" value="<?php echo $gallery['id'] ;?>"  />
                <input type="hidden" name="controller" value="edit_gallery"  />
                <input type="hidden" name="mod" value="mod_gallery"  />
                <input type="button" value="<?php echo UPDATE;?>"  title="Update" name="button" onclick="checkEditgallery();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>"  title="Cancel" onclick="window.location.href='./index.php?mod=mod_gallery&view=default&m=4&d=5'"  style="cursor:pointer;width:70px;height:30px;"/>
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
		