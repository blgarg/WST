<?php
 require_once($config_var->LIB_ROOT.'mysql/mysql.php');
 $JDatabaseMySQL  =  new JDatabaseMySQL();
class model_fan_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = '';        
          function __construct(  ){ }   			   		   
		  
			// parent::__query($this->qry);	
			function initialize(){}	
			function getvarp(){
				 //$this->_result = mysql_query($this->qry);
						$_data = $this->get_page_nav();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
			}
			function numRow(){	
						$this->setQuery($this->qry);
						$array_aa = $this->getNumRows();
						return $array_aa;
											
				}
				
				
			function getFanData($id)
			{		$this->sql = "SELECT * FROM mgl_users WHERE user_id=".$id;
					$this->query();
					$this->_result = $this->getArray();   				
					//print_r($this->_result); die;
					return $this->_result;			
			}	
			
			function current_Favorite_Artist()
			{		$this->sql = "SELECT * FROM mgl_users WHERE type = '1' AND user_role = 'user' order by rand() limit 1";
					$this->query();
					$this->_result = $this->getArray();   				
					//print_r($this->_result); die;
					return $this->_result;			
			}	
			
			
			function getCountryName($id){
				$this->sql = "SELECT name FROM country WHERE id=".$id;
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result['name'];	
			}	
			
			function format_date($original='', $format="%b %d,%Y"){ 
             $format = ($format=='date' ? "%m-%d-%Y" : $format); 
             $format = ($format=='datetime' ? "%m-%d-%Y %H:%M:%S" : $format); 
             $format = ($format=='mysql-date' ? "%Y-%m-%d" : $format); 
             $format = ($format=='mysql-datetime' ? "%Y-%m-%d %H:%M:%S" : $format); 
             return (!empty($original) ? strftime($format, strtotime($original)) : "" ); 
           } 	
			
			
			function getPlayList()
			{		$session = new session();
					$model_fan_default = new model_fan_default();
					$idUser = @$session->getVar("userAccountID");
					$this->sql = "SELECT * FROM mgl_users_playlist WHERE playlist_user_id=".$idUser;
					$this->query();
					$this->_result = $this->loadAssoc();
					
					
						
					//print_r($this->_result); die;
					//return $this->_result;
					
					$PlayList = '<div class="saved_playlist_content">';
					$j=1;
					for($i=0;$i<count($this->_result);$i++){
					 
					 $playlistTime = self::getPlayListTime($this->_result[$i]['playlist_id']);
                     $PlayList .='<a href="javascript:;" onclick="PlaySong('.$this->_result[$i]['playlist_id'].',\''.$this->_result[$i]['playlist_name'].'\');" style="text-decoration:none;">
					 <div class="saved_playlist_text_main"><div class="left_text">'.$j.'. '.ucfirst($this->_result[$i]['playlist_name']).'</div>
					 <div class="right_text">'.gmdate("H:i:s",$playlistTime).'</div></div></a>';
                      $j++; }
					  if(count($this->_result) <=0){
					  $PlayList .= '<h2 style="font-size:12px;text-align:center;">No playlist found.</h2>';
					  }                               
                      $PlayList .= '</div>';
					  return  $PlayList ;			
			}
			
			
			function getVideos($playListId){
				$this->sql = "SELECT * FROM mgl_fan_playlist WHERE playList_id=".$playListId;
				$this->query();
				$this->_result = $this->loadAssoc();
				
				$TotalDuration = 0;
				for($i=0;$i<count($this->_result);$i++){
				   $TotalDuration += $this->getDuration($this->_result[$i]['youtube_video_id']);
				}
				return $TotalDuration;
			}
			
			
			function getDuration($VideoId){
				$this->sql = "SELECT * FROM mgl_videodetail WHERE vid=".$VideoId;
				$this->query();
				$this->_result = $this->getArray();
				return $this->_result['vduration'];
			}
			
			
			 function getMyTuneCrew($fanId){
				$this->sql = "SELECT * FROM mgl_tune_crew WHERE fan_id='$fanId' ";
				$this->query();
				$this->_result = $this->loadAssoc();
				return $this->_result;
			}
			
  			function getMyFavouritArtist($fanId){
				$this->sql = "SELECT * FROM  mgl_fan_favourit_artist WHERE fan_id='$fanId'";
				$this->query();
				$this->_result = $this->loadAssoc();
				return $this->_result;
			}
			
			
			function getMyFavouritArtistDetail($fanId){
				$this->sql = "SELECT * FROM  mgl_fan_favourit_artist WHERE fan_id='$fanId' ORDER BY date_added DESC LIMIT 1";
				$this->query();
				$this->_result = $this->loadAssoc();
				return $this->_result;
			}
						
			function getPlayListTime($Id){
				   $this->qry = "SELECT SUM(mgl_videodetail.vduration) AS totalDuaration FROM mgl_fan_playlist,mgl_videodetail WHERE mgl_videodetail.vid = mgl_fan_playlist.youtube_video_id AND playList_id = '".$Id."' ";
					$this->sql = $this->qry;
					$this->query();
					$UserData = $this->loadAssoc();
					if(count($UserData)>0){
					return number_format($UserData[0]['totalDuaration'],2);
					}else{
					return  number_format(0,2);
					}
				}
				
				
			function lastPlayedVideo($userId){
				/*echo $this->qry = "SELECT  LastPlayedVideo.*,videoDetail.* 
				  				FROM  lastplaysong as LastPlayedVideo,mgl_videodetail as videoDetail 
								WHERE 
								LastPlayedVideo.uId = '".$userId."'
								AND
								videoDetail.vid = LastPlayedVideo.playId 
							   ";*/
							   
				$this->qry = "SELECT  * 
				  				FROM  lastplaysong 
								WHERE 
								uId = '".$userId."'
							   ";			   
				  $this->sql = $this->qry;
				  $this->query();
				  $LastPlayedVideoData = $this->loadAssoc();
				  			  
				  $this->qry = "SELECT  * 
				  				FROM  mgl_videodetail 
								WHERE 
								vid = '".$LastPlayedVideoData[0]['playId']."'
							   ";			   
				  $this->sql = $this->qry;
				  $this->query();
				  $LastPlayedVideoData2 = $this->loadAssoc();
				  //print_r($LastPlayedVideoData2);
				  
				  
				  return $LastPlayedVideoData2;
			}	
			
			
			
			
}
						
						
						
