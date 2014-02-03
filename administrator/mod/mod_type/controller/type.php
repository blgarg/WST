<?php
class type_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	   function runController(){
	   global $config_var;
		  switch(@$_REQUEST['controller'])
		  {
		  		case 'addNewtype':
				
					$objects = new stdClass();
					
					
					$objects->title = strip_tags(@$_REQUEST['type_title']);
					$model_type_addNewtype = new model_type_addNewtype();
					$result = $model_type_addNewtype->checkRecords($objects->title);
					if(count($result)>0){
						$_SESSION['error']="Type name already exists";
						@header('Location:index.php?mod=mod_type&view=addNewtype&d=4');
						}
					else
					{
						if($model_type_addNewtype->insertData($objects)){
						@header('Location:index.php?mod=mod_type&view=default&d=4&s=1');}else{@header('Location:index.php?mod=mod_type&view=default&d=4&r=1');}
					}
				break;
				
				case 'edit_type':
				
					if(isset($_REQUEST) && !empty($_REQUEST))
					{
						$model_type_editType = new model_type_editType();
						$objects = new stdClass();
						$objects->title = strip_tags(@$_REQUEST['type_title']);
						$objects->type_id = @$_REQUEST['type_id'];
						$result = $model_type_editType->checkRecords($objects);
						if(count($result)>0){
							$_SESSION['error']="Type name already exists";
							@header('Location:index.php?mod=mod_type&view=editType&m=4&d=4&type_id='.$objects->type_id);
						}
						else{
						if($model_type_editType->saveData($objects)){
							@header('Location:index.php?mod=mod_type&view=default&d=4&s=2');
						}
						else{
							@header('Location:index.php?mod=mod_type&view=default&d=4&r=5');
							exit();
						}
					}
					}
					
					
					//echo "<pre>";	print_r($objects); die;
					
		
		
				
				break;

				case 'delete':
				$model_type_delete = new model_type_default();
				
				$objects = new stdClass();
				$objects->cat_id = @$_REQUEST['cat_id'];
				$modelIds = '';
				if(count($objects->cat_id)>0){
					for($i=0;$i<count($objects->cat_id);$i++){
						$modelIds .= $objects->cat_id[$i].",";
					}
					$modelIds = substr($modelIds,0,-1);
				}
				if($model_type_delete->deleteData($modelIds)){
					@header('Location:index.php?mod=mod_type&view=default&d=4&s=3');}else{@header('Location:index.php?mod=mod_type&view=default&d=4&r=3');
				 }
				 
				break;
				
				case 'activate':
				//echo "<pre>"; print_r($_REQUEST); die;
				$model_type_activate = new model_type_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= $objects->cat_ids[$i].',';
					}
					$modelIds = substr($modelIds,0,-1);
				}
				
			
				if($model_type_activate->changeStatus($modelIds,'activate')){
					@header('Location:index.php?mod=mod_type&view=default&d=4&s=4');}else{@header('Location:index.php?mod=mod_type&view=default&d=4&r=5');
				 }
				break;

				case 'deactivate':
				$model_type_deactivate = new model_type_default();
				$objects = new stdClass();
				$objects->cat_ids = @$_REQUEST['cat_id'];
				$modelIds = '';
				if(count($objects->cat_ids)>0){
					for($i=0;$i<count($objects->cat_ids);$i++){
						$modelIds .= $objects->cat_ids[$i].',';
					}
					$modelIds = substr($modelIds,0,-1);
				}

				if($model_type_deactivate->changeStatus($modelIds,'deactivate')){
					@header('Location:index.php?mod=mod_type&view=default&d=4&s=5');}else{@header('Location:index.php?mod=mod_type&view=default&d=4&r=5');
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