<?php
class model_forum_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
				$this->tb_name = 'forum_categories';
				$this->where = ' where 1 and status=1 ';
				$this->where .=' order by cat_name asc';
				$this->adjacents = '1';
				$this->page = '?mod=mod_forum&view=default';
				$this->pageLimit = '10';
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

			
			//Fetch Sub Cat name
			function getSubCatById($id){
		  
		   $this->sql = "SELECT * from `forum_sub_categories` where cat_id=$id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
			
			function getCountryName(){
				$this->sql = "SELECT country_name FROM `countries` WHERE `id` =".$_REQUEST['country'];
				$this->query();
				return $this->loadAssoc();
			}
				function getCity(){
						$this->sql = "SELECT `city` FROM `party_girls_images`";
						$this->query();
						return $this->loadAssoc();
					}
		
}
