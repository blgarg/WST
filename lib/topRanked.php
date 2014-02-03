<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var;  
 class topRanked extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	var $_result = '';   
	
	 function initialize(){ return;}
	 function getvarp(){return ;}
				
	function getTopRankedUsers()
	{	
		       
			 $resultArray = array();
		    $this->sql = "SELECT userName,MAX(`dateUpdated`) FROM rankings WHERE  rankings.rankingId = '1' AND rankings.rank >= 0 group by `userName` ORDER BY rank  DESC LIMIT 10";
		 	   $this->query();
			   $results = $this->loadAssoc();
			   for($i=0;$i<count($results);$i++){
			   $this->sql = "SELECT Users.* FROM mgl_users as Users WHERE  Users.user_name = '".$results[$i]['userName']."'";
			  //$this->sql = "SELECT * FROM mgl_users as Users,rankings As rank WHERE  Users.user_name = rank.userName AND rank.rankingId = '1' AND rank.rank >= 0  ORDER BY rank.rank ASC LIMIT 10";     
			  $this->query();
			 $res =  $this->loadAssoc();
				 if(count($res)>0){
				   $resultArray[] = $res[0];
				 }
	        }
 return $resultArray;
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
	    
		
		function getLastWeelRank($currentDate,$userName,$rankingId){
	    	$date = $currentDate;
			$newdate = strtotime ( '-7 day' , strtotime ( $date ) ) ;
			$newdate = date ( 'Y-m-j' , $newdate );
			$this->sql = "SELECT rank FROM rank WHERE  dateUpdated = $newdate AND rank.rankingId = '$rankingId' AND userName='$userName'";
			  if($this->query()){
				$rankData = $this->getArray();
				return $rankData['rank'];
			   }
		}
		
}

$topRanked = new topRanked();
?>	
<?php
$rank_no = 0;
$topRankedusers = $topRanked->getTopRankedUsers();
$topUsersCount = count($topRankedusers);
if($topUsersCount == 0){
echo "<h3 style='text-align:center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No User Found</h3>";
}
for($i=0;$i<count($topRankedusers);$i++)
{ 
  $rank_no++;
	         
			 
			 $userVal = @unserialize($topRankedusers[$i]['youTubeProfilepic']);
		     if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 else{$IMG_PATH = @$topRankedusers[$i]['youTubeProfilepic'];}
			 $last_rank = $topRanked->getLastWeelRank($topRankedusers[$i]['dateUpdated'],$topRankedusers[$i]['userName'],$topRankedusers[$i]['rankingId']);
			 
?>
                            	<!--Top Ranked-->
                            <div class="top-ranked">
                            	<!--Image-->
                                <div class="top-ranked-img">
                                	<img src="<?php echo  $IMG_PATH; ?>" alt="<?php echo $topRankedusers[$i]['user_firstname']."&nbsp;".$topRankedusers[$i]['user_lastname'];?>"  width="125" height="82" title="<?php echo $topRankedusers[$i]['user_firstname']."&nbsp;".$topRankedusers[$i]['user_lastname'];?>"  onclick="getPublicProfile('<?php echo $topRankedusers[$i]['user_id'];?>','1');" style="cursor:pointer;"/>
                                </div>
                                <!-- //Image-->
                                	<!--Top Ranked Right Text-->
                                    <div class="top-ranked-txt">
                                    	<div class="top-ranked-bg">
                                        	<div class="top-rank">Rank</div>
                                            <div class="top-rank-no"><?php echo $rank_no;//echo ceil($topRankedusers[$i]['rank']);?></div>
                                            
                                            <span><?php if($last_rank !=''){?>Last Week:<?php echo @$last_rank;?>  <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/arrow-up.png" alt="" /><?php }else{?>Last Week:<?php echo "N/A"; ?><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/arrow-up.png" alt="" /></span><?php }?>
                                        </div>
                                    </div>
                                    <!-- //Top Ranked Right Text-->
                                    
                                    <h3 onclick="getPublicProfile('<?php echo $topRankedusers[$i]['user_id'];?>','1');" style="cursor:pointer;"><?php echo ucfirst($topRankedusers[$i]['user_firstname']."&nbsp;".$topRankedusers[$i]['user_lastname']);?></h3>
                                    <h4>Tunezy Member ID : <?php echo $topRankedusers[$i]['user_id'];?></h4>
                                
                            </div>
                            <!-- //Top Ranked-->
                           
<?php } ?>  				 <?php if($topUsersCount >=11){?>	
							 <div class="top-rank-view-more">
                            	<a href="javascript:;" title="View More">View More</a>
                            </div>
                            <?php } ?>
