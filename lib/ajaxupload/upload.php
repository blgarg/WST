<?php
 include '../../settings.php';
 require_once('../../inc/load.php');
 $session = new session();
 //$sessionVar = $session->printSession();
  $idUser = @$session->getVar("userAccountID");
  $userType = @$session->getVar("userType");
   // Edit upload location here
   $destination_path = getcwd().DIRECTORY_SEPARATOR;

   $result = 0;

          $JDatabaseMySQL = new JDatabaseMySQL();
		  $JDatabaseMySQL->sql = "SELECT * FROM mgl_users WHERE user_id ='$idUser'";
		  $JDatabaseMySQL->query();
		  $dataA = $JDatabaseMySQL->getArray();
		  $userVal = @unserialize($dataA['youTubeProfilepic']);
		  
		  if(is_array($userVal))
		  {	
		  	@deleteUploadedImages($userVal['original'],$userVal['thumb']);
			
		  }else{
		  	echo"no";
		  }
		  $images = $nowWillUpload = @uploadUserProfile($_FILES['myfile'],$idUser);
		  $images = @serialize($images);
		  $JDatabaseMySQL->sql = "UPDATE  mgl_users SET youTubeProfilepic = '$images' WHERE user_id ='$idUser'";
		  $JDatabaseMySQL->query();
		
  
   if(uploadUserProfile($_FILES['myfile'],$idUser))
   {
   	$result = 1;
   }
	
	
   sleep(1);
   if($userType == 1){
   	$USER_MOD = 'artist_default';
   }else{
    $USER_MOD = 'fan_default';
   }
   ?>
 <script language="javascript" type="text/javascript">
parent.stopUpload(<?php echo $result; ?>,'<?php echo $USER_MOD;?>'); 
</script>  
 <?php  
   function uploadUserProfile($imgarr,$imgId)
			{ 
				 $helper = new Helper();
				 $config_var = new config();
				 $time = time();
				 $tempPath = $imgarr['tmp_name'];
				 $FileName = $imgarr['name'];
		         $original = $config_var->UPLOAD_ROOT.'user/original/'.$imgId."_img".".";
				 $original_h = $config_var->UPLOAD_URL.'user/original/'.$imgId."_img".".";
		         $thumb =$config_var->UPLOAD_ROOT.'user/thumb/'.$imgId."_img".".";
				 $thumb_h =$config_var->UPLOAD_URL.'user/thumb/'.$imgId."_img".".";
		  	     $ext = $helper->getUploadFileExtension($imgarr['name']);
				 move_uploaded_file($tempPath,$original.$ext);
				 $helper->resizeImage($original.$ext,255,184, $thumb.$ext, $imgarr);
				 $images = array("original"=>$original.$ext,"thumb"=>$thumb.$ext,"original_h"=>$original_h.$ext,"thumb_h"=>$thumb_h.$ext);
				 return $images;				
			}
			
	function deleteUploadedImages($original,$thumb){
			//UNLINK PREVIOUS UPOADED IMAGES
			if(file_exists($original)) @unlink($original);
			if(file_exists($thumb)) @unlink($thumb);
			return true;
		}		
?>

