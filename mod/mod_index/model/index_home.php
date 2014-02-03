<?php
class model_index_home extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){return true;}	
		  function getvarp(){return true;}
	      
		  function getRecentImages(){
				//$this->sql = "SELECT * FROM images order by created_on desc limit 12 ";
				//Updated on 23 July 2013
				$this->sql = "SELECT * FROM images order by created_on desc limit 12 ";
				if($this->query()){
				return $this->loadAssoc();
			   }
		  }
		  
		  function mostRatedVideos()
		  {
			$this->sql = "select * from videos where status=1 order by rating desc limit 4";
			if($this->query()){
				return $this->loadAssoc();
			   }
		  }
		  function getRecentVideos()
		  {
			$this->sql = "select * from videos where status=1 order by created_on desc limit 12";
			if($this->query()){
				return $this->loadAssoc();
			   }
		  }
		
		function getCountryList(){
		  
		   $this->sql = "SELECT * from countries";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		//Fetch Country name from id
			function getCountryName($id){
		  
		   $this->sql = "SELECT * from countries where id=$id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		 //Get Featured images
		    function getFeaturedImages()
		  {
			$this->sql = "select * from images where featured=1 order by RAND()";
			
			if($this->query()){
				return $this->loadAssoc();
			   }
		  }

		function getTourHeader(){
		  $this->sql = "SELECT * FROM `cms_pages` WHERE `page_id` IN ( 4,3 ) ";
		  $this->query();
		  return $this->loadAssoc();
		  }
		function upcomingData(){
		$this->sql = "SELECT * FROM `upcoming_image`";
		  $this->query();
		  return $this->loadAssoc();
		}
					
													
}
