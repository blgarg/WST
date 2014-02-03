<?php
		
class model_users_editUser extends JDatabaseMySQL
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
			function getUserData($user_id)
			{	 $this->sql = "SELECT * FROM users WHERE id =".$user_id;
				$this->query();
				return $this->loadAssoc();			
			}
						
			function saveData($data)
			{
			  
			$this->first_name = @mysql_real_escape_string(stripslashes($data->first_name));
			$this->last_name = @mysql_real_escape_string(stripslashes($data->last_name));
			$this->email_add = @mysql_real_escape_string(stripslashes($data->email_add));
			$this->phone_number = @mysql_real_escape_string(stripslashes($data->phone_number));
			$this->address = @mysql_real_escape_string(stripslashes($data->address));
			$this->password = $data->password;
			$this->country = @mysql_real_escape_string(stripslashes($data->country));
			$this->state = @mysql_real_escape_string(stripslashes($data->state));
		 	$this->modifydate = date('Y-m-d g:i:s');
			$this->user_id = $data->user_id;
			$this->emailexist = $this->emailExist($data->email_add,$data->user_id);

			if($this->emailexist) {
				$exit = 'Exist';
				return $exit;
				exit;
			}else {


				 $this->qry = "UPDATE users SET
						  first_name = '".$this->first_name."',
						  last_name  = '".$this->last_name."',
						  email  = '".$this->email_add."',
						  phone_number  = '".$this->phone_number."',
						  address  = '".$this->address."',
						  password = '".base64_encode($this->password)."',
						  country  = '".$this->country."',
						  state  = '".$this->state."',
						  
						  modified_on='".$this->modifydate."'
						  WHERE 
						  id=".$this->user_id;
				
				$this->sql = $this->qry;
					if($this->query()){return 'edit';}else{return $this->sql;}
				}
			 
			 }	
			 	
			function getvarp(){ return; }
			
			function emailExist($email,$userid){
			
			$this->sql = "SELECT * FROM users where email = '".addslashes($email)."' and id != '".$userid."' ";	
			$this->query();
			$array_aa = $this->getNumRows();
			
			if($array_aa > 0){
				return "1";
			}else{
				return "0";
			}
			
		}
		
		
		function countryList(){
		    $this->sql = "SELECT * FROM countries";	
			$this->query();
			return $this->loadAssoc();
		}	
		
		function stateListSelected($cId){
		   
		 $this->qry = "SELECT * FROM state WHERE cid = '".$cId."'";
		  $this->sql = $this->qry ;
		   $this->query();
		   return $this->loadAssoc();
	}			
			
}
