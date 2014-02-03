<?php
class model_index_tour extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){return true;}	
		  function getvarp(){return true;}
	      
		  function getRecentImages(){
				$this->sql = "SELECT * FROM images where status=1 order by created_on desc limit 15 ";
				if($this->query()){
				return $this->loadAssoc();
			   }
		  }
		   function getRecentVideos(){
				$this->sql = "SELECT * FROM videos where status=1 order by created_on desc limit 2 ";
				if($this->query()){
				return $this->loadAssoc();
			   }
		  }
		  function getTourHeader(){
		       $this->sql = "SELECT * FROM `cms_pages` WHERE `page_id` IN ( 4,3 ) ";
		       $this->query();
		       return $this->loadAssoc();
		  }
		   function getTourCms(){
		       $this->sql = "SELECT * FROM `cms_pages` WHERE `page_id`=20 ";
		       $this->query();
		       return $this->loadAssoc();
		  }
										
}
