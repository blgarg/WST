<?php
$to = 'jsingh13@mt2014.com';
$subject = 'Test email using PHP';
$message = 'This is a test email message';
$headers = 'From: admin@wst.com' . "\r\n" .
           'Reply-To: admin@wst.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $headers, '-fadmin@wst.com');
?>