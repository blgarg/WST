<script  src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyATTaZ15HmsPONHJtN7Sm9EtGHfqY4LMcA"
type="text/javascript">
</script>
<script  src="http://www.google.com/uds/api?file=uds.js&v=1.0&key=AIzaSyATTaZ15HmsPONHJtN7Sm9EtGHfqY4LMcA"
type="text/javascript">
</script>
<?php
echo $config_var->WEB_TPL_URL;
global $config_var;
global $model;
if(isset($_GET['id']) && $_GET['id']!='' && $_GET['id']>0)
{
	$barData = $model->getBarDetail($_GET['id']);
	//echo "<pre>"; print_r($barData[0]['image_name']); die;

	if(is_dir($config_var->UPLOAD_ROOT."bar_images/".$_GET['id']))
	{
		$list_images = scandir($config_var->UPLOAD_ROOT."bar_images/".$_GET['id']);
	}
}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		 jQuery('#mycarousel').jcarousel({
			wrap: 'circular',
			
			scroll:3
		});
	});
</script>

<div class="bar-detail-hdr">
  	<?php 
						   $length = strlen($barData[0]['bar_name']);
						   if($length >= 35){
						 echo  $barname=substr($barData[0]['bar_name'],0,35).'....';
						   }else{
						   echo $barData[0]['bar_name'];
						   }
						   ?>
    <div class="back-bar-guide"><a href="?mod=mod_barguide&view=default<?php if($_REQUEST['p'] != ""){ echo '&p='.$_REQUEST['p'];} ;?>" title="BACK TO BAR GUIDE">Back TO BAR GUIDE</a></div>
</div>

<div class="bar-detail-txt">
<div style="width: 55%; float:left">
  <img style="border: 2px solid LightSalmon;height:285px;width:360px" src="<?php if($barData[0]['image_name']!=''){ echo $config_var->UPLOAD_URL."bar_images/".$barData[0]['image_name'];}else{ echo $config_var->UPLOAD_URL."NotAvailable.gif";}?>" alt=""  />
</div>

<div style="width:45%; float:right">
   <?php $address= $barData[0]['bar_address'].' ,'.$barData[0]['bar_city'].' ,'.$barData[0]['country_name']; 
?>

<style>
#mapsearch {
width : 530px;
margin-left: -147px;
padding: 4px;
border : 1px solid #f9f9f9;
}
.gsmsc-idleMapDiv{
height:320px;
}
</style>
<script>
function LoadMapSearch() {
var options = {
title : "Googleplex",
url : "http://www.google.com/corporate/index.html"
}
new GSmapSearchControl(
document.getElementById("mapsearch"),
"<?php echo $address; ?>",
options
);
}
GSearch.setOnLoadCallback(LoadMapSearch);
</script>

