<?php
class cms_toolbar
{    var $mod_view;
		var $toolBr = '';
     function __contruct(){}
	 
	 function tooBar(){ 
	  switch(@$_GET['view'])
	   {
	     case 'default':
		 		return $this->dashboard();
				break;
		 case 'addNewPage':
		 		return $this->addNewPage();
				break;
		 case 'editModel':
		 		return $this->editmodel();
				break;	
		case 'editPage':
		 		return $this->addNewPage();
				break;			
			
				
		 case 'ViewModel':
		 		return $this->ViewModel();
				break;					
		 		
		 default:
		    return;
		  break;
	   }
	    }
	   
	   
	   
	   function dashboard(){
	   $config_var = new config();
	   
								
		/*$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						 						
						<td align="right" width="45%">
						<a href = "javascript:;" onClick="pageAction(\'activate\');"  >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/activate.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.ACTIVATE.'</b></a></td>
						
						<td align="right" width="17%" >
						<a href =  "javascript:;" onClick="pageAction(\'deactivate\');"   >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/deactivate.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.DEACTIVATE.'</b></a></td>
						
						
						</tr>
					            </table>';	*/
													
		/*$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						 <tr>
						<td align="center" width="17%" valign="top">
						<a href = "./?mod=mod_cms&view=addNewPage&d=3" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/add_icn.png" width="20" height="20" alt="" />Add New</a></td>
												
						<td align="center" width="17%" valign="top">
						<a href = "javascript:;" onClick="pageAction(\'delete\');" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/delete.png" width="20" height="20" alt="" />Delete</a></td>
						
						<td align="center" width="17%">
						<a href = "javascript:;" onClick="pageAction(\'activate\');"  >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/activate.png" width="20" height="20" alt="" />Activate</a></td>
						
						<td align="center" width="17%" valign="top">
						<a href =  "javascript:;" onClick="pageAction(\'deactivate\');"   >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/deactivate.png" width="20" height="20" alt="" />Deactivate</a></td>
						
						
						</tr>
					            </table>';		*/		
						return $this->toolBr;
				}
				
		function addNewModel(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkAddmodel();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" />Save</a></td>
			
			<td align="center" width="12%" >
			<a href = "./index.php?mod=mod_manageModel&view=default&m=1" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
		function addNewPage(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" >&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkAddPage();" title="Update" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.UPDATE.'</b></a></td>
			
			<td align="center" width="12%" >
			<a href = "./index.php?mod=mod_cms&view=default&d=2"  title="Cancel">
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.CANCEL.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
		function editmodel(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" >&nbsp;</td>
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkEditBanner();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>Save</b></a></td>
			
			<td align="center" width="12%" >
			<a href = "./index.php?mod=mod_manageModel&view=default&m=1" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>Cancel</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
		function editpage(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" >&nbsp;</td>
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkEditBanner();" title="Update">
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.UPDATE.'</b></a></td>
			
			<td align="center" width="12%" >
			<a href = "./index.php?mod=mod_cms&view=default&d=2" title="Cancel" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.CANCEL.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
		
		function ViewModel(){
			$config_var = new config();
			$bannerId=$_REQUEST['bannerId'];
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" >&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = '."?mod=mod_newsBanner&view=editBanner&m=1&bannerId=".$bannerId."".'>
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/edit.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>Edit</b></a></td>
			
			<td align="center" width="12%" >
			<a href = "./index.php?mod=mod_newsBanner&view=default&m=1" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>Cancel</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}								
						

}