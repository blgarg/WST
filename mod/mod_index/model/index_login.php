<?php
class model_index_login extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
		 
		  return true;}	
		  function getvarp(){return true;}
	      
		  function userLogin($email, $pass){
			 $this->sql = "SELECT *
								FROM `users`
								WHERE `email` = '".$email."'
								AND `password` = '".base64_encode($pass)."'
								"; 
			
			$this->query();
			//return $this->getNumRows($this->sql); 
			 return $this->loadAssoc();
			  
		}
		function userPaymentStatus($id){
			$this->sql = "SELECT * FROM  `payment_transaction` WHERE user_id = ".$id ;
			$this->query();
			 return $this->loadAssoc();
		}		
											
}
