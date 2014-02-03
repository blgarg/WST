<?php
//define('IN_PHPBB', true);
//$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../phpbb3/';
//$phpEx = substr(strrchr(__FILE__, '.'), 1);
//require($phpbb_root_path . 'common.' . $phpEx);
//require($phpbb_root_path . 'includes/functions_user.' . $phpEx);
//require($phpbb_root_path . 'includes/functions_module.' . $phpEx);				
class model_users_addNewUser extends JDatabaseMySQL{  			
          var $tableName;
		  var $first_name;
		  var $last_name;
		  var $password;
		  var $email_add;
		  var $phone_number;
		  var $address;
		  var $created_date;
		  var $page_title_link='';
		  var $qry = '';  
		  var $_result = '';  
		  var $strdate='';                   
          function __construct(){}
		  // parent::__query($this->qry);	
			function initialize(){
					 
			}	
		
		function insertMembership($arg1, $arg2,$arg3)
		{
			$membership_plan_data = $this->membership_plan_data($arg2);
			//echo "<pre>"; print_r($arg3); die;
			
		$this->qry = "insert into user_membership_relation(user_id,membership_id,start_date,expiry_date) values(".$arg1.",".$arg2.",'".date("Y-m-d h:i:s")."','".date("Y-m-d h:i:s", strtotime("+".+$membership_plan_data[0]['period']." years", time()))."')";
			$this->sql = $this->qry;
			$this->query();
			$characters = 'ABCDEFG0123456789';
			$string = '';
			 for ($i = 0; $i < strlen($characters); $i++) {
				  $string .= $characters[rand(0, strlen($characters) - 1)];
			 }
			 $this->qry = "insert into payment_transaction(txn_id,amount,user_id,membership_plan,txn_date,payment_status,payment_type) values('".$string."',".$membership_plan_data[0]['price'].",".$arg1.",'".$membership_plan_data[0]['title']."',now(),'".$arg3."','offline')";
			
			$this->sql = $this->qry;
			$this->query();
			
		}
		function inserData($data)
		{
			$this->first_name = @mysql_real_escape_string(stripslashes($data->first_name));
			$this->last_name = @mysql_real_escape_string(stripslashes($data->last_name));
			$this->password = @mysql_real_escape_string(stripslashes($data->password));
			$this->email_add = @mysql_real_escape_string(stripslashes($data->email_add));
			$this->phone_number = @mysql_real_escape_string(stripslashes($data->phone_number));
			$this->address = @mysql_real_escape_string(stripslashes($data->address));
			
			$this->country = @mysql_real_escape_string(stripslashes($data->country));
			$this->state = @mysql_real_escape_string(stripslashes($data->state));
			
			$this->strdate = date('Y-m-d g:i:s');
			
			
			
			$this->emailexist = $this->emailExist($data->email_add);
			
			if($this->emailexist) {
				$exit = 'Exist';
				return $exit;
				exit;
			}else {
			
					$this->qry = "INSERT INTO users(
					first_name,
					last_name,
					password,
					email,
					address,
					phone_number,
					country,
					state,

					created_on,
					modified_on,
					status
					) VALUES
					(
					
					'".$this->first_name."',
					'".$this->last_name."',
					'".base64_encode($this->password)."',
					'".$this->email_add."',
					'".$this->address."',
					'".$this->phone_number."',
					'".$this->country."',
					'".$this->state."',
					'".$this->strdate."','".date('Y-m-d h:i:s')."',
					'1'
					)";
					
				
					$this->sql = $this->qry;
					if($this->query()){
					
					$returnData[0] =  mysql_insert_id();
					$returnData[1] = "added";
					//$get_username = explode('@',$this->email_add);
					//echo $this->sql = "insert into phpbb_users(user_id,group_id,username,username_clean,user_password,user_email) values(".$returnData[0].",2,'".$get_username[0]."','".$get_username[0]."','".phpbb_hash($this->password)."','".$this->email_add."')";
					//die;$this->query();
					return $returnData;}else{return false;}
			}
			
		}
													
		 function getvarp(){
				$_data = $this->get_page_nav();  
				$this->cur = $_data['result'];
				$result_set = $this->loadAssoc();
				return array('result'=>$result_set,'nav'=>$_data['nav']);
		}
		
													
		function numRow(){	
			$this->setQuery($this->qry);
			$array_aa = $this->getNumRows();
			return $array_aa;
		
		}			
		function emailExist($email){
			
			$this->sql = "SELECT * FROM users where email = '".addslashes($email)."'";	
			$this->query();
			$array_aa = $this->getNumRows();
			
			if($array_aa > 0){
				return true;
			}else{
				return false;
			}
			
		}
		function membership_list()
		{
			$this->sql = "select * from membership_plans";
			$this->query();
			return $this->loadAssoc();
		}
		function membership_plan_data($data)
		{
			$this->sql ="select * from membership_plans where id=".$data; 
			$this->query();
			return $this->loadAssoc();
		}
		function countryList(){
		    $this->sql = "SELECT * FROM countries";	
			$this->query();
			return $this->loadAssoc();
		}			
		function getUserData($user_id)
			{	$this->sql = "SELECT * FROM users WHERE user_id =".$user_id;
				$this->query();
				return $this->loadAssoc();			
			}
					
}
?>
