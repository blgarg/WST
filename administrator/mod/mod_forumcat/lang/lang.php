<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:''; 
############### PAGE TITLE
switch($mod_str)
{ 
  case 'addNewCategory':
  $pageTitle = 'Add Forum Category';
  $modTitle = 'Add Forum Category';
  break;
  case 'editCategory':
  $pageTitle = 'Edit Forum Category';
  $modTitle = 'Edit Forum Category';
  break;
  
  default :
  $pageTitle = 'Manage Forum Category';
  $modTitle = 'Manage Forum Category';
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
  



									