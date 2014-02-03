<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
############### PAGE TITLE
switch($mod_str)
{ 
	case 'editbar':
	  $pageTitle = 'Edit bar';
	  $modTitle = 'Edit Bar & Pub';
	break;
	  case 'addNewbar':
	  $pageTitle = 'Add bar';
	  $modTitle = 'Add Bar & Pub';
	  break;
	 
	  default :
	  $pageTitle = 'Manage 	bar';
	  $modTitle = 'Manage Bar & Pub';
	  $icon = '';
	  break;}

############### SUCCESSFULL ACTIONS
switch($_REQUEST['s'])
{ 
  case '1':
  $s_mess = 'Bar is created successfully.';
  break;
  
  case '2':
   $s_mess = "Bar details Updated successfully";
  break;
  
  case '3':
   $s_mess = 'Selected bar has been deleted successfully.';
  break;
  
  case '4':
   $s_mess = 'Selected bar has been activated successfully.';
  break;
  
  case '5':
   $s_mess = 'Selected bar has been deactivated successfully.';
  break;
  
  default :
  $s_mess = '';
  break;}
  
############### ERROR ACTIONS  
switch($_REQUEST['r'])
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
  


									