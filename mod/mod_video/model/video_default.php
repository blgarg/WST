<?php				
class model_video_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = '';        
          function __construct(  ){ 
		              
			}   			   		   
		  function initialize(){
				if(isset($_REQUEST['search']) && $_REQUEST['search']==1)
				{
					if(isset($_REQUEST['video_name']) && $_REQUEST['video_name']!="")
					{
						$this->searchCondition.= "and video_title like'%".trim($_REQUEST['video_name'])."%' "; 
					}
					if(isset($_REQUEST['country']) && $_REQUEST['country']!='')
					{
						$this->searchCondition.="and country_id=".$_REQUEST['country'];
					}
				}
				$this->tb_name = 'videos';
				$this->where = ' where 1 and status =1 '.$this->searchCondition;
				$this->where .=' order by created_on desc';
				$this->adjacents = '1';
				$this->page = '?mod=mod_video&view=default';
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
				
			function getArtistData($id)
			{	
			    $this->sql = "SELECT * FROM mgl_users WHERE user_id=".$id;
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}	
			
			function getCountryName($id){
				$this->sql = "SELECT name FROM country WHERE id=".$id;
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result['name'];	
			}	
			
			function getAllCountry(){
				$this->sql = "select * from countries";
				$this->query();
				return $this->loadAssoc();
			}
			
			function getSelectedCountry(){
				$this->sql = "SELECT country_name FROM `countries` WHERE `id` =".$_REQUEST['country'];
				$this->query();
				return $this->loadAssoc();
			}
			
			function format_date($original='', $format="%b %d,%Y") {
				 $format = ($format=='date' ? "%m-%d-%Y" : $format); 
				 $format = ($format=='datetime' ? "%m-%d-%Y %H:%M:%S" : $format); 
				 $format = ($format=='mysql-date' ? "%Y-%m-%d" : $format); 
				 $format = ($format=='mysql-datetime' ? "%Y-%m-%d %H:%M:%S" : $format); 
				 return (!empty($original) ? strftime($format, strtotime($original)) : "" ); 
           }
			
}
						
						
						
