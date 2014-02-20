<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:''; 
############### PAGE TITLE
switch($mod_str)
{ 
  case 'addNewCategory':
  $pageTitle = 'Add Forum Sub Category';
  $modTitle = 'Add Forum Sub Category';
  break;
  case 'editCategory':
  $pageTitle = 'Edit Forum Sub Category';
  $modTitle = 'Edit Forum Sub Category';
  break;
  
  default :
  $pageTitle = 'Manage Forum Sub Category';
  $modTitle = 'Manage Forum Sub Category';
  $icon = '';
  break;}

############### SUCCESSFULL ACTIONS
switch($_REQUEST['s'])
{ 
  case '1':
  $s_mess = 'New Forum has been added successfully.';
  break;
  
  case '2':
   $s_mess = 'Forum Updated successfully';
  break;
  
  case '3':
   $s_mess = 'Forum deleted successfully.';
  break;
  
  case '4':
   $s_mess = 'Forum has been activated successfully.';
  break;
  
  case '5':
   $s_mess = 'Forum has been deactivated successfully.';
  break;
  
  default :
  $s_mess = '';
  break;}
  



									