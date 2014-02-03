<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var;  
 include($config_var->WEB_ROOT.'lib/session/session.php');
 include($config_var->WEB_ROOT.'lib/Helper.php');
 $page_id = isset($_REQUEST['pageId'])?$_REQUEST['pageId']:'1';
 $page_id  = (int)$page_id;
 ?>
<?php  
class model_page extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	var $_result = '';   
	
	 function initialize(){ return;}
	 function getvarp(){return ;}
				
	 function getPage($id)
			{		
				$this->sql = "SELECT * FROM mgl_pages WHERE page_id=".$id;
			  	if($this->query())
				{
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

$model_page = new model_page();
$page = $model_page->getPage($page_id);
if(count($page) >=1):
?>             <div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;min-height:410px;">
               <div class="content-lt-hdr" style="width:100%;background:#555555">
                    	<?php echo $page[0]['page_title'];?>
               </div>
               <div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:auto; padding:1% 2% 1% 2%; float:left;">
               <?php echo $page[0]['page_content'];?>
               <div class="clr"></div>
               </div>
               </div>
<?php else:?>
			   <div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;">
               <div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:auto; padding:1% 2% 1% 2%; float:left;">
               <h1 align="center">PAGE NOT FOUND</h1>
               <div class="clr"></div>
               </div>
               </div>
<?php endif;?>                
 