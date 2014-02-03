<?php //ob_start("ob_gzhandler"); ?> 
<?php
global $config_var;
$model_index_default = new model_index_default();
$recentActivities = $model_index_default ->getrecentActivities();
 $bannerList = $model_index_default ->getBannerList();
 $featuedBlogPost = $model_index_default ->getFeaturedPost();
?>
<div class="l-page-txt">
       	 <div style="float:left;">
		 <img style="margin-left:1px;" src="<?php echo $config_var->WEB_TPL_PATH.'/images/LandingPageImage.jpg'?>"/></div>
       	  <div class="l-page-txt-rt" style="width:630px;float:right!important;">
<h2>Welcome to <span>WorldSexTraveler.com </span> <br /><font>Sex Travel Adventures Around the World</font></h2>Warning! This site contains sexually explicate material, which may be offensive to some audiences.To enter this website you must be at least 18 years (or older if required in the jurisdiction in which you reside or access this website). By entering WorldSexTraveler.com you certify that you are of legal age and you are choosing to enter of your own free will. You may not enter this site if you are offended by sexually explicate material or if the standards of your community do notallow for the viewing and downloading of such material. You may not redistribute any material contained in this website to any person or business or permit any minor to view this material.All images, text, and video are copyrighted material. All Rights Reserved.<p>All content and images are in full compliance with the requirements of 18 U.S.C. 2257 and associated regulations.</p>
           <div class="i-agree-btn-outer">
                	<div class="i-agree-btn">
                    	<a href="<?php echo $config_var->WEB_URL ;?>?mod=mod_index&view=tour&form=agree&s=1">
                        	<span>I AGREE</span> ENTER <span>WORLDSEXTRAVELER.COM</span>
                        </a>
                    </div>
                   <div class="i-agree-btn">
<a href="http://www.google.com"">
                        	<span>I DO NOT AGREE</span> EXIT <span>WORLDSEXTRAVELER.COM</span>
                        </a>
                    </div>
                </div>
          </div>
        </div>
		</div>
	