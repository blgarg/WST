<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
############### PAGE TITLE
switch($mod_str)
{ 
	case 'editTravel':
	  $pageTitle = 'Edit Travel Info';
	  $modTitle = 'Edit Travel';
	break;
	  case 'addNewtravel':
	  $pageTitle = 'Add New Info';
	  $modTitle = 'Add Travel';
	  break;
	 
	  default :
	  $pageTitle = 'Travel Guide';
	  $modTitle = 'Travel Guide';
	  $icon = '';
	  break;}

############### SUCCESSFULL ACTIONS
switch(@$_REQUEST['s'])
{ 
  case '1':
  $s_mess = 'New Travel data has been created successfully.';
  break;
  
  case '2':
   $s_mess = "Selected travel data has been Updated successfully";
  break;
  
  case '3':
   $s_mess = 'Selected travel(s) data has been deleted successfully.';
  break;
  
  case '4':
   $s_mess = 'Selected travel(s) data has been activated successfully.';
  break;
  
  case '5':
   $s_mess = 'Selected travel(s) has been deactivated successfully.';
  break;
  
  default :
  $s_mess = '';
  break;}
  
############### ERROR ACTIONS  
switch(@$_REQUEST['r'])
{ 
  case '1':
  $r_mess = "Server_Error";
  break;
  
  case '2':
   $r_mess = "Wrong Image Format";
  break;
  
   case '3':
	  $r_mess = Date;
	  break;
   
    
  
  default :
  $r_mess = '';
  break;
}
  


									