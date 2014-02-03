<?php
class model_index_termspage extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
		  return true;}	
		  function getvarp(){return true;}
		
		function getTermsPage(){
			$this->sql = "SELECT * FROM `cms_pages`";
			$this->query();
			return $this->loadAssoc();
		}
		
	}
						
													
?>
