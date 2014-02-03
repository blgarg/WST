<?php 
include '../settings.php';
require_once('session/session.php');
require_once('mysql/mysql.php');
global $config_var;  
class contestDetail extends JDatabaseMySQL
{


    function initialize(){ return;}
	function getvarp(){return ;}
	function getContest($cId)
	{	
		          
					$this->qry = "select * from mgl_contest WHERE contestId = '".$cId."'";
					$this->sql = $this->qry;
					if($this->query())
					{
						return $this->loadAssoc();
					}
	 }
	 
	 function getContestVideoList($cId)
  {	
  
   $this->qry = "select DISTINCT mgl_videodetail.*,mgl_contest_video.userId from mgl_contest_video,mgl_videodetail, mgl_video_rating_update WHERE mgl_videodetail.vid = mgl_contest_video.VideoId AND mgl_video_rating_update.video_id = mgl_videodetail.vid AND mgl_videodetail.uId = mgl_contest_video.userId  AND  mgl_contest_video.contestId = '".$cId."'  ORDER BY mgl_video_rating_update.rating  DESC limit 4";
	$this->sql = $this->qry;
		if($this->query())
		{return $this->loadAssoc();}
	}	
	 
	 
	 function getLikes($video_id, $contest_id){
					$this->qry = "select count(*) as liked from  mgl_video_rating WHERE video_id='$video_id' AND contest_id ='$contest_id' AND unique_hit_count = '1'";
					$this->sql = $this->qry;
					$this->query();
					$result = $this->getArray();
					
					$numLikes = (int)$result['liked'];
					
					return $numLikes;
	}
	
	
	function getDisLikes($video_id, $contest_id){
					$this->qry = "select count(*) as dislike from  mgl_video_rating WHERE video_id='$video_id' AND contest_id ='$contest_id' AND unique_hit_count = '-1'";
					$this->sql = $this->qry;
					$this->query();
					$result = $this->getArray();
					
					$numLikes = (int)$result['dislike'];
					
					return $numLikes;
	}
    
	function getComments($video_id, $contest_id){
		$this->qry = "select * from  mgl_video_comments_update WHERE video_id='$video_id' AND contest_id ='$contest_id'";
					$this->sql = $this->qry;
					$this->query();
					$result = $this->getArray();
					
					$NumOfComments = (int)$result['total_comments'];
					
					return $NumOfComments;
	}
}


 $contest = new contestDetail();
 $contestDetail = $contest->getContest($_REQUEST['contestId']);
 $contestVideoList = $contest->getContestVideoList($_REQUEST['contestId']);
 $session = new session();
 $userId= $session->getVar("userAccountID");
 $_SESSION['contestId'] = $contestDetail[0]['contestId'];

    $checkImage = false;
	$imgPath = $config_var->UPLOAD_ROOT.'contestBanner/resizedImg/'.$contestDetail[0]['contestId']."_img.".$contestDetail[0]['imgExt'];
	if(file_exists($imgPath)){
	$imgPath = $config_var->UPLOAD_URL.'contestBanner/resizedImg/'.$contestDetail[0]['contestId']."_img.".$contestDetail[0]['imgExt'];
	$checkImage = false;
	}
	else{
	$imgPath = $config_var->UPLOAD_URL.'contestBanner/thumbs/'."no-image.gif";
	$checkImage = true;
	}
	
	
	
 
 						$m1 = 	 date("m");
						$m2 = 	 date("m",strtotime($contestDetail[0]['endDate']));
						$day1 =  date("d");
						$day2 =  date("d",strtotime($contestDetail[0]['endDate']));
						$y1 =    date("Y");
						$y2 =    date("Y",strtotime($contestDetail[0]['endDate']));
						$h1 =    date("g");
						$h2 =    date("g",strtotime($contestDetail[0]['endDate']));
												
					
						$d1= mktime($h1,0,0,$m1,$day1,$y1);
                        $d2= mktime($h2,0,0,$m2,$day2,$y2);
						
						
						$hrs = floor(($d2-$d1)/3600);
						$Mins = floor(($d2-$d1)/60);
						$Sec =($d2-$d1);
						$Months = floor(($d2-$d1)/2628000);
						$Days = floor(($d2-$d1)/86400);
						$years = floor(($d2-$d1)/31536000);
						
						//echo $hrs;
						$days = floor($hrs/24);
						$hours = floor($hrs%24);
						
						if($hrs < 0){
							$day = "Expired";
							$hrs_s = '';
						}
						if($days > 0){
							$day = $days."&nbsp;Days";
					    	$hrs_s = $hours.' hours';
						}
 ?>
 
 
 <script>
