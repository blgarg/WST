<?php 
 global $config_var;
 require_once($config_var->LIB_ROOT.'session/session.php');
   
 require_once($config_var->LIB_ROOT.'users/fan_db.php');
 global $DataSet;
 global $model;

$session = new session();
$model_fan_default = new model_fan_default();
//$sessionVar = $session->printSession();
$idUser = @$session->getVar("userAccountID");
$fan = $model_fan_default->getFanData($idUser);
$fanPlayList = $model_fan_default->getPlayList();
//print_r($fanPlayList);
?>
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