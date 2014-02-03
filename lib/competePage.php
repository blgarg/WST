<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var;  
 class featuredContest extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	var $_result = ''; 
	var $per_page = 2;  
	
	 function initialize(){ return;}
	 function getvarp(){return ;}
				
	function getFeaturedPost()
	{	
		          	$page = @$_REQUEST['page'];
					if($page == 0){ $page = '1';}
					$start = ($page-1)*$this->per_page;
					$where = '';
					if(isset($_REQUEST['SORT_BY_WHAT'])){
						if($_REQUEST['SORT_BY_WHAT'] == trim('latest_post')){
						$this->qry = "select * from mgl_contest  WHERE CURDATE() <= endDate order by createdDate DESC limit $start,$this->per_page";    
						}
						else if($_REQUEST['SORT_BY_WHAT'] == trim('featured_post')){
						$this->qry = "select * from mgl_contest WHERE CURDATE() <= endDate limit $start,$this->per_page";    
						}
						else{
						$this->qry = "select * from mgl_contest WHERE CURDATE() <= endDate order by contestId limit $start,$this->per_page";
						}
					}else{
					$this->qry = "select * from mgl_contest WHERE CURDATE() <= endDate order by contestId limit $start,$this->per_page";
					}
					
									
					$this->sql = $this->qry;
					if($this->query())
					{
						return $this->loadAssoc();
					}
	 }	
	 
	 
	 
	 function featuredPost()
	{	           
		          	$this->qry = "select * from mgl_contest WHERE CURDATE() <= endDate order by contestId limit 5";
					$this->sql = $this->qry;
					if($this->query())
					{
						return $this->loadAssoc();
					}
	 }			
			
	
	
	function totalPage()
	{
		$per_page = 2;
		$this->qry = "select * from mgl_contest WHERE  CURDATE() <= endDate";
					$this->sql = $this->qry;
					if($this->query())
					{
						return ceil($this->getNumRows()/$per_page);
					}
	}
	function getLimitData($data,$limit)
		{
			$DataLen = strlen($data);
			if($DataLen >$limit)
			{
				return substr($data,0,$limit+1).".....";
			}else{
				return $data;
			}
		}		
	 
	 
 function getContestVideoList($cId)
  {	
  
   $this->qry = "select DISTINCT mgl_videodetail.*,mgl_contest_video.userId from mgl_contest_video,mgl_videodetail, mgl_video_rating_update WHERE mgl_videodetail.vid = mgl_contest_video.VideoId AND  mgl_contest_video.contestId = '".$cId."' AND mgl_videodetail.uId = mgl_contest_video.userId AND mgl_video_rating_update.video_id = mgl_videodetail.vid ORDER BY mgl_video_rating_update.rating  DESC limit 4";
	$this->sql = $this->qry;
		if($this->query())
		{return $this->loadAssoc();}
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
	
	
	
	function getComments($video_id, $contest_id){
		$this->qry = "select * from  mgl_video_comments_update WHERE video_id='$video_id' AND contest_id ='$contest_id'";
					$this->sql = $this->qry;
					$this->query();
					$result = $this->getArray();
					
					$NumOfComments = (int)$result['total_comments'];
					
					return $NumOfComments;
	}
	
		
}
if(isset($_REQUEST['SORT_BY_WHAT'])){
$sortBy = trim($_REQUEST['SORT_BY_WHAT']);
}else{
$sortBy = '';
}
 $featuredContest = new featuredContest();
 
 //$postBlogData =  $postBlog->show(); 
 // print_r($postBlogData);
$pageS = @$_REQUEST['page'];
$featuedContestData = $featuredContest->getFeaturedPost();
$ContestData = $featuredContest->featuredPost();
$totalPage = $featuredContest->totalPage();

 $next = 1;
 if(isset( $pageS) &&  $pageS >= 1)
 {
 	if($totalPage >$pageS):
	$next = $next+$pageS;
	$prev = $pageS-1;
	$link_back = "onclick=\"prevCompete('".$prev."','".$sortBy."')\"";
	$link_next = "onclick=\"nextCompete('".$next."','".$sortBy."')\"";
	else:
	$prev = $totalPage-1;
	$link_next = "";
	$link_back = "onclick=\"prevCompete('".$prev."','".$sortBy."')\"";
	endif;
	
 }else
 {
 	$next = $next;
	$prev = 1;
	$link_back = "onclick=\"prevCompete('".$prev."','".$sortBy."')\"";
	$link_next = "onclick=\"nextCompete('".$next."','".$sortBy."')\"";
 }
 
 if($pageS == 1)
 {$link_back  = '';}
