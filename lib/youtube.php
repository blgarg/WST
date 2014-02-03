<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * PHP sample code for the YouTube data API.  Utilizes the Zend Framework
 * Zend_Gdata component to communicate with the YouTube data API.
 *
 * Requires the Zend Framework Zend_Gdata component and PHP >= 5.1.4
 * This sample is run from within a web browser.  These files are required:
 * session_details.php - a script to view log output and session variables
 * operations.php - the main logic, which interfaces with the YouTube API
 * index.php - the HTML to represent the web UI, contains some PHP
 * video_app.css - the CSS to define the interface style
 * video_app.js - the JavaScript used to provide the video list AJAX interface
 *
 * NOTE: If using in production, some additional precautions with regards
 * to filtering the input data should be used.  This code is designed only
 * for demonstration purposes.
 */
 
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_App_Exception');

include '../settings.php';
require_once('mysql/mysql.php');

global $config_var;  
global $DataSet;
global $model;

/*
 * The main controller logic.
 *
 * POST used for all authenticated requests
 * otherwise use GET for retrieve and supplementary values
 */
session_start();
setLogging('on');
generateUrlInformation();

if (!isset($_POST['operation'])) {
    // if a GET variable is set then process the token upgrade
    if (isset($_GET['token'])) {
     if (  isset($_SESSION['authenticate']) )  unset($_SESSION['authenticate']);
	   updateAuthSubToken($_GET['token']);
    } else {
        if (loggingEnabled()) {
            logMessage('reached operations.php without $_POST or $_GET variables set', 'error');
            //header('Location: uploader.php');
        }
    }
 }

$operation = isset($_POST['operation']) ? $_POST['operation'] :'';

