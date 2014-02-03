<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
############### PAGE TITLE
switch($mod_str)
{ 
  case 'addNewBook':
  $pageTitle = 'Add New Book';
  $modTitle = 'Add New Book';
  break;
  case 'purchaseBooks':
  $pageTitle = 'Purchase books section';
  $modTitle = 'Purchase books section';
  break;
  case 'issueBooks':
  $pageTitle = 'Issue Books';
  $modTitle = 'Issue Books';
  break;
  case 'sell_books':
  $pageTitle = 'Sell Books';
  $modTitle = 'Sell Books';
  break;
  case 'NewOrder':
  $pageTitle = 'Add Order';
  $modTitle = 'Add Order';
  break;
  case 'orderbookdetail':
  $pageTitle = 'Add Order';
  $modTitle = 'Add Order';
  break;
   case 'sellBooks':
  $pageTitle = 'Sell Books';
  $modTitle = 'Sell Books';
  break;
	case 'issue_type':
	 $pageTitle = 'Issue Books';
  $modTitle = 'Issue Books';
  break;
   case 'sellBooks':
  $pageTitle = 'Sell Books';
  $modTitle = 'Sell Books';
  break;
  case 'seeCart':
  $pageTitle = 'Books Cart Detail';
  $modTitle = 'Books Cart Detail';
  break;
  case 'bookdetail':
  $pageTitle = 'Full detail of the book';
  $modTitle = 'Full detail of the book';
  break;
  case 'bookissue_detail':
  $pageTitle = 'Full detail of the book';
  $modTitle = 'Full detail of the book';
  break;
  case 'seeOrder':
  $pageTitle = 'Order cart';
  $modTitle = 'Order cart';
  break;
  case 'detail':
  $pageTitle = 'Book order detail';
  $modTitle = 'Book order detail';
  break;
  case 'orderDetail':
  $pageTitle = 'Orders list';
  $modTitle = 'Orders list';
  break;
  default :
  $pageTitle = 'HGA';
  $modTitle = 'Manage Books';
  $icon = '';
  break;}

############### SUCCESSFULL ACTIONS
switch($_REQUEST['s'])
{ 
  case '1':
  $s_mess = 'New book has been saved successfully.';
  break;
  
  case '2':
   $s_mess = 'Book information has been updated successfully.';
  break;
  
  case '3':
   $s_mess = 'Book has been deleted successfully.';
  break;
  
  case '4':
   $s_mess = 'Book has been activated successfully.';
  break;
  
  case '5':
   $s_mess = 'Book has been deactivated successfully.';
  break;
  
  case '6':
  $s_mess = 'Book has been successfully add into the cart.';
  break;
  
  case '7':
  $s_mess = 'Book has been successfully gifted to the person.';
  break;
  case '8':
  $s_mess = 'Book has been successfully issued to the person.';
  break;
  case '9':
  $s_mess = 'Some books quantity not updated, so please enter minimum quantity as available.';
  break;
  case '10':
  $s_mess = 'Books quantity has been successfully updated.';
  break;
  case '11':
  $s_mess = 'Books order has been successfully completed.';
  break;
  default :
  $s_mess = '';
  break;}
  
############### ERROR ACTIONS  
switch($_REQUEST['r'])
{ 
  case '1':
  $r_mess = 'Sorry , Server error.';
  break;
  
  case '2':
   $r_mess = 'Selected image format not valid.';
  break;
  
   case '3':
	  $r_mess = "Future date is not allowed.";
	  break;
   
  case '4':
     $r_mess = "Please enter minimum quantity as compare to available quantity.";
	 setcookie("cook_quantity","",time()-60*60);
	  break;
  
  case '5':
     $r_mess = "Please update your cart, because current books quantity have become more as compare to available quantity.";
	 setcookie("cook_quantity","",time()-60*60);
	  break;
	case '6':
     $r_mess = "Some books quantity are not updated, so please enter minimum quantity as available.";
	 break;  
	 case '7':
     $r_mess = "This product all ready exist in your order.";
	 break; 
  default :
  $r_mess = '';
  break;
}
  


									