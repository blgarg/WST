<?php
class model_index_resetpass extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
		  if(isset($_GET['reset']) && isset($_GET['id']) && $_GET['id']!=''  && $_GET['reset']!='')
			{
				 $qry = "select count(*) as count from users where id=".$_GET['id']." and reset='".$_GET['reset']."'";
				$this->sql = $qry;
				$this->query();
				$userCount = $this->getArray();
				if($userCount['count']==0)
				{
					 $_SESSION['error'] = "Wrong URL";
					
					header("Location:".$config_var->WEB_URL."?mod=mod_index&view=resetpass");
					die;
				}
			}
		  }	
		  function getvarp(){return true;}
	      
	function resetPass()
		{
			global $config_var;
			$JDatabaseMySQL = new JDatabaseMySQL();
			if(isset($_GET['reset']) && isset($_GET['id']) && $_GET['id']!=''  && $_GET['reset']!='')
			{
			$qry = "select count(*) as count from users where id=".$_GET['id']." and reset='".$_GET['reset']."'";
			$JDatabaseMySQL->sql = $qry;
			$JDatabaseMySQL->query();
			$userCount = $JDatabaseMySQL->getArray();
			//echo $userCount['count'];die;	
			if($userCount['count']==0)
				{
					 $_SESSION['error'] = "Wrong URL";
					
					header("Location:".$config_var->WEB_URL."?mod=mod_index&view=forgot&s=5");
				}
				else
				{
					$qryP = "UPDATE users  SET password ='".base64_encode($_POST['new_password'])."' ,reset='' WHERE id=".$_REQUEST['id'];
					$JDatabaseMySQL->sql = $qryP;
					$JDatabaseMySQL->query();
					$_SESSION['succ'] = "Password has been changed.";
					header("Location:".$config_var->WEB_URL."?mod=mod_index&view=login&s=5");
				}
			}
		}													
}
