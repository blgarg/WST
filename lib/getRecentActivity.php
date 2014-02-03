<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var;  
 class recentActivity extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	var $_result = '';   
	
	 function initialize(){ return;}
	 function getvarp(){return ;}
				
	function recentActivities()
	{	
		      $this->sql = "SELECT * FROM mgl_recent_activities order by id DESC limit 12";
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
	    
		
}

$recentActivity = new recentActivity();
?>	
<?php
$recentActivityData = $recentActivity->recentActivities();
for($i=0;$i<count($recentActivityData);$i++){ 
							?>
                            	<!--Recent Activity Text-->
                            	<div class="recent-activity-txt">
                                 <?php echo $recentActivityData[$i]['name'];?>
                                </div>
                                <!-- //Recent Activity Text-->
                             <?php } ?>  

