<?php
class Forum_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	  
	  function runController(){
	    switch(@$_REQUEST['controller'])
		  {
		  		case 'add_newForum':
				/*echo "<pre>";
				print_r($_REQUEST);
				die;*/
				$model_Forum_addNewForum = new model_Forum_addNewForum();
				$objects = new stdClass();
				if(isset($_FILES['image_load']) && !empty($_FILES['image_load']))
				{
					$image_err = $model_Forum_addNewForum->uploadimage($_FILES['image_load']);
					if($image_err['filename']!="")
					{
						foreach($image_err['filename'] as $filename)
						{
							if(!empty($filename))
							{
								$objects->filename[] = strip_tags(@$filename);
							}
						}
					}
				}
				global $config_var;
				
				$objects->categorytitle = strip_tags(@$_REQUEST['title']);
				$objects->categoryText = $_REQUEST['categoryText'];
				$objects->category = strip_tags(@$_REQUEST['cat']);
				$objects->subcategory = strip_tags(@$_REQUEST['sub_cat']);
				$result = $model_Forum_addNewForum->checkRecords($objects);
				if($model_Forum_addNewForum->inserData($objects)){
					$_SESSION['succ'] = "New Forum has been added successfully.";
					@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum');
				}else{
					$_SESSION['error'] = "Error adding new Forum.";
					@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum&r=1');
				 }
				 
				break;
				case 'editForum':
				global $config_var;
				$objects = new stdClass();
				$model_Forum_editForum = new model_forum_editForum();
				if(isset($_FILES['image_load']) && !empty($_FILES['image_load']))
				{
					$image_err = $model_Forum_editForum->uploadimage($_FILES['image_load']);
					if($image_err['filename']!="")
					{
						foreach($image_err['filename'] as $filename)
						{
							if(!empty($filename))
							{
								$objects->filename[] = strip_tags(@$filename);
							}
						}
					}
				}
				$objects->categorytitle = strip_tags(@$_REQUEST['title']);
				$objects->categoryText = strip_tags(@$_REQUEST['categoryText']);
				$objects->category = strip_tags(@$_REQUEST['cat']);
				$objects->subcategory = strip_tags(@$_REQUEST['sub_cat']);
				$objects->topic_id = @$_REQUEST['topic_id'];
				
				if($model_Forum_editForum->saveData($objects)){
				$_SESSION['succ'] = "Forum Updated successfully.";
				@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum');
				}else{
				$_SESSION['error'] = "Error editing Forum.";
				@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum');
					exit();
				 }
				
				break;
				
				

				case 'delete':
				$model_booksCategory_delete = new model_Forum_default();
				$objects = new stdClass();
				$objects->cat_id = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_id)>0){
					for($i=0;$i<count($objects->cat_id);$i++){
						$modelIds .= ','.$objects->cat_id[$i];
					}
					
				}
				if($model_booksCategory_delete->deleteData($modelIds)){
					$_SESSION['succ'] = "Forum deleted successfully.";
					@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum');
					}else{
					$_SESSION['error'] = "Error deleting Forum.";
					@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum');
				 }
				 
				break;
				
				case 'activate':
				$model_booksCategory_active = new model_Forum_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}
				
			
				if($model_booksCategory_active->changeStatus($modelIds,'activate')){
					$_SESSION['succ'] = "Forum has been activated successfully.";
					@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum');
					}else{
					$_SESSION['error'] = "Error activating Forum.";
					@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum');
				 }
				break;

				case 'deactivate':
				$model_booksCategory_deactive = new model_Forum_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}

				if($model_booksCategory_deactive->changeStatus($modelIds,'deactivate')){
					$_SESSION['succ'] = "Forum has been deactivated successfully.";
					@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum');
					}else{
					$_SESSION['error'] = "Error deactivating Forum.";
					@header('Location:index.php?mod=mod_forum&view=default&d=1&type=forum');
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