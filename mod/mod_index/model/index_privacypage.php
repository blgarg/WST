<?php
class model_index_privacypage extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
		  return true;}	
		  function getvarp(){return true;}
		
		function getPrivacyPage(){
			$this->sql = "SELECT * FROM `cms_pages`";
			$this->query();
			return $this->loadAssoc();
		}
		
	}
						
													
?>
