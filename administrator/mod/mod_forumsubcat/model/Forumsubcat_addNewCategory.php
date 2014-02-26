<?php
class model_Forumsubcat_addNewCategory extends JDatabaseMySQL{  			
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
			  $this->cat_id = @mysql_real_escape_string(stripslashes($data->cat_id));
			  //$this->createdDate = date('Y-m-d g:i:s');
/*			 echo "<pre>";
			 print_r($data);
			 die;*/
			 $this->qry = "INSERT INTO forum_sub_categories(
					 cat_id,
					 sub_cat_name,
					  status) VALUES
									('".$this->cat_id."',
									'".$this->categoryTitle."',
									'1')"; 
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
			$this->sql = "SELECT * FROM forum_sub_categories where sub_cat_name='".$data->categorytitle."' and cat_id='".$data->cat_id."'";	
			$this->query();
			return $this->loadAssoc();
		}
				
				
				
}
