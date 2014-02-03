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
		 		return $this->editBook();
				break;	
		case 'purchaseBooks':
		 		return $this->addPurchaseBook();
				break;	
		case 'editpurchaseBooks':
		 		return $this->editPurchaseBook();
				break;	
		case 'sellBooks':			
		 		return $this->see_cart();
				break;
		case 'sell_books':
		 		return $this->see_cart();
				break;
		case 'bookdetail':
				return $this->see_cart();
				break;
		case 'issue_type':
		 		return $this->see_issue();
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
		case 'NewOrder':			
		 		return $this->see_order();
				break;	
		case 'generateOrders':
		 		return $this->see_order();
				break;	
		case 'seeOrder':
		return $this->see_order_cart();
				break;	
		case 'orderDetail':
		return $this->orders_list();
				break;	
		case 'detail':
		return $this->orders_detail();
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
		function orders_detail()
		{
	 $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="right" width="17%" valign="top">
						<a href = "javascript:;" onClick="window.history.back();" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/back.png" width="20" height="20" alt="" />Go Back</a></td></tr>
					            </table>';
						
						return $this->toolBr;
				
		
		}
		function orders_list()
		{
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="right" width="17%" valign="top">
						<a href = "./?mod=mod_booksStore&view=NewOrder&m=7" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/add_icn.png" width="20" height="20" alt="" />Generate Order</a></td>
												
						
						
						
						</tr>
					            </table>';
						
						return $this->toolBr;
				}
		function see_order_cart()
		{
	 $config_var = new config();
	 if(count($_SESSION['order'])>0)
	 {
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="53%" valign="top"><b>Order cart contain <font color="#94B52C" size="4">'.count($_SESSION['order']).'</font> books</b>
						<a href = "./?mod=mod_booksStore&view=seeOrder&m=7" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/cart_check.png" width="20" height="20" alt="" />Order cart</a></td>
						<td align="center" width="17%" valign="top">
						<a href = "javascript:;" onClick="update_order_cart();" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/update_cart.png" width="20" height="20" alt="" />Update cart</a></td>
												
						<td align="center" width="17%" valign="top">
						<a href = "javascript:;" onClick="clear_order_cart();" >
						<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/delete.png" width="20" height="20" alt="" />Empty cart</a></td>
						
						
						</tr>
					            </table>';
	 }
	 else 
	 {
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="37%" border="0" >
						<tr>
						<td align="center" width="53%" valign="top"><b>Order cart contain <font color="#94B52C" size="4">'.count($_SESSION['order']).'</font> books</b>
						</td>
						</tr>
					            </table>';
	 }
	 
						
						return $this->toolBr;
				
		
		}
		function for_cart(){
	   $config_var = new config();
	   if(count($_SESSION['cart'])>0)
	   {
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
				}
				else
				{
				
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="37%" border="0" >
						<tr>
						<td align="center" width="53%" valign="top"><b>Your cart contains <font color="#94B52C" size="4">'.count($_SESSION['cart']).'</font> books</b>
						</td>
						</tr>
					            </table>';
				
				}		
						return $this->toolBr;
				}
		function for_issue()
		{
		
	   $config_var = new config();
	   if(count($_SESSION['issue_cart'])>0)
	   {
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
		}
		else
		{
		
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="34%" border="0" >
						<tr>
						<td align="center" width="53%" valign="top"><b>Issue cart contain <font color="#94B52C" size="4">'.count($_SESSION['issue_cart']).'</font> books</b>
						</td></tr>
					            </table>';
		
		}				
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
		function see_order(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
						<td align="center" width="53%" valign="top"><b>Your order cart contains <font color="#94B52C" size="4">'.count($_SESSION['order']).'</font> books</b>
						<a href = "./?mod=mod_booksStore&view=seeOrder&m=7" >
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
						<a href = "./?mod=mod_booksStore&view=addNewBook&m=3" >
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
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkAddbook();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" />Save</a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_booksStore&view=default&m=1" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		}
	   function editBook()
	   {
	   
			$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkeditbook();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" />Save</a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_booksStore&view=default&m=1" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		
	   }
	   function addPurchaseBook()
	   {	$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkPurchasebook();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" />Save</a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_booksStore&view=default&m=1" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		 }
		 function editPurchaseBook()
		 {
		 	$config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%" valign="top">&nbsp;</td>
			
			
			
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkPurchasebook();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt="" />Save</a></td>
			
			<td align="center" width="12%" valign="top">
			<a href = "./index.php?mod=mod_booksStore&view=default&m=1" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />Cancel</a></td>
			</tr>
			</table>';
			
			return $this->toolBr;
		 
		 }
	}   
	   //function see_cart(){}