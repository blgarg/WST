<?php
global $config_var;  
require_once($config_var->LIB_ROOT.'mysql/mysql.php');
require_once($config_var->LIB_ROOT.'users/artist_db.php');	
require_once($config_var->LIB_ROOT.'facebook-php/src/facebook.php');				
global $DataSet;
global $model;
$session = new session();
$idUser = @$session->getVar("userAccountID");
$_SESSION['developerKey'] = "AI39si6bPoVuOQJycYHcfGN4uet3Gzb98NhtIhYgQcJgrHLE1X5EKp9qEvwS5yp-0wlmx_uaal2tnRqeRH1bpRa6cE1Kh9wkdw";
$model_artist_default = new model_artist_default();
$userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : $session->getVar("userAccountID");
$artist=$model_artist_default->getArtistData($userId);
$_SESSION['sessionToken']=$artist['sessionToken'];
?>
<div class="about_artist_bg" id="user_content">
                	<div class="about_artist_bg_top">
                    About Me
                    </div>
                    <div class="about_artist_bg_cen" >
                    	<div class="about_artist_text_born">Born: <span><!--July 6th, 1993--> <?php echo $model_artist_default->format_date($artist['dateofbirth']); ?></span></div>
                        <div class="about_artist_text_form">Form: <span><?php echo $artist['stateText'] .','.$model_artist_default->getCountryName($artist['country']); ?> 	</span></div>
                        <div class="about_artist_text_inspiration"><?php /*?>Biggest Inspiration: <span><?php if($artist['insp'] == ''){echo "N/A";}else{ echo $artist['insp']; }?></span></span><?php */?></div>
                        <div class="about_artist_text_bio">Bio:</div>
                        <div class="about_artist_text_bio_text"><?php echo $artist['bio']; ?></div>
						<div class="about_artist_lets_friend"><span>Let's be Friends:</span>
                        <a href="http://www.facebook.com/<?php echo $artist['facebookUsername'];?>" target="_blank"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_facebook.jpg" border="0" width="32" height="32" title="Facebook" alt="Facebook" /></a>
                        <a href="javascript:;"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_twitter.jpg" border="0" width="32" height="32" title="Twitter" alt="Twitter" /></a>
                        <a href="javascript:;"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_myspace.jpg" border="0" width="32" height="32" title="My Space" alt="My Space" /></a>
                        <a href="javascript:;"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_mail.jpg" border="0" width="32" height="32" title="Mail" alt="Mail" /></a>
                        <a href="javascript:;"><img class="icons" src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_apple.jpg" border="0" width="32" height="32" title="Apple" alt="Apple" /></a>
                        </div>
                        <!--<div class="add_buttons">
                        	<a href="javascript:;"><img src="<?php //echo  $config_var->WEB_TPL_URL; ?>images/add_tune_crue.jpg" border="0" height="27" width="191" title="Add" /></a>
                            <a href="javascript:;"><img class="button_space" src="<?php //echo  $config_var->WEB_TPL_URL; ?>images/add_current_fav_artist.jpg" border="0" height="27" width="299" title="Add" /></a>
                        </div>-->
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
                                 <script language="javascript" type="text/javascript">  
								 $(document).ready(function(){
								  ytVideoApp.presentAuthLink(); 
                                  })
                                 </script>
                                  <br><br><br>You are not authenticated with the youtube.Please click below to authenticate.<br><br /><br />
                                      <div id="generateAuthSubLink" style="margin-left:30px;"></div>
                                  <?php }else{ 
								  //$artist_default = new model_artist_default();
								  $_SESSION['authenticate']= true ;
								  $comment = $model_artist_default->getCommentList($_SESSION['userAccountID']);
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
                                  <div class="our_connection_text">You are successfully Authenticated with youtube.Latest comment on your videos will be display here soon.</div>
                                 <?php } ?>
								  
								   
						<?php } ?> 
                                </div>
                            </div>
                            <div class="connections_line"></div>
                            <div class="our_connection_box">
                            	<div class="our_connection_icon_outer">
                                	<div class="our_connection_icon"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/connections_facebook.jpg" border="0" height="36" width="106" title="Facebook"/></div>
                                     <span id="facebookcontent">
                                    <?php	if(trim($artist['facebookUsername'])==''){ ?>
                                       <br><br><br>You are not connected with the facebook.Please click below to connect.<br><br /><br />
                                       
    <div id="fb-root"></div>
    <script>
	  
	  window.fbAsyncInit = function() {
        FB.init({appId: '172091782856668', status: true, cookie: true,
                 xfbml: true});
      };
      (function(){
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
	</script>
 
 <p style="margin-left:30px;"><fb:login-button perms="email,user_birthday,user_about_me,user_checkins,user_hometown,manage_pages,read_stream,offline_access" onlogin="updateUser()">
         Connect to facebook
      </fb:login-button></p>
      </span>
									<?php }else{
									
									$userPost=$model_artist_default->getArtistLatestPost($artist['facebookUsername'],$artist['facebookToken']);
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
						  }else{ ?>
                        <div style="text-align:center;"><strong><br /><br />No Post Found.</strong></div>
                          <?php } ?>
						  <div id="facebookReadMore" class="alert_block">
						   <div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert();"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/cross_icon.png" alt="" width="25" height="25" /></a></div>
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
						 <?php } ?>
					<?php	 } 
						 
						 ?>
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