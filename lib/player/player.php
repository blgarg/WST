<!--
You are free to copy and use this sample in accordance with the terms of the
Apache license (http://www.apache.org/licenses/LICENSE-2.0.html)
-->
<?php
 include '../../settings.php';
 require_once('../../inc/load.php');
 $session = new session();
 $userId = $session->getVar("userAccountID");

 class PlayerModel extends JDatabaseMySQL{
     
	  function getFirstSong($playId = NULL){
	     if($playId){
		  $this->qry = "SELECT mgl_videodetail.* FROM mgl_videodetail,mgl_fan_playlist WHERE mgl_videodetail.vid=mgl_fan_playlist.youtube_video_id AND mgl_fan_playlist.playList_id='".$playId."' AND mgl_fan_playlist.user_id = '".$_SESSION['userAccountID']."' LIMIT 0,1";
		}else{
		   if(isset($_REQUEST['mywork']) && trim($_REQUEST['mywork']) != ''){
		    $this->qry = "SELECT * FROM mgl_videodetail WHERE vid = '".$_REQUEST['mywork']."'";
		    }else {
		     $this->qry = "SELECT * FROM mgl_videodetail LIMIT 0,1";
		   }
		} 
		 $this->sql = $this->qry;
		 $this->query();
		 //$Rcdrs =  $this->getNumRows();
		$UserData = $this->loadAssoc();
		//$arrResult =  $this->loadAssoc();
		return $UserData;
	 }
	 
	 function getNewtSong($arr,$songNum){
	  
	 /* if($arr['action']=='next') {
	     $this->qry = "SELECT * FROM mgl_videodetail WHERE id > ".$arr['currentSong']."  LIMIT 0,1";
		}else{
	     $this->qry = "SELECT * FROM mgl_videodetail WHERE id < ".$arr['currentSong']." ORDER BY id DESC  LIMIT 0,1";
		 }*/
		  if(isset($_REQUEST['playListId']) && $_REQUEST['playListId']){
		 $this->qry = "SELECT mgl_videodetail.* FROM mgl_videodetail,mgl_fan_playlist WHERE mgl_videodetail.vid=mgl_fan_playlist.youtube_video_id AND mgl_fan_playlist.playList_id='".$_REQUEST['playListId']."' AND mgl_fan_playlist.user_id = '".$_SESSION['userAccountID']."' LIMIT ".$songNum.",1";
		}else{
	 	  $this->qry = "SELECT * FROM mgl_videodetail LIMIT ".$songNum.",1";
		 } 
		 $this->sql = $this->qry;
		 $this->query();
		 //$Rcdrs =  $this->getNumRows();
		$UserData = $this->loadAssoc();
		//$arrResult =  $this->loadAssoc();
		return $UserData;
	 
 }
	 
	 function showNextLink($songNum){
	     
		 if(isset($_REQUEST['playListId']) && $_REQUEST['playListId']){
		 $this->qry = "SELECT mgl_videodetail.* FROM mgl_videodetail,mgl_fan_playlist WHERE mgl_videodetail.vid=mgl_fan_playlist.youtube_video_id AND mgl_fan_playlist.playList_id='".$_REQUEST['playListId']."' AND mgl_fan_playlist.user_id = '".$_SESSION['userAccountID']."' LIMIT ".++$songNum.",1";
		}else{
	     $this->qry = "SELECT * FROM mgl_videodetail LIMIT ".++$songNum.",1";
		 }
		 $this->sql = $this->qry;
		 $this->query();
		 $UserData = $this->loadAssoc();
		 if(count($UserData)>0){
		   return true;
		 }else{
		   return false;
		 }
 }
	
	
	 function showPreviousLink($songNum){
	      if(isset($_REQUEST['playListId']) && $_REQUEST['playListId']){
		  $this->qry = "SELECT mgl_videodetail.* FROM mgl_videodetail,mgl_fan_playlist WHERE mgl_videodetail.vid=mgl_fan_playlist.youtube_video_id AND mgl_fan_playlist.playList_id='".$_REQUEST['playListId']."' AND mgl_fan_playlist.user_id = '".$_SESSION['userAccountID']."' LIMIT ".--$songNum.",1";
		}else{
		 $this->qry = "SELECT * FROM mgl_videodetail LIMIT ".--$songNum.",1";
		 }
		 $this->sql = $this->qry;
		 $this->query();
		 $UserData = $this->loadAssoc();
		 if(count($UserData)>0){
		   return true;
		 }else{
		   return false;
		 }
	}
    
	function getPlayList($playId = NULL){
	     
		 if($playId){
	  $this->qry = "SELECT mgl_videodetail.* FROM mgl_videodetail,mgl_fan_playlist WHERE mgl_videodetail.vid=mgl_fan_playlist.youtube_video_id AND mgl_fan_playlist.playList_id='".$playId."' AND mgl_fan_playlist.user_id = '".$_SESSION['userAccountID']."'";
		}else{
		  $this->qry = "SELECT * FROM mgl_videodetail LIMIT 20";
		 }
		// $this->qry = "SELECT * FROM mgl_users_playlist LIMIT 6 ";
		
		 $this->sql = $this->qry;
		 $this->query();
		 $UserData = $this->loadAssoc();
		 return $UserData;
	}
	
	function getPlayListTime($Id){
	 
	   $this->qry = "SELECT SUM(mgl_videodetail.vduration) AS totalDuaration FROM mgl_fan_playlist,mgl_videodetail WHERE mgl_videodetail.vid = mgl_fan_playlist.youtube_video_id AND playList_id = '".$Id."' ";
		$this->sql = $this->qry;
		$this->query();
		$UserData = $this->loadAssoc();
		if(count($UserData)>0){
		return $UserData[0]['totalDuaration'];
		}else{
		return 0 ;
		}
	}
	
	function getUserDetail($songId){
	   
	     $this->qry = "SELECT mgl_users.* FROM mgl_videodetail,mgl_users WHERE mgl_videodetail.uId = mgl_users.user_id AND mgl_videodetail.vid = '".$songId."' ";
		 $this->sql = $this->qry;
		 $this->query();
		 $UserData = $this->loadAssoc();
		 return $UserData; 
	}
	
	function getCountry($cId){
	   $this->qry = "SELECT name FROM country WHERE id = '".$cId."'";
	   $this->sql = $this->qry;
	   $this->query();
	   $UserData = $this->loadAssoc();
	   return $UserData[0]['name'];
	}
	
	
	function insertLastPlaySong($playId){
	   $this->qry = "DELETE FROM lastplaysong WHERE uId = '".$_SESSION['userAccountID']."'";
	   $this->sql = $this->qry;
	   $this->query();
	   $this->qry = "INSERT INTO lastplaysong(uId,playId,datePlay)VALUES('".$_SESSION['userAccountID']."','".$playId."',now())";
	   $this->sql = $this->qry;
	   $this->query();
	}
 
 }
 
  $playerObj = new PlayerModel();
  $showNext = $showPrevious=false;
  $autoPlay=0;
  $topDisplay = '';
  $bottomDisplay = 'display:none;';
	
  if(isset($_REQUEST['frameHeight']) && $_REQUEST['frameHeight'] == '35px'){
    $topDisplay = '';
    $bottomDisplay = 'display:none;';
  }
  
  if(isset($_REQUEST['frameHeight']) && $_REQUEST['frameHeight'] == '400px'){
    $topDisplay = 'display:none;';
    $bottomDisplay = '';
  }
 
  $songCount = isset($_REQUEST['songCount']) ? $_REQUEST['songCount'] : '0'; 
  $playListId = isset($_REQUEST['playListId']) ? $_REQUEST['playListId'] : '';
 if($playListId!=''){
     $playList = $playerObj->getPlayList($playListId);
	  if(isset($_REQUEST['songCount']) && $_REQUEST['isplaylistchange']=='yes') $songCount=0;
 }else{
    $playList = $playerObj->getPlayList();
}
  
  if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'getNewSong' && isset($_REQUEST['mywork']) && trim($_REQUEST['mywork'])=='' && isset($_REQUEST['isplaylistchange']) && trim($_REQUEST['isplaylistchange'])==''){
			
			/*echo "<pre>";
			print_r($_REQUEST);
			echo "</pre>";*/
			$songDetail=$playerObj->getNewtSong($_REQUEST,$songCount);
			$songId= $songDetail[0]['id'];
			$userDetail =   $playerObj->getUserDetail($songDetail[0]['vid']);
			if($playerObj->showNextLink($songCount)){
			 $showNext = true;
			}
			if($playerObj->showPreviousLink($songCount)){
			 $showPrevious = true;
			}
             if($_REQUEST['action']=='next'){
			  if($showNext){ 
			   ++$songCount ;
			  }else{
			   --$songCount ;
			  }
			}else{
			  if($showPrevious){
			  
			   --$songCount;
			  }else{
			    ++$songCount;
			  }
			}
   
 }else{
 
	   if(isset($_REQUEST['playListId']) && trim($_REQUEST['playListId']) !=''){
	    $songDetail=$playerObj->getFirstSong($_REQUEST['playListId']);
	    }else{
	    $songDetail=$playerObj->getFirstSong();
	   } 
	   $songId= $songDetail[0]['id'];
	   $userDetail =   $playerObj->getUserDetail($songDetail[0]['vid']);
	   if($playerObj->showNextLink($songCount)){
	    $showNext = true;
         ++$songCount;
	   }
 }
 
 $playId =  (isset($_REQUEST['mywork']) && trim($_REQUEST['mywork'])!='') ?  $_REQUEST['mywork'] : $songDetail['0']['vid'] ;
