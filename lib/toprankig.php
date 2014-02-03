
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
		      $this->sql = "SELECT * FROM mgl_users as Users,rankings As rank WHERE  Users.user_name = rank.userName AND rank.rankingId = '1' AND rank.rank >= 0  ORDER BY rank.rank ASC LIMIT 10";
			  if($this->query()){
				 return $this->loadAssoc();
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
		
		function format_date($original='', $format="%b %d,%Y") {
             $format = ($format=='date' ? "%m-%d-%Y" : $format); 
             $format = ($format=='datetime' ? "%m-%d-%Y %H:%M:%S" : $format); 
             $format = ($format=='mysql-date' ? "%Y-%m-%d" : $format); 
             $format = ($format=='mysql-datetime' ? "%Y-%m-%d %H:%M:%S" : $format); 
             return (!empty($original) ? strftime($format, strtotime($original)) : "" ); 
           } 
		
}

$topRanked = new topRanked();
?>	
 <div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;min-height:410px;">
               <div class="content-lt-hdr" style="width:100%;background:#555555;">
               Featured Artist
               </div>
               <div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:auto; padding:1% 2% 1% 2%; float:left;">
                 
				 <table width="100%" cellpadding="5" cellspacing="5">
          <?php
		   $topRankedusers = $topRanked->getTopRankedUsers();
		   $rank_no = 0;
		   for($i=0;$i<count($topRankedusers);$i++){ 
               $rank_no++;
	          $userVal = @unserialize($topRankedusers[$i]['youTubeProfilepic']);
		     if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 else{$IMG_PATH = @$topRankedusers[$i]['youTubeProfilepic'];} ?>
                <tr>
                    <td height="50" width="100"><img src="<?php echo $IMG_PATH; ?>" alt="<?php echo $topRankedusers[$i]['user_firstname']."&nbsp;".$topRankedusers[$i]['user_lastname'];?>" title="<?php echo $topRankedusers[$i]['user_firstname']."&nbsp;".$topRankedusers[$i]['user_lastname'];?>" onclick="getPublicProfile('<?php echo $topRankedusers[$i]['user_id'];?>','1');" style="cursor:pointer;" width="80" height="80" /></td><td valign="top"><strong><?php echo $topRankedusers[$i]['user_firstname']."&nbsp;".$topRankedusers[$i]['user_lastname'];?></strong><br>
                    Bio : <?php echo $topRankedusers[$i]['bio']; ?> <br>
                    Born : <?php echo $topRanked->format_date($topRankedusers[$i]['dateofbirth']); ?>
                    </td> </tr>
              <tr><td colspan="2">
                    <div class="top-ranked-txt">
                                    	<div class="top-ranked-bg">
                                        	<div class="top-rank">Rank</div>
                                            <div class="top-rank-no"><?php echo $rank_no;//echo ceil($topRankedusers[$i]['rank']);?></div>
                                           </div>
                                    </div> </td>
                 </tr>
              <tr><td colspan="2"><hr /></td></tr>
              
               <?php
			  } ?>
           </table>
				 
               <div class="clr"></div>
               </div>
               </div>
