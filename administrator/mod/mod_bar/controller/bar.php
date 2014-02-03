<?php
class bar_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	   function runController(){
	   global $config_var;
	//  echo "<pre>"; print_r($_REQUEST); die;
		  switch(@$_REQUEST['controller'])
		  {
		  		case 'add_new_bar':
				
				$model_bar_addNewbar = new model_bar_addNewbar();
			if($_REQUEST){
				if($_FILES['image_load']['name']!='')
				{
					$image_err = $model_bar_addNewbar->uploadimage($_FILES['image_load']);
					//echo "<pre>"; print_r($image_err); die;
					$url = $config_var->UPLOAD_ROOT."bar_images/" ;
					$thumbnail_path = $config_var->UPLOAD_ROOT."bar_images/thumbnails/";
					$thumb = $model_bar_addNewbar->createthumbnail($url,$thumbnail_path,$image_err['filename'],'80',$image_err['type']);
					
					if($image_err['error']=="")
					{
						echo "no image error"; 
						$objects = new stdClass();
						$image_data['image']['name'] = $image_err['filename'];
						$image_data['image']['size'] = $image_err['size'];
						$image_data['image']['type'] = $image_err['type'];
					
					$objects->image_data = serialize($image_data['image']);
					$objects->bar_name = strip_tags(@$_REQUEST['bar_name']);
					$objects->bar_type = @$_REQUEST['bar_type'];
					$objects->web_site = @$_REQUEST['site_name'];
					$objects->bar_address = strip_tags(@$_REQUEST['bar_address']);
					$objects->country_id = @$_REQUEST['country_name'];
					$objects->bar_city = strip_tags(@$_REQUEST['bar_city']);
					$objects->working_hours = @$_REQUEST['working_hours'];
					$objects->no_of_staff = @$_REQUEST['no_of_staff'];
					$objects->facilities = strip_tags(@$_REQUEST['facilities']);
					$objects->Price_for_Sex = strip_tags(@$_REQUEST['Price_for_Sex']);
					$objects->bar_Desc = strip_tags(@$_REQUEST['bar_Desc']);
					$objects->Rating = @$_REQUEST['Rating'];
					$objects->image_thumbnail = @$image_err['filename'];
					
					}
					
				}
				else{
					$objects = new stdClass();
					
					$objects->bar_name = strip_tags(@$_REQUEST['bar_name']);
					$objects->bar_type = @$_REQUEST['bar_type'];
					$objects->web_site = @$_REQUEST['site_name'];
					$objects->bar_address = strip_tags(@$_REQUEST['bar_address']);
					$objects->country_id = @$_REQUEST['country_name'];
					$objects->bar_city = strip_tags(@$_REQUEST['bar_city']);
					$objects->working_hours = @$_REQUEST['working_hours'];
					$objects->no_of_staff = @$_REQUEST['no_of_staff'];
					$objects->facilities = strip_tags(@$_REQUEST['facilities']);
					$objects->Price_for_Sex = strip_tags(@$_REQUEST['Price_for_Sex']);
					$objects->bar_Desc = strip_tags(@$_REQUEST['bar_Desc']);
					$objects->Rating = @$_REQUEST['Rating'];
					
				}
				
					//echo "<pre>"; print_r($objects); die;
						if($model_bar_addNewbar->inserData($objects)){
							$_SESSION['succ'] = 'Bar is created successfully.';
							@header('Location:index.php?mod=mod_bar&view=default&m=3');
							}
						else{
							$_SESSION['error']=	"Error in creatng Bar";		
							@header('Location:index.php?mod=mod_bar&view=default&m=3');
						}
				}
				
				break;
				
				case 'edit_bar':
				//echo "<pre>"; print_r($_REQUEST); print_r($_FILES) ;
				$model_bar_editbar = new model_bar_editbar();
				if($_FILES['upload_video']['error']==0 && !empty($_FILES['upload_video']))
				{
					$image_err = $model_bar_editbar->uploadimage($_FILES['upload_video']);
					//echo "<pre>"; print_r($image_err); die;
					$url = $config_var->UPLOAD_ROOT."bar_images/" ;
					$thumbnail_path = $url."thumbnails";
					$thumb = $model_bar_editbar->createthumbnail($url,$thumbnail_path,$image_err['filename'],'80',$image_err['type']);

				if($image_err['error']=="")
					{
						echo "no image error"; 
						$objects = new stdClass();
						$image_data['image']['name'] = $image_err['filename']; 
						$image_data['image']['size'] = $image_err['size'];
						$image_data['image']['type'] = $image_err['type'];
						}
					
					//echo "<pre>"; print_r($_REQUEST); die;
					
					$objects->image_data = serialize($image_data['image']);
					$objects->bar_name = strip_tags(@$_REQUEST['bar_name']);
					$objects->web_site = @$_REQUEST['site_name'];
					$objects->bar_type = @$_REQUEST['bar_type'];
					$objects->bar_address = strip_tags(@$_REQUEST['bar_address']);
					$objects->bar_city = strip_tags(@$_REQUEST['bar_city']);
					$objects->bar_country = @$_REQUEST['country_name'];
					$objects->working_hours = @$_REQUEST['working_hours'];
					$objects->no_of_staff = @$_REQUEST['no_of_staff'];
					$objects->image_name = strip_tags(@$image_err['filename']);
					$objects->bar_desc = strip_tags(@$_REQUEST['bar_Desc']);
					$objects->facilities = strip_tags(@$_REQUEST['facilities']);
					$objects->Price_for_Sex = strip_tags(@$_REQUEST['Price_for_Sex']);
					$objects->rate = @$_REQUEST['Rating'];
					$objects->thumbnail_name = @$image_err['filename'];
					$objects->cat_id = @$_REQUEST['cat_id'];

				}
				else
				{
				$objects = new stdClass();
					$objects->bar_name = strip_tags(@$_REQUEST['bar_name']);
					$objects->web_site = @$_REQUEST['site_name'];
					$objects->bar_type = @$_REQUEST['bar_type'];
					$objects->bar_address = strip_tags(@$_REQUEST['bar_address']);
					$objects->bar_city = strip_tags(@$_REQUEST['bar_city']);
					$objects->bar_country = @$_REQUEST['country_name'];
					$objects->working_hours = @$_REQUEST['working_hours'];
					$objects->no_of_staff = @$_REQUEST['no_of_staff'];
					$objects->bar_desc = strip_tags(@$_REQUEST['bar_Desc']);
					$objects->facilities = strip_tags(@$_REQUEST['facilities']);
					$objects->Price_for_Sex = strip_tags(@$_REQUEST['Price_for_Sex']);
					$objects->rate = @$_REQUEST['Rating'];
					$objects->cat_id = @$_REQUEST['cat_id'];
				}
			//	echo "<pre>"; print_r($objects); die;
				
				if($model_bar_editbar->saveData($objects)){
							$_SESSION['succ'] = "Bar details Updated successfully";
							@header('Location:index.php?mod=mod_bar&view=default&m=4');
						}
						else{
							$_SESSION['error'] = "Error in updating Bar details";
							@header('Location:index.php?mod=mod_bar&view=default&m=4');
							exit();
						}
				
				break;
				
				

				case 'delete':

				$model_booksbar_delete = new model_bar_default();
				$objects = new stdClass();
				$objects->cat_id = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_id)>0){
					for($i=0;$i<count($objects->cat_id);$i++){
						$modelIds .= ','.$objects->cat_id[$i];
					}
					
				}
				if($model_booksbar_delete->deleteData($modelIds)){
					$_SESSION['succ'] = 'Selected bar has been deleted successfully.';
					@header('Location:index.php?mod=mod_bar&view=default&m=4');}else{
					$_SESSION['error'] = "Error in deleting Bar records";
					@header('Location:index.php?mod=mod_bar&view=default&m=4');
				 }
				 
				break;
				
				case 'activate':
				//echo "<pre>"; print_r($_REQUEST); die;
				$model_booksbar_active = new model_bar_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}
				
			
				if($model_booksbar_active->changeStatus($modelIds,'activate')){
					$_SESSION['succ'] = 'Selected bar has been activated successfully.';
					@header('Location:index.php?mod=mod_bar&view=default&m=4');}else{
					$_SESSION['error'] = "Error in activating Bar records";
					@header('Location:index.php?mod=mod_bar&view=default&m=4');
				 }
				break;

				case 'deactivate':
				$model_booksbar_deactive = new model_bar_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}

				if($model_booksbar_deactive->changeStatus($modelIds,'deactivate')){
					$_SESSION['succ'] = 'Selected bar has been deactivated successfully.';
					@header('Location:index.php?mod=mod_bar&view=default&m=4');
				}else{
					$_SESSION['error'] = "Error in deactivating Bar records";
					@header('Location:index.php?mod=mod_bar&view=default&m=4');
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
