<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
############### PAGE TITLE
switch($mod_str)
{ 
	case 'editgallery':
	$pageTitle = 'Edit Gallery';
	$modTitle = 'Edit Gallery';
	break;
	  case 'addNewgallery':
	  $pageTitle = 'Add Gallery';
	  $modTitle = 'Add Gallery';
	  break;
  
	  default :
	  $pageTitle = 'Manage Gallery';
	  $modTitle = 'Manage Gallery';
	  $icon = '';
	  break;}

############### SUCCESSFULL ACTIONS
switch($_REQUEST['s'])
{ 
  case '1':
  $s_mess = 'New gallery added successfully.';
  break;
  
  case '2':
   $s_mess = 'Gallery image Updated successfully.';
  break;
  
  case '3':
   $s_mess = 'Gallery image(s) deleted successfully.';
  break;
  
  case '4':
   $s_mess = 'Gallery image(s) has been activated.';
  break;
  
  case '5':
   $s_mess = 'Gallery image(s) has been deactivated.';
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
  


									