<?php
global $config_var;
global $model;
$model_joinus_default = new model_joinus_default();
$recentImages = $model->getRecentImages();
$topVideos = $model->mostRatedVideos();
?>
<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/membership-signup-txt.png" alt="" />
        </div>
    	<!--Content Text-->
    	<div class="content-txt">
           <!--Home Con-->
            <div class="home-con">
              <div class="home-lt">
                	<!--Models Around-->
                	<div class="home-rt-txt">
                    	<div class="home-rt-hdr">Models around the World</div>
                        <?php foreach($recentImages as $images){ ?>
                        <div class="pop-img">
                        	<div class="img"><img src="<?php echo $config_var->UPLOAD_URL;?>images/front_end/<?php echo $images['image_thumbnail']?>" alt="" width="100" height="130" /></div>
                            <?php if(is_dir($config_var->UPLOAD_ROOT."images/".$images['id']))
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
								 $length = strlen($images['image_title']);
							   if($length >= 20){
							       $barname=substr($images['image_title'],0,20).'....';
							       echo "<br>".$modelNameUpper = strtoupper($barname);
							   }else{
							       echo "<br>".$modelNameUpper = strtoupper($images['image_title']);
							   }		 
						   $countryNamesAll = $model->getCountryNameById($images['country_id']);
						  
						  echo "<br>".$countryNamesAll[0]['country_name']; 
							//echo "<br>".$country_name[0]['country_name'];
								echo "</br>".$cnt ;
								}else {echo "</br>0";} echo " Photos"; ?>
                        </div>
                        <?php }?>
                    </div>
                   <!--//Models Around--> 
                   
                   <!--Mship Join-->
                   <div class="mship-join">
                       By Joining Worldsextraveler.Com, <br />
                       you will have full access to all of our <br />
                        <font>Full Length Videos &amp; Pics!</font>
                        
                       	<p></p>
                        	<div class="mship-join-txt">
                            	<div class="mship-price">Recurring<br/>
                                	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/1month-price.png" alt="" />
                                </div>
                                <a href="<?php echo $config_var->WEB_URL;?>?mod=mod_joinus&view=signup&join=1&s=6" title="Join"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/join-btn.png" alt="" /></a>
                            </div>
                            <div class="mship-join-txt">
                            	<div class="mship-price">Recurring<br/>
                                	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/3month-price.png" alt="" />
                                </div>
                                <a href="<?php echo $config_var->WEB_URL;?>?mod=mod_joinus&view=signup&join=2&s=6" title="Join"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/join-btn.png" alt="" /></a>
                            </div>
                            
                             <div class="mship-join-txt">
                            	<div class="mship-price">Non-recurring<br/>
                                	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/6month-price.png" alt="" />
                                </div>
                                <a href="<?php echo $config_var->WEB_URL;?>?mod=mod_joinus&view=signup&join=3&s=6" title="Join"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/join-btn.png" alt="" /></a>
                            </div>
							 <div> For billing support</div>
                        <div style=" text-align: center;  color: #6F7777; font-size: 17px;">
				Please visit <a href="http://www.epoch.com" target="_blank" style="color:background !important;" >EPOCH.COM</a>, our authorized sales agent.
				One and or three month memberships re-bill at their
				initial price either monthly or every 3 months 
				respectively if not canceled.
			</div>
			 </div>
                   <!--//Mship Join-->
                 </div>
                <!--Home page Right Side-->
                <div class="home-rt">
                	<div class="home-rt-txt">
                    	<div class="home-rt-hdr">Top Rated Videos</div>
                        <?php foreach($topVideos as $videos){?>
                        <div class="video">
                        	<img alt="" src="<?php echo $config_var->UPLOAD_URL;?>videos/images/<?php echo $videos['image']?>">
							<?php 
							 $length = strlen($videos['video_title']);
							   if($length >= 20){
							       $videoName=substr($videos['video_title'],0,20).'....';
							       echo "<br>".$modelNameUpper = strtoupper($videoName);
							   }else{
							       echo "<br>".$modelNameUpper = strtoupper($videos['video_title']);
							   }
							  // $countryNamesAll = $model->getCountryNameById($videos['country_id']);
						          // echo "<br>".$countryNamesAll[0]['country_name']; 
							   ?>
						</div>
						<?php }?>
                     </div>
                </div>
                <!--//Home page Right Side-->
                <!--Additional Feau-->
                   <div class="additional-feau">
                   		<div class="add-feau-hdr">Additional features as a benefit of joining:</div>
                        <div class="bar-guide">
                        	<h3>Bar Guide</h3>
                            <div class="bar-guide-img"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/bar-guide1.jpg" alt="" /></div>
                        </div>
                        <div class="bar-guide">
                        	<h3>Tour Guide</h3>
                            <div class="bar-guide-img"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/bar-guide2.jpg" alt="" /></div>
                        </div>
                        
                        <div class="bar-guide m-r-none">
                        	<h3>Forum</h3>
                            <div class="bar-guide-img"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/bar-guide3.jpg" alt="" /></div>
                        </div>
                   </div>
                  <!--//Additional Feau-->
            
            </div>
            <!--//Home Con-->
        </div>
        <!--//Content Text-->
 </div>
     <!--//ConTent-->
	
<div class="clr"></div>    
</div>