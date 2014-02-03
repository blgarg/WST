<?php
class model_gallery_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
				if(isset($_REQUEST['search']) && $_REQUEST['search']==1)
				{
					if(isset($_REQUEST['image_name']) && $_REQUEST['image_name']!="")
					{
						$this->searchCondition.= "and image_title like'%".strip_tags(trim($_REQUEST['image_name']))."%' "; 
					}
					if(isset($_REQUEST['country']) && $_REQUEST['country']!='')
					{
						$this->searchCondition.="and country_id=".$_REQUEST['country'];
					}
				}
				else if(isset($_REQUEST['country']) && $_REQUEST['country']!='')
				{
					$this->searchCondition.="and country_id=".$_REQUEST['country'];
				}
				$this->tb_name = 'images';
				$this->where = ' where 1 and status=1 '.$this->searchCondition;
				$this->where .=' order by created_on desc';
				$this->adjacents = '1';
				$this->page = '?mod=mod_gallery&view=default';
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

			function getImagesData(){
				$this->sql = "SELECT * FROM images where status=1";
				$this->query();
				return $this->loadAssoc();
				}
				
			function getCountryList(){
				$this->sql = "SELECT * FROM countries ";
				$this->query();
				return $this->loadAssoc();
			}
			
			//Fetch Country name from id
			function getCountryNameById($id){
		  
		   $this->sql = "SELECT * from countries where id=$id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
			
			function getCountryName(){
				$this->sql = "SELECT country_name FROM `countries` WHERE `id` =".$_REQUEST['country'];
				$this->query();
				return $this->loadAssoc();
			}
		
}
