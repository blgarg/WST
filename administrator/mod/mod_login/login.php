<?php
class login_toolbar
{    var $mod_view;
		var $toolBr = '';
     function __contruct(){}
	 
	 function tooBar(){ 
	  switch(@$_GET['view'])
	   {
	     case 'default':
		 		return $this->dashboard();
				break;
		 
		 
		 default:
		    return;
		  break;
	   }
	    }
	   
	   
	   
	   function dashboard(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" >
						<tr>
						<td align="right" width="17%" valign="top">
						<a href = "" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/add_icn.png" width="20" height="20" alt="" />Add New</a></td>
						
						<td align="center" width="17%">
						<a href = "" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/edit icon.png" width="20" height="20" alt="" />Edit</a></td>
						
						<td align="center" width="17%" valign="top">
						<a href = "" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/delete.png" width="20" height="20" alt="" />Delete</a></td>
						
						<td align="center" width="17%">
						<a href = "" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/activate.png" width="20" height="20" alt="" />Activate</a></td>
						
						<td align="center" width="17%" valign="top">
						<a href = "" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/deactivate.png" width="20" height="20" alt="" />Deactivate</a></td>
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;
						
				}		
						

}