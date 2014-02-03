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


					
class model_reports_agents extends JDatabaseMySQL{  			
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

			$this->where = ' mgl_amt_sell_books a,mgl_sell_books b,mgl_agents c where a.agent_id=c.agent_id and a.amt_book_id=b.sell_amt_id group by b.sell_amt_id  order by c.agent_name asc';
				 //$this->where = ' mgl_books_info where Actions=1 and '.$this->searchCondition.'  order by book_id desc';
				//$this->where = 'ORDER BY bannerId DESC';
				//echo $this->where; die;
				$this->adjacents = '0';
				
				$this->page = 'index.php?mod=mod_reports&view=agents&m=6';
				
				$this->pageLimit = '10';
				//chcecked
				// $this->_result = mysql_query($this->qry);
                     return $this->get_agent_nav();
					
				}	
				
				
				
				function getvarp(){
				 //$this->_result = mysql_query($this->qry);
						$_data = $this->get_agent_nav();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						/*echo "<pre>";
						print_r($_data);
						die;*/
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
				
				
				function numRow(){	 $this->setQuery($this->qry);
									 $array_aa = $this->getNumRows();
											return $array_aa;
											
				}			
			
					function get_agent_title($id)
				{
				$this->sql = "SELECT agent_name FROM mgl_agents where agent_id=$id";	
				$this->query();
				return $this->loadAssoc();
				}	
				function get_total_books($id)
				{
				$this->sql = "SELECT SUM(book_qty) as booksum FROM mgl_sell_books where sell_amt_id=$id";	
				$this->query();
				return $this->loadAssoc();
				}
				function get_academytitle($id)
				{
				$this->sql = "SELECT business_title FROM mgl_business_parties where parties_id=$id";	
				$this->query();
				return $this->loadAssoc();
				}
				function get_partytitle($id)
				{
				$this->sql = "SELECT party_title FROM mgl_party where party_id=$id";	
				$this->query();
				return $this->loadAssoc();
				}
				function get_personname($id)
				{
				$this->sql = "SELECT name FROM mgl_fair_person_detail where transaction_id=$id";	
				$this->query();
				return $this->loadAssoc();
				}					
			
}
						
						
	?>					


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


					
/*class model_reports_agents extends JDatabaseMySQL{  			
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
			
				if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''){
						$this->searchCondition .= ' and Actions='.$_REQUEST['cmbStatus'];
					}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (page_title like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				}
				   $this->where = ' mgl_amt_sell_books a,mgl_sell_books b where a.amt_book_id=b.sell_amt_id group by b.sell_amt_id '.$this->searchCondition.' order by a.amt_book_id desc';
				//$this->where = 'ORDER BY bannerId DESC';
				$this->adjacents = '1';
				if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
				$this->page = 'index.php?mod=mod_agents&view=default&m=5&d=5&creteria='.trim($_REQUEST['creteria']).'&hdnSearch='.$_REQUEST['hdnSearch']."&cmbStatus=".$_REQUEST['cmbStatus'];
				}else{
				$this->page = 'index.php?mod=mod_agents&view=default&m=5&d=5';
				}
				$this->pageLimit = '10';
				// $this->_result = mysql_query($this->qry);
                     return $this->get_page_nav();
				}	
				
				
				function get_total_books($id)
				{
				$this->sql = "SELECT SUM(book_qty) as booksum FROM mgl_sell_books where sell_amt_id=$id";	
				$this->query();
				return $this->loadAssoc();
				}
				function get_academytitle($id)
				{
				$this->sql = "SELECT business_title FROM mgl_business_parties where parties_id=$id";	
				$this->query();
				return $this->loadAssoc();
				}
				function get_partytitle($id)
				{
				$this->sql = "SELECT party_title FROM mgl_party where party_id=$id";	
				$this->query();
				return $this->loadAssoc();
				}
				function get_personname($id)
				{
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
				
				
				
				function numRow(){	 $this->setQuery($this->qry);
									 $array_aa = $this->getNumRows();
											return $array_aa;
											
				}			
			
									
				function deleteData($ids){
					$this->qry = "delete FROM mgl_agents WHERE agent_id  in(".$ids.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}
				function get_agent_title($id)
				{
				$this->sql = "SELECT agent_name FROM mgl_agents where agent_id=$id";	
				$this->query();
				return $this->loadAssoc();
				}				
				function changeStatus($modelIds,$type){
				
				//echo $type; die;
					if($type=="activate") $typeval = '1'; else $typeval='0';
					$this->qry = "update mgl_agents set Actions='".$typeval."' WHERE agent_id in(".$modelIds.") ";
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

}
						
						
						*/
