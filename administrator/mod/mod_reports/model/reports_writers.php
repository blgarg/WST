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


					
class model_reports_writers extends JDatabaseMySQL{  			
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
						$this->searchCondition .= ' and (writer_name like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				}
				if(isset($_REQUEST['filterwname']) && $_REQUEST['filterwname']!='')
				{
					$this->searchCondition .=' and writer_id='.$_REQUEST['filterwname'];
				}
				else
				{
					$this->searchCondition .=' and writer_id= 0';
				}
				
				$this->tb_name = 'mgl_writers';
				$this->where = ' where 1 '.$this->searchCondition.' ORDER BY writer_name asc';
			    //$this->where = 'ORDER BY bannerId DESC';
				$this->adjacents = '1';
				if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
				$this->page = 'index.php?mod=mod_reports&view=writers&m=6&d=13&creteria='.trim($_REQUEST['creteria']).'&hdnSearch='.$_REQUEST['hdnSearch']."&cmbStatus=".$_REQUEST['cmbStatus'];
				}else{
				$this->page = 'index.php?mod=mod_reports&view=writers&m=6&d=13';
				}
				$this->pageLimit = '10';
				//chcecked
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
				
				function writer_list()
				{
					$this->sql = "select * from  mgl_writers";
					$this->query();
					$this->result = $this->loadAssoc();
					return $this->result;
					
				}
				
				function numRow(){	 $this->setQuery($this->qry);
									 $array_aa = $this->getNumRows();
											return $array_aa;
											
				}			
			
					function get_royality_prices($id)
	{
	$this->sql = "SELECT sum(`book_qty`) as quantities,sum(`writer_amt`) as totals FROM mgl_sell_books WHERE `writer_id`= '$id' and `writer_amt`!='0.00'"; 
					$this->query();
					$this->result = $this->loadAssoc();
					return $this->result;
	}				
				function deleteData($ids){
					$this->qry = "delete FROM mgl_writers WHERE writer_id  in(".$ids.") ";
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
					$this->qry = "update mgl_writers set Actions='".$typeval."' WHERE writer_id in(".$modelIds.") ";
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
		function get_employee_name($id){
		$this->sql = "SELECT user_firstname,user_lastname FROM mgl_users where user_id=$id";	
		$this->query();
		return $this->loadAssoc();
		}

}
						
						
						
