<?php 
include '../settings.php';
require_once('session/session.php');
require_once('mysql/mysql.php');
require_once('users/artist_db.php');	
require_once('facebook-php/src/facebook.php');				
global $config_var;  
global $DataSet;
global $model;
$session = new session();
$idUser = @$session->getVar("userAccountID");
$userType = @$session->getVar("userType");
$_SESSION['developerKey'] = "AI39si6bPoVuOQJycYHcfGN4uet3Gzb98NhtIhYgQcJgrHLE1X5EKp9qEvwS5yp-0wlmx_uaal2tnRqeRH1bpRa6cE1Kh9wkdw";
$model_artist_default = new model_artist_default();
$userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : $session->getVar("userAccountID");
$artist = $model_artist_default->getArtistData($userId);
$_SESSION['sessionToken'] = $artist['sessionToken'];
$likeCount = $model_artist_default->getLikeCount($userId);
?>
 <link href="<?php echo  $config_var->WEB_TPL_URL; ?>css/jScrollPane.css" rel="stylesheet" type="text/css" />
 <script src="<?php echo  $config_var->WEB_TPL_URL; ?>js/jScrollPane.js" type="text/javascript"></script>
<script language="javascript">
 $(document).ready(function(){
   ytVideoApp.listVideos('search_username','<?php echo $artist['user_name']; ?>', 1,'','<?php echo $userId; ?>'); 
   ytVideoApp.subscriberAndview('<?php echo $artist['user_name']; ?>'); 
 })
 
 
 
	$(function()
			{
				// this initialises the demo scollpanes and makes it reinitialise itself once it's images have loaded...
				$('#pane1')
					.jScrollPane(
						{
							
							showArrows:true, 
							scrollbarWidth: 10
						}
					); 
			});
			
		
 
 
 function updateUser(){
    $('#facebookcontent').html('<img src="template/system/images/loader.gif" alt="wait" />');
	$.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: "action=updateUser",
          success: function(msg){
	      /* '<div class="our_connection_text_heading">CabsLiz(1 day ago)</div><div class="our_connection_text">You Know? While I was watchingyour vids i thought "This girl mustvery younh still" and then i read you are 17... just wow! Lots and lots of love from my Paraguay.</div><div class="our_connection_text_heading">CabsLiz(1 day ago)</div><div class="our_connection_text">You Know? While I was watching your vids i thought "This girl must very younh still" and then i read you are 17... just wow! Lots and lots of love from my Paraguay.<a href="javascript:;">Read more...</a></div>'*/
		   $('#facebookcontent').html(msg);
          }
    });
}


function SelectFanPage(){

  showWaitPopUp('fanpageSelection','1');

 }


function getSeletedOption(num){
  var ok = confirm('Are you sure you want to be make this page as your fan page');
  if(ok){
	closePopUp('fanpageSelection');
	$('#reach_text_underneath').html('<img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/loader.gif" alt="wait" width="75" height="75" />');
	$.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: "access_token="+$('#access_token'+num).val()+"&access_id="+$('#access_id'+num).val()+"&action=addUserPage",
          success: function(msg){
	       $('#reach_text_underneath').html(msg);
          }
    });
  }
}


