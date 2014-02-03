<?php
		
class model_users_editadmin extends JDatabaseMySQL
{  			
          var $tableName;
		  var $user_display_name;
		  var $user_name;
		  var $password;
		  var $email_add;
		  var $phone_number;
		  var $Npassword;
		  var $created_date;

		  var $user_id;
		  var $page_title_link='';
		  var $qry = '';  
		  var $_result = '';     
		  var  $strdate   = '';                
         	function __construct(){}
		  	function initialize(){ return ;}	
			function getUserData($data)
			{	$this->sql = "SELECT * FROM admin WHERE id ='".$data."'";
				
				$this->query();			
				return $this->loadAssoc();			
			}
						
			function saveData($data)
			{
				
			$this->user_name = @mysql_real_escape_string(stripslashes($data->user_name));
			 $this->user_email = @mysql_real_escape_string(stripslashes($data->email));
			$this->user_id = $data->user_id;
			$this->password = md5($data->password);
			
			echo $this->qry = "UPDATE admin SET
						  password  = '".$this->password."'
						  WHERE 
						  id='".$this->user_id."'";
			//echo $this->qry ;die;			  
		
				$this->sql = $this->qry;
					if($this->query()){return 'edit';}else{return false;}
				
			 
			 }	
			 	
			function getvarp(){ return; }
			
			function emailExist($email,$userid){
			
			$this->sql = "SELECT * FROM mgl_users where user_email = '".addslashes($email)."' and user_id != '".$userid."' ";	
			$this->query();
			$array_aa = $this->getNumRows();
			
			if($array_aa>0){
				return true;
			}else{
				return false;
			}
			
		}
		
		
		function countryList(){
		    $this->sql = "SELECT * FROM country";	
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
