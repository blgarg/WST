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
$country_list=model_bar_addNewbar::countryList();
$type_list = model_bar_addNewbar::typeList();
$category_list=model_bar_addNewbar::categoryList();
//echo "<pre>"; print_r($country_list); die;
?>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_bar&view=addNewbar&m=4" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onSubmit="return checkAddbar();" >
    <input type="hidden" id="loadfilesize" name="loadfilesize" value="" />
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th width="153" valign="top">Bar Name<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="bar_name"  id="bar_name" maxlength="100" class="textbox"/></td>
            </tr>
			 <tr>
                <th width="153" valign="top">Web Site :</th>
              <td width="558"><input type="text"  name="site_name"  id="site_name" maxlength="100" class="textbox"/></td>
            </tr>
			<tr><th width="153" valign="top">Bar Type<span class="red">*</span> :</th><td>
			<select class="textbox" name="bar_type" id="bar_type">
				<option value="0" >Select Bar Type</option>
				<?php for($i = 0;$i<count($type_list);$i++){ ?>
                <option value="<?php echo $type_list[$i]['id']; ?>" ><?php echo $type_list[$i]['type_name']; ?></option>
				<?php }?>
			</select>
		</td></tr>
		
		<tr>
                <th width="153" valign="top">Bar Address<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="bar_address"  id="bar_address" maxlength="100" class="textbox"/></td>
        </tr>
		
		<tr><th width="153" valign="top">Country Name<span class="red">*</span> :</th><td>
			<select class="textbox" name="country_name" id="country_name">
				<option value="0" >Select Country Name</option>
				<?php for($i = 0;$i<count($country_list);$i++){ ?>
                <option value="<?php echo $country_list[$i]['id']; ?>" ><?php echo $country_list[$i]['country_name']; ?></option>
				<?php }?>
			</select>
		</td></tr>
		
		<tr>
                <th width="153" valign="top">Bar City<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="bar_city"  id="bar_city" maxlength="50" class="textbox"/></td>
        </tr>
		
		<tr>
                <th width="153" valign="top">Working Hours:</th>
              <td width="558"><input type="text"  name="working_hours"  id="working_hours" maxlength="100" class="textbox"/></td>
        </tr>
		
		<tr>
                <th width="153" valign="top">No of staff:</th>
              <td width="558"><input type="text"  name="no_of_staff"  id="no_of_staff" maxlength="50" class="textbox"/></td>
        </tr>
		
		<tr>
                <th width="153" valign="top">facilities:</th>
              <td width="558"><input type="text"  name="facilities"  id="facilities" maxlength="100" class="textbox"/></td>
        </tr>
		<tr>
                <th width="153" valign="top">Price for Sex:</th>
              <td width="558"><input type="text"  name="Price_for_Sex"  id="Price_for_Sex" maxlength="100" class="textbox"/></td>
        </tr>
		
		<tr>
                <th width="153" valign="top">Bar Description :</th>
              <td width="558"><textarea name="bar_Desc"  id="bar_Desc" class="textarea" > </textarea></td>
        </tr>
		
		<tr><th width="153" valign="top">Rating:</th><td>
			<select class="textbox" name="Rating" id="Rating">
			<option value="">Select Rating</option>
				<?php 
				for($j=1; $j<=5; $j++)
				{
				?>
				  <option value="<?php echo $j; ?>" <?php if($j==$bar['rate']){ ?>selected="selected" <?php } ?> ><?php echo $j; ?></option>
				<?php
				}
				
				?>
                
			</select>
		</td></tr>
		
		<tr><th width="153" valign="top">Upload Image:</th>
		<td><input class="textbox" type="file" id="image_load" name="image_load" /></td>
		</tr>
	  
		
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_new_bar"  />
                <input type="hidden" name="mod" value="mod_bar"  />
             <input type="submit" value="<?php echo SAVE;?>" title="Save" name="button" onclick="checkAddbar();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="<?php echo CANCEL;?>" title="Cancel" onclick="window.location.href='./?mod=mod_bar&view=default&m=4'"  style="cursor:pointer;width:70px;height:30px;"/>          </td>
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
		