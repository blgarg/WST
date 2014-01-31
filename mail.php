<?php
//Simple mail Function
 $to = "jsingh13@mt2014.com";
            $subject = "Hello";
            $msg = "Test";
            $from = "abhisheks.net@gmail.com";
            $headers = "From: $from";
            mail($to,$subject,$msg,$headers);
            echo "Mail Send";

   
//Using SMPT
<?php
require '/PHPMailer/class.phpmailer.php';

$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'localhost';                 // Specify main and backup server
$mail->Port = 25;                                    // Set the SMTP port
$mail->SMTPAuth = false;                               // Enable SMTP authentication
$mail->Username = 'admin@wst.com';                // SMTP username
$mail->Password = 'admin';                  // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'admin@wst.com';
$mail->FromName = 'jas';
$mail->AddAddress('amit82nanda@gmail.com', 'Josh Adams');  // Add a recipient
             

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <strong>in bold!</strong>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';
	?>
	
	



