<?php
class video_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	  
	  function runController(){
		
		  switch(@$_REQUEST['controller'])
		  {
		  		case 'add_new_video':
				/*echo "<pre>";
				print_r($_REQUEST);
				print_r($_FILES);
				
				echo "</pre>";
				die;*/
				$model_video_addNewVideo = new model_video_addNewVideo();
				global $config_var;
				$objects = new stdClass();
				$objects->country = $_REQUEST['country'];
				$objects->category = $_REQUEST['category'];
				if(isset($_FILES['upload_image']) && $_FILES['upload_image']['error']==0)
				{
					
					if($_FILES['upload_image']['size']/(1024*1024) > 1)
					{
						
						$_SESSION['error'] = "File size should not be greater than 1MB";
						@header('Location:index.php?mod=mod_video&view=default&m=4');
						die;
					}
					$image = $model_video_addNewVideo->uploadImage($_FILES['upload_image']);
					
					if($image['error']==0)
					{
						$objects->video_image = $image['filename'];
					}
				}
				if(isset($_FILES['upload_video']) && !empty($_FILES['upload_video']))
				{
					$objects->video_name = $_FILES['upload_video']['name'];
					
					if($_FILES['upload_video']['size']/(1024*1024) > 500)
					{
						$_SESSION['error'] = "File size should not be greater than 500MB";
						@header('Location:index.php?mod=mod_video&view=default&m=4');
						die;
					}
					$video_err = $model_video_addNewVideo->uploadVideo($_FILES['upload_video']);
					if($video_err['error']=="")
					{
						echo "no video error"; 
					
						$video_data['video']['filename'] = $video_err['filename'];
						$video_data['video']['size'] = $video_err['size'];
						$video_data['video']['type'] = $video_err['type'];
						$objects->video_data = serialize($video_data['video']);
					
						$objects->video_title = strip_tags(@$_REQUEST['video_name']);
					
					
					}
					else
					{
						echo $video_err;
							
					}
					
				}
				
				 if($model_video_addNewVideo->inserData($objects)){
						$_SESSION['succ'] = 'New Video has been saved successfully.';
						@header('Location:index.php?mod=mod_video&view=default&m=3');}else{
						$_SESSION['error'] = "Error in uploading Video";
						@header('Location:index.php?mod=mod_video&view=default&m=3');
					}
					die;
				
				break;
				case 'edit_video':
				
				global $config_var;
				$objects = new stdClass();
				$model_video_editVideo = new model_video_editVideo();
				$objects->video_title = strip_tags(@$_REQUEST['video_name']);
				$objects->video_name = $_FILES['upload_video']['name'];
				$objects->country = @$_REQUEST['country'];
				$objects->category = @$_REQUEST['category'];
				$objects->video_id = @$_REQUEST['video_id'];
				if(@$_REQUEST['editVideo']==1)
				{
					$videoError = $this->uploadVideo($_FILES['upload_video'],$_REQUEST['video_id']);
					
					if($videoError['error']=="")
					{
						$video['image']['filename'] = $videoError['filename'];
						$video['image']['type'] = $videoError['type'];
						$video['image']['size'] = $videoError['size'];
						$videoData = serialize($video['image']);
						$objects->video_data = $videoData;
						$objects->editVideo = 1;
					}
					else
					{
						echo "Error in uploading video";
						$_SESSION['error'] = "Error in uploading video";
						@header('Location:index.php?mod=mod_video&view=default&m=3');
						die;
					}
					
				}
				if($_REQUEST['editVideoImage']==1)
				{
					$returnData = $model_video_editVideo->editVideoImage($_FILES['upload_image'],$_REQUEST['videoImage']);
						
						if($returnData['error']==0)
						{
							$objects->image = $returnData['filename'];
							$objects->imageFlag = 1;
						}
				}
				if($model_video_editVideo->saveData($objects)){
					$_SESSION['succ'] = 'Video has been updated successfully.';
					@header('Location:index.php?mod=mod_video&view=default&m=3');
				die;
				}else{
					$_SESSION['error'] = 'File size should not be greater than 500MB';
					@header('Location:index.php?mod=mod_video&view=default&m=3');
					exit();
						 }
				break;
				
				

				case 'delete':
				//echo "<pre>"; print_r($_REQUEST); die;
				$model_manageVideo_delete = new model_video_default();
				$objects = new stdClass();
				$objects->video_id = @$_REQUEST['video_id'];
				$break = 0;
				foreach($objects->video_id as $vid)
				{
				
					$response = $this->unlink_video($vid);
					if($response=="")
					{
						if($model_manageVideo_delete->deleteData($vid))
						{
							$break = 0;
						}
						else
						{
							$break =1;
						}
							
							
						
					}
					if($break)
					{
					
						break;
					}
				}
				if($break)
				{
					$_SESSION['error'] = 'Sorry , Unable to delete properly.';
					@header('Location:index.php?mod=mod_video&view=default&m=3');
				}
				else
				{
					$_SESSION['succ'] = 'All selected videos has been deleted successfully.';
					@header('Location:index.php?mod=mod_video&view=default&m=3');
				}
				
				 
				break;
				
				case 'activate':
				$model_manageVideo_activate = new model_video_default();
				$objects = new stdClass();
				$objects->emp_ids = @$_REQUEST['video_id'];
				
				$modelIds = '0';
				if(count($objects->emp_ids)>0){
					for($i=0;$i<count($objects->emp_ids);$i++){
						$modelIds .= ','.$objects->emp_ids[$i];
					}
					
				}
				
			
				if($model_manageVideo_activate->changeStatus($modelIds,'activate')){
					$_SESSION['succ'] = 'Video has been activated successfully.';
					@header('Location:index.php?mod=mod_video&view=default&m=1');
				}
				else{
						$_SESSION['error'] = 'Error in activating Video records.';
						@header('Location:index.php?mod=mod_writers&view=default&m=3');
					}
				break;

				case 'deactivate':
				$model_manageVideo_deactivate = new model_video_default();
				$objects = new stdClass();
				$objects->emp_ids = @$_REQUEST['video_id'];
				$modelIds = '0';
				if(count($objects->emp_ids)>0){
					for($i=0;$i<count($objects->emp_ids);$i++){
						$modelIds .= ','.$objects->emp_ids[$i];
					}
					
				}

				if($model_manageVideo_deactivate->changeStatus($modelIds,'deactivate')){
					$_SESSION['succ'] = 'Video has been deactivated successfully.';
					@header('Location:index.php?mod=mod_video&view=default&m=3');
				}else{
					$_SESSION['error'] = "Error in deactivating the records";
					@header('Location:index.php?mod=mod_writers&view=default&m=3');
				 }
				break;

				


			}
	  }
	  function uploadVideo($file,$video_id)
			{
					$config_var = new config();
					$error ="";
					$data['error'] = "";
					$fileinfo = pathinfo($file['name']);
					$model_video_editVideo = new model_video_editVideo();
					$old_Video_Data = $model_video_editVideo->getOldVideoData($video_id);
					//echo "<pre>"; print_r($old_Video_Data['filename']); die;
					if(($fileinfo['extension']=="mp4" || $fileinfo['extension']=="flv" || $fileinfo['extension']=="wmv") && $file['size']/(1024*1024) < 500 )
					{
						$filename = microtime().".".$fileinfo['extension'];
						$filename = str_replace(" ","",$filename);
						//echo $config_var->UPLOAD_ROOT;
						
						
						if(move_uploaded_file($file['tmp_name'],$config_var->UPLOAD_ROOT."videos/".$filename))
						{
							if(file_exists($config_var->UPLOAD_ROOT."videos/".$old_Video_Data['filename']))
							{
							$old_flv_video = explode("wmv", $old_Video_Data['filename']); 
							$old_flv_video_name = $old_flv_video[0]."flv";
								unlink($config_var->UPLOAD_ROOT."videos/flv_videos/".$old_flv_video_name);
								if(!unlink($config_var->UPLOAD_ROOT."videos/".$old_Video_Data['filename']))								{
									$data['error']="Problem in deleting file from folder";
								}
							}
							
							$data['filename'] = $filename;
							$data['type'] = $file['type'];
							$data['size'] = $file['size'];
						
							echo $srcFile  = $config_var->UPLOAD_ROOT."videos/".$filename;
							$new_file = explode("wmv", $filename);
							$destFile = $config_var->UPLOAD_ROOT."videos/flv_videos/".$new_file[0]."flv";
							exec("/usr/bin/ffmpeg -i $srcFile $destFile 2>&1", $output);
							echo "<pre>"; var_dump($output);
							
						}
						else
						{
							$data['error'] = "Error uploading file";
						}
						
					}
					else
					{
						$data['error'] = "Either file extension is not flv, wmv, mp4 or file size greater than 500 MB";
						
					}
				return $data;
			}
		// unlink video file
		function unlink_video($vid)
		{
			global $config_var;
			$model_manageVideo_delete = new model_video_default();
			$videoData = $model_manageVideo_delete->getVideoData($vid);
			
			$err = "";
			if(file_exists($config_var->UPLOAD_ROOT."videos/".$videoData['filename']))
			{
					$old_flv_video = explode("wmv", $videoData[0]['filename']); 
					$old_flv_video_name = $old_flv_video[0]."flv";
					unlink($config_var->UPLOAD_ROOT."videos/flv_videos/".$old_flv_video_name);	
					unlink($config_var->UPLOAD_ROOT."videos/".$videoData[0]['filename']);			
					unlink($config_var->UPLOAD_ROOT."videos/images/".$videoData[1]);
				
				
			}
			else
			{
				$err="File does not exist";
			}
		
			return $err;
		}
	  
}




?>