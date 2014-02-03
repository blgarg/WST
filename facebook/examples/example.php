<?php
mysql_connect("localhost","root","root");
mysql_select_db("hga");
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require '../src/facebook.php';



// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '199417083513399',
  'secret' => 'd989e33d2f908ed8d4d1244ec67f9c2a',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl(array('next' => 'http://121.241.123.82:9040/HGA/facebook/examples/example.php',));
} else {
  $loginUrl = $facebook->getLoginUrl(array(
    'canvas' => 1,
    'fbconnect' => 0,
	'scope'=>'publish_stream,offline_access',
    'req_perms' => 'publish_stream,offline_access',
    'next' => 'http://121.241.123.82:9040/HGA/facebook/examples/example.php',
    'cancel_url' => 'http://121.241.123.82:9040/HGA/facebook/examples/example.php',
));
}

// This call will always work since we are fetching public data.
$naitik = $facebook->api('/naitik');

?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>php-sdk</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <h1>php-sdk</h1>

    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>

    <h3>PHP Session</h3>
    <pre><?php print_r($_SESSION); 
	if($_SESSION['fb_199417083513399_access_token']!=''){
	$token=$_SESSION['fb_199417083513399_access_token'];
$userid=$_SESSION['fb_199417083513399_user_id'];
$usercode=$_SESSION['fb_199417083513399_code'];
echo $str="UPDATE `tb_facebook_contents` SET `facebook_code` = '$usercode', `facebook_token` = '$token', `facebook_state` = '$userid' WHERE `tb_facebook_contents`.`id` = 1 LIMIT 1";
mysql_query($str);
}
	?></pre>

    <?php if ($user): ?>
      <h3>You</h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <h3>Your User Object (/me)</h3>
      <pre><?php print_r($user_profile); ?></pre>
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>

    <h3>Public profile of Naitik</h3>
    <img src="https://graph.facebook.com/naitik/picture">
    <?php echo $naitik['name']; 
	
?>
  </body>
</html>
