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
					
					
class model_Forumsubcat_editCategory extends JDatabaseMySQL
{  			
          var $tableName;
		  var $pageTitle;
		  var $pageMetaTagTitle;
		  var $pageMetaDes;
		  var $pageContents;
		  var $cat_id;
		  var $pageCats = 24;
		  var $created_date;
		  var $page_title_link='';
		  var $qry = '';  
		  var $_result = '';     
		                     
         	function __construct(){}
		  	function initialize(){ return ;}
		
			function checkRecords($data){
			$this->sql = "SELECT * FROM forum_sub_categories where sub_cat_name='". $data->categorytitle."' and sub_cat_id !='".$data->cat_id."'"; 
			$this->query();
			return $this->loadAssoc();		
		}
			
													
			function getPageData($data)
			{	
				$this->sql = "SELECT * FROM forum_sub_categories WHERE sub_cat_id='".$data['cat_id']."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}
			
			function saveData($data)
			{
		       $this->categoryTitle = @mysql_real_escape_string(stripslashes($data->categorytitle));
			  $this->cat = @mysql_real_escape_string(stripslashes($data->cat));
			  $this->cat_id = @mysql_real_escape_string(stripslashes($data->cat_id));
			 /* $this->sql= "SELECT * FROM mgl_main_category WHERE page_url='$this->page_title_link'";
			  $this->query();
			  $Rcdrs =  $this->getNumRows();
			  if($Rcdrs >=1){$this->page_title_link = $this->page_title_link."_1"; /*$this->pageTitle = $this->pageTitle."_1";*//*}	
			  */
			$this->qry = "UPDATE forum_sub_categories SET
					  sub_cat_name='".$this->categoryTitle."', cat_id='".$this->cat."'
                      WHERE sub_cat_id=".$this->cat_id;
			$this->sql = $this->qry;
				if($this->query()){return $this->sql;}else{return $this->sql;}
			 }	
			 	
			function getvarp(){ return; }
													
			
}
