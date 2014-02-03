<?php 
 include '../settings.php';
 require_once('../inc/load.php');
 require_once('facebook-php/src/facebook.php');	
 
class usersModel extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	
function getStateList($cId)
	{	
		           $this->qry = "SELECT * FROM state WHERE cid = '".$cId."'";
					$this->sql = $this->qry;
					$this->query();
					//$Rcdrs =  $this->getNumRows();
					$UserData = $this->loadAssoc();
					//$arrResult =  $this->loadAssoc();
					return $UserData;
	}

function getPlayList(){
	 $session = new session();
	 $userId= $session->getVar("userAccountID");
	$this->sql = "SELECT * FROM mgl_users_playlist WHERE playlist_user_id='".$userId."'";
	 $this->query();	
	 $this->_result = $this->loadAssoc();
	 return $this->_result;
	}
	
function userRegistration($arr){
	
    	session_start();
	    $this->qry = "SELECT user_email,user_name FROM mgl_users WHERE user_email = '".$arr['email_add']."' ";
		$this->sql = $this->qry;
		$this->query();
	    $UserData = $this->loadAssoc();
	// print_r($UserData);
	  if(count($UserData)>0){
	//  echo 'user exist';
	     if($arr['email_add']==$UserData[0]['user_email']){
		  echo  'email exist';
		 }else{
		 echo  'user exist';
		 }
	  }else{
	   $strdate = date('Y-m-d g:i:s');
	   $strrole = 'user';
	   $sessioToken='';
	   $arr['isyoutubeauth']='0';
	   
	   /*if($arr['isyoutubeauth']==1){
	    $sessioToken=isset($_SESSION['sessionToken']) ? $_SESSION['sessionToken'] : '' ;
	   }
	   */
	    $arr['phone_number']='';
		$arr['address']='';
		$arr['insp']='';
		$arr['facebook_URL']= '';
		$arr['twitter_URL']= '';
	   
	   if($arr['type']=='2'){
	    $sessioToken='';
		$arr['subscriber']='0';
		
		$arr['bio']='';
	   }
	  $config = new config();
	  
	  $arr['profilePic']= $config->WEB_TPL_URL."images/nouser.png";
	  
	   $facebookToken = isset($_COOKIE['fbs_172091782856668']) ? trim($_COOKIE['fbs_172091782856668'],'"') : '';
	 $this->qry = "INSERT INTO mgl_users(
					user_id,
					user_firstname,
					user_lastname,
					user_name,
					facebookUsername,
					password,
					dateofbirth,
					gender,
					user_email,
					user_phonenum,
					country,
					state,
					stateText,
					user_address,
					bio,
					insp,
					facebook_url,
					twitter_url,
					type,
					youTubeProfilepic,
					sessionToken,
					facebookToken,
					subscriber,
					isyoutubeauth,
					date_created,
					date_updated,
					user_role,
					is_active,
					is_recentActivity
					) VALUES
					(
					NULL,
					'".$arr['first_name']."',
					'".$arr['last_name']."',
					'".$arr['username']."',
					'".$arr['facebookusername']."',
					'".md5($arr['password'])."',
					'".$arr['birth_date']."',
					'".$arr['gender']."',
					'".$arr['email_add']."',
					'".$arr['phone_number']."',
					'".$arr['country']."',
					'".$arr['state']."',
					'".$arr['stateText']."',
					'".$arr['address']."',
					'".$arr['bio']."',
					'".$arr['insp']."',
					'".$arr['facebook_URL']."',
					'".$arr['twitter_URL']."',
					'".$arr['type']."',
					'".mysql_real_escape_string($arr['profilePic'])."',
					'".$sessioToken."',
					'".$facebookToken."',
					'".$arr['subscriber']."',
					'".$arr['isyoutubeauth']."',
					'".$strdate."',
					'".$strdate."',
					'".$strrole."',
					'0',
					'1'
					)";
					
				
					$this->sql = $this->qry;
					$this->query();
					$userId = $this->insertid();
					
					if(trim($arr['facebookusername'])!=''){
					   $this->qry = "INSERT INTO users(`userId`,`facebookId`)VALUES('".$userId."','".$arr['facebookusername']."')";
			           $this->sql = $this->qry;
					  //$exec = mysql_query($query) or mysql_error();
					  $this->query();
					}
					
					setcookie ("fbs_172091782856668", "", time() - 3600);
					$linkUserActivity = mysql_real_escape_string("<a href='#' onclick=\"getPublicProfile('".$userId."','".$arr['type']."')\">".ucfirst($arr['first_name'])."&nbsp;&nbsp;".ucfirst($arr['last_name'])."&nbsp;has joined Tunezy.</a>");

					$recentQuery = "INSERT INTO mgl_recent_activities(id,

					 		   name,
							   date_modified,
							   date_created
							   )
							   VALUES(NULL,
							   '".$linkUserActivity."',
							   '".$strdate."',
							   '".$strdate."'
							   )";
					$this->isActivity("user",$userId); 			   
					$this->sql = $recentQuery;
					$this->query();
				
					$config_var = new config(); 
					$mailObj = new Mail();
					$mailObj->to = $arr['email_add'];
					$mailObj->message="<p>Hello ".ucfirst($arr['first_name']).' '.$arr['last_name']."</p>";
                    $mailObj->message.="<p>Thanks for your registration with tunezy.com</p>";
                    $mailObj->message.="<p>Username:".$arr['email_add']."<br>" ;
					$mailObj->message.="Password:".$arr['password']."</p>" ;
					$mailObj->message.="<p>Please click the link below to confirm your registration.<br>";
                    $mailObj->message.= "<a href='".$config_var->WEB_URL."?ucode=".base64_encode($arr['email_add'])."&vrifycode=".md5($arr['password'])."&action=confirm' target='_blank'>Click Here</a></p>";
                    $mailObj->message.="<p>Thank You,<br />";
                    $mailObj->message.="Tunezy</p>";
					$mailObj -> send();
					
					echo '<div class="sign_up-outer"> <div class="sign_up-Midbg"><table> <tr> <td>Thanks <strong>'.ucfirst($arr['first_name']).'</strong> for register with the tunezy.com. A confirmation mail has been sent to your email address. Please click on the  activation link to activate your account. After activation you will be able to login on the site.</td></tr></table> </div><img src="'.$config_var->WEB_TPL_URL.'images/sign_up-BtmBg.png" alt="" style="position:relative; bottom:5px; z-index:3333;" /><div class="cross_icon"><a href="javascript:;" title="Close"><img src="'.$config_var->WEB_TPL_URL.'images/cross_icon.png" alt="" onclick="closePopUp(\'chose_option\')"/></a></div>';
	   }
	}
	
	
