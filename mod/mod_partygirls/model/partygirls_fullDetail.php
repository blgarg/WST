<?php
class model_partygirls_fullDetail extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = ''; 
		 
          function __construct( $options='' ){ }   			   		   
		  function initialize(){ return true;}	
		  function getvarp(){return true;}
		 // fetch gallery Detail
		  function getData($id){
			$this->sql = "SELECT * FROM party_girls_images where id=".$id;
			$this->query();
			return $this->loadAssoc();
			}
	     function calcRating($gid,$img)
		{
			 $this->sql = "SELECT count(*) as count FROM image_rating WHERE gallery_id=".$gid." and image_name='".$img."'";
				$this->query();
				$this->_result = $this->getArray();   				
				
			$this->sql = "select sum(rating) as total FROM image_rating WHERE gallery_id=".$gid." and image_name='".$img."'";		
			$this->query();
			$total_rating = $this->getArray();   				
			
			$rating = ceil($total_rating['total']/$this->_result['count']);
			return $rating;
		}
		function countryName($id){
			$this->sql = "SELECT * FROM countries where id=".$id;
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