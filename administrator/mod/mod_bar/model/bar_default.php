<?php



					
class model_bar_default extends JDatabaseMySQL{  			
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
	//echo "<pre>"; print_r($_REQUEST); die;
		
			if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
			$_REQUEST['creteria'] = strip_tags($_REQUEST['creteria']);
			$_REQUEST['creteria'] = substr($_REQUEST['creteria'],0,60); 
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''){
						$this->searchCondition .= "and status='".$_REQUEST['cmbStatus']."'";
						}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
					$this->searchCondition .= ' and (bar_name like "%'.trim($_REQUEST['creteria']).'%"  )'; 
					}
					
				}
						
				
				$this->tb_name = 'bar_data';
				$this->where = ' where 1 '.$this->searchCondition;
				$this->where .=' order by created_on desc';
			   	$this->adjacents = '1';
				$this->page = 'index.php?mod=mod_bar&view=default&m=4';
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
					$this->unlink($ids);			
					@unlink($image['image']);
					$this->qry = "delete FROM `bar_data` WHERE id  in(".$ids.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}
				
				function unlink($id){
				global $config_var;
				$ids = explode(",",$id);
				//print_r($ids); die;
				foreach ($ids as $id){
					$this->sql = "SELECT * FROM `bar_data` where id = ".$id;
					$this->query();
					$data = $this->loadAssoc();
					print_r($data);
					$image_path = $config_var->UPLOAD_ROOT."bar_images/".$data[0]['thumbnail_name']; ;
					$thumbnail_path = $config_var->UPLOAD_ROOT."bar_images/thumbnails/".$data[0]['thumbnail_name'];
					@unlink($image_path);
					@unlink($thumbnail_path);
			}

		}
				function changeStatus($modelIds,$type){
				
				//echo $type; die;
					if($type=="activate") $typeval = '1'; else $typeval='0';
					$this->qry = "update bar_data set status='".$typeval."' WHERE id in(".$modelIds.") ";
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

		function get_category_name($id){
		    $this->sql = "SELECT category_name FROM categories where id=$id";
			$this->query();
			return $this->loadAssoc();
		}
		function get_country_name($id){
			$this->sql = "SELECT country_name FROM countries where id=$id";
			$this->query();
			return $this->loadAssoc();
		}
		function get_type_name($typeid){
			$this->sql = "SELECT type_name FROM type where id=$typeid";
			$this->query();
			return $this->loadAssoc();
		}

}
						
						
						
