<?php
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var; 
 class getDiscover extends JDatabaseMySQL
{
     function initialize(){ return;}
	 function getvarp(){return ;}
				
	function getTopRankedUsers($arr)
	{	
		   
			  $subqry = '';
			  $modelId=$arr['modelId'];
			 $subscribe = isset($_REQUEST['subscriber']) ? $_REQUEST['subscriber'] : 1000000;
			 $views = isset($_REQUEST['views']) ? $_REQUEST['views'] : 1000000;
			 $avg_rating = isset($_REQUEST['rating']) ? $_REQUEST['rating'] : 4.00;
			  
			 // $subqry = "dailystatistics.subscribers <='".$subscribe."' AND dailystatistics.views <= '".$views ."' AND dailystatistics.avg_raters_universe < '".$avg_rating."' AND ";
			
			//echo $this->sql = "SELECT Users.*,rank.*,max(dailystatistics.views) as Views, max(dailystatistics.subscribers) as Subscribers,max(dailystatistics.average_rating) as avg_rating ,dailystatistics.lastDate as lastDate FROM mgl_users as Users,rankings As rank,dailystatistics WHERE  Users.user_name = rank.userName AND Users.user_name = dailystatistics.userName AND ".$subqry." rank.rankingId = '".$modelId."' AND rank.rank >= 0 GROUP BY dailystatistics.userName  ORDER BY rank.rank ASC LIMIT 10";
			 
			  $this->sql = "SELECT Users.* FROM mgl_users as Users WHERE  Users.user_name IN (SELECT userName FROM rankings WHERE  rankings.rankingId = '".$modelId."' AND rankings.rank >= 0 GROUP BY rankings.userName ORDER BY rankings.dateUpdated DESC ) LIMIT 10";
			 
			  if($this->query()){
				 return self :: filterResult($this->loadAssoc(),$subscribe,$views,$avg_rating);
			   }
	 }
	 
	
	function getModeletail($modelId){
		
		      $this->sql = "SELECT * FROM rankingmodels WHERE rankingId = '".$modelId."'";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
  } 

	
  function filterResult($totalResults,$subscriber,$views,$avg_rating){
      $newResults = array();
	 
	  for($r=0;$r<count($totalResults);$r++){
	  $result = array();
	    $this->sql = 'SELECT * FROM dailystatistics WHERE userName = "'.$totalResults[$r]['user_name'].'" ORDER BY lastDate DESC LIMIT 0,1 ';
		 
		 if($this->query()){
			$result = $this->loadAssoc();
		}
		 if(count($result) > 0){
		    if($result[0]['views']<=$views && $result[0]['subscribers']<=$subscriber && $result[0]['average_rating']>=$avg_rating){
		      $newResults[] = $totalResults[$r];
		    }
	     }
	  }
	 return $newResults;
  }	
	