$currentPlayListName= isset($_REQUEST['currentPlatlistName']) ? $_REQUEST['currentPlatlistName'] : 'All Songs';
$autoPlay=(isset($_REQUEST['act']) && $_REQUEST['act'] == 'getNewSong' ) ? 1 : 0;

if(isset($_SESSION['userAccountID']) && $_SESSION['userAccountID'] != ''){
  if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'getNewSong'){
   $playerObj->insertLastPlaySong($playId);
  }

}
 //echo $songCount;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>YouTube Player API Sample</title>
<style>
	body {
	margin:0;
	padding:0;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#333333;
	width: 100%;
    height: 100%;
}
	.music_bar_outer{
	width:100%;
	float:left;
	position:fixed;
	bottom:0;
	height: auto;  
	z-index:8;
	
}
.music_bar{
	width:997px;
	height:36px;
	margin:auto;
	background:url(<?php echo  $config_var->WEB_TPL_URL; ?>images/music_bar_bg.png) left top no-repeat;

}
.music_bar-txt{
	width:350px;
	height:30px;
	line-height:30px;
	margin:0 5px 0 30px;
	color:#676666;
	float:left;
	font-size:15px;

}
.music_bar-txt span{
  color:#2c2c2c;
  float:left;
  font-size:18px;
  margin-right:5px;
}
.music_bar-time{
	width:140px;
	height:25px;
	line-height:25px;
	margin:5px 5px 0 0px;
	color:#676666;
	float:left;
	font-size:20px;
	text-align:center;
	background:url(<?php echo  $config_var->WEB_TPL_URL; ?>images/time_bg.png) 0 0 no-repeat;

}
.music_icons_div{
	width:170px;
	height:31px;
	line-height:31px;
	margin:3px 5px 0 5px;
	float:left;
 }