switch ($operation){

    case 'create_upload_form':
        createUploadForm($_POST['videoTitle'],
                         $_POST['videoDescription'],
                         $_POST['videoCategory'],
                         $_POST['videoTags']);
        break;

    case 'edit_meta_data':
        editVideoData($_POST['newVideoTitle'],
                      $_POST['newVideoDescription'],
                      $_POST['newVideoCategory'],
                      $_POST['newVideoTags'],
                      $_POST['videoId']);
        break;

    case 'check_upload_status':
        checkUpload($_POST['videoId']);
        break;

    case 'delete_video':
        deleteVideo($_POST['videoId']);
        break;

    case 'auth_sub_request':
        generateAuthSubRequestLink();
        break;

    case 'auth_sub_token_upgrade':
        updateAuthSubToken($_GET['token']);
        break;

    case 'clear_session_var':
        clearSessionVar($_POST['name']);
        break;

    case 'retrieve_playlists':
        retrievePlaylists();
        break;

    case 'create_playlist':
        createPlaylist($_POST['playlistTitle'], $_POST['playlistDescription']);
        break;

    case 'delete_playlist':
        deletePlaylist($_POST['playlistTitle']);
        break;

    case 'update_playlist':
        updatePlaylist($_POST['newPlaylistTitle'],
                       $_POST['newPlaylistDescription'],
                       $_POST['oldPlaylistTitle']);
        break;

    case (strcmp(substr($operation, 0, 7), 'search_') == 0):
        // initialize search specific information
        $searchType = substr($operation, 7);
        searchVideos($searchType, $_POST['searchTerm'], $_POST['startIndex'],
            $_POST['maxResults']);
        break;

    case 'show_video':
        echoVideoPlayer($_POST['videoId']);
        break;
    case 'register':
	    registerMusician();
	    break;
	case 'getview':
	   getViewAndsubscriber($_POST['username']); 
	   break;
	case 'videoDetail':
	   getvideoDetail($_POST['vId']);  
	   break;
	   
	  case 'videoView':
	   getvideoView($_POST['vId']);  
	   break;
	    
	case 'videoAddDetail':
	   getAddvideoDetail($_POST['vId'],$_POST['contestId']);  
	   break;
	      
	case 'getFraturedArtist':
	   getFraturedArtist();  
	   break;
	case 'getFraturedVideo':
	   getFraturedVideo();  
	   break; 
	case 'videoEnrty':
	   addVideoEntry($_REQUEST);  
	   break;  
	 case 'addtoplayList':
	   getuserUplaodDetail($_REQUEST);  
	   break;   
	     
	default:
        unsupportedOperation($_POST);
        break;
 }



         function registerMusician(){
		     $httpClient = getAuthSubHttpClient();
             $youTubeService = new Zend_Gdata_YouTube($httpClient);
			 $youTubeService->setMajorProtocolVersion(2);
             $feed = $youTubeService->getUserUploads('default');
             $profile=$youTubeService->getUserProfile($feed->author[0]->name->text);
	         $data = array();
	         $data["userName"] = @$profile->getUsername()->text;
	         $data["prifilePicUrl"]= @$profile->getThumbnail()->getUrl();
			 $data["bio"] = @$profile->getAboutMe()->text;
			 $data["age"] =@$profile->getAge()->text;
			 $data["gender"]= @$profile->getGender()->text;
			 $data["relationShip"]=@$profile->getRelationship()->text;
			 $data["hometown"]=@$profile->getHometown()->text;
			 $data["location"]=@$profile->getLocation()->text;
			 $data["fristName"]=@$profile->firstName->text;
			 $data["lastName"]=@$profile->lastName->text;
			 $data["email"] =@$profile->author[0]->email;
			 $data["date_join"] = @$profile->getPublished()->text;
			 $data["city"]= '';
			 $city=explode(',',$data["location"]);
			 if(count($city)>1){
			 $data["city"]= $city[0];
			 }
			 $statistics =@$profile->getStatistics();
			 if($data["location"]){
			 $loc= str_replace(", ", "','", trim($data["location"]));
			
			 $con = new  JDatabaseMySQL();
			 $query = "SELECT * FROM country WHERE code IN ('".trim($loc)."')";
			  
			  $exec = mysql_query($query) or mysql_error();
			   $option='<option value="0">Select State</option>';
			   while($res = mysql_fetch_assoc($exec)){
			  
			   $data["countryName"]= $res['name'];
			   $data["countryIndex"]= $res['id'];
			     /* if($data["countryIndex"]==1){
				    
					$qry = "SELECT * FROM state WHERE cid = '".$data["countryIndex"]."'";
					$exec = mysql_query($qry
					) or mysql_error();
				     while($res = mysql_fetch_assoc($exec)){
					    $option.= '<option value ='.$res['id'].'>'.$res['name'].'</option>';
					 }
				    $data["statelist"]=$option;
				  }*/
			   }
			 }
			 $data["subscriber"]=@$statistics->getSubscriberCount();
			 $data["channel_view"]=@$statistics->getViewCount();
			 $data["last_access"]=@$statistics->getLastWebAccess();
			 $data["totalUploadViews"]=@$statistics->extensionAttributes['totalUploadViews']['value'];
			 
			 $query= "SELECT * FROM mgl_users WHERE user_name = '".$data["userName"]."'";	
			 $exec = mysql_query($query) or mysql_error();
			 $num_rows = mysql_num_rows($exec);
			 if($num_rows==0){
			 $query = "UPDATE mgl_users SET user_name='".$data["userName"]."',youTubeProfilepic='".$data["prifilePicUrl"]."',sessionToken='".$_SESSION['sessionToken']."',isyoutubeauth='1',date_updated=now() WHERE user_id='".$_SESSION['userAccountID']."'";
			 $exec = mysql_query($query) or mysql_error();
		    
			$query= "SELECT * FROM users WHERE userId = '".$_SESSION['userAccountID']."'";	
			$exec = mysql_query($query) or mysql_error();
			$num_rows = mysql_num_rows($exec);
			if($num_rows > 0){
			      $query= "UPDATE users SET userName='".$data["userName"]."',youtubeId='".$data["userName"]."' WHERE userId = '".$_SESSION['userAccountID']."'";
			      $exec = mysql_query($query) or mysql_error();
			}else{
			     $query= "INSERT INTO users(`userId`,`userName`,`youtubeId`)VALUES('".$_SESSION['userAccountID']."','".$data["userName"]."','".$data["userName"]."')";
			      $exec = mysql_query($query) or mysql_error();
			}
			
			$query = "DELETE FROM youtubestatistics WHERE youtubeUser = '".$data["userName"]."'";
			$exec = mysql_query($query) or mysql_error();
			$query = "INSERT INTO youtubestatistics(`youtubeUser`,`subscribers`,`channel_views`,`dateUpdated`,`lastAccess`,`totalUploadViews`)VALUES('".$data["userName"]."','".$data["subscriber"]."','".$data["channel_view"]."',now(),'".$data["last_access"]."','".$data["totalUploadViews"]."')";
			$exec = mysql_query($query) or mysql_error();
			
			$query = "DELETE FROM youtubeuser WHERE youtubeUser = '".$data["userName"]."'";
			$exec = mysql_query($query) or mysql_error();
			$query= "INSERT INTO youtubeuser(`youtubeUser`,`authSubToken`,`firstName`,`lastName`,`description`,`age`,`dateJoined`,`location`)VALUES('". $data["userName"]."','".$_SESSION['sessionToken']."','".$data["fristName"]."','".$data["lastName"]."','".$data["bio"]."','".$data["age"]."','".$data["date_join"]."','".$data["location"]."')";
		    $exec = mysql_query($query) or mysql_error();
         echo 1;
	 }else{
	   echo 0;
	 }
 } 
		
		
		function getViewAndsubscriber($username){
		   
		    if(trim($username)!=''){
		    $httpClient = getAuthSubHttpClient();
            $youTubeService = new Zend_Gdata_YouTube($httpClient);
        //    $feed = $youTubeService->getuserUploads('default');
			
			$profile=$youTubeService->getUserProfile($username);
			$statistics =@$profile->getStatistics();
			$subscriber=@$statistics->getSubscriberCount();
			$view = $statistics->getViewCount();
		    echo '<div class="reach_text_underneath" id="youtubeView">View: '.$view.'</div><div class="reach_text_underneath" id="youtubescribers">Subscribers '.$subscriber.'</div>';
			}else{
			  echo '<div class="reach_text_underneath" id="youtubeView">Not Auhenticate Yet</div>';
			}
		
		}
		
		
		
		function getFraturedArtist(){
		     $con = new  JDatabaseMySQL();
			 $sql = "SELECT * FROM mgl_users WHERE isyoutubeauth = '1' AND type = '1' ";
			  $exec = mysql_query($sql) or mysql_error();
			 // $httpClient = getAuthSubHttpClient();
              $youTubeService = new Zend_Gdata_YouTube();
               $i=0;
			   $featureListArray = array();
			  while($res = mysql_fetch_assoc($exec)){
			    $numRaters = 0 ;
				$profile=$youTubeService->getuserUploads($res['user_name']);
			    foreach($profile as $videoEntry) {
				   if (isset($videoEntry->rating->average)) {
                    $numRaters+= $videoEntry->rating->average;
                   } 
				  }
			    if($numRaters!=0){
				   $featureListArray[$i]['username']=$res['user_name'];
				   $featureListArray[$i]['rating']=$numRaters;
				   $sql = "SELECT * FROM mgl_users WHERE user_name = '".$res['user_name']."'";
				   $exec2 = mysql_query($sql) or mysql_error();
				  while($result = mysql_fetch_assoc($exec2)){
				    $userVal = @unserialize($result['youTubeProfilepic']);
		     		if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
					 else{$IMG_PATH = @$result['youTubeProfilepic'];}
			 
				     $featureListArray[$i]['user_id']=$result['user_id'];
					 $featureListArray[$i]['name']=$result['user_firstname'].' '.$result['user_lastname'];
					 $featureListArray[$i]['born']=$result['dateofbirth'];
					 $featureListArray[$i]['sex']= $result['gender']=='m' ? 'male':'female';
					 $featureListArray[$i]['profilepic']= $IMG_PATH;
					  $featureListArray[$i]['bio']= $result['bio'];
				 }
				   $featureListArray[$i]['rating']=$numRaters;
				  ++$i;
				}
			
			}
		  
		  $featureListArray=sortArrayByKey($featureListArray,'rating');
		  /* echo "<pre>";
		   print_r($featureListArray);
		   echo "</pre>";*/
		  ?>
          <table width="100%" cellpadding="5" cellspacing="5">
          <?php
		   if(count($featureListArray)>0){
		      for($k=0;$k<count($featureListArray);$k++){
			   ?>
                <tr>
                    <td height="100" width="100"><img src="<?php echo $featureListArray[$k]['profilepic']; ?>" alt="userPic" title="userpic"  width="80" height="80"/><br />
                    <strong>Rating:</strong> <?php echo $featureListArray[$k]['rating']; ?>
                    </td> <td><strong><?php echo $featureListArray[$k]['name']; ?></strong><br>Born:<?php echo format_date($featureListArray[$k]['born']); ?><br>Sex: <?php echo $featureListArray[$k]['sex']; ?><br>Bio: <?php echo  $featureListArray[$k]['bio']; ?></td>
                </tr>
              <tr><td colspan="2"><hr /></td></tr>
              
               <?php
			  }
		   } ?>
           </table>
           <?php
		   
}




		function getuserUplaodDetail($arr){
              $youTubeService = new Zend_Gdata_YouTube();
              $profile=$youTubeService->getuserUploads($arr['youtubeId']); 
		    $con = new  JDatabaseMySQL();
			foreach($profile as $videoEntry) {
			 $vid=$videoEntry->getVideoId();
			 $query= "SELECT * FROM mgl_videodetail WHERE vid = '".$vid."'";	
			$exec = mysql_query($query) or mysql_error();
			$num_rows = mysql_num_rows($exec);
			if($num_rows==0){
			 $thumbnailUrl = 'notfound.jpg';
                if (count($videoEntry->mediaGroup->thumbnail) > 0) {
                 $thumbnailUrl = htmlspecialchars($videoEntry->mediaGroup->thumbnail[0]->url);
                }

            $videoTitle = htmlspecialchars($videoEntry->getVideoTitle());
            $videoDescription = htmlspecialchars($videoEntry->getVideoDescription());
			$duration=$videoEntry->getVideoDuration();
			$query="INSERT INTO mgl_videodetail(vid,uId,vtitle,vdesc,vtags,vthumbs,vduration)VALUES('".$vid."','".$arr['uId']."','".$videoTitle."','".$videoDescription."','tunezy','".$thumbnailUrl."','".$duration."')";
		     $exec = mysql_query($query) or mysql_error();
			 $ratingInfo = $videoEntry->getVideoRatingInfo();
			 $youtubeUserName = $arr['youtubeId'];
			 $comment= $videoEntry->comments->feedLink->countHint;
			 $favorites= $videoEntry->statistics->favoriteCount;
			 $numRaters = $ratingInfo['numRaters'];
			 $avgRatig = $ratingInfo['average'];
			 $view = htmlspecialchars($videoEntry->getVideoViewCount());
			 $sql = "INSERT INTO youtubevideos(`videoId`,`youtubeUser`,`comments`,`favourites`,`numberOfRaters`,`averageRating`,`views`,`dateUpdated`)VALUES('".$vid."','".$youtubeUserName."','".$comment."','".$favorites."','".$numRaters ."','".$avgRatig."','".$view."',now())";
			$exec = mysql_query($sql) or mysql_error();
			
			}
		 }
	 echo 1;		
 }


      
	  
	  function getFraturedVideo(){
		     $con = new  JDatabaseMySQL();
			 $config_var = new config();
			 $sql = "SELECT * FROM mgl_videodetail";
			  $exec = mysql_query($sql) or mysql_error();
			 // $httpClient = getAuthSubHttpClient();
              $youTubeService = new Zend_Gdata_YouTube();
               $i=0;
			   $featureListArray = array();
			  while($res = mysql_fetch_assoc($exec)){
			 $entry = 1;
			  try{
			  $videoEntry = $youTubeService->getVideoEntry($res['vid']);
			   
			  }catch(Zend_Gdata_App_Exception $e){
			   $entry = 0 ;
			  }
              if($entry){
			  $ratingInfo = $videoEntry->getVideoRatingInfo();
			 if(isset($ratingInfo['average'])){
			  $thumbnailUrl = 'notfound.jpg';
              if (count($videoEntry->mediaGroup->thumbnail) > 0) {
                $thumbnailUrl = htmlspecialchars($videoEntry->mediaGroup->thumbnail[0]->url);
              }
			    $featureListArray[$i]['videoId']=$res['vid'];
				$featureListArray[$i]['rating']=$ratingInfo['average'];
			    $featureListArray[$i]['thumbUrl']=$thumbnailUrl;
				$featureListArray[$i]['description']=htmlspecialchars($videoEntry->getVideoDescription());
			    $featureListArray[$i]['title']=htmlspecialchars($videoEntry->getVideoTitle()); 
		        $featureListArray[$i]['duration']=$videoEntry->getVideoDuration();
			   ++$i;
			  }
			 } 
		 }
		
		  
		  $featureListArray=sortArrayByKey($featureListArray,'rating');
		  /* echo "<pre>";
		   print_r($featureListArray);
		   echo "</pre>";*/
		  ?>
          <table width="100%" cellpadding="5" cellspacing="5">
          <?php
		    if(count($featureListArray)>0){
		      for($k=0;$k<count($featureListArray);$k++){
			   ?>
                <tr>
                    <td height="100" width="100"  onmouseover="ShowAddtoplayListButton('<?php echo $k.'_'.$featureListArray[$k]['videoId'];?>')" 
                    onmouseout="HideAddtoplayListButton('<?php echo $k.'_'.$featureListArray[$k]['videoId'];?>')" >
                    <img src="<?php echo $featureListArray[$k]['thumbUrl']; ?>" alt="VideoPic" title="VideoPic" width="170" height="92" 
                    onclick="ytVideoApp.presentVideo('<?php echo $featureListArray[$k]['videoId']; ?>','<?php echo $featureListArray[$k]['thumbUrl']; ?>','<?php echo addslashes($featureListArray[$k]['title']); ?>','<?php echo $featureListArray[$k]['duration']; ?>','<?php echo $_SESSION['userAccountID']; ?>')" style="cursor:pointer;"  />
                     
                      <div style="position:relative; top:-70px; left:55px; z-index:333; cursor:pointer;">
                                         <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/play.png" title="Play" alt="Play" onclick="ytVideoApp.presentVideo('<?php echo $featureListArray[$k]['videoId']; ?>','<?php echo $featureListArray[$k]['thumbUrl']; ?>','<?php echo addslashes($featureListArray[$k]['title']); ?>','<?php echo $featureListArray[$k]['duration']; ?>','<?php echo $_SESSION['userAccountID']; ?>');" /> 
                             <span style="margin-left:40px;top:15px;display:none; position:relative; z-index:555;" id="<?php echo $k.'_'.$featureListArray[$k]['videoId'];?>" onclick="openPlayListDiv('addToPlayList','<?php echo $featureListArray[$k]['videoId'];?>','<?php echo $_SESSION['userAccountID'] ; ?>');"> <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/add_to_playlist.png" alt="Add" title="Add to playlist"  /> </span>            
                             </div>
                    <strong>Rating:</strong> <?php echo $featureListArray[$k]['rating']; ?>
                     
                     </td><td valign="top"><strong><?php echo  addslashes($featureListArray[$k]['title']); ?></strong><br>Description: <?php echo addslashes($featureListArray[$k]['description']); ?></td>
                </tr>
              <tr><td colspan="2"><hr /></td></tr>
               
               <?php
			  }
		    } ?>
           </table>
           <?php
		   
}

	  
	  
	  
	  
	  
	  
	   function format_date($original='', $format="%b %d,%Y") {
             $format = ($format=='date' ? "%m-%d-%Y" : $format); 
             $format = ($format=='datetime' ? "%m-%d-%Y %H:%M:%S" : $format); 
             $format = ($format=='mysql-date' ? "%Y-%m-%d" : $format); 
             $format = ($format=='mysql-datetime' ? "%Y-%m-%d %H:%M:%S" : $format); 
             return (!empty($original) ? strftime($format, strtotime($original)) : "" ); 
           } 
		 
		 
		 
		function getvideoDetail($vid){
		    set_time_limit (3600);
		    $flag= true;
			$entry = getEntry($vid);
			$con = new  JDatabaseMySQL();
		
			if(isset($entry->control->state->name)){
				while(@$entry->control->state->name=='processing'){
			    $entry = getEntry($vid);
		   }
		      if(@$entry->control->state->name=='rejected'){
					
					$sql = 'DELETE FROM mgl_contest_video WHERE VideoId = "'.$vid.'"';
					$exec = mysql_query($sql) or mysql_error();
					$flag= false;
				    echo 'Your Video has been rejected by youtube due to duplicate video.';

			  }
		    
		 }	
			
		  if($flag){
			
            $videoThumbnails = @$entry->getVideoThumbnails();

 $sql = "INSERT INTO mgl_videodetail(`vid`,`uId` ,`vtitle`,`vdesc`,`vtags`,`vthumbs`,`vduration`,`datecreated`)VALUES('".$vid."','".$_SESSION['userAccountID']."','".mysql_real_escape_string(@$entry->getVideoTitle())."','".mysql_real_escape_string(@$entry->getVideoDescription())."','Tunezy','".mysql_real_escape_string(@$videoThumbnails[0]['url'])."','".@$entry->getVideoDuration()."',now())";
			$exec = mysql_query($sql) or mysql_error();
          
		     $sql = "SELECT user_name FROM mgl_users WHERE user_id = '".$_SESSION['userAccountID']."'";
			 $exec = mysql_query($sql) or mysql_error();
			 $res =  mysql_fetch_assoc($exec);
			 $ratingInfo = @$entry->getVideoRatingInfo();
			 $youtubeUserName = @$res['user_name'];
			 $comment= @$entry->comments->feedLink->countHint;
			 $favorites= @$entry->statistics->favoriteCount;
			 $numRaters = @intval($ratingInfo['numRaters']);
			 $avgRatig = @intval($ratingInfo['average']);
			 $view = intval(htmlspecialchars($entry->getVideoViewCount()));
			 $sql = "INSERT INTO youtubevideos(`videoId`,`youtubeUser`,`comments`,`favourites`,`numberOfRaters`,`averageRating`,`views`,`dateUpdated`)VALUES('".$vid."','".$youtubeUserName."','".$comment."','".$favorites."','".$numRaters ."','".$avgRatig."','".$view."',now())";
			$exec = mysql_query($sql) or mysql_error();
		   echo 'Video has been uploaded successfully.';
		}   
        	
			//print_r($entry);
 }
 
 
   function getvideoView($vid){
            $flag= true;
			$entry = getEntry($vid);
			$con = new  JDatabaseMySQL();
			try{
			echo $viewCount = (int) htmlspecialchars(@$entry->getVideoViewCount());
			}catch(Zend_Gdata_App_Exception $e){
			echo 0;
			}
		
   }
		
		
		function getAddvideoDetail($vid,$contestId){
			$flag= true;
			$entry = getEntry($vid);
			$con = new  JDatabaseMySQL();
			$query = "SELECT * FROM mgl_contest_video WHERE userId ='".$_SESSION['userAccountID']."' AND VideoId = '".$vid."' AND contestId = '".$contestId."'";
			$exec = mysql_query($query) or mysql_error();
			$num_rows = mysql_num_rows($exec);
			if($num_rows == 0){
			if($entry){
			implode(", ", $entry->getVideoTags()) ;
            $videoThumbnails = $entry->getVideoThumbnails();
			 $sql = "INSERT INTO mgl_videodetail(`vid`,`uId` ,`vtitle`,`vdesc`,`vtags`,`vthumbs`,`vduration`,`datecreated`)VALUES('".$vid."','".$_SESSION['userAccountID']."','".mysql_real_escape_string(@$entry->getVideoTitle())."','".mysql_real_escape_string(@$entry->getVideoDescription())."','Tunezy','".mysql_real_escape_string(@$videoThumbnails[0]['url'])."','".@$entry->getVideoDuration()."',now())";
			$exec = mysql_query($sql) or mysql_error();
             
             $sql = "SELECT user_name FROM mgl_users WHERE user_id = '".$_SESSION['userAccountID']."'";
			 $exec = mysql_query($sql) or mysql_error();
			 $res =  mysql_fetch_assoc($exec);
			 $ratingInfo = $entry->getVideoRatingInfo();
			 $youtubeUserName = $res['user_name'];
			 $comment= $entry->comments->feedLink->countHint;
			 $favorites= $entry->statistics->favoriteCount;
			 $numRaters = $ratingInfo['numRaters'];
			 $avgRatig = $ratingInfo['average'];
			 $view = htmlspecialchars($entry->getVideoViewCount());
			 $sql = "INSERT INTO youtubevideos(`videoId`,`youtubeUser`,`comments`,`favourites`,`numberOfRaters`,`averageRating`,`views`,`dateUpdated`)VALUES('".$vid."','".$youtubeUserName."','".$comment."','".$favorites."','".$numRaters ."','".$avgRatig."','".$view."',now())";
			$exec = mysql_query($sql) or mysql_error();
		   
		    $sql ="INSERT INTO mgl_contest_video(contestId,VideoId,userId,dateUploaded)VALUES('".$contestId."','".$vid."','".$_SESSION['userAccountID']."',now())";
		    $exec = mysql_query($sql) or mysql_error();
			 
			$sql ="INSERT INTO mgl_video_rating_update(video_id,contest_id,rating)VALUES('".$vid."','".$contestId."','0')";
		    $exec = mysql_query($sql) or mysql_error();
		    echo 'Your video has been successfully add to contest.';
			
			}else{
			  echo 'Your youtube link is not valid';
			}
		  }else{
		  
		   echo 'This video link is already add by you';
		   
		  }
		   //print_r($entry);
 }
		
		
		function getEntry($vid){
		  
		    $httpClient = getAuthSubHttpClient();
            $youTubeService = new Zend_Gdata_YouTube($httpClient);
		    try{
			$entry = $youTubeService->getVideoEntry($vid);
			return $entry;
			}catch(Zend_Gdata_App_Exception $e){
			 return 0;
			}
		    
		}

