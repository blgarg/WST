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
  $modTitle = 'Manage CMS';
  $icon = '';
  break;}

############### SUCCESSFULL ACTIONS
switch($_REQUEST['s'])
{ 
  case '1':
  $s_mess = New_Page;
  break;
  
  case '2':
   $s_mess = 'Page has been updated successfully';
  break;
  
  case '3':
   $s_mess = Page_Deleted;
  break;
  
  case '4':
   $s_mess = Page_Activated;
  break;
  
  case '5':
   $s_mess = Page_Deactivated;
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
  


									