.pause, .play, .stop, .next, .prev{
	width:31px;
	height:31px;
	text-align:center;
	float:left;
	margin-right:3px;
}
.view_artist{
	width:60px;
	height:31px;
	float:left;
	margin:4px 20px 0 0px;
}
.view_artist_txt{
	width:40px;
	height:31px;
	line-height:15px;
	float:left;
	color:#010101;
	font-size:12px;

}

.share_video{
width:118px;
height:31px;
float:left;
margin:4px 5px 0 5px;

}
.share_video_txt{
	width:40px;
	height:31px;
	line-height:15px;
	float:left;
	color:#010101;
	font-size:12px;

}
.music_bar-arrow{
 width:23px;
height:23px;
float:right;
margin:8px 20px 0 5px;

}
.music_player_outer{
	width:100%;
	float:left;
	bottom:0;
	
}
.music_player{
	width:997px;
	height:366px;
	margin:auto;
}
.music_player_bg{
	width:997px;
	height:366px;
	float: left;
	background: url(<?php echo  $config_var->WEB_TPL_URL; ?>images/vid_payer_bg.png) left top no-repeat;
}
.video_bg{
	background: url(<?php echo  $config_var->WEB_TPL_URL; ?>images/video_bg.png) no-repeat;
	widows: 514px;
	height: 321px;
	margin:10px 0 0 12px;
	padding: 15px;
	float:left;
}
.video{
	float:left;
}
.player_playlist_outer{
	width: 441px;
	float:left;
	margin: 10px 0 0 18px;
}
.player_playlist_bg_top{
	background: url(<?php echo  $config_var->WEB_TPL_URL; ?>images/playlist_top.png) no-repeat;
	width: 431px;
	height: 35px;
	float: left;
	font-family: arial;
	font-size: 18px;
	color: #ffffff;
	line-height: 35px;
	text-transform: uppercase;
	padding: 0 0 0 10px;
	font-weight: bold;
}
.player_playlist_bg_cen{
	background:url(<?php echo  $config_var->WEB_TPL_URL; ?>images/vid_player_playlist_cen.jpg) repeat-y;
	width: 441px;
	float: left;
}
.player_playlist_bg_bot{
	background:url(<?php echo  $config_var->WEB_TPL_URL; ?>images/vid_player_playlist_bot.png) no-repeat;
	width: 441px;
	height: 35px;
	float: left;
}
.player_playlist_content{
	width: 441px;
	float:left;
	margin:0;
}
.player_playlist_text_main{
	width: 423px;
	background: url(<?php echo  $config_var->WEB_TPL_URL; ?>images/playlist_tracks_bg.jpg) repeat-x;
	height: 32px;
	float: left;
	margin: 0 0 0 1px;
}

