<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:''; 
############### PAGE TITLE
switch($mod_str)
{ 
  case 'addNewCategory':
  $pageTitle = 'Add Category';
  $modTitle = 'Add Category';
  break;
  
  default :
  $pageTitle = 'Manage Category';
  $modTitle = 'Manage Category';
  $icon = '';
  break;}

############### SUCCESSFULL ACTIONS
switch($_REQUEST['s'])
{ 
  case '1':
  $s_mess = 'New category has been added successfully.';
  break;
  
  case '2':
   $s_mess = 'Category Updated successfully';
  break;
  
  case '3':
   $s_mess = 'Category deleted successfully.';
  break;
  
  case '4':
   $s_mess = 'Category has been activated successfully.';
  break;
  
  case '5':
   $s_mess = 'Category has been deactivated successfully.';
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
  


									