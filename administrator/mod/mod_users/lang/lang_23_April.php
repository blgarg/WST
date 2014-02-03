<?php
global $mod_view;
$mod_str = isset($mod_view)?$mod_view:'';
############### PAGE TITLE
switch($mod_str)
{ 
  case 'addNewUser':
  $pageTitle = 'Add New User';
  $modTitle = 'Add New User';
  break;
  
  case 'editUser':
  $pageTitle = 'Edit User';
  $modTitle = 'Edit User';
  break;
  
  case 'detailUser':
  $pageTitle = 'User Detail';
  $modTitle = 'User Detail';
  break;
  
  case 'editadmin':
  $pageTitle = PROFILESETTING;
  $modTitle = PROFILESETTING;
  break;
  
  default :
  $pageTitle = 'Tunezy';
  $modTitle = 'Manage Users';
  $icon = '';
  break;}

############### SUCCESSFULL ACTIONS
if(isset($_REQUEST['s'])) {
		switch($_REQUEST['s'])
		{ 
		  case '1':
		  $s_mess = 'User has been saved successfully.';
		  break;
		  
		  case '2':
		   $s_mess = 'User has been updated successfully.';
		  break;
		  
		  case '3':
		   $s_mess = 'User(s) has been deleted successfully.';
		  break;
		  
		  case '4':
		   $s_mess = 'User(s) has been activated successfully.';
		  break;
		  
		  case '5':
		   $s_mess = 'User(s) has been deactivated successfully.';
		  break;
		  case '6':
		   $s_mess = 'User already exist.';
		  break;
		  
		  case '7':
		   $s_mess = 'Admin profile has been updated.';
		  break;
		  
		  
		  default :
		  $s_mess = '';
		  break;}
}		  
############### ERROR ACTIONS  

if(isset($_REQUEST['r'])){
	switch($_REQUEST['r'])
	{ 
	  case '1':
	  $r_mess = 'Sorry , Server error.';
	  break;
	  
	  case '2':
	   $r_mess = 'User has been updated successfully.';
	  break;
	  
	 
	  
	  default :
	  $r_mess = '';
	  break;
	}
	  
}

									