<?php				
class model_gallery_addImage extends JDatabaseMySQL{  			
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
		
			
				}	
				
				
				
				function getvarp(){
				 //$this->_result = mysql_query($this->qry);
						$_data = $this->get_page_nav();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
								
				function deleteData($ids){
					$this->unlink($ids);			
					@unlink($image['image']);
					$this->qry = "delete FROM images WHERE id  in(".$ids.") ";
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
					$this->sql = "SELECT * FROM `images` where id = ".$id;
					$this->query();
					$data = $this->loadAssoc();
					echo $image_path = $config_var->UPLOAD_ROOT."images/".$data[0]['image_thumbnail']; ;
					echo $thumbnail_path = $config_var->UPLOAD_ROOT."images/thumbnail/".$data[0]['image_thumbnail']; ;
					@unlink($image_path);
					@unlink($thumbnail_path);
			}


		}
			
				
			

		
}
						
						
						