function userLogin($arr){
	
	  $this->qry = "SELECT * FROM mgl_users WHERE user_email = '".$arr['username']."' AND  password = '".md5($arr['loginpassword'])."' AND is_active = '1' ";
	  $this->sql = $this->qry;
	  $this->query();
	  $isUser = $this->getNumRows();
	  $userDATA = $this->getArray();
	  if($isUser >0)
	  {	
		if($arr['remember'] == '1'){
		setcookie("frontcookname", $arr['username'], time()+60*60*24*100, "/");
        setcookie("frontcookpass", base64_encode($arr['loginpassword']), time()+60*60*24*100, "/");
		}else{
		 setcookie("frontcookname", $arr['username'], time()-60*60*24, "/");
         setcookie("frontcookpass", base64_encode($arr['loginpassword']), time()-60*60*24, "/");
        }
	    $session = new session();
		$session->setSessionId('userSessionID');
		$session->setVar("userAccountID",$userDATA['user_id']);
        $session->setVar("userType",(int)$userDATA['type']);
		echo (int)$userDATA['type'];
        $_SESSION['authenticate'] = true ;
		}else{echo '0';}
	}
	
function resetandsendPassword($arr){
              //print_r($arr);
              $this->qry = "SELECT * FROM mgl_users WHERE user_email = '".$arr['user_email']."' ";
			  $this->sql = $this->qry;
	          $this->query();
			  $isUser = $this->loadAssoc();
			   $config_var = new config(); 
			  if(count($isUser)>0){
              $pass = self :: gen_trivial_password();
			  $this->qry = "UPDATE mgl_users SET  password = '".md5($pass)."' WHERE user_email = '".$arr['user_email']."' ";
			  $this->sql = $this->qry;
	          $this->query();
			  $mailObj = new Mail();
			  $mailObj->to = $arr['user_email'];
			  $mailObj->message="<p>Hello ".ucfirst($isUser[0]['user_firstname']).' '.$isUser[0]['user_lastname']."</p>";
              $mailObj->message.="<p>Below is your login detail</p>";
			  $mailObj->message.="<p>Username:".$arr['user_email']."</p>";
			  $mailObj->message.="<p>Password:".$pass."</p>";
			  $mailObj->message.="<p>Thank You,<br />";
              $mailObj->message.="Tunezy</p>";
			  @$mailObj -> send();
			 
			  echo '<div class="sign_up-outer"> <div class="sign_up-Midbg" style="height:100px;"><table> <tr> <td>Hello <strong>'.ucfirst($isUser[0]['user_firstname']).'</strong> your new password has been sent to your email address please check it.</td></tr></table> </div><img src="'.$config_var->WEB_TPL_URL.'images/sign_up-BtmBg.png" alt="" style="position:relative; bottom:5px; z-index:3333;" /><div class="cross_icon"><a href="javascript:;" title="Close"><img src="'.$config_var->WEB_TPL_URL.'images/cross_icon.png" alt="" onclick="closePopUp(\'chose_option\')"/></a></div>';
			 }else{
			   echo '<div class="sign_up-outer"> <div class="sign_up-Midbg" style="height:100px;"><table> <tr> <td>We are not able to find your email address in our database.</td></tr></table> </div><img src="'.$config_var->WEB_TPL_URL.'images/sign_up-BtmBg.png" alt="" style="position:relative; bottom:5px; z-index:3333;" /><div class="cross_icon"><a href="javascript:;" title="Close"><img src="'.$config_var->WEB_TPL_URL.'images/cross_icon.png" alt="" onclick="closePopUp(\'chose_option\')"/></a></div>';
			  }
  } 
	
	