/**
 * Perform a search on youtube. Passes the result feed to echoVideoList.
 *
 * @param string $searchType The type of search to perform.
 * If set to 'owner' then attempt to authenticate.
 * @param string $searchTerm The term to search on.
 * @param string $startIndex Start retrieving search results from this index.
 * @param string $maxResults The number of results to retrieve.
 * @return void
 */
function searchVideos($searchType, $searchTerm, $startIndex, $maxResults)
{
       // create an unauthenticated service object
    $youTubeService = new Zend_Gdata_YouTube();
    $query = $youTubeService->newVideoQuery();
    $query->setQuery($searchTerm);
    $query->setStartIndex($startIndex);
    $query->setMaxResults($maxResults);

    switch ($searchType) {
        case 'most_viewed':
            $query->setFeedType('most viewed');
            $query->setTime('this_week');
            $feed = $youTubeService->getVideoFeed($query);
            break;
        case 'most_recent':
            $query->setFeedType('most recent');
            $query->setTime('this_week');
            $feed = $youTubeService->getVideoFeed($query);
            break;
        case 'recently_featured':
            $query->setFeedType('recently featured');
            $feed = $youTubeService->getVideoFeed($query);
            break;
        case 'top_rated':
            $query->setFeedType('top rated');
            $query->setTime('this_week');
            $feed = $youTubeService->getVideoFeed($query);
            break;
        case 'username':
           if(trim($searchTerm)==''){
		    echo '<div style="text-align:center; font-weight:bold;">No Record Found</div>';
		    exit();
			}else{
		   $feed = $youTubeService->getUserUploads($searchTerm);
           }
		   break;
		   
		
        case 'all':
            $feed = $youTubeService->getVideoFeed($query);
            break;
        case 'owner':
            $httpClient = getAuthSubHttpClient();
           
		    $youTubeService = new Zend_Gdata_YouTube($httpClient);
            try {
                $feed = $youTubeService->getUserUploads('default');
               if (loggingEnabled()) {
                    logMessage($httpClient->getLastRequest(), 'request');
                    logMessage($httpClient->getLastResponse()->getBody(),
                        'response');
                }
            } catch (Zend_Gdata_App_HttpException $httpException) {
                print 'ERROR ' . $httpException->getMessage()
                    . ' HTTP details<br /><textarea cols="70" rows="20">'
                    . $httpException->getRawResponseBody()
                    . '</textarea><br />'
                    . '<br />';
                return;
            } catch (Zend_Gdata_App_Exception $e) {
                print 'ERROR - Could not retrieve users video feed: '
                    . $e->getMessage() . '<br />';
                return;
            }
            echoVideoList($feed, true);
            return;
       
	    default:
            echo 'ERROR - Unknown search type - \'' . $searchType . '\'';
            return;
    }

    if (loggingEnabled()) {
        $httpClient = $youTubeService->getHttpClient();
		
        logMessage($httpClient->getLastRequest(), 'request');
        logMessage($httpClient->getLastResponse()->getBody(), 'response');
    }
    echoVideoList($feed);
}

