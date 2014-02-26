<?php
class Post_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	  
	  function runController(){
	    switch(@$_REQUEST['controller'])
		  {
		  		case 'add_newPost':
				/*echo "<pre>";
				print_r($_REQUEST);
				die;*/
				$model_Post_addNewPost = new model_Post_addNewPost();
				$objects = new stdClass();
				if(isset($_FILES['image_load']) && !empty($_FILES['image_load']))
				{
					$image_err = $model_Post_addNewPost->uploadimage($_FILES['image_load']);
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
				$result = $model_Post_addNewPost->checkRecords($objects);
				if($model_Post_addNewPost->inserData($objects)){
					$_SESSION['succ'] = "New Post has been added successfully.";
					@header('Location:index.php?mod=mod_Post&view=default&d=1&type=forum');
				}else{
					$_SESSION['error'] = "Error adding new Post.";
					@header('Location:index.php?mod=mod_Post&view=default&d=1&type=forum&r=1');
				 }
				 
				break;
				case 'editPost':
				global $config_var;
				$objects = new stdClass();
				$model_Post_editPost = new model_Post_editPost();
				if(isset($_FILES['image_load']) && !empty($_FILES['image_load']))
				{
					$image_err = $model_Post_editPost->uploadimage($_FILES['image_load']);
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
				
				if($model_Post_editPost->saveData($objects)){
				$_SESSION['succ'] = "Post Updated successfully.";
				@header('Location:index.php?mod=mod_Post&view=default&d=1&type=forum');
				}else{
				$_SESSION['error'] = "Error editing Post.";
				@header('Location:index.php?mod=mod_Post&view=default&d=1&type=forum');
					exit();
				 }
				
				break;
				
				

				case 'delete':
				$model_booksCategory_delete = new model_Post_default();
				$objects = new stdClass();
				$objects->cat_id = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_id)>0){
					for($i=0;$i<count($objects->cat_id);$i++){
						$modelIds .= ','.$objects->cat_id[$i];
					}
					
				}
				if($model_booksCategory_delete->deleteData($modelIds)){
					$_SESSION['succ'] = "Post deleted successfully.";
					@header('Location:index.php?mod=mod_Post&view=default&d=1&type=forum');
					}else{
					$_SESSION['error'] = "Error deleting Post.";
					@header('Location:index.php?mod=mod_Post&view=default&d=1&type=forum');
				 }
				 
				break;
				
				case 'activate':
				$model_booksCategory_active = new model_Post_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}
				
			
				if($model_booksCategory_active->changeStatus($modelIds,'activate')){
					$_SESSION['succ'] = "Post has been activated successfully.";
					@header('Location:index.php?mod=mod_Post&view=default&d=1&type=forum');
					}else{
					$_SESSION['error'] = "Error activating Post.";
					@header('Location:index.php?mod=mod_Post&view=default&d=1&type=forum');
				 }
				break;

				case 'deactivate':
				$model_booksCategory_deactive = new model_Post_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}

				if($model_booksCategory_deactive->changeStatus($modelIds,'deactivate')){
					$_SESSION['succ'] = "Post has been deactivated successfully.";
					@header('Location:index.php?mod=mod_Post&view=default&d=1&type=Post');
					}else{
					$_SESSION['error'] = "Error deactivating Post.";
					@header('Location:index.php?mod=mod_Post&view=default&d=1&type=forum');
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