function gen_trivial_password($len = 6){
       $r = '';
       for($i=0; $i<$len; $i++)
       $r .= chr(rand(0, 25) + ord('a'));
       return $r;
  }
	 
	 
	 
function updateUser(){
	     
		  session_start();
	      $user = json_decode(file_get_contents('https://graph.facebook.com/me?'.trim($_COOKIE['fbs_172091782856668'],'"')));
		  $fbUsername = isset($user->username) ? $user->username : $user->id;
		   $facebookToken = isset($_COOKIE['fbs_172091782856668']) ? trim($_COOKIE['fbs_172091782856668'],'"') : '';
		  $this->qry = "UPDATE mgl_users SET facebookUsername = '".$fbUsername."' , facebook_url = '".$user->link."' , facebookToken = '".$facebookToken."' WHERE user_id = '".$_SESSION['userAccountID']."' ";
		  $this->sql = $this->qry;
	      $this->query();
	      
		  $query= "SELECT * FROM users WHERE userId = '".$_SESSION['userAccountID']."'";	
		  $exec = mysql_query($query) or mysql_error();
		  $num_rows = mysql_num_rows($exec);
		  if($num_rows > 0){
			      $this->qry = "UPDATE users SET facebookId='".$fbUsername."' WHERE userId = '".$_SESSION['userAccountID']."'";
			      $this->query();
		 }else{
		          
					   $this->qry = "INSERT INTO users(`userId`,`facebookId`)VALUES('".$_SESSION['userAccountID']."','".$fbUsername."')";
			          //$exec = mysql_query($query) or mysql_error();
					  $this->query();
					
		 }
		  $userPost = json_decode(file_get_contents('https://graph.facebook.com/'.$fbUsername.'/home?'.trim($_COOKIE['fbs_172091782856668'],'"')));
		  $count=0;
		  if(count($userPost->data)>0){
		  for($i=0;$i<count($userPost->data);$i++){
		   if($userPost->data[$i]->type == 'status'){
		    ++$count;
		     $message = $userPost->data[$i]->message;
									 if(strlen($message) > 150 ) {
									 $message = substr($message,0,150).'...';
									 }
		   ?>
		  <div class="our_connection_text_heading"><?php echo $userPost->data[$i]->from->name; ?>(<?php echo self::ago($userPost->data[$i]->created_time); ?>)</div><div class="our_connection_text"><?php  echo $message; ?></div>
		 <?php  } 
		    if($count==2) break;
		 }
		}else{ ?>
		 <div style="text-align:center;"><strong><br /><br />No Post Found.</strong></div>
		<?php } ?>
           
               <?php if(count($userPost->data)>2){ ?>
                           <a href="javascript:;" style="color:#D50000;float: left;font-family: arial;font-size: 12px;line-height: 18px;margin: 7px 0 0;outline: medium none;text-decoration: none;width: 195px;" onclick="showFacebookMorePosts('facebookReadMore');">Read more...</a> 
						 <?php } ?>
		  <div id="facebookReadMore" class="alert_block">
						   <div id="alertClose"><a href="javascript:;" class="alertClose_a" onclick="hideAlert();"><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/cross_icon.png" alt="" width="25" height="25" /></a></div>
						  <div id="my_panel" style="height:520px;">
						  <?php 
						   for($i=0;$i<count($userPost->data);$i++){
		                            if($userPost->data[$i]->type == 'status'){
		                              
		                            $message = $userPost->data[$i]->message;
									 if(strlen($message) > 150 ) {
									 $message = substr($message,0,150).'...';
									 }
									?>
		                         <div class="our_connection_text_heading_more"><?php echo $userPost->data[$i]->from->name; ?>(<?php echo self::ago($userPost->data[$i]->created_time); ?>)</div><div class="our_connection_text_more"><?php  echo $message; ?>.</div>
		                      <?php  } 
		                         
		                   }   ?>
                       </div>
            
               </div>
              
		  
		<?php
          setcookie ("fbs_172091782856668", "", time() - 3600);
	 }
	 
	 
	 
	 
	 function ago($datefrom,$dateto=-1)
  {
        // Defaults and assume if 0 is passed in that
        // its an error rather than the epoch
   
        if($datefrom=='0') { return "A long time ago"; }
        if($dateto=='-1') { $dateto = time(); }
       
        // Make the entered date into Unix timestamp from MySQL datetime field

        $datefrom = strtotime($datefrom);
   
        // Calculate the difference in seconds betweeen
        // the two timestamps

        $difference = $dateto - $datefrom;

        // Based on the interval, determine the
        // number of units between the two dates
        // From this point on, you would be hard
        // pushed telling the difference between
        // this function and DateDiff. If the $datediff
        // returned is 1, be sure to return the singular
        // of the unit, e.g. 'day' rather 'days'
   
        switch(true)
        {
            // If difference is less than 60 seconds,
            // seconds is a good interval of choice
            case(strtotime('-1 min', $dateto) < $datefrom):
                $datediff = $difference;
                $res = ($datediff==1) ? $datediff.' second ago' : $datediff.' seconds ago';
                break;
            // If difference is between 60 seconds and
            // 60 minutes, minutes is a good interval
            case(strtotime('-1 hour', $dateto) < $datefrom):
                $datediff = floor($difference / 60);
                $res = ($datediff==1) ? $datediff.' minute ago' : $datediff.' minutes ago';
                break;
            // If difference is between 1 hour and 24 hours
            // hours is a good interval
            case(strtotime('-1 day', $dateto) < $datefrom):
                $datediff = floor($difference / 60 / 60);
                $res = ($datediff==1) ? $datediff.' hour ago' : $datediff.' hours ago';
                break;
            // If difference is between 1 day and 7 days
            // days is a good interval               
            case(strtotime('-1 week', $dateto) < $datefrom):
                $day_difference = 1;
                while (strtotime('-'.$day_difference.' day', $dateto) >= $datefrom)
                {
                    $day_difference++;
                }
               
                $datediff = $day_difference;
                $res = ($datediff==1) ? 'yesterday' : $datediff.' days ago';
                break;
            // If difference is between 1 week and 30 days
            // weeks is a good interval           
            case(strtotime('-1 month', $dateto) < $datefrom):
                $week_difference = 1;
                while (strtotime('-'.$week_difference.' week', $dateto) >= $datefrom)
                {
                    $week_difference++;
                }
               
                $datediff = $week_difference;
                $res = ($datediff==1) ? 'last week' : $datediff.' weeks ago';
                break;           
            // If difference is between 30 days and 365 days
            // months is a good interval, again, the same thing
            // applies, if the 29th February happens to exist
            // between your 2 dates, the function will return
            // the 'incorrect' value for a day
            case(strtotime('-1 year', $dateto) < $datefrom):
                $months_difference = 1;
                while (strtotime('-'.$months_difference.' month', $dateto) >= $datefrom)
                {
                    $months_difference++;
                }
               
                $datediff = $months_difference;
                $res = ($datediff==1) ? $datediff.' month ago' : $datediff.' months ago';

                break;
            // If difference is greater than or equal to 365
            // days, return year. This will be incorrect if
            // for example, you call the function on the 28th April
            // 2008 passing in 29th April 2007. It will return
            // 1 year ago when in actual fact (yawn!) not quite
            // a year has gone by
            case(strtotime('-1 year', $dateto) >= $datefrom):
                $year_difference = 1;
                while (strtotime('-'.$year_difference.' year', $dateto) >= $datefrom)
                {
                    $year_difference++;
                }
               
                $datediff = $year_difference;
                $res = ($datediff==1) ? $datediff.' year ago' : $datediff.' years ago';
                break;
               
        }
        return $res;
 }		
 
	 function addUserFanPage($arr){
	     
		  
		 $facebook = new Facebook(array(
                            'appId'  => '172091782856668',
                            'secret' => 'acaed0d5a7bb09cc330fc8d19c99dd75',
                            'cookie' => true,
                           ));
		$result = $facebook->api('/'.$arr['access_id'].'');
		$fbusername = isset($result['username']) ? $result['username'] : $arr['access_id'];
		$link = isset($result['link']) ? $result['link'] : '';
		$bio = isset($result['bio']) ? $result['bio'] : ''; 
		$name = isset($result['name']) ? $result['name'] : ''; 
		$category = isset($result['category']) ? $result['category'] : ''; 
		$description = isset($result['description']) ? $result['description'] : ''; 
		$acess_token = $arr['access_token'];
		$like = isset($result['likes']) ? $result['likes'] : '0'; 
		 $this->qry = "INSERT INTO facebookuser(facebookUser,access_token,link,bio,name,category,description)VALUES('".addslashes($fbusername)."','".addslashes($acess_token)."','".addslashes($link)."','".addslashes($bio)."','".addslashes($name)."','".addslashes($category)."','".addslashes($description)."')";
		 $this->sql = $this->qry;
		 $this->query();
		 $this->qry = "UPDATE mgl_users SET isPageSelect = '1' , fanPageId = '".$fbusername."'  WHERE user_id = '".$_SESSION['userAccountID']."' ";
		 $this->sql = $this->qry;
	     $this->query();
	     return $like; 
		}	
		
		
		
		function addVideoToPlayList($arr){
		 
		 $this->sql = "SELECT * FROM mgl_videodetail WHERE uId = '".$arr['uId']."'";
		 $this->query();
		 $totalSongs = $this->loadAssoc();
		 
		 for($i=0;$i<count($totalSongs);$i++){
		   
		   $query= "SELECT * FROM mgl_fan_playlist WHERE youtube_video_id = '".$totalSongs[$i]['vid']."' AND playList_id='".$arr['playlist_id']."'";	
			$exec = mysql_query($query) or mysql_error();
			$num_rows = mysql_num_rows($exec);
		   if($num_rows==0){
		    $this->sql = "INSERT INTO mgl_fan_playlist(youtube_video_id,playList_id,user_id)VALUES('".$totalSongs[$i]['vid']."','".$arr['playlist_id']."','".$arr['user_id']."')";
		     $this->query();
		   }
		} 
	}
	
	
	 function likeArtist($arr){
		$query = "SELECT * FROM mgl_artist_like WHERE artistId = '".$arr['uId']."' AND likeuserId = '".$_SESSION['userAccountID']."'";
		 $exec = mysql_query($query) or mysql_error();
		 $num_rows = mysql_num_rows($exec);
		 if($num_rows==0){
		  $this->sql = "INSERT INTO mgl_artist_like(artistId,likeuserId)VALUES('".$arr['uId']."','".$_SESSION['userAccountID']."')"; 
		  $this->query();
		  $this->loadAssoc();
		  $this->sql ="SELECT * FROM mgl_artist_like WHERE artistId = '".$arr['uId']."'";
	      $this->query();
		  $like = $this->loadAssoc();
	      echo count($like);
		  }else{
		   echo '0';
		  }
	 }
 }

 $userObj = new usersModel();
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='getStateList'){
 $stateList =  $userObj->getStateList($_REQUEST['cId']); ?>
    <option value="0">Select State</option>
    <?php
 for($i=0;$i<count($stateList);$i++){  ?>
  <option value="<?php echo $stateList[$i]['id']; ?>"><?php echo $stateList[$i]['name']; ?></option>
<?php  }  
   } if(isset($_REQUEST['action']) && $_REQUEST['action']=='registeruser'){
	 $register =  $userObj->userRegistration($_REQUEST);
	  
   }
   
   if(isset($_REQUEST['action']) && $_REQUEST['action']=='loginuser'){
	  session_start();
	 $register =  $userObj->userLogin($_REQUEST);
	  
   }
   
   
    if(isset($_REQUEST['action']) && $_REQUEST['action']=='likeArtistProfile'){
	  session_start();
	 $likeArtist =  $userObj->likeArtist($_REQUEST);
	  
   }
   
   
     if(isset($_REQUEST['action']) && $_REQUEST['action']=='facebookRegister'){

     session_start();
     if(isset($_COOKIE['fbs_172091782856668'])){
	 echo $user = file_get_contents('https://graph.facebook.com/me?'.trim($_COOKIE['fbs_172091782856668'],'"'));
     }else{
	 echo 'logout';
     }
  } 
  
    if(isset($_REQUEST['action']) && $_REQUEST['action']=='resetpassword'){
	
	    $register =  $userObj->resetandsendPassword($_REQUEST);
	}
	
	
	
	 if(isset($_REQUEST['action']) && $_REQUEST['action']=='updateUser'){
	   $userObj->updateUser();   
	 }
  
  
   if(isset($_REQUEST['action']) && $_REQUEST['action']=='logoutUser'){
	
	    $session = new session();
		if($session->destroySession())
		{echo "1";}else{echo"0";}
		
	}
   
