<?php
		
class model_users_detailUser extends JDatabaseMySQL
{  			
          var $tableName;
		  var $first_name;
		  var $last_name;
		  var $password;
		  var $email_add;
		  var $phone_number;
		  var $address;
		  var $created_date;

		  var $user_id;
		  var $page_title_link='';
		  var $qry = '';  
		  var $_result = '';     
		  var  $strdate   = '';                
         	function __construct(){}
		  	function initialize(){ return ;}	
			function getUserData($data)
			{	
			    $this->sql = "SELECT * FROM mgl_users,country WHERE user_id ='".$data['user_id']."' AND country.id=mgl_users.country";
			    $this->query();
				$this->_result = $this->getArray();   				
				return $this->_result;			
			}
			
			function getStateName($id){
			    
				$this->sql = "SELECT * FROM state WHERE id ='".$id."'";
			    $this->query();
				$this->_result = $this->getArray();   				
				return $this->_result['name'];
			}
						
			
			 	
			function getvarp(){ return; }
			
					
			
}
