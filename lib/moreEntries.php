<?php 
include '../settings.php';
require_once('session/session.php');
require_once('mysql/mysql.php');
global $config_var;  
$session = new session();
 $userId = $session->getVar("userAccountID");
class contestDetail extends JDatabaseMySQL
{

  var $contest_id;
  function initialize(){ return;}
  function getvarp(){return ;}
  function getContest($cId)
  {	
    
    $this->qry = "select * from mgl_contest WHERE contestId = '".$cId."'";
	$this->sql = $this->qry;
	if($this->query())
	{return $this->loadAssoc();}
  }
  
  function getContestVideoList($cId)
  {	
    	$this->contest_id = $cId;
  		$per_page = 4;
  		$page = @$_REQUEST['page'];
  		if($page == 0){ $page = '1';}
  		$start = ($page-1)*$per_page;
  		$this->qry = "select mgl_videodetail.*,mgl_contest_video.userId from mgl_contest_video,mgl_videodetail, mgl_video_rating_update WHERE mgl_videodetail.vid = mgl_contest_video.VideoId AND  mgl_contest_video.contestId = '".$cId."' AND mgl_video_rating_update.video_id = mgl_videodetail.vid ORDER BY mgl_video_rating_update.rating  DESC limit $start,$per_page";
		
		
		$this->sql = $this->qry;
		if($this->query())
		{return $this->loadAssoc();}
	}	

function getComments($video_id, $contest_id){
		$this->qry = "select * from  mgl_video_comments_update WHERE video_id='$video_id' AND contest_id ='$contest_id'";
					$this->sql = $this->qry;
					$this->query();
					$result = $this->getArray();
					
					$NumOfComments = (int)$result['total_comments'];
					
					return $NumOfComments;
	}
	
function totalPage()
	{
		$per_page = 4;
		 $this->qry = "select mgl_videodetail.* from mgl_contest_video,mgl_videodetail WHERE mgl_videodetail.vid = mgl_contest_video.VideoId AND  mgl_contest_video.contestId = '".$this->contest_id."'";
		$this->sql = $this->qry;
		if($this->query()){return ceil($this->getNumRows()/$per_page);}
	}
	
	function getLikes($video_id, $contest_id){
					$this->qry = "select sum(unique_hit_count) from  mgl_video_rating WHERE video_id='$video_id' AND contest_id ='$contest_id' AND unique_hit_count = '1'";
					$this->sql = $this->qry;
					$this->query();
					$result = $this->getArray();
					
					$numLikes = $result['sum(unique_hit_count)'];
					
					return (int)$numLikes;
	}
	
	
	function getDisLikes($video_id, $contest_id){
					$this->qry = "select count(*) as dislike from  mgl_video_rating WHERE video_id='$video_id' AND contest_id ='$contest_id' AND unique_hit_count = '-1'";
					$this->sql = $this->qry;
					$this->query();
					$result = $this->getArray();
					
					$numLikes = (int)$result['dislike'];
					
					return $numLikes;
	}
	
	
					

}

 $contest = new contestDetail();
 $contestId = (int)$_REQUEST['contestId'];
 $contestVideoList = $contest->getContestVideoList($contestId);
 $contestDetail = $contest->getContest($contestId);
 $session = new session();
 $userId= $session->getVar("userAccountID");
 $totalPage = $contest->totalPage();
 
 $pageS = @$_REQUEST['page'];
 $next = 1;
 if(isset( $pageS) &&  $pageS >= 1)
 {
 	if($totalPage >$pageS):
	$next = $next+$pageS;
	$prev = $pageS-1;
	$link_back = "onclick=\"prevMoreEntries('".$prev."','".$contestId."')\"";
	$link_next = "onclick=\"nextMoreEntries('".$next."','".$contestId."')\"";
	else:
	$prev = $totalPage-1;
	$link_next = "";
	$link_back = "onclick=\"prevMoreEntries('".$prev."','".$contestId."')\"";
	endif;
	
 }else
 {
 	$next = $next;
	$prev = 1;
	$link_back = "onclick=\"prevMoreEntries('".$prev."','".$contestId."')\"";
	$link_next = "onclick=\"nextMoreEntries('".$next."','".$contestId."')\"";
 }
 
 if($pageS == 1)
 {$link_back  = '';}