?>	

<div class="artist_page_outer">
        	<div class="artist_page">
            <div class="contest_bg_outer">
                	<div class="contest_bg_top">
                        <div class="contest_bg_top_heading">All Contest</div>
                        <div class="featured_contest_links">
                        	<ul>
                                <li class="nav"><a href="javascript:;">View: Featured Contests</a>
                                    <ul>
                                       <li><a href="javascript:;" onclick="getCompetePage(1,'latest_post')">Latest Contest</a></li>
                                       <li><a href="javascript:;" onclick="getCompetePage(1,'featured_post')">Featured Contest</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="contest_bg_cen">
                    	<div class="contest_heading">
                         Contest
                                         <span style="float:right;">
                                         <a href="javascript:;"  id="sendPageNext" <?php echo $link_back;?> style="font:13px Arial, Helvetica, sans-serif;">
                                          <?php if($link_back !=''){?>Back<?php } ?></a>
                                        <?php if($link_back !='' or $link_next !=''){?><strong>|</strong><?php } ?>
                                        <a href="javascript:;"  id="sendPageBack" <?php echo $link_next;?> style="font:13px Arial, Helvetica, sans-serif;">
                                       	 <?php if($link_next !=''){?>Next<?php } ?></a>
                                        </span>
                        </div> 
                         
