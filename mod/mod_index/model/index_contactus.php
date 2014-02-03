<?php
class model_index_contactus extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = ''; 
		 
          function __construct( $options='' ){ }   			   		   
		  function initialize(){ return true;}	
		  function getvarp(){return true;}
	    function sendMail()
		 {
$fromMail=$_REQUEST['email'];
$to = 'ultradrake69@yahoo.com';
$subject = $_REQUEST['subject'];
$message = '<p>Hello WST Support </p>
				<p>'.$_REQUEST['message'].'</p>
				<p>Thanks <br />'.$_REQUEST['yname'].'<br/>'.$_REQUEST['email'].'';
                $headers = 'From:'.$fromMail. "\r\n" .
               'Reply-To: admin@wst.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
            if(mail($to, $subject, $message, $headers, '-fadmin@wst.com')) { 
				$_SESSION['succ'] = "Your message has been sent our support team<br/>They contact you shortly";
		        header("Location:".$config_var->WEB_URL."?mod=mod_index&view=contactus"); die;
			}else{echo"no";}	
			/*$Mail = new Mail();
			$message = '<p>Hello WST Support </p>
				<p>'.$_REQUEST['message'].'</p>
				<p>Thanks <br />'.$_REQUEST['yname'].'<br/>'.$_REQUEST['email'].'</p>';
			$Mail->to="ultradrake69@yahoo.com";
			$Mail->subject = $_REQUEST['subject'];
			$Mail->message=$message;
			if($Mail->send())
			{ 
				$_SESSION['succ'] = "Your message has been sent our support team<br/>They contact you shortly";
				header("Location:".$config_var->WEB_URL."?mod=mod_index&view=contactus"); die;
			}else{echo"no";}*/
			
		 }
		 
		  
}


?>