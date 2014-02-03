<?php 
 include '../settings.php';
 require_once('session/session.php');
 global $config_var;  
 require_once('users/fan_db.php');
 global $DataSet;
 global $model;

$session = new session();
$model_fan_default = new model_fan_default();
//$sessionVar = $session->printSession();
$idUser =  @$_REQUEST['userId'];
$fan = $model_fan_default->getFanData($idUser);
$fanPlayList = $model_fan_default->getPlayList();
?>
<div class="artist_page_outer">
        	<?php if(isset($idUser) && ($idUser !='')){
			$flag =false;
			$userVal = @unserialize($fan['youTubeProfilepic']);
			if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 else{$IMG_PATH = @$fan['youTubeProfilepic'];$flag =true;}
			 ?>
            <div class="fan_page">
            	<div class="fan_img_bg">
                	<div class="fan_img_bg_top"></div>
                    <div class="fan_img_bg_cen">
                    <div style="position: absolute;width:150px;height:20px;border:#000099 1px solid;z-index:499;left:250px;text-align:center;background:#FF9933;display:none;" id="changeProfilePicsUser"><a href="#" onclick="loadFanHTML('chageProfilePic');">Chage Profile Picture</a></div>
                    	<div class="fan_img" id="setUserProfileImage" style="margin:auto;text-align:center;">
                        	<img src="<?php echo $IMG_PATH; ?>"  border="0" alt="" title=""  <?php if($flag){?>style="height:80px; width=80px; margin-top:50px;"<?php } ?>/>
                        </div>
                        <div class="fan_name">
                        	<!--<span>J</span>ohn <span>D</span>oe-->
                         <span id="setName" style="height:25px;width:180px;float:left;color:#000000;">   
                        <?php   
						  $name = $fan['user_firstname'].' '.$fan['user_lastname'];
						  if(strlen($name)>15){
						  $name= substr($name,0,15).'...';
						  }
						  echo $name ;  ?>
                          </span>
                         </div>
                        
                    </div>
                    <div class="fan_img_bg_bot"></div>
                    <div class="last_video_outer">
                    <div class="last_video_bg_top">Last Video I Wathched</div>
                    <div class="last_video_bg_cen">
                        <div class="last_video_content">
                        <?php $lastVideoPlayData = $model_fan_default->lastPlayedVideo($idUser);
							  if(count($lastVideoPlayData) >0){
						?>
                            <div class="last_video_icon">
                            <a href="javascript:;" onclick="ytVideoApp.presentVideo('<?php echo $lastVideoPlayData[0]['playId'];?>');" class="personPopupTrigger" rel="<?php echo  $lastVideoPlayData[0]['uId']; ?>,a17bee64-8593-436e-a2f8-599a626370df">
                            <img src="<?php echo  $lastVideoPlayData[0]['vthumbs']; ?>" border="0" height="65" width="80" title="<?php echo  $lastVideoPlayData[0]['vtitle	']; ?>" /></a></div>
                            <div class="last_video_text_main">Mree</div>
                            <div class="last_video_text_underneath"><span id="last_video_view_count">
                            <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/loader.gif" alt="wait" width="75" height="75" /></span></div>
                        <?php }else{ ?>
                        <h2 style="font-size:12px;text-align:center;">No video played yet.</h2> 
                        <?php } ?>   
                        </div>
                    </div>
                    <div class="last_video_bg_bot"></div>
                </div>
                
                          
                <?php /*?><div class="saved_playlist_outer">
                    <div class="saved_playlist_bg_top">Saved Playlist</div>
                    <div class="saved_playlist_bg_cen">
                        <!-- PlayList Contentes come here -->
                        <?php echo $fanPlayList;?>
                    </div>
                    <div class="last_video_bg_bot"></div>
                </div><?php */?>
                
                </div>
                <div class="about_fan_bg" id="user_content">
                	<div class="about_fan_bg_top">
                    About Me
                    </div>
                    <div class="about_fan_bg_cen">
                    	<div class="about_fan_text_born">Born: <span><!--July 6th, 1993--><?php echo $model_fan_default->format_date($fan['dateofbirth']); ?>
                        </span></div>
                        <div class="about_fan_text_form">Form: <span><?php echo $fan['stateText'] .', '.$model_fan_default->getCountryName($fan['country']); ?>                        </span></div>
                        <?php $current_Favorite_Artist_1 = $model_fan_default->getMyFavouritArtist($idUser);
						//echo $current_Favorite_Artist_1[0]['artist_id'];echo "dsdasd";
							  $current_Favorite_Artist = $model_fan_default->getFanData($current_Favorite_Artist_1[0]['artist_id']);?>
                        <?php $myFavouritArtistPic = @unserialize($current_Favorite_Artist['youTubeProfilepic']);
							   if(@is_array($myFavouritArtistPic)){ $myFavouritArtistProfileImage = @$myFavouritArtistPic['thumb_h'];}
			 					  else{$myFavouritArtistProfileImage = @$current_Favorite_Artist['youTubeProfilepic'];}
								  ?>
                                  
                        <div class="about_fan_text_fav_artist">Current Favorite Artist:</div>
                        <div class="about_fan_text_fav_artist_box">
                        	<?php if(count($current_Favorite_Artist_1) > 0){ ?>
                            <div class="about_fan_fav_artist_img">
                            <img src="<?php echo $myFavouritArtistProfileImage;?>" width="78" height="54" border="0" /></div>
                            <div class="about_fan_fav_artist_name">
							<?php   
						  	$current_Favorite_Artist_Name = $current_Favorite_Artist['user_firstname'].' '.$current_Favorite_Artist['user_lastname'];
						  	if(strlen($current_Favorite_Artist_Name)>25){
						  	$current_Favorite_Artist_Name= substr($current_Favorite_Artist_Name,0,25).'...';
						  	}
						  	echo ucfirst($current_Favorite_Artist_Name);  
							?>
                          </div>
                        	<div class="about_fan_text_bio">Bio:</div>
                            <div class="about_fan_text_bio_text"><?php echo ucfirst($current_Favorite_Artist['bio']);?></div>
                            <?php }else{ ?>
                           <h2 style="font-size:12px;text-align:center;">No favorite artist.</h2>
                            <?php }?>
						</div>
                        
                    </div>
                    <div class="about_fan_bg_bot"></div>
                    <div class="our_connections_outer">
                    	<div class="about_artist_bg_top">
                        My tune crew
                        </div>
                        <div class="about_artist_bg_cen">
                       		<?php $myTuneCrew = $model_fan_default->getMyTuneCrew($idUser);?>
                            <?php for($p=0;$p<count($myTuneCrew);$p++){?>
                            <?php $myTuneCrewOb = $model_fan_default->getFanData($myTuneCrew[$p]['artist_id']);
									//print_r($myTuneCrewOb);
								  $myTuneCrewPic = @unserialize($myTuneCrewOb['youTubeProfilepic']);
								  if(@is_array($myTuneCrewPic)){ $myTuneProfileImage = @$myTuneCrewPic['thumb_h'];}
			 					  else{$myTuneProfileImage = @$myTuneCrewOb['youTubeProfilepic'];}
								  //echo $myTuneProfileImage;?>
                            <div class="my_crue_artist">
                            	<img src="<?php echo  $myTuneProfileImage; ?>" border="0" width="133" height="94"  onclick="getPublicProfile('<?php echo $myTuneCrewOb['user_id'];?>','<?php echo $myTuneCrewOb['type'];?>')"  style="cursor:pointer;"/>
                                <div class="crue_artist_text"><?php echo ucfirst($myTuneCrewOb['user_firstname']);?></div>
                            </div>
                            <?php } if(count($myTuneCrew) <=0){ ?>
                      
                             <h2 style="font-size:12px;text-align:center;">No tune crew.</h2>
                           
                            <?php }?>
                            
                            
                            <div class="my_crue_artist_clr"></div>
                            
                        </div>
                        <div class="about_artist_bg_bot"></div>
                    </div>
                </div>
                
                
                
            </div>
            <?php }else{ ?>
            <div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;height:410px">
               <div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:auto; padding:1% 2% 1% 2%; float:left;">
               <h1 align="center">Please login to view your profile.</h1>
               <div class="clr"></div>
               </div>
               </div>
            <?php } ?>
        </div>
		<!--  end content-table-inner ............................................END  -->
		