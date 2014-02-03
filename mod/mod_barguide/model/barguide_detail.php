<?php
include('lib/paypal_pro.php');
class model_barguide_detail extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';  
          function __construct( $options='' ){ }   			   		   
		  function initialize(){ return true;
		  }	
		  function getvarp(){return true;}
			// view bar details
		 function getBarDetail($id)
		 {
			$this->sql = "SELECT b.*,c.*,t.* FROM bar_data b left join countries c on b.bar_country= c.id left join type t on b.bar_type=t.id where b.id=".$_GET['id'];
			$this->query();
			return $this->loadAssoc();
	 	 }
		 function getCountryList(){
			$this->sql = "SELECT * FROM countries ";
			$this->query();
			return $this->loadAssoc();
		  }
		  
		  
		  

}
?>