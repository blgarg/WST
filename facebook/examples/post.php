<?php 
mysql_connect("localhost","root","root");
mysql_select_db("hga");
require '../src/facebook.php';
$str="select * from tb_facebook_contents where id=1";
$rs=mysql_query($str);
$row=mysql_fetch_array($rs);
$accesstoken=$row['facebook_token'];
echo $accesstoken;
$app_id="199417083513399"; 
$app_secret="d989e33d2f908ed8d4d1244ec67f9c2a";  
 // Init facebook api. 
$facebook = new Facebook(array(
  'appId'  => '199417083513399',
  'secret' => 'd989e33d2f908ed8d4d1244ec67f9c2a',
));

$facebook->setAccessToken($accesstoken);
 // Get the url to redirect for login to facebook 
 // and request permission to write on the user's wall.
 //$login_url=$facebook->getLoginUrl(array('scope'=>'publish_stream')); 
 print_r($facebook->api('/me/feed',"post",array('message' => 'this is a last test...','link'=>'http://www.youtube.com/watch?v=LqjAyBX1lQ4&feature=youtu.be')));

 //$facebook->api("/me/feed","post",array('access_token'=>"$accesstoken",message=>"YOUR_MESSAGE",picture=>"https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/372661_100001445376769_209675685_n.jpg",link=>"YOUR_LINK",name=>"YOUR_LINK_NAME",caption=>"YOUR_CAPTION")); 
 //$token =  array(
   // 'access_token' =>$accesstoken
//);
//$userdata = $facebook->api('/me', 'GET', $token);
  ?>