function ClickButtonForUploadButton()
{
	var videoTitle;
	var videoDescription;
	var videoCategory;
	var videoTags;
	try{
		videoTitle = document.uploadForm.videoTitle.value;
		videoDescription = document.uploadForm.videoDescription.value;
		videoCategory = document.uploadForm.videoCategory.value;
		videoTags = document.uploadForm.videoTags.value;
		if(videoTitle == ''){ throw "videoTitle";}
		else if(videoDescription == ''){ throw "videoDescription";}
		else if(videoCategory == ''){ throw "videoCategory";}
		else if(videoTags == ''){ throw "videoTags";}
		else{
		ytVideoApp.prepareSyndicatedUpload(videoTitle, videoDescription,videoCategory, videoTags); 
		}
		return false;
	}catch(e){  if(e == "videoTitle"){alert('Please fill video title');document.uploadForm.videoTitle.focus();}
				if(e == "videoDescription"){alert('Please fill video description');document.uploadForm.videoDescription.focus();}
				if(e == "videoCategory"){alert('Please select video title');document.uploadForm.videoCategory.focus();}
				if(e == "videoTags"){alert('Please enter at least one tag.');document.uploadForm.videoTags.focus();}
		    	
			}
}

 function getSelectedOption(str){
     $('#select_exitsing_video').attr('checked', false);
	  $('#select_new_video').attr('checked', false);
	 closePopUp('choseoptionpopup')
	 str = parseInt(str);
	 if(str){
	 showVideoUploadform('videouploadform',0);
	 }else{
	  $('#youtube_video_link').val('');
	  $('#url_error').html('');
	  urlPasePopUp('paste_youtube_VideoLink',0);
	 }
 }
 
 
 
 function getQuerystring(key,contestId)
{
  $('#url_error').html('');
  if(trim($('#youtube_video_link').val()) == ''){
  $('#url_error').html('Please enter video link');
   return false;
  }
  
  if(!isUploadValidUrl($('#youtube_video_link').val())){
   $('#url_error').html('Please enter valid youtube video link');
   return false
  }
 
  key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
  var qs = regex.exec($('#youtube_video_link').val());
   if(qs){
    hideAlert();
    urlPasePopUpWait('paste_youtube_VideoLinkWait',0);
    ytVideoApp.getAddVideoDeatil(qs[1],contestId);
   }else{
     $('#url_error').html('Please enter valid youtube video link');
     return false;
   }
   $('#youtube_video_link').val('');
  // return qs[1];
 }
 
 
 
 function choseoptionpopup(popupId,message)
{
    var popID = popupId; //Get Popup Name
    var popWidth = 600; //Gets the first query string value
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) });
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;
    $('#' + popID).css({
        'margin-left' : -popMargLeft
    });
    $('body').append('<div id="fade"></div>');
    $('#fade').css({'filter' : 'alpha(opacity=40)'}).fadeIn();
	
}


 function urlPasePopUp(popupId,message)
{
    var popID = popupId; //Get Popup Name
    var popWidth = 600; //Gets the first query string value
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) });
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;
    $('#' + popID).css({
        'margin-left' : -popMargLeft
    });
    $('body').append('<div id="fade"></div>');
    $('#fade').css({'filter' : 'alpha(opacity=40)'}).fadeIn();
	
}


