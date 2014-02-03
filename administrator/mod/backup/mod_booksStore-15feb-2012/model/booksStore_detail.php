<?php
session_start();
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
					
					
class model_booksStore_detail extends JDatabaseMySQL{  			
          var $categoryTitle;
		  var $categoryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
          function initialize(){ return ; }	
		   function get_order_detail($id)
            {
				$this->sql = "SELECT * FROM tb_order_detail WHERE detail_id='".base64_decode($id['order'])."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;
		    }
			function get_product_name($pid){
			$result=mysql_query("select * from mgl_books_info where book_id=$pid");
			$row=mysql_fetch_array($result);
			return($row);
			}
	  			  function get_academy_title($id)
				{
				$this->sql = "SELECT business_title FROM mgl_business_parties WHERE parties_id='".$id."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;
				}
				function get_employee_name($id)
				{
				$this->sql = "SELECT user_name FROM mgl_users WHERE user_id='".$id."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;
				}
				function get_all_books_withorder($id)									
				{
				$this->sql = "SELECT * FROM tb_order_send WHERE order_detail_id='".base64_decode($id['order'])."'";
				$this->query();
				$this->_result = $this->loadAssoc();   				
				return $this->_result;
				}
		 function getvarp(){
		 //$this->_result = mysql_query($this->qry);
				$_data = $this->get_page_nav();  
				$this->cur = $_data['result'];
				$result_set = $this->loadAssoc();
				return array('result'=>$result_set,'nav'=>$_data['nav']);
		}
		
					
				
}
