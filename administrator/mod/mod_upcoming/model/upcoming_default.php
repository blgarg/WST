<?php



					
class model_upcoming_default extends JDatabaseMySQL{  			
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
				return true;
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
				function getRecord(){
				$this->sql = "select * from upcoming_image where id='1'"; 
				$this->query();
				$result_set = $this->loadAssoc();
				return $result_set; 
				}
				function getCountry($id){
				$this->sql = "select * from countries where id=".$id;  
				$this->query();
				$result_set = $this->loadAssoc();
				return $result_set; 
				}
				
}
						
						
						
