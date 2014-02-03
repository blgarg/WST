<?php
 
class model_index_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){return true;}	
		  function getvarp(){return true;}
	      
		  function getrecentActivities(){
			 
			  $this->sql = "SELECT * FROM mgl_recent_activities ";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}	
		
		function getBannerList(){
		  
		   $this->sql = "SELECT * FROM mgl_news_banner WHERE Actions=1";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getFeaturedPost()
		{
			$this->sql = "SELECT post.* ,featuredPost.post_id FROM wp_posts as post,wp_featured_posts as featuredPost
							WHERE post.ID =featuredPost.post_id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getPostAuthorName($id)
		{
			$this->sql = "SELECT  users.display_name FROM wp_users as users WHERE users.ID = '$id'";
			  if($this->query()){
				 $DATA = $this->getArray();
				 return "&nbsp;".ucfirst($DATA['display_name'])."&nbsp;";
			   }
		}
		
		function getPostAuthor($id,$field)
		{
			$this->sql = "SELECT  usersMeta.$field FROM wp_usermeta as usersMeta WHERE usersMeta.user_id = '$id'";
			  if($this->query()){
				 $DATA = $this->getArray();
				 return $DATA[$field];
			   }
		}
		
		function _remove_image($text)
		{
			$text = preg_replace("/<img[^>]+\>/i", "", $text); 
			return $text;
		}									 
		
		function getLimitData($data,$limit)
		{
			$DataLen = strlen($data);
			if($DataLen >$limit)
			{
				return substr($data,0,$limit)."...";
			}else{
				return $data;
			}
		}	
		
		function confirmUser($arr){
		 if(isset($arr['ucode']) && isset($arr['vrifycode']))
		 {
			 $this->sql = "SELECT  * FROM mgl_users  WHERE user_email = '".trim(base64_decode($arr['ucode']))."' AND password = '".trim($arr['vrifycode'])."'";
			 $this->query();
			 $this->_result = $this->loadAssoc();
			 if(count($this->_result)>0){
			 $this->sql = "UPDATE mgl_users SET is_active='1' WHERE user_id = ".$this->_result[0]['user_id']."";
			 $this->query();
			 $session = new session();
		     $session->setSessionId('userSessionID');
		     $session->setVar("userAccountID",$this->_result[0]['user_id']);
			 $session->setVar("userType",(int)$this->_result[0]['type']);
		     if($this->_result[0]['type']=='1') return 1;
			 else return 2;
			 }else{return 0;}   
		}else{
		  return 0;
		 }
	}
	
	
	function addVideoToContest($arr){
	   $session = new session();
	   $this->sql = "SELECT * FROM mgl_contest_video WHERE VideoId='".$arr['id']."'";
	   $this->query();	
	   $this->_result = $this->loadAssoc();
	  if(count($this->_result)==0){
	 $this->sql = "INSERT INTO mgl_contest_video(`contestId`,`VideoId`,`userId`,`dateUploaded`)VALUES('".$_SESSION['contestId']."','".$arr['id']."','".$_SESSION['userAccountID']."',now())";
	 $this->query();
	
	 $this->sql = "INSERT INTO mgl_video_rating_update(video_id,contest_id,rating)VALUES('".$arr['id']."','".$_SESSION['contestId']."','0')";
	 $this->query();
	  unset($_SESSION['contestId']);
	   ?>
	  <script language="javascript" type="text/javascript">
	  $(document).ready(function(){
	  uploadingVideosPopUP('uploadingVideosPopUP',1);
	  ytVideoApp.getVideoDeatil('<?php echo $arr['id']; ?>');
	  });
    </script>
	<?php   }
	}
	
	function getPlayList(){
	 $session = new session();
	 $userId= $session->getVar("userAccountID");
	 $this->sql = "SELECT * FROM mgl_users_playlist WHERE playlist_user_id='".$userId."'";
	 $this->query();	
	 $this->_result = $this->loadAssoc();
	 return $this->_result;
	}
					
													
}
