<?php
class users_toolbar
{    var $mod_view;
		var $toolBr = '';
     function __contruct(){}
	 
	 function tooBar(){ 
	  switch(@$_GET['view'])
	   {
	     case 'default':
		 		return $this->dashboard();
				break;
		 case 'addNewUser':
		 		return $this->addNewUser();
				break;
				
		 case 'editUser':
		 		return $this->editUser();
				break;					
		  case 'detailUser':
		 		return $this->detailuser();
				break;
				
		  case 'editadmin':
		 		return $this->editadmin();
				break;	
		  case 'editprofile ':
		 		return $this->editprofile();
				break;					
		 
		 default:
		    return;
		  break;
	   }
	    }
	   
	   
	   
	   function dashboard(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="17%">
						<a href = "./index.php?mod=mod_users&view=addNewUser&m=1" title="Add New" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/add_icn.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.ADDNEW.'</b></a></td>
												
						<td align="center" width="17%" valign="top">
						<a href = "javascript:;" onClick="pageAction(\'delete\');" title="Delete" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/delete.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.DELETE.'</b></a></td>
						
						<td align="center" width="17%">
						<a href = "javascript:;" onClick="pageAction(\'activate\');" title="Activate" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/activate.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.ACTIVATE.'</b></a></td>
						
						<td align="center" width="17%" valign="top">
						<a href =  "javascript:;" onClick="pageAction(\'deactivate\');"  title="Deactivate" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/deactivate.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.DEACTIVATE.'</b></a></td>
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;
		}
				
		function addNewuser(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkAddUser();" title="Save" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.SAVE.'</b></a></td>
			
			<td align="center" width="12%">
			<a href = "./index.php?mod=mod_users&view=default&m=1" title="Cancel">
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.CANCEL.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}	
		
		function editUser(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkEditUser();" title="Update" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.Update.'</b></a></td>
			
			<td align="center" width="12%">
			<a href = "./index.php?mod=mod_users&view=default&m=1" title="Cancel" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.Cancel.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}	
		
		function editadmin(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			
			</table>';
			
			return $this->toolBr;
		}	
		
		function editprofile(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			
			</table>';
			
			return $this->toolBr;
		}	
		
		
		function detailuser(){
			$config_var = new config();
			$userId=$_REQUEST['user_id'];
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" >&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = '."?mod=mod_users&view=editUser&d=2&user_id=".$userId."".'>
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/edit.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.EDIT.'</b></a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_users&view=default&d=2" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.CANCEL.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}					
						

}
?>