	function searchArtistViaName($arr){
	   
	   $this->sql = "SELECT * FROM mgl_users WHERE ((user_firstname LIKE('%".$arr['artistName']."%') || user_lastname LIKE('%".$arr['artistName']."%') || user_name LIKE('%".$arr['artistName']."%') ) AND mgl_users.type = '1'  AND user_name !='admin'  ) LIMIT 10";
	   
	    if($this->query()){
		 return $this->loadAssoc();
		}
	}			
 function userVIdeoList($arr){
   
   $sql = "SELECT mgl_videodetail.* FROM mgl_videodetail,mgl_contest_video WHERE mgl_videodetail.vid=mgl_contest_video.VideoId AND mgl_contest_video.VideoId.userId = '".$arr['userId']."'";
    if($this->query()){
		 return $this->loadAssoc();
	}
 }	


} 
 $discover = new getDiscover();
 if(isset($_REQUEST['act']) && $_REQUEST['act']=='changeModel'){
  $toprankedUsers =  $discover->getTopRankedUsers($_REQUEST);
//  $modelDeatil = $discover->getModeletail($_REQUEST['modelId']);
 ?>
 <style>
	#demo-frame > div.demo { padding: 10px !important;margin-left:50px !important; };
	div.demo p label {float:left !important;}
	.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default { border: 1px solid #ED6103/*{borderColorDefault}*/; background: #FC7418 !important;/*{bgColorDefault} url(images/ui-bg_glass_75_e6e6e6_1x400.png)*//*{bgImgUrlDefault}*/ 50%/*{bgDefaultXPos}*/ 50%/*{bgDefaultYPos}*/ repeat-x/*{bgDefaultRepeat}*/; font-weight: normal/*{fwDefault}*/; color: #555555/*{fcDefault}*/; }
	</style>

<script>
	$(function() {
		$( "#slider-range-max_for_subscriber" ).slider({
		
			range: "min",
			min: 1,
			max: 1000000,
			value: 1000000,
           slide: function( event, ui ) {
				$( "#subscriber_amount" ).val( ui.value );
			  
			}
		});
		
		$( "#subscriber_amount" ).val( $( "#slider-range-max_for_subscriber" ).slider( "value" ) );
		
		$( "#slider-range-max_for_views" ).slider({
			range: "min",
			min: 1,
			max: 1000000,
			value: 1000000,

			slide: function( event, ui ) {
				$( "#views_amount" ).val( ui.value );
			}
		});
		
		$( "#views_amount" ).val( $( "#slider-range-max_for_views" ).slider( "value" ) );
		
		$( "#slider-range-max_for_avg_rating" ).slider_rating({
			range: "min",
			min: 4,
            max: 5,
			value: 4,

			slide: function( event, ui ) {
				$( "#avg_rating_amount" ).val( ui.value );
			}
		});
		
		$( "#avg_rating_amount" ).val( $( "#slider-range-max_for_avg_rating" ).slider_rating( "value" ) );
	    
	});
	
</script>
 <div id="content-txt" >
        	<!--Discover Left-->
            <div class="discover_lt">
            
            	<!--Dis Outer-->
            	<div class="dis_lt_outer">
                	<div class="dis_lt_hdr">Tunezy top talent</div>
                    
                    <!--Dis Mid-->
                    <div class="dis_lt_mid">
                    	
                        <!--Top Talent Outer-->
                    	<div class="top_talent_outer">
                        	<div class="top_talent_lt">
                            
                            	<div class="grey_txt_box" id="model1" style="margin:61px 0 40px 0;" onclick="getDiscoverPageLeftPanel('1')" onmouseover="getModelDescription('1')">
                                	Most <br />
									Influence
                                </div>
                                
                                <div class="grey_txt_box" id="model6" onclick="getDiscoverPageLeftPanel('6')" onmouseover="getModelDescription('6')">
                                	The Most <br />
									Favoured
                                </div>
                                
                            </div>
                            <div class="top_talent_mid" >
                            
                            	<div class="org_sltd" onclick="getDiscoverPageLeftPanel('2')" id="model2" onmouseover="getModelDescription('2')" >
                                	Going <br />
									Viral
                                </div>
                                	<img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/top_talent_mid_img.png" alt="" style="margin:3px 0;" />
                              
                                <div class="grey_txt_box" onclick="getDiscoverPageLeftPanel('5')" id="model5" onmouseover="getModelDescription('5')">
                                	Recently <br />
									Released
                                </div>
                            
                            
                            </div>
                            <div class="top_talent_rt">
                            	<div class="grey_txt_box" style="margin:61px 0 40px 0;" onclick="getDiscoverPageLeftPanel('3')" id="model3" onmouseover="getModelDescription('3')">
                                	THE Young <br />
									and talented
                                </div>
                                
                                <div class="grey_txt_box" onclick="getDiscoverPageLeftPanel('4')" id="model4" onmouseover="getModelDescription('4')">
                                	The Most <br />
									Discussed
                                </div>
                            
                            </div>
                            
                           <div class="clr"></div>
                          <div class="top_talent_btm" id = "model_detail_description">
                              <i> Going Viral - These artists have recently started turning heads.  Find out who is blowing up, and help spread the word.</i> 
                            </div>
                            
                        </div>
                           <!-- //Top Talent Outer-->
                          
                           
                    </div>
                    <!-- //Dis Mid-->
                </div>
                <!-- //Dis Outer-->
                
                
                <div class="dis_lt_outer">
                	<div class="dis_lt_hdr">Filter Results</div>
                    <div class="dis_lt_mid" style="text-align:center;">
                    	<div class="demo" style="width:400px;margin-left:70px !important; ">
<p style="margin-left:-110px;"><label for="amount" style="color:#ED6103; font-weight:bold;">Subscriber Less Than:</label>
	<input type="text" id="subscriber_amount" style="border:0; color:#333333; font-weight:bold;" readonly="readonly" />
</p>
<div id="slider-range-max_for_subscriber"></div>


<p style="margin-left:-150px;"><label for="amount" style="color:#ED6103; font-weight:bold;">Views Less Than:</label>
	<input type="text" id="views_amount" style="border:0; color:#000000; font-weight:bold;"  readonly="readonly"/>
</p>
<div id="slider-range-max_for_views"></div>



<p style="margin-left:-110px;"><label for="amount" style="color:#ED6103; font-weight:bold;">Avg Rating More Than:</label>
	<input type="text" id="avg_rating_amount" style="border:0; color:#000000; font-weight:bold;"  readonly="readonly"/>
</p>

<div id="slider-range-max_for_avg_rating"></div><br />
<div style="float:right; margin-right:-40px;"><a href="javascript:;"  onclick=" getDiscoverFilterResults();" ><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/search_dis.png" alt="" /></a></div>
</div>
                    </div>
                </div>
                
                
                <div class="dis_lt_outer">
                	<div class="dis_lt_hdr">Search Artists</div>
                    <div class="dis_lt_mid">
                    	<div class="artists_Outer">
                        	<div class="artists_input">
                       <input type="text" value="" style="height:20px; width:240px; margin:9px 0px 0 7px; background:none;border:none; " id="get_artist_name"  onkeypress="getValue();"/>

                           </div>
                            <span class="fl" style="margin:3px 30px 0 5px;"><b>Enter Artist Name <br /> or Youtube ID</b></span>
                            
                            <a href="#" class="fl" ><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/search_dis.png" alt="" onclick="searchArtist()" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Discover Left-->
            
            	<!--Discover Right-->
                <div class="discover_rt">
                	
                    <!--Right Outer-->
                	<div class="dis_rt_outer">
                    	<div class="dis_rt_hdr">Artists</div>
                        
                        <!--Dis Rt Mid-->
                        <div class="dis_rt_mid" id="dis_rt_mid">
                        
                        	<?php if(isset($toprankedUsers) && count($toprankedUsers) > 0){ 
							for($i=0;$i<count($toprankedUsers);$i=$i+2){
							$userId = $toprankedUsers[$i]['user_id'];
							$youTubename = $toprankedUsers[$i]['user_name'];
							$artistName =  $toprankedUsers[$i]['user_firstname'].' '.$toprankedUsers[$i]['user_lastname'];
							$userVal = @unserialize($toprankedUsers[$i]['youTubeProfilepic']);
		     				if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 				else{$IMG_PATH = @$toprankedUsers[$i]['youTubeProfilepic'];}
							
							?>
                            <!--Artists Outer-->
                        	<div class="artists_outer_div">
                            	<div class="artists_sr_no"><?php echo $i+1; ?></div>
                                <div class="artists_img_div">
                                	<div class="artists_img" style="text-align:center;cursor:pointer;"> <img src="<?php echo  $IMG_PATH; ?>" alt=""  width="155" height="95" onmouseover="getUserinfo('<?php echo $youTubename ?>','<?php echo $IMG_PATH  ?>','<?php echo $artistName  ?>','<?php echo $userId; ?>')"/></div>
                                    <?php echo ucfirst($youTubename); ?> <br />
                                    <?php echo ucfirst($artistName); ?>
                                </div>
                             
                             <?php if(isset($toprankedUsers[$i+1])) { 
							     $userId = $toprankedUsers[$i+1]['user_id'];
								 $youTubename = $toprankedUsers[$i+1]['user_name'];
							     $artistName =  $toprankedUsers[$i+1]['user_firstname'].' '.$toprankedUsers[$i]['user_lastname'];
							     $userVal = @unserialize($toprankedUsers[$i+1]['youTubeProfilepic']);
		     				if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 				else{$IMG_PATH = @$toprankedUsers[$i+1]['youTubeProfilepic'];}
							 ?>
                                 <div class="artists_sr_no"><?php echo $i+2; ?></div>
                                   <div class="artists_img_div">
                                	  <div class="artists_img" style="text-align:center;cursor:pointer;"><img src="<?php echo  $IMG_PATH; ?>" alt=""  width="155" height="95"  onmouseover="getUserinfo('<?php echo $youTubename ?>','<?php echo $IMG_PATH  ?>','<?php echo $artistName  ?>','<?php echo $userId; ?>')"/></div>
                                      <?php echo ucfirst($youTubename); ?> <br />
                                     <?php echo ucfirst($artistName); ?>
                                   </div>
						       <?php } ?>
                          </div>
						  <?php   }
						      }else{
						  ?>	  
                           
                           <span style="text-align:center; font-weight:bold; font-size:14px;margin:100px;">No Record Found</span>
                           
						   <?php } ?> <!-- //Artists Outer-->
                            
                            
                            <!--Artists Outer-->
                        	<!--<div class="artists_outer_div">
                            	<div class="artists_sr_no">3</div>
                                <div class="artists_img_div">
                                	<div class="artists_img"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/a3.gif" alt="" /></div>
                                    Yotube ID <br />
                                    Artist Name
                                </div>
                                
                                
                                <div class="artists_sr_no">4</div>
                                <div class="artists_img_div">
                                	<div class="artists_img"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/a4.gif" alt="" /></div>
                                    Yotube ID <br />
                                    Artist Name
                                </div>
                                
                            </div>-->
                            <!-- //Artists Outer-->
                            
                         </div>
                         <!-- //Dis Rt Mid-->
                    </div>
                     <!-- //Right Outer-->
                     
                     
                </div>
                <!-- //Discover Right-->
            
         <div class="clr"></div>
        </div>
        <input type="hidden" id="selectdModel" value="" />
 <?php
  }
 if(isset($_REQUEST['act']) && $_REQUEST['act']=='getLeftPanel'){
  $toprankedUsers =  $discover->getTopRankedUsers($_REQUEST);
?>

  
                        <!--Dis Rt Mid-->
                        
                        
                        	<?php if(isset($toprankedUsers) && count($toprankedUsers) > 0){ 
							for($i=0;$i<count($toprankedUsers);$i=$i+2){
							$userId = $toprankedUsers[$i]['user_id'];
							$youTubename = $toprankedUsers[$i]['user_name'];
							$artistName =  $toprankedUsers[$i]['user_firstname'].' '.$toprankedUsers[$i]['user_lastname'];
							$userVal = @unserialize($toprankedUsers[$i]['youTubeProfilepic']);
		     				if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 				else{$IMG_PATH = @$toprankedUsers[$i]['youTubeProfilepic'];}
							
							?>
                            <!--Artists Outer-->
                        	<div class="artists_outer_div">
                            	<div class="artists_sr_no"><?php echo $i+1; ?></div>
                                <div class="artists_img_div">
                                	<div class="artists_img" style="text-align:center;cursor:pointer;"> <img src="<?php echo  $IMG_PATH; ?>" alt=""  width="155" height="95" onmouseover="getUserinfo('<?php echo $youTubename ?>','<?php echo $IMG_PATH  ?>','<?php echo $artistName  ?>','<?php echo $userId; ?>')"/></div>
                                    <?php echo ucfirst($youTubename); ?> <br />
                                    <?php echo ucfirst($artistName); ?>
                                </div>
                             
                             <?php if(isset($toprankedUsers[$i+1])) { 
							     $userId = $toprankedUsers[$i+1]['user_id'];
								 $youTubename = $toprankedUsers[$i+1]['user_name'];
							     $artistName =  $toprankedUsers[$i+1]['user_firstname'].' '.$toprankedUsers[$i]['user_lastname'];
							     $userVal = @unserialize($toprankedUsers[$i+1]['youTubeProfilepic']);
		     				if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 				else{$IMG_PATH = @$toprankedUsers[$i+1]['youTubeProfilepic'];}
							 ?>
                                 <div class="artists_sr_no"><?php echo $i+2; ?></div>
                                   <div class="artists_img_div">
                                	  <div class="artists_img" style="text-align:center;cursor:pointer;"><img src="<?php echo  $IMG_PATH; ?>" alt=""  width="155" height="95" onmouseover="getUserinfo('<?php echo $youTubename ?>','<?php echo $IMG_PATH  ?>','<?php echo $artistName  ?>','<?php echo $userId; ?>')"/></div>
                                      <?php echo ucfirst($youTubename); ?> <br />
                                     <?php echo ucfirst($artistName); ?>
                                   </div>
						       <?php } ?>
                          </div>
						  <?php   }
						      }else{
						  ?>	  
                            <span style="text-align:center; font-weight:bold; font-size:14px; margin:100px;"> No Record Found </span>
							<?php } ?> 
                            <!-- //Artists Outer-->
                            
                            
                            <!--Artists Outer-->
                        	<!--<div class="artists_outer_div">
                            	<div class="artists_sr_no">3</div>
                                <div class="artists_img_div">
                                	<div class="artists_img"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/a3.gif" alt="" /></div>
                                    Yotube ID <br />
                                    Artist Name
                                </div>
                                
                                
                                <div class="artists_sr_no">4</div>
                                <div class="artists_img_div">
                                	<div class="artists_img"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/a4.gif" alt="" /></div>
                                    Yotube ID <br />
                                    Artist Name
                                </div>
                                
                            </div>-->
                            <!-- //Artists Outer-->
                            
                       
                         <!-- //Dis Rt Mid-->
       

<?php
 }
 
     if(isset($_REQUEST['act']) && $_REQUEST['act']=='searchArtistviaName'){
  $toprankedUsers =  $discover->searchArtistViaName($_REQUEST);
?>

  
                        <!--Dis Rt Mid-->
                        
                        
                        	<?php if(isset($toprankedUsers) && count($toprankedUsers) > 0){ 
							for($i=0;$i<count($toprankedUsers);$i=$i+2){
							$userId = $toprankedUsers[$i]['user_id'];
							$youTubename = $toprankedUsers[$i]['user_name'];
							$artistName =  $toprankedUsers[$i]['user_firstname'].' '.$toprankedUsers[$i]['user_lastname'];
							$userVal = @unserialize($toprankedUsers[$i]['youTubeProfilepic']);
		     				if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 				else{$IMG_PATH = @$toprankedUsers[$i]['youTubeProfilepic'];}
							
							?>
                            <!--Artists Outer-->
                        	<div class="artists_outer_div">
                            	<div class="artists_sr_no"><?php echo $i+1; ?></div>
                                <div class="artists_img_div">
                                	<div class="artists_img" style="text-align:center;cursor:pointer;"> <img src="<?php echo  $IMG_PATH; ?>" alt=""  width="155" height="95" onmouseover="getUserinfo('<?php echo $youTubename ?>','<?php echo $IMG_PATH  ?>','<?php echo $artistName  ?>','<?php echo $userId; ?>')"/></div>
                                    <?php echo ucfirst($youTubename); ?> <br />
                                    <?php echo ucfirst($artistName); ?>
                                </div>
                             
                             <?php if(isset($toprankedUsers[$i+1])) { 
							     $userId = $toprankedUsers[$i+1]['user_id'];
								 $youTubename = $toprankedUsers[$i+1]['user_name'];
							     $artistName =  $toprankedUsers[$i+1]['user_firstname'].' '.$toprankedUsers[$i]['user_lastname'];
							     $userVal = @unserialize($toprankedUsers[$i+1]['youTubeProfilepic']);
		     				if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 				else{$IMG_PATH = @$toprankedUsers[$i+1]['youTubeProfilepic'];}
							 ?>
                                 <div class="artists_sr_no"><?php echo $i+2; ?></div>
                                   <div class="artists_img_div">
                                	  <div class="artists_img" style="text-align:center;cursor:pointer;"><img src="<?php echo  $IMG_PATH; ?>" alt=""  width="155" height="95" onmouseover="getUserinfo('<?php echo $youTubename ?>','<?php echo $IMG_PATH  ?>','<?php echo $artistName  ?>','<?php echo $userId; ?>')"/></div>
                                      <?php echo ucfirst($youTubename); ?> <br />
                                     <?php echo ucfirst($artistName); ?>
                                   </div>
						       <?php } ?>
                          </div>
						  <?php   }
						      }else{
						  ?>	  
                            <span style="text-align:center; font-weight:bold; font-size:14px; margin:100px;"> No Record Found </span>
							<?php } ?> 
                            <!-- //Artists Outer-->
                            
                            
                            <!--Artists Outer-->
                        	<!--<div class="artists_outer_div">
                            	<div class="artists_sr_no">3</div>
                                <div class="artists_img_div">
                                	<div class="artists_img"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/a3.gif" alt="" /></div>
                                    Yotube ID <br />
                                    Artist Name
                                </div>
                                
                                
                                <div class="artists_sr_no">4</div>
                                <div class="artists_img_div">
                                	<div class="artists_img"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/a4.gif" alt="" /></div>
                                    Yotube ID <br />
                                    Artist Name
                                </div>
                                
                            </div>-->
                            <!-- //Artists Outer-->
                            
                       
                         <!-- //Dis Rt Mid-->
       

<?php
 }
 
 if(isset($_REQUEST['act']) && $_REQUEST['act']=='getArtistDetail'){
 ?>
   <script language="javascript" type="text/javascript">
    ytVideoApp.listVideosuser('search_username','<?php echo $_REQUEST['youtubeId']; ?>', 1,'viewCount','<?php echo $_REQUEST['userId']; ?>'); 
   </script>
   
 <table width="100%" cellpadding="0" cellspacing="0">
  <tr><td valign="top" width="20%" align="right"><div style="width:150px;height:85px;;border:#CCCCCC 3px solid;padding:1px;"><img src="<?php echo $_REQUEST['artistPic']; ?>" alt="userPic" title="Artist Pic"  height="83" width="150" onclick="hideAlert(),getPublicProfile('<?php echo $_REQUEST['userId']; ?>','1')" style="cursor:pointer;"/></div></td><td width="20%" align="left" valign="top"><div style="width:150px;height:20px;font:bold 15px Arial, Helvetica, sans-serif; margin-left:10px;">
  <?php echo ucfirst($_REQUEST['artistName']); ?></div></td><td valign="top"><div style="width:90px;height:50px;float:left" onclick="hideAlert(),getPublicProfile('<?php echo $_REQUEST['userId']; ?>','1')"> <span style="cursor:pointer;float:left;width:40px;">View <br>Artist</span><span style="cursor:pointer;float:left;width:40px;"><a href="javascript:;"><img border="0" alt="" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_icon.png"> </a></span></div></td>
    <td width="36%" align="center"  valign="top" id="video_list_to_add"><div style="width:60px;height:50px;"><span style="cursor:pointer;" onclick="return addSongTovideoList('<?php echo $_REQUEST['youtubeId']; ?>','<?php echo $_REQUEST['userId']; ?>')">Add all<br />Artist's<br />Videos</span></div></td></tr>
  
  
  <?php
   //$userVideoList = $discover->getuserVideoList($_REQUEST)
  ?>
 <tr><td colspan="4"><div id="videoListofauser"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/loader.gif" alt="wait" title="wait image" /></div></td></tr>
  <tr id="view_uploaded_video" style="display:none;"><td colspan="4"><div style="float:right;"><a href="#" onclick="ytVideoApp.listVideosuser('search_username','<?php echo $_REQUEST['youtubeId']; ?>', 1,'viewCount','<?php echo $_REQUEST['userId']; ?>')">View</a>&nbsp;|&nbsp;<a href="#" onclick="ytVideoApp.listVideosuser('search_username','<?php echo $_REQUEST['youtubeId']; ?>', 1,'','<?php echo $_REQUEST['userId']; ?>')">Uploaded</a></div><br /></td></tr>
  </table>
<?php }?>