function likeArtist(id){
$.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: "uId="+id+"&action=likeArtistProfile",
          success: function(msg){
		    if(parseInt(msg)==0){
		    alert('You already like this artist');
		   }else{
		   $('#count_like').html(msg);
		   }
          }
    });
	
}
 </script>
      
       <div class="artist_page_outer">
        	<?php 
			$flag =false;
			 $userVal = @unserialize($artist['youTubeProfilepic']);
		     if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 else{$IMG_PATH = @$artist['youTubeProfilepic']; $flag =true;}
			?>
            <div class="artist_page">
            	<div class="artist_img_bg">
                	<div class="artst_img_bg_top"></div>
                    <div class="artst_img_bg_cen"><div style="position: absolute;width:150px;height:20px;border:#000099 1px solid;z-index:499;left:250px;text-align:center;background:#FF9933;display:none;" id="changeProfilePicsUser" onmouseout="HideChangePicOption();">
                    <a href="#" onclick="loadFanHTML('chageProfilePic');">Chage Profile Picture</a></div>
                    	<div class="artist_img"  id="setUserProfileImage" style="margin:auto;text-align:center;vertical-align:middle">
                        	<img src="<?php echo $IMG_PATH; ?>"  border="0" alt="" title=""   <?php if($flag){?>style="height:80px; width=80px; margin-top:50px;"<?php } ?>/>
                        </div>
                         <div class="fan_name">
                         <!--<span>J</span>ohn <span>D</span>oe-->
                         <span id="setName" style="height:25px;width:180px;float:left;color:#000000;">   
                        <?php   
						  $name = $artist['user_firstname'];
						  if(strlen($name)>15){
						  $name= substr($name,0,15).'...';
						  }
						  echo ucfirst($name) ;  ?>
                          </span>
                          &nbsp;&nbsp;<!--<a href="#" style="font:10px Arial, Helvetica, sans-serif;" onclick="loadFanHTML('edit_user');">Edit Profile</a> -->
                        </div>
                        
                        <div class="artist_rank">
                        	<div class="artist_rank_icom"></div>
                            <div class="artist_rank_text">
                            Rank: <?php echo $model_artist_default->getArtistRank($artist['user_name']);?>
                            </div>
                            <div class="artist_like">
                             <?php if(isset($_SESSION['userAccountID'])) { ?>
                            <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/contest_video_like.jpg" title="like" alt="like" onclick="likeArtist('<?php echo $artist['user_id'] ?>')"/>
                             <span id="count_like" style="border:#666666 1px solid; background-color: #CCCCCC;width:15px; position:relative;display:block; left:32px; text-align:center; top:-20px;"><?php echo $likeCount; ?></span>
							 <?php }else{ ?>
                             Likes : &nbsp;
                             <span id="count_like" style="border:#666666 1px solid; background-color: #CCCCCC;width:15px; position:relative;display:block; left:39px; text-align:center; top:-15px;"><?php echo $likeCount; ?></span>
							 <?php } ?>
                            
                            </div>
                        </div>
                    </div>
                    <div class="artst_img_bg_bot"></div>
                    <div class="reach_outer">
                    <div class="reach_bg_top">My Reach</div>
                    <div class="reach_bg_cen">
                        <div class="reach_content">
                            <div class="reach_icon"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/reach_youtube.jpg" border="0" height="57" width="58" title="Youtube" /></div>
                            <div class="reach_text_main">Mree on Youtube</div>
                            <div id="mereyoutube">
                             <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/loader.gif" alt="wait" width="75" height="75" />
                            </div>
                        </div>
                        <div class="reach_line"></div>
                        <?php
						  /* $facebook = new Facebook(array(
                            'appId'  => '200888379969053',
                            'secret' => 'a9051f7b18a211984ee07f5086f5e06d',
                            'cookie' => true,
                           ));
						   
						   $result = @$facebook->api('/'.$artist['fanPageId'].'');
						 /* echo "<pre>";
						   print_r($result);
						   echo "</pre>";*/
						   $fb_fans = @$result['likes'];
						?>
                        <div class="reach_content">
                            <div class="reach_icon"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/reach_facebook.jpg" border="0" height="57" width="58" title="Facebook" /></div>
                            <div class="reach_text_main">Mree on Facebook</div>
                            <div class="reach_text_underneath">Mree's Music</div>
                             <?php if($artist['isPageSelect'] == '1'){ 
							
						   $facebook = new Facebook(array(
                            'appId'  => '172091782856668',
                            'secret' => 'acaed0d5a7bb09cc330fc8d19c99dd75',
                            'cookie' => true,
                           ));
						   
						   $result = $facebook->api('/'.$artist['fanPageId'].'');
						  
						   $fb_fans = $result['likes'];
					
							 ?>
                             <div class="reach_text_underneath">Fans: <?php echo number_format($fb_fans); ?></div>
                             <?php } else {
							    if(trim($artist['facebookUsername']) != '0'){
							 ?>
                              <div class="reach_text_underneath" id="reach_text_underneath"> <h2 style="font-size:12px;text-align:left;">No page selected</h2></div>
                              <?php 
							 }else{   ?>
							 Authentication required
					 <?php		 }
					} ?>
                        </div>
                        <div class="reach_line"></div>
                        <div class="reach_content">
                            <div class="reach_icon"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/reach_twitter.jpg" border="0" height="57" width="58" title="Twitter" /></div>
                            <div class="reach_text_main">Mree on Twitter</div>
                            <div class="reach_text_underneath">Mree's Music</div>
                            <div class="reach_text_underneath">Follows: 2,945</div>
                        </div>
                        <div class="reach_line"></div>
                        <div class="reach_content">
                            <div class="reach_icon"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/reach_tunezy.jpg" border="0" height="57" width="58" title="Tunezy" /></div>
                            <div class="reach_text_main">Mree on Tunezy</div>
                            <div class="reach_text_underneath">Top 100 Artist under 18</div>
                            <div class="reach_text_underneath">Top 30 Most Inflencialv</div>
                        </div>
                    </div>
                    <div class="reach_bg_bot"></div>
                </div>
                </div>
                <div class="about_artist_bg" id="user_content">
                	<div class="about_artist_bg_top">
                    About Me
                    </div>
                    <div class="about_artist_bg_cen" >
                    	<div class="about_artist_text_born">Born: <span><!--July 6th, 1993--> <?php echo $model_artist_default->format_date($artist['dateofbirth']); ?></span></div>
                        <div class="about_artist_text_form">Form: <span><?php echo $artist['stateText'] .','.$model_artist_default->getCountryName($artist['country']); ?> 	</span></div>
                        <div class="about_artist_text_inspiration" style="height:10px;">&nbsp;<?php /*?>Biggest Inspiration: <span><?php if($artist['insp'] == ''){echo "N/A";}else{ echo $artist['insp']; }?></span></span><?php */?></div>
                        <div class="about_artist_text_bio">Bio:</div>
                         <?php
						 $bio = $artist['bio'];
						 if(trim($bio)==''){
						 $bio = 'N/A';
						 }
						 ?>
                        <div class="about_artist_text_bio_text"><?php echo $bio; ?></div>
						<div class="about_artist_lets_friend"><span>Let's be Friends:</span>
                        <a href="http://www.facebook.com/<?php echo $artist['facebookUsername'];?>" target="_blank"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_facebook.jpg" border="0" width="32" height="32" title="Facebook" alt="Facebook" /></a>
                        <a href="javascript:;"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_twitter.jpg" border="0" width="32" height="32" title="Twitter" alt="Twitter" /></a>
                        <a href="javascript:;"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_myspace.jpg" border="0" width="32" height="32" title="My Space" alt="My Space" /></a>
                        <a href="javascript:;"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_mail.jpg" border="0" width="32" height="32" title="Mail" alt="Mail" /></a>
                        <a href="javascript:;"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_apple.jpg" border="0" width="32" height="32" title="Apple" alt="Apple" /></a>
                        </div>
                      <?php if(isset($idUser) && ($idUser !='') && ($userType == 2)){?>
                        	<div class="add_buttons">
                            <?php if($model_artist_default->isMyTuneCrew($idUser,$userId) <=0){?>
                        	<a href="javascript:;" onclick="addToMyTuneCrewFunc(<?php echo $idUser;?>,<?php echo $userId;?>);" id="addToMyTuneCrewFunc_id">
                            <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/add_tune_crue.jpg" border="0" height="27" width="191" title="Add" />
                            </a>
                            <?php }?>
                            <?php if($model_artist_default->isMyFavouritArtist($idUser,$userId) <=0){?>
                            <a href="javascript:;" onclick="addMyCurrentFavouritArtistFunc(<?php echo $idUser;?>,<?php echo $userId;?>);" id="addMyCurrentFavouritArtistFunc_id">
                            <img class="button_space" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/add_current_fav_artist.jpg" border="0" 
                             height="27" width="299" title="Add" />
                             </a>
                             <?php } ?>
                        </div>
                      <?php }?>
                    </div>
                    <div class="about_artist_bg_bot"></div>
                    <div class="our_connections_outer">
                    	<div class="about_artist_bg_top">
                        Our Connections
                        </div>
                        <div class="about_artist_bg_cen">
                        	<div class="our_connection_box">
                            	<div class="our_connection_icon_outer">
                                 <div class="our_connection_icon"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/connections_youtube.jpg" border="0" height="36" width="90" title="youtube"/></div>
								<?php	if($artist['isyoutubeauth']=='0'){ ?>
                                 <br><br><br>This artist is not connected to YouTube.<br><br /><br />
                                                                      <?php }else{ 
								  $artist_default = new model_artist_default();
								  
								  $comment = $artist_default->getCommentList($userId);
								  $youtubeCommentcount = 0;
								  if(count($comment)>0){
								 
								  for($i=0;$i<count($comment);$i++){
							          ++ $youtubeCommentcount;
									 $latestcomment = $comment[$i]['comment'];
									 if(strlen($latestcomment) > 150 ) {
									 $latestcomment = substr($latestcomment,0,150).'...';
									 }
									 
								  ?> 
                               <div class="our_connection_text_heading"><?php echo $comment[$i]['youtubeUsername']; ?>(<?php echo $model_artist_default->ago($comment[$i]['date_created']); ?>)</div>
                                    <div class="our_connection_text">
                                    <?php echo $latestcomment; ?>
                                
                                    </div>
                                  <?php 
								    if($youtubeCommentcount == 2) break;
								  }  ?>
						<div id="youtubeCommentReadMore" class="alert_block">
						     <div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert();"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/cross_icon.png" alt="" width="25" height="25" /></a></div>
                                <div id="my_panel" style="height:520px;">
                          
								  <?php
								  for($i=0;$i<count($comment);$i++){
							     
									 $latestcomment = $comment[$i]['comment'];
									?> 
                               <div class="our_connection_text_heading_more"><?php echo $comment[$i]['youtubeUsername']; ?>(<?php echo $model_artist_default->ago($comment[$i]['date_created']); ?>)</div>
                                    <div class="our_connection_text_more">
                                    <?php echo $latestcomment; ?>
                               </div>
                                  <?php 
								  }   ?>
                                 </div>   
                            </div>  
                                  <?php if(count($comment)>0){ ?>
                                  <a href="javascript:;" style="color:#D50000;float: left;font-family: arial;font-size: 12px;line-height: 18px;margin: 7px 0 0;outline: medium none;text-decoration: none;width: 195px;" onclick="showYoutubeMoreComments('youtubeCommentReadMore')">Read more...</a> 
                                  <?php } ?>
                                  <?php
								 }else{?>
                                  <div class="our_connection_text">No Comment found.</div>
                                 <?php } ?>
								  
								   
						<?php } ?> 
                                </div>
                            </div>
                            <div class="connections_line"></div>
                            <div class="our_connection_box">
                            	<div class="our_connection_icon_outer">
                                	<div class="our_connection_icon"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/connections_facebook.jpg" border="0" height="36" width="106" title="Facebook"/></div>
                                  
                                    <?php	if(trim($artist['facebookUsername'])==''){ ?>
                                       <br><br><br>This Artist is not connected to facebook.<br><br /><br />
                                       </span>
									<?php }else{ 
									
									$userPost = @$model_artist_default->getArtistLatestPost($artist['facebookUsername'],$artist['facebookToken']);
									$count=0;
		                            if(count($userPost->data)>0){
								    for($i=0;$i<count($userPost->data);$i++){
		                            if($userPost->data[$i]->type == 'status'){
		                              ++$count;
		                            $message = $userPost->data[$i]->message;
									 if(strlen($message) > 150 ) {
									 $message = substr($message,0,150).'...';
									 }
									?>
		                         <div class="our_connection_text_heading"><?php echo $userPost->data[$i]->from->name; ?>(<?php echo $model_artist_default->ago($userPost->data[$i]->created_time); ?>)</div><div class="our_connection_text"><?php  echo $message; ?>.</div>
		                      <?php  } 
		                         if($count==2) break;
		                   } 
						 } else{ ?>
                        <div style="text-align:center;"><strong><br /><br />No Post Found.</strong></div>
                          <?php } ?>
						  <div id="facebookReadMore" class="alert_block">
						   <div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert();"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/cross_icon.png" alt=""  width="25" height="25" /></a></div>
						   <div id="my_panel" style="height:520px;">
						  <?php 
						   for($i=0;$i<count($userPost->data);$i++){
		                            if($userPost->data[$i]->type == 'status'){
		                              
		                            $message = $userPost->data[$i]->message;
									/* if(strlen($message) > 150 ) {
									 $message = substr($message,0,150).'...';
									 }*/
									?>
		                         <div class="our_connection_text_heading_more"><?php echo $userPost->data[$i]->from->name; ?>(<?php echo $model_artist_default->ago($userPost->data[$i]->created_time); ?>)</div><div class="our_connection_text_more"><?php  echo $message; ?>.</div>
		                      <?php  } 
		                         
		                   }   ?>
                         </div>
                      </div>  
                           <?php if(count($userPost->data)>2){ ?>
                           <a href="javascript:;" style="color:#D50000;float: left;font-family: arial;font-size: 12px;line-height: 18px;margin: 7px 0 0;outline: medium none;text-decoration: none;width: 195px;" onclick="showFacebookMorePosts('facebookReadMore');">Read more...</a> 
                     <?php	 } 
						 
						} ?>
                                </div>
                            </div>
                            <div class="connections_line"></div>
                            <div class="our_connection_box">
                            	<div class="our_connection_icon_outer">
                                	<div class="our_connection_icon"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/connections_tweet.jpg" border="0" height="36" width="115" title="Twitter"/></div>
                                    <div class="our_connection_text_heading">CabsLiz(1 day ago)</div>
                                    <div class="our_connection_text">You Know? While I was watching
                                    your vids i thought "This girl must
                                    very younh still" and then i read 
                                    you are 17... just wow! Lots and 
                                    lots of love from my Paraguay.</div>
                                    <div class="our_connection_text_heading">CabsLiz(1 day ago)</div>
                                    <div class="our_connection_text">You Know? While I was watching
                                    your vids i thought "This girl must
                                    very younh still" and then i read 
                                    you are 17... just wow! Lots and 
                                    lots of love from my Paraguay.
                                    <a href="javascript:;">Read more...</a>
                                    </div>
                                    
                                </div>
                            </div>
                         </div>
                        <div class="about_artist_bg_bot"></div>
                    </div>
                </div>
                <div class="work_bg_outer">
                	<div class="work_bg_top">My Work</div>
                    <div class="work_bg_cen">
                    	<div class="work_top_links">
                        	<div class="work_link_left"><a href="javascript:;" onclick="displayMoreVideo('viewMoreVideo')" id="view_more_video">View More</a></div>
                            <div class="work_link_right">
                            <span>Sort By:</span>
                            <ul>
                            	<li><a href="javascript:;" onclick="ytVideoApp.listVideos('search_username', '<?php echo $artist['user_name']; ?>', 1,'viewCount');">View</a></li>
                                <li><a href="javascript:;" onclick="ytVideoApp.listVideos('search_username', '<?php echo $artist['user_name']; ?>', 1,'rating');">Rating</a></li>
                                <li style="background: none;"><a href="javascript:;" onclick="ytVideoApp.listVideos('search_username', '<?php echo $artist['user_name']; ?>', 1,''); ">Upload Date</a></li>
                            </ul>
                            </div>
                        </div>
                    	<div id="searchResultsVideoList">
</div>   
                      
                     </div>
                    <div class="work_bg_bot"></div>
                </div> 
               <div class="alert_block" id="viewMoreVideo">
                <div id="alertClose"><a href="#" class="alertClose_a" onclick="hideAlert();"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/cross_icon.png" alt="" width="25" height="25" /></a></div>
                <div class="work_bg_outer" >
                	<div class="work_bg_top">My Work</div>
                    <div class="work_bg_cen">
                    	<div id="searchResultsVideoListMore">
</div>   
                      
                     </div>
                    <div class="work_bg_bot"></div>
                </div>
            </div>
           </div> 
     
        </div>
<!--  end content-table-inner ............................................END  -->
		