/**
 * Finds the URL for the flash representation of the specified video.
 *
 * @param Zend_Gdata_YouTube_VideoEntry $entry The video entry
 * @return (string|null) The URL or null, if the URL is not found
 */
function findFlashUrl($entry)
{
    foreach ($entry->mediaGroup->content as $content) {
        if ($content->type === 'application/x-shockwave-flash') {
            return $content->url;
        }
    }
    return null;
 }

/**
 * Check the upload status of a video
 *
 * @param string $videoId The video to check.
 * @return string A message about the video's status.
 */
function checkUpload($videoId){
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);

    $feed = $youTubeService->getuserUploads('default');
    
	$message = 'No further status information available yet.';

    foreach($feed as $videoEntry) {
        if ($videoEntry->getVideoId() == $videoId) {
            // check if video is in draft status
            try {
                $control = $videoEntry->getControl();
            } catch (Zend_Gdata_App_Exception $e) {
                print 'ERROR - not able to retrieve control element '
                    . $e->getMessage();
                return;
            }

            if ($control instanceof Zend_Gdata_App_Extension_Control) {
                if (($control->getDraft() != null) &&
                    ($control->getDraft()->getText() == 'yes')) {
                    $state = $videoEntry->getVideoState();
                    if ($state instanceof Zend_Gdata_YouTube_Extension_State) {
                        $message = 'Upload status: ' . $state->getName() . ' '
                            . $state->getText();
                    } else {
                        print $message;
                    }
                }
            }
        }
    }
    print $message;
}

/**
 * Store location of the demo application into session variables.
 *
 * @return void
 */
function generateUrlInformation()
{
     $config_var = new config();
	if (!isset($_SESSION['operationsUrl']) || !isset($_SESSION['homeUrl'])) {
        $_SESSION['operationsUrl'] = 'http://'. $_SERVER['HTTP_HOST']
                                   . $_SERVER['PHP_SELF'];
        $path = explode('/', $_SERVER['PHP_SELF']);
        $path[count($path)-1] = 'index.php';
        $_SESSION['homeUrl'] = $config_var->WEB_URL.'index.php';
    }
}

/**
 * Log a message to the session variable array.
 *
 * @param string $message The message to log.
 * @param string $messageType The type of message to log.
 * @return void
 */
function logMessage($message, $messageType){

    if (!isset($_SESSION['log_maxLogEntries'])) {
        $_SESSION['log_maxLogEntries'] = 20;
    }

    if (!isset($_SESSION['log_currentCounter'])) {
        $_SESSION['log_currentCounter'] = 0;
    }

    $currentCounter = $_SESSION['log_currentCounter'];
    $currentCounter++;

    if ($currentCounter > $_SESSION['log_maxLogEntries']) {
        $_SESSION['log_currentCounter'] = 0;
    }

    $logLocation = 'log_entry_'. $currentCounter . '_' . $messageType;
    $_SESSION[$logLocation] = $message;
    $_SESSION['log_currentCounter'] = $currentCounter;
 }

/**
 * Update an existing video's meta-data.
 *
 * @param string $newVideoTitle The new title for the video entry.
 * @param string $newVideoDescription The new description for the video entry.
 * @param string $newVideoCategory The new category for the video entry.
 * @param string $newVideoTags The new set of tags for the video entry (whitespace separated).
 * @param string $videoId The video id for the video to be edited.
 * @return void
 */
function editVideoData($newVideoTitle, $newVideoDescription, $newVideoCategory, $newVideoTags, $videoId)
{
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $feed = $youTubeService->getVideoFeed('http://gdata.youtube.com/feeds/users/default/uploads');
    $videoEntryToUpdate = null;

    foreach($feed as $entry) {
        if ($entry->getVideoId() == $videoId) {
            $videoEntryToUpdate = $entry;
            break;
        }
    }

    if (!$videoEntryToUpdate instanceof Zend_Gdata_YouTube_VideoEntry) {
        print 'ERROR - Could not find a video entry with id ' . $videoId
            . '<br />' . printCacheWarning();
        return;
    }

    try {
        $putUrl = $videoEntryToUpdate->getEditLink()->getHref();
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not obtain video entry\'s edit link: '
            . $e->getMessage() . '<br />';
        return;
    }

    $videoEntryToUpdate->setVideoTitle($newVideoTitle);
    $videoEntryToUpdate->setVideoDescription($newVideoDescription);
    $videoEntryToUpdate->setVideoCategory($newVideoCategory);

    // convert tags from space separated to comma separated
    $videoTagsArray = explode(' ', trim($newVideoTags));

    // strip out empty array elements
    foreach($videoTagsArray as $key => $value) {
        if (strlen($value) < 2) {
            unset($videoTagsArray[$key]);
        }
    }

    $videoEntryToUpdate->setVideoTags(implode(', ', $videoTagsArray));

    try {
        $updatedEntry = $youTubeService->updateEntry($videoEntryToUpdate, $putUrl);
        if (loggingEnabled()) {
            logMessage($httpClient->getLastRequest(), 'request');
            logMessage($httpClient->getLastResponse()->getBody(), 'response');
        }
    } catch (Zend_Gdata_App_HttpException $httpException) {
        print 'ERROR ' . $httpException->getMessage()
            . ' HTTP details<br /><textarea cols="70" rows="20">'
            . $httpException->getRawResponseBody()
            . '</textarea><br />'
            . '<br />';
        return;
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not post video meta-data: ' . $e->getMessage();
        return;
    }
        print 'Entry updated successfully.<br /><a href="#" onclick="'
            . 'ytVideoApp.presentFeed(\'search_owner\', 5, 0, \'none\'); '
            . 'ytVideoApp.refreshSearchResults();" >'
            . '(refresh your video listing)</a><br />'
            . printCacheWarning();
 }

/**
 * Create upload form by sending the incoming video meta-data to youtube and
 * retrieving a new entry. Prints form HTML to page.
 *
 * @param string $VideoTitle The title for the video entry.
 * @param string $VideoDescription The description for the video entry.
 * @param string $VideoCategory The category for the video entry.
 * @param string $VideoTags The set of tags for the video entry (whitespace separated).
 * @param string $nextUrl (optional) The URL to redirect back to after form upload has completed.
 * @return void
 */
