
<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var;  
 class searchArtist extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	var $_result = '';   
	
	 function initialize(){ return;}
	 function getvarp(){return ;}
				
	function searchArtistViaName($arr){
	   
	   $this->sql = "SELECT * FROM mgl_users WHERE ((user_firstname LIKE('%".$arr['artistName']."%') || user_lastname LIKE('%".$arr['artistName']."%') || user_name LIKE('%".$arr['artistName']."%') ) AND mgl_users.type = '1'  AND user_name !='admin'  )";
	   
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
	    
		function format_date($original='', $format="%b %d,%Y") {
             $format = ($format=='date' ? "%m-%d-%Y" : $format); 
             $format = ($format=='datetime' ? "%m-%d-%Y %H:%M:%S" : $format); 
             $format = ($format=='mysql-date' ? "%Y-%m-%d" : $format); 
             $format = ($format=='mysql-datetime' ? "%Y-%m-%d %H:%M:%S" : $format); 
             return (!empty($original) ? strftime($format, strtotime($original)) : "" ); 
           } 
		
}

$searchArtist = new searchArtist();
?>	
 <div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;min-height:410px;">
               <div class="content-lt-hdr" style="width:100%;background:#555555;">
               Search Result
               </div>
               <div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:auto; padding:1% 2% 1% 2%; float:left;">
                 
				 <table width="100%" cellpadding="5" cellspacing="5">
          <?php
		   $topRankedusers = $searchArtist->searchArtistViaName($_REQUEST);
		  if(count($topRankedusers)>0){
		   for($i=0;$i<count($topRankedusers);$i++){
	          $userVal = @unserialize($topRankedusers[$i]['youTubeProfilepic']);
		     if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'];}
			 else{$IMG_PATH = @$topRankedusers[$i]['youTubeProfilepic'];} ?>
                <tr>
                    <td height="50" width="100"><img src="<?php echo $IMG_PATH; ?>" alt="<?php echo $topRankedusers[$i]['user_firstname']."&nbsp;".$topRankedusers[$i]['user_lastname'];?>" title="<?php echo $topRankedusers[$i]['user_firstname']."&nbsp;".$topRankedusers[$i]['user_lastname'];?>" onclick="getPublicProfile('<?php echo $topRankedusers[$i]['user_id'];?>','1');" style="cursor:pointer;" width="80" height="80" /></td><td valign="top"><strong><?php echo $topRankedusers[$i]['user_firstname']."&nbsp;".$topRankedusers[$i]['user_lastname'];?></strong><br>
                    Bio : <?php echo $topRankedusers[$i]['bio']; ?> <br>
                    Born : <?php echo $searchArtist->format_date($topRankedusers[$i]['dateofbirth']); ?>
                    </td>
               </tr>
              <tr><td colspan="2"><hr /></td></tr>
              
               <?php
			  }
			}else{?>
             <tr><td colspan="2" align="center"><strong>No record found.</strong></td></tr>
            <?php } ?>
           </table>
				 
               <div class="clr"></div>
               </div>
               </div>
