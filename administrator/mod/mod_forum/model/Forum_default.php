<?php



					
class model_Forum_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = ''; 
		   var $originalBanner = '';
		  var $thumbbanner ='';
		  var $mediumbanner = '';   
		         
          function __construct(  ){ 
		              
			}   			   		   
		  
			// parent::__query($this->qry);	
			function initialize(){
			//echo "<pre>"; echo count($_REQUEST); die;
		
			if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
			$_REQUEST['creteria'] = strip_tags($_REQUEST['creteria']);
			$_REQUEST['creteria'] = substr($_REQUEST['creteria'],0,60); 
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''){
						$this->searchCondition .= 'and status='.$_REQUEST['cmbStatus'];
					}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (topic_title  like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				}
						
				
				$this->tb_name = 'topics';
				$this->where = ' where 1 '.$this->searchCondition;
				$this->where .=' order by topic_id desc';
			   	$this->adjacents = '1';
				$this->page = 'index.php?mod=mod_Forum&view=default&d=5&d=1&type=forum';
				$this->pageLimit = '10';
				// $this->_result = mysql_query($this->qry);
                     return $this->get_page_nav();
				}	
				
				
				
				function getvarp(){
				 //$this->_result = mysql_query($this->qry);
						$_data = $this->get_page_nav();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
				
				
				function numRow(){	 $this->setQuery($this->qry);
									 $array_aa = $this->getNumRows();
											return $array_aa;
											
				}			
			
									
				function deleteData($ids){
					$this->qry = "delete FROM topics WHERE topic_id  in(".$ids.") ";
					$this->sql = $this->qry;
					if($this->query()){
						$this->qry = "delete FROM topic_image WHERE topic_id  in(".$ids.") ";
						$this->sql = $this->qry;
						$this->query();
						$this->qry = "delete FROM posts WHERE topic_id  in(".$ids.") ";
						$this->sql = $this->qry;
						$this->query();
						return true;
					}else{
						return false;
					}
					
				}
				function changeStatus($modelIds,$type){
				
				//echo $type; die;
					if($type=="activate") $typeval = '1'; else $typeval='0';
					$this->qry = "update topics set status='".$typeval."' WHERE topic_id in(".$modelIds.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}
				
				
				function deleteUploadedImages($id,$ext){
				$config_var = new config();
		         $this->originalBanner = $config_var->UPLOAD_ROOT.'newsBanner/originalImg/'.$id."_img".".$ext";
		         $this->thumbbanner =$config_var->UPLOAD_ROOT.'newsBanner/thumbs/'.$id."_img".".$ext";
		  	    $this->mediumbanner = $config_var->UPLOAD_ROOT.'newsBanner/resizedImg/'.$id."_img".".$ext";
				
		    if($id !=''){
				//UNLINK PREVIOUS UPOADED IMAGES
			if(file_exists($this->originalBanner)) unlink($this->originalBanner);
			if(file_exists($this->thumbbanner)) unlink($this->thumbbanner);
			if(file_exists($this->mediumbanner)) unlink($this->mediumbanner);
			}
			return true;
		}
			function getCatName($cat_id){
			$this->sql = "SELECT * FROM forum_categories where cat_id='".$cat_id."'";	
			$this->query();
			return $this->loadAssoc();
		}
			function getSubCatName($sub_cat_id){
			$this->sql = "SELECT * FROM forum_sub_categories where sub_cat_id='".$sub_cat_id."'";	
			$this->query();
			return $this->loadAssoc();
		}
		
		function gettopic_image($topic_id){
			$this->sql = "SELECT * FROM topic_image where topic_id='".$topic_id."'";	
			$this->query();
			return $this->loadAssoc();
		}
		
		function gettopic_post($topic_id){
			$this->sql = "SELECT * FROM posts where topic_id='".$topic_id."'";	
			$this->query();
			return $this->loadAssoc();
		}


}
						
						
						