function createUploadForm($videoTitle, $videoDescription, $videoCategory, $videoTags,$nextUrl = null){
    $config_var = new config();
	$httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $newVideoEntry = new Zend_Gdata_YouTube_VideoEntry();

    $newVideoEntry->setVideoTitle($videoTitle);
    $newVideoEntry->setVideoDescription($videoDescription);

    //make sure first character in category is capitalized
    $videoCategory = strtoupper(substr($videoCategory, 0, 1))
        . substr($videoCategory, 1);
    $newVideoEntry->setVideoCategory($videoCategory);

    // convert videoTags from whitespace separated into comma separated
    $videoTagsArray = explode(' ', trim($videoTags));
    $newVideoEntry->setVideoTags(implode(', ', $videoTagsArray));

    $tokenHandlerUrl = 'http://gdata.youtube.com/action/GetUploadToken';
    try {
        $tokenArray = $youTubeService->getFormUploadToken($newVideoEntry, $tokenHandlerUrl);
        if (loggingEnabled()) {
            logMessage($httpClient->getLastRequest(), 'request');
            logMessage($httpClient->getLastResponse()->getBody(), 'response');
        }
    } catch (Zend_Gdata_App_HttpException $httpException) {
        print '<div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert(),setForm();"><img src="'.$config_var->WEB_TPL_URL.'images/cross_icon.png" alt=""  width="25" height="25" /></a></div><br /><br /><strong>You are not authenticate with youtube.To upload video please auhenticate with youtube.</strong><br /><br /><br /><br />';
        return;
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not retrieve token for syndicated upload. '
            . $e->getMessage()
            . '<br /><br />';
        return;
    }

    $tokenValue = $tokenArray['token'];
    $postUrl = $tokenArray['url'];

    // place to redirect user after upload
    if (!$nextUrl) {
        $nextUrl = $_SESSION['homeUrl'];
    }

print '<div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert(),setForm();"><img src="'.$config_var->WEB_TPL_URL.'images/cross_icon.png" alt=""  width="25" height="25" /></a></div><br /><br /><div id="extvalidationError" style="text-align:center;color:#F37D20;font-size:14px;margin-top:-10px;padding:10px;font-weight:bold"></div><form action="'.$postUrl.'?nexturl='.$nextUrl.'" method="post" enctype="multipart/form-data" onsubmit=" return checkValidExt()">
					<input name="file" type="file" id="upload_file_value"/>
					<input name="token" type="hidden" value="'.$tokenValue.'"/>
					<input value="Upload Video File" type="submit" class="btn_class" style="cursor:pointer;" />
					</form><br><br>';
			
 }

/**
 * Deletes a Video.
 *
 * @param string $videoId Id of the video to be deleted.
 * @return void
 */
function deleteVideo($videoId)
{
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $feed = $youTubeService->getVideoFeed('http://gdata.youtube.com/feeds/users/default/uploads');
    $videoEntryToDelete = null;

    foreach($feed as $entry) {
        if ($entry->getVideoId() == $videoId) {
            $videoEntryToDelete = $entry;
            break;
        }
    }

    // check if videoEntryToUpdate was found
    if (!$videoEntryToDelete instanceof Zend_Gdata_YouTube_VideoEntry) {
        print 'ERROR - Could not find a video entry with id ' . $videoId . '<br />';
        return;
    }

    try {
        $httpResponse = $youTubeService->delete($videoEntryToDelete);
        if (loggingEnabled()) {
            logMessage($httpClient->getLastRequest(), 'request');
            logMessage($httpClient->getLastResponse()->getBody(), 'response');
        }

    } catch (Zend_Gdata_App_HttpException $httpException) {
        print 'ERROR ' . $httpException->getMessage()
         . ' HTTP details<br /><textarea cols="70" rows="20">'
         . $httpException->getRawResponseBody()
         . '</textarea><br />'
         . '<br />';
        return;
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not delete video: '. $e->getMessage();
        return;
    }

    print 'Entry deleted succesfully.<br />' . $httpResponse->getBody()
        . '<br /><a href="#" onclick="'
        . 'ytVideoApp.presentFeed(\'search_owner\', 5, 0, \'none\');"'
        . '">(refresh your video listing)</a><br />'
        . printCacheWarning();
}

/**
 * Enables logging.
 *
 * @param string $loggingOption 'on' to turn logging on, 'off' to turn logging off.
 * @param integer|null $maxLogItems Maximum items to log, default is 10.
 * @return void
 */
function setLogging($loggingOption, $maxLogItems = 10)
{
    switch ($loggingOption) {
        case 'on' :
            $_SESSION['logging'] = 'on';
            $_SESSION['log_currentCounter'] = 0;
            $_SESSION['log_maxLogEntries'] = $maxLogItems;
            break;

        case 'off':
            $_SESSION['logging'] = 'off';
            break;
    }
 }

/**
 * Check whether logging is enabled.
 *
 * @return boolean Return true if session variable for logging is set to 'on'.
 */
function loggingEnabled()
{
    if ($_SESSION['logging'] == 'on') {
        return true;
    }
}

/**
 * Unset a specific session variable.
 *
 * @param string $name Name of the session variable to delete.
 * @return void
 */
function clearSessionVar($name)
{
    if (isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
    }
    header('Location: session_details.php');
}

/**
 * Generate an AuthSub request Link and print it to the page.
 *
 * @param string $nextUrl URL to redirect to after performing the authentication.
 * @return void
 */
function generateAuthSubRequestLink($nextUrl = null)
{
    $scope = 'http://gdata.youtube.com';
    $secure = false;
    $session = true;

    if (!$nextUrl) {
        generateUrlInformation();
        $nextUrl = $_SESSION['operationsUrl'];
    }
    $config_var = new config(); 
    $url = Zend_Gdata_AuthSub::getAuthSubTokenUri($nextUrl, $scope, $secure, $session);
  /* <img src="'.$config_var->WEB_TPL_URL.'images/youtube.png" alt="youtube" border="0">*/
    echo '<a href="' . $url
        . '" style="margin-left:-30px;">Click to authenticate with youtube</a>';
 }

/**
 * Upgrade the single-use token to a session token.
 *
 * @param string $singleUseToken A valid single use token that is upgradable to a session token.
 * @return void
 */
function updateAuthSubToken($singleUseToken)
{
  try {
        $sessionToken = Zend_Gdata_AuthSub::getAuthSubSessionToken($singleUseToken);
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Token upgrade for ' . $singleUseToken
            . ' failed : ' . $e->getMessage();
        return;
    }
    $config_var = new config();
    $_SESSION['sessionToken'] = $sessionToken;
    generateUrlInformation();
    $_SESSION['homeUrl']=$config_var->WEB_URL.'index.php';
	header('Location: ' . $_SESSION['homeUrl']);
}

/**
 * Convenience method to obtain an authenticted Zend_Http_Client object.
 *
 * @return Zend_Http_Client An authenticated client.
 */
function getAuthSubHttpClient()
{
    if(isset($_REQUEST['token']) && $_REQUEST['token'] != ''){
	 $_SESSION['sessionToken'] = Zend_Gdata_AuthSub::getAuthSubSessionToken($_REQUEST['token']);
    }
	
	try {
        $httpClient = Zend_Gdata_AuthSub::getHttpClient($_SESSION['sessionToken']);
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not obtain authenticated Http client object. '
            . $e->getMessage();
        return;
    }
    $httpClient->setHeaders('X-GData-Key', 'key='. $_SESSION['developerKey']);
    return $httpClient;
}

/**
 * Echo img tags for the first thumbnail representing each video in the
 * specified video feed. Upon clicking the thumbnails, the video should
 * be presented.
 *
 * @param Zend_Gdata_YouTube_VideoFeed $feed The video feed
 * @return void
 */
function echoThumbnails($feed)
{
    foreach ($feed as $entry) {
        $videoId = $entry->getVideoId();
        $firstThumbnail = htmlspecialchars(
            $entry->mediaGroup->thumbnail[0]->url);
        echo '<img id="' . $videoId . '" class="thumbnail" src="'
            . $firstThumbnail .'" width="130" height="97" onclick="'
            . 'ytVideoApp.presentVideo(\'' . $videoId . '\', 1);" '
            . 'title="click to watch: ' .
            htmlspecialchars($entry->getVideoTitle()) . '" />';
     }
}

/**
 * Echo the list of videos in the specified feed.
 *
 * @param Zend_Gdata_YouTube_VideoFeed $feed The video feed.
 * @param boolean|null $authenticated If true then the videoList will
 * attempt to create additional forms to edit video meta-data.
 * @return void
 */
