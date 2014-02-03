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
global $model;
$model_upcoming_editupcoming = new model_upcoming_editupcoming();
$getRecord = $model_upcoming_editupcoming->getRecord();
$country_list = $model_upcoming_editupcoming->getCountryList();
//echo "<pre>"; print_r($getRecord); die;
$thumbnail = $config_var->UPLOAD_URL.'upcoming/'.$getRecord[0]['image_name'];

?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_upcoming&view=editupcoming&d=8&id=1" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onsubmit="return checkEditbar();">
	<input type="hidden" id="loadfilesize" name="loadfilesize" value="" />
   <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                       
		<tr><th width="153" valign="top">Country Name<span class="red">*</span> :</th><td>
			<select class="textbox" name="country_name" id="country_name">
				<option value="" >Select Country Name</option>
				<?php for($i = 0;$i<count($country_list);$i++){ ?>
                <option value="<?php echo $country_list[$i]['id']; ?>" <?php if($country_list[$i]['id'] == $getRecord[0]['country_id'] ){?>selected="selected" <?php }?>><?php echo $country_list[$i]['country_name']; ?></option>
				<?php }?>
			</select>
		</td></tr>
		
		
		
		<tr><th width="253" valign="top">Image :</th>
		<td><img src="<?php  echo $thumbnail;?>" alt="Smiley face" ></td>
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
                
				<input type="hidden" name="old_img_name" value="<?php echo $getRecord[0]['image_name'] ;?>"  />
				<input type="hidden" name="controller" value="edit_upcoming"  />
                <input type="submit" value="Update"  title="Update" name="button" onclick="checkEditbar();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="Cancel"  title="Cancel" onclick="window.location.href='./index.php?mod=mod_upcoming&view=default&d=8'"  style="cursor:pointer;width:70px;height:30px;"/>
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
		