<?php
class partygirls_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	   function runController(){
	   global $config_var;
	  
		  switch(@$_REQUEST['controller'])
		  {
		  		case 'upload':
				//echo "upload"; die;
					$this->uploadZip();
				break;
				case 'add_new_partygirls':
				
				$model_partygirls_addNewpartygirls = new model_partygirls_addNewpartygirls();
				//echo "<pre>";print_r($_REQUEST);die;
				if(isset($_FILES['image_load']) && !empty($_FILES['image_load']))
				{
					$image_err = $model_partygirls_addNewpartygirls->uploadimage($_FILES['image_load']);
					//echo "<pre>"; print_r($image_err); die;
					$url = $config_var->UPLOAD_ROOT."partygirls_images/" ;
					$thumbnail_path = $config_var->UPLOAD_ROOT."partygirls_images/thumbnail";
					$thumb = $model_partygirls_addNewpartygirls->createthumbnail($url,$thumbnail_path,$image_err['filename'],'175',$image_err['type']);
					$model_partygirls_addNewpartygirls->resizeImage($url.$image_err['filename'],'320','262',$url."front_end/".$image_err['filename'],$_FILES['image_load']);
					if($image_err['error']=="")
					{
						echo "no image error"; 
						$objects = new stdClass();
						$image_data['image']['name'] = $image_err['filename'];
						$image_data['image']['size'] = $image_err['size'];
						$image_data['image']['type'] = $image_err['type'];
					
					$objects->image_data = serialize($image_data['image']);
					$objects->image_title = strip_tags(@$_REQUEST['gallery_title']);
					$objects->country_id = @$_REQUEST['country_name'];
					$objects->city = @$_REQUEST['city'];
					$objects->category_id = @$_REQUEST['category_name'];
					$objects->image_thumbnail = @$image_err['filename'];
					
					
					if($model_partygirls_addNewpartygirls->inserData($objects)){
						$_SESSION['succ'] = 'New party girls image add successfully.';
						@header('Location:index.php?mod=mod_partygirls&view=default&m=3');
					}else{
						$_SESSION['error'] = "Error in creating new party girls";
						@header('Location:index.php?mod=mod_partygirls&view=default&m=3');
					}
					}
					else
					{
						echo $video_err;
					}
						die;
				}
				
				
				
				global $config_var;
				$objects = new stdClass();
				$objects->gallerytitle = strip_tags(@$_REQUEST['gallery_title']);
				//$objects->gallerytext = @$_REQUEST['galleryText'];
				//echo "<pre>"; print_r($_REQUEST);die('rohjihithih');
				
				if($model_partygirls_addNewpartygirls->inserData($objects)){
					$_SESSION['succ'] = "'New party girls image add successfully.'";
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
					}else{
					$_SESSION['error']="Error in creating party girls";
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
				 }
				break;
				case 'edit_partygirls':
				
				$model_partygirls_editpartygirls = new model_partygirls_editpartygirls();
				if(isset($_FILES['upload_video']) && !empty($_FILES['upload_video']))
				{
				//echo "<pre>"; print_r($_REQUEST); die;
					$image_err = $model_partygirls_editpartygirls->uploadimage($_FILES['upload_video']);
					//echo "<pre>"; print_r($image_err); die;
					$url = $config_var->UPLOAD_ROOT."partygirls_images/" ;
					$thumbnail_path = $config_var->UPLOAD_ROOT."partygirls_images/thumbnail";
					$thumb = $model_partygirls_editpartygirls->createthumbnail($url,$thumbnail_path,$image_err['filename'],'80',$image_err['type']);
					$model_partygirls_editpartygirls->resizeImage($url.$image_err['filename'],'220','162',$url."front_end/".$image_err['filename'],$_FILES['upload_video']);
					if($image_err['error']=="")
					{
								echo "no image error"; 
								$objects = new stdClass();
								$image_data['image']['name'] = $image_err['filename'];
								$image_data['image']['size'] = $image_err['size'];
								$image_data['image']['type'] = $image_err['type'];
							//echo "<pre>"; print_r(); die;
							if($image_data['image']['name']=="" || $image_data['image']['name']==""){
							$objects->image_title = strip_tags(@$_REQUEST['gallery_title']);
							$objects->country_id = @$_REQUEST['country_name'];
							$objects->city = @$_REQUEST['city'];
							$objects->category_id = @$_REQUEST['category_name'];
							$objects->cat_id = @$_REQUEST['cat_id'];
							
							}else{
							$objects->image_data = serialize($image_data['image']);
							$objects->image_title = strip_tags(@$_REQUEST['gallery_title']);
							$objects->country_id = @$_REQUEST['country_name'];
							$objects->city = @$_REQUEST['city'];
							$objects->category_id = @$_REQUEST['category_name'];
							$objects->image_thumbnail = @$image_err['filename'];
							$objects->cat_id = @$_REQUEST['cat_id'];
							}
							
							//echo "<pre>";	print_r($objects); die;
							if($model_partygirls_editpartygirls->saveData($objects)){
								$_SESSION['succ'] = 'Party Girls image Updated successfully.';	
									@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
								}
								else{
									$_SESSION['error'] = "Error in inserting Data";
									@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
									exit();
								}
					}
				}
				
				break;
				
				

				case 'delete':
				
				$model_bookspartygirls_delete = new model_partygirls_default();
				$objects = new stdClass();
				$objects->cat_id = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_id)>0){
					for($i=0;$i<count($objects->cat_id);$i++){
						$modelIds .= ','.$objects->cat_id[$i];
					}
					
				}
				if($model_bookspartygirls_delete->deleteData($modelIds)){
					$_SESSION['succ'] = 'Party Girls image(s) deleted successfully.';
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
					}else{
					$_SESSION['error']= "Error in deleting Party Girls image records";	
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
				 }
				 
				break;
				
				case 'activate':
				//echo "<pre>"; print_r($_REQUEST); die;
				$model_bookspartygirls_active = new model_partygirls_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}
				
			
				if($model_bookspartygirls_active->changeStatus($modelIds,'activate')){
					$_SESSION['succ'] = 'Party Girls image(s) has been activated.';
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');}else{
					$_SESSION['error'] = "Error in activating partygirls records";
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
				 }
				break;

				case 'deactivate':
				$model_bookspartygirls_deactive = new model_partygirls_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}

				if($model_bookspartygirls_deactive->changeStatus($modelIds,'deactivate')){
					$_SESSION['succ'] = 'Party Girls image(s) has been deactivated.';
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');}else{
					$_SESSION['error'] = 'Error in deactivating Party Girls records';
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
				 }
				break;

				case 'featured':
				//echo "<pre>"; print_r($_REQUEST); die;
				$model_bookspartygirls_active = new model_partygirls_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}
				
			
				if($model_bookspartygirls_active->featureStatus($modelIds,'activate')){
					$_SESSION['succ'] = 'Party Girls image(s) has been Featured.';
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');}else{
					$_SESSION['error'] = "Error in activating Party Girls records";
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
				 }
				break;

				case 'unfeatured':
				$model_bookspartygirls_deactive = new model_partygirls_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}

				if($model_bookspartygirls_deactive->featureStatus($modelIds,'deactivate')){
					$_SESSION['succ'] = 'Party Girls image(s) has been Unfeatured.';
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');}else{
					$_SESSION['error'] = 'Error in deactivating Party Girls records';
					@header('Location:index.php?mod=mod_partygirls&view=default&m=4');
				 }
				break;	


			}
	  }
	  
	  function unlink_function($id){
		
		$this->sql ='SELECT imagehdpi,imageshdpi,imageldpi,imagemdpi,imagexhdpi FROM mgl_models WHERE cat_id= "'.$id.'" ';
			$this->query();
			return $this->loadAssoc();
		 } 
	  function uploadZip() //uploading files from zip 
		{
			$targetDir = $config_var->UPLOAD_ROOT.'zip/zipfiles/';
			
			$cleanupTargetDir = true; // Remove old files
			$maxFileAge = 5 * 3600; // Temp file age in seconds
				
			// 5 minutes execution time
			@set_time_limit(5 * 60);
				
			// Uncomment this one to fake upload time
			// usleep(5000);

				
			// Get parameters
			$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
			$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
			$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
			$numfiles = isset($_REQUEST["numfile"]) ? $_REQUEST["numfile"] : '';


				
			// Clean the fileName for security reasons
			$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);
				
			// Make sure the fileName is unique but only if chunking is disabled
			if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
				$ext = strrpos($fileName, '.');
				$fileName_a = substr($fileName, 0, $ext);
				$fileName_b = substr($fileName, $ext);
					
				$count = 1;
				while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
					$count++;
					
				$fileName = $fileName_a . '_' . $count . $fileName_b;
			}
				
			$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
				
			// Create target dir
			if (!file_exists($targetDir))
				@mkdir($targetDir);
				
			// Remove old temp files
			if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
				while (($file = readdir($dir)) !== false) {
					$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
						
					// Remove temp file if it is older than the max age and is not the current file
					if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
						@unlink($tmpfilePath);
					}
				}
					
				closedir($dir);
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
				
		}
  
	  
}




?>