.player_playlist_text_main .left_text{
	width: 340px;
	height: 32px;
	float: left;
	font-family: arial;
	font-size: 13px;
	line-height: 32px;
	font-weight: bold;
	color: #555555;	
	margin: 2px 0 0 0;
	text-decoration: none;
	padding: 0 0 0 10px;
}
.player_playlist_text_main .right_text{
	width: 60px;
	height: 32px;
	float: right;
	font-family: arial;
	font-size: 13px;
	line-height: 32px;
	font-weight: bold;
	color: #555555;	
	margin: 0 0 0 10px;
	text-decoration: none;
}

.player_playlist_text_main_total{
	width: 437px;
	height: 32px;
	float: left;
	margin: 0 0 0 2px;
}
.player_playlist_text_main_total .left_text{
	width: 340px;
	height: 32px;
	float: left;
	font-family: arial;
	font-size: 13px;
	line-height: 32px;
	font-weight: bold;
	color: #555555;	
	margin: 2px 0 0 0;
	text-decoration: none;
	padding: 0 0 0 10px;
}
.player_playlist_text_main_total .right_text{
	width: 75px;
	height: 32px;
	float: right;
	font-family: arial;
	font-size: 13px;
	line-height: 32px;
	font-weight: bold;
	color: #555555;	
	margin: 0 0 0 10px;
	text-decoration: none;
}
.player_playlist_btns{
	width: 437px;
	height: 32px;
	float: left;
	margin: 9px 0 0 2px;
}
.player_playlist_btns .btns{
	width: 39px;
	height: 16px;
	float: left;
	margin: 16px 2px 0 0;
}
.player_about_artist_bg_cen{
	background:url(<?php echo  $config_var->WEB_TPL_URL; ?>images/player_artist_info.png);
	width: 441px;
	height:71px;
	float: left;
	margin: 10px 0 0 18px;
}

.player_about_artist_text_born{
	width: 175px;
	margin:6px 0 0 12px;
	float: left;
	font-family: arial;
	font-size: 12px;
	color: #000000;	
	font-weight: bold;
}
.player_about_artist_text_born span{
	color: #999999;
	font-size: 12px;
}
.player_about_artist_text_form{
	width: 240px;
	margin:6px 0 0 12px;
	float: left;
	font-family: arial;
	font-size: 12px;
	color: #000000;	
	font-weight: bold;
}
.player_about_artist_text_form span{
	color: #999999;
	font-size: 12px;
}
.player_about_artist_text_bio{
	width: 28px;
	margin:0px 0 0 12px;
	float: left;
	font-family: arial;
	font-size: 12px;
	color: #000000;	
	font-weight: bold;
}
.player_about_artist_text_bio_text{
	width: 380px;
	margin:0px 0 0 0;
	float: left;
	font-family: arial;
	font-size: 12px;
	color: #999999;	
}

