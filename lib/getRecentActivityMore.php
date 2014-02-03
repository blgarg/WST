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
		      $this->sql = "SELECT * FROM mgl_recent_activities order by id DESC limit 40";
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
?>
<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;min-height:410px;">
               <div class="content-lt-hdr" style="width:100%;background:#555555;">
               Recent Activities  <span style="float:right; margin-right:13px; font-size:14px;cursor:pointer;" onclick="loadHome();">Back</span>
               </div>
               <div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:auto; padding:1% 2% 1% 2%; float:left;"><!--Recent Activity Text-->
  <?php             
for($i=0;$i<count($recentActivityData);$i++){ 
							?>
                            	 
                            	<div class="recent-activity-txt" style="width:500px;">
                                 <?php echo $recentActivityData[$i]['name']."<br>";?>
                                </div>
                     <!-- //Recent Activity Text-->
                             <?php } ?>  
                          
           <div class="clr"></div>
        </div>
   </div>                              
        
                 
			
				 
               
