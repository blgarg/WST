<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
//print_r($mod_str); die;
############### PAGE TITLE
switch($mod_str)
{ 
  case 'addNewVideo':
  $pageTitle = 'Add New Video';
  $modTitle = 'Add New Video';
  break;
  case 'detail':
  $pageTitle = 'Royality Detail';
  $modTitle = 'Royality Detail';
  break;
  case 'editVideo':
  $pageTitle = 'Edit video';
  $modTitle = 'Edit video';
  break;
  
   case 'ViewBanner':
  $pageTitle = 'News Banner View';
  $modTitle = 'News Banner View';
  break;
  
  default :
  $pageTitle = 'WST';
  $modTitle = 'Manage Videos';
  $icon = '';
  break;}

############### SUCCESSFULL ACTIONS
 switch($_REQUEST['s'])
{
  case '1':
  $s_mess = 'New Video has been saved successfully.';
  break;
  
  case '2':
   $s_mess = 'Video has been updated successfully.';
  break;
  
  case '3':
   $s_mess = 'All selected videos has been deleted successfully.';
  break;
  
  case '4':
   $s_mess = 'Video has been activated successfully.';
  break;
  
  case '5':
   $s_mess = 'Video has been deactivated successfully.';
  break;
  
  default :
  $s_mess = '';
  break; 
 } 
############### ERROR ACTIONS  
switch($_REQUEST['r'])
{ 
  case '1':
  $r_mess = 'Sorry , Unable to delete properly.';
  break;
  
  case '2':
   $r_mess = 'Selected image format not valid.';
  break;
  
   case '3':
	  $r_mess = "Future date is not allowed.";
	  break;
   
    case '4':
	$r_mess = "Error in uploading video";
	break;
	
	case '5':
	$r_mess = "File size should not be greater than 20MB";
	break;
  default :
  $r_mess = '';
  break;
}
  


									