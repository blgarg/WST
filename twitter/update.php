<?php

//include 'db.php';
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';
$message="Your Status update";
/*$tw_sql=mysql_query("select oauth_token,oauth_token_secret from users where user='$user_session'");
$row=mysql_fetch_array($tw_sql);*/
$consumerKey='lsHAiSO5F4GKzRnrPQ';
$consumerSecret='Ve6pKz4o0MjqZfGUhSiCXsVP65D1cQEB0U4IaXTDKtk';
$oauth_token='557823522-AMzMhTP9QW82i4aTAj1KOa2pPUukT6p9mfjX0fse';
$oauth_token_secret='N3tU4wJiWlJhK5kznz8JLdDwLYGS49ACVgMKNZABCM';

if(strlen($oauth_token)>0 || strlen($oauth_token_secret)>0 )
{
echo $oauth_token."<br>";
echo $oauth_token_secret;
$Twitter = new EpiTwitter($consumerKey, $consumerSecret);
$Twitter->setToken($oauth_token,$oauth_token_secret);
//$message Status update
$status=$Twitter->post_statusesUpdate(array('status' => $message));
$status->response;
}
?>