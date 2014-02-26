<?php 
global $config_var;  
global $DataSet;
global $model;
//config URL 
//$config_var->ADMIN_TPL_URL
error_reporting(1);
if(isset($_GET['id']) && $_GET['id']!='' && isset($_GET['img']) && $_GET['img']!='')
{
	$galleryDetail = $model->getData($_GET['id']);
	
	$_SESSION['gallery_id']= $_GET['id'];
	if(is_dir($config_var->UPLOAD_ROOT."images/".$_GET['id']))
	{
		$list_images = scandir($config_var->UPLOAD_ROOT."images/".$_GET['id']);
		
	}
	if(file_exists($config_var->UPLOAD_ROOT."images/".$_GET['id']."/".$_GET['img']))
	$image= $config_var->UPLOAD_URL."images/".$_GET['id']."/".$_GET['img'];
	else
	$images=array();
	$staticRate = $model->calcRating($_GET['id'],$_GET['img']);
}
if(in_array('Thumbs.db',$list_images) && in_array('thumbnails',$list_images))
{
$countImgList = count($list_images)-4;
}
else if(in_array('thumbnails',$list_images))
{
	$countImgList = count($list_images) -3;
}

?>
<script src="jsApp/rating.js" type='text/javascript'></script>
<script src="jsApp/jquery.lightbox_me.js"></script>
<script src="<?php echo $config_var->WEB_TPL_URL;?>js/jquery.jcarousel.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/jquery.jcarousel.min.js" type="text/javascript"></script>