function urlPasePopUpWait(popupId,message)
{
    var popID = popupId; //Get Popup Name
    var popWidth = 600; //Gets the first query string value
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) });
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;
    $('#' + popID).css({
        'margin-left' : -popMargLeft
    });
    $('body').append('<div id="fade"></div>');
    $('#fade').css({'filter' : 'alpha(opacity=40)'}).fadeIn();
	
}


function showVideoUploadform(popupId,message)
{
    var popID = popupId; //Get Popup Name
    var popWidth = 600; //Gets the first query string value
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) });
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;
    $('#' + popID).css({
        'margin-left' : -popMargLeft
    });
    $('body').append('<div id="fade"></div>');
    $('#fade').css({'filter' : 'alpha(opacity=40)'}).fadeIn();
	
}


function checkValidExt(){
  if(trim($('#upload_file_value').val()) ==''){
  $('#extvalidationError').html('Please select a file.');
   return false;
  }
  
  var ext = getFileExtension('upload_file_value');
  if(ext == '.flv' || ext == '.wmv' || ext == '.mpg' || ext == '.avi' || ext == '.mov' || ext == '.mp4'){
  return true
  }else{
    $('#extvalidationError').html('Please select valid extension  file. Only following extension files are allowed(flv,wmv,mpg,avi,mov,mp4)');
    return false;
  } 
 
}


function setForm(){
 $('#videouploadform').html('<div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert();"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/cross_icon.png" alt=""  width="25" height="25" /></a></div><h3>Please fill video details</h3><form  id="uploadForm" name="uploadForm"><table width="494" border="0" cellpadding="2" cellspacing="2"><tr><td width="484" colspan="3" align="left" valign="top" height="20">Enter video title</td></tr><tr><td width="484" align="left" colspan="3" valign="top" height="20"><input type="text" name="videoTitle" size="50" /></td></tr><tr><td width="484" align="left" colspan="3" valign="top">Enter video description</td></tr><tr style="height:30px;"><td width="484" align="left" colspan="3" valign="top"><textarea name="videoDescription" cols="50"  style="resize:none;"></textarea></td></tr><tr style="height:30px;margin-top:15px;"><td width="484" align="left" colspan="3" valign="top">Select a category</td></tr><tr><td align="left" valign="top"><select name="videoCategory"><option value="Music">Music</option></select></td></tr><tr><td width="484" colspan="3" align="left" valign="top">Enter some tags to describe your video <em>(separated by spaces)</em></td></tr><tr><td width="484" colspan="3" align="left" valign="top"><input type="text" value="tunezy" size="50" name="videoTags"></td></tr><tr><td width="484" colspan="3" align="left" valign="top"><input type="button" value=" Upload "  onclick="ClickButtonForUploadButton();" class="btn_class" style="cursor:pointer;"></td></tr></table></form>');
$('#videouploadform').hide();
}

