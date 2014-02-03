<?php

/*$message = '<p>Hello Sir/Mam, </p>
			<p>'.@nl2br($_REQUEST['mess']).'</p>
			<p>Thanks <br />'.@$_REQUEST['name'].'</p>';

$mailing = new mailing();
$mailing->to = "blgarg@gmail.com";
$mailing->from = @$_REQUEST['u_email'];
$mailing->message =$message;
$mailing->subject = @$_REQUEST['u_sub'];
if($mailing->send()){ echo "yes";}else{echo"no";}*/

class Mail{
var $to = '';
var $from  = '';
var $header = '';
var $message = '';
var $subject = '';
var $webName = '';

function __construct()
{ 
		$JDatabaseMySQL = new JDatabaseMySQL();
    	$qry = "SELECT * FROM admin WHERE id ='1'";
		$JDatabaseMySQL->sql = $qry;
		$JDatabaseMySQL->query();
		$settings = $JDatabaseMySQL->getArray();
		$this->webName = "WST";
		$this->from =  "info@wst.com";
		$this->subject  = "Reset Password";
			
 }
							
					
function send(){
		$this->headers = "Reply-To: $this->webName < $this->from >\r\n"; 
		$this->headers .= "Return-Path: $this->webName < $this->from >\r\n"; 
		$this->headers .= "From: $this->webName < $this->from >\r\n"; 
		$this->headers .= "MIME-Version: 1.0\r\n";
		$this->headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$this->headers .= "X-Priority: 3\r\n";
		$this->headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;
		
		if(mail($this->to,$this->subject,$this->message,$this->headers)){
			return true;
		}else{
			return false;
		}
}	
					
function  getVar(){	return  $arr = array($this->to,$this->message,$this->from,$this->subject,$this->header);}											
}



?>