#scrollbar1 { width: 440px; margin: 2px 0 2px; }
#scrollbar1 .viewport { width: 440px; height: 130px; overflow: hidden; position: relative; }
#scrollbar1 .overview { list-style: none; position: absolute; left: 0; top: 0; padding: 0; margin: 0; }
#scrollbar1 .scrollbar{ background: transparent url(images/bg-scrollbar-track-y.png) no-repeat 0 0; position: absolute; background-position: 0 0; float: right; width: 15px; margin-left:425px; }
#scrollbar1 .track { background: transparent url(images/bg-scrollbar-trackend-y.png) no-repeat 0 100%; height: 100%; width:15px; position: absolute; }
#scrollbar1 .thumb { background: transparent url(images/bg-scrollbar-thumb-y.png) no-repeat 50% 100%; height: 20px; width: 25px; cursor: pointer; overflow: hidden; position: absolute; top: 0; left: -5px; }
#scrollbar1 .thumb .end { background: transparent url(images/bg-scrollbar-thumb-y.png) no-repeat 50% 0; overflow: hidden; height: 5px; width: 25px; }
#scrollbar1 .disable { display: none; }

</style>
    <script src="jquery.min.js" type="text/javascript"></script> 
    <script src="jquery.tinyscrollbar.min.js" type="text/javascript"></script> 
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <script type="text/javascript">
    google.load("swfobject", "2.1");
    </script>
      <script type="text/javascript">
onerror=function(){
   return true;
 }
</script>
	<script src="player.js" type="text/javascript"></script>    
  
	<script type="text/javascript">
	
	$(document).ready(function(){
        $('#scrollbar1').tinyscrollbar();
		
   });  
   
      function _run(vId){
		
		var videoID = vId;
       
        var params = { allowScriptAccess: "always"};
     
        var atts = { id: "myytplayer" };
	
        swfobject.embedSWF("http://www.youtube.com/v/" + videoID + "&enablejsapi=1&playerapiid=player1&rel=0&autoplay=<?php echo $autoPlay; ?>",
                           "videoDiv", "480", "295", "8", null, null, params, atts);
        
        
      }
      google.setOnLoadCallback(_run('<?php echo $playId ; ?>'));
      
	//QNGkZcGovag
	//oKL5ywP1HRo
	 function next(){
	  $('#action').val('next'); 
	//  var count = $('#songCount').val();
	//  $('#songCount').val(parseInt(count)+1);
	
	  $('#frameHeight').val(parent.document.getElementById('music_frame').style.height); 
	  document.song.submit();
	 }
	 
	  function previous(){
	    $('#action').val('previous');
		// var count = $('#songCount').val(); 
		//$('#songCount').val(parseInt(count)-1)
	    $('#frameHeight').val(parent.document.getElementById('music_frame').style.height); 
	    document.song.submit(); 
		return false;
	 }
	 
	function upPlayer(){
	 /*parent.document.getElementById("music_bar_outer").style.top = "auto";
	  document.getElementById("music_player_outer").style.visibility = "visible";*/
	  $('#music_bar').hide();
	  $('#music_bar_bottom').show();
	 /* document.getElementById('arrow').innerHTML ='<a href="javascript:;" onclick="downPlayer()" id="downButton" ><img src="<?php //echo  $config_var->WEB_TPL_URL; ?>images/down_arrow.png" alt="" border="0" /></a>'*/
	  document.getElementById("music_player_outer").style.visibility = "visible";
	  parent.document.getElementById('music_frame').style.height = '400px';
	  
 }
	 
	  function downPlayer(){
	 /* parent.document.getElementById("music_bar_outer").style.top = "94%";
	  document.getElementById("music_player_outer").style.visibility = "hidden";	*/
	  $('#music_bar_bottom').hide();
	  $('#music_bar').show();
	  /* document.getElementById('arrow').innerHTML ='<a href="javascript:;" onclick="upPlayer()" id="downButton" border="0"><img src="<?php //echo  $config_var->WEB_TPL_URL; ?>images/up_arrow.png" alt="" border="0" /></a>'*/
	   parent.document.getElementById('music_frame').style.height = '35px';
	   document.getElementById("music_player_outer").style.visibility = "hidden";

 }
 