</script>
<div class="artist_page_outer">
        	<div class="artist_page">
              <div class="contest_bg_outer">
                	<div class="contest_bg_top"><?php echo ucfirst ($contestDetail[0]['contestTitle']);?><span style="float:right;font-size:12px;margin-right:15px;">
                    <a onclick="goback(1);" title="Go back " href="javascript:;" style="color:#FFFFFF;">GO BACK</a></span></div>
                    <div class="contest_bg_cen">
                    	<div class="contest_heading">
                         Contest Detail
                        </div> 
                        <div class="contest_details" >
                       		<!--Contest Detail Text-->
                            <div class="contest_detail_txt" >
                            	<!--Image Div-->
                                <div class="contest_img_div" style="height:220px;">
                                <?php if($checkImage){?>
                                <img src="<?php echo $imgPath;?>" alt=""    style="height:220px;width:360px;" />
                                <?php }else{?>
                                <img src="thumb.php?sizex=350&sizey=250&quality=100&nocache=1&file=/uploads/contestBanner/originalImg/<?php echo $contestDetail[0]['contestId']."_img.".$contestDetail[0]['imgExt'];?>" alt=""    style="height:220px;width:360px;" />
                                <?php } ?>
                                	
                                </div>
                                <!-- //Image Div-->
                                
                                <!--Contest Right Text-->
                                <div class="contest_rt_div">
                                	<h3><?php echo ucfirst ($contestDetail[0]['contestTitle']);?></h3>
                                    	<table width="100%" border="0" cellspacing="0" cellpadding="4" style="margin-top:30px; margin-bottom:10px;">
                                      <tr>
                                        <td width="120" height="25" align="left" valign="top">Starting Date: </td>
                                        <td align="left" valign="top"><?php echo date("d M Y",strtotime($contestDetail[0]['startDate']));?></td>
                                      </tr>
                                      <tr>
                                        <td width="120" height="25" align="left" valign="top">End Date:</td>
                                        <td align="left" valign="top"><?php echo date("d M Y",strtotime($contestDetail[0]['endDate']));?></td>
                                      </tr>
                                      <tr>
                                        <td width="120" height="25" align="left" valign="top">Time Left: </td>
                                        <td align="left" valign="top"> <?php echo $day ;?></td>
                                      </tr>
                                      <tr>
                                        <td width="120" height="25" align="left" valign="top">Price:</td>
                                        <td align="left" valign="top">
                                        $<?php echo (int)$contestDetail[0]['price'];?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="120" height="25" align="left" valign="top" colspan="2">
                                        	<script>function fbs_click() {u=location.href;t=<?php echo ucfirst ($contestDetail[0]['contestTitle']);?>;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url(<?php echo $config_var->WEB_TPL_URL;?>/images/contest_facebook_share.jpg?6:26981) no-repeat top right;width:70px;height:30px; }  </style> <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;"></a></a>
                                        </td>
                                      </tr>
                                    </table>
                                    
                                </div>
                                 <!-- //Contest Right Text-->
                                 
                                 
                                    <span class="clr"  style="margin-top:40px;">
                                    	<?php echo ucfirst($contestDetail[0]['contestDesc']);?>
                                    </span>
                            
                            </div>
                            <!-- //Contest Detail Text-->
                  
                            
                            <!--Contest Detail Text-->
                            <div class="contest_detail_txt">
                            	
                            	 <span>
                                 		<h2>Contest Rules</h2>
                                        
                                 	  <table width="100%" border="0" cellspacing="4" cellpadding="0">
                                      <tr>
                                        <td width="25" align="right" valign="top">&nbsp;</td>
                                        <td align="left" valign="top">
                                        	<?php echo ucfirst($contestDetail[0]['contestRules']);?>
                                        </td>
                                      </tr>
                                      
                                    </table>
                                 
                              </span>
                            	
                                
                               
                            </div>
                            <!-- //Contest Detail Text-->
                            
                            
                            
                             <!--Contest Detail Text-->
                            <div class="contest_detail_txt">
                            	
                            	 <span>
                                 		<h2 style="width:400px; float:left;">
                                        	Contest Entries
                                        </h2>
                                         <span style="font-size:15px; color:#f37d21; font-weight:normal;float:right; width:100px;">
                                         	<a href="javascript:;" style="font-size:15px; color:#f37d21; text-decoration:none; " title="Sort by Rating">
                                            <b><!--Sort by Rating--></b>
                                            </a>
                                         </span>
                                        
                                 	 <!--Contest Entries Image Outer-->
                                     <div class="contest_entries_img_Outer" style="float:left;height:auto;font-weight:normal !important;font-size:12px;width:860px;margin-left:30px;">
                                     <?php $videoList = $contest->getContestVideoList($contestDetail[0]['contestId']);
										   for($j=0;$j<count($videoList);$j++){ ?>
    <div class="contest_video_outer" style="width:170px;margin-right:35px;margin-bottom:20px;"  onmouseover="ShowAddtoplayListButton('<?php echo $videoList[$j]['vid'];?>')" onmouseout="HideAddtoplayListButton('<?php echo $videoList[$j]['vid'];?>')">                                       
    <div class="contest_video"  style="height:83px;border:#CCCCCC 4px solid;width:170px;">
        <a  onclick="ytVideoApp.presentVideo('<?php echo $videoList[$j]['vid'];?>');" class="personPopupTrigger" href="javascript:;" rel="<?php echo  $videoList[$j]['userId']; ?>,a17bee64-8593-436e-a2f8-599a626370df">
        <img src="<?php echo  $videoList[$j]['vthumbs']; ?>" border="0" width="170" height="83" />
        </a>
        <div style="position:relative; top:-70px; left:55px; z-index:999; cursor:pointer;">
  <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/play.png" title="Play" alt="Play" onclick="ytVideoApp.presentVideo('<?php echo $videoList[$j]['vid'];?>');" />
 </div>
     <span style="left:144px;top:-90px; position:relative; z-index:333;display:none;" id="<?php echo $videoList[$j]['vid'];?>" onclick="openPlayListDiv('addToPlayList','<?php echo $videoList[$j]['vid'];?>','<?php echo $userId ; ?>');"> <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/add_to_playlist.png" alt="Add" title="Add to playlist"  /> </span>
    </div>
    <div class="like_thumbs" style="width:180px;">
    <div class="thumb_left" style="width:27px;float:left">
    <a href="javascript:;" onclick="openVideoRateDiv('addToPlayList','<?php echo  $videoList[$j]['vid']; ?>',<?php echo $contestDetail[0]['contestId'];?>,'doLike');">							       <img src="<?php echo $config_var->WEB_TPL_URL;?>/images/contest_video_like.jpg" border="0" width="27" height="18" />
    </a>
    </div><div class="thumb_right" style="float:left;color:#333333;min-width:7px;width:auto;margin-right:5px;" id="like_<?php echo  $videoList[$j]['vid']; ?>">&nbsp;<?php echo $contest->getLikes($videoList[$j]['vid'],$contestDetail[0]['contestId']); ?>
    </div>
    <div class="thumb_left" style="width:30px;float:left">
    <a href="javascript:;" onclick="openVideoRateDiv('addToPlayList','<?php echo  $videoList[$j]['vid']; ?>',<?php echo $contestDetail[0]['contestId'];?>,'doDisLike');"><img src="<?php echo $config_var->WEB_TPL_URL;?>/images/contest_video_dislike.jpg" border="0" width="27" height="18" /></a></div>
    <div class="thumb_right" style="float:left;width:60px;color:#333333" id="dislike_<?php echo  $videoList[$j]['vid']; ?>">&nbsp;<?php echo $contest->getDisLikes($videoList[$j]['vid'],$contestDetail[0]['contestId']); ?></div>
    </div>
    
    <div class="like_thumbs" style="width:180px;">
    <div class="thumb_left" style="width:65px;">
<a href="javascript:;" onclick="openVideo_Comment_Div('video_comments','<?php echo  $videoList[$j]['vid']; ?>',<?php echo $contestDetail[0]['contestId'];?>);" style="text-decoration:none;"><strong>Comments</strong>:&nbsp;</a></div>
    <div class="thumb_right" style="float:left;width:90px;color:#333333;text-align:left;" id="dislike_<?php echo  $videoList[$j]['vid']; ?>">&nbsp;
	<?php echo $contest->getComments($videoList[$j]['vid'],$contestDetail[0]['contestId']); ?></div>
    
    </div>
    </div>
                                       <?php } ?> 
                                     </div>
                                     
                                      <!-- //Contest Entries Image Outer-->
                                      
                                      
                                      
                                      	 <!--Contest Entries Image Outer-->
                                     
                                      <!-- //Contest Entries Image Outer-->
                                   
                                 	
                              </span>
                            	
                                 <span style="font-size:15px; color:#f37d21; font-weight:normal;float:right; width:400px; text-align:right;">
                                 <a href="javascript:;" style="font-size:15px; text-decoration:none; color:#f37d21;" title="View more" onclick="getContestEntries(1,<?php echo $contestDetail[0]['contestId'];?>);"><b>View more...</b> </a><?php if($userId !=''){?>&nbsp;|&nbsp;<a href="javascript:;" style="font-size:15px; text-decoration:none; color:#f37d21;" onclick="choseoptionpopup('choseoptionpopup',0)"><b>Click here to Participate</b></a><?php } ?>
                                 </span>
                
             <!--   onclick=""  -->            
              </div>
                            <!-- //Contest Detail Text-->
                           
                        </div>                     
                    </div>
                    <div class="contest_bg_bot"></div>
                </div>
            </div>
        </div>
        <div class="clr"></div>
     <div id="videouploadform" class="alert_block" style="text-align:center;top:100px;">
    
     <div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert();"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/cross_icon.png" alt=""  width="25" height="25" /></a></div>
      
       <h3>Please fill video details</h3>		