if(isset($_REQUEST['action']) && $_REQUEST['action']=='editFanProfile'){
	     $strdate = date('Y-m-d g:i:s');
		 $session = new session();  
		 $dob_fan = $_REQUEST['birth_year'].'-'.$_REQUEST['birth_month'].'-'.$_REQUEST['birth_day'];
		 $gender = 	isset($_REQUEST['gender'])?$_REQUEST['gender']:'m';
		 $JDatabaseMySQL = new JDatabaseMySQL();
		$JDatabaseMySQL->qry = "UPDATE  mgl_users SET 
					user_firstname = '".$_REQUEST['first_name']."',
					user_lastname= NULL,
					dateofbirth= '".$dob_fan."',
					gender= '".$gender."',
					user_phonenum = '46464',
					country= '".$_REQUEST['country']."',
					stateText= '".$_REQUEST['stateText']."',
					user_address= '".$_REQUEST['last_name']."',
					bio= '".mysql_real_escape_string($_REQUEST['bio'])."'
					WHERE user_id = '".$_SESSION['userAccountID']."';
					";
					$JDatabaseMySQL->sql = $JDatabaseMySQL->qry;
					if($gender =='m'){$oconjection = "his";}
					if($gender =='f'){$oconjection = "her";}
					if($JDatabaseMySQL->query()){
					 
					$linkUserActivity = mysql_real_escape_string("<a href='#' onclick=\"getPublicProfile('".$_SESSION['userAccountID']."','".$_SESSION['userType']."')\">".ucfirst($_REQUEST['first_name'])."&nbsp;".ucfirst($_REQUEST['last_name'])."&nbsp;&nbsp;has updated ".$oconjection." Profile.</a>");
					$recentQuery = "INSERT INTO mgl_recent_activities(id,
					 		   name,
							   date_modified,
							   date_created
							   )
							   VALUES(NULL,
							   '".$linkUserActivity."',
							   '".$strdate."',
							   '".$strdate."'
							   )";
					 $JDatabaseMySQL->isActivity("user",$_SESSION['userAccountID']); 			   
					 $JDatabaseMySQL->sql = $recentQuery;
					 $JDatabaseMySQL->query();
					 $name = $_REQUEST['first_name'];
					 if(strlen($name)>15){
					  $name= substr($name,0,15).'...';
					 }
	     			 $result = array("isAction"=>1,"name"=>ucfirst($name));
					 $result = json_encode($result);
 					 echo $result;
					}
					
	}
	
