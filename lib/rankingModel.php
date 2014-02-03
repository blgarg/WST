<?php
// All ranking models.
include '../settings.php';
require_once('../inc/load.php');  
// 1. Influence Ranking model

class influence_Model extends JDatabaseMySQL{
	var $qry;
	var $userId;
	var $subscribers;				// Single user's youtube subscribers
	var $avg_subscribers_universe; 	// Average of all youtube user's subscribers 
	var $views;						// Single user's video's views
	var $avg_views_universe;		// All youtube users's videos's view
	var $view_weighted_average_rating;
	var $avg_vwar_universe;
	var $avg_videos;				// All youtube videos in entire database
	var $video_weighted_rating;		// weighted rating for a particular video of a user
	var $favourites;				// Number of favoutites of a particular user
	var $avg_favourites_universe;	// Average of total favourites 
	var $facebook_likes;    		// Single user's facbook like  
	var $avg_facebook_likes_universe;	// Average of all users
	var $rank_is = 0;
	var $_result;
	
	function __construct(){}
	function setRank ($youtube_user_id){
		$this->userId = $youtube_user_id;
		$this->qry = "SELECT * FROM dailystatistics AS dailyStats WHERE userName = '$this->userId' ORDER BY lastDate DESC LIMIT 1";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = (object)$this->getArray();
		$this->subscribers = $this->_result->subscribers;
		$this->avg_subscribers_universe = $this->_result->avg_subscribers_universe;
		$this->views = $this->_result->views;
		$this->avg_views_universe = $this->_result->avg_views_universe;
		$this->view_weighted_average_rating = $this->_result->view_weighted_average_rating;
		$this->avg_vwar_universe = $this->_result->avg_vwar_universe;
		$this->favourites = $this->_result->favourites;
		$this->avg_favourites_universe = $this->_result->avg_favourites_universe;
		$this->facebook_likes = $this->_result->facebook_likes;
		$this->avg_facebook_likes_universe = $this->_result->avg_facebook_likes_universe;
	}
	function getRank($youtube_user_id){
		self::setRank ($youtube_user_id);
		$this->qry = "SELECT * FROM mgl_ranking_module_attribute WHERE rank_module_id = '1' AND rank_attr_status = '1' ORDER BY rank_attr_id ASC";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = $this->loadAssoc();
		$ARRAY_TO_ATTRIBUTES = array();
		for($i=0;$i<count($this->_result);$i++){
		$ARRAY_TO_ATTRIBUTES[$i] =  $this->_result[$i]['rank_attr_name'];
		}
		if(in_array("Subscribers",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is =  ($this->subscribers / $this->avg_subscribers_universe);}else{ $this->rank_is += 0; }
		if(in_array("Views",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is += ( $this->views / $this->avg_views_universe); }else{ $this->rank_is += 0; }
		if(in_array("Weighted_rating",$ARRAY_TO_ATTRIBUTES)){$this->rank_is += ( $this->view_weighted_average_rating / $this->avg_vwar_universe);}else{ $this->rank_is += 0; }
		if(in_array("Favourites",$ARRAY_TO_ATTRIBUTES)){$this->rank_is +=  ( $this->favourites / $this->avg_favourites_universe); }else{ $this->rank_is += 0; }
		if(in_array("Facebook",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is +=( $this->facebook_likes / $this->avg_facebook_likes_universe);}else{ $this->rank_is += 0; } ;
		return $this->rank_is;
	}
} 


	// 2. Going Viral Ranking model
class goingViral_Model extends JDatabaseMySQL{
	var $qry;
	var $userId;
	var $views_last3;				// Single user's video's views
	var $views_last3_avg200;		// youtube users's videos's view
	var $rank_is = 0;		
	var $_result;		
	function __construct(){}
	
	function setRank ($youtube_user_id){
		$this->userId = $youtube_user_id;
		$this->qry = "SELECT * FROM dailystatistics AS dailyStats WHERE userName = '$this->userId' ORDER BY lastDate DESC LIMIT 1";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = (object)$this->getArray();
		$this->views_last3 = $this->_result->views_last3;
		$this->views_last3_avg200 = $this->_result->views_last3_avg200;
	}
	function getRank($youtube_user_id){
		self::setRank ($youtube_user_id);
		$this->qry = "SELECT * FROM mgl_ranking_module_attribute WHERE rank_module_id = '2' AND rank_attr_status = '1' ORDER BY rank_attr_id ASC";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = $this->loadAssoc();
		$ARRAY_TO_ATTRIBUTES = array();
		for($i=0;$i<count($this->_result);$i++){
		$ARRAY_TO_ATTRIBUTES[$i] =  $this->_result[$i]['rank_attr_name'];
		}
		
		$this->rank_is = ($this->views_last3) / ($this->views_last3_avg200) ;
		return $this->rank_is;
	}	
}

	// 3. The Young and Talented
class theYoungAndTalented_Model extends JDatabaseMySQL{
	var $qry;
	var $user_age; // Tunezy user's age
	var $is_young = false;
	var $_result;
	var $rank_is = 0;
	var $subscribers;				// Single user's youtube subscribers
	var $avg_subscribers_universe; 	// Average of all youtube user's subscribers 
	var $views;						// Single user's video's views
	var $avg_views_universe;		// All youtube users's videos's view
	var $view_weighted_average_rating;
	var $avg_vwar_universe;
	var $avg_videos;				// All youtube videos in entire database
	var $video_weighted_rating;		// weighted rating for a particular video of a user
	var $favourites;				// Number of favoutites of a particular user
	var $avg_favourites_universe;	// Average of total favourites 
	var $facebook_likes;    		// Single user's facbook like  
	var $avg_facebook_likes_universe;	// Average of all users	    
	
	function __construct(){}

	function setRank ($youtube_user_id){
		$this->userId = $youtube_user_id;
		$this->qry = "SELECT * FROM dailystatistics AS dailyStats,youtubeuser WHERE userName = '$this->userId' AND youtubeuser.age <=21  ORDER BY lastDate DESC LIMIT 1";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = (object)$this->getArray();
		$this->subscribers = $this->_result->subscribers;
		$this->avg_subscribers_universe = $this->_result->avg_subscribers_universe;
		$this->views = $this->_result->views;
		$this->avg_views_universe = $this->_result->avg_views_universe;
		$this->view_weighted_average_rating = $this->_result->view_weighted_average_rating;
		$this->avg_vwar_universe = $this->_result->avg_vwar_universe;
		$this->favourites = $this->_result->favourites;
		$this->avg_favourites_universe = $this->_result->avg_favourites_universe;
		$this->facebook_likes = $this->_result->facebook_likes;
		$this->avg_facebook_likes_universe = $this->_result->avg_facebook_likes_universe;
	}
	function getRank($youtube_user_id){
		self::setRank ($youtube_user_id);
		$this->qry = "SELECT * FROM mgl_ranking_module_attribute WHERE rank_module_id = '1' AND rank_attr_status = '1' ORDER BY rank_attr_id ASC";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = $this->loadAssoc();
		$ARRAY_TO_ATTRIBUTES = array();
		for($i=0;$i<count($this->_result);$i++){
		$ARRAY_TO_ATTRIBUTES[$i] =  $this->_result[$i]['rank_attr_name'];
		}
		if(in_array("Subscribers",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is =  ($this->subscribers / $this->avg_subscribers_universe);}else{ $this->rank_is += 0; }
		if(in_array("Views",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is += ( $this->views / $this->avg_views_universe); }else{ $this->rank_is += 0; }
		if(in_array("Weighted_rating",$ARRAY_TO_ATTRIBUTES)){$this->rank_is += ( $this->view_weighted_average_rating / $this->avg_vwar_universe);}else{ $this->rank_is += 0; }
		if(in_array("Favourites",$ARRAY_TO_ATTRIBUTES)){$this->rank_is +=  ( $this->favourites / $this->avg_favourites_universe); }else{ $this->rank_is += 0; }
		if(in_array("Facebook",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is +=( $this->facebook_likes / $this->avg_facebook_likes_universe);}else{ $this->rank_is += 0; } ;
		return $this->rank_is;
	}
	
}	
	
	// 4. The Most Discussed
class theMostDiscussed_Model extends JDatabaseMySQL{
	var $qry;
	var $comments_last7;				// Single user's youtube subscribers
	var $facebook_likes_last7; 			// Facebook comments
	var $last_days_for_facebook = 3;	// Consider  likes of last how many days
	var $last_days_for_youtube = 3;		// Consider comments of last how many days
	var $rank_is = 0;	
	var $_result;
	
	function __construct(){}
	
	function setRank ($youtube_user_id){
		$this->userId = $youtube_user_id;
		$this->qry = "SELECT sum(comments_last7) as comments_last7,sum(facebook_likes_last7) as facebook_likes_last7 FROM dailystatistics WHERE userName = '$this->userId' ORDER BY lastDate DESC LIMIT 0,7";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = (object)$this->getArray();
		$this->comments_last7 = $this->_result->comments_last7;
		$this->facebook_likes_last7 = $this->_result->facebook_likes_last7;
	}
	function getRank($youtube_user_id){
		self::setRank ($youtube_user_id);
		$this->qry = "SELECT * FROM mgl_ranking_module_attribute WHERE rank_module_id = '4' AND rank_attr_status = '1' ORDER BY rank_attr_id ASC";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = $this->loadAssoc();
		$ARRAY_TO_ATTRIBUTES = array();
		for($i=0;$i<count($this->_result);$i++){
		$ARRAY_TO_ATTRIBUTES[$i] =  $this->_result[$i]['rank_attr_name'];
		}
		if(in_array("Youtube_num_comments",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is =  $this->comments_last7;}else{ $this->rank_is += 0; }
		if(in_array("Facebook_num_comments",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is += $this->facebook_likes_last7; }else{ $this->rank_is += 0; }
		return $this->rank_is;
	}
}  	

	// 5. Recently Released
class theRecentlyReleased_Model extends JDatabaseMySQL{
	var $qry;
	var $video_posted_in_last_week = 1;	// Consider all posted video in last how many weeks
	var $_result;
	var $is_recent;
	var $rank_is = 0;	
	var $subscribers;				// Single user's youtube subscribers
	var $avg_subscribers_universe; 	// Average of all youtube user's subscribers 
	var $views;						// Single user's video's views
	var $avg_views_universe;		// All youtube users's videos's view
	var $view_weighted_average_rating;
	var $avg_vwar_universe;
	var $avg_videos;				// All youtube videos in entire database
	var $video_weighted_rating;		// weighted rating for a particular video of a user
	var $favourites;				// Number of favoutites of a particular user
	var $avg_favourites_universe;	// Average of total favourites 
	var $facebook_likes;    		// Single user's facbook like  
	var $avg_facebook_likes_universe;	// Average of all users	    
	
	function __construct(){}

	function setRank ($youtube_user_id){
		$this->userId = $youtube_user_id;
		$this->qry = "SELECT * FROM dailystatistics, youtubeuser WHERE userName = '$this->userId' ORDER BY dailystatistics.lastDate DESC LIMIT 1";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = (object)$this->getArray();
		$this->subscribers = $this->_result->subscribers;
		$this->avg_subscribers_universe = $this->_result->avg_subscribers_universe;
		$this->views = $this->_result->views;
		$this->avg_views_universe = $this->_result->avg_views_universe;
		$this->view_weighted_average_rating = $this->_result->view_weighted_average_rating;
		$this->avg_vwar_universe = $this->_result->avg_vwar_universe;
		$this->favourites = $this->_result->favourites;
		$this->avg_favourites_universe = $this->_result->avg_favourites_universe;
		$this->facebook_likes = $this->_result->facebook_likes;
		$this->avg_facebook_likes_universe = $this->_result->avg_facebook_likes_universe;
	}
	function getRank($youtube_user_id){
	    if(self::isVideoUploaded($youtube_user_id) >=1){
		self::setRank ($youtube_user_id);
		$this->qry = "SELECT * FROM mgl_ranking_module_attribute WHERE rank_module_id = '1' AND rank_attr_status = '1' ORDER BY rank_attr_id ASC";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = $this->loadAssoc();
		$ARRAY_TO_ATTRIBUTES = array();
		for($i=0;$i<count($this->_result);$i++){
		$ARRAY_TO_ATTRIBUTES[$i] =  $this->_result[$i]['rank_attr_name'];
		}
		if(in_array("Subscribers",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is =  ($this->subscribers / $this->avg_subscribers_universe);}else{ $this->rank_is += 0; }
		if(in_array("Views",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is += ( $this->views / $this->avg_views_universe); }else{ $this->rank_is += 0; }
		if(in_array("Weighted_rating",$ARRAY_TO_ATTRIBUTES)){$this->rank_is += ( $this->view_weighted_average_rating / $this->avg_vwar_universe);}else{ $this->rank_is += 0; }
		if(in_array("Favourites",$ARRAY_TO_ATTRIBUTES)){$this->rank_is +=  ( $this->favourites / $this->avg_favourites_universe); }else{ $this->rank_is += 0; }
		if(in_array("Facebook",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is +=( $this->facebook_likes / $this->avg_facebook_likes_universe);}else{ $this->rank_is += 0; } ;
		return $this->rank_is;
		}else{
		 return 0;
		}
	}
	
	function isVideoUploaded($youtube_user_id){
		$this->userId = $youtube_user_id;
		$this->qry = "SELECT mgl_users.user_name FROM mgl_users, mgl_contest_video WHERE mgl_users.user_id = mgl_contest_video.userId AND mgl_users.user_name = '$this->userId' AND mgl_contest_video.dateUploaded BETWEEN CURDATE()-7 AND CURDATE()   ORDER BY mgl_contest_video.dateUploaded";
		$this->sql = $this->qry;
		$this->query();
		$this->is_recent = $this->getNumRows();
		return $this->is_recent;		
	}
}  

	// 6. Most Tuned In
class mostTunedIn_Model extends JDatabaseMySQL{
	var $qry;
	var $channel_views_difference;	// Single user's youtube subscribers
	var $rank_is = 0;	
	var $_result;
	
	function __construct(){}
	
	function setRank ($youtube_user_id){
		$this->userId = $youtube_user_id;
		$this->qry = "SELECT * FROM `dailystatistics` AS dailyStats WHERE userName = '$this->userId' ORDER BY lastDate DESC LIMIT 1";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = (object)$this->getArray();
		$this->channel_views_difference = $this->_result->channel_views_difference;
	}
	function getRank($youtube_user_id){
		self::setRank ($youtube_user_id);
		$this->qry = "SELECT * FROM mgl_ranking_module_attribute WHERE rank_module_id = '6' AND rank_attr_status = '1' ORDER BY rank_attr_id ASC";
		$this->sql = $this->qry;
		$this->query();
		$this->_result = $this->loadAssoc();
		$ARRAY_TO_ATTRIBUTES = array();
		for($i=0;$i<count($this->_result);$i++){
		$ARRAY_TO_ATTRIBUTES[$i] =  $this->_result[$i]['rank_attr_name'];
		}
		if(in_array("Channel_views_differece ",$ARRAY_TO_ATTRIBUTES)){ $this->rank_is =  $this->channel_views_difference;}else{ $this->rank_is += 0; }
		return $this->rank_is;
	}
} 

$testRank = new theRecentlyReleased_Model();
echo  $testRank->getRank("danieldb13");	  	
?>