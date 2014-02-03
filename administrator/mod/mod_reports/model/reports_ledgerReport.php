<?php
					
class model_reports_ledgerReport extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = ''; 
		  var $searchrecivepmtCondition = '';
		  var $originalBanner = '';
		  var $thumbbanner ='';
		  var $mediumbanner = '';   
		         
          function __construct(  ){ 
		              
			} 
		function get_lastsixmonthreport(){
			
			
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
			
	function initialize(){
		
				if(isset($_REQUEST['particularsearch']) && $_REQUEST['particularsearch']=='particularsearch'){
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''  && !(isset($_REQUEST['businessid']))){
						$this->searchCondition .= ' and Actions=1';
					}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (book_name like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				}
				else if((isset($_REQUEST['report_datewise']) && $_REQUEST['report_datewise']=='report_datewise') || (isset($_REQUEST['report_sixmonthwise']) && $_REQUEST['report_sixmonthwise']=='report_sixmonthwise')){
				
					if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!='' && $_REQUEST["filtertype"]!=3){
					
						$this->searchCondition .= " amt_date>='".$_REQUEST['sdate']."' and amt_date<='".$_REQUEST['edate']."' ";
					}
					else if(isset($_REQUEST["filtertype"]) && $_REQUEST["filtertype"]==3){
					$tdate=date("Y-m-d");
					$stdate=date("Y-m-d", strtotime("-6 months"));
					$this->searchCondition .= " amt_date>='".$stdate."' and amt_date<='".$tdate."' ";
					}
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
						$this->searchCondition .= " a.amt_year='".@$_REQUEST['yearselection']."' ";
					}
					else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==1){
								if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==1){
								$this->searchCondition .= " a.amt_date>='".$quater_first."' and a.amt_date<='".$endquater_first."' ";
						 }
						 else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==2){
								$this->searchCondition .= " a.amt_date>='".$quater_second."' and a.amt_date<='".$endquater_second."' ";
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==3){
								$this->searchCondition .= " a.amt_date>='".$quater_third."' and a.amt_date<='".$endquater_third."' ";
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==4){
								$this->searchCondition .= " a.amt_date>='".$quater_fourth."' and a.amt_date<='".$endquater_fourth."' ";
						 }
					}
				else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==2){
						if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==1){
								$this->searchCondition .= " a.amt_date>='".$firsthalf_start."' and a.amt_date<='".$firsthalf_end."' ";
						 }
						 else if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==2){
								$this->searchCondition .= " a.amt_date>='".$secondhalf_start."' and a.amt_date<='".$secondhalf_end."' ";
						 }
						  
				 }	
				 
				}
				
				
				if(@$_REQUEST['acapar'] ==1){
							$biztype = @$_REQUEST['biztype'];
							$party_type = " and a.`academy_id` ='".$biztype."' ";
				}else if(@$_REQUEST['acapar'] ==2){
							$biztype = @$_REQUEST['biztype'];
							$party_type = " and a.`party_id`= '".$biztype."' ";
				}
				
				
				$this->tb_name='mgl_amt_sell_books a,mgl_sell_books b';
				$this->where = '  where a.amt_book_id=b.sell_amt_id and a.pending_payment!=0 and '.$this->searchCondition.' '.$party_type.' group by b.sell_amt_id order by amt_book_id DESC';
				
				
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
						$this->page = 'index.php?mod=mod_reports&view=ledgerReport&m=6&d=12&filtertype='.$_REQUEST['filtertype'].'&report_datewise='.$_REQUEST['report_datewise'].'&sdate='.$_REQUEST['sdate'].'&edate='.$_REQUEST['edate']."&cmbStatus=".$_REQUEST['cmbStatus'];
					}
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
					$this->page = 'index.php?mod=mod_reports&view=ledgerReport&m=6&d=12&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&typeselection='.$_REQUEST['typeselection'];
					}
					else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==1){
								if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==1){
								$this->page = 'index.php?mod=mod_reports&view=ledgerReport&m=6&d=12&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&quarter='.$_REQUEST['quarter'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						 else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==2){
								$this->page = 'index.php?mod=mod_reports&view=ledgerReport&m=6&d=12&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&quarter='.$_REQUEST['quarter'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==3){
							$this->page = 'index.php?mod=mod_reports&view=ledgerReport&m=6&d=12&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&quarter='.$_REQUEST['quarter'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						  else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==4){
								$this->page = 'index.php?mod=mod_reports&view=ledgerReport&m=6&d=12&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&quarter='.$_REQUEST['quarter'].'&typeselection='.$_REQUEST['typeselection'];
						 }
					}
				else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==2){
						if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==1){
								$this->page = 'index.php?mod=mod_reports&view=ledgerReport&m=6&d=12&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&selecthalf='.$_REQUEST['selecthalf'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						 else if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==2){
								$this->page = 'index.php?mod=mod_reports&view=ledgerReport&m=6&d=12&yearselection='.$_REQUEST['yearselection'].'&report_yearwise='.$_REQUEST['report_yearwise'].'&selecthalf='.$_REQUEST['selecthalf'].'&typeselection='.$_REQUEST['typeselection'];
						 }
						  
				 }	
				}
				
				else{
				$this->page = 'index.php?mod=mod_reports&view=ledgerReport&m=6&d=12';
				}
				$this->pageLimit = '10';
				
                return $this->get_page_nav();
					
				}	
				
		function getvarp(){
				 
						$_data = $this->get_page_nav();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						
						
						$recive = self :: getrecivepayment(@$_REQUEST['biztype']);
						
						$result_set = array_merge((array)$recive, (array)$result_set);
						
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
				
			if(file_exists($this->originalBanner)) unlink($this->originalBanner);
			if(file_exists($this->thumbbanner)) unlink($this->thumbbanner);
			if(file_exists($this->mediumbanner)) unlink($this->mediumbanner);
			}
			return true;
		}
		
		function getrecivepayment($id)
		{
			if(isset($_REQUEST['report_yearwise']) && @$_REQUEST['report_yearwise']=='report_yearwise'){
				
				
				$year1=$_REQUEST['yearselection'];
				$startyear=$year1."-01-01";
				$endyear=$year1."-12-31";
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
					$this->searchrecivepmtCondition .= " createDate>='".$startyear."' and createDate<='".$endyear."' ";
				}
				else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==1){
					if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==1){
						$this->searchrecivepmtCondition .= " createDate>='".$quater_first."' and createDate<='".$endquater_first."' ";
					}
					else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==2){
						$this->searchrecivepmtCondition .= " createDate>='".$quater_second."' and createDate<='".$endquater_second."' ";
					}
					else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==3){
						$this->searchrecivepmtCondition .= " createDate>='".$quater_third."' and createDate<='".$endquater_third."' ";
					}
					else if(isset($_REQUEST['quarter']) && @$_REQUEST['quarter']==4){
						$this->searchrecivepmtCondition .= " createDate>='".$quater_fourth."' and createDate<='".$endquater_fourth."' ";
					}
				}
				else if(isset($_REQUEST['typeselection']) && @$_REQUEST['typeselection']==2){
					if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==1){
						$this->searchrecivepmtCondition .= " createDate>='".$firsthalf_start."' and createDate<='".$firsthalf_end."' ";
					}
					else if(isset($_REQUEST['selecthalf']) && @$_REQUEST['selecthalf']==2){
						$this->searchrecivepmtCondition .= " createDate>='".$secondhalf_start."' and createDate<='".$secondhalf_end."' ";
					}
			
				}
			}
			
			if(@$_REQUEST['acapar'] ==1){
					echo $this->sql = "SELECT * FROM recive_payments where acadamy_id='$id' and $this->searchrecivepmtCondition ";
					
			}else if(@$_REQUEST['acapar'] ==2){
					$this->sql = "SELECT * FROM recive_payments where party_id='$id' and $this->searchrecivepmtCondition ";
					
			}
			$this->query();
			$result = $this->loadAssoc(); 
			return $result;
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
		function get_particular_party($id)
		{
			$this->sql = "SELECT party_title FROM mgl_party where party_id=$id";	
			$this->query();
			return $this->loadAssoc();
		}
		function get_particular_agentname($id)
		{
			$this->sql = "SELECT agent_name FROM mgl_agents where agent_id=$id";	
			$this->query();
			return $this->loadAssoc();
		}
		function get_third_person($id){
			$this->sql = "SELECT name FROM mgl_fair_person_detail where transaction_id=$id";	
			$this->query();
			return $this->loadAssoc();
		}
		function get_employee_name($id){
		$this->sql = "SELECT user_firstname,user_lastname FROM mgl_users where user_id=$id";	
		$this->query();
		return $this->loadAssoc();
		}

		 
}
						
						
						
