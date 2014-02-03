<?php
class model_index_forgot extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = ''; 
		 
          function __construct( $options='' ){ }   			   		   
		  function initialize(){ return true;}	
		  function getvarp(){return true;}
	     
		function checkEmail($email){
		 global $config_var;
			if($email){
			$JDatabaseMySQL = new JDatabaseMySQL();
			$Mail = new Mail();
			$randPas = Helper::createPassword(6);
			$user_email = htmlspecialchars(trim($email),ENT_QUOTES);
			$randPas = Helper::createPassword(6);
			$qry = "SELECT * FROM users WHERE email ='$user_email' ";
			$JDatabaseMySQL->sql = $qry;
			$JDatabaseMySQL->query();
			$IsUser =  $JDatabaseMySQL->getNumRows(); 
			if($IsUser>0)
			{
			$userData = $JDatabaseMySQL->getArray();
			$qryP = "UPDATE users  SET reset='".base64_encode($randPas)."' WHERE id=".$userData['id'];
			$JDatabaseMySQL->sql = $qryP;
			if($JDatabaseMySQL->query())
				{
		$to = $user_email;
        $subject = "Change password request";
        $message = '<p>Hello '.ucfirst($userData['first_name']." ".$userData['last_name']).', </p>
			<p>To change your password please click on the <a href="'.$config_var->WEB_URL.'?mod=mod_index&view=resetpass&s=5&id='.$userData['id'].'&reset='.base64_encode($randPas).'">link</a></p>
									<p>Thanks <br />WST</p>';
	           $headers = 'From:admin@wst.com'."\r\n" .
               'Reply-To: admin@wst.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
            if(mail($to, $subject, $message, $headers, '-fadmin@wst.com')) { 
				$_SESSION['succ'] = "Password reset link has been sent to your mail";
						header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5"); die;
					}else{echo"no";}		
				/*$message = '<p>Hello '.ucfirst($userData['first_name']." ".$userData['last_name']).', </p>
									<p>To change your password please click on the <a href="'.$config_var->WEB_URL.'?mod=mod_index&view=resetpass&s=5&id='.$userData['id'].'&reset='.base64_encode($randPas).'">link</a></p>
									<p>Thanks <br />WST</p>';
					
					$Mail->to  = $user_email;
					$Mail->message =$message;
					if($Mail->send())
					{ 
						$_SESSION['succ'] = "Password reset link has been sent to your mail";
						header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5"); die;
					}else{echo"no";}*/
					
				}
			}
			else
			{
				$_SESSION['error'] = "Invalid Email address";
				header("Location:".$config_var->WEB_URL."?mod=mod_index&view=forgot&s=5"); die;
			}
		}
		}
		 
}	
?>