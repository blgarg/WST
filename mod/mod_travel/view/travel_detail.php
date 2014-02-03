<?php global $config_var;?>
</script>
<script src="<?php echo $config_var->WEB_TPL_URL;?>js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/jquery.validate.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $config_var->WEB_TPL_URL;?>css/prettyPhoto.css" type="text/css" media="screen"/>

<?php
global $config_var;  
global $DataSet;
global $model;
$detail = $model->getDetail($_REQUEST['id']);
$countryname = $model->getCountryName($detail[0]['country']);
$type = $model->getTypeName($detail[0]['type']);
if(isset($_GET['id']) && $_GET['id']!='' && $_GET['id']>0)
{
if(is_dir($config_var->UPLOAD_ROOT."travel/".$_GET['id']))
	{
		$list_images = scandir($config_var->UPLOAD_ROOT."travel/".$_GET['id']);
	}
	    $map_image = scandir($config_var->UPLOAD_ROOT."travel_map/".$_GET['id'].'/thumbnails/');
}
?>
<script language="javascript" type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#mycarousel').jcarousel({
			wrap: 'circular'
		});
	});
</script>
 <!--ConTent-->
    <div class="content" style="padding-top:0;">
   		<div class="bar-detail-hdr">
        	<?php 
				  $length = strlen($detail[0]['place_name']);
				    if($length >= 35){
					  echo $barname=substr($detail[0]['place_name'],0,35).'....';
				    }else{
					  echo $detail[0]['place_name'];
					}
			?>
            <div class="back-bar-guide"><a href="?mod=mod_travel&view=default<?php if($_REQUEST['p'] != ""){ echo '&p='.$_REQUEST['p'];} ;?>" title="BACK TO TRAVEL">BACK TO TRAVEL</a></div>
        </div>
        <!--Bar Detail Text-->
        <div class="bar-detail-txt">
		     <div class="bar-detail-row" style="height:auto !important;">
			 <div style="width: 55%; float:left">
				<div id="mapsearch"><img  style="margin-top:13px;width:360px;height:285px;" src="<?php if($detail[0]['thumb_image']!=''){ echo $config_var->UPLOAD_URL."travel/".$detail[0]['thumb_image'];}else{ echo $config_var->UPLOAD_URL."NotAvailable.gif";}?>" alt=""  /></div>	
		      </div>		
			<div style="width:31%;padding-left:504px;">

<div id="mapsearch"> <?php 
for($i=0;$i<count($map_image);$i++){
if($map_image[$i] !== '.' && $map_image[$i] !== '..' && $map_image[$i]!== 'Thumbs.db' && $map_image[$i]!=='thumbnails' && $map_image[$i]!=='files' && $list_images[$i]!=='mapimage'){
?>
 <ul  class="gallery clearfix">
  <a   href="<?php echo $config_var->UPLOAD_URL?>travel_map/<?php echo $_GET['id']?>/<?php echo $map_image[$i];?>" rel="prettyPhoto[gallery1]" >
			<img src="<?php echo $config_var->UPLOAD_URL?>travel_map/<?php echo $_GET['id']?>/thumbnails/<?php echo $map_image[$i]?>"  alt="" title="Click here to Zoom" />
			</a>
			</ul>
			
				<?php } } ?></div>