<script>
var image;
var ratingData="";
jQuery(document).ready(function() {

// Close Popup
$(".closePopup").click(function(){
	$("#starRatingGallery").hide();
	$(".js_lb_overlay").remove();
})

$("#starRatingGallery1").css({"height":"33"});
$("#loading").hide();
<?php if($countImgList > 6){?>	
    jQuery('#mycarousel').jcarousel({
    	wrap: 'circular'
    });
<?php }?>	
$('#rate-it').click(function(e) {
	$(".star-rate").show();
	$(".closePopup").show();
	$(".stars").children().removeClass('fullStar');
	$("#starRatingGallery p").remove();
	$('#starRatingGallery').css({"display":"block"});
    
});

// rating
			$('.rate').click(function(e){
				var rateValue = jQuery(this).attr('id');
				//alert(rateValue);
				//$("#starRatingGallery").children().remove();
				image = $("#full_image_id img").attr('title');
				
				$.ajax({
				  type:"POST",
				  cache:false,
				  url: "lib/rating/ratingImage.php",
				  data: {rating:rateValue,user_id:"<?php echo $_SESSION['user_id']?>",gid:"<?php echo $_GET['id'];?>",image:image},
				  dataType:'json',
				  success: function(data){
				  
				  //$('#starRatingGallery').hide;
					var rate = data.rate;
					if(data.error==0)
					{
						ratingData="";
						$("#starRatingGallery1").html(ratingData);
						ratingData +='<div id="starRatingMsg"><div class="closeBox"></div></div>';
						for(var j=1;j<=rate;j++){
							
							ratingData +='<a class="star fullStar" title="'+j+'"></a>';
						}
						
						for(var s=1;s<=5-rate;s++)
						{
							var sum = (s+j)-1;
							ratingData +='<a class="star" title="'+sum+'"></a>';
						}
						    $(".star-rate").hide();
							$(".closePopup").hide();
							$("#starRatingGallery").append('<p style="text-align:center;">'+data.msg+'</p>');
							$("#starRatingGallery").fadeOut(3500,function(){
								$("#starRatingGallery").hide();
								
								$(".js_lb_overlay").remove();
							});
							$("#starRatingGallery1").html(ratingData);
					}
					else
					{
							
							$(".star-rate").hide();
							$(".closePopup").hide();
							$("#starRatingGallery").append('<p id="s" style="text-align:center;">'+data.msg+'</p>');
							$("#starRatingGallery").fadeOut(3500,function(){
								$("#starRatingGallery").hide();
								$(".js_lb_overlay").remove();
							});
					     }	
                      }
				  });	
		      });

$('.rate').mouseover(function() {
				var rateValue = jQuery(this).attr('id');
				var dimStar = 5-rateValue;
				console.log(rateValue);
				for(var k=1;k<=rateValue;k++)
				{
					
					$('#'+k).addClass('fullStar');
				}
			});
			jQuery('.rate').mouseout(function() {
				var rateValue = jQuery(this).attr('id');
				for(var k=1;k<=5;k++)
				{
					
					jQuery('#'+k).removeClass('fullStar');
				}
			});
// When clicking on crousel image
$(".full_image").click(function(){	
	var id =$(this).attr("id");
	  image = $("#"+id+" img").attr("title");
	  width = $("#"+id+" span").attr("width");
	  height = $("#"+id+" span").attr("height");
	  console.log(width+'---'+height);
	$(".container").show();
	$("#starRatingGallery p").remove();
	$.ajax({
		type:"POST",
		cache:false,
		url:"lib/rating/ratingImage.php?mod=getRating",
		data:{gid:"<?php echo $_GET['id'];?>",image:image},
		dataType:'json',
		success:function(data){
			console.log(data);
			if(!isNaN(data))
			{
				$(".album-full-img").html('<center><img style="padding-left:92px;" height="'+height+'" width="'+width+'" src="<?php echo $config_var->UPLOAD_URL?>images/<?php echo $_GET['id'];?>/'+image+'" title="'+image+'" ></center>');
				ratingData="";
				$("#starRatingGallery1").html(ratingData);
				ratingData +='<div id="starRatingMsg">								<div class="closeBox"><a href="javascript:void(0);" id="closeMsg">X</a></div></div>';
				for(var j=1;j<=data;j++){
					ratingData +='<a class="star fullStar" title="'+j+'"></a>';
				}
				for(var s=1;s<=5-data;s++)
				{
					var sum = (s+j)-1;
					ratingData +='<a class="star" title="'+sum+'"></a>';
				}
				
				$("#starRatingGallery").fadeOut(3000,function(){
					$("#starRatingGallery").hide();
					$(".js_lb_overlay").remove();
				})
				$("#starRatingGallery1").html(ratingData);
			}
		}
	});
  });
});
</script>
            <div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL?>images/photos-txt.png" alt="" />
        </div>
        <!--Inner Text-->
        <div class="inner-txt">
			<!--Bar Guide Container--> 
            <div class="bar-guide-con">
            	<div class="b-guide-hdr" style="float:left;">
				<?php 
					$model_gallery_fullDetail = new model_gallery_fullDetail();
					$countryName = $model_gallery_fullDetail->countryName($galleryDetail[0]['country_id']);
			?>
                	 <?php echo $countryName[0]['country_name']; ?>&nbsp;|&nbsp;<?php echo $galleryDetail[0]['image_title'];?>&nbsp;|&nbsp;<?php if(in_array("Thumbs.db",$list_images)){echo count($list_images)-4;}else{ echo count($list_images)-3;}?> photos  
					<a href="?mod=mod_gallery&view=default&s=3" style="float:right; color:#ffffff; padding-right:5px;">Back to Gallery</a>
                    <span style="color:#fff;float:right;">|</span>
					<a href="?mod=mod_gallery&view=detail&s=3&id=<?php echo $_GET['id'];?>" style="float:right; color:#ffffff; padding-right:5px;">Back to Photos</a>
                    
                </div>
                <div class="bar-guide-txt">
                <div class="album-full-img" id="full_image_id">
                <center>
				
		  <?php 
				$image = str_replace($config_var->WEB_URL,'',$image);
				$sizes = getimagesize($image);
				
				$width = $sizes[0];
				$height = $sizes[1];
				
				$sizer = imageResize($width, $height, 700);
				
				function imageResize($width, $height, $target) {
				
					//takes the larger size of the width and height and applies the formula accordingly...this is so this script will work dynamically with any size image

					if ($width > $height) {
					   $percentage = ($target / $width);
					} else {
					   $percentage = ($target / $height);
					}

					//gets the new value and applies the percentage, then rounds the value
					$width = round($width * $percentage);
					$height = round($height * $percentage);

					//returns the new sizes in html image tag format...this is so you can plug this function inside an image tag and just get the

					return "width='$width' height='$height'";

					}
						?>			
						<img  style="padding-left:92px;" id="large_image_id" src="<?php echo $image;?>" title="<?php echo $_GET['img'];?>"  alt="" <?php echo $sizer;?>  />
						</div>
						</center>
					</div>
                    
                    <div class="popup" id="starRatingGallery" style="display:none;">
						<div class="closePopup"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/cross-circle.png" alt=""/></div>

						<div class="star-rate" style="width:95px;margin-left:20px;">Rate this Image</div>
						<div class="star-rate" id="star-rate11">
							<?php for($i=1;$i<=5;$i++){?>
							<a class="star rate" id="<?php echo $i?>" title="<?php echo $i?>"></a>
						<?php }?>
						</div>
					</div>
                        <div id="starRatingGallery1" class="rate-photo">
						<div id="starRatingMsg">
						</div>
						<?php for($i=1;$i<=$staticRate;$i++){?>
							<a class="star fullStar" title="<?php echo $i?>"></a>
						<?php }
						for($j=1;$j<=5-$staticRate;$j++){?>
						<a class="star" title="<?php echo $j+$i-1?>"></a>
						<?php }?>
                    </div>
					<a href="javascript:void(0);" id="rate-it" style="position:relative; top:-48px; left:483px;"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/rate-it.png"></a>
					<div id="loading" >Loading...</div>
				<?php 
				
				if($countImgList > 6){?>	
				   <div class="album-img-slider">
                    	<ul id="mycarousel" class="jcarousel-skin-tango">
						<?php
						for($i=2;$i<count($list_images);$i++){
							if($list_images[$i] !== '.' && $list_images[$i] !== '..' && $list_images[$i]!== 'Thumbs.db' && $list_images[$i]!=='thumbnails'){?>
							<li><a href="javascript:void(0);" class="full_image" id="full_image_<?php echo $i;?>">
							<?php
							$image = str_replace($config_var->WEB_URL,'',$config_var->UPLOAD_URL.'images/'.$_GET['id'].'/'.$list_images[$i]);
							$sizes = getimagesize($image);
							$width = $sizes[0];
							$height = $sizes[1];
							
							$sizer = imageResize($width, $height, 700);
							?>
							
							<img src="<?php echo $config_var->UPLOAD_URL?>images/<?php echo $_GET['id']?>/thumbnails/<?php echo $list_images[$i]?>" width="120" height="160" alt="" title="<?php echo $list_images[$i];?>"/><span <?php echo $sizer; ?> style="display:hide;"><?php echo $image; ?></span></a></li>
							
						<?php }}?>
						</ul>
					</div>
                  <?php }else{ ?>  
				  <div class="album-img-slider" style="width:850px;margin-left:70px;">
					<div class="album-img-slider-txt">
                        <?php for($i=0;$i < (count($list_images));$i++){
							if($list_images[$i] !== '.' && $list_images[$i] !== '..' && $list_images[$i]!== 'Thumbs.db' && $list_images[$i]!=='thumbnails'){
										
							$image = str_replace($config_var->WEB_URL,'',$config_var->UPLOAD_URL.'images/'.$_GET['id'].'/'.$list_images[$i]);
							$sizes = getimagesize($image);
							$width = $sizes[0];
							$height = $sizes[1];
							$sizer = imageResize($width, $height, 700);
						?>
							<div class="img">
								<a href="javascript:void(0);" class="full_image" id="full_image_<?php echo $i;?>"><img src="<?php echo $config_var->UPLOAD_URL?>images/<?php echo $_GET['id']?>/thumbnails/<?php echo $list_images[$i]?>" width="120" height="160" alt="" title="<?php echo $list_images[$i];?>"/><span <?php echo $sizer; ?> style="display:hide;"><?php //echo $image; ?></span></a>
							</div>
                         <?php }}?>   
                        </div>
				  </div>
				  <?php }?>
                
                </div>
            </div>
			 <!--//Bar Guide Container--> 
           <div class="clr"></div>
        </div>
        <!--//Inner Text-->
        		
	<div style="float:left;width:100%;">
	
