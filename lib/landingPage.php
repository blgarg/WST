<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var;  
 ?>
<!--Content Left-->
            <div class="content-lt" id="content-lt">
            	<!--Content Text Div-->
             <div id="getSlider" style="height:408px;width:735px;">
              <!-- //get Slider contet -->
                
             </div>   
                
                
                <!--Content Text Div-->
                <div class="content-txt-div">
                	<!--Header Text-->
                    <div class="content-lt-hdr">
                    	Recent Activity
                        	<a href="javascript:;" class="fr"  title="View More" onclick="getMoreRecentActivities('45');">
                            	<img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/view-more-btn.png" alt="" style="margin:7px 10px 0 0;" />
                            </a>
                    </div>
                    <!-- //Header Text-->
                    
                    	 <!--Left mid bg btm-->
                    	<div class="content-txt-btm-bg">
                    	<!--Left mid text-->
                        <div class="content-txt-mid">
                        	<!--Recent Activity-->
                            <div class="recent-activity" id="getRecentActiveity" style="height:200px;">
                                <!-- //Get Recent Activity Content-->                       
                               </div>
                            <!-- //Recent Activity-->
                        
                        </div>
                       <!-- //Left mid text-->
                       </div>
                        <!--Left mid bg btm-->
                </div>
                <!-- //Content Text Div-->
                
                
                
                
                <!--Content Text Div-->

                <div class="content-txt-div">
                	<!--Header Text-->
                    <div class="content-lt-hdr">
                    	FEATURED CONTESTS
                    </div>
                    <!-- //Header Text-->
                    
                    	 <!--Left mid bg btm-->
                    	<div class="content-txt-btm-bg">
                    	<!--Left mid text-->
                        <div class="content-txt-mid" id="putFeaturedContest" style="min-height:360px;">
                        	<!--Featured Contests-->
                            <div id="content_f">
                            <div style="text-align:center"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/loader.gif" alt=""  height="100" id="loderImg" align="middle"/></div>
                            </div>
                            <!-- // end Contest Entries-->
                        </div>
                       <!-- //Left mid text-->
                        </div>
                         <!-- //Left mid bg btm-->
                    
                    	
                </div>
                <!-- //Content Text Div-->
                
               <!--Content Text Div-->
               <div class="content-txt-btm-bg" >
                    	<!--Left mid text-->
                        <div class="content-txt-mid" style="padding-top:0px;">
                <div class="content-txt-div"  style="height:558px;background:#FFFFFF;width:732px;">
                <div class="content-lt-hdr">
                    	FEATURED BLOG POST
                        <a href="<?php echo  $config_var->WEB_URL."blog"; ?>" class="fr"  title="Read More">
                            	<img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/read-more-btn.png" alt="" style="margin:7px 10px 0 0;" />
                            </a>
                    </div>
                 <div id="featuredPost" style="border:none; margin-top:40px;"> 
                 <div style="text-align:center"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/loader.gif" alt=""  height="100" id="loderImg" align="middle"  style="border:none;"/></div>
                 </div>   
                  <!--featured post-->
                </div>
                </div></div><!-- //Content Text Div-->
            
            
            <div class="clr"></div>
            </div>
            <!-- //Content Left-->
            
            
            	<!--Content Right-->
                <div class="content-rt">
                	<!--Content Right Text bg Bottom-->
                    <div class="content-rt-txt">
                    	<div class="content-rt-txt-hdr">Top Ranked</div>
                        <!--Mid Text Right-->
                        <div class="content-rt-txt-mid" id="getToRankedUsers" style="height:1605px;">
                        	  <!-- top ranbked contents-->
                        </div>
                         <!-- //Mid Text Right-->
                    </div>
                    <!-- //Content Right Text bg Bottom-->

                
                <div class="clr"></div>
                </div>
                <!-- //Content Right-->
<div class="clr"></div>