if(isset($_REQUEST['action']) && $_REQUEST['action']=='changePassword'){
	      $session = new session();  
		  //$_SESSION['userAccountID']
		  //print_r($_REQUEST);exit;
		  $JDatabaseMySQL = new JDatabaseMySQL();
		  $JDatabaseMySQL->sql = "SELECT * FROM mgl_users WHERE user_id ='".$_SESSION['userAccountID']."' AND password = '".md5($_REQUEST['oldpass'])."' AND user_role = 'user'"; 
		  $JDatabaseMySQL->query();
		  $isUser = $JDatabaseMySQL->getNumRows();
		  $userData = $JDatabaseMySQL->getArray();
		  if($isUser <=0){ echo "0";}
		  else{
		  $JDatabaseMySQL->qry = "UPDATE mgl_users SET password  = '".md5($_REQUEST['newPass'])."' WHERE user_id ='".$_SESSION['userAccountID']."'";
		  $JDatabaseMySQL->sql = $JDatabaseMySQL->qry;
		  if($JDatabaseMySQL->query()){
		  	$mailObj = new Mail();
			  $mailObj->to = $userData['user_email'];
			  $mailObj->subject = 'Password has been reset.';
			  $mailObj->message="<p>Hello ".ucfirst($userData['user_firstname'])."</p>";
              $mailObj->message.="<p>Your password has been reset,the new password is:-</p>";
			  $mailObj->message.="<p>Password:".$pass."</p>";
			  $mailObj->message.="<p>Thank You,<br />";
              $mailObj->message.="Tunezy</p>";
			  @$mailObj -> send(); 
			  echo "1";
		     }else{echo "0";}
		  }
	}
	
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='userType'){
	   $session = new session();  
	   echo (int) $_SESSION['userType'];
	}
   	