<form  id="uploadForm" name="uploadForm">
<table width="494" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td width="484" colspan="3" align="left" valign="top" height="20">Enter video title</td>
  </tr>
  <tr>
    <td width="484" align="left" colspan="3" valign="top" height="20"><input type="text" name="videoTitle" size="50" /></td>
  </tr>
  <tr>
    <td width="484" align="left" colspan="3" valign="top">Enter video description</td>
  </tr>
  <tr style="height:30px;">
    <td width="484" align="left" colspan="3" valign="top"><textarea name="videoDescription" cols="50"  style="resize:none;"></textarea></td>
  </tr>
<tr style="height:30px;margin-top:15px;">
    <td width="484" align="left" colspan="3" valign="top">Select a category</td>
    </tr>
  <tr>
     <td align="left" valign="top"><select name="videoCategory"><option value="Music">Music</option></select></td>
  </tr>
  
  <tr>
    <td width="484" colspan="3" align="left" valign="top">Enter some tags to describe your video <em>(separated by spaces)</em></td>
  </tr>
  <tr>
    <td width="484" colspan="3" align="left" valign="top"><input type="text" value="tunezy" size="50" name="videoTags"></td>
  </tr>
   <tr>
    <td width="484" colspan="3" align="left" valign="top"><input type="button" value=" Upload "  onclick="ClickButtonForUploadButton();" class="btn_class" style="cursor:pointer;"></td>
  </tr>
