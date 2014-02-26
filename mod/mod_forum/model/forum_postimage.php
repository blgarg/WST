<?php

class model_forum_postimage extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		    function initialize(){
					
			}
			function getvarp(){
				}
					
		  function getAllPostImagesId($id){
		  		$this->sql = "SELECT * from `posts_image` where id='".$id."'";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
}
