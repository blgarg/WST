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
//echo "<pre>"; print_r($_REQUEST); die;
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
	$model_bar_editbar = new model_bar_editbar();
	$bar = $model_bar_editbar->getPageData($_REQUEST['cat_id']);
	//echo "<pre>"; print_r($bar); die;
	$country_list=$model_bar_editbar->countryList();
	$type_list = model_bar_editbar::typeList(); 
	$thumbnail = $config_var->bar_img."/".$bar['image_name'];
}   
//print_r($bar);
?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_bar&view=editbar&d=5&cat_id=<?php echo $bar['id'];?>" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onsubmit="return checkEditbar();">
	<input type="hidden" id="loadfilesize" name="loadfilesize" value="" />
   <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                       <tr>
                <th width="153" valign="top">Bar Name<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="bar_name"  id="bar_name" maxlength="100" class="textbox" value="<?php echo $bar['bar_name'] ;?>"/></td>
            </tr>
			<tr>
                <th width="153" valign="top">Web Site :</th>
              <td width="558"><input type="text"  name="site_name"  id="site_name" maxlength="100" class="textbox"/></td>
            </tr>
			<tr><th width="153" valign="top">Bar Type<span class="red">*</span> :</th><td>
			<select class="textbox" name="bar_type" id="bar_type">
				<option value="" >Select Bar Type</option>
				<?php for($i = 0;$i<count($type_list);$i++){ ?>
                <option value="<?php echo $type_list[$i]['id']; ?>" <?php if($type_list[$i]['id'] == $bar['bar_type']){?> selected="selected" <?php } ?>><?php echo $type_list[$i]['type_name']; ?></option>
				<?php }?>
			</select>
		</td></tr>
		
		<tr>
                <th width="153" valign="top">Bar Address<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="bar_address"  id="bar_address" maxlength="100" class="textbox" value="<?php echo $bar['bar_address'] ;?>"/></td>
        </tr>
		
		<tr><th width="153" valign="top">Country Name<span class="red">*</span> :</th><td>
			<select class="textbox" name="country_name" id="country_name">
				<option value="" >Select Country Name</option>
				<?php for($i = 0;$i<count($country_list);$i++){ ?>
                <option value="<?php echo $country_list[$i]['id']; ?>" <?php if($country_list[$i]['id'] == $bar['bar_country'] ){?>selected="selected" <?php }?>><?php echo $country_list[$i]['country_name']; ?></option>
				<?php }?>
			</select>
		</td></tr>
		
		<tr>
                <th width="153" valign="top">Bar City<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="bar_city"  id="bar_city" maxlength="50" class="textbox" value="<?php echo $bar['bar_city'] ;?>"/></td>
        </tr>
		
		<tr>
                <th width="153" valign="top">Working Hours:</th>
              <td width="558"><input type="text"  name="working_hours"  id="working_hours" maxlength="150" class="textbox" value="<?php echo $bar['working_hours']; ?>"/></td>
        </tr>
		
		<tr>
                <th width="153" valign="top">No of staff:</th>
              <td width="558"><input type="text"  name="no_of_staff"  id="no_of_staff" maxlength="50" class="textbox" value="<?php echo $bar['no_of_staff'] ;?>"/></td>
        </tr>
		
		<tr>
                <th width="153" valign="top">facilities:</th>
              <td width="558"><input type="text"  name="facilities"  id="facilities" maxlength="100" class="textbox" value="<?php echo $bar['facilities'] ;?>"/></td>
        </tr>
		<tr>
                <th width="153" valign="top">Price for Sex:</th>
              <td width="558"><input type="text"  name="Price_for_Sex"  id="Price_for_Sex" maxlength="100" class="textbox" value="<?php echo $bar['Price_for_Sex'] ;?>"/></td>
        </tr>
		
		<tr>
                <th width="153" valign="top">Bar Description:</th>
              <td width="558"><textarea name="bar_Desc"  id="bar_Desc" class="textarea"> <?php echo $bar['bar_desc']; ?></textarea></td>
        </tr>
		
		<tr><th width="153" valign="top">Rating:</th><td>
			<select class="textbox" name="Rating" id="Rating">
				<option value="" >Select Rating</option>
				<?php 
				for($j=1; $j<=5; $j++)
				{
				?>
				  <option value="<?php echo $j; ?>" <?php if($j==$bar['rate']){ ?> selected="selected"<?php } ?> ><?php echo $j; ?></option>
				<?php
				}
				
				?>
                
			</select>
		</td></tr>
		
		
		<tr><th width="153" valign="top">Image :</th>
		<td><img src="<?php  echo $thumbnail;?>" alt="Smiley face" height="100" width="100"></td>
		</tr>
	<tr>
				<th valign="top">&nbsp;</th>
				<td>
					<div class="">
						<input type="checkbox" id="editVideo" value="1" name="editImage" onclick="showUpload()"> Change image
					</div>
					<div class="" id="activate_upload"><input class="textbox" id="image_load"  type="file" name="upload_video"></div>
			  </td>
			</tr>
       
          
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                
				<input type="hidden" name="old_img_name" value="<?php echo $bar['image_name'] ;?>"  />
				<input type="hidden" name="cat_id" value="<?php echo $bar['id'] ;?>"  />
                <input type="hidden" name="controller" value="edit_bar"  />
                <input type="hidden" name="mod" value="mod_bar"  />
                <input type="submit" value="Update"  title="Update" name="button" onclick="checkEditbar();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="Cancel"  title="Cancel" onclick="window.location.href='./index.php?mod=mod_bar&view=default&m=4&d=5'"  style="cursor:pointer;width:70px;height:30px;"/>
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
		