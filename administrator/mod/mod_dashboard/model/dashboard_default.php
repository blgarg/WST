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


					
class model_dashboard_default extends JDatabaseMySQL{  			
          var $qry = 'SELECT * FROM wp_postmeta';  
		  var $_result = '';                     
          function __construct( $options ){ 
		              
							  }   			   		   
		  
		 
	 						   
								   
                                   // parent::__query($this->qry);	
            								    function initialize(){
									                              $this->tb_name = 'wp_postmeta';
																	$this->where = 'ORDER BY meta_id DESC';
																	  $this->adjacents = '3';
																		$this->page = 'index.php?mod=mod_dashboard';
																		  $this->pageLimit = '5';
											   //$this->_result = mysql_query($this->qry);
											          return $this->get_page_nav();
									                }	
													
													
													
													 function getvarp(){
									                 //$this->_result = mysql_query($this->qry);
											                $_data = $this->get_page_nav();  
													        $this->cur = $_data['result'];
 													        $result_set = $this->loadAssoc();
															return array('result'=>$result_set,'nav'=>$_data['nav']);
									                }
													
											function get_admin_cms()
											{
												$this->sql = "SELECT * FROM mgl_pages WHERE page_id=1";
												$this->query();
												$this->_result = $this->getArray();   				
												return $this->_result;	
											}		
													function numRow(){	
													                     $this->setQuery($this->qry);
																	     $array_aa = $this->getNumRows();
														                        return $array_aa;
																				
																				}			
				  
				
					
						}