function fbs_click(){
	u=location.href;
    t=document.title;
    window.open('http://www.facebook.com/sharer.php?u=http://tunezy.com&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=726,height=436');return false;
}



 function getPlayList(){
	  $.ajax({
          type: "POST",
          url: "playList.php",
          data: "action=getPlayList",
          success: function(msg){
	        parent.showUserPlayListPopUp('UserPlayListPopup');
			parent.document.getElementById('UserPlayList').innerHTML = msg ;
			//alert(msg);
          }
       });
 }
 
 
 function playSelectedSong(songNum){
	 $('#frameHeight').val(parent.document.getElementById('music_frame').style.height);
	 $('#songCount').val(songNum);
	 document.song.submit();
 }

 
 </script>
    
  </head>
  <body style="font-family: Arial;border: 0 none;">
 <?php
  if($showNext){ 
	  $duration = $songDetail[0]['vduration'] ;
	  ?>
	    <script language="javascript">
		 setTimeout("submitForm()",2000);
		 function submitForm(){
		   setTimeout("submitForm()",2000);
		   if($('#videotime1').html()){
		   var playingTimeArray = $('#videotime1').html().split(':');
		   var playTime = parseInt(playingTimeArray[0]) * 3600 + parseInt(playingTimeArray[1])*60 + parseInt(playingTimeArray[2]);
		   var totalSongDuration = parseInt('<?php echo $duration; ?>');
	       if(playTime == totalSongDuration){
			   $('#action').val('next'); 
	           $('#frameHeight').val(parent.document.getElementById('music_frame').style.height); 
			   document.song.submit();
			}
	    }
	}
    </script>
	 <?php } ?>
<form name="song" id="test">
<input type="hidden" name="currentSong" id="currentSong" value="<?php echo $songId; ?>"/>
<input type="hidden" name="act" id="act" value="getNewSong"/>
<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="mywork" id="mywork" value="" />
<input type="hidden" id="frameHeight" name="frameHeight" value="35px" />
<input type="hidden" name="playListId" id="playListId" value="<?php echo $playListId; ?>" />
<input type="hidden" name="isplaylistchange" id="isplaylistchange" value="" />
<input type="hidden" name="songCount" id="songCount" value="<?php echo $songCount; ?>" />
<input type="hidden" name="currentPlatlistName" id="currentPlatlistName" value="<?php echo $currentPlayListName; ?>" />
 </form>
<div class="music_bar" id="music_bar" style="text-align:center;<?php echo $topDisplay; ?>"  >
 <div class="music_bar-txt">
        	<span>Now Playing :</span>
            <?php echo $songDetail['0']['vtitle']; ?>
        </div>
        
        <div class="music_bar-time">
        	<span id="videotime1"></span>/<span><?php  echo gmdate("H:i:s", $songDetail['0']['vduration']);