<?php
	for($i=0;$i<count($featuedContestData);$i++){ 
	$imgPath = $config_var->UPLOAD_ROOT.'contestBanner/thumbs/'.$featuedContestData[$i]['contestId']."_img.".$featuedContestData[$i]['imgExt'];
	if(file_exists($imgPath)){
	$imgPath = $config_var->UPLOAD_URL.'contestBanner/thumbs/'.$featuedContestData[$i]['contestId']."_img.".$featuedContestData[$i]['imgExt'];
	}
	else{
	$imgPath = $config_var->UPLOAD_URL.'contestBanner/thumbs/'."no-image.gif";
	}
	
?>  
<?php  
						$m1 = 	 date("m");
						$m2 = 	 date("m",strtotime($featuedContestData["$i"]['endDate']));
						$day1 =  date("d");
						$day2 =  date("d",strtotime($featuedContestData["$i"]['endDate']));
						$y1 =    date("Y");
						$y2 =    date("Y",strtotime($featuedContestData["$i"]['endDate']));
						
					    $h1 =    date("g");
						$h2 =    date("g",strtotime($featuedContestData["$i"]['endDate']));
												
					
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
						
						if($hrs <= 0){
							$day = "Expired";
							$hrs_s = '';
						}
						if($days >= 0){
							$day = $days."&nbsp;Days";
					    	$hrs_s = $hours.' hours';
						}
						
?>
                                               
<div class="contest_details">
<div class="contest_details_left">
<div class="contest_banner"><img src="<?php echo $imgPath;?>" border="0" width="190" height="96" /></div>
<div class="contest_name"><?php  echo ucfirst($featuredContest->getLimitData($featuedContestData[$i]['contestTitle'],150)); //echo $featuredContest->video_avg($featuedContestData[$i]['contestId']);?></div>
<div class="contest_text"> <?php echo ucfirst($featuredContest->getLimitData($featuedContestData[$i]['contestDesc'],302));?>
<a href="javascript:;" onclick="getContestDetail('<?php echo $featuedContestData[$i]['contestId']; ?>')"> read more</a></div>
<div class="contest_prize" style="width:100%">Prize:$<?php echo (int)$featuedContestData[$i]['price'];?></div>
<div class="contest_entry_videos">

<?php $videoList = $featuredContest->getContestVideoList($featuedContestData[$i]['contestId']);
for($j=0;$j<count($videoList);$j++){ ?>
<div class="contest_video_outer" style="width:170px;margin-right:30px;">
<div class="contest_video"  style="height:83px;border:#CCCCCC 4px solid;width:170px;"  onmouseover="ShowAddtoplayListButton('<?php echo $videoList[$j]['vid'];?>')" onmouseout="HideAddtoplayListButton('<?php echo $videoList[$j]['vid'];?>')">
<a href="javascript:;" onclick="ytVideoApp.presentVideo('<?php echo $videoList[$j]['vid'];?>');" class="personPopupTrigger" rel="<?php echo  $videoList[$j]['userId']; ?>,a17bee64-8593-436e-a2f8-599a626370df"><img src="<?php echo  $videoList[$j]['vthumbs']; ?>" border="0" width="170" height="83" /></a>
<div style="position:relative; top:-70px; left:55px; z-index:999; cursor:pointer;">
  <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/play.png" title="Play" alt="Play" onclick="ytVideoApp.presentVideo('<?php echo $videoList[$j]['vid'];?>');" />
 </div>
  <span style="margin-left:144px; bottom:70px;position:relative; z-index:333;display:none;" id="<?php echo $videoList[$j]['vid'];?>" onclick="openPlayListDiv('addToPlayList','<?php echo $videoList[$j]['vid'];?>','<?php echo $userId ; ?>');"> <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/add_to_playlist.png" alt="Add" title="Add to playlist"  />  </span>
</div>
<div class="like_thumbs" style="width:180px;">

<div class="thumb_left" style="width:30px;">
<a href="javascript:;" onclick="openVideoRateDiv('addToPlayList','<?php echo  $videoList[$j]['vid']; ?>',<?php echo $featuedContestData[$i]['contestId'];?>,'doLike');"><img src="<?php echo $config_var->WEB_TPL_URL;?>/images/contest_video_like.jpg" border="0" width="27" height="18" /></a></div>

<div class="thumb_right" style="float:left;color:#333333;min-width:7px;width:auto;margin-right:5px;" id="like_<?php echo  $videoList[$j]['vid']; ?>">&nbsp;<?php echo $featuredContest->getLikes($videoList[$j]['vid'],$featuedContestData[$i]['contestId']); ?></div>

<div class="thumb_left" style="width:30px;">
<a href="javascript:;" onclick="openVideoRateDiv('addToPlayList','<?php echo  $videoList[$j]['vid']; ?>',<?php echo $featuedContestData[$i]['contestId'];?>,'doDisLike');"><img src="<?php echo $config_var->WEB_TPL_URL;?>/images/contest_video_dislike.jpg" border="0" width="27" height="18" /></a></div>
<div class="thumb_right" style="float:left;width:58px;color:#333333" id="dislike_<?php echo  $videoList[$j]['vid']; ?>">&nbsp;<?php echo $featuredContest->getDisLikes($videoList[$j]['vid'],$featuedContestData[$i]['contestId']); ?></div>
</div>

<div class="like_thumbs" style="width:180px;">
<div class="thumb_left" style="width:65px;">
<a href="javascript:;" onclick="openVideo_Comment_Div('video_comments','<?php echo  $videoList[$j]['vid']; ?>',<?php echo $featuedContestData[$i]['contestId'];?>);" style="text-decoration:none;"><strong>Comments</strong>:&nbsp;</a></div>
<div class="thumb_right" style="float:left;width:90px;color:#333333;text-align:left;" id="dislike_<?php echo  $videoList[$j]['vid']; ?>">&nbsp;<?php echo 
$featuredContest->getComments($videoList[$j]['vid'],$featuedContestData[$i]['contestId']); ?></div></div>

</div>
<?php }?>
</div>
</div>
<div class="contest_details_right">
<div class="time_left_txt">Time Left</div>
<div class="time_left_bg">
<div class="time_left_txt_inner_days"><?php echo @$day;?></div>
<div class="time_left_txt_inner_hours"><?php echo @$hrs_s;?> </div>
</div>
<div class="contest_btns">
<a href="javascript:;" onclick="getContestDetail('<?php echo $featuedContestData[$i]['contestId']; ?>')"><img src="<?php echo $config_var->WEB_TPL_URL;?>/images/contest_readmore_btn.jpg" width="95" height="27" border="0" title="learn more" /></a>
</div>
<div class="contest_btns">
<script>function fbs_click(){ try{u=location.href;t='<?php echo ucfirst ($featuedContestData[$i]['contestTitle']);?>'; window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false; }catch(e){}}</script><style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url(<?php echo $config_var->WEB_TPL_URL;?>/images/contest_facebook_share.jpg?6:26981) no-repeat top right;width:70px;height:30px; }  </style> <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;"></a>
</div>
</div>
</div>

<?php } ?>
                        
                        
       <div class="pagination" style="float:right;width:100px;color:#FF9933;font-size:20px;"><a href="javascript:;"  id="sendPageNext" <?php echo $link_back;?> style="font:13px Arial, Helvetica, sans-serif;">
                                          <?php if($link_back !=''){?>Back<?php } ?></a>
                                        <strong>|</strong>
                                        <a href="javascript:;"  id="sendPageBack" <?php echo $link_next;?> style="font:13px Arial, Helvetica, sans-serif;">
                                       	 <?php if($link_next !=''){?>Next<?php } ?></a></div>
</div>
                    <div class="contest_bg_bot"></div>
                </div>
            </div>
        </div>
