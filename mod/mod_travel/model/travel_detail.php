<?php				
class model_travel_detail extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = '';        
          function __construct(  ){ 
		              
			}   			   		   
		  function initialize(){return true;}	
			
				 function getvarp(){
						$_data = $this->get_page_nav_front();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
				function numRow(){	
						$this->setQuery($this->qry);
						$array_aa = $this->getNumRows();
						return $array_aa;
											
				}
				function getDetail($id){
						$this->sql = "SELECT * FROM `travel_guide` WHERE `id` =".$id ;
						$this->query();
						return $this->loadAssoc();
				}
				function getCountryName($id){
						$this->sql = "SELECT * FROM `countries` WHERE `id` ='".$id."'" ;
						$this->query();
						return $this->loadAssoc();
				}
				function getTypeName($id){
						$this->sql = "SELECT * FROM `type` WHERE `id` ='".$id."'" ;
						$this->query();
						return $this->loadAssoc();
				}
				
			
}
						
						
						
