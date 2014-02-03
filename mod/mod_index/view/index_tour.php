<?php 
if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')
	{
		@header("Location:?mod=mod_index&view=home&form=agree&s=1");
		die;
	}
	global $model;
	global $config_var;
	$images = $model->getRecentImages();
	$videos = $model-> getRecentVideos();
	$id='100000000000455';
	if(is_dir($config_var->UPLOAD_ROOT."images/".$id))
	  $tourImages = scandir($config_var->UPLOAD_ROOT."images/".$id);
	else
	  $tourImages = array();
?>
 <script>
	function link()
	{
		window.location='<?php echo $config_var->WEB_URL?>?mod=mod_joinus&view=default&s=6';
	}
 </script>
 <?php $tourheader =$model->getTourHeader();
   $tourTitle =$model->getTourCms();
   ?>
   <title><?php echo $tourTitle[0]['page_title'];?></title>
 
 <div class="content" style="padding-top:0;">
   	<div class="inner-hdr t-align-c">
       <img src="<?php echo $config_var->WEB_TPL_URL?>images/welcome-txt.png" alt="" />
        </div>
    	<!--Content Text-->
    	<div class="content-txt">
            
            <div class="img-slider-outer">
            	<div class="img-slider">
				<!--<img style="height:241px;width:537px;" src="<?php //echo $config_var->WEB_TPL_URL?>test.php" alt="A Random Image" /> -->
                	<img src="<?php echo $config_var->WEB_TPL_URL?>images/h-img1.jpg" alt="" />
				</div>
                <div class="h-txt">
				 <?php $srtingData=$tourTitle[0]['page_content'];
				echo  preg_replace(array('/\s{3,}/', '/[\t\n]/'),'  ', $srtingData);
				?>
                </div>
            </div>
            <div class="join-new-btn">
                	<a href="<?php echo $config_var->WEB_URL;?>?mod=mod_joinus&view=default&s=6">Join Now to See More of These Featured Models</a>
             </div>
             <div class="f-models">
             	<div class="f-models-hdr">Featured Models</div>
                <!--Models Image Outer Row-->
			<div class="models-img-outer" onclick="window.location='<?php echo $config_var->WEB_URL?>?mod=mod_joinus&view=default&s=6'">
		<?php	
					$j=0;
					$i=1;
	function getRandomFromArray($ar) {
	$sent = $ar;
    mt_srand( (double)microtime() * 1000000 ); // php 4.2+ not needed
    $num = array_rand($sent);
	$rnd_img = $ar[$num];
	     return $rnd_img;
	 }
	     $img_arry = array();
	     $limit = 15;
	
    foreach ($tourImages as $ind=>$rnd_img)
	{
		if($rnd_img =="" || $rnd_img =='Thumbs.db' || $rnd_img=='..' || $rnd_img =='thumbnail' || $rnd_img == 'thumbnails' || $rnd_img =='.' || $rnd_img =='thumbs'){
			unset($tourImages[$ind]);
		}
	}
	$x=true;
	$cnt = 0;
	while($x){
		$rnd_img = getRandomFromArray($tourImages);
		if(!in_array($rnd_img,$img_arry)){
			$img_arry[] = $rnd_img;
		}
		if(count($img_arry)==$limit){
			$x=false;
		}
	}
	        $tourImages = $img_arry;
	           foreach ($tourImages as $data) 
					{
					 if ($j == $limit) {
						  break;
                     }elseif(count($tourImages)<$limit){
						if($j == count($tourImages)){	
						  break;
						}
					}
					$rnd_img = $data;
					?>
					<div class="models-img">
                    	<div class="models-img-box">
                          <!--<img src="<?php// echo $config_var->WEB_TPL_URL?>images/f-m1.jpg" alt="" />-->
							<!--<img  height="200" width="150" src="<?php //echo $config_var->UPLOAD_URL."images/front_end/".$data['image_thumbnail']; ?>" alt="" />-->
							<img style="height:200;width:150;" src="<?php echo $config_var->WEB_URL?>uploads/images/100000000000455/thumbnails/<?php 
							//$rnd_img = getRandomFromArray($tourImages);
							echo $rnd_img;?>" alt="A Random Image" />
							
                        </div>
                        <?php 
						//echo getRandomFromArray($tourImages); 
						$nowString    = pathinfo($rnd_img, PATHINFO_FILENAME);
                        $rnd_img      = explode("0" , rtrim($nowString, "1"));
                        $nowData      = $rnd_img[0];
						$expData      = explode("(" , rtrim($nowString, ")"));
						$getModelName = explode('-',$nowString);
					    echo strtoupper($getModelName[0]);
						//Ftech Country Names
						$domain = strstr($nowString, '-');
						$countryName= explode('-',$domain);
                        echo "<br>";
						 if($countryName[1]=="Thai") {
						   echo "Thailand";
						 }elseif($countryName[1]=="Mex") {
						   echo "Mexico"; 
						 }elseif ($countryName[1]=="Cam"){
						   echo "Cambodia";
						 }elseif ($countryName[1]=="PI"){
                           echo "Philippines";						 
						 }elseif ($countryName[1] == "DR"){
						   echo 'Dominican Republic';
						 }elseif($countryName[1] =="CR") {
                            echo 'Costa Rica';	
                         }elseif($countryName[1] =="Vn"){
                            echo "Vietnam";	
					     }elseif($countryName[1] =="laos"){
                            echo "Laos";	
                         }else{
                          echo  "Cambodia";
                         }			
						?>					  
						<span>
						<?php 
							/*echo $config_var->UPLOAD_URL."images/".$DataSet['result'][$j]['id'] ;
								 if(is_dir($config_var->UPLOAD_ROOT."images/".$data['id']))
								 {
									$countFiles = scandir($config_var->UPLOAD_ROOT."images/".$data['id']);
									$cnt=0;foreach($countFiles as $img){
										if($img != "." && $img != ".." && $img != "thumbnails" && $img != "thumbs.db")
										{
				                        $ext = explode(".",$img);
										if($ext['1'] == "jpg" || $ext['1'] == "png" ||$ext['1'] == "gif")
										$cnt++ ;
										
										}
				                    }
								//echo $cnt ;
								}else {<echo "0";} echo " images";*/ ?>
									</span>
                    </div>
                   <?php 
					if($i%5==0 && count($images)>5)
						{
							echo '</div><div class="models-img-outer" onclick="link();">';
						}
					$i++;
					 
					$j++;}?>
                </div>
				<!--//Models Image Outer Row-->
             </div>
             <div class="inner-hdr t-align-c mt-20">
                <img alt="" src="<?php echo $config_var->WEB_TPL_URL?>images/see-sexy-girls-txt.png" alt=""/>
            </div>
         <div class="f-models mt-30">
             	<div class="f-models-hdr">Hardcore Videos</div>
                
                <!--Models Image Outer Row-->
                <div class="models-img-outer">
                	<?php	foreach ($videos as $data) {?>
                	<div class="models-video">
				      <span><?php echo $data['video_title'];?></span>
                        <div class="video">
                        	<img height="280" width="460" onclick="link();" src="<?php echo $config_var->UPLOAD_URL."videos/images/".$data['image']; ?>" alt="" />
                        </div>
					</div>
                    <?php } ?>
                </div>
                <!--//Models Image Outer Row-->
             </div>
             <!--Party Girls Start Here-->
              <div class="inner-hdr t-align-c mt-20">
                <img alt="" src="<?php echo $config_var->WEB_TPL_URL?>images/see-party-girls-txt.png" alt=""/>
           	 </div>
             <div class="party-girls-outer">
             	<div class="party-girl-img">
                	<img src="<?php echo $config_var->WEB_TPL_URL?>images/p-girl1.jpg" alt="" />
                </div>
                <div class="party-girl-img">
                	<img src="<?php echo $config_var->WEB_TPL_URL?>images/p-girl2.jpg" alt="" />
                </div>
                <div class="party-girl-img">
                	<img src="<?php echo $config_var->WEB_TPL_URL?>images/p-girl3.jpg" alt="" />
                </div>
                <div class="party-girl-img m-r-none">
                	<img src="<?php echo $config_var->WEB_TPL_URL?>images/p-girl4.jpg" alt="" />
                </div>
             </div>
			  <!-- New video Section -->
                <div class="f-models mt-30">
             	<div class="f-models-hdr">Sample Videos</div>
                <!--Models Image Outer Row-->
                <div class="models-img-outer">
                	<div class="models-video">
				       <span><?php //echo $data['video_title'];?></span>
                        <div class="video">
						<div id="myElement_ff">Loading the player...</div>
						<script type="text/javascript">
							jwplayer("myElement_ff").setup({
							file: "<?php echo $config_var->UPLOAD_URL."tour_videos/tour_video1.flv"?>",
							image: "<?php echo $config_var->UPLOAD_URL."tour_videos/tour_video1.png"?>",
							'width':  '460',
							'height': '280'
								});
                        </script>
               </div>
					 </div>
					<div class="models-video">
				         <span><?php //echo $data['video_title'];?></span>
                        <div class="video">
				      <div id="myElement_jj">Loading the player...</div>
						  <script type="text/javascript">
							jwplayer("myElement_jj").setup({
							file: "<?php echo $config_var->UPLOAD_URL."tour_videos/tour_video2.flv"?>",
							image: "<?php echo $config_var->UPLOAD_URL."tour_videos/tour_video2.png"?>",
							'width': '460',
							'height': '280'
								});
                           </script>
               </div>
					 </div>
                    	
                </div>
                <!--//Models Image Outer Row-->
             </div>
            <!-- End Video Sectio -->	
			 
             <!--//Party Girls End Here-->
              <!--Member Features-->
                <div class="member-feau-outer">
                	<div class="member-feau-hdr"><img src="<?php echo $config_var->WEB_TPL_URL?>images/member-feau-txt.png" alt="" /></div>
                    <div class="member-feau-con fl">
                    	<div class="member-feau-txt-hdr">Travel Guide</div>
                        <div class="member-feau-txt">
                        	<div class="img"><img src="<?php echo $config_var->WEB_TPL_URL?>images/travel-guide-img1.jpg" alt="" /></div>
                            <span>
                            	 <?php echo strip_tags($tourheader[0]['page_content']); ?>
                            </span>
                        </div>
                    
                    </div>
                    <div class="member-feau-con fr">
                    	<div class="member-feau-txt-hdr">Bar Guide</div>
                        <div class="member-feau-txt">
                        	<div class="img"><img src="<?php echo $config_var->WEB_TPL_URL?>images/travel-guide-img2.jpg" alt="" /></div>
                            <span>
                            	<?php echo strip_tags($tourheader[1]['page_content']); ?>
                            </span>
                        </div>
                    </div>
                </div>
                 <!--//Member Features-->
        </div>
        <!--//Content Text-->
    </div>
     <!--//ConTent-->
	
<div class="clr"></div>    
</div>