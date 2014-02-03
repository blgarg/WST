<?php
class model_travel_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
				if(isset($_REQUEST['search']) && $_REQUEST['search']==1)
					{
						if(isset($_REQUEST['search_place']) && $_REQUEST['search_place']!="")
						{
							$this->searchCondition.= "and place_name like'%".strip_tags(trim($_REQUEST['search_place']))."%' "; 
						}
						if(isset($_REQUEST['country']) && $_REQUEST['country']!='')
						{
							$this->searchCondition.="and country = ".$_REQUEST['country'].' ';
						}
						if(isset($_REQUEST['bar_city']) && $_REQUEST['bar_city']!='')
						{
							$this->searchCondition.="and city like'%".strip_tags(trim($_REQUEST['bar_city']))."%' ";
						}
					}
					else if(isset($_REQUEST['country']) && $_REQUEST['country']!='')
					{
						$this->searchCondition.="and country_id=".$_REQUEST['country'];
					}
					$this->tb_name = 'travel_guide';
					$this->where = ' where 1 and status=1 '.$this->searchCondition;
					//$this->where .=' order by created_on desc';
					//Update on 24 july 3013
					$this->where .=' order by RAND()';
					$this->adjacents = '1';
					$this->page = '?mod=mod_travel&view=default';
					$this->pageLimit = '40';
					return $this->get_page_nav_front();
				}	
				
				 function getvarp(){
						$_data = $this->get_page_nav_front();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
				function numRow(){	
					$this->setQuery($this->qry);
					$array_aa = $this->getNumRows();
					return $array_aa;
				}

				function getCountry(){
						$this->sql = "select * from countries";
						$this->query();
						return $this->loadAssoc();
					}
				function getCountryName($id)
				  {
					$this->sql = "SELECT * FROM countries where id=".$id ;
						if($this->query()){
						return $this->loadAssoc();
					   }
				  }
				function getCity(){
						$this->sql = "SELECT `city` FROM `travel_guide`";
						$this->query();
						return $this->loadAssoc();
					}
				
}
