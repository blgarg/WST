<?php
class bar_toolbar
{    var $mod_view;
		var $toolBr = '';
     function __contruct(){}
	
	 function tooBar(){ 
	  switch(@$_GET['view'])
	   {
	     case 'default':
		 		return $this->dashboard();
				break;
		 case 'addNewbar':
		 		return $this->addNewbar();
				break;
		 case 'editbar':
		 		return $this->editbar();
				break;	
		/*case 'editPage':
		 		return $this->addNewbar();
				break;			
			
				
		 case 'ViewModel':
		 		return $this->ViewModel();
				break;	*/				
		 		
		 default:
		    return;
		  break;
	   }
	    }
	   
	   
	   
	   function dashboard(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="17%" >
						<a href = "./?mod=mod_bar&view=addNewbar&m=3&d=2" title="Add New">
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/add_icn.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.ADDNEW.'</b></a></td>
												
						<td align="center" width="17%" valign="top">
						<a href = "javascript:;" onClick="pageAction(\'delete\');" title="Delete" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/delete.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.DELETE.'</b></a></td>
						
						<td align="center" width="17%">
						<a href = "javascript:;" onClick="pageAction(\'activate\');" title="Activate" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/activate.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.ACTIVATE.'</b></a></td>
						
						<td align="center" width="17%" valign="top">
						<a href =  "javascript:;" onClick="pageAction(\'deactivate\');"  title="Deactivate" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/deactivate.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.DEACTIVATE.'</b></a></td>
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;
				}
				
/*		function addNewModel(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkAddmodel();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" />Save</a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_manageModel&view=default&m=4" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}*/
		function addNewbar(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" >&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkAddbar();"  title="Save">
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.SAVE.'</b></a></td>
			
			<td align="center" width="12%" >
			<a href = "./index.php?mod=mod_bar&view=default&d=5&m=4" title="Cancel">
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.CANCEL.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
		function editbar(){
		
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" >&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkEditbar();" title="Update">
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.Update.'</b></a></td>
			
			<td align="center" width="12%" >
			<a href = "./index.php?mod=mod_bar&view=default&d=5&m=4" title="Cancel">
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" align="top" />&nbsp;<b>'.Cancel.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
	/*	function editmodel(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkEditBanner();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" />Save</a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_manageModel&view=default&m=4" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
		function editpage(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkEditBanner();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" />Save</a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_manageModel&view=default&m=4" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
		
		function ViewModel(){
			$config_var = new config();
			$bannerId=$_REQUEST['bannerId'];
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = '."?mod=mod_newsBanner&view=editBanner&m=4&bannerId=".$bannerId."".'>
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/edit.png" width="20" height="20" alt="" />Edit</a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_newsBanner&view=default&m=4" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}*/								
						

}