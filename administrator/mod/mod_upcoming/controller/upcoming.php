<?php
class upcoming_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	   function runController(){
	 // echo "<pre>"; print_r($_REQUEST);
	  switch(@$_REQUEST['controller'])
		  {
		  case 'edit_upcoming':
	   global $config_var;
	   $objects = new stdClass();
	   	$objects->country = @$_REQUEST['country_name'];
		$objects->old_img_name = @$_REQUEST['old_img_name'];
		$objects->video_name = $_FILES['upload_video']['name'];
	   $thumbnail = $config_var->UPLOAD_ROOT.'upcoming/'.@$_REQUEST['old_img_name'];
	 
	 //echo "<pre>"; print_r($_REQUEST); 		print_r($_FILES);			die;
	   $model_upcoming_addNewImage = new model_upcoming_editupcoming();
	  $countryName = $model_upcoming_addNewImage->getCountryName(@$_REQUEST['country_name']);
	// echo "<pre>"; print_r($countryName[0]['country_name']); die;
		if(isset($_FILES['upload_video']) && $_FILES['upload_video']['error']==0)
				{
					
					if($_FILES['upload_video']['size']/(1024*1024) > 1)
					{
						
						$_SESSION['error'] = "File size should not be greater than 1MB";
						@header('Location:index.php?mod=mod_upcoming&view=editupcoming&d=8');
						die;
					}
					$image = $model_upcoming_addNewImage->uploadImage($_FILES['upload_video'], $thumbnail);
					if($image['error']==0)
					{
						$objects->video_image = $image['filename'];
						$objects->imageData = serialize($image);
						
						$SourceFile = $config_var->UPLOAD_ROOT.'upcoming/'.@$image['filename'];
						$DestinationFile = $config_var->UPLOAD_ROOT.'upcoming/'.@$image['filename'];
						$WaterMarkText = 'Upcoming updates: '.$countryName[0]['country_name']; 
						$image = $model_upcoming_addNewImage->watermarkImage ($SourceFile, $WaterMarkText, $DestinationFile);
					}
				}
				if($model_upcoming_addNewImage->saveData($objects)){
					$_SESSION['succ'] = 'Upcoming Image has been updated successfully.';
					@header('Location:index.php?mod=mod_upcoming&view=default&d=8');
				die;
				}else{
					$_SESSION['error'] = 'File size should not be greater than 1MB';
					@header('Location:index.php?mod=mod_upcoming&view=default&d=8');
					exit();
						 }
						 break;
				}
	  }
	  
	  
}




?>