</div>	
			 </div>
			<div class="bar-detail-row" <?php if($length >= 75){ ?> style="height: 75px;"<?php } ?>>
			<div class="txt-left">Place Name: </div>
                <div class="txt-right"><?php echo $detail[0]['place_name'];?></div>
            </div>
           <div class="bar-detail-row">
            	<div class="txt-left">Country: </div>
                <div class="txt-right"><?php echo $countryname[0]['country_name'];?></div>
            </div>
            <div class="bar-detail-row">
            	<div class="txt-left">City: </div>
                <div class="txt-right"><?php echo $detail[0]['city'];?></div>
            </div>
            <div class="bar-detail-row">
            	<div class="txt-left">Type: </div>
                <div class="txt-right"><?php echo $type[0]['type_name'];?></div>
            </div>
           <div class="bar-detail-row">
            	<div class="txt-left">Address: </div>
                <div class="txt-right"><?php echo $detail[0]['address'];?></div>
            </div>
			<div class="bar-detail-row">
            	<div class="txt-left">Working Hours: </div>
                <div class="txt-right"><?php if($detail[0]['working_hours']!=""){echo $detail[0]['working_hours'];}else{ echo "N.A" ; } ?></div>
            </div>
			<div class="bar-detail-row">
            	<div class="txt-left">Price for Sex: </div>
                <div class="txt-right"><?php if($detail[0]['Price_for_Sex']!=""){echo $detail[0]['Price_for_Sex'];}else{ echo "N.A" ; } ?></div>
            </div>
            <div class="bar-desc-row">
            	<div class="txt-left">Description: </div>
                <div class="txt-right" style="text-align:justify; word-wrap: break-word;">
                	<?php if($detail[0]['description']!=""){echo $detail[0]['description'];}else{ echo "N.A";} ?>
                </div>
            </div>
			<div class="bar-img-slide-row">
             <div class="txt-left">Images: </div> 
			  <div class="clr"></div>
               <div class="img-slider-outer">
			      <div class="img-slider-txt">
                    	<?php if(count($list_images)>3){ ?>
							<?php if(count($list_images)>6){ ?>
						<ul id="mycarousel" class="jcarousel-skin-tango gallery clearfix">
						<?php
						$j=1;
						for($i=0;$i<count($list_images);$i++){
						  if($list_images[$i] !== '.' && $list_images[$i] !== '..' && $list_images[$i]!== 'Thumbs.db' && $list_images[$i]!=='thumbnails' && $list_images[$i]!=='files' && $list_images[$i]!=='mapimage'){?>
							<li>
							<a  href="<?php echo $config_var->UPLOAD_URL?>travel/<?php echo $_GET['id']?>/<?php echo $list_images[$i]?>" rel="prettyPhoto[gallery1]" >
							<img src="<?php echo $config_var->UPLOAD_URL?>travel/<?php echo $_GET['id']?>/<?php echo $list_images[$i]?>" width="134" height="160" alt="" title="<?php echo $list_images[$i];?>" />
							<a>
							</li>
						<?php } $j++;}?>
						</ul>
					<?php	}else{ ?>
					<ul class="gallery clearfix">
						<?php
						for($i=0;$i<count($list_images);$i++){
							if($list_images[$i] !== '.' && $list_images[$i] !== '..' && $list_images[$i]!== 'Thumbs.db' && $list_images[$i]!=='thumbnails' && $list_images[$i]!=='files' && $list_images[$i]!=='mapimage'){?>
							
							<a href="<?php echo $config_var->UPLOAD_URL?>travel/<?php echo $_GET['id']?>/<?php echo $list_images[$i]?>" rel="prettyPhoto[gallery1]">
							<img src="<?php echo $config_var->UPLOAD_URL?>travel/<?php echo $_GET['id']?>/<?php echo $list_images[$i]?>" width="134" height="160" alt="" title="<?php echo $list_images[$i];?>" />
							</a>
							
						<?php }}?>
						<?php } ?>
						</ul>
                    	<?php }else{ ?>
							<div  class="txt-right" style="padding-left:22px;">Images Not Found</div>
							<?php } ?>
					</div>
                </div>
            </div>
		 <div class="clr"></div>
        </div>
        <!--//Bar Detail Text-->
    </div>
     <!--//ConTent-->
<div class="clr"></div>    
</div>
<!--//site wrapper--> 
<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
		  	    $("area[rel^='prettyPhoto']").prettyPhoto();
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		        $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
					custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
					changepicturecallback: function(){ initialize(); }
				});
                $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
					custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
					changepicturecallback: function(){ _bsap.exec(); }
				});
			});
			</script>
			<script src="<?php echo $config_var->WEB_TPL_URL?>js/jquery.jcarousel.min.js" type="text/javascript"></script>