?>
<div class="artist_page_outer">
        	<div class="artist_page">
              <div class="contest_bg_outer">
                	<div class="contest_bg_top"><?php echo ucfirst ($contestDetail[0]['contestTitle']);?><span style="float:right;font-size:12px;margin-right:15px;">
                    <a onclick="getContestDetail(<?php echo (int)$_REQUEST['contestId'];?>);" title="Go back " href="javascript:;" style="color:#FFFFFF;">GO BACK</a></span></div>
                    <div class="contest_bg_cen">
                    	<div class="contest_heading">
                         Contest Enteries
                        </div> 
                        <div class="contest_details" style="height:auto;">
                       	
                            <div class="contest_detail_txt" style="height:auto;padding:0px;">
                                
                                     <div class="contest_entries_img_Outer" style="float:left;height:auto;font-weight:normal !important;font-size:12px;width:860px;margin-left:30px;">
                                     <?php $videoList = $contest->getContestVideoList($_REQUEST['contestId']);
										   for($j=0;$j<count($videoList);$j++){ ?>
    <div class="contest_video_outer" style="width:170px;margin-right:35px;margin-bottom:20px;">                                       
    <div class="contest_video"  style="height:83px;border:#CCCCCC 4px solid;width:170px;" onmouseover="ShowAddtoplayListButton('<?php echo $j.'_'.$videoList[$j]['vid'];?>')" onmouseout="HideAddtoplayListButton('<?php echo $j.'_'.$videoList[$j]['vid'];?>')">
        <a href="javascript:;" class="personPopupTrigger"  rel="<?php echo  $videoList[$j]['userId']; ?>,a17bee64-8593-436e-a2f8-599a626370df" onclick="ytVideoApp.presentVideo('<?php echo $videoList[$j]['vid'];?>');">
        <img src="<?php echo  $videoList[$j]['vthumbs']; ?>" border="0" width="170" height="83" />
       </a>
    <div style="position:relative; top:-70px; left:55px;cursor:pointer;" >
   <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/play.png" title="Play" alt="Play" onclick="ytVideoApp.presentVideo('<?php echo $videoList[$j]['vid'];?>');"  />
  </div>
     <span style="margin-left:144px;top:-87px; position:relative; z-index:333;display:none;" id="<?php echo $j.'_'.$videoList[$j]['vid'];?>" onclick="openPlayListDiv('addToPlayList','<?php echo $videoList[$j]['vid'];?>','<?php echo $userId ; ?>');"> <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/add_to_playlist.png" alt="Add" title="Add to playlist"  /> </span>
    </div>
 
    <div class="like_thumbs" style="width:180px;">
    <div class="thumb_left" style="width:25px;float:left;">
    <a href="javascript:;" onclick="openVideoRateDiv('addToPlayList','<?php echo  $videoList[$j]['vid']; ?>',<?php echo $_REQUEST['contestId'];?>,'doLike');">							       <img src="<?php echo $config_var->WEB_TPL_URL;?>/images/contest_video_like.jpg" border="0" width="27" height="18" />
    </a>
    </div>
    
    <div class="thumb_right" style="float:left;color:#333333;min-width:7px;width:auto;margin-right:5px;" id="like_<?php echo  $videoList[$j]['vid']; ?>">&nbsp;<?php echo $contest->getLikes($videoList[$j]['vid'],$_REQUEST['contestId']); ?>
    </div>
    
    <div class="thumb_left" style="width:25px;float:left">
    <a href="javascript:;" onclick="openVideoRateDiv('addToPlayList','<?php echo  $videoList[$j]['vid']; ?>',<?php echo $_REQUEST['contestId'];?>,'doDisLike');"><img src="<?php echo $config_var->WEB_TPL_URL;?>/images/contest_video_dislike.jpg" border="0" width="27" height="18" /></a></div>
    <div class="thumb_right" style="float:left;width:60px;color:#333333" id="dislike_<?php echo  $videoList[$j]['vid']; ?>">&nbsp;<?php echo $contest->getDisLikes($videoList[$j]['vid'],$_REQUEST['contestId']); ?></div>
    
    
    </div>
    
    <div class="like_thumbs" style="width:180px;">
    <div class="thumb_left" style="width:65px;">
<a href="javascript:;" onclick="openVideo_Comment_Div('video_comments','<?php echo  $videoList[$j]['vid']; ?>',<?php echo $_REQUEST['contestId'];?>);" style="text-decoration:none;"><strong>Comments</strong>:&nbsp;</a></div>
    <div class="thumb_right" style="float:left;width:90px;color:#333333;text-align:left;" id="dislike_<?php echo  $videoList[$j]['vid']; ?>">&nbsp;
	<?php echo $contest->getComments($videoList[$j]['vid'],$_REQUEST['contestId']); ?></div>
    
    
    
    </div>
    </div>
 <?php } ?> 
 </div>
                                     
                                     
                                
                        <span style="font-size:15px; color:#f37d21; font-weight:normal;float:right; width:200px; text-align:right;">
                                        <a href="javascript:;"  id="sendPageNext" <?php echo $link_back;?> style="font:13px Arial, Helvetica, sans-serif;">
                                          <?php if($link_back !=''){?>Back<?php } ?></a>
                                        <?php if($link_back !='' || $link_next !=''){?><strong>|</strong><?php } ?>
                                        <a href="javascript:;"  id="sendPageBack" <?php echo $link_next;?> style="font:13px Arial, Helvetica, sans-serif;">
                                       	 <?php if($link_next !=''){?>Next<?php } ?></a>
                                 </span>
                               
                            </div>
                            <!-- //Contest Detail Text-->
                           
                        </div>                     
                    </div>
                    <div class="contest_bg_bot"></div>
                </div>
            </div>
        </div>