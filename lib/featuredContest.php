<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var;  
 class featuredContest extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	var $_result = '';   
	
	 function initialize(){ return;}
	 function getvarp(){return ;}
				
	function getFeaturedPost()
	{	
		          	$per_page = 1;
					$page = $_REQUEST['page'];
					if($page == 0){ $page = '1';}
					$start = ($page-1)*$per_page;
					$this->qry = "select * from mgl_contest WHERE CURDATE() <= endDate order by contestId limit $start,$per_page";
					$this->sql = $this->qry;
					if($this->query())
					{
						return $this->loadAssoc();
					}
	 }			
	
	function totalPage()
	{
		$this->qry = "select * from mgl_contest WHERE CURDATE() <= endDate";
					$this->sql = $this->qry;
					if($this->query())
					{
						return $this->getNumRows();
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
		
}

 $featuredContest = new featuredContest();
  
 //$postBlogData =  $postBlog->show(); 
 // print_r($postBlogData);
$pageS = @$_REQUEST['page'];

$totalPage = $featuredContest->totalPage();

 $next = 1;
 if(isset( $pageS) &&  $pageS >= 1)
 {
 	if($totalPage >$pageS):
	$next = $next+$pageS;
	$prev = $pageS-1;
	$link_back = "onclick=\"prev('".$prev."')\"";
	$link_next = "onclick=\"next('".$next."')\"";
	else:
	$prev = $totalPage-1;
	$link_next = "";
	$link_back = "onclick=\"prev('".$prev."')\"";
	endif;
	
 }else
 {
 	$next = $next;
	$prev = 1;
	$link_back = "onclick=\"prev('".$prev."')\"";
	$link_next = "onclick=\"next('".$next."')\"";
 }
 
 if($pageS == 1)
 {$link_back  = '';}
?>	

<?php
	$featuedContestData = $featuredContest->getFeaturedPost();
	for($i=0;$i<count($featuedContestData);$i++){ 
	$videoList = $featuredContest->getContestVideoList($featuedContestData[$i]['contestId']);
	
?> 
		
 <div class="featured-contests" style="margin-top:10px;">
                            	
                                <!--sONG cONTEST-->
                                <div class=" song-contest">
                                	<div class="song-contest-lt">
                                    <a href="javascript:;"  id="sendPageNext" <?php echo $link_back;?>>
                                          <?php if($link_back !=''){?>
                                          	<img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/arr-orange-lt.png" alt=""  style="margin-right:5px;" />
                                            <?php } ?>
                                          </a>
                                          <?php echo ucfirst($featuredContest->getLimitData($featuedContestData[$i]['contestTitle'],10));?>
                                          <a href="javascript:;"  id="sendPageBack" <?php echo $link_next;?>>
                                       	 <?php if($link_next !=''){?>
                                         <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/arr-orange-rt.png" alt="" style="margin-left:5px;"  />
                                         <?php } ?>
                                        </a>
                                    </div>
                                    	<div class="song-contest-rt">
                                        	<!--Prize-->
                                            <div class="song-contest-prize">
                                            	PRIZE
                                            </div>
                                            <!-- //Prize-->
                                            
                                            	<!--cASH-->
                                                <div class="song-contest-cash">
                                                	$<?php echo (int)$featuedContestData[$i]['price'];?> Cash
                                                </div>
                                                <!-- //cASH-->
                                        </div>
                                
                                </div>
                                 <!-- //sONG cONTEST-->
                                 
                                	<!--Song Contest Text-->
                                    <div class="song-contest-txt">
                                      <?php echo $featuredContest->getLimitData($featuedContestData[$i]['contestDesc'],302);?> 
                                   
                                    </div>
                                     <!-- //Song Contest Text-->
                            </div>
                     
 <!--Contest Entries-->
 <div class="contest-entries" id="contests" >
                            	 <!--Contest Entries heading-->
                                 <div class="contest-entries-hdr">
                                 	Top Contest Entries
                                    
                                    <a href="#" class="fr" style="font-size:12px; " onclick="getContestDetail('<?php echo $featuedContestData[$i]['contestId']; ?>')">View More</a>
                                 </div>
                                 <!-- //Contest Entries heading-->
                                 
                                 <!--Contest Entries Videos-->
                                 <div class="contest-entries-video" >
                                 	<?php for($j=0;$j<count($videoList);$j++){ ?>                             
                                    
                                    <!--Video-->
                                    <div class="c-entries-video-size" style="border:#CCCCCC 4px solid;width:160px;"  onmouseover="ShowAddtoplayListButton('<?php echo $j.'_'.$videoList[$j]['vid'];?>')" onmouseout="HideAddtoplayListButton('<?php echo $j.'_'.$videoList[$j]['vid'];?>')">
                                    	
                                         <a href="javascript:;" class="personPopupTrigger" rel="<?php echo  $videoList[$j]['userId']; ?>,a17bee64-8593-436e-a2f8-599a626370df" onclick="ytVideoApp.presentVideo('<?php echo $videoList[$j]['vid'];?>');"><img src="<?php echo  $videoList[$j]['vthumbs']; ?>" border="0" width="160" height="83" /></a>
                                         </a>
                                          <div style="position:relative; top:-70px; left:55px; z-index:333; cursor:pointer;">
                                         <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/play.png" title="Play" alt="Play" onclick="ytVideoApp.presentVideo('<?php echo $videoList[$j]['vid'];?>');" />
                                         </div>
                                         <span style="left:134px;top:-69px; position:relative; z-index:333;display:none;" id="<?php echo $j.'_'.$videoList[$j]['vid'];?>" onclick="openPlayListDiv('addToPlayList','<?php echo $videoList[$j]['vid'];?>','<?php echo $userId ; ?>');"> <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/add_to_playlist.png" alt="Add" title="Add to playlist"  /> </span>
                                    </div>
                                    <!-- //Video-->
                                   <?php }?> 
                                    
                                 </div>
                                 <!-- //Contest Entries Videos-->
                                  
                                  
                            </div>

<?php } ?>
