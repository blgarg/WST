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
					
					
class model_Forumcat_addNewCategory extends JDatabaseMySQL{  			
          var $categoryTitle;
		  var $categoryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ return ; }	
													
			function inserData($data)
			{
		      $HelperOb = new Helper();
			  $config_var = new config();
			  $this->categoryTitle = @mysql_real_escape_string(stripslashes($data->categorytitle));
			  //$this->categoryText = @mysql_real_escape_string(stripslashes($data->categorytext));
			  //$this->createdDate = date('Y-m-d g:i:s');
/*			 echo "<pre>";
			 print_r($data);
			 die;*/
			$this->qry = "INSERT INTO forum_categories(
					 cat_name,
					  status) VALUES
									('".$this->categoryTitle."',
									'1'
									)"; 
				
				$this->sql = $this->qry;
				if($this->query()){ /*echo "jshrjsm"; die;*/return true; }else{/*echo "jsm";die;*/ return false; }
			}
													
													 function getvarp(){
									                 //$this->_result = mysql_query($this->qry);
											                $_data = $this->get_page_nav();  
													        $this->cur = $_data['result'];
 													        $result_set = $this->loadAssoc();
															return array('result'=>$result_set,'nav'=>$_data['nav']);
									                }
													
													
													function numRow(){	
													                     $this->setQuery($this->qry);
																	     $array_aa = $this->getNumRows();
														                        return $array_aa;
																				
																				}			
				  
				
					
		function checkRecords($data){
			$this->sql = "SELECT * FROM forum_categories where cat_name='".$data->categorytitle."'";	
			$this->query();
			return $this->loadAssoc();
		}
				
				
				
}