//$songDetail['0']['vduration']; ?> </span></span>
        </div>
        
        <div class="music_icons_div">
        	<div class="pause">
            	<a href="javascript:;" onclick="pause()" title="pause"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/Pause_icon.png" alt="" border="0" /></a>
            </div>
            <div class="play">
            	<a href="javascript:;" onclick="play()" title="play"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/play_icon.png" alt="" border="0" /></a>
            </div>
            <div class="stop">
            	<a href="javascript:;" onclick="stop()" title="play"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/stop_icon.png" alt="" border="0" /></a>
            </div>
            <?php if($showPrevious){ ?>
            <div class="prev">
            	<a href="javascript:;" onclick="previous()" title="prev"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/rev_icon.png" alt="" border="0" /></a>
            </div>
            <?php } if($showNext){  ?>
            <div class="next">
            	<a href="javascript:;" onclick="next()" title="next"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/next_icon.png" alt="" border="0" /></a>
            </div>
            <?php } ?>
        </div>
        
        <div class="view_artist" style="cursor:pointer;" onclick="parent.getPublicProfile('<?php echo $userDetail[0]['user_id']; ?>','1')">
        	<div class="view_artist_txt">View <br />Artist</div>
            <a href="javascript:;"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_icon.png" alt="" class="fr" border="0" /></a>
        
        </div>
        
        
        <div class="share_video">
        	<div class="share_video_txt">Share <br />Video</div>
             <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;">
             <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/FB_icon.png" alt="" class="fl"  style="margin-right:8px;" border="0"/>
             </a>
             <a href="javascript:;"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/TW_icon.png" alt="" class="fl" border="0" /></a>
        
        </div>
        
        <div class="music_bar-arrow" id="arrow">
        	
            <a href="javascript:;" onclick="upPlayer()"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/up_arrow.png" alt="" border="0" /></a>
           
        </div>
    </div>    
        <!--<div id="videoDiv"></div>-->
        
        <div class="music_player_outer" id="music_player_outer">
	<!--Music Bar-->
	<div class="music_player">
    	<div class="music_player_bg" id="music_player_bg">
        	<div class="video_bg">
            	<div class="video" id="videoDiv">
                <img src="<?php echo $config_var->WEB_TPL_URL; ?>images/video.jpg" border="0" width="483" height="290" border="0" /></div>
                </div>
            <div class="player_playlist_outer">
                    <div class="player_playlist_bg_top">Playlist : <span id="playlistName" style="font-size:16px;"><?php echo $currentPlayListName;?></span> 
                     <span id="playlistName" style="font-size:12px;margin-left:100px; cursor:pointer;" onclick="getPlayList()">Select PlayList</span>
                 
                    </div>
                    <div class="player_playlist_bg_cen">
                        <div class="player_playlist_content">
                           <div id="scrollbar1">
                             <div class="scrollbar" style="z-index:100;"><div class="track" ><div class="thumb"><div class="end"></div></div></div></div> 
                             <div class="viewport">
						    <div class="overview" style="top: 0px;">
                          <?php
						  $toatalTime = 0;
						  for($p=0;$p<count($playList);$p++){ 
						  // $playListTime = $playerObj->getPlayListTime($playList[$p]['playlist_id']);
						   $toatalTime+= $playList[$p]['vduration'];
						   $playListTime=gmdate("H:i:s",$playList[$p]['vduration']);
						   $playListName = $playList[$p]['vtitle'];
						   if(strlen($playListName)>15){
						    $playListName = substr($playListName,0,15).'...';
						   }
						  ?>
                             <a href="javascript:;" style="text-decoration:none">
                             <div class="player_playlist_text_main" style="min-height:50px;">
                            	<div class="left_text" onclick="playSelectedSong(<?php echo $p; ?>)"><?php echo $p+1; ?>. <?php echo $playListName; ?></div>
                                <div class="right_text"><?php echo $playListTime; ?></div>
                            </div></a>
                          <?php } ?>
                          
                                  </div>
                           </div>
						</div>  
                            <!--<a href="javascript:;"><div class="player_playlist_text_main">
                            	<div class="left_text">1. Random Artist</div>
                                <div class="right_text">22:50</div>
                            </div></a>
                            <a href="javascript:;"><div class="player_playlist_text_main">
                            	<div class="left_text">1. Random Artist</div>
                                <div class="right_text">22:50</div>
                            </div></a>
                            <a href="javascript:;"><div class="player_playlist_text_main">
                            	<div class="left_text">1. Random Artist</div>
                                <div class="right_text">22:50</div>
                            </div></a>
                            <a href="javascript:;"><div class="player_playlist_text_main">
                            	<div class="left_text">1. Random Artist</div>
                                <div class="right_text">22:50</div>
                            </div></a>-->
                            
                            <div class="player_playlist_btns">
                            	<div class="btns"><a href="javascript:;" onclick="parent.openPlayListDiv('addToPlayList','<?php echo  $playId; ?>','<?php echo $userId;?>');"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/playlist_add_btn.jpg"  width="39" height="16" border="0" /></a></div>
                             <!--<div class="btns"><a href="javascript:;"><img src="<?php //echo  $config_var->WEB_TPL_URL; ?>images/playlist_ren_btn.jpg" border="0" width="39" height="16" /></a></div>
                            <div class="btns"><a href="javascript:;"><img src="<?php //echo  $config_var->WEB_TPL_URL; ?>images/playlist_mics_btn.jpg" border="0" width="39" height="16" /></a></div>
                            <div class="btns"><a href="javascript:;"><img src="<?php //echo  $config_var->WEB_TPL_URL; ?>images/playlist_info_btn.jpg" border="0" width="39" height="16" /></a></div>-->
                            </div>
                            
                        </div>
                    </div>
                    <div class="player_playlist_bg_bot">
                    		<div class="player_playlist_text_main_total">
                            	<div class="left_text">Playlist Time</div>
                                <div class="right_text"><?php echo  gmdate("H:i:s",$toatalTime); ?></div>
                            </div>
                    </div>
                </div>
                
             <div class="player_about_artist_bg_cen">
                        <div class="player_about_artist_text_born">Born: <span><?php echo ($userDetail[0]['dateofbirth']!='0000-00-00') ? date('M jS, Y',strtotime($userDetail[0]['dateofbirth'])) :'N/A'; ?></span></div>
                        <div class="player_about_artist_text_form">Form: <span><?php echo ($userDetail[0]['country']!='0') ? $playerObj->getCountry($userDetail[0]['country']) : 'N/A'; ?>, 
						<?php echo (trim($userDetail[0]['stateText'])!='') ? $userDetail[0]['stateText'] : 'N/A'; ?></span></div>
                        <div class="player_about_artist_text_bio">Bio:</div>
                        <div class="player_about_artist_text_bio_text"><?php echo (trim($userDetail[0]['bio'])!='') ? $userDetail[0]['bio'] : 'N/A'; ?>,</div>
						
                        
            </div>
        </div>
    </div>
    <!-- //Music Bar-->
