<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
print_r($mod_str);  die;
############### PAGE TITLE
switch($mod_str)
{ 
  default :
  $pageTitle = 'Gallery';
  $modTitle = 'Gallery';
  $icon = '';
  break;}



									