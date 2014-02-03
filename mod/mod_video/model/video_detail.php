<?php				
class model_video_detail extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';             
		  var $searchCondition = '';        
          
		  function __construct(  ){ 
		  }   			   		   
		  
		function initialize(){
			if(isset($_GET['id']) && $_GET['id'])
				{
					$this->tb_name = 'videos';
					$this->where = ' where status=1 and id='.$_GET['id'];
					$this->where .=' order by created_on desc';
					$this->adjacents = '1';
					$this->page = '?mod=mod_video&view=default';
					$this->pageLimit = '1';
					return $this->get_page_nav_front();
				}
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
				
		function getArtistData($id){	
			    $this->sql = "SELECT * FROM mgl_users WHERE user_id=".$id;
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}	
		
		function getCountry($id){
				$this->sql = "SELECT * from countries WHERE id=".$id;
				$this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;
			}
		function getCategory($id){
			$this->sql = "SELECT * from categories WHERE id=".$id;
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
		
		function calcRating($vid){
				$this->sql = "SELECT count(*) as count FROM video_rating WHERE video_id=".$vid;
				$this->query();
				$this->_result = $this->getArray();   				
				$this->sql = "select sum(rating) as total FROM video_rating WHERE video_id=".$vid;		
				$this->query();
				$total_rating = $this->getArray();   				
				$rating = ceil($total_rating['total']/$this->_result['count']);
				return $rating;
			}
		
		function getAllCountry()
			{
				$this->sql = "select * from countries";
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
						
						
						
