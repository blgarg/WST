<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
############### PAGE TITLE
switch($mod_str)
{ 
	case 'editType':
	  $pageTitle = 'Edit Type';
	  $modTitle = 'Edit Type';
	break;
	  case 'addNewtype':
	  $pageTitle = 'Add Type';
	  $modTitle = 'Add Type';
	  break;
	 
	  default :
	  $pageTitle = 'Manage Type';
	  $modTitle = 'Manage Type';
	  $icon = '';
	  break;}

############### SUCCESSFULL ACTIONS
switch(@$_REQUEST['s'])
{ 
  case '1':
  $s_mess = 'New type is added successfully.';
  break;
  
  case '2':
   $s_mess = "Type detail has been Updated successfully";
  break;
  
  case '3':
   $s_mess = 'Selected type(s) has been deleted successfully.';
  break;
  
  case '4':
   $s_mess = 'Selected type(s) has been activated.';
  break;
  
  case '5':
   $s_mess = 'Selected type(s) has been deactivated.';
  break;
  
  default :
  $s_mess = '';
  break;}
  
############### ERROR ACTIONS  
switch(@$_REQUEST['r'])
{ 
  case '1':
  $r_mess = Server_Error;
  break;
  
  case '2':
   $r_mess = Image_Format;
  break;
  
   case '3':
	  $r_mess = Date;
	  break;
   
    
  
  default :
  $r_mess = '';
  break;
}
  


									