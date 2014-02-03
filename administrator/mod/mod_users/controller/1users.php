<?php
class users_controller{	

	  var $modName  = '';
	  
	  function runController(){
	 
		  switch(@$_REQUEST['controller'])
		  {
		
				case 'add_new_user':
				$model_users_addNewUser = new model_users_addNewUser();
				$objects = new stdClass();
				$objects->first_name = strip_tags(@$_REQUEST['first_name']);
				$objects->last_name = strip_tags(@$_REQUEST['last_name']);
				$objects->password = strip_tags(@$_REQUEST['password']);
				$objects->email_add = strip_tags(@$_REQUEST['email_add']);
				$objects->phone_number = @$_REQUEST['phone_number'];
				$objects->address = strip_tags(@$_REQUEST['address']);
				$objects->country = @$_REQUEST['country'];
				$objects->state = strip_tags(@$_REQUEST['state']);
				if($model_users_addNewUser->emailExist($objects->email_add))
				{
					
					$_SESSION['error'] = "Email already exists";
					$_SESSION['return'] = $_REQUEST ;
					@header('Location:index.php?mod=mod_users&view=addNewUser&m=1');
					die;
				}
				$returndata = $model_users_addNewUser->inserData($objects);
				$objects->payment = @$_REQUEST['payment'];
				$objects->membership = @$_REQUEST['membership'];
				
				
				
				if($returndata[1]=='added'){
						$model_users_addNewUser->insertMembership($returndata[0],$objects->membership,$objects->payment);
						$_SESSION['succ'] = "New user is created successfully.";
						@header('Location:index.php?mod=mod_users&view=default&m=1');
					
				}else{
							$_SESSION['error'] = "current password doesnot match";
							@header('Location:index.php?mod=mod_users&view=default&m=1');
				}
								 
				break;
				
				
				
				case 'edit_user':
				$model_users_editNewUser = new model_users_editUser();
				$objects = new stdClass();
				$objects->first_name = strip_tags(@$_REQUEST['first_name']);
				$objects->last_name = strip_tags(@$_REQUEST['last_name']);
				$objects->email_add = strip_tags(@$_REQUEST['email_add']);
				$objects->phone_number = @$_REQUEST['phone_number'];
				$objects->address = strip_tags(@$_REQUEST['address']);
				$objects->user_id = @$_REQUEST['user_id']; 
				$objects->state = strip_tags(@$_REQUEST['state']);
				$objects->password = strip_tags(@$_REQUEST['password']);
				$objects->country = @$_REQUEST['country'];
				if($model_users_editNewUser->emailExist($objects->email_add,$objects->user_id))
				{
					
					$_SESSION['error'] = "Email already exists";
					@header('Location:index.php?mod=mod_users&view=default&m=1');
					die;
				}
				$returndata= $model_users_editNewUser->saveData($objects);
				
				if($returndata=='Exist'){
					
						echo "<script> document.getElementById('content-table-inner').style.display = ''; 
	    				document.getElementById('err_mess').innerHTML = 'Email already exists';</script>";
						break;
						//@header('Location:index.php?mod=mod_users&view=addNewUser&m=1&s=6');
				}else if($returndata=='edit'){

						if(@$_REQUEST['p'])
						{
							$_SESSION['succ'] = "User details are updated successfully.";
							@header('Location:index.php?mod=mod_users&view=default&m=1&p='.$_REQUEST['p']);
						}
						else
						{
							$_SESSION['succ'] = "User details are updated successfully.";
							@header('Location:index.php?mod=mod_users&view=default&m=1');
						}

				}else{
					if(@$_REQUEST['p'])
					{
						$_SESSION['error'] = "Error in user update";
						@header('Location:index.php?mod=mod_users&view=default&r=2&p='.$_REQUEST['p']);
					}
					else
					{
						$_SESSION['error'] = "Error in user update";
						@header('Location:index.php?mod=mod_users&view=default&r=2');
					}
				}
				
				break;
				
				
				case 'edit_admin':
				
				
				//print_r($_SESSION);
				
				$model_users_editAdmin = new model_users_editadmin();
				$admin_data = $model_users_editAdmin->getUserData($_SESSION['user_Id']);
				
				//echo md5($_REQUEST['password']);die;
				if($admin_data[0]['password']!= md5($_REQUEST['password']))
				{
					@header('Location:index.php?mod=mod_users&view=editadmin&m=1&r=1');	
					die;
				}
				
				$objects = new stdClass();
				$abc = str_replace(" ","",$_REQUEST['user_name']);
				$objects->user_name = strip_tags(@$abc);
				
				$objects->email = strip_tags(@$_REQUEST['user_email']);
				$objects->password = strip_tags(@$_REQUEST['npassword']);
				
				$objects->user_id = @$_SESSION['user_Id']; 
				$returndata= $model_users_editAdmin->saveData($objects);
				if($returndata=='Exit'){
					
						echo "<script> document.getElementById('content-table-inner').style.display = ''; 
	    				document.getElementById('err_mess').innerHTML = 'Current password does not exist';</script>";
						break;
				}else if($returndata=='edit'){
					
						@header('Location:index.php?mod=mod_users&view=editadmin&d=3&user_id=1&s=8');
					
				}else{
							@header('Location:index.php?mod=mod_users&view=editadmin&d=3&user_id=1&r=1');
				}
				
				break;
				
				
				case 'edit_profile':
				
				
			//echo "<pre>";	print_r($_REQUEST); die;
				
				$model_users_editprofile = new model_users_editprofile();
				$admin_data = $model_users_editprofile->getUserData($_SESSION['user_Id']);
				
				$objects = new stdClass();
				$abc = str_replace(" ","",$_REQUEST['user_name']);
				$objects->user_name = strip_tags(@$abc);
				
				$objects->email = strip_tags(@$_REQUEST['user_email']);
				$objects->user_id = @$_SESSION['user_Id']; 
				//echo "<pre>";print_r($objects); die;
				$returndata= $model_users_editprofile->saveData($objects);
				//print_r($returndata); die;
				if($returndata=='edit'){
					
						$_SESSION['succ'] = "Admin profile has been updated successfully";
						@header('Location:index.php?mod=mod_users&view=editprofile&d=9&user_id=1');
					
				}else{
							$_SESSION['error'] = "current password doesnot match";
							@header('Location:index.php?mod=mod_users&view=editprofile&d=9&user_id=1');
				}
				
				break;
				
				

				case 'delete':
				$model_users_delete = new model_users_default();
				$objects = new stdClass();
				$objects->user_ids = @$_REQUEST['user_id'];
				$userids = '0';
				if(count($objects->user_ids)>0){
					for($i=0;$i<count($objects->user_ids);$i++){
						$userids .= ','.$objects->user_ids[$i];
					}
					
				}
				if($model_users_delete->deleteData($userids)){
					$_SESSION['succ'] = " selected User are deleted successfully";
					@header('Location:index.php?mod=mod_users&view=default&m=1');}else{
					$_SESSION['error'] = "Error in deleting records";
					@header('Location:index.php?mod=mod_users&view=default&m=1');
				 }
				break;
				
				case 'activate':
				$model_users_active = new model_users_default();
				$objects = new stdClass();
				$objects->user_ids = @$_REQUEST['user_id'];
				$userids = '0';
				if(count($objects->user_ids)>0){
					for($i=0;$i<count($objects->user_ids);$i++){
						$userids .= ','.$objects->user_ids[$i];
					}
				}
				
			
				if($model_users_active->changeStatus($userids,'activate')){
					$_SESSION['succ'] = "User are activated successfully.";
					@header('Location:index.php?mod=mod_users&view=default&m=1');}else{
					$_SESSION['error'] = "Error in user activation";
					@header('Location:index.php?mod=mod_users&view=default&m=1');
				 }
				break;

				case 'deactivate':
				$model_users_deactive = new model_users_default();
				$objects = new stdClass();
				$objects->user_ids = @$_REQUEST['user_id'];
				$userids = '0';
				if(count($objects->user_ids)>0){
					for($i=0;$i<count($objects->user_ids);$i++){
						$userids .= ','.$objects->user_ids[$i];
					}
					
				}
				if($model_users_deactive->changeStatus($userids,'deactivate')){
					$_SESSION['succ'] = "User are deactivated successfully.";
					@header('Location:index.php?mod=mod_users&view=default&m=1');}else{
					$_SESSION['error'] = "Error in deactivating user";
					@header('Location:index.php?mod=mod_users&view=default&m=1');
				 }
				break;

			}
	  }
}

?>