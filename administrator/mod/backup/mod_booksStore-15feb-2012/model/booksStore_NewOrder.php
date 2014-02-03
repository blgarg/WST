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


					
class model_booksStore_NewOrder extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = ''; 
		   var $originalBanner = '';
		  var $thumbbanner ='';
		  var $mediumbanner = '';   
		         
          function __construct(  ){ 
		              
			}   			   		   
		  function get_all_businesscategories()
		{
			$this->sql = "SELECT * FROM mgl_business_categories where Actions='1' order by business_cat_title ASC";	
			$this->query();
			return $this->loadAssoc();

		}
		function get_all_bookscategories()
		{
			$this->sql = "SELECT * FROM mgl_books_categories where Actions='1' order by cat_title ASC";	
			$this->query();
			return $this->loadAssoc();
		}
		function get_all_bookswriters()
		{
			$this->sql = "SELECT * FROM mgl_writers where Actions='1' order by writer_name ASC";	
			$this->query();
			return $this->loadAssoc();
		}
			// parent::__query($this->qry);	
			function initialize(){
			
				if(isset($_REQUEST['particularsearch']) && $_REQUEST['particularsearch']=='particularsearch'  && !(isset($_REQUEST['businessid']))){
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''){
						$this->searchCondition .= ' and Actions=1';
					}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (book_name like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				}
				else if(isset($_REQUEST['sell_booksSearchBookWriters']) && $_REQUEST['sell_booksSearchBookWriters']=='sell_booksSearchBookWriters'){
				
					if(isset($_REQUEST['royalitywriter']) && $_REQUEST['royalitywriter']!=''){
						$this->searchCondition .= ' and Actions=1 and royality_writer_id ='.base64_decode($_REQUEST['royalitywriter']);
					}
				}
				else if(isset($_REQUEST['issue_booksSearchBookCategories']) && $_REQUEST['issue_booksSearchBookCategories']=='issue_booksSearchBookCategories'){
				
					if(isset($_REQUEST['bookcategory']) && $_REQUEST['bookcategory']!=''){
						$this->searchCondition .= ' and Actions=1 and book_cat_id='.base64_decode($_REQUEST['bookcategory']);
					}
				}
				else if(isset($_REQUEST['issue_booksSearchBusiness']) && $_REQUEST['issue_booksSearchBusiness']=='issue_booksSearchBusiness'){
				
					if(isset($_REQUEST['businessid'])){
					if($_REQUEST['businessid']=='hga')
					{
					$this->searchCondition .= ' and Actions=1 and party_id=0';
					}
					else
					{
					$this->searchCondition .= ' and Actions=1 and party_id='.base64_decode($_REQUEST['businessid']);
					}
					}
				}
				$this->tb_name = 'mgl_books_info';
				$this->where = ' where 1 '.$this->searchCondition.' and Actions=1 ORDER BY book_id DESC';
				
			    //$this->where = 'ORDER BY bannerId DESC';
				$this->adjacents = '1';
				if(isset($_REQUEST['issue_booksSearch']) && $_REQUEST['issue_booksSearch']=='issue_booksSearch'){
				$this->page = 'index.php?mod=mod_booksStore&view=NewOrder&m=7&creteria='.trim($_REQUEST['creteria']).'&issue_booksSearch='.$_REQUEST['issue_booksSearch']."&cmbStatus=".$_REQUEST['cmbStatus'];
				}else if(isset($_REQUEST['sell_booksSearchBookWriters']) && $_REQUEST['sell_booksSearchBookWriters']=='sell_booksSearchBookWriters'){
				$this->page = 'index.php?mod=mod_booksStore&view=NewOrder&m=7&creteria='.trim($_REQUEST['creteria']).'&sell_booksSearchBookWriters='.$_REQUEST['sell_booksSearchBookWriters']."&royalitywriter=".$_REQUEST['royalitywriter'];
				}
				else if(isset($_REQUEST['issue_booksSearchBookCategories']) && $_REQUEST['issue_booksSearchBookCategories']=='issue_booksSearchBookCategories'){
				$this->page = 'index.php?mod=mod_booksStore&view=NewOrder&m=7&creteria='.trim($_REQUEST['creteria']).'&issue_booksSearchBookCategories='.$_REQUEST['issue_booksSearchBookCategories']."&bookcategory=".$_REQUEST['bookcategory'];
				}
				else if(isset($_REQUEST['issue_booksSearchBusiness']) && $_REQUEST['issue_booksSearchBusiness']=='issue_booksSearchBusiness'){
				if(isset($_REQUEST['businessid'])){
					$this->page = 'index.php?mod=mod_booksStore&view=NewOrder&m=7&creteria='.trim($_REQUEST['creteria']).'&issue_booksSearchBusiness='.$_REQUEST['issue_booksSearchBusiness']."&partyid=".$_REQUEST['businessid'];
					
					
					
					}			
				}
				else{
				$this->page = 'index.php?mod=mod_booksStore&view=NewOrder&m=7';
				}
				$this->pageLimit = '10';
				// $this->_result = mysql_query($this->qry);
                     return $this->get_page_nav();
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
			
									
				function deleteData($ids){
					$this->qry = "delete FROM mgl_books_info WHERE book_id  in(".$ids.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}
				function changeStatus($modelIds,$type){
				
				//echo $type; die;
					if($type=="activate") $typeval = '1'; else $typeval='0';
					$this->qry = "update mgl_books_info set Actions='".$typeval."' WHERE book_id in(".$modelIds.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}
				
				
				function deleteUploadedImages($id,$ext){
				$config_var = new config();
		         $this->originalBanner = $config_var->UPLOAD_ROOT.'newsBanner/originalImg/'.$id."_img".".$ext";
		         $this->thumbbanner =$config_var->UPLOAD_ROOT.'newsBanner/thumbs/'.$id."_img".".$ext";
		  	    $this->mediumbanner = $config_var->UPLOAD_ROOT.'newsBanner/resizedImg/'.$id."_img".".$ext";
				
		    if($id !=''){
				//UNLINK PREVIOUS UPOADED IMAGES
			if(file_exists($this->originalBanner)) unlink($this->originalBanner);
			if(file_exists($this->thumbbanner)) unlink($this->thumbbanner);
			if(file_exists($this->mediumbanner)) unlink($this->mediumbanner);
			}
			return true;
		}
		function get_party_title($id)
		{
			$this->sql = "SELECT business_title FROM mgl_business_parties where parties_id=$id";	
			$this->query();
			return $this->loadAssoc();
		}
		function get_academy_title($id)
		{
			$this->sql = "SELECT business_cat_title FROM mgl_business_categories where buiness_cat_id=$id";	
			$this->query();
			return $this->loadAssoc();
		}	
		function get_all_academics()
		{
			$this->sql = "SELECT * FROM mgl_business_parties where Actions='1' order by business_title ASC";	
			$this->query();
			return $this->loadAssoc();

		}
}
						
						
						
