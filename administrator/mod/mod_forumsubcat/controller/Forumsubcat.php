<?php
class Forumsubcat_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	  
	  function runController(){
	    switch(@$_REQUEST['controller'])
		  {
		  		case 'add_new_category':
				/*echo "<pre>";
				print_r($_REQUEST);
				die;*/
				$model_Category_addNewCategory = new model_forumsubcat_addNewCategory();
				global $config_var;
				$objects = new stdClass();
				$objects->categorytitle = strip_tags(@$_REQUEST['category_title']);
				$objects->cat_id = strip_tags(@$_REQUEST['cat']);
				$result = $model_Category_addNewCategory->checkRecords($objects);
				if(count($result)>0){
					$_SESSION['error']="Category title already exists";
					@header('Location:index.php?mod=mod_forumsubcat&view=addNewCategory&d=3&type=forum');
						
				}else{
				if($model_Category_addNewCategory->inserData($objects)){
					$_SESSION['succ'] = "New category has been added successfully.";
					@header('Location:index.php?mod=mod_forumsubcat&view=default&d=3&type=forum');
				}else{
					$_SESSION['error'] = "Error adding new category.";
					@header('Location:index.php?mod=mod_forumsubcat&view=default&d=3&type=forum&r=1');
				 }
				 }
				break;
				case 'edit_category':
				global $config_var;
				$objects = new stdClass();
				$model_Category_editCategory = new model_forumsubcat_editCategory();
				$objects->categorytitle = strip_tags(@$_REQUEST['category_title']);
				$objects->cat = strip_tags(@$_REQUEST['cat']);
				$objects->cat_id = @$_REQUEST['cat_id'];
				$result = $model_Category_editCategory->checkRecords($objects);
				if(count($result)>0){
				$_SESSION['error']="Category title already exists";
				@header('Location:index.php?mod=mod_forumsubcat&view=editCategory&d=3&type=forum&cat_id='.$objects->cat_id);
					
				}else{
				if($model_Category_editCategory->saveData($objects)){
				$_SESSION['succ'] = "Category Updated successfully.";
				@header('Location:index.php?mod=mod_forumsubcat&view=default&d=3&type=forum');
				}else{
				$_SESSION['error'] = "Error editing category.";
				@header('Location:index.php?mod=mod_forumsubcat&view=default&d=3&type=forum');
					exit();
				 }
				}
				break;
				
				

				case 'delete':
				$model_booksCategory_delete = new model_forumsubcat_default();
				$objects = new stdClass();
				$objects->cat_id = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_id)>0){
					for($i=0;$i<count($objects->cat_id);$i++){
						$modelIds .= ','.$objects->cat_id[$i];
					}
					
				}
				if($model_booksCategory_delete->deleteData($modelIds)){
					$_SESSION['succ'] = "Category deleted successfully.";
					@header('Location:index.php?mod=mod_forumsubcat&view=default&d=3&type=forum');
					}else{
					$_SESSION['error'] = "Error deleting category.";
					@header('Location:index.php?mod=mod_forumsubcat&view=default&d=3&type=forum');
				 }
				 
				break;
				
				case 'activate':
				$model_booksCategory_active = new model_forumsubcat_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}
				
			
				if($model_booksCategory_active->changeStatus($modelIds,'activate')){
					$_SESSION['succ'] = "Category has been activated successfully.";
					@header('Location:index.php?mod=mod_forumsubcat&view=default&d=3&type=forum');
					}else{
					$_SESSION['error'] = "Error activating category.";
					@header('Location:index.php?mod=mod_forumsubcat&view=default&d=3&type=forum');
				 }
				break;

				case 'deactivate':
				$model_booksCategory_deactive = new model_forumsubcat_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '0';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= ','.$objects->cat_ids[$i];
					}
					
				}

				if($model_booksCategory_deactive->changeStatus($modelIds,'deactivate')){
					$_SESSION['succ'] = "Category has been deactivated successfully.";
					@header('Location:index.php?mod=mod_forumsubcat&view=default&m=4');
					}else{
					$_SESSION['error'] = "Error deactivating category.";
					@header('Location:index.php?mod=mod_forumsubcat&view=default&m=4');
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