function echoVideoList($feed, $authenticated = false)
{
	
	
	$yuotubeUserName = $feed->author[0]->name->text;
	
	$videolist = '';
	$videolistMore = '';
	$videoView = '<div class="veiwer_text">';
    $videoViewMore = '<div class="veiwer_text">';
	$results = 0;
    $videoDetail = array();
    $yt = new Zend_Gdata_YouTube();
    $yt->setMajorProtocolVersion(2);
    
	$con = new  JDatabaseMySQL();
    $sql = "SELECT user_id FROM mgl_users WHERE user_name = '".$yuotubeUserName."'";
	$exec = mysql_query($sql) or mysql_error();
	$userId = mysql_fetch_row($exec);
	foreach ($feed as $entry) {
      /*echo "<pre>";
	   print_r($entry);
	   echo '</pre>';*/
	   
	    $videoId = $entry->getVideoId();
		
		$sql = "DELETE FROM youtubeactivities WHERE vId = '".$videoId."'";
		$exec = mysql_query($sql) or mysql_error();
		$commentFeed = $yt->getVideoCommentFeed($videoId);
       
		printCommentFeed($commentFeed,$videoId,$userId[0]);
		
	    $thumbnailUrl = 'notfound.jpg';
        if (count($entry->mediaGroup->thumbnail) > 0) {
            $thumbnailUrl = htmlspecialchars(
                $entry->mediaGroup->thumbnail[0]->url);
        }

        $videoTitle = htmlspecialchars($entry->getVideoTitle());
        $videoDescription = htmlspecialchars($entry->getVideoDescription());
        $videoCategory = htmlspecialchars($entry->getVideoCategory());
        $videoTags = $entry->getVideoTags();
        $viewCount = htmlspecialchars($entry->getVideoViewCount());
        $numRaters = 0;
        if (isset($entry->rating->average)) {
         $numRaters = $entry->rating->average;
        }
        $dateUpdate = $entry->getUpdated();
	    $videoDetail[$results]['videoId']= $videoId;
	    $videoDetail[$results]['thumbUrl']= $thumbnailUrl;
		$videoDetail[$results]['rating']= $numRaters;
		$videoDetail[$results]['viewCount']= $viewCount;
		$videoDetail[$results]['dateupdated']= $dateUpdate;
		$videoDetail[$results]['title']= $entry->getVideoTitle();
		$videoDetail[$results]['duration']=$entry->getVideoDuration();
		//$videoDetail[$results]['desc']= $entry->getVideoTitle();
	    $results++;
 }
    $videoToshow = 5;
	if(trim($_REQUEST['sortBy']) != ''){
    $videoDetail = sortArrayByKey($videoDetail,$_REQUEST['sortBy']);
	}
	 if(count($videoDetail)<5){
	  $videoToshow = count($videoDetail);
	 }
	 $videoToshow = count($videoDetail);
	$config_var = new config();
    session_start();
	$userId = $_SESSION["userAccountID"];
	 for($i=0;$i<count($videoDetail);$i++){
	     if($i<5){
			 $videolist .= '<div class="work_video" onmouseover="ShowAddtoplayListButton(\''.$videoDetail[$i]['videoId'].'\')" onmouseout="HideAddtoplayListButton(\''.$videoDetail[$i]['videoId'].'\')"><a href="javascript:;"><img onclick="ytVideoApp.presentVideo(\''
					.$videoDetail[$i]['videoId']. '\',\'' .$videoDetail[$i]['thumbUrl']. '\',\'' .addslashes($videoDetail[$i]['title']). '\',\'' .$videoDetail[$i]['duration']. '\',\'' .$_REQUEST['uId']. '\')" src="' .$videoDetail[$i]['thumbUrl']. '" border="0" width="170" height="92" /></a><div style="position:relative; top:-70px; left:55px; z-index:333; cursor:pointer;"><img src="'.$config_var->WEB_TPL_URL.'images/play.png" title="Play" alt="Play" onclick="ytVideoApp.presentVideo(\''
					.$videoDetail[$i]['videoId']. '\',\'' .$videoDetail[$i]['thumbUrl']. '\',\'' .addslashes($videoDetail[$i]['title']). '\',\'' .$videoDetail[$i]['duration']. '\',\'' .$_REQUEST['uId']. '\');" /> </div> <span style="left:145px;top:-70px; position:relative; z-index:333;display:none" id="'.$videoDetail[$i]['videoId'].'" onclick="openPlayListDiv(\'addToPlayList\',\'' .$videoDetail[$i]['videoId']. '\',\'' .$userId. '\');"><img src="'.$config_var->WEB_TPL_URL.'images/add_to_playlist.png" alt="Add" title="Add to playlist"  /></span>
</div>';
		   $videoView.='<div class="text_row"><div class="row">Rating:'.floatval($videoDetail[$i]['rating']).'</div><div class="row">Views: '. intval($videoDetail[$i]['viewCount']).'</div><div class="row">'.ago($videoDetail[$i]['dateupdated']).'</div></div>';
	   }
	   
	    $videolistMore .= '<div class="work_video_more" onmouseover="ShowAddtoplayListButton(\''.$videoDetail[$i]['videoId'].'_pop\')" onmouseout="HideAddtoplayListButton(\''.$videoDetail[$i]['videoId'].'_pop\')"><a href="javascript:;"><img onclick="ytVideoApp.presentVideo(\''
					.$videoDetail[$i]['videoId']. '\',\'' .$videoDetail[$i]['thumbUrl']. '\',\'' .addslashes($videoDetail[$i]['title']). '\',\'' .$videoDetail[$i]['duration']. '\',\'' .$_REQUEST['uId']. '\')" src="' .$videoDetail[$i]['thumbUrl']. '" border="0" width="170" height="92" /></a><div style="position:relative; top:-70px; left:55px; z-index:333; cursor:pointer;"><img src="'.$config_var->WEB_TPL_URL.'images/play.png" title="Play" alt="Play" onclick="ytVideoApp.presentVideo(\''
					.$videoDetail[$i]['videoId']. '\',\'' .$videoDetail[$i]['thumbUrl']. '\',\'' .addslashes($videoDetail[$i]['title']). '\',\'' .$videoDetail[$i]['duration']. '\',\'' .$_REQUEST['uId']. '\');" /><span style="left:45px;top:23px; position:relative; z-index:999;display:none;" id="'.$videoDetail[$i]['videoId'].'_pop" onclick="openPlayListDiv(\'addToPlayList\',\'' .$videoDetail[$i]['videoId']. '\',\'' .$userId. '\');"><img src="'.$config_var->WEB_TPL_URL.'images/add_to_playlist.png" alt="Add" title="Add to playlist"  /></span></div><br><div style="margin-top:-40px;"><span style="font-family:arial; font-size:12px; font-weight:bold; color:#999999; text-align:center; margin:4px 0 0 5px;width: 160px;">Rating:'.floatval($videoDetail[$i]['rating']).'</span><br><span style="font-family:arial; font-size:12px; font-weight:bold; color:#999999; text-align:center; margin:4px 0 0 5px;width: 160px;">Views: '.intval($videoDetail[$i]['viewCount']).'</span><br><span style="font-family:arial; font-size:12px; font-weight:bold; color:#999999; text-align:center; margin:4px 0 0 5px;width: 160px;">'.ago($videoDetail[$i]['dateupdated']).'</span></div></div>';
	
	}
	 
	  /*echo "<pre>";
		print_r($videoDetail);
		echo "</pre>";*/
    if ($results < 1) {
        echo '<br />No results found<br /><br />';
    } else {
        echo $videolist ;
		echo $videoView.='</div>@@@';
		echo ' <div id="my_panel" style="height:520px; width:993px; margin-left:3px;">'.$videolistMore.='</div></div>' ;
		//echo $videoViewMore;
    }
}



function printCommentFeed($commentFeed,$videoId,$userId) 
{
  $count = 1;
  foreach ($commentFeed as $commentEntry) {
   // echo 'Entry # ' . $count . "\n";
    printCommentEntry($commentEntry,$videoId,$userId);
  //  echo "\n";
    $count++;
  }
}

function printCommentEntry($commentEntry,$videoId,$userId) 
{
   /*echo "<pre>";
   print_r($commentEntry);
   echo "</pre>";*/
  
   $con = new  JDatabaseMySQL();
   
   
   $sql = "INSERT INTO youtubeactivities(vId,uId,youtubeUsername,title,comment,date_created)VALUES('".$videoId."','".$userId."','".$commentEntry->author[0]->name->text."','".$commentEntry->title->text."','".$commentEntry->content->text."','".$commentEntry->published->text."')";
   $exec = mysql_query($sql) or mysql_error();
  /* echo 'Comment: ' . $commentEntry->title->text . "\n";
  echo "Full text: " . $commentEntry->content->text . "\n";
  echo "Author: " . $commentEntry->author[0]->name->text . "\n"; */

 }


function sortArrayByKey($videoDetail,$sortkey='viewCount'){
	 
		 for($x = 0; $x < count($videoDetail); $x++) {
			for($y = 0; $y < count($videoDetail); $y++) {
			   if($videoDetail[$x][$sortkey] > $videoDetail[$y][$sortkey]) {
				 $hold = $videoDetail[$x];
				 $videoDetail[$x] = $videoDetail[$y];
				 $videoDetail[$y] = $hold;
			  }
		   }
		}
	  return $videoDetail;
}