<div id="mapsearch">Loading Location<img src="<?php echo $config_var->UPLOAD_URL."images/loader.gif"?>" alt=""  /></div>
</div>
<!--<div class="bar-detail-row" style="height:auto !important;">-->
	</div><br/>
        	<div class="bar-detail-row">
            	<div class="txt-left">Country: </div> 
                <div class="txt-right"><?php echo $barData[0]['country_name'];?></div>
            </div>
            <div class="bar-detail-row">
            	<div class="txt-left">City: </div>
                <div class="txt-right"><?php echo $barData[0]['bar_city'];?></div>
            </div>
            <div class="bar-detail-row">
            	<div class="txt-left">Type: </div>
                <div class="txt-right"><?php echo $barData[0]['type_name'];?></div>
            </div>
            <div class="bar-detail-row" <?php if($length >= 75){ ?> style="height: 75px;"<?php } ?>>
            	<div class="txt-left">Name: </div>
                <div class="txt-right"><?php echo $barData[0]['bar_name'];?></div>
            </div>
            <div class="bar-detail-row">
            	<div class="txt-left">Address: </div>
                <div class="txt-right"><?php echo $barData[0]['bar_address'];?></div>
            </div>
           <div class="bar-detail-row">
            	<div class="txt-left">Website: </div>
                <div class="txt-right"><?php if($barData[0]['web_site']!=""){ 
				$address=$barData[0]['web_site'];
				echo '<a href=http://'.$address.' target="_blank">'.$barData[0]['web_site'].'</a>';}else{echo "N.A";}?></div>
            </div>
            <div class="bar-detail-row">
            	<div class="txt-left">Working Hours: </div>
                <div class="txt-right"><?php if($barData[0]['working_hours']!=""){ echo $barData[0]['working_hours'];}else{ echo "N.A"; }?></div>
            </div>
            <div class="bar-detail-row">
            	<div class="txt-left">No of Staff: </div>
                <div class="txt-right"><?php if($barData[0]['no_of_staff']!=""){echo $barData[0]['no_of_staff'];}else{ echo "N.A";}?></div>
            </div>
            <div class="bar-desc-row">
            	<div class="txt-left">Bar Description: </div>
                <div class="txt-right" style="text-align: justify; word-wrap: break-word;">
                	<?php if($barData[0]['bar_desc']!=""){ echo $barData[0]['bar_desc']; }else{ echo "N.A";} ?>
                </div>
            </div>
             <div class="bar-detail-row">
            	<div class="txt-left">Facilities: </div>
                <div class="txt-right"><?php if($barData[0]['facilities']!=""){echo $barData[0]['facilities'];}else{echo "N.A";}?></div>
            </div>
			<div class="bar-detail-row">
            	<div class="txt-left">Price for Sex: </div>
                <div class="txt-right"><?php if($barData[0]['Price_for_Sex']!=""){echo $barData[0]['Price_for_Sex'];}else{echo "N.A";}?></div>
            </div>
             <div class="bar-detail-row">
            	<div class="txt-left">Rating: </div>
                <div class="txt-right">
				<?php if($barData[0]['rate']!=""){ ?>
					<?php $rate = $barData[0]['rate'];
					 for($i=0;$i<$rate;$i++){?>
                	<img style="padding-top: 9px;" src="<?php echo $config_var->WEB_TPL_URL;?>images/star-yellow.png"  alt="" />
                    <?php } }else{ echo "N.A";}?>
					
               </div>
            </div>
            
          <!--<div class="bar-img-slide-row">
            	<div class="txt-left">Images: </div>
            <div class="img-slider-outer">
             
                    <div class="img-slider-txt">
                     <?php if(count($list_images)>3){ ?>
						<?php if(count($list_images)>6){ ?>
						<ul id="mycarousel" class="jcarousel-skin-tango">
						<?php
						for($i=0;$i<count($list_images);$i++){
							if($list_images[$i] !== '.' && $list_images[$i] !== '..' && $list_images[$i]!== 'Thumbs.db' && $list_images[$i]!=='thumbnails' && $list_images[$i]!=='files'){?>
							<!--<li><img src="<?php echo $config_var->UPLOAD_URL?>bar_images/<?php echo $_GET['id']?>/<?php echo $list_images[$i]?>" width="170" height="160" alt="" title="<?php echo $list_images[$i];?>" /></li>-->
							
						<!--<?php }}?>
						</ul>
					<?php	}else{ ?>
						<?php
						for($i=0;$i<count($list_images);$i++){
							if($list_images[$i] !== '.' && $list_images[$i] !== '..' && $list_images[$i]!== 'Thumbs.db' && $list_images[$i]!=='thumbnails' && $list_images[$i]!=='files'){?>
							<img src="<?php echo $config_var->UPLOAD_URL?>bar_images/<?php echo $_GET['id']?>/<?php echo $list_images[$i]?>" width="170" height="140" alt="" title="<?php echo $list_images[$i];?>" />
							
						<?php }}?>
						<?php } ?>
                    	
							<?php }else{ ?>
							<div  class="txt-right" style="padding-left:22px;">Images Not Found</div>
							<?php } ?>
					
                    
                    </div>
                  
                </div>
            </div>-->
                 <div class="bar-img-slide-row">
            	<div class="txt-left">Images: </div>
            <div class="img-slider-outer_test">
                	 <div class="img-slider-txt_test">
                    	<ul id="mycarousel_test" class="jcarousel-skin-tango">
						<?php
						#{ '40/1315233481_resized.jpg': { caption: '1' }}
						$scrl_img = '{';
						for($i=0;$i<count($list_images);$i++){
							if($list_images[$i] !== '.' && $list_images[$i] !== '..' && $list_images[$i]!== 'Thumbs.db' && $list_images[$i]!=='thumbnails' && $list_images[$i]!=='files'){?>
							<!--<li><img src="<?php 
							  $temp_str = "'".$_GET['id']."/".$list_images[$i]."': { caption: '".$i."' },";
							  $scrl_img.=$temp_str;
							  echo $config_var->UPLOAD_URL?>bar_images/<?php echo $_GET['id']?>/<?php echo $list_images[$i]?>" width="170" height="160" alt="" title="<?php echo $list_images[$i];?>" /></li>-->
						<?php 
							}
						}
						$scrl_img = $scrl_img."}";
						$scrl_img = str_replace('},}', '}}', $scrl_img);
					    //$scrl_img = "{'40/1315233481_resized.jpg': { caption: '2' },'40/IMG_4522.jpg': { caption: '3' },'40/IMG_4523.jpg': { caption: '4' },'40/IMG_4523.jpg': { caption: '4' }}";
						?>
						<script type="text/javascript" language="javascript">
        window.addEvent('domready', function(){
            var data = <?php echo $scrl_img; ?>;

			new Slideshow('overlap', data, {  delay: 3000, height: 250, hu: '<?php echo $config_var->UPLOAD_URL?>bar_images/', width: 398 });
		});
  </script>
    <div id="overlap" class="slideshow">
		<?php if($list_images<>'' && $scrl_img<>'{}') {?>
		<img src="<?php echo $scrl_img; ?>" >
		<?php } else {
		  echo "No Image Found!";
		  }
		?>
	</div>	   
</ul>
					</div>
                  </div>
            </div>
            
          <div class="clr"></div>
       </div>
	   
	   
	   
	   
	  