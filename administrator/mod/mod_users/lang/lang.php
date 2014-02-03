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
  $pageTitle = "Change Password";
  $modTitle = "Change Password";
  break;
  case 'editprofile':
  $pageTitle = "Change Profile";
  $modTitle = "Change Profile";
  break;
  
  default :
  $pageTitle = 'Manage Users';
  $modTitle = 'Manage Users';
  $icon = '';
  break;}

############### SUCCESSFULL ACTIONS
if(isset($_REQUEST['s'])) {
		switch($_REQUEST['s'])
		{ 
		  case '1':
		  $s_mess = 'New user is created successfully.';
		  break;
		  
		  case '2':
		   $s_mess = 'User details are updated successfully.';
		  break;
		  
		  case '3':
		   $s_mess = 'User(s) are deleted successfully.';
		  break;
		  
		  case '4':
		   $s_mess = 'User(s) are activated successfully.';
		  break;
		  
		  case '5':
		   $s_mess = 'User(s) are deactivated successfully.';
		  break;
		  case '6':
		   $s_mess = User_Name;
		  break;
		  
		  case '7':
		   $s_mess = "Admin profile has been updated successfully";
		  break;
		  
		   case '8':
		   $s_mess = "Admin password has been updated successfully";
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
	  $r_mess = "Current password does not match";
	  break;
	  
	  case '2':
	   $r_mess = User_Update;
	  break;
	  
	 
	  
	  default :
	  $r_mess = '';
	  break;
	}
	  
}

									