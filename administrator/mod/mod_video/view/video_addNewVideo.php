<style>
#f1_upload_process{
  background-color: black;
  position: fixed;
  top: 0; right: 0; bottom: 0; left: 0;
  opacity: 0.5; /* also -moz-opacity, etc. */
  z-index: 99999999;
 padding-top: 250px;
 display:none;
}
</style>
<script type="text/javascript">
$(function(){
$('#upload_video').change(function() {
    var filesize = this.files[0].size ;
	var mb = filesize/(1024*1024) ;
	$("#loadfilesize").val(mb);
});
$('#upload_image').change(function(){
var imagesize = this.files[0].size ;
var sizemb = imagesize/(1024*1024) ;
$("#loadimagesize").val(sizemb);
});
$("select").each(function() {
	         
	        // Keep track of the selected option.
	        //alert($(this).val());
			var id = $(this).attr('id');
			var selectedValue = $(this).val();	 
	        // Sort all the options by text. I could easily sort these by val.
	        $(this).html($("option", $(this)).sort(function(a, b) {
	            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
	        }));
	 
	        // Select one option.
	        $(this).val(selectedValue);
			/*$("#"+id+" option[value='']").remove();
			alert
			if(id=="category"){
				$("#"+id).prependTo("<option value=''>Select Category</option>");
			}*/
			//$("#"+id+" option[value='']").remove();
		});
});
</script>
<?php 
global $config_var;  
global $DataSet;
global $model;
//config URL 
//$config_var->ADMIN_TPL_URL
$model_video_addVideo = new model_video_addNewVideo();
$countryList = $model_video_addVideo->getCountry();
$categories = $model_video_addVideo->getCategory();

?>

<style type="text/css">

</style>
<script type="text/javascript">

</script>
<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_video&view=addNewVideo&m=4" method="post" id="addVideoFrm" name="adddPageFrm" enctype="multipart/form-data" onsubmit="return checkAddVideo();" >
    <input type="hidden" id="loadfilesize" name="loadfilesize" value="" />
	<input type="hidden" id="loadimagesize" name="loadimagesize" value="" />
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
              <th valign="top">Video Name<span class="red">* </span>:</th>
              <td><input type="text"  name="video_name"   id="video_name" maxlength="50" class="textbox"/></td>
            </tr>

            <tr>
              <th valign="top">Country<span class="red">* </span>:</th>
              <td>
				<select name="country" id="country" class="textbox">
					<option value="">--Select country--</option>
					<?php foreach($countryList as $list){?>
					<option value="<?php echo $list['id']?>"><?php echo $list['country_name']?></option>
					<?php }?>
				</select>
            </tr>
            
			<tr>
              <th valign="top">Category<span class="red">*</span> :</th>
              <td>
				<select name="category" id="category" class="textbox">
					<option value="">--Select category--</option>
					<?php foreach($categories as $categories){?>
					<option value="<?php echo $categories['id']?>"><?php echo $categories['category_name']?></option>
					<?php }?>
				</select>
			  
            </tr>
			<tr>
				<th valign="top">Upload Image<span class="red">*</span>:</th>
				<td>
					<input type="file" id="upload_image" name="upload_image"class="textbox"><br/>
					<span style="color:red;padding-top:2px;">(Max image size 1MB)</span>
				</td>
			</tr>
            <tr>
				<th valign="top">Upload Video<span class="red">*</span>:</th>
				<td>
					<input type="file" id="upload_video" name="upload_video"class="textbox"><br/>
					<img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/load.gif" style="display:none;" id="loader"   alt=""  /><span style="color:red;padding-top:2px;">(Max video size 500MB)</span>
				</td>
			</tr>
			
			
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_new_video"  />
                <input type="hidden" name="mod" value="mod_video"  />
                <input type="submit" value="Save" style="height: 30px;
    width: 70px;cursor:pointer;" title="Save" name="button" onclick="checkAddVideo();" />
                <input type="button" style="height: 30px;
    width: 70px;"value="Cancel" title="Cancel"  onclick="window.location.href='./?mod=mod_video&view=default&m=3'"  style="cursor:pointer;"/>            </td>
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
 <p id="f1_upload_process" style='color:white;' align='center'>Loading...<br/><img src="<?php echo $config_var->ADMIN_TPL_URL;?>/images/loader.gif" /><br/></p>

</div>
		