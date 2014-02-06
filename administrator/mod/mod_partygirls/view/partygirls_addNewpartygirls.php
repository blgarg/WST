<script type="text/javascript">
$(function(){
$('#image_load').change(function() {
    var filesize = this.files[0].size ;
	var mb = filesize/(1024*1024) ;
	$("#loadfilesize").val(mb);
});
});
</script>
<?php 
global $config_var;  
global $DataSet;

include("$config_var->ADMIN_ROOT"."ckeditor/ckeditor.php");
$config['toolbar'] = array(
	array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	array( 'Image', 'Link', 'Unlink', 'Anchor' )
);
$config['skin'] = 'v2';
//echo "<pre>"; print_r($_REQUEST); die;
$country_list=model_partygirls_addNewpartygirls::countryList();
$category_list=model_partygirls_addNewpartygirls::categoryList();
//echo "<pre>"; print_r($country_list); die;
?>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_partygirls&view=addNewpartygirls&m=4" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkAddgallery();" >
    <input type="hidden" id="loadfilesize" name="loadfilesize" value="" />
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th width="153" valign="top">Gallery Title<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="gallery_title"  id="gallery_title" maxlength="50" class="textbox"/></td>
            </tr>
		<tr><th width="153" valign="top">Country Name<span class="red">*</span> :</th><td>
			<select class="textbox" name="country_name" id="country_name">
				<option value="" >Select Country Name</option>
				<?php for($i = 0;$i<count($country_list);$i++){ ?>
                <option value="<?php echo $country_list[$i]['id']; ?>" ><?php echo $country_list[$i]['country_name']; ?></option>
				<?php }?>
			</select>
		</td></tr>
		
		<tr><th width="153" valign="top">Category Name<span class="red">*</span> :</th><td>
			<select class="textbox" name="category_name" id="category_name">
				<option value="" >Select Category Name</option>
				<?php for($i = 0;$i<count($category_list);$i++){ ?>
                <option value="<?php echo $category_list[$i]['id']; ?>" ><?php echo $category_list[$i]['category_name']; ?></option>
				<?php }?>
			</select>
		</td></tr>
		<tr><th width="153" valign="top">Upload Image<span class="red">*</span> :</th>
		<td><input class="textbox" type="file" id="image_load" name="image_load" /></td>
		</tr>
	        
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_new_partygirls"  />
                <input type="hidden" name="mod" value="mod_partygirls"  />
             <input type="button" value="<?php echo SAVE;?>"  title="Save" name="button" onclick="checkAddgallery();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>" title="Cancel" onclick="window.location.href='./?mod=mod_partygirls&view=default&m=4'"  style="cursor:pointer;width:70px;height:30px;"/>          </td>
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
		