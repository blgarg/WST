<?php 
global $config_var;  
global $DataSet;
global $model;

$getVideoCountry = $model->getCountry($DataSet['result'][0]['country_id']);
$getVideoCategory = $model->getCategory($DataSet['result'][0]['category_id']);
$video_detail = unserialize($DataSet['result'][0]['video_data']);
$staticRate = $model->calcRating($_GET['id']);

if(count($DataSet['result'])==0)
{
	@header("Location:".$config_var->WEB_URL."?mod=mod_video");
	die;
}
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery.noConflict();
	// Close Popup
jQuery(".closePopup").click(function(){
	jQuery("#starRatingGallery").hide();
	jQuery("#mediaplayer").show();
	jQuery(".js_lb_overlay").remove();
});
	jQuery('#rate-it').click(function(e) {
	jQuery('#starRatingGallery').css({"display":"block"});
	jQuery("#mediaplayer").hide();
	jQuery(".star-rate").show();
	jQuery(".closePopup").show();
	jQuery(".stars").children().removeClass('fullStar');
	jQuery("#starRatingGallery p").remove();
    /*jQuery('#starRatingGallery').lightbox_me({
        centered: true 
        });*/
    e.preventDefault();
	});
            //$('.container').rating();
			jQuery('.rate').mouseover(function() {
				var rateValue = jQuery(this).attr('id');
				var dimStar = 5-rateValue;
				console.log(rateValue);
				for(var k=1;k<=rateValue;k++)
				{
					
					jQuery('#'+k).addClass('fullStar');
				}
			});
			jQuery('.rate').mouseout(function() {
				var rateValue = jQuery(this).attr('id');
				//var dimStar = 5-rateValue;
				//console.log(rateValue);
				for(var k=1;k<=5;k++)
				{
					jQuery('#'+k).removeClass('fullStar');
				}
			});
			jQuery('.rate').click(function(e){
				var rateValue = jQuery(this).attr('id');
				//alert(rateValue);
				
				
				jQuery.ajax({
				  url: "lib/rating/rating.php?r="+rateValue+"&vid=<?php echo $DataSet['result'][0]['id'];?>&user_id=<?php echo $_SESSION['user_id']?>",
				  dataType:'json',
				  success: function(data) {
					var ratingData;
					ratingData="";
						
						if(data.error==0)
						{
							//for(var j=0;j<data.rate;j++){
								//ratingData.='<div class="star fullStar" title="'+j+'"></a>';
							//}
							
								ratingData="";
								jQuery("#starRatingGallery1").html(ratingData);
								for(var j=1;j<=data.rate;j++){
									ratingData +='<a class="star fullStar" title="'+j+'"></a>';
								}
								for(var s=1;s<=5-data.rate;s++)
								{
									var sum = (s+j)-1;
									ratingData +='<a class="star" title="'+sum+'"></a>';
								}
								
								//jQuery(".container").hide();
								jQuery(".star-rate").hide();
								jQuery(".closePopup").hide();
								jQuery("#starRatingGallery").append('<p style="text-align:center!important;">'+data.msg+'</p>');
								jQuery("#starRatingGallery").fadeOut(3500,function(){
									jQuery("#starRatingGallery").hide();
									jQuery(".js_lb_overlay").remove();
									jQuery("#mediaplayer").show();
								})
								
								//$("#starRatingGallery1").css({"height":"100"});
								jQuery("#starRatingGallery1").html(ratingData);
						}
						else
						{
							//jQuery(".container").hide();
							jQuery(".star-rate").hide();
							jQuery(".closePopup").hide();
							jQuery("#starRatingGallery").append('<p id="s" style="text-align:center!important;">'+data.msg+'</p>');
							jQuery("#starRatingGallery").fadeOut(3500,function(){
								
								jQuery("#starRatingGallery").hide();
								jQuery(".js_lb_overlay").remove();
								jQuery("#mediaplayer").show();
								
							});
							
						}
					}  
				});
				
				
			});
 });						
</script>
<script type="text/javascript" language="javascript">
function showHide() {
    var ele = document.getElementById("showHideDiv");
    if(ele.style.display == "block") {
            ele.style.display = "none";
      }
    else {
        ele.style.display = "block";
    }
}
</script>
						<style>
						.fsSubmitButton
{
padding: 10px 15px 11px !important;
font-size: 18px !important;
background-color: goldenRod;
font-weight: bold;

color: #ffffff;
border-radius: 5px;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border: 1px solid goldenRod;
cursor: pointer;
box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
-moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
-webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
}

