<?php
 include '../settings.php';
 require_once('../inc/load.php');
 class doRank extends JDatabaseMySQL {
 	var $qry;
	var $_like_result;
	var $_dislike_result;
	var $like_alreadyRatedVideo_flag;
	var $dis_like_alreadyRatedVideo_flag;
	var $video_id;
	var $contest_id; 
	var $user_id;
	var $_like_total_unique_counts;
	var $_dislike_total_unique_counts;
	var $_like_dataSet;
	var $_dislike_dataSet;
	var $_aveg_total;
	var $_total_num_of_likes_dislikes;
	
	function __construct($video_id,$contest_id,$user_id)
	{	
	    $this->video_id = $video_id;
		$this->contest_id = $contest_id;
		$this->user_id = $user_id;
		self::alreadyRatedVideo();
		self::video_avg();
	}
 	
	function alreadyRatedVideo(){
 	  $this->qry = "SELECT * FROM mgl_video_rating WHERE video_id = '".$this->video_id."' AND  contest_id = '".$this->contest_id."' AND user_ip = '".$this->user_id."' AND unique_hit_count = '1'";
	  $this->sql = $this->qry;
	  $this->query();
	  $_like_result = $this->getNumRows();
	  $_like_dataSet = $this->getArray();
	  //$_like_total_unique_counts = $_like_dataSet['unique_hit_count'];
	  if($_like_result <=0){
	  $this->like_alreadyRatedVideo_flag = false;
	  $this->_like_total_unique_counts = 1;
	  }else{
	  $this->like_alreadyRatedVideo_flag = true;
	   //$this->_like_total_unique_counts = 1;
	} 
		
	 $this->qry = "SELECT * FROM mgl_video_rating WHERE video_id = '".$this->video_id."' AND  contest_id = '".$this->contest_id."' AND user_ip = '".$this->user_id."' AND unique_hit_count = '-1'";
	  $this->sql = $this->qry;
	  $this->query();
	  $_dislike_result = $this->getNumRows();
	  $_dislike_dataSet = $this->getArray();
	  //$_dislike_total_unique_counts = $_dislike_dataSet['unique_hit_count'];
	  if($_dislike_result <=0){
	  $this->dis_like_alreadyRatedVideo_flag = false;
	  $this->_dislike_total_unique_counts = -1;
	  }else{
	  $this->dis_like_alreadyRatedVideo_flag = true;
	  // $this->_dislike_total_unique_counts = -1;
	}

}  

function deleteCurrentrate(){
	  $this->qry = "DELETE FROM mgl_video_rating WHERE video_id = '".$this->video_id."' AND  contest_id = '".$this->contest_id."' AND user_ip = '".$this->user_id."' ";
	  $this->sql = $this->qry;
	  $this->query();
	  return true;
	}
	
function doRate(){
	
  $check = 1;
  if(!$this->like_alreadyRatedVideo_flag){//$this->deleteCurrentrate();
	 $this->qry = "INSERT INTO mgl_video_rating(video_id, contest_id, user_ip, unique_hit_count) VALUES('".$this->video_id."', '".$this->contest_id."', '".$this->user_id."', '".$this->_like_total_unique_counts."' ) ";
	$check = 3;
	$this->sql = $this->qry;
	$this->query() ;
  }
 
  return  $check ;
}

function doUnRate(){
  $ucheck = 1;
   if(!$this->dis_like_alreadyRatedVideo_flag){
  	$this->qry = "INSERT INTO mgl_video_rating(video_id, contest_id, user_ip, unique_hit_count) VALUES('".$this->video_id."', '".$this->contest_id."', '".$this->user_id."', '".$this->_dislike_total_unique_counts."' ) ";
				$ucheck = 3;
	$this->sql = $this->qry;
	$this->query();
  }
  
  return $ucheck;
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
	
	function video_avg(){
				$this->sql = "SELECT * FROM mgl_video_rating WHERE contest_id = '".$this->contest_id."'";
				$this->query();
	  			$this->_total_num_of_likes_dislikes = $this->getNumRows();
				
				$this->sql = "SELECT * FROM mgl_video_rating WHERE contest_id = '".$this->contest_id."' AND unique_hit_count = '-1'";
				$this->query();
	  			$_total_num_of_dislikes = $this->getNumRows();
				
				$this->sql = "SELECT * FROM mgl_video_rating WHERE contest_id = '".$this->contest_id."' AND unique_hit_count = '1'";
				$this->query();
	  			$_total_num_of_likes = $this->getNumRows();
				
				$this->sql = "SELECT sum(total_comments) FROM mgl_video_comments_update WHERE contest_id = '".$this->contest_id."' ";
				$this->query();
	  			$comments_data = $this->getArray();
				$total_comments = $comments_data['sum(total_comments)'];
				
				
				//$this->_aveg_total = ($_total_num_of_likes + $_total_num_of_dislikes)/$this->_total_num_of_likes_dislikes;
				$this->_aveg_total = $_total_num_of_likes - $_total_num_of_dislikes + $total_comments;

			/**/
	 }
	 
	 function updateVideoRank(){
	 			
				$this->sql = "SELECT * FROM mgl_video_rating WHERE contest_id = '".$this->contest_id."' AND unique_hit_count = '1' AND video_id = '".$this->video_id."'";
				$this->query();
	  			$_total_num_of_likes = $this->getNumRows();
				
				$this->sql = "SELECT * FROM mgl_video_rating WHERE contest_id = '".$this->contest_id."' AND unique_hit_count = '-1' AND video_id = '".$this->video_id."'";
				$this->query();
	  			$_total_num_of_dislikes = $this->getNumRows();
				
				$this->sql = "SELECT * FROM mgl_video_rating WHERE contest_id = '".$this->contest_id."' and video_id = '".$this->video_id."'";
				$this->query();
	  			$_total_num_of_likes_dislikes = $this->getNumRows();
				
				$this->sql = "SELECT * FROM mgl_video_comments_update WHERE contest_id = '".$this->contest_id."' and video_id = '".$this->video_id."'";
				$this->query();
	  			$comments_data = $this->getArray();
				$total_comments = $comments_data['total_comments'];
				
				
				$videos_rank = $_total_num_of_likes - $_total_num_of_dislikes + $total_comments;
				
				$this->sql = "DELETE FROM mgl_video_rating_update WHERE contest_id = '".$this->contest_id."' and video_id = '".$this->video_id."'";
				$this->query();
				
				$this->sql = "INSERT INTO mgl_video_rating_update(video_id, contest_id, rating) VALUES('".$this->video_id."','".$this->contest_id."','".$videos_rank."')";
				$this->query();			
				
				
				//$videos_rank = $videos_rank/$this->_aveg_total;
				
				//return array($videos_rank,$this->_aveg_total);//$videos_rank;
	 }
		
}

 if(isset($_REQUEST['action']) && $_REQUEST['action']=='doLike'){
	  $session = new session();
	  $resp = '';
	  //$userId = $session->getVar("userAccountID");
	   $userIP = @$_SERVER['REMOTE_ADDR'];
	  $contestId = $_REQUEST['contestId'];
	  $videoId  = $_REQUEST['videoId'];
	  $doRank = new doRank($videoId, $contestId, $userIP );
	  $return = $doRank->doRate();
	  if($return == 3)
	  {
	   		$resp = '<p>You have voted successfully.</p>';
	  }else{
	  		$resp = '<p>You have already voted this video.</p>';
	  }
	  $likes_number =  $doRank->getLikes($videoId, $contestId);
	  $doRank->updateVideoRank();
	  //if($likes_number == 0){$likes_number  = 1;}
	  $isAction = 1;
      $result = array("isAction"=>$isAction,"resp"=>$resp,"video_id"=>$videoId,"action"=>'like',"num_likes"=>$likes_number);
	  $result = json_encode($result);
	  echo $result;
}	  

if(isset($_REQUEST['action']) && $_REQUEST['action']=='doDisLike'){
	  $session = new session();
	  $resp = '';
	  //$userId = $session->getVar("userAccountID");
	  $userIP = @$_SERVER['REMOTE_ADDR'];
	  $contestId = $_REQUEST['contestId'];
	  $videoId  = $_REQUEST['videoId'];
	  $doRank = new doRank($videoId, $contestId, $userIP);
	  $return = $doRank->doUnRate();
	  if($return == 3)
	  {
	   		$resp = '<p>You have removed vote successfully.</p>';
	  }else{
	  		$resp = '<p>You have already removed vote.</p>';
	  }
	 
	  $Dislikes_number =  $doRank->getDisLikes($videoId, $contestId);
	  $doRank->updateVideoRank();
	  $isAction = 1;
	  //$todtal_rank = $doRank->updateVideoRank();
      $result = array("isAction"=>$isAction,"resp"=>$resp,"video_id"=>$videoId,"action"=>'dislike',"num_dislikes"=>$Dislikes_number);
	  $result = json_encode($result);
	  echo $result;
}	  

?>