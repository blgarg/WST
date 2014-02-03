<?php
class booksStore_toolbar
{    var $mod_view;
		var $toolBr = '';
     function __contruct(){}
	 
	 function tooBar(){ 
	  switch(@$_GET['view'])
	   {
	     case 'default':
		 		return $this->dashboard();
				break;
		 case 'addNewBook':
		 		return $this->addNewBook();
				break;
		case 'editBook':
		 		return $this->addNewBook();
				break;	
		case 'sellBooks':			
		 		return $this->see_cart();
				break;
		case 'bookdetail':
				return $this->see_cart();
				break;
		case 'issueBooks':			
		 		return $this->see_issue();
				break;
		case 'bookissue_detail':
				return $this->see_issue();
				break;			
		case 'seeCart':
				return $this->for_cart();
				break;
		case 'issue':
				return $this->for_issue();
				break;				
		/* case 'editModel':
		 		return $this->editmodel();
				break;	
		case 'editPage':
		 		return $this->addNewUser();
				break;			
			
				
		 case 'ViewModel':
		 		return $this->ViewModel();
				break;	*/				
		 		
		 default:
		    return;
		  break;
	   }
	    }
		function for_cart(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="53%" valign="top"><b>Your cart contains <font color="#94B52C" size="4">'.count($_SESSION['cart']).'</font> books</b>
						<a href = "./?mod=mod_booksStore&view=seeCart&m=2" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/cart_check.png" width="20" height="20" alt="" />Check cart</a></td>
						<td align="center" width="17%" valign="top">
						<a href = "javascript:;" onClick="update_cart();" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/update_cart.png" width="20" height="20" alt="" />Update cart</a></td>
												
						<td align="center" width="17%" valign="top">
						<a href = "javascript:;" onClick="clear_cart();" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/delete.png" width="20" height="20" alt="" />Empty cart</a></td>
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;
				}
		function for_issue()
		{
		
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="53%" valign="top"><b>Issue cart contain <font color="#94B52C" size="4">'.count($_SESSION['issue_cart']).'</font> books</b>
						<a href = "./?mod=mod_booksStore&view=issue&m=4" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/cart_check.png" width="20" height="20" alt="" />Issue cart</a></td>
						<td align="center" width="17%" valign="top">
						<a href = "javascript:;" onClick="update_issue_cart();" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/update_cart.png" width="20" height="20" alt="" />Update cart</a></td>
												
						<td align="center" width="17%" valign="top">
						<a href = "javascript:;" onClick="clear_issue_cart();" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/delete.png" width="20" height="20" alt="" />Empty cart</a></td>
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;
				
		}		
		function see_cart(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="53%" valign="top"><b>Your cart contains <font color="#94B52C" size="4">'.count($_SESSION['cart']).'</font> books</b>
						<a href = "./?mod=mod_booksStore&view=seeCart&m=2" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/cart_check.png" width="20" height="20" alt="" />Check cart</a></td>
												
						
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;
				}
		function see_issue()
		{
		
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="53%" valign="top"><b>Issue cart contain <font color="#94B52C" size="4">'.count($_SESSION['issue_cart']).'</font> books</b>
						<a href = "./?mod=mod_booksStore&view=issue&m=4" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/cart_check.png" width="20" height="20" alt="" />Issue cart</a></td>
												
						
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;
				
		}		
		function dashboard(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="17%" valign="top">
						<a href = "./?mod=mod_writers&view=addNewWriter&m=4" >
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
					            </table>';
						
						return $this->toolBr;
				}
				function addNewBook(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="17%" valign="top">
						<a href = "./?mod=mod_writers&view=addNewWriter&m=4" >
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
					            </table>';
						
						return $this->toolBr;
				}
	   
	}   
	   //function see_cart(){}