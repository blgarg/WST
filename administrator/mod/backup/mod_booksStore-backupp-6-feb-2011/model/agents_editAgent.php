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
					
					
class model_agents_editAgent extends JDatabaseMySQL
{  			
          var $tableName;
		  var $pageTitle;
		  var $pageMetaTagTitle;
		  var $pageMetaDes;
		  var $pageContents;
		  var $agent_id;
		  var $pageCats = 24;
		  var $created_date;
		  var $page_title_link='';
		  var $qry = '';  
		  var $_result = '';     
		                     
         	function __construct(){}
		  	function initialize(){ return ;}	
													
			function getPageData($data)
			{	
				$this->sql = "SELECT * FROM mgl_agents WHERE agent_id='".$data['agent_id']."'";
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}
			function saveData_withimg($data,$imgpath)
			{

			  $this->emp_type = @mysql_real_escape_string(stripslashes($data->emp_type));
			  $this->fName = @mysql_real_escape_string(stripslashes($data->fName));
			  $this->lName = @mysql_real_escape_string(stripslashes($data->lName));
			  $this->rTitle = @mysql_real_escape_string(stripslashes($data->rTitle));
			  $this->dob = @mysql_real_escape_string(stripslashes($data->dob));
			  $this->jdate = @mysql_real_escape_string(stripslashes($data->jdate));
			  $this->addr1 = @mysql_real_escape_string(stripslashes($data->addr1));
			  $this->country = @mysql_real_escape_string(stripslashes($data->country));
			  $this->state = @mysql_real_escape_string(stripslashes($data->state));
			  $this->city = @mysql_real_escape_string(stripslashes($data->city));
			  $this->phone = @mysql_real_escape_string(stripslashes($data->phone));
			  $this->mobile = @mysql_real_escape_string(stripslashes($data->mobile));
			  $this->agent_id = @mysql_real_escape_string(stripslashes($data->agent_id));
			 /* $this->sql= "SELECT * FROM mgl_agents WHERE page_url='$this->page_title_link'";
			  $this->query();
			  $Rcdrs =  $this->getNumRows();
			  if($Rcdrs >=1){$this->page_title_link = $this->page_title_link."_1"; /*$this->pageTitle = $this->pageTitle."_1";*//*}	
			  */
				$this->qry = "UPDATE mgl_agents SET
					  emp_type='".$this->emp_type."',
                      emp_lname='".$this->lName."',
					  emp_fname='".$this->fName."',
                      emp_rtitle='".$this->rTitle."',
					  emp_dob='".$this->dob."',
                      emp_joining='".$this->jdate."',
					  addr1='".$this->addr1."',
                      emp_country='".$this->country."',
					  emp_state='".$this->state."',
                      emp_city='".$this->city."',
					  emp_phone='".$this->phone."',
					  img_title='".$imgpath."',	
                      emp_mobile='".$this->mobile."'
					  WHERE 
					  agent_id=".$this->agent_id;
			
			$this->sql = $this->qry;
				if($this->query()){return $this->sql;}else{return $this->sql;}
			 }
			function saveData($data)
			{
			/*	echo "<pre>";
			print_r($_REQUEST);
			die('jsm');*/
			 $this->emp_type = @mysql_real_escape_string(stripslashes($data->agent_name));
			  $this->dob = @mysql_real_escape_string(stripslashes($data->dob));
			  $this->addr1 = @mysql_real_escape_string(stripslashes($data->addr1));
			  $this->country = @mysql_real_escape_string(stripslashes($data->country));
			  $this->state = @mysql_real_escape_string(stripslashes($data->state));
			  $this->city = @mysql_real_escape_string(stripslashes($data->city));
			  $this->phone = @mysql_real_escape_string(stripslashes($data->phone));
			  $this->mobile = @mysql_real_escape_string(stripslashes($data->mobile));
			  $this->agent_id = @mysql_real_escape_string(stripslashes($data->agent_id));
				$this->qry = "UPDATE mgl_agents SET
					  agent_name='".$this->emp_type."',
                      agent_dob='".$this->dob."',
					  agent_address='".$this->addr1."',
                      agent_country='".$this->country."',
					  agent_state='".$this->state."',
                      agent_city='".$this->city."',
					  agent_phno='".$this->phone."',
                      agent_mobno='".$this->mobile."'
					  WHERE 
					  agent_id=".$this->agent_id;
			
			$this->sql = $this->qry;
				if($this->query()){return $this->sql;}else{return $this->sql;}
			 }	
			 	
			function getvarp(){ return; }
													
			
}
