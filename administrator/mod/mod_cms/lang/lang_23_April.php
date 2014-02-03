<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
############### PAGE TITLE
switch($mod_str)
{ 
  case 'addNewPage':
  $pageTitle = 'Add New Page';
  $modTitle = 'Add New Page';
  break;
  
  case 'editModel':
  $pageTitle = 'Edit Model';
  $modTitle = 'Edit Model';
  break;
  
   case 'ViewBanner':
  $pageTitle = 'News Banner View';
  $modTitle = 'News Banner View';
  break;
  
  default :
  $pageTitle = 'HGA';
  $modTitle = MANAGECMS;
  $icon = '';
  break;}

############### SUCCESSFULL ACTIONS
switch($_REQUEST['s'])
{ 
  case '1':
  $s_mess = 'New page has been saved successfully.';
  break;
  
  case '2':
   $s_mess = 'Page has been updated successfully.';
  break;
  
  case '3':
   $s_mess = 'Page has been deleted successfully.';
  break;
  
  case '4':
   $s_mess = 'Page has been activated successfully.';
  break;
  
  case '5':
   $s_mess = 'Page has been deactivated successfully.';
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
   
    
  
  default :
  $r_mess = '';
  break;
}
  


									