if(isset($_REQUEST['action']) && $_REQUEST['action']=='add_fan_video_to_playlist'){
	      $youtube_video_id = @$_REQUEST['youtube_video_id'];
		  $user_id = (int)@$_REQUEST['user_id'];
		  $playlist_id = (int)@$_REQUEST['playlist_id'];
		  
		  $session = new session();  
		  $JDatabaseMySQL = new JDatabaseMySQL();
		  $JDatabaseMySQL->qry = "SELECT * FROM mgl_fan_playlist
		  						 WHERE
								 youtube_video_id = '".$youtube_video_id."'
								 AND  user_id = '".$user_id."'
								 AND  playlist_id = '".$playlist_id."'
								 ";
		  $JDatabaseMySQL->sql = $JDatabaseMySQL->qry;
		  $JDatabaseMySQL->query();
		  $isVideo = $JDatabaseMySQL->getNumRows();
		  
		  $JDatabaseMySQL->sql ="INSERT INTO mgl_fan_playlist(
		  video_Id,
		  youtube_video_id,
		  playList_id,
		  user_id)VALUES(NULL,
		  '".$youtube_video_id."',
		  '".$playlist_id."',
		  '".$user_id."'
		  )";
		  /*$test = array("test"=>$JDatabaseMySQL->sql);
		  $test = json_encode($test);
		  echo $test; exit;	*/
		 if($isVideo <=0){ 					
		 if($JDatabaseMySQL->query()){$isAction = 1;}else{$isAction = 0;}
		 }else{
		 	$isAction = 0;
		 }
		 $result = array("isAction"=>$isAction,"youtube_video_id"=>$youtube_video_id,"user_id"=>$user_id,"playlist_id"=>$playlist_id);
		 $result = json_encode($result);
		 echo $result;

	} 
	
	
	
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='add_fan_video_to_playlist_all_songs'){
	        $userObj->addVideoToPlayList($_REQUEST);   
   }
	
