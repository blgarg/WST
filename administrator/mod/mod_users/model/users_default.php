<?php
					
class model_users_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = '';        
          function __construct(  ){ 
		              
			}   			   		   
		  
			// parent::__query($this->qry);	
			function initialize(){
				
				
				if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
				$_REQUEST['creteria'] = strip_tags($_REQUEST['creteria']);
				$_REQUEST['creteria'] = substr($_REQUEST['creteria'],0,60); 
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''){
						$this->searchCondition .= ' and status ="'.$_REQUEST['cmbStatus'].'"';
					}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (first_name like "%'.trim($_REQUEST['creteria']).'%" || last_name like "%'.trim($_REQUEST['creteria']).'%" || address like "%'.trim($_REQUEST['creteria']).'%" )';
					}
					
				}
				$this->tb_name = 'users';
				$this->where = ' where 1   '.$this->searchCondition.' ORDER BY id DESC'; 
				
				$this->adjacents = '1';
				
				if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
					$this->page = 'index.php?mod=mod_users&view=default&m=1&creteria='.trim($_REQUEST['creteria']).'&hdnSearch='.$_REQUEST['hdnSearch']."&cmbStatus=".$_REQUEST['cmbStatus'];
				}else{
					$this->page = 'index.php?mod=mod_users&view=default&m=1';
				}
				$this->pageLimit = '10';
				//$this->_result = mysql_query($this->qry);

				  return $this->get_page_nav();
				}	
				
				
				
				 function getvarp(){
				 //$this->_result = mysql_query($this->qry);
						$_data = $this->get_page_nav();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
				
				function numRow(){	
									 $this->setQuery($this->qry);
									 $array_aa = $this->getNumRows();
											return $array_aa;
											
				}			
			
				
				function deleteData($userids){
					$this->qry = "delete FROM users WHERE id in(".$userids.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}
				function changeStatus($userids,$type){
					if($type=="activate") $typeval = '1'; else $typeval='0';
					$this->qry = "update users set status='".$typeval."' WHERE id  in(".$userids.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}

}
						
						
						