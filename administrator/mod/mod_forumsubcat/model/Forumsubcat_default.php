<?php
class model_Forumsubcat_default extends JDatabaseMySQL{  			
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
			//echo "<pre>"; echo count($_REQUEST); die;
		
			if(isset($_REQUEST['hdnSearch']) && $_REQUEST['hdnSearch']=='hdnsearch'){
			$_REQUEST['creteria'] = strip_tags($_REQUEST['creteria']);
			$_REQUEST['creteria'] = substr($_REQUEST['creteria'],0,60); 
					if(isset($_REQUEST['cmbStatus']) && $_REQUEST['cmbStatus']!=''){
						$this->searchCondition .= 'and status='.$_REQUEST['cmbStatus'];
					}
					if(isset($_REQUEST['creteria']) && $_REQUEST['creteria']!='' && strtolower($_REQUEST['creteria'])!='search' ){
						$this->searchCondition .= ' and (sub_cat_name  like "%'.trim($_REQUEST['creteria']).'%"  )';
					}
					
				}
						
				
				$this->tb_name = 'forum_sub_categories';
				$this->where = ' where 1 '.$this->searchCondition;
				$this->where .=' order by sub_cat_id desc';
			   	$this->adjacents = '1';
				$this->page = 'index.php?mod=mod_forum_subcat&view=default&d=3@type=forum';
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
					$this->qry = "delete FROM forum_sub_categories WHERE sub_cat_id  in(".$ids.") ";
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
					$this->qry = "update forum_sub_categories set status='".$typeval."' WHERE sub_cat_id in(".$modelIds.") ";
					$this->sql = $this->qry;
					
					if($this->query()){
						return true;
					}else{
						return false;
					}
					
				}
				
							
		function getCatName($cat_id){
			$this->sql = "SELECT * FROM forum_categories where cat_id='".$cat_id."'";	
			$this->query();
			return $this->loadAssoc();
		}
}
						
						
						
