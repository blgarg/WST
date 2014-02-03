<?php
class model_page extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = '';        
          function __construct(  ){ }   			   		   
		  
			// parent::__query($this->qry);	
			function initialize(){}	
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
				
				
			function getPage($id)
			{		$this->sql = "SELECT * FROM  mgl_pages WHERE page_id=".$id;
					$this->query();
					$this->_result = $this->getArray(); 
					//print_r($this->_result);  				
					return $this->_result;			
			}	
			
			function getCountryName($id){
			
			   	$this->sql = "SELECT name FROM country WHERE id=".$id;
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result['name'];	
			}	
			
				
			
}
						
						
						
