<?php
class model_barguide_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct($options='' )
		  {
		  }   			   		   
		  function initialize()
		  { 
			if(isset($_REQUEST['search']) && $_REQUEST['search']=="search")
				{
					if(isset($_REQUEST['place_name']) && $_REQUEST['place_name']!="")
					{
						$this->searchCondition.= "and bar_name like'%".trim($_REQUEST['place_name'])."%' "; 
					}
					if(isset($_REQUEST['country']) && $_REQUEST['country']!='')
					{
						$this->searchCondition.="and bar_country='".$_REQUEST['country']."'";
					}
					if(isset($_REQUEST['city']) && $_REQUEST['city']!='')
					{
						$this->searchCondition.="and bar_city='".$_REQUEST['city']."'";
					}
				}
				//echo $this->searchCondition;die;
				$this->tb_name = 'bar_data';
				$this->where = ' where 1 and status =1 '.$this->searchCondition;
				//$this->where .=' order by created_on desc';
				//Updated on 23 july 2013
				$this->where .=' order by RAND()';
				$this->adjacents = '1';
				$this->page = '?mod=mod_barguide&view=default';
				$this->pageLimit = '40';
				// $this->_result = mysql_query($this->qry);
                     return $this->get_page_nav_front();
		  }	
		  function getvarp()
		  {
			$_data = $this->get_page_nav_front();  
						$this->cur = $_data['result'];
						$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
		  }
		  function getRecentBar(){
				$this->sql = "SELECT * FROM bar_data where status='1' order by created_on desc ";
				if($this->query()){
				return $this->loadAssoc();
			   }
		  }
		  function getCountryList()
		  {
			$this->sql = "SELECT * FROM countries";
				if($this->query()){
				return $this->loadAssoc();
			   }
		  }
		  function getCountryName($id)
		  {
			$this->sql = "SELECT * FROM countries where id=".$id ;
				if($this->query()){
				return $this->loadAssoc();
			   }
		  }
		  function getCities()
		  {
			$this->sql = "SELECT distinct(bar_city) FROM bar_data";
				if($this->query()){
				return $this->loadAssoc();
			   }
		  }
		  function mostRatedVideos()
		  {
			$this->sql = "select * from videos order by rating desc limit 0,4";
			if($this->query()){
				return $this->loadAssoc();
			   }
		  }

}
