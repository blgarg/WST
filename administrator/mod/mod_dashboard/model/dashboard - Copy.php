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


					
class modelDashboard extends JDatabaseMySQL{  			
          var $qry = 'SELECT * FROM mgl_seo_pages_content';  
		  var $_result = '';                     
          function __construct( $options ){ 
		              
							  }   			   		   
		  
		 
	 						   
								   
                                   // parent::__query($this->qry);	
            								    function getvar(){
									                              $this->tb_name = 'mgl_seo_pages_content';
																	$this->where = '';
																	  $this->adjacents = '3';
																		$this->page = 'index.php?mod=mod_dashboard';
																		  $this->pageLimit = '5';
											   //$this->_result = mysql_query($this->qry);
											          return $this->get_page_nav();
									                }	
													
													
													
													 function getvarp(){
									                 //$this->_result = mysql_query($this->qry);
											                $Data = $this->get_page_nav();  
													        $this->cur = $Data['result'];
 													        $array_ass = $this->loadAssoc();
															return $array_ass;
									                }
													
													
													function numRow(){	
													                     $this->setQuery($this->qry);
																	     $array_aa = $this->getNumRows();
														                        return $array_aa;
																				
																				}			
				  
				
					
						}
global $dbVar;
$tests  =  new modelDashboard($dbVar);
print_r($tests->getvar());	

echo "<br / >";echo "<br / >";
$text = $tests->getvarp();	

foreach($text as $test){

print_r($test['page_content_id']); echo "<br />";
}

echo "<br / >";echo "<hr />";echo "<br / >";

print($tests->numRow());				