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
			
			//$("#"+id+" option[value='']").remove();
		});
});
</script>
<?php 

global $config_var;  
global $model;
global $DataSet;

//config URL 
//$config_var->ADMIN_TPL_URL

  
  if((isset($_REQUEST['video_id']))&&(@$_REQUEST['video_id']!= '')){ 
    
	$video_id = (int)@$_REQUEST['video_id']; 
	
	$model_video_editVideo = new model_video_editVideo();
	$videoList = $model_video_editVideo->getPageData($video_id);
	$countryList = $model_video_editVideo->getCountry();
	$categories = $model_video_editVideo->getCategory();
	$videoData = unserialize($videoList[0]['video_data']);
	//echo "<pre>";
	//print_r($videoList);die;
}         
?>
<!-- Player script-->




<!--
<script type="text/javascript">
	$(document).ready(function(){
	
	jwplayer('mediaplayer').setup({
    'flashplayer': '<?php echo $config_var->WEB_URL; ?>jsApp/jwplayer/player.swf',
    'allowscriptaccess':'never',
    'width': '480',
    'height': '270',
    'file': '<?php echo $config_var->UPLOAD_URL."videos/".$videoData['filename'];?>',
	'viral.allowmenu' : 'false',
							'plugins': {
								 'viral-2': {
								  'onpause': 'false',
									'oncomplete': 'false'
								 }
							  },
	
  });
  
  });
  
</script> -->


<!-- End script-->
<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_video&view=editVideo&video_id=<?php echo $videoList[0]['id'];?>&d=5" method="post" id="editVideoFrm" name="editVideoFrm" enctype="multipart/form-data"  onsubmit="return checkAddWriters();">
    <input type="hidden" id="loadfilesize" name="loadfilesize" value="" />
	<input type="hidden" id="loadimagesize" name="loadimagesize" value="" />
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td style="width:73%;">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
              <th valign="top">Video Title<span class="red">* </span>:</th>
              <td><input type="text"  name="video_name" value="<?php echo $videoList[0]['video_title'];?>"  id="video_name" maxlength="50" class="textbox" style="width:90%;" /></td>
            </tr>
			<tr>
				<th valign="top">Country<span class="red">* </span>:</th>
				<td>
					<select name="country" id="country" class="textbox">
						<option value="">--Select country--</option>
						<?php foreach($countryList as $country){?>
							<option value="<?php echo $country['id']?>" <?php if($country['id']==$videoList[0]['country_id']){?> selected="selected" <?php }?> ><?php echo $country['country_name'];?></option>
						<?php }?>
					</select>
			</tr>
            <tr>
				<th valign="top">Category<span class="red">* </span>:</th>
				<td>
					<select name="category" id="category" class="textbox">
						<option value="">--Select category--</option>
						<?php foreach($categories as $categories){?>
							<option value="<?php echo $categories['id']?>" <?php if($categories['id']==$videoList[0]['category_id']){?> selected="selected" <?php }?> ><?php echo $categories['category_name'];?></option>
						<?php }?>
					</select>
			</tr>
			<tr>
				<th valign="top">Upload Image<span class="red">*</span>:</th>
				<td>
					<?php if($videoList[0]['image']!="")
					{?>
						<img src="<?php echo $config_var->UPLOAD_URL?>videos/images/<?php echo $videoList[0]['image'];?>" height="200" width="200">
					<?php } ?>
					<br>
					Edit Image:<input type="checkbox" value="1" name="editVideoImage" id="editUploadImage" onclick="editshowUpload();">
					<div id="editImage1" style="display:none;">
						<input type="file" id="upload_image" name="upload_image"class="textbox"><br/>
						<span style="color:red;padding-top:2px;">(Max image size 1MB)</span>
					</div>
				</td>
			</tr>
           <tr>
              <th valign="top">Filename<span class="red">* </span>:</th>
              <td><input type="text"  name="video_filename" value="<?php echo $videoList[0]['video_name'];?>"  id="video_name" class="textbox" style="width:90%;margin:0 0 10px 0" readonly="readonly" />
					
					<div id='mediaplayer' style="margin-top:10px;">
					<!--<object width="100%" height="100%"
						type="video/x-ms-asf" url="<?php //echo $config_var->UPLOAD_URL."videos/".$videoData['filename'];?>" data="<?php //echo $config_var->UPLOAD_URL."videos/".$videoData['filename'];?>"
						classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6">
						<param name="url" value="<?php //echo $config_var->UPLOAD_URL."videos/".$videoData['filename'];?>">
						<param name="filename" value="<?php //echo $config_var->UPLOAD_URL."videos/".$videoData['filename'];?>">
						<param name="autostart" value="1">
						<param name="uiMode" value="full">
						<param name="autosize" value="1">
						<param name="playcount" value="1">
						<embed type="application/x-mplayer2" src="<?php //echo $config_var->UPLOAD_URL."videos/".$videoData['filename'];?>" width="700px" height="500px" autostart="true" showcontrols="true" pluginspage="http://www.microsoft.com/Windows/MediaPlayer/"></embed>
					</object>-->
						<div id="page">
			
								<!-- this A tag is where your Flowplayer will be placed. it can be anywhere -->
								<?php
								$new_file = explode("wmv", $videoData['filename']);
								$flvFileName = $new_file[0]."flv" ;
								?>
								<!--<a  
									 href="<?php// echo $config_var->UPLOAD_URL."videos/flv_videos/".$flvFileName;?>"
									 style="display:block;width:500px;height:400px" id="player"> 
								</a>--> 
							
								<!-- this will install flowplayer inside previous A- tag. -->
								<!--<script>
									flowplayer("player", "<?php //echo $config_var->WEB_TPL_URL?>js/flowplayer-3.2.16.swf");
								</script>-->
						<div id="myElement">Loading the player...</div>							
								<script type="text/javascript">
    jwplayer("myElement").setup({
        file: "<?php echo $config_var->UPLOAD_URL."videos/flv_videos/".$flvFileName;?>",
        image: "",
		'width': '500',
         'height': '400'
    });
</script>
								
						</div>
					</div>
			  </td>
			  <td>
				
			  </td>
            </tr>
			<tr>
				<th valign="top">&nbsp;</th>
				<td>
					<div class="">
						<input type="checkbox" id="editVideo" value="1" name="editVideo" onclick="showUpload()"> Change Video
					</div>
					
					<div class="" id="activate_upload"><input class="textbox" type="file" id="upload_video" name="upload_video">
					</br><span style="color:red;padding-top:2px;">(Max video size 500MB)</span>
					</div>
			  </td>
			</tr>
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="edit_video"  />
                <input type="hidden" name="mod" value="mod_video"  />
				<input type="hidden" name="videoImage" value="<?php echo $videoList[0]['image'];?>" />
                <input type="submit" value="Update" title="Update" style="height: 30px;
    width: 70px;" name="button" onclick="return checkEditVideo();" style="cursor:pointer;"/>
                <input type="button" value="Cancel" style="height: 30px;
    width: 70px;" title="Cancel"  onclick="window.location.href='./?mod=mod_video&view=default&m=3'"  style="cursor:pointer;"/>            </td>
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
 
<p id="f1_upload_process" style='color:white;' align='center'>Loading...<br/><img src="<?php echo $config_var->ADMIN_TPL_URL;?>/images/loader.gif" /><br/></p>
<!--<div id="f1_upload_process" style='color:white;' align='center'><div id="my_progress_bar_1" style="position: relative; top: 45%; margin: 0px auto;"></div></div>-->
</div>
	