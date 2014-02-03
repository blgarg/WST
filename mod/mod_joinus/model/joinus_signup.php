<?php
include('lib/paypal_pro.php');
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : 'phpBB3/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
require($phpbb_root_path . 'common.' . $phpEx);
require($phpbb_root_path . 'includes/functions_user.' . $phpEx);
require($phpbb_root_path . 'includes/functions_module.' . $phpEx);
class model_joinus_signup extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';  
          function __construct( $options='' ){ }   			   		   
		  function initialize(){ return true;
		  }	
		  function getvarp(){return true;}
		  function getCountryList(){
			$this->sql = "SELECT * FROM countries ";
			$this->query();
			return $this->loadAssoc();
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
		  function insertUser(){
		  if(@$_REQUEST['agreement'] !='' && @$_REQUEST['agreement']=='on'){
		  // Set sandbox (test mode) to true/false.
			$sandbox = TRUE;

			// Set PayPal API version and credentials.
			$api_version = '85.0';
			$api_endpoint = $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
			$api_username = $sandbox ? 'gurpre_1358227379_biz_api1.gmail.com' : 'LIVE_USERNAME_GOES_HERE';
			$api_password = $sandbox ? '1358227409' : 'LIVE_PASSWORD_GOES_HERE';
			$api_signature = $sandbox ? 'ADEWmSgtu4uztZI7IwI1nAEwqSAFAi6-53pwFajWhAfqXgQFUVRLTn00' : 'LIVE_SIGNATURE_GOES_HERE';

		  
		 $request_params = array
					(
					'METHOD' => 'DoDirectPayment', 
					'USER' => $api_username, 
					'PWD' => $api_password, 
					'SIGNATURE' => $api_signature, 
					'VERSION' => $api_version, 
					'PAYMENTACTION' => 'Sale', 					
					'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
					'CREDITCARDTYPE' => $_REQUEST['payment_type'], 
					'ACCT' => $_REQUEST['card_number'], 						
					'EXPDATE' => $_REQUEST['month'].$_REQUEST['year'], 			
					'CVV2' => urlencode($_REQUEST['cvv']), 
					'FIRSTNAME' => urlencode($_REQUEST['name_on_card']), 
					'LASTNAME' => @mysql_real_escape_string(stripslashes($_REQUEST['lastname'])), 
					'STREET' => @mysql_real_escape_string(stripslashes($_REQUEST['address'])), 
					'CITY' => @mysql_real_escape_string(stripslashes($_REQUEST['city'])), 
					'STATE' => @mysql_real_escape_string(stripslashes($_REQUEST['state'])), 					
					'COUNTRYCODE' => @mysql_real_escape_string(stripslashes($_REQUEST['country_name'])), 
					'ZIP' => '33770', 
					'AMT' => urlencode($_SESSION['price']), 
					'CURRENCYCODE' => 'USD', 
					'DESC' => 'Testing Payments Pro' 
					);
				
					$nvp_string = '';
					foreach($request_params as $var=>$val)
					{
						$nvp_string .= '&'.$var.'='.urlencode($val);	
					}

// Send NVP string to PayPal and store response
$curl = curl_init();
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_URL, $api_endpoint);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

$result = curl_exec($curl);
$result = explode('&',$result);
$httpParsedResponseAr = array();
		foreach ($result as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
		//print_r($httpParsedResponseAr["ACK"]);die;
			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
					$fname = @mysql_real_escape_string(stripslashes($_REQUEST['username']));
					$lname = @mysql_real_escape_string(stripslashes($_REQUEST['lastname']));
					$address = @mysql_real_escape_string(stripslashes($_REQUEST['address']));
					$city = @mysql_real_escape_string(stripslashes($_REQUEST['city']));
					$state = @mysql_real_escape_string(stripslashes($_REQUEST['state']));
					$country = @mysql_real_escape_string(stripslashes($_REQUEST['country_name'])); 
					$phone_no = @mysql_real_escape_string(stripslashes($_REQUEST['phone_no']));
					$email = @mysql_real_escape_string(stripslashes($_REQUEST['emailid']));
					$password = $_REQUEST['password'];
					
					$this->sql = "INSERT INTO `wst`.`users` (`id`, `first_name`, `last_name`, `email`, `password`, `address`, `phone_number`, `state`, `country`, `status`, `reset`, `created_on`, `modified_on`) VALUES ('', '".$fname."', '".$lname."', '".$email."', '". base64_encode($password)."', '".$address."', '".$phone_no."', '".$state."', '".$country."', '1', '', now(), now())";
					
					$abc = $this->query();
					$last_id = mysql_insert_id();
					$this->sql = "insert into payment_transaction(txn_id,amount,user_id,txn_date,payment_status,payment_type) values('".$httpParsedResponseAr['TRANSACTIONID']."','".$_SESSION['price']."','".$last_id."',now(),'complete','online')";
					$this->query();
					$get_username = explode('@',$email);
					
					$this->sql = "insert into phpbb_users(user_id,group_id,username,username_clean,user_password,user_email) values($last_id,2,'".$get_username[0]."','".$get_username[0]."','".phpbb_hash($password)."','$email')";
					$this->query();
					if($abc == '1'){
					$_SESSION['succ'] = "Your account has been created successfully.";$fromMail=$_REQUEST['email'];
				$to = $email;
				$subject = "WST Registration";
				$message = "Hello ". ucfirst($_REQUEST['username']." ". $_REQUEST['lastname'])."</p><p>Your account has been created successfully<br/>Login Email ID = ".$email."<br/>Password = ".$password."</p><p>Thanks <br/>WST</p>";

				$headers = 'From:'.$fromMail. "\r\n" .
				'Reply-To: admin@wst.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				if(mail($to, $subject, $message, $headers, '-fadmin@wst.com')) { 
				echo "yes";}else{echo"no";}
				@header('Location:index.php?mod=mod_index&view=login&s=5');
					
					
						/*$_SESSION['succ'] = "Your account has been created successfully.";
						$Mail = new Mail();
						$subject = "WST Registration";
						$message = "Hello ". ucfirst($_REQUEST['username']." ". $_REQUEST['lastname'])."</p><p>Your account has been created successfully<br/>Login Email ID = ".$email."<br/>Password = ".$password."</p><p>Thanks <br/>WST</p>";
						$Mail->to  = $email;
						$Mail->message =$message;
						$Mail->subject = $subject;
						if($Mail->send())
						{ echo "yes";}else{echo"no";}
						@header('Location:index.php?mod=mod_index&view=login&s=5');*/
						
						
					}else{
						$_SESSION['error'] = "Account unable to create.";
						@header('Location:index.php?mod=mod_joinus&view=signup&join='.$_REQUEST['join'].'&s=6');
						echo "Invalid Information";
					}
				} else  {
						$_SESSION['error'] = "Payment transaction error";
						$_SESSION['details'] = $_REQUEST;
						@header('Location:index.php?mod=mod_joinus&view=signup&join='.$_REQUEST['join'].'&s=6');
				}

curl_close($curl);

// Parse the API response
$result_array = NVPToArray($result);

echo "<pre>"; 
print_r($result_array);

// Function to convert NTP string to an array
function NVPToArray($NVPString)
{
	$proArray = array();
	while(strlen($NVPString))
	{
		// name
		$keypos= strpos($NVPString,'=');
		$keyval = substr($NVPString,0,$keypos);
		// value
		$valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
		$valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
		// decoding the respose
		$proArray[$keyval] = urldecode($valval);
		$NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
	}
	return $proArray;
}
}
		  }
		  

}
?>