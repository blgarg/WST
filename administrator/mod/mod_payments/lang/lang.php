<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
############### PAGE TITLE
switch($mod_str)
{ 
  case 'recivepaymt':
  $pageTitle = RECIVEPMT;
  $modTitle = RECIVEPMT;
  break;
   
  default :
  $pageTitle = 'Manage Payment';
  $modTitle = "Manage Payment";
  $icon = '';
  break;}

############### SUCCESSFULL ACTIONS
switch($_REQUEST['s'])
{ 
  case '1':
  $s_mess = PMTSUCC;
  break;
  
  case '2':
   $s_mess = Payment_Updated;
  break;
  
  case '3':
   $s_mess = Payment_Deleted;
  break;
  
  case '4':
   $s_mess = Payment_Activated;
  break;
  
  case '5':
   $s_mess = Payment_Deactivated;
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
 
   
    
  
  default :
  $r_mess = '';
  break;
}
  


									