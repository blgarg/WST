<script type="text/javascript">
$(function(){
$('#upload_image').change(function() {
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


  
  if((isset($_REQUEST['t_id']))&&(@$_REQUEST['t_id']!= '')){ 
	$model_travel_editTravel = new model_travel_editTravel();
	$travel = $model_travel_editTravel->getPageData($_REQUEST['t_id']);
	$country_list=$model_travel_editTravel->countryList();
	$type_list=$model_travel_editTravel->typeList();
}   

?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_travel&view=editTravel&d=5&t_id=<?php echo $travel['id'];?>" method="post" id="adddPageFrm" name="adddPageFrm" enctype="multipart/form-data"  onsubmit="return checkEditTravel();">
	<input type="hidden" id="loadfilesize" name="loadfilesize" value="" />
   <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td>
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th width="153" valign="top">Place name<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="place_name"  id="place_name" maxlength="50" class="textbox" value="<?php echo $travel['place_name'] ;?>"/></td>
            </tr>
			<tr>
                <th width="153" valign="top">Address<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="address"  id="address" maxlength="100" class="textbox" value="<?php echo $travel['address'] ;?>"/></td>
            </tr>
			<tr>
                <th width="153" valign="top">City<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="city"  id="city" maxlength="100" class="textbox" value="<?php echo $travel['city'] ;?>"/></td>
            </tr>
		<tr><th width="153" valign="top">Country Name<span class="red">*</span> :</th><td>
			<select class="textbox" name="country_name" id="country_name">
				<option value="" >Select Country Name</option>
				<?php for($i = 0;$i<count($country_list);$i++){ ?>
               <option value="<?php echo $country_list[$i]['id'] ;?>" <?php if($country_list[$i]['id']==$travel['country']){?> selected="selected" <?php }?> ><?php echo $country_list[$i]['country_name'];?></option>
				<?php }?>
			</select>
		</td></tr>
		
		<tr><th width="153" valign="top">Type Name<span class="red">*</span> :</th><td>
			<select class="textbox" name="type" id="type">
				<option value="" >Select Type Name</option>
				<?php foreach($type_list as $list){ ?>
                <option value="<?php echo $list['id']; ?>" <?php if($list['id']==$travel['type']){ ?> selected="selected" <?php } ?> ><?php echo $list['type_name']; ?></option>
				 
				<?php }?>
			</select>
		</td></tr>
		<tr>
              <th width="153" valign="top">Working hours<span class="red">*</span> :</th>
              <td width="558"><input type="text"  name="working_hours"  id="working_hours" maxlength="150" class="textbox" value="<?php echo $travel['working_hours'] ;?>"/></td>
        </tr>
		<tr>
              <th width="153" valign="top">Price for Sex:</th>
              <td width="558"><input type="text"  name="Price_for_Sex"  id="Price_for_Sex" maxlength="100" class="textbox" value="<?php echo $travel['Price_for_Sex'] ;?>"/></td>
        </tr>
		<tr>
              <th width="153" valign="top">Description :</th>
              <td width="558"><textarea name="description"><?php echo @$travel['description'];?></textarea></td>
        </tr>
		<tr><th width="153" valign="top">Image :</th>
		<td><img src="<?php  echo $config_var->UPLOAD_URL;?>travel/thumbs/<?php echo $travel['thumb_image']?>" alt="Smiley face" height="100" width="100"></td>
		</tr>
	<tr>
				<th valign="top">&nbsp;</th>
				<td>
					<div class="">
						<input type="checkbox" id="editVideo" value="1" name="editTravel" onclick="showUpload()"> Change Image
					</div>
					<div class="" id="activate_upload"><input class="textbox" type="file" id="upload_image" name="upload_image"></div>
			  </td>
			</tr>
       
          
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                
				<input type="hidden" name="old_img_name" value="<?php echo $travel['thumb_image'] ;?>"  />
				<input type="hidden" name="t_id" value="<?php echo $travel['id'] ;?>"  />
                <input type="hidden" name="controller" value="edit_travel"  />
                <input type="hidden" name="mod" value="mod_travel"  />
                <input type="submit" value="Update" title="Update" name="button" onclick="checkEditTravel();" style="cursor:pointer;width:70px;height:30px;"/>
                <input type="button" value="Cancel"  title="Cancel" onclick="window.location.href='./index.php?mod=mod_travel&view=default&d=6'"  style="cursor:pointer;width:70px;height:30px;"/>
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
		