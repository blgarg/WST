<?php
 include '../../settings.php';
 require_once('../../inc/load.php');
 $session = new session();
 class PlayListModel extends JDatabaseMySQL{
     
	 function getUserPlayList(){
	     $this->qry = "SELECT * FROM mgl_users_playlist WHERE playlist_user_id = '".$_SESSION['userAccountID']."'";
		 $this->sql = $this->qry;
		 $this->query();
		 $PlayList = $this->loadAssoc();
		 return $PlayList;
	 }
 }
 
  $playerObj = new PlayListModel();
  if(isset($_REQUEST['action']) && $_REQUEST['action']=='getPlayList'){
   $playListHtml = '<table cellspacing="5" cellpadding="5" width="100%">';
    if(isset($_SESSION['userAccountID'])){
    
	$playList = $playerObj->getUserPlayList();
	//print_r($playList);
	if(count($playList)>0){
	   $playListHtml.='<tr><td><strong>Playlist Name</strong></td><td><strong>ACTION</strong></td></tr>';
	  for($i=0;$i<count($playList);$i++){
	  $playListHtml.='<tr><td>'.$playList[$i]['playlist_name'].'</td><td> <a href="#" title="playlist" onclick="PlaySong('.$playList[$i]['playlist_id'].',\''.$playList[$i]['playlist_name'].'\');">Play </a> | <a href="#" title="playlist" onclick="deletePlayList('.$playList[$i]['playlist_id'].');">DELETE </a></td></tr>';
	  }
	
	}else{
	  $addToPlayList = 'addToPlayList';
	  $playListHtml.='<tr><td>No playlist created yet. </td><td>Please <a href="#" onclick="openPlayListDiv(\''.$addToPlayList.'\',\'\',\''.$_SESSION["userAccountID"].'\');">click here</a> to crete playlist.</td></tr>';
	}
	
 }else{
  $playListHtml.='<tr><td>Please do login to select your playlist.</td></tr>';
 }
	$playListHtml.='</table>';
   echo $playListHtml;
  }	