<script>
$(function(){
		$("#barguidep p").each(function(){
			$(this).css("margin","0px");
		});
		$("#travelguidep p").each(function(){
			$(this).css("margin","0px");
		});
	});
</script>
<?php
global $config_var;
global $model;
if(!isset($_REQUEST['form']) || $_REQUEST['form'] ==''){
	header("Location: /wst/");
}else{
$_SESSION['views']=$_REQUEST['form']; 
}
$getRecentImages = $model->getRecentImages();
$getRecentVideos = $model->getRecentVideos();
$mostRates = $model->mostRatedVideos();
$countries = $model->getCountryList();
$tourheader =$model->getTourHeader();
$upcomingData =$model->upcomingData();
?>
<!--Content Text-->
    	<div class="inner-hdr t-align-c">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/welcome-txt2.png" alt="" />
        </div>
    	<!--Content Text-->
    	<div class="content-txt" style="padding-bottom:6px;">
        <!--Home Con-->
            <div class="home-con">
            <div class="home-lt">
                	<!--Coming Updates-->
                    <div class="coming-updates">
                    	<div class="coming-updates-lt">
                        	<img width="100%" height="163px" src="<?php echo $config_var->UPLOAD_URL.'upcoming/'.$upcomingData[0]['image_name']; ?>" alt="" />
                        </div>
                        <div class="coming-updates-rt">
                        	Enjoy our photos and videos of sexy girls from all over the world. Use our Travel 
                            Guide and Bar Guide when planning your next sex travel adventure. We are dedicated 
                            to providing our members up to date information. Please send us your comments and suggestions.
                        
                        </div>
                    </div>
                    <!--//Coming Updates-->
                <!--Recent Photos-->
                	<div class="r-photos">
                    	<div class="r-photos-hdr">Recent Photos</div>
                        <!--Photos Row-->
                        <div class="r-photos-outer">
                        <?php $i=1;foreach($getRecentImages as $images){?>
							<div class="r-photos-img">
                            	<div class="r-photos-box">
                                	<a href="<?php echo $config_var->FRONT_ROOT?>?mod=mod_gallery&view=detail&s=3&id=<?php echo $images['id'];?>"><img src="<?php echo $config_var->UPLOAD_URL?>images/front_end/<?php echo $images['image_thumbnail']?>" alt="" width="150" height="200" /></a>
                                </div>
                                 <?php //echo $images['image_title'];
								 $length = strlen($images['image_title']);
							   if($length >= 20){
							     $barname=substr($images['image_title'],0,15).'....';
							     echo $modelNameUpper = strtoupper($barname);
							   }else{
							  
							    echo $modelNameUpper = strtoupper($images['image_title']);
							   }
								if(is_dir($config_var->UPLOAD_ROOT."images/".$images['id']))
								 {
									$countFiles = scandir($config_var->UPLOAD_ROOT."images/".$images['id']);
									$cnt=0;foreach($countFiles as $img){
										if($img != "." && $img != ".." && $img != "thumbnails" && $img != "thumbs.db")
										{
				
										$ext = explode(".",$img);
										if($ext['1'] == "jpg" || $ext['1'] == "png" ||$ext['1'] == "gif")
										$cnt++ ;
										}
				                }
							$countryNames = $model->getCountryName($images['country_id']);
							echo "<br>".$countryNames[0]['country_name']; 
							//echo "<br>".$country_name[0]['country_name'];
								echo "<br>".$cnt. "&nbsp;Pics" ;
								}else {echo "</br>"."0 Pics";}  ?>
									</span>
                            </div>
                            <?php 
							if($i%4==0 && count($getRecentImages)>4)
							{
								echo '</div><div class="r-photos-outer">';
							}
							$i++;}?>
                        </div>
                        <!--//Photos Row-->
                    </div>
                    <!--//Recent Photos-->
                    <div class="gap-20"></div>
                    <!--Recent Videos-->
               <div class="fj-models mt-30">
             	<div class="fj-models-hdr">Recent Videos</div>
                        <!--Videos Row-->
                        <div class="videos-row">
						<?php 
						 $k=0;
						$j=1;foreach($getRecentVideos as $videos){?>
                            <div class="video-outer">
                                <div class="video">
								<a href="<?php echo $config_var->WEB_URL?>?mod=mod_video&view=detail&id=<?php echo $videos['id'];?>">
									<img alt="" width="210" height="156" src="<?php echo $config_var->UPLOAD_URL?>videos/images/<?php echo $videos['image']?>"></div>
                                </a>
								
								<?php //echo $images['image_title'];
								 $length = strlen($videos['video_title']);
							   if($length >= 20){
							     $barname=substr($videos['video_title'],0,15).'....';
							     echo $modelNameUpper = strtoupper($barname);
							   }else{
							  
							 echo $modelNameUpper = strtoupper($videos['video_title']);
							   }
							  $countryNamesNow = $model->getCountryName($videos['country_id']);
							  
							echo "<br>".$countryNamesNow[0]['country_name']; 
								?>
                      </div>
                            <?php 
							if($j%3==0 && count($videos)>3)
							{
								echo '</div><div class="videos-row">';
							}
							$j++;
							$k++;
							}?>
                          </div>
                        <!--//Videos Row-->
					</div>
           </div>
			<!--Home page Right Side-->
                <div class="home-rt">
                	<div class="quick-menu">
                    	<div class="quick-menu-hdr">Quick Menu</div>
                        	<ul>
								<?php foreach($countries as $clist){?>
                            	<li><a href="<?php echo $config_var->WEB_URL?>?mod=mod_gallery&view=default&s=3&country=<?php echo $clist['id']?>"><?php echo $clist['country_name']?></a></li>
								<?php }?>
                            </ul>
                    </div>
                    <div class="home-rt-txt">
                    	<div class="home-rt-hdr">Most Popular Videos</div>
                        <?php foreach($mostRates as $list){?>
                        <div class="video">
							<a href="?mod=mod_video&view=detail&id=<?php echo $list['id'];?>">
                        	<img alt="<?php echo $videos['image'];?>" src="<?php echo $config_var->UPLOAD_URL?>videos/images/<?php echo $list['image'];?>" width="225" height="164">
							</a>
							<?php 
							 $length = strlen($list['video_title']);
							   if($length >= 20){
							       $videoName=substr($list['video_title'],0,15).'....';
							       echo "<br>".$modelNameUpper = strtoupper($videoName);
							   }else{
							       echo "<br>".$modelNameUpper = strtoupper($list['video_title']);
							   }
							    $countryNamesAll = $model->getCountryName($list['country_id']);
						  
						         echo "<br>".$countryNamesAll[0]['country_name']; 
							   ?>
                        </div>
						<?php }?>
                    </div>
                    <div class="home-rt-txt">
                    	<div class="home-rt-hdr">Most Popular Photos</div>
                        <?php for($i=0;$i<6;$i++){
								if($getRecentImages[$i]['image_thumbnail']!=''){
						?>
							<div class="pop-img">
								<div class="img">
								<a href="<?php echo $config_var->FRONT_ROOT?>?mod=mod_gallery&view=detail&s=3&id=<?php echo $getRecentImages[$i]['id'];?>">
								<img src="<?php echo $config_var->UPLOAD_URL?>images/front_end/<?php echo $getRecentImages[$i]['image_thumbnail']?>" alt="" width="240" height="130" /></a>
							</div>
								<?php if(is_dir($config_var->UPLOAD_ROOT."images/".$getRecentImages[$i]['id']))
								 {
									$countFiles = scandir($config_var->UPLOAD_ROOT."images/".$getRecentImages[$i]['id']);
									$cnt=0;foreach($countFiles as $img){
										if($img != "." && $img != ".." && $img != "thumbnails" && $img != "thumbs.db")
										{
				                         $ext = explode(".",$img);
										if($ext['1'] == "jpg" || $ext['1'] == "png" ||$ext['1'] == "gif")
										$cnt++ ;
										}
									// End loop
								}	
                              $length = strlen($getRecentImages[$i]['image_title']);
							   if($length >= 20){
							       $imageName=substr($getRecentImages[$i]['image_title'],0,15).'....';
							       echo "<br>".$modelNameUpper = strtoupper($imageName);
							   }else{
							       echo "<br>".$modelNameUpper = strtoupper($getRecentImages[$i]['image_title']);
							   }
							    $countryNamesAll = $model->getCountryName($getRecentImages[$i]['country_id']);
						        echo "<br>".$countryNamesAll[0]['country_name']; 
								 echo "<br>".$cnt;
								 }else{echo  "<br>"."0";}?>
									Photos
							</div> 
                        <?php }//if($i%2==0 && count($getRecentImages)>2){
							//echo '</div><div class="pop-img">';
						//}
						}?>
                     </div>
                   </div>
                <!--//Home page Right Side-->
                <!--Member Features-->
                <div class="member-feau-outer">
                    <div class="member-feau-hdr"><img src="<?php echo $config_var->WEB_TPL_URL?>images/wst-guide-txt.png" alt="" /></div>
                    <div class="member-feau-con fl">
                        <div class="member-feau-txt-hdr">Travel Guide</div>
                        <div class="member-feau-txt">
                            <div class="img"><img src="<?php echo $config_var->WEB_TPL_URL?>images/travel-guide-img1.jpg" alt="" /></div>
                            <span id="travelguidep" style="text-align:justify;">
                               <?php echo strip_tags($tourheader[0]['page_content']); ?>
                            </span>
                        </div>
                     </div>
                    <div class="member-feau-con fr">
                        <div class="member-feau-txt-hdr">Bar Guide</div>
                        <div class="member-feau-txt">
                            <div class="img"><img src="<?php echo $config_var->WEB_TPL_URL?>images/travel-guide-img2.jpg" alt="" /></div>
                            <span id="barguidep" style="text-align:justify;">
							<?php echo strip_tags($tourheader[1]['page_content']); ?>
                            </span>
                        </div>
                     </div>
                </div>
              <!--//Member Features-->
            </div>
            <!--//Home Con-->
        </div>
		<div style="font-size: 18px; text-align: center;" >
		  <div style=" text-align: center; color: #6F7777; font-size: 17px;font-weight: bold;">
For billing support please visit 
<a style="color:background !important;" target="_blank" href="http://www.epoch.com">EPOCH.COM</a>
, our authorized sales agent. One and or three month memberships re-bill at their initial price either monthly or every 3 months respectively if not canceled.
</div></div>
	<!--<div style="font-size: 18px; text-align: center;" >
				If you have questions regarding billing, please visit <a href="https://epoch.com/billingsupport" target="_blank" style="color:background !important;" >EPOCH.COM</a> our authorized sales agent.    
			</div>-->
        <!--//Content Text-->
    </div>
     <!--//ConTent-->
	
