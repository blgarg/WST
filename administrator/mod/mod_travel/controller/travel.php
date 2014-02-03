<?php
class travel_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	   function runController(){
	   global $config_var;
		  switch(@$_REQUEST['controller'])
		  {
		  		case 'add_new_travel':
				
				$model_gallery_addNewTravel = new model_travel_addNewtravel();
				$objects = new stdClass();
				
				if(isset($_FILES['image_load']) && !empty($_FILES['image_load']))
				{
					$image_err = $model_gallery_addNewTravel->uploadimage($_FILES['image_load']);
					//echo "<pre>"; print_r($image_err); die;
					$url = $config_var->UPLOAD_ROOT."travel/" ;
					$thumbnail_path = $config_var->UPLOAD_ROOT."travel/thumbs/";
					$thumb = $model_gallery_addNewTravel->createthumbnail($url,$thumbnail_path,$image_err['filename'],'80',$image_err['type']);
					
					if($image_err['error']=="")
					{
						echo "no image error"; 
						
						$image_data['image']['name'] = $image_err['filename'];
						$image_data['image']['size'] = $image_err['size'];
						$image_data['image']['type'] = $image_err['type'];
					
					$objects->image_data = serialize($image_data['image']);
					
					$objects->image_thumbnail = @$image_err['filename'];
					$objects->image="1";
				}
				else
				{
					$objects->image="0";
				}
					$objects->place_name = strip_tags(@$_REQUEST['place_name']);
					$objects->address = strip_tags(@$_REQUEST['address']);
					$objects->city = strip_tags(@$_REQUEST['city']);
					$objects->country = @$_REQUEST['country_name'];
					$objects->type = @$_REQUEST['type'];
					$objects->working_hours = strip_tags(@$_REQUEST['whours']);
					$objects->Price_for_Sex = strip_tags(@$_REQUEST['Price_for_Sex']);
					$objects->description = strip_tags(@$_REQUEST['description']);
					if($model_gallery_addNewTravel->inserData($objects)){
						$_SESSION['succ']= 'New Travel data has been created successfully.';
						@header('Location:index.php?mod=mod_travel&view=default&m=3');
						}else{
						$_SESSION['error'] = "Error in creating new travel data records"; 
						@header('Location:index.php?mod=mod_travel&view=default&m=3');
					}
					}
					else
					{
						echo $image_err['error'];
						$_SESSION['error'] = "Error in uploading Image";
						@header('Location:index.php?mod=mod_travel&view=default&m=3');	
					}
					
				
				
				break;
				case 'edit_travel':
				
				$model_travel_editTravel = new model_travel_editTravel();
				$objects = new stdClass();
				if($_FILES['upload_image']['error']==0 && !empty($_FILES['upload_image']))
				{
					//echo "<pre>"; print_r($_REQUEST);print_r($_FILES); 
					$image_err = $model_travel_editTravel->uploadimage($_FILES['upload_image']);
					
					$url = $config_var->UPLOAD_ROOT."travel/" ;
					$thumbnail_path = $config_var->UPLOAD_ROOT."travel/thumbs/";
					$thumb = $model_travel_editTravel->createthumbnail($url,$thumbnail_path,$image_err['filename'],'80',$image_err['type']);
							
					if($image_err['error']=="")
					{
						
						
						$image_data['image']['name'] = $image_err['filename'];
						$image_data['image']['size'] = $image_err['size'];
						$image_data['image']['type'] = $image_err['type'];
					
						$objects->image_data = serialize($image_data['image']);
						$objects->image_thumb = $image_err['filename'];
					}
					else
					{
						$_SESSION['error'] = $image_err['error'];
						@header('Location:index.php?mod=mod_gallery&view=default&m=4');
							exit();
					}
				}
				
					$objects->place_name = strip_tags(@$_REQUEST['place_name']);
					$objects->address = strip_tags(@$_REQUEST['address']);
					$objects->city = strip_tags(@$_REQUEST['city']);
					$objects->country_name = @$_REQUEST['country_name'];
					$objects->type = @$_REQUEST['type'];
					$objects->working_hours = @$_REQUEST['working_hours'];
					$objects->Price_for_Sex = strip_tags(@$_REQUEST['Price_for_Sex']);
					$objects->description = strip_tags(@$_REQUEST['description']);
					$objects->editTravel = strip_tags(@$_REQUEST['editTravel']);
					$objects->id = strip_tags(@$_REQUEST['t_id']);
					if($model_travel_editTravel->saveData($objects)){
							$_SESSION['succ'] = "Selected travel data has been Updated successfully";
							@header('Location:index.php?mod=mod_travel&view=default&m=4');
						}
						else{
							$_SESSION['error'] = "Error in updating travel data";
							@header('Location:index.php?mod=mod_travel&view=default&m=4');
							exit();
						}
			
		
				
				break;
				
				

				case 'delete':
/*				echo "<pre>";
				print_r($_REQUEST);
				die;*/
				$model_travel_delete = new model_travel_default();
				$objects = new stdClass();
				$objects->cat_id = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_id)>0){
					for($i=0;$i<count($objects->cat_id);$i++){
						$modelIds .= ','.$objects->cat_id[$i];
					}
					
				}
				if($model_travel_delete->deleteData($modelIds)){
					$_SESSION['succ'] = 'Selected travel(s) data has been deleted successfully.';
						@header('Location:index.php?mod=mod_travel&view=default&m=4');}else{
					$_SESSION['error'] = "Error in deleting travel records";
					@header('Location:index.php?mod=mod_gallery&view=default&m=4');
				 }
				 
				break;
				
				case 'activate':
				//echo "<pre>"; print_r($_REQUEST); die;
				$model_travel_active = new model_travel_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}
				
			
				if($model_travel_active->changeStatus($modelIds,'activate')){
					$_SESSION['succ'] = 'Selected travel(s) data has been activated successfully.';
					@header('Location:index.php?mod=mod_travel&view=default&m=4');}else{
					$_SESSION['error'] = "Error in activating travel data";
					@header('Location:index.php?mod=mod_travel&view=default&m=4');
				 }
				break;

				case 'deactivate':
				$model_travel_deactive = new model_travel_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}

				if($model_travel_deactive->changeStatus($modelIds,'deactivate')){
					$_SESSION['succ'] = 'Selected travel(s) has been deactivated successfully.';
					@header('Location:index.php?mod=mod_travel&view=default&m=6');}else{
					$_SESSION['error'] = 'Error in deactivating travel records';
					@header('Location:index.php?mod=mod_gallery&view=default&m=4');
				 }
				break;

				


			}
	  }
	  
	  function unlink_function($id){
		
		$this->sql ='SELECT imagehdpi,imageshdpi,imageldpi,imagemdpi,imagexhdpi FROM mgl_models WHERE cat_id= "'.$id.'" ';
			$this->query();
			return $this->loadAssoc();
		 }  
  
	  
}




?>