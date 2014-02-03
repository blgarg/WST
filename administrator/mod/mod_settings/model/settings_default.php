<?php
/*                  $this->tb_name = 'mgl_seo_pages_content';
					$this->where = '';
					$this->adjacents = '3';
					$this->page = 'index.php?mod=mod_dashboard';
					$this->pageLimit = '5'; 
					*/
					
/*                 FOR PAGINATION INITIALIZATION THE ABOVE VARIABLES
				   1. Call $data = $this->get_page_nav();
				   2. abovce functions returns array of three values 
				   		a. query result = $data[result]
						b. total number of records = $data[records] 
						c. Navigation  =  $data[nav] 
					*/
					
/*                 Load records from database 
				   $Data = $this->get_page_nav();  
				   $this->cur = $Data['result'];
 				   $result_set = $this->loadAssoc();	
				    */


					
class model_settings_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ 
		              
							  }   			   		   
		  // parent::__query($this->qry);	
            function initialize(){
		    	return true;
			}	
													
			/*function inserData($data,$tableName)
			{	
			  $data = self::object_2_array($data);
			  $keys=array_keys($data);
			  $keys=implode('`,`',$keys);
			  $keys = '`'.$keys.'`';
			  $values=implode('","',$data);
			  $values='"'.$values.'"';
			  $this->qry ='INSERT INTO '.trim($tableName).'('.$keys.') VALUES ('.$values.')';
			  $this->sql = $this->qry;
			  if($this->query()){return true;}else{return false;}
			}*/
			
			
			function updateRecord($data,$files='',$tableName,$where)
			{	
			 $data = self::object_2_array($data);
			  $update='';
			  foreach($data as $keys=>$values){
			   $update.= '`'.$keys.'`="'.addslashes($values).'",';
			  }
			  $update = rtrim($update,',');
			    
			  $this->qry = 'UPDATE '.$tableName.' SET '.$update.' '.$where.' ';
		 
			  $this->sql = $this->qry;
			  if($this->query()){
			    if(isset($files['logo_image']) && trim($files['logo_image']['name'])!=''){
			       self::uploadLogo($files['logo_image']);
			    }
			   return true;
			  }else{return false;}
			}
			
			
			function object_2_array($result) 
           { 
				$array = array(); 
				foreach ($result as $key=>$value) 
				{ 
					if (is_object($value)) 
					{ 
						$array[$key]=object_2_array($value); 
					} 
					if (is_array($value)) 
					{ 
						$array[$key]=object_2_array($value); 
					} 
					else 
					{ 
						$array[$key]=$value; 
					} 
				} 
				return $array; 
        }  
			
			 function getvarp(){
						 $_data = $this->get_page_nav();  
													        $this->cur = $_data['result'];
 													        $result_set = $this->loadAssoc();
															return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
				
			function getPageData()
			{	$this->sql = "SELECT * FROM mgl_settings WHERE 1";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}
			
			
			
			 function uploadLogo($imgarr)
			{ 
				 $helper = new Helper();
				 $config_var = new config();
				 $time = time();
				 $tempPath = $imgarr['tmp_name'];
				 $FileName = $imgarr['name'];
		         foreach (glob($config_var->UPLOAD_ROOT."logo". '/*') as $filename) {
                  unlink($filename);
                 }
				 $this->originalLogo = $config_var->UPLOAD_ROOT.'logo/'.$FileName;
		         $this->thumbLogo = $config_var->UPLOAD_ROOT.'logo/thumb_'.$FileName;
		  	     move_uploaded_file($tempPath,$this->originalLogo);
				 $helper->resizeImage($this->originalLogo, 150, 100, $this->thumbLogo, $imgarr);
				 
				
			}	
													
												
}
