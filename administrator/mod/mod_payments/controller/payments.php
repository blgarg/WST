<?php
class payments_controller extends JDatabaseMySQL{	
	  var $modName  = '';
	  
	  function runController(){
		  switch(@$_REQUEST['controller'])
		  {
		  		case 'add_receive_pmt':
				$model_payments_recivepaymt = new model_payments_recivepaymt();
				global $config_var;
				$objects = new stdClass();
				
				$objects->prtyacdmy_id = @$_REQUEST['prtyacdmy_id'];
				$objects->biztype = @$_REQUEST['biztype'];
				$objects->recv_pmt = @$_REQUEST['recv_pmt'];
				
				$biztype = @$_REQUEST['biztype'];
				
						
				 //echo "<pre>"; print_r($_REQUEST);die('rohit');
				 
				if($model_payments_recivepaymt->inserData($objects)){
					@header('Location:index.php?mod=mod_payments&view=default&m=11&type='.$biztype.'&s=1');}else{@header('Location:index.php?mod=mod_payments&view=default&m=11&r=1');
				 }
				break;
				case 'edit_magazines':
				/* echo "<pre>";
				print_r($_REQUEST);
				die; */
				global $config_var;
				$objects = new stdClass();
				$model_magazines_editMagazines = new model_magazines_editMagazines();
				$objects = new stdClass();
				$objects->title = @$_REQUEST['title'];
				$objects->desc = @$_REQUEST['desc'];
				$objects->magz_price = @$_REQUEST['magz_price'];
				
					$random = rand(5,25);
				$book_imagetitle='';
				
				if(@$_FILES['file1']['name'] !=''){
						
						$book_imagetitle = $random.'_'.$_FILES['file1']['name'];
											
						$book_imagetitle_tmp = $_FILES['file1'][tmp_name];
												
						$emp_image_small_tmpurl = $config_var->UPLOAD_ROOT.'magazines/thumbs/'.$book_imagetitle;
						$emp_image_employee_tmpurl = $config_var->UPLOAD_ROOT.'magazines/mediumimages/'.$book_imagetitle;
						$real_image_path = $config_var->UPLOAD_ROOT.'magazines/originialimages/'.$book_imagetitle;
						
				if(move_uploaded_file($book_imagetitle_tmp,$real_image_path)){ 

					 require_once($config_var->LIB_ROOT.'Helper.php'); 
					 Helper::resizeImage($real_image_path,60,70,$emp_image_small_tmpurl,$_FILES['file1']);
					 Helper::resizeImage($real_image_path,185,170,$emp_image_employee_tmpurl,$_FILES['file1']);
					}
					 if($model_magazines_editMagazines->saveData_withimage($objects,$book_imagetitle)){
				@header('Location:index.php?mod=mod_magazines&view=default&m=9&s=2');}else{@header('Location:index.php?mod=mod_magazines&view=default&m=9&r=5');
					exit();
						 }
				 }
				else
				{
				  if($model_magazines_editMagazines->saveData($objects)){
				@header('Location:index.php?mod=mod_magazines&view=default&m=9&s=2');}else{@header('Location:index.php?mod=mod_magazines&view=default&m=9&r=5');
					exit();
						 }
				}		 
				break;
				
				

				case 'delete':
				$model_manageUser_delete = new model_magazines_default();
				$objects = new stdClass();
				$objects->emp_id = @$_REQUEST['mag_id'];
				$modelIds = '0';
				if(count($objects->emp_id)>0){
					for($i=0;$i<count($objects->emp_id);$i++){
						$modelIds .= ','.$objects->emp_id[$i];
					}
					
				}
				if($model_manageUser_delete->deleteData($modelIds)){
					@header('Location:index.php?mod=mod_magazines&view=default&m=9&s=3');}else{@header('Location:index.php?mod=mod_magazines&view=default&m=9&r=3');
				 }
				 
				break;
				
				case 'activate':
				$model_manageUser_active = new model_magazines_default();
				$objects = new stdClass();
				$objects->emp_ids = @$_REQUEST['mag_id'];
				$modelIds = '0';
				if(count($objects->emp_ids)>0){
					for($i=0;$i<count($objects->emp_ids);$i++){
						$modelIds .= ','.$objects->emp_ids[$i];
					}
					
				}
				
			
				if($model_manageUser_active->changeStatus($modelIds,'activate')){
					@header('Location:index.php?mod=mod_magazines&view=default&m=9&s=4');}else{@header('Location:index.php?mod=mod_magazines&view=default&m=9&r=5');
				 }
				break;

				case 'deactivate':
				$model_manageUser_deactive = new model_magazines_default();
				$objects = new stdClass();
				$objects->emp_ids = @$_REQUEST['mag_id'];
				$modelIds = '0';
				if(count($objects->emp_ids)>0){
					for($i=0;$i<count($objects->emp_ids);$i++){
						$modelIds .= ','.$objects->emp_ids[$i];
					}
					
				}

				if($model_manageUser_deactive->changeStatus($modelIds,'deactivate')){
					@header('Location:index.php?mod=mod_magazines&view=default&m=9&s=5');}else{@header('Location:index.php?mod=mod_magazines&view=default&m=9&r=5');
				 }
				break;

				


			}
	  }
	  
	  function unlink_function($id){
		
		$this->sql ='SELECT imagehdpi,imageshdpi,imageldpi,imagemdpi,imagexhdpi FROM mgl_models WHERE emp_id= "'.$id.'" ';
			$this->query();
			return $this->loadAssoc();
		 }  
  
	  
}




?>