</div>
<div class="music_bar_outer"  id="music_bar_bottom" style="text-align:center;<?php echo $bottomDisplay; ?>" >
<div class="music_bar" >
 <div class="music_bar-txt">
        	<span>Now Playing :</span>
            <?php echo $songDetail['0']['vtitle']; ?>
        </div>
        
        <div class="music_bar-time">
        	<span id="videotime2"></span>/<span><?php  echo gmdate("H:i:s", $songDetail['0']['vduration']);
//$songDetail['0']['vduration']; ?> </span></span>
        </div>
        
        <div class="music_icons_div">
        	<div class="pause">
            	<a href="javascript:;" onclick="pause()" title="pause"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/Pause_icon.png" alt="" border="0" /></a>
            </div>
            <div class="play">
            	<a href="javascript:;" onclick="play()" title="play"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/play_icon.png" alt="" border="0" /></a>
            </div>
            <div class="stop">
            	<a href="javascript:;" onclick="stop()" title="play"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/stop_icon.png" alt="" border="0" /></a>
            </div>
            <?php if($showPrevious){ ?>
            <div class="prev">
            	<a href="javascript:;" onclick="previous()" title="prev"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/rev_icon.png" alt="" border="0" /></a>
            </div>
            <?php } if($showNext){  ?>
            <div class="next">
            	<a href="javascript:;" onclick="next()" title="next"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/next_icon.png" alt="" border="0" /></a>
            </div>
            <?php } ?>
        </div>
        
        <div class="view_artist" onclick="parent.getPublicProfile('<?php echo $userDetail[0]['user_id']; ?>','1')">
        	<div class="view_artist_txt">View <br />Artist</div>
            <a href="javascript:;"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/artist_icon.png" alt="" class="fr" border="0" /></a>
        
        </div>
        
        
        <div class="share_video">
        	<div class="share_video_txt">Share <br />Video</div>
             <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;">
             <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/FB_icon.png" alt="" class="fl"  style="margin-right:8px;" border="0"/>
             </a>
             <a href="javascript:;"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/TW_icon.png" alt="" class="fl" border="0" /></a>
        
        </div>
        
        <div class="music_bar-arrow" id="arrow">
        	
            <a href="javascript:;" onclick="downPlayer()"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/down_arrow.png" alt="" border="0" /></a>
           
        </div>
    </div>
  </div>  
  </body>
  
</html>