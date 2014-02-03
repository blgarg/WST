<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
############### PAGE TITLE
switch($mod_str)
{ 
	case 'editupcoming':
	  $pageTitle = 'Edit Upcoming';
	  $modTitle = 'Edit Upcoming';
	break;
	 
	  default :
	  $pageTitle = 'Upcoming';
	  $modTitle = 'Upcoming';
	  $icon = '';
	  break;}
  


									