<?php
class payments_toolbar
{    var $mod_view;
		var $toolBr = '';
     function __contruct(){}
	 
	 function tooBar(){ 
	  switch(@$_GET['view'])
	   {
	     case 'default_demo':
		 		return $this->dashboard();
				break;
		 case 'recivepaymt':
		 		return $this->addNew();
				break;
		case 'editAgent':
		 		return $this->addNewAgent();
				break;
		case 'detail':
				return $this->goback();
				break;
		case 'booksdetail':
				return $this->goback2();
				break;
		case 'addNewMagazines':
		 		return $this->addNewMagazines();
				break;				
		case 'editMagazines':
		 		return $this->EDITMagazines();
				break; 		
		 default:
		    return;
		  break;
	   }
	    }
	   
	   
	   function goback()
	   {
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="17%">
						</td>
												
						<td align="center" width="17%">
						</td>
						
						<td align="center" width="17%">
						
						</td>
						
						<td align="center" width="17%" >
						<a href =  "?mod=mod_magazines&view=default&m=5"   >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/back.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.GOBACK.'</b></a></td>
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;	   
	   }
	   
	    function goback2()
	   {
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="17%">
						</td>
												
						<td align="center" width="17%">
						</td>
						
						<td align="center" width="17%">
						
						</td>
						
						<td align="center" width="17%" valign="top">
						<a href =  "javascript:;" onClick="window.history.back();"   >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/back.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.GOBACK.'</b></a></td>
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;	   
	   }
	   
	   function dashboard(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="17%">
						<a href = "./?mod=mod_magazines&view=addNewMagazines&m=9" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/add_icn.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.ADDNEW.'</b></a></td>
												
						<td align="center" width="17%">
						<a href = "javascript:;" onClick="pageAction(\'delete\');" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/delete.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.DELETE.'</b></a></td>
						
						<td align="center" width="17%">
						<a href = "javascript:;" onClick="pageAction(\'activate\');"  >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/activate.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.ACTIVATE.'</b></a></td>
						
						<td align="center" width="17%">
						<a href =  "javascript:;" onClick="pageAction(\'deactivate\');"   >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/deactivate.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.DEACTIVATE.'</b></a></td>
						
						
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
			<a href = "./index.php?mod=mod_manageModel&view=default&m=1" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}*/
		function addNew(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkAddpmt();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.SAVE.'</b></a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_payments&view=default&m=11&d=5" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.CANCEL.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
			function addNewMagazines(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkAddmagazine();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.SAVE.'</b></a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_magazines&view=default&m=9" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.CANCEL.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
		function EDITMagazines(){
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkAddmagazine();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.Update.'</b></a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_magazines&view=default&m=9" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.CANCEL.'</b></a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}						
						

}