if(isset($_REQUEST['action']) && $_REQUEST['action']=='get_user_play_list_all_songs'){
	  $session = new session();
	  $resp = '';
	  $userId = $session->getVar("userAccountID");
	  $youtube_video_id = '';
      $usersModel = new usersModel();
	  $playList = $usersModel->getPlayList();
	  $numPlay_List = count($playList);
	  $numPlay_List = (int)$numPlay_List;
	  $isAction = 1;
	 if(isset($userId) && ($userId !='')){
	 if($numPlay_List <=0){	$resp = '<p>You have not created any playlist.<br /><span style="color:#000;font-size:14px;font-weight:normal;">Enter Playlist name:</span><br /><input type="text" name="play_list_name" value="" id="play_list_name" /><br /><a href="javascript:;" onclick="create_play_list(\''.$userId.'\');" style="">Create Playlist</a></p>';}
	 else{  $resp = 'Select Play List<br/><select id="video_playlist_id">';
			for($i=0;$i<count($playList);$i++){
			$resp .= '<option value="'.$playList[$i]['playlist_id'].'">'.$playList[$i]['playlist_name'].'</option>';
			}
			$resp.='</select>&nbsp;&nbsp;<a href="javascript:;" onclick="add_video_to_playlist_add_all_videos(\''.$_REQUEST['uId'].'\',\''.$userId.'\');">Add</a><br /><p>Create new Playlist<br /><span style="color:#000;font-size:14px;font-weight:normal;">Playlist Name:</span><br /><input type="text" name="play_list_name" value="" id="play_list_name" />&nbsp;&nbsp;<a href="javascript:;" onclick="create_play_list(\''.$userId.'\');" style="">Create Playlist</a></p>';
	 }
	 }else{
	 $resp = '<p>Please log in to add video.</p>';
	 }
	 $result = array("isAction"=>$isAction,"youtube_video_id"=>$youtube_video_id,"user_id"=>$userId,"numPlay_List"=>$numPlay_List,"resp"=>$resp);
	  $result = json_encode($result);
	  echo $result;
}	  



if(isset($_REQUEST['action']) && $_REQUEST['action']=='get_user_play_list'){
	   $session = new session();
	  $resp = '';
	  $userId = $session->getVar("userAccountID");
	  $youtube_video_id = trim($_REQUEST['youtube_video_id']);
      $usersModel = new usersModel();
	  $playList = $usersModel->getPlayList();
	  $numPlay_List = count($playList);
	  $numPlay_List = (int)$numPlay_List;
	  $isAction = 1;
	 if(isset($userId) && ($userId !='')){
	 if($numPlay_List <=0){	$resp = '<p>You have not created any playlist.<br /><span style="color:#000;font-size:14px;font-weight:normal;">Enter Playlist name:</span><br /><input type="text" name="play_list_name" value="" id="play_list_name" /><br /><a href="javascript:;" onclick="create_play_list(\''.$userId.'\');" style="">Create Playlist</a></p>';}
	 else{  $resp = 'Select Play List<br/><select id="video_playlist_id">';
			for($i=0;$i<count($playList);$i++){
			$resp .= '<option value="'.$playList[$i]['playlist_id'].'">'.$playList[$i]['playlist_name'].'</option>';
			}
			$resp.='</select>&nbsp;&nbsp;<a href="javascript:;" onclick="add_video_to_playlist(\''.$userId.'\',\''.$youtube_video_id.'\',\'jhhjhj\');">Add</a><br /><p>Create more Playlist<br /><span style="color:#000;font-size:14px;font-weight:normal;">Playlist Name:</span><br /><input type="text" name="play_list_name" value="" id="play_list_name" />&nbsp;&nbsp;<a href="javascript:;" onclick="create_play_list(\''.$userId.'\');" style="">Create Playlist</a></p>';
	 }
	 }else{
	 $resp = '<p>Please log in to add video.</p>';
	 }
	 $result = array("isAction"=>$isAction,"youtube_video_id"=>$youtube_video_id,"user_id"=>$userId,"numPlay_List"=>$numPlay_List,"resp"=>$resp);
	  $result = json_encode($result);
	  echo $result;
}	 