.fsSubmitButton2
{
padding: 6px 20px 11px !important;
font-size: 10px !important;
background-color: goldenRod;
font-weight: bold;
text-shadow: 1px 1px goldenRod;
color: #ffffff;
border-radius: 100px;

border: 1px solid goldenRod;
cursor: pointer;
box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
-moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
-webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5) inset;
}
						</style>
		<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/videos-txt.png" alt="" />
        </div>
        
        <!--Inner Text-->
        <div class="inner-txt">
			
           
           <!--Bar Guide Container--> 
            <div class="bar-guide-con">
            	<div class="b-guide-hdr" style="float:left; ">
                	<?php echo $getVideoCountry['country_name'];?>&nbsp;|&nbsp;<?php echo $DataSet['result'][0]['video_title'];?>
                    
                    <a href="?mod=mod_video&view=default" style="float:right; color:#ffffff; padding-right:5px;">Back to Videos</a>
                </div>
                <div class="bar-guide-txt">
                
                	<div class="album-full-img" id="full_image_id" style="height:400px;">
                    	
						<div id='mediaplayer' style="margin-top:10px;">
						<!--<object width="100%" height="100%"
							type="video/x-ms-asf" url="<?php echo $config_var->UPLOAD_URL."videos/".$video_detail['filename'];?>" data="<?php //echo $config_var->UPLOAD_URL."videos/".$video_detail['filename'];?>"
							classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6">
							<param name="url" value="<?php //echo $config_var->UPLOAD_URL."videos/".$video_detail['filename'];?>">
							<param name="filename" value="<?php //echo $config_var->UPLOAD_URL."videos/".$video_detail['filename'];?>">
							<param name="autostart" value="1">
							<param name="uiMode" value="full">
							<param name="autosize" value="1">
							<param name="playcount" value="1">
							<embed type="application/x-mplayer2" src="<?php //echo $config_var->UPLOAD_URL."videos/".$video_detail['filename'];?>" width="100%" height="100%" autostart="true" showcontrols="true" pluginspage="http://www.microsoft.com/Windows/MediaPlayer/"></embed>
						</object>-->
						
							<!-- Update on july23 2011 -->
					<?php
							    $new_file = explode("wmv", $video_detail['filename']);
								$flvFileName = $new_file[0]."flv" ;
								?>
					<div id="myElement">Loading the player...</div>							
						<script type="text/javascript">
    jwplayer("myElement").setup({
        file: "<?php echo $config_var->UPLOAD_URL."videos/flv_videos/".$flvFileName;?>",
        image: "",
		'width': '900',
        'height': '400'
    });
                  </script>
							<div id="page">
								
								<!-- this A tag is where your Flowplayer will be placed. it can be anywhere -->
								<!--<a  
									 href="<?php //echo $config_var->UPLOAD_URL."videos/flv_videos/".$flvFileName;?>"
									 style="display:block;width:900px;height:400px" id="player"> 
								</a> -->
							
								<!-- this will install flowplayer inside previous A- tag. -->
								<!--<script>
									flowplayer("player", "<?php //echo $config_var->WEB_TPL_URL?>js/flowplayer-3.2.16.swf");
								</script>-->
								
							</div>

						</div>
					</div>
                    <div class="popup" id="starRatingGallery" style="display:none;">
                    	<div class="closePopup"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/cross-circle.png" alt=""/></div>
						<div class="star-rate" style="width:95px;margin-left:20px;">Rate this Video</div>
						<div class="star-rate">
							<?php for($i=1;$i<=5;$i++){?>
							<a class="star rate" id="<?php echo $i?>" title="<?php echo $i?>"></a>
						<?php }?>
						</div>
						
						
                    </div>
					<div id="starRatingGallery1" class="rate-photo" style="float:left;">
						<?php for($i=1;$i<=$staticRate;$i++){?>
							<a class="star fullStar" title="<?php echo $i?>"></a>
						<?php }
						for($j=1;$j<=5-$staticRate;$j++){?>
						<a class="star" title="<?php echo $j+$i-1?>"></a>
						<?php }?>
						&nbsp;	
						
					</div>
					<a href="javascript:void(0);" id="rate-it" style="position:relative; top:-35px; left:483px;"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/rate-it.png"></a>	
					<!--<div id="rateStar">
						<a href="javascript:void(0);" id="rate-it">Rate It</a>
					</div>-->
					<div class="rateMsg" style="display:none;">
					</div>
					<div>
						<?php 
					$type_size = unserialize($DataSet['result'][0]['video_data']);
					//print_r($DataSet['result'][0]['video_name']);
					?>
						<div style="float:left; width:70%;">
							<table style="padding-left: 30px; text-align:left;">
								<tr style="font-size:15pt; color:goldenRod; text-align:center !important;"><th colspan="2">Video Details</th></tr>
								<tr>
									<th>Video Title		:-</th><td> <?php echo ucfirst($DataSet['result'][0]['video_title']);?></td>
								</tr>
								<tr>
									<th>Video Name		:-</th><td><?php echo $DataSet['result'][0]['video_name'];?></td>
								</tr>
								<tr>
									<th>File Size		:-</th><td><?php $size = $type_size['size']/(1024*1024);
																		echo $size = number_format($size, 2, '.', '');	?> MB</td>
								</tr>
								<tr>
									<th>File Format		:-</th><td><?php echo $type_size['type'];?></td>
								</tr>
								<tr>
									<th>Country			:- </th><td><?php echo $getVideoCountry['country_name'];  ?></td>
								</tr>
								<tr>
									<th>Category		:- </th><td><?php echo $getVideoCategory['category_name']; ?></td>
								</tr>
							</table>
						</div>
						<!--<div style="float:left;">
						<form action="<?php echo $config_var->WEB_URL ?>download.php" method="post" name="downloadform">
							  <input name="download_video" value="<?php echo $video_detail['filename'];?>" type="hidden">
							  <input name="video_name" value="<?php echo $DataSet['result'][0]['video_name'];?>" type="hidden">
							 <input type="submit" style="width: 200px; height: 45px; font-size: 16pt;" value="Download Video" > 
						</form>
						</div>-->

												<div style="float:left;">
						<input type="submit" class="fsSubmitButton" style="width: 200px; height: 45px; font-size: 16pt;" value="Download Video" onclick="return showHide();" />
						
						<div id="showHideDiv" style="display:none;">
                           <div class="area1"><br>
						      <form action="<?php echo $config_var->WEB_URL ?>download.php" method="post" name="downloadform">
							  
							   <input name="download_video" value="<?php echo $video_detail['filename'];?>" type="hidden">
							  <input name="video_name" value="<?php echo $DataSet['result'][0]['video_name'];?>" type="hidden">
							 <input class="fsSubmitButton2" type="submit" style="width: 136px; height: 26px; font-size: 8pt;" value="Download as WMV" > 
							  </form>
							  
							<!-- Download FLV -->

                              <form action="<?php echo $config_var->WEB_URL ?>downloadflv.php" method="post" name="downloadform">
							  <?php  $withoutExt = pathinfo($video_detail['filename'], PATHINFO_FILENAME);?>
							  <input name="flvDownload_video" value="<?php echo $withoutExt.'.flv';?>" type="hidden">
							  <?php  $withoutExtName = pathinfo($DataSet['result'][0]['video_name'], PATHINFO_FILENAME);?>
							  <input name="flvVideo_name" value="<?php echo $withoutExtName.'.flv';?>" type="hidden">
							  <input class="fsSubmitButton2" type="submit" style="width: 136px; height: 26px; font-size: 8pt;" value="Download as FLV" > 
							  </form>
							  
                             <!-- Download Mp4 -->

                              <form action="<?php echo $config_var->WEB_URL ?>downloadmp4.php" method="post" name="downloadform">
							  <?php  $withoutExt = pathinfo($video_detail['filename'], PATHINFO_FILENAME);?>
							  <input name="flvDownload_video" value="<?php echo $withoutExt.'.flv';?>" type="hidden">
							  <?php  $withoutExtName = pathinfo($DataSet['result'][0]['video_name'], PATHINFO_FILENAME);?>
							  <input name="flvVideo_name" value="<?php echo $withoutExtName.'.flv';?>" type="hidden">
							  <input class="fsSubmitButton2" type="submit" style="width: 136px; height: 26px; font-size: 8pt;" value="Download as Mp4" > 
							  </form>	
							  
                           </div>
                       </div>
						
						</div>
					</div>
					
                </div>
            </div>
			 <!--//Bar Guide Container--> 

</div>
            
          <div class="clr"></div>
        </div>
        <!--//Inner Text-->
        		
	<div style="float:left;width:100%;">
	