function ago($datefrom,$dateto=-1)
  {
        // Defaults and assume if 0 is passed in that
        // its an error rather than the epoch
   
        if($datefrom=='0') { return "A long time ago"; }
        if($dateto=='-1') { $dateto = time(); }
       
        // Make the entered date into Unix timestamp from MySQL datetime field

        $datefrom = strtotime($datefrom);
   
        // Calculate the difference in seconds betweeen
        // the two timestamps

        $difference = $dateto - $datefrom;

        // Based on the interval, determine the
        // number of units between the two dates
        // From this point on, you would be hard
        // pushed telling the difference between
        // this function and DateDiff. If the $datediff
        // returned is 1, be sure to return the singular
        // of the unit, e.g. 'day' rather 'days'
   
        switch(true)
        {
            // If difference is less than 60 seconds,
            // seconds is a good interval of choice
            case(strtotime('-1 min', $dateto) < $datefrom):
                $datediff = $difference;
                $res = ($datediff==1) ? $datediff.' second ago' : $datediff.' seconds ago';
                break;
            // If difference is between 60 seconds and
            // 60 minutes, minutes is a good interval
            case(strtotime('-1 hour', $dateto) < $datefrom):
                $datediff = floor($difference / 60);
                $res = ($datediff==1) ? $datediff.' minute ago' : $datediff.' minutes ago';
                break;
            // If difference is between 1 hour and 24 hours
            // hours is a good interval
            case(strtotime('-1 day', $dateto) < $datefrom):
                $datediff = floor($difference / 60 / 60);
                $res = ($datediff==1) ? $datediff.' hour ago' : $datediff.' hours ago';
                break;
            // If difference is between 1 day and 7 days
            // days is a good interval               
            case(strtotime('-1 week', $dateto) < $datefrom):
                $day_difference = 1;
                while (strtotime('-'.$day_difference.' day', $dateto) >= $datefrom)
                {
                    $day_difference++;
                }
               
                $datediff = $day_difference;
                $res = ($datediff==1) ? 'yesterday' : $datediff.' days ago';
                break;
            // If difference is between 1 week and 30 days
            // weeks is a good interval           
            case(strtotime('-1 month', $dateto) < $datefrom):
                $week_difference = 1;
                while (strtotime('-'.$week_difference.' week', $dateto) >= $datefrom)
                {
                    $week_difference++;
                }
               
                $datediff = $week_difference;
                $res = ($datediff==1) ? 'last week' : $datediff.' weeks ago';
                break;           
            // If difference is between 30 days and 365 days
            // months is a good interval, again, the same thing
            // applies, if the 29th February happens to exist
            // between your 2 dates, the function will return
            // the 'incorrect' value for a day
            case(strtotime('-1 year', $dateto) < $datefrom):
                $months_difference = 1;
                while (strtotime('-'.$months_difference.' month', $dateto) >= $datefrom)
                {
                    $months_difference++;
                }
               
                $datediff = $months_difference;
                $res = ($datediff==1) ? $datediff.' month ago' : $datediff.' months ago';

                break;
            // If difference is greater than or equal to 365
            // days, return year. This will be incorrect if
            // for example, you call the function on the 28th April
            // 2008 passing in 29th April 2007. It will return
            // 1 year ago when in actual fact (yawn!) not quite
            // a year has gone by
            case(strtotime('-1 year', $dateto) >= $datefrom):
                $year_difference = 1;
                while (strtotime('-'.$year_difference.' year', $dateto) >= $datefrom)
                {
                    $year_difference++;
                }
               
                $datediff = $year_difference;
                $res = ($datediff==1) ? $datediff.' year ago' : $datediff.' years ago';
                break;
               
        }
        return $res;
 }		
 
		

/**
 * Echo the video embed code, related videos and videos owned by the same user
 * as the specified videoId.
 *
 * @param string $videoId The video
 * @return void
 */
function echoVideoPlayer($videoId)
{
    $youTubeService = new Zend_Gdata_YouTube();

    try {
        $entry = $youTubeService->getVideoEntry($videoId);
		
	} catch (Zend_Gdata_App_HttpException $httpException) {
        print 'ERROR ' . $httpException->getMessage()
            . ' HTTP details<br /><textarea cols="70" rows="20">'
            . $httpException->getRawResponseBody()
            . '</textarea><br />'
            . '<br />';
        return;
    }

    $videoTitle = htmlspecialchars($entry->getVideoTitle());
    $videoUrl = htmlspecialchars(findFlashUrl($entry));
    $relatedVideoFeed = getRelatedVideos($entry->getVideoId());
    $topRatedFeed = getTopRatedVideosByUser($entry->author[0]->name);
    $videoComments = $youTubeService -> getVideoCommentFeed($entry->getVideoId()); 
    $commentCount = count($videoComments);
    $scriberCount = $youTubeService ->getSubscriptionFeed($entry->author[0]->name);
	$profile=$youTubeService->getUserProfile($entry->author[0]->name);
	
	/*echo "<pre>";
	print_r($profile);
	echo "</pre>";*/
	
	print <<<END
        <b>$videoTitle</b><br /><br/><br/>
        <object width="425" height="350">
        <param name="movie" value="${videoUrl}&autoplay=1"></param>
        <param name="wmode" value="transparent"></param>
        <embed src="${videoUrl}&autoplay=1&rel=0" type="application/x-shockwave-flash" wmode="transparent"
        width="425" height="350"></embed>
        </object>
END;

    echo '<br />';
   // echoVideoMetadata($entry,$commentCount);
//	echo '<br /><b>Subscribers:</b>';
//	echo $profile->statistics->subscriberCount;
    //echo '<br /><b>Related:</b><br />';
   // echoThumbnails($relatedVideoFeed);
   // echo '<br /><b>Top rated videos by user:</b><br />';
   // echoThumbnails($topRatedFeed);
}

/**
 * Returns a feed of videos related to the specified video
 *
 * @param string $videoId The video
 * @return Zend_Gdata_YouTube_VideoFeed The feed of related videos
 */
function getRelatedVideos($videoId)
{
    $youTubeService = new Zend_Gdata_YouTube();
    $ytQuery = $youTubeService->newVideoQuery();
    // show videos related to the specified video
    $ytQuery->setFeedType('related', $videoId);
    // order videos by rating
    $ytQuery->setOrderBy('rating');
    // retrieve a maximum of 5 videos
    $ytQuery->setMaxResults(5);
    // retrieve only embeddable videos
    $ytQuery->setFormat(5);
	// show like
	$ytQuery->setOrderBy('rating');
    return $youTubeService->getVideoFeed($ytQuery);
}

/**
 * Returns a feed of top rated videos for the specified user
 *
 * @param string $user The username
 * @return Zend_Gdata_YouTube_VideoFeed The feed of top rated videos
 */
function getTopRatedVideosByUser($user)
{
    $userVideosUrl = 'http://gdata.youtube.com/feeds/users/' .
                   $user . '/uploads';
    $youTubeService = new Zend_Gdata_YouTube();
    $ytQuery = $youTubeService->newVideoQuery($userVideosUrl);
    // order by the rating of the videos
    $ytQuery->setOrderBy('rating');
    // retrieve a maximum of 5 videos
    $ytQuery->setMaxResults(5);
    // retrieve only embeddable videos
    $ytQuery->setFormat(5);
    return $youTubeService->getVideoFeed($ytQuery);
}

/**
 * Echo video metadata
 *
 * @param Zend_Gdata_YouTube_VideoEntry $entry The video entry
 * @return void
 */
function echoVideoMetadata($entry,$videoComments)
{

	$title = htmlspecialchars($entry->getVideoTitle());
    $description = htmlspecialchars($entry->getVideoDescription());
    $authorUsername = htmlspecialchars($entry->author[0]->name);
    $authorUrl = 'http://www.youtube.com/profile?user=' .
                 $authorUsername;
    $tags = htmlspecialchars(implode(', ', $entry->getVideoTags()));
    $duration = htmlspecialchars($entry->getVideoDuration());
    $watchPage = htmlspecialchars($entry->getVideoWatchPageUrl());
    $viewCount = htmlspecialchars($entry->getVideoViewCount());
    $rating = 0;
    if (isset($entry->rating->average)) {
        $rating = $entry->rating->average;
    }
    $numRaters = 0;
    if (isset($entry->rating->numRaters)) {
        $numRaters = $entry->rating->numRaters;
    }
    $flashUrl = htmlspecialchars(findFlashUrl($entry));
    print <<<END
        <b>Title:</b> ${title}<br />
        <b>Description:</b> ${description}<br />
        <b>Author:</b> <a href="${authorUrl}">${authorUsername}</a><br />
        <b>Tags:</b> ${tags}<br />
        <b>Duration:</b> ${duration} seconds<br />
        <b>View count:</b> ${viewCount}<br />
        <b>Rating:</b> ${rating} (${numRaters} ratings)<br />
		<b>Comments:</b> ${videoComments}<br />
        <b>Flash:</b> <a href="${flashUrl}">${flashUrl}</a><br />
        <b>Watch page:</b> <a href="${watchPage}">${watchPage}</a> <br />
END;
}

/**
 * Print message about YouTube caching.
 *
 * @return string A message
 */
function printCacheWarning()
{
    return '<p class="note">'
         . 'Please note that the change may not be reflected in the API '
         . 'immediately due to caching.<br/>'
         . 'Please refer to the API documentation for more details.</p>';
}

/**
 * Retrieve playlists for the currently authenticated user and print.
 * @return void
 */
