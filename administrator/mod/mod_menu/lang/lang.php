<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
switch($mod_str)
{ case 'product':
  $pageTitle = 'Product Listing';
  $modTitle = 'All Product';
  break;
  
  default :
  $pageTitle = 'Moogla';
  $modTitle = 'Menus';
  break;}


									