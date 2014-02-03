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
					
					
class model_reports_detail extends JDatabaseMySQL{  			
          var $categoryTitle;
		  var $categoryText;
		  var $createdDate = '0000-00-00 00:00:00';
          function __construct(){}
		  // parent::__query($this->qry);	
         
		  function initialize(){ return ; }	
		   function get_order_detail($id)
            {
				$this->sql = "SELECT * FROM mgl_sell_books WHERE sell_amt_id='".base64_decode($id['sell_id'])."'";
				$this->query();
				$this->_result = $this->loadAssoc();   				
				return $this->_result;
		    }
			
			function get_particular_agentname($id)
		{
			$this->sql = "SELECT agent_name FROM mgl_agents where agent_id=$id";	
			$this->query();
			return $this->loadAssoc();
		}
			 function get_order_seconddetail($id)
            {
				$this->sql = "SELECT * FROM mgl_amt_sell_books WHERE amt_book_id='".base64_decode($id['sell_id'])."'";
				$this->query();
				$this->_result = $this->loadAssoc();   				
				return $this->_result;
		    }
			function get_price_list($id)
            {
				$this->sql = "SELECT * FROM mgl_party a,mgl_amt_sell_books b,mgl_books_categories c WHERE a.party_id=b.party_id and b.business_id=c.cat_id and amt_book_id='".base64_decode($id['sell_id'])."'";
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
				$this->sql = "SELECT * FROM mgl_users WHERE user_id='".$id."'";
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
				function get_third_person($id){
			$this->sql = "SELECT name FROM mgl_fair_person_detail where transaction_id=$id";	
			$this->query();
			return $this->loadAssoc();
		}
		 function getvarp(){
		 //$this->_result = mysql_query($this->qry);
				$_data = $this->get_page_nav();  
				$this->cur = $_data['result'];
				$result_set = $this->loadAssoc();
				return array('result'=>$result_set,'nav'=>$_data['nav']);
		}
		function get_agents_commision($id){
		$this->sql = "SELECT agents_commision FROM mgl_agents where agent_id=$id";	
			$this->query();
			return $this->loadAssoc();
	 }
		
		
					
				
}
