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


					
class model_reports_publicationbook extends JDatabaseMySQL{  			
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
			
				if(isset($_REQUEST['particularsearch']) && $_REQUEST['particularsearch']=='particularsearch'){
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''  && !(isset($_REQUEST['businessid']))){
						$this->searchCondition .= ' and Actions=1';
					}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (book_name like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				}
				else if(isset($_REQUEST['report_datewise']) && $_REQUEST['report_datewise']=='report_datewise'){
				
					if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!=''){
					
						$this->searchCondition .= " created_date>='".$_REQUEST['sdate']."' and created_date<='".$_REQUEST['edate']."' ";
					}
				}
				else if(isset($_REQUEST['report_academicwise']) && $_REQUEST['report_academicwise']=='report_academicwise'){
						$this->searchCondition .= " party_id='".base64_decode($_REQUEST['businessid'])."' ";
				}
				else if(isset($_REQUEST['report_yearwise']) && @$_REQUEST['report_yearwise']=='report_yearwise'){
				$year1=$_REQUEST['yearselection'];
				$quater_first=$year1."-01-01";
				$endquater_first=$year1."-03-31";
				$quater_second=$year1."-04-01";
				$endquater_second=$year1."-06-30";
				$quater_third=$year1."-07-01";
				$endquater_third=$year1."-09-30";
				$quater_fourth=$year1."-10-01";
				$endquater_fourth=$year1."-12-31";
				
				$firsthalf_start=$year1."-01-01";
				$firsthalf_end=$year1."-06-30";
				$secondhalf_start=$year1."-07-01";
				$secondhalf_end=$year1."-12-31";
					if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==3){
						$this->searchCondition .= " created_year='".@$_REQUEST['yearselection']."' ";
					}
					else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==1){
								if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==1){
								$this->searchCondition .= " created_date>='".$quater_first."' and created_date<='".$endquater_first."' ";
						 }
						 else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==2){
								$this->searchCondition .= " created_date>='".$quater_second."' and created_date<='".$endquater_second."' ";
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==3){
								$this->searchCondition .= " created_date>='".$quater_third."' and created_date<='".$endquater_third."' ";
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==4){
								$this->searchCondition .= " created_date>='".$quater_fourth."' and created_date<='".$endquater_fourth."' ";
						 }
					}
				else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==2){
						if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==1){
								$this->searchCondition .= " created_date>='".$firsthalf_start."' and created_date<='".$firsthalf_end."' ";
						 }
						 else if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==2){
								$this->searchCondition .= " created_date>='".$secondhalf_start."' and created_date<='".$secondhalf_end."' ";
						 }
						  
				 }	
				}
				 $this->where = ' mgl_books_info where Actions=1 and '.$this->searchCondition.'  order by book_id desc';
				//$this->where = 'ORDER BY bannerId DESC';
				//echo $this->where; die;
				$this->adjacents = '0';
				
				
				if(isset($_REQUEST['particularsearch']) && $_REQUEST['particularsearch']=='particularsearch'){
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''  && !(isset($_REQUEST['businessid']))){
						$this->searchCondition .= ' and Actions=1';
					}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (book_name like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				}
				else if(isset($_REQUEST['report_datewise']) && $_REQUEST['report_datewise']=='report_datewise'){
				
					if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!=''){
						$this->page = 'index.php?mod=mod_reports&view=publicationbook&m=6&filtertype='.$_REQUEST['filtertype'].'&report_datewise='.$_REQUEST['report_datewise'].'&sdate='.$_REQUEST['sdate'].'&edate='.$_REQUEST['edate']."&cmbStatus=".$_REQUEST['cmbStatus'];
					}
				}
				else if(isset($_REQUEST['report_academicwise']) && $_REQUEST['report_academicwise']=='report_academicwise'){
						$this->searchCondition .= " party_id='".base64_decode($_REQUEST['businessid'])."' ";
				}
				else if(isset($_REQUEST['report_yearwise']) && @$_REQUEST['report_yearwise']=='report_yearwise'){
				$year1=$_REQUEST['yearselection'];
				$quater_first=$year1."-01-01";
				$endquater_first=$year1."-03-31";
				$quater_second=$year1."-04-01";
				$endquater_second=$year1."-06-30";
				$quater_third=$year1."-07-01";
				$endquater_third=$year1."-09-30";
				$quater_fourth=$year1."-10-01";
				$endquater_fourth=$year1."-12-31";
				
				$firsthalf_start=$year1."-01-01";
				$firsthalf_end=$year1."-06-30";
				$secondhalf_start=$year1."-07-01";
				$secondhalf_end=$year1."-12-31";
					if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==3){
					$this->page = 'index.php?mod=mod_reports&view=publicationbook&m=6&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&typeselection='.$_REQUEST['typeselection'];
					}
					else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==1){
								if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==1){
								$this->page = 'index.php?mod=mod_reports&view=publicationbook&m=6&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&quarter='.$_REQUEST['quarter'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						 else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==2){
								$this->page = 'index.php?mod=mod_reports&view=publicationbook&m=6&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&quarter='.$_REQUEST['quarter'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==3){
							$this->page = 'index.php?mod=mod_reports&view=publicationbook&m=6&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&quarter='.$_REQUEST['quarter'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==4){
								$this->page = 'index.php?mod=mod_reports&view=publicationbook&m=6&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&quarter='.$_REQUEST['quarter'].'&typeselection='.$_REQUEST['typeselection'];
						 }
					}
				else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==2){
						if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==1){
								$this->page = 'index.php?mod=mod_reports&view=publicationbook&m=6&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&selecthalf='.$_REQUEST['selecthalf'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						 else if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==2){
								$this->page = 'index.php?mod=mod_reports&view=publicationbook&m=6&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&selecthalf='.$_REQUEST['selecthalf'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						  
				 }	
				}
				
				else{
				$this->page = 'index.php?mod=mod_reports&view=publicationbook&m=6';
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
		function get_author($id)
		{
			$this->sql = "SELECT writer_name FROM mgl_writers where writer_id=$id";	
			$this->query();
			return $this->loadAssoc();
		}	
		function get_all_academics()
		{
			$this->sql = "SELECT * FROM mgl_business_parties where Actions='1' order by business_title ASC";	
			$this->query();
			return $this->loadAssoc();
		}
		function get_employee_name($id){
	 $this->sql = "SELECT user_firstname,user_lastname FROM mgl_users where user_id=$id";	
			$this->query();
			return $this->loadAssoc();
	 }
		
}
						
						
						
