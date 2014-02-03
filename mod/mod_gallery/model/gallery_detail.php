<?php
class model_gallery_detail extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = ''; 
		 
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
				return true;
			}	
		  function getvarp(){return true;}
	     
		 function getDetail($id)
		 {
			$this->sql = "SELECT * FROM images where id=".$id;
			$this->query();
			return $this->loadAssoc();
		 }
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
				$qryP = "UPDATE users  SET reset='".md5($randPas)."' WHERE id=".$userData['id'];
				$JDatabaseMySQL->sql = $qryP;
				if($JDatabaseMySQL->query())
				{
					
				echo $message = '<p>Hello '.ucfirst($userData['first_name']." ".$userData['last_name']).', </p>
									<p>To change your password please click on the <a href="'.$config_var->WEB_URL.'?mod=mod_index&view=resetpass&s=5&id='.$userData['id'].'&reset='.md5($randPas).'">link</a></p>
									<p>Thanks <br />WST</p>';
					die;
					$Mail->to  = $user_email;
					$Mail->message =$message;
					if($Mail->send())
					{ echo "yes";}else{echo"no";}
					
				}
			}
			else
			{
				$_SESSION['error'] = "Email does not match.";
				header("Location:".$config_var->WEB_URL."?mod=mod_index&view=forgot&s=5"); die;
			}
		}
		}
		 
}	
?>