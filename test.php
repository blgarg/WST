<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>tunezy</title>
  </head>
  <body>
    <h1>tunezy</h1>
    <p><p><fb:login-button fields="name,birthday,gender,location,email" autologoutlink="true" onlogin="registerFaceBookUser()" >Register As a Fan</fb:login-button></p>

    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function(){
        FB.init({appId: '232137006809301', status: true, cookie: true,
                 xfbml: true});
      };
      (function() {
	  
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js?xfbml=1';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
	  
	  
    </script>
    
    
    
    
  </body>
</html>

<?php
ini_set('max_execution_time', 300); 
session_start();


$user = json_decode(file_get_contents('https://graph.facebook.com/me?'.trim($_COOKIE['fbs_232137006809301'],'"')));

echo "<pre>";
print_r($user);
echo "</pre>";
?>