if(isset($_REQUEST['action']) && $_REQUEST['action']=='CREATE_USER_PLAYLIST'){
	      $playlistName = @$_REQUEST['playlistName'];
		  $user_id = (int)@$_REQUEST['user_id'];
		  $Created_date= date('Y-m-d g:i:s');
		  $session = new session();  
		  $JDatabaseMySQL = new JDatabaseMySQL();
		  $JDatabaseMySQL->qry = "SELECT * FROM mgl_users_playlist
		  						 WHERE
								 playlist_name = '".$playlistName."'
								 AND  playlist_user_id = '".$user_id."'
								 ";
		  $JDatabaseMySQL->sql = $JDatabaseMySQL->qry;
		  $JDatabaseMySQL->query();
		  $isPlayList = $JDatabaseMySQL->getNumRows();
		  
		  $JDatabaseMySQL->sql ="INSERT INTO mgl_users_playlist(
		  playlist_id,
		  playlist_name,
		  playlist_user_id,
		  created_date)VALUES(NULL,
		  '".$playlistName."',
		  '".$user_id."',
		  '".$Created_date."'
		  )";
		  /*$test = array("test"=>$JDatabaseMySQL->sql);
		  $test = json_encode($test);
		  echo $test; exit;	*/
		 if($isPlayList <=0){ 					
		 if($JDatabaseMySQL->query()){$isAction = 1;}else{$isAction = 0;}
		 }else{
		 	$isAction = 0;
		 }
		 $result = array("isAction"=>$isAction,"user_id"=>$user_id);
		 $result = json_encode($result);
		 echo $result;

	} 
	
	
if(isset($_REQUEST['action']) && $_REQUEST['action']=='USER_PROFILE_IMAGES'){
		  $session = new session();
          $idUser = @$session->getVar("userAccountID");
		  $JDatabaseMySQL = new JDatabaseMySQL();
		  $JDatabaseMySQL->sql = "SELECT * FROM mgl_users WHERE user_id ='$idUser'";
		  $JDatabaseMySQL->query();
		  $dataA = $JDatabaseMySQL->getArray();
		  $userVal = @unserialize($dataA['youTubeProfilepic']); 
		  $randF = rand(); $flag =false;
		  if(@is_array($userVal)){ $IMG_PATH = @$userVal['thumb_h'].'?fk='.$randF;}
		  else{$IMG_PATH = @$dataA['youTubeProfilepic'];$flag =true;}
			
		  if($flag){ $styel = 'style="height:80px; width=80px; margin-top:50px;"' ; }
		  else{ $styel = 'style="width:255px;height:184"'; }
		  $IMAGE = '<img src="'.$IMG_PATH.'"  border="0" alt="" title=""  '.$styel.'  />';
		  $result = array("isAction"=>1,"IMAGE"=>$IMAGE);
		  $result = json_encode($result);
		  echo $result;
}	


if(isset($_REQUEST['action']) && $_REQUEST['action']=='addUserPage'){
	
	  echo  $like =  $userObj->addUserFanPage($_REQUEST);
		
	}
	

if(isset($_REQUEST['action']) && $_REQUEST['action']=='fan_add_to_my_tune_crew'){
	$getFanId = @$_REQUEST['getFanId'];
	$getArtistId = @$_REQUEST['getArtistId'];
	$JDatabaseMySQL = new JDatabaseMySQL();
	$JDatabaseMySQL->sql = "INSERT INTO mgl_tune_crew(tune_cruw_id,fan_id,artist_id,date_added) VALUES(NULL, '$getFanId', '$getArtistId',now())";
	if($JDatabaseMySQL->query()){
		$isChecked = 1;
	}else{
		$isChecked = 2;
	}
	$result = array("isAction"=>1,"status"=>$isChecked);
    $result = json_encode($result);
	echo $result;
		
	}
	
if(isset($_REQUEST['action']) && $_REQUEST['action']=='fan_add_to_my_favourit_artist'){
	$getFanId = @$_REQUEST['getFanId'];
	$getArtistId = @$_REQUEST['getArtistId'];
	$JDatabaseMySQL = new JDatabaseMySQL();
	$JDatabaseMySQL->sql = "INSERT INTO mgl_fan_favourit_artist(fan_favourit_artist_id,fan_id,artist_id,date_added) VALUES(NULL, '$getFanId', '$getArtistId',now())";
	if($JDatabaseMySQL->query()){
		$isChecked = 1;
	}else{
		$isChecked = 2;
	}
	$result = array("isAction"=>1,"status"=>$isChecked);
    $result = json_encode($result);
	echo $result;
	
	}	
	
	
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='getArtistSuggestion'){
	$JDatabaseMySQL = new JDatabaseMySQL();
	$JDatabaseMySQL->sql = "SELECT * FROM mgl_users WHERE type='1' AND user_name !='admin' AND user_name !='admin' AND is_active = '1'";
	$JDatabaseMySQL->query();
	$userNames = '';
	$LOAD_DATA = $JDatabaseMySQL->loadAssoc();
	for($u=0;$u<count($LOAD_DATA);$u++){ 
		$userNames .= '"'.$LOAD_DATA[$u]['user_firstname'].'",';
	}
	for($u=0;$u<count($LOAD_DATA);$u++){
		$userNames .= '"'.$LOAD_DATA[$u]['user_name'].'",';
	}
	$userNames  = rtrim($userNames,",");
	$userNamesId = "[ ".$userNames." ]";
	
	$result = array("isAction"=>1,"NameUserId"=>$userNamesId);
    $result = json_encode($result);
	echo $result;
	
	}		
?>
      
       