</table>
</form>
  
 </div>   
 
 
 
 
 
 <div id="choseoptionpopup" class="alert_block" style="text-align:center;top:100px;">
     
        <div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert();"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/cross_icon.png" alt=""  width="25" height="25" /></a></div>
       
       <h3>Participate to contest</h3><br />	
       <input type="radio" id="select_exitsing_video" name="choose_option" value="0" onclick="getSelectedOption(0)"/>Add video from youtube.
       <input type="radio" id="select_new_video" name="choose_option" value="1" onclick="getSelectedOption(1)"/>Upload new video. <br />
       <br /><br /><br /><br /><br />
 </div>
 
 
 
  <div id="paste_youtube_VideoLink" class="alert_block" style="text-align:center;top:100px;">
      
       <div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert();"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/cross_icon.png" alt=""  width="25" height="25" /></a></div>
       
      <!--Sign Up Mid Bg-->
       
       <h3>Participate to contest</h3><br />	
       <div id="url_error" style="color:#FF0000;"></div>
       <span style="font-weight:bold;">Paste youtube url: </span><input type="text" id="youtube_video_link" name="youtube_video_link" style="width:420px; height:28px;cursor:pointer;"/><br /><br />
       <input type="button" value="Submit"  onclick="getQuerystring('v','<?php echo $contestDetail[0]['contestId'];?>');" class="btn_class" style="cursor:pointer;">
       
        <br /><br /><br />
    
 </div>
 
 
 <div id="paste_youtube_VideoLinkWait" class="alert_block" style="text-align:center;top:100px;">

    <br/><br />
      <div id="UserInfoContent" style="text-align:center"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/loader.gif"  alt="loading" /></div><br />
    <br/><br />
</div>