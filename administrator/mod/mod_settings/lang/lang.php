<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
switch($mod_str)
{ 
  
  default :
  $pageTitle = 'Moogla';
  $modTitle = GLOBALSETTING;
  $icon = 'settings';
  break;
  
  }
  
  switch($_REQUEST['s'])
{ 
  case '1':
  $s_mess = Settings;
  break;
} 
  
  
switch($_REQUEST['r'])
{ 
  case '1':
  $r_mess = Server_Error;
  break;  
}  
  


									