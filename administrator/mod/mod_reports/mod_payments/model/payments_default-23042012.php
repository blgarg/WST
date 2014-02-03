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


					
class model_payments_default extends JDatabaseMySQL{  			
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
			
			/*	if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''){
						$this->searchCondition .= ' and Actions='.$_REQUEST['cmbStatus'];
					} */
				
			/*		if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (mag_title like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				} */
				
				
				
				if(isset($_REQUEST['type']) && $_REQUEST['type']=='academy'){		
				 $this->tb_name = 'mgl_business_parties';
				 $this->where = ' where 1 ORDER BY parties_id DESC';
				
				}
				
				if(isset($_REQUEST['type']) && $_REQUEST['type']=='party'){
				$this->tb_name = 'mgl_party';
				$this->where = ' where 1 '.$this->searchCondition.' ORDER BY party_id DESC';
				}
				
				//$this->tb_name = 'mgl_magazine_detail';
				//$this->where = ' where 1 '.$this->searchCondition.' ORDER BY mag_id DESC';
			    //$this->where = 'ORDER BY bannerId DESC';
				$this->adjacents = '1';
				
				if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
				$this->page = 'index.php?mod=mod_payments&view=default&m=11&d=5&creteria='.trim($_REQUEST['creteria']).'&hdnSearch='.$_REQUEST['hdnSearch']."&type=".$_REQUEST['type'];
				}else{
				$this->page = 'index.php?mod=mod_payments&view=default&m=11&d=5';
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
						$receivedpayment = array();
						for($m=0;$m<count($result_set);$m++){
							
							if(isset($result_set[$m]['parties_id']) && $result_set[$m]['parties_id'] != ''){
								$amtinfo[$m] = self :: amtacadmyinfo($result_set[$m]['parties_id']);
								
								$result_set[$m]['amt_book_id'] = $amtinfo[$m]['amt_book_id'];
								$result_set[$m]['total_amt_withanothercost'] = $amtinfo[$m]['total_amt_withanothercost'];
								$result_set[$m]['pending_payment'] = $amtinfo[$m]['pending_payment'];
								$result_set[$m]['balance_payment'] = $amtinfo[$m]['balance_payment'];
								
							}
							if(isset($result_set[$m]['party_id']) && $result_set[$m]['party_id'] != ''){
								$amtinfo[$m] = self :: amtpartyinfo($result_set[$m]['party_id']);
								
								$result_set[$m]['amt_book_id'] = $amtinfo[$m]['amt_book_id'];
								$result_set[$m]['total_amt_withanothercost'] = $amtinfo[$m]['total_amt_withanothercost'];
								$result_set[$m]['pending_payment'] = $amtinfo[$m]['pending_payment'];
								$result_set[$m]['balance_payment'] = $amtinfo[$m]['balance_payment'];
							}
							
							$pmtfo = self :: receivedpmtinfo($result_set[$m]['amt_book_id']);
							
							$receivedpayment = $pmtfo; 
							
						}
						
						return array('result'=>$result_set,'nav'=>$_data['nav'],'recvpmt'=>$receivedpayment);
				}
				
				
				
				function numRow(){	 $this->setQuery($this->qry);
									 $array_aa = $this->getNumRows();
											return $array_aa;
											
				}			
			
									
				function deleteData($ids){
					$this->qry = "delete FROM mgl_magazine_detail WHERE mag_id  in(".$ids.") ";
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
					$this->qry = "update mgl_magazine_detail set Actions='".$typeval."' WHERE mag_id in(".$modelIds.") ";
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

		function amtacadmyinfo($biztypeid){
			$this->sql = "SELECT amt_book_id,total_amt_withanothercost,pending_payment,balance_payment FROM mgl_amt_sell_books where academy_id= '".$biztypeid."' ";
			$this->query();
			$amtinfo = $this->loadAssoc();
			return $amtinfo[0];
		}
		
		function amtpartyinfo($biztypeid){
			$this->sql = "SELECT amt_book_id,total_amt_withanothercost,pending_payment,balance_payment FROM mgl_amt_sell_books where party_id= '".$biztypeid."' ";
			$this->query();
			$amtinfo = $this->loadAssoc();
			return $amtinfo[0];
		}
		
		function receivedpmtinfo($bookId){
			$this->sql = "SELECT receivepmt FROM recive_payments where book_pmt_id= '".$bookId."' ";
			$this->query();
			$pmtinfo = $this->loadAssoc();
			return $pmtinfo;
		}
		
		
}
						
						
						
