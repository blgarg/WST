<?php
class model_joinus_default extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct($options='' )
		  {
		  }   			   		   
		  function initialize()
		  { 
			return true;
		  }	
		  function getvarp()
		  {
			return true;
		  }
		  function getRecentImages(){
				$this->sql = "SELECT * FROM images order by created_on desc limit 0,8 ";
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
		  	//Fetch Country name from id
			function getCountryNameById($id){
		  
		   $this->sql = "SELECT * from countries where id=$id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}

}