function retrievePlaylists()
{
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $feed = $youTubeService->getPlaylistListFeed('default');

    if (loggingEnabled()) {
        logMessage($httpClient->getLastRequest(), 'request');
        logMessage($httpClient->getLastResponse()->getBody(), 'response');
    }

    if (!$feed instanceof Zend_Gdata_YouTube_PlaylistListFeed) {
        print 'ERROR - Could not retrieve playlists<br />'.
        printCacheWarning();
        return;
    }

    $playlistEntries = '<ul>';
    $entriesFound = 0;
    foreach($feed as $entry) {
        $playlistTitle = $entry->getTitleValue();
        $playlistDescription = $entry->getDescription()->getText();
        $playlistEntries .=  '<li><h3>' . $playlistTitle
            . '</h3>' . $playlistDescription . ' | '
            . '<a href="#" onclick="ytVideoApp.prepareUpdatePlaylistForm(\''
            . $playlistTitle . '\', \'' . $playlistDescription
            . '\'); ">update</a> | '
            . '<a href="#" onclick="ytVideoApp.confirmPlaylistDeletion(\''
            . $playlistTitle. '\');">delete</a></li>';
        $entriesFound++;
    }

    $playlistEntries .= '</ul><br /><a href="#" '
                        . 'onclick="ytVideoApp.prepareCreatePlaylistForm(); '
                        . 'return false;">'
                        . 'Add new playlist</a><br />'
                        . '<div id="addNewPlaylist"></div>';

    if (loggingEnabled()) {
        logMessage($httpClient->getLastRequest(), 'request');
        logMessage($httpClient->getLastResponse()->getBody(), 'response');
    }
    if ($entriesFound > 0) {
        print $playlistEntries;
    } else {
        print 'No playlists found';
    }
}

/**
 * Create a new playlist for the currently authenticated user
 *
 * @param string $playlistTitle Title of the new playlist
 * @param string $playlistDescription Description for the new playlist
 * @return void
 */
function createPlaylist($playlistTitle, $playlistDescription)
{
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $feed = $youTubeService->getPlaylistListFeed('default');
    if (loggingEnabled()) {
        logMessage($httpClient->getLastRequest(), 'request');
        logMessage($httpClient->getLastResponse()->getBody(), 'response');
    }

    $newPlaylist = $youTubeService->newPlaylistListEntry();
    $newPlaylist->description = $youTubeService->newDescription()->setText($playlistDescription);
    $newPlaylist->title = $youTubeService->newTitle()->setText($playlistDescription);

    if (!$feed instanceof Zend_Gdata_YouTube_PlaylistListFeed) {
        print 'ERROR - Could not retrieve playlists<br />'
            . printCacheWarning();
        return;
    }

    $playlistFeedUrl = 'http://gdata.youtube.com/feeds/users/default/playlists';

    try {
        $updatedEntry = $youTubeService->insertEntry($newPlaylist, $playlistFeedUrl);
        if (loggingEnabled()) {
            logMessage($httpClient->getLastRequest(), 'request');
            logMessage($httpClient->getLastResponse()->getBody(), 'response');
        }
    } catch (Zend_Gdata_App_HttpException $httpException) {
        print 'ERROR ' . $httpException->getMessage()
            . ' HTTP details<br /><textarea cols="70" rows="20">'
            . $httpException->getRawResponseBody()
            . '</textarea><br />'
            . '<br />';
        return;
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not create new playlist: ' . $e->getMessage();
        return;
    }

    print 'Playlist added succesfully.<br /><a href="#" onclick="'
        . 'ytVideoApp.retrievePlaylists();"'
        . '">(refresh your playlist listing)</a><br />'
        . printCacheWarning();
}

/**
 * Delete a playlist
 *
 * @param string $playlistTitle Title of the playlist to be deleted
 * @return void
 */
function deletePlaylist($playlistTitle)
{
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $feed = $youTubeService->getPlaylistListFeed('default');
    if (loggingEnabled()) {
        logMessage($httpClient->getLastRequest(), 'request');
        logMessage($httpClient->getLastResponse()->getBody(), 'response');
    }

    $playlistEntryToDelete = null;

    foreach($feed as $playlistEntry) {
        if ($playlistEntry->getTitleValue() == $playlistTitle) {
            $playlistEntryToDelete = $playlistEntry;
            break;
        }
    }

    if (!$playlistEntryToDelete instanceof Zend_Gdata_YouTube_PlaylistListEntry) {
        print 'ERROR - Could not retrieve playlist to be deleted<br />'
            . printCacheWarning();
            return;
    }

    try {
        $response = $playlistEntryToDelete->delete();
        if (loggingEnabled()) {
            logMessage($httpClient->getLastRequest(), 'request');
            logMessage($httpClient->getLastResponse()->getBody(), 'response');
        }
    } catch (Zend_Gdata_App_HttpException $httpException) {
        print 'ERROR ' . $httpException->getMessage()
            . ' HTTP details<br /><textarea cols="70" rows="20">'
            . $httpException->getRawResponseBody()
            . '</textarea><br />'
            . '<br />';
        return;
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not delete the playlist: ' . $e->getMessage();
        return;
    }

    print 'Playlist deleted succesfully.<br />'
        . '<a href="#" onclick="ytVideoApp.retrievePlaylists();">'
        . '(refresh your playlist listing)</a><br />' . printCacheWarning();
}

/**
 * Delete a playlist
 *
 * @param string $newplaylistTitle New title for the playlist to be updated
 * @param string $newPlaylistDescription New description for the playlist to be updated
 * @param string $oldPlaylistTitle Title of the playlist to be updated
 * @return void
 */
function updatePlaylist($newPlaylistTitle, $newPlaylistDescription, $oldPlaylistTitle)
{
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $feed = $youTubeService->getPlaylistListFeed('default');

    if (loggingEnabled()) {
        logMessage($httpClient->getLastRequest(), 'request');
        logMessage($httpClient->getLastResponse()->getBody(), 'response');
    }

    $playlistEntryToDelete = null;

    foreach($feed as $playlistEntry) {
        if ($playlistEntry->getTitleValue() == $oldplaylistTitle) {
            $playlistEntryToDelete = $playlistEntry;
            break;
        }
    }

    if (!$playlistEntryToDelete instanceof Zend_Gdata_YouTube_PlaylistListEntry) {
        print 'ERROR - Could not retrieve playlist to be updated<br />'
            . printCacheWarning();
            return;
    }

    try {
        $response = $playlistEntryToDelete->delete();
        if (loggingEnabled()) {
            logMessage($httpClient->getLastRequest(), 'request');
            logMessage($httpClient->getLastResponse()->getBody(), 'response');
        }
    } catch (Zend_Gdata_App_HttpException $httpException) {
        print 'ERROR ' . $httpException->getMessage()
            . ' HTTP details<br /><textarea cols="70" rows="20">'
            . $httpException->getRawResponseBody()
            . '</textarea><br />'
            . '<br />';
            return;
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not delete the playlist: ' . $e->getMessage();
        return;
    }

    print 'Playlist deleted succesfully.<br /><a href="#" onclick="' .
          'ytVideoApp.retrievePlaylists();"'.
          '">(refresh your playlist listing)</a><br />'.
          printCacheWarning();
}



function addVideoEntry($arr){
             $con = new  JDatabaseMySQL();
            $query= "SELECT * FROM mgl_videodetail WHERE vid = '".$arr['videoId']."'";	
			$exec = mysql_query($query) or mysql_error();
			$num_rows = mysql_num_rows($exec);
			if($num_rows==0){
			$query="INSERT INTO mgl_videodetail(vid,uId,vtitle,vdesc,vtags,vthumbs,vduration)VALUES('".$arr['videoId']."','".$arr['uId']."','".$arr['title']."','".$arr['title']."','tunezy','".$arr['thumb']."','".$arr['duration']."')";
		     $exec = mysql_query($query) or mysql_error();
			 $entry = getEntry($arr['videoId']);
			 $sql = "SELECT user_name FROM mgl_users WHERE user_id = '".$arr['uId']."'";
			 $exec = mysql_query($sql) or mysql_error();
			 $res =  mysql_fetch_assoc($exec);
			 $ratingInfo = $entry->getVideoRatingInfo();
			 $youtubeUserName = $res['user_name'];
			 $comment= $entry->comments->feedLink->countHint;
			 $favorites= $entry->statistics->favoriteCount;
			 $numRaters = $ratingInfo['numRaters'];
			 $avgRatig = $ratingInfo['average'];
			 $view = htmlspecialchars($entry->getVideoViewCount());
			 $sql = "INSERT INTO youtubevideos(`videoId`,`youtubeUser`,`comments`,`favourites`,`numberOfRaters`,`averageRating`,`views`,`dateUpdated`)VALUES('".$arr['videoId']."','".$youtubeUserName."','".$comment."','".$favorites."','".$numRaters ."','".$avgRatig."','".$view."',now())";
			$exec = mysql_query($sql) or mysql_error();
			
			$query = "INSERT INTO mgl_contest_video(contestId,VideoId,userId,dateUploaded)VALUES('0','".$arr['videoId']."','".$arr['uId']."',now())";
			$exec = mysql_query($query) or mysql_error();
	}
          
 /*echo "<pre>";
 print_r($arr);
 echo "</pre>";*/

}

/**
 * Helper function if an unsupported operation is passed into this files main loop.
 *
 * @param array $post (Optional) The post variables that accompanied the operation, if available.
 * @return void
 */
function unsupportedOperation($_POST)
{
    $message = 'ERROR An unsupported operation has been called - post variables received'
             . print_r($_POST, true);

    if (loggingEnabled()) {
        logMessage($message, 'error');
    }
    print $message;
	
}

class location extends JDatabaseMySQL{

}

?>
