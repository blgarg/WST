<?php
include '../settings.php';
 require_once('../inc/load.php');
 class video_comments extends JDatabaseMySQL {
 	var $qry;
	var $_comments_per_page=10;
	var $_set_of_comments;
	var $_comment_text;
	var $_user_id;
	var $video_id;
	var $contest_id;
	var $_save_flag = false;
	var $_DELETE_flag = false;
	
function __construct($video_id,$contest_id,$user_id,$comment_text)
{	
	    $this->video_id = $video_id;
		$this->contest_id = $contest_id;
		$this->_user_id = $user_id;
		$this->_comment_text = $comment_text;
}
 	
function load_Comments(){
		$this->qry = "SELECT * FROM mgl_video_comments WHERE vidoe_id ='".$this->video_id."' AND contest_id = '".$this->contest_id."'  ORDER BY comment_id DESC ";
		$this->sql = $this->qry;
		$this->query();
		return $this->loadAssoc();
}

function load_Single_Comments($comment_id){
		$this->qry = "SELECT * FROM mgl_video_comments WHERE comment_id = '".$comment_id."' ";
	  	$this->sql = $this->qry;
	  	$this->query();
	    return $this->getArray();
}

function deleteCurrentrate(){
	  $this->qry = "DELETE FROM mgl_video_rating WHERE vidoe_id = '".$this->video_id."' AND  contest_id = '".$this->contest_id."' AND user_id = '".$this->_user_id."' ";
	  $this->sql = $this->qry;
	  $this->query();
	  return true;
	}
	
	
	
function saveComments(){
		$this->qry = "INSERT INTO mgl_video_comments(comment_id, comment_text, vidoe_id, contest_id, user_id)
				VALUES(NULL, '".$this->_comment_text."', '".$this->video_id."', '".$this->contest_id."', '".$this->_user_id."' ) ";
		$this->sql = $this->qry;
		if($this->query())
		return mysql_insert_id();	//$this->_save_flag = true;
	
}

function delete_Comments($comment_id){
		$this->qry = "DELETE FROM mgl_video_comments WHERE 	comment_id	 ='".$comment_id."' ";
		$this->sql = $this->qry;
		if($this->query())
		$this->_DELETE_flag = true;
		self::updateVideo_comments();
}

function updateVideo_comments(){
	 			
				$this->sql = "SELECT * FROM mgl_video_comments WHERE vidoe_id ='".$this->video_id."' AND contest_id = '".$this->contest_id."' ";
				$this->query();
	  			$_total_num_of_comments = (int)$this->getNumRows();
				
				$this->sql = "SELECT * FROM mgl_video_comments_update WHERE video_id ='".$this->video_id."' AND contest_id = '".$this->contest_id."' ";
				$this->query();
	  			$_is_total_comments = $this->getNumRows();
				
				if($_is_total_comments <=0){
				$this->qry = "INSERT INTO mgl_video_comments_update(video_id, contest_id, total_comments)
				VALUES('".$this->video_id."', '".$this->contest_id."', '".$_total_num_of_comments."' ) ";
				$this->sql = $this->qry;
					if($this->query())
					return true;
					else
					return false;
				}else{
				$this->qry = "UPDATE mgl_video_comments_update SET total_comments = '".$_total_num_of_comments."' WHERE video_id= '".$this->video_id."'
				AND contest_id = '".$this->contest_id."'";
				$this->sql = $this->qry;
					if($this->query())
					return true;
					else
					return false;
				}
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
	   		$resp = '<p>You has voted successufully.</p>';
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

if(isset($_REQUEST['action']) && $_REQUEST['action']=='load_video_comments'){
	  
	  $Video_id = @$_REQUEST['videoId'];
	  $Contest_id = @$_REQUEST['contestId'];
	  $session = new session();
	  $resp = '';
	  $userId = $session->getVar("userAccountID");
	  $comment_text = '';
	  $video_comments =  new video_comments($Video_id,$Contest_id,$userId,$comment_text);
	  $video_comments =  $video_comments->load_Comments();
	  $resp = '<div id="my_panel">
	  <table width="500" border="0" cellpadding="3"  cellspacing="3">
  		<tr><td valign="top" colspan="2"><h1 style="font-size:20px;">Post your comment</h1></td></tr>
   		<tr>';
	   if(isset($userId) && $userId !=''){	
	  $resp .= '<td valign="bottom"><textarea name="post_comment" id="post_comment_text" ></textarea></td>
			<td valign="bottom"><span id="post_image_load"></span>
			<input type="submit" name="post_comment_btn" id="post_comment_btn" class="btn_class" value="Post Comment" 
			onclick="post_video_comments(\''. $Video_id .'\','.$Contest_id.')"/></td>';
		}else{
		 $resp .= '<td valign="bottom"><textarea name="post_comment" id="post_comment_text"  readonly="readonly" style="color:#FF6633;font-weight:bold;">Sign In or Sign Up now to post a comment!</textarea></td>
			<td valign="bottom"><span id="post_image_load"></span>
			<input type="submit" name="post_comment_btn" id="post_comment_btn" class="btn_class" value="Post Comment" 
			/></td>';
		}	
			
	$resp .='</tr>
</table><div id="all_comments">';	
	  if(count($video_comments)<=0){
	  $resp .= '<p> There are no comments posted yet.</p>'; 
	  }	
	  for($k=0;$k<count($video_comments);$k++){		
	  	$resp .= '<p id="comment_id_'.$video_comments[$k]['comment_id'].'">';
			if($userId == $video_comments[$k]['user_id'])
			$resp .= '<a href="javascript:;" id="delete_comment" class="delete_comment_class" onclick="delete_comment('.$video_comments[$k]['comment_id'].')" title="Delete this message">&nbsp;&nbsp;</a>'; 
			$resp .= $video_comments[$k]['comment_text'].'</p>';	
		}

	  $resp .='</div></div>'; 
	  $isAction = 1;
	  //$todtal_rank = $doRank->updateVideoRank();
      $result = array("isAction"=>$isAction,"resp"=>$resp);
	  $result = json_encode($result);
	  echo $result;
}	

if(isset($_REQUEST['action']) && $_REQUEST['action']=='save_video_comments'){
	  
	  $session = new session();
	  $resp = '';
	  $userId = $session->getVar("userAccountID");
	  $Video_id = @$_REQUEST['videoId'];
	  $Contest_id = @$_REQUEST['contestId'];
	  $comment_text = mysql_real_escape_string($_REQUEST['comment_text']);
	  $video_comments =  new video_comments($Video_id,$Contest_id,$userId,$comment_text);
	  $commnet_id = $video_comments->saveComments();
	  $video_comments->updateVideo_comments();
	  $comment_data = $video_comments->load_Single_Comments($commnet_id);
	  $resp = '<p id=comment_id_'.$comment_data['comment_id'].'>'.$comment_data['comment_text'].'</p>';
	  $isAction = 1;
	  $result = array("isAction"=>$isAction,"resp"=>$resp,"comment_id"=>$commnet_id);
	  $result = json_encode($result);
	  echo $result;
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete_video_comment'){
	  
	  $session = new session();
	  $resp = '';
	  $userId = $session->getVar("userAccountID");
	  $comment_id = @$_REQUEST['comment_id'];
	  $video_comments_ini =  new video_comments('','','','');
	  $comment_data = $video_comments_ini->load_Single_Comments($comment_id);
	  $Video_id = $comment_data['vidoe_id'];
	  $Contest_id = $comment_data['contest_id'];
	  $comment_text = $comment_data['comment_text'];
	  $video_comments =  new video_comments($Video_id,$Contest_id,$userId,$comment_text);
	 
	 //$resp = '<p id=comment_id_'.$comment_data['comment_id'].'>'.$comment_data['comment_text'].'</p>';
	  $video_comments->delete_Comments($comment_id);
	  //echo $video_comments->updateVideo_comments();
	  $isAction = 1;
	  $result = array("isAction"=>$isAction,"resp"=>$resp,"comment_id"=>$comment_id);
	  $result = json_encode($result);
	  echo $result;
}	    
?>
