<?php 
class ToolBar 
{	var $_mod_name = '';
	var $_form_name = '';
	var $_form_id = '';
	var $_form_add_link = '';  
	var $_form_edit_link = '';
	var $_form_cancel_link = '';
	var $_form_activate = '';
	var $_form_deactivate_link = '';
	var $_button_name = '';
	
	
	
	function __construct()
	{
		
	}
	
	function save()
	{}
	
	function add()
	{
		$config_var = new config();
		$button = '<a href = "'.$this->_form_add_link.'" ><img src="'.$config_var->ADMIN_TPL_URL.'images/shared/add_icn.png" width="20" height="20" alt="" />'.$this->_button_name.'</a>';
		return $button;
	}
	
	function edit()
	{
		$config_var = new config();
		$button = '<a href = "'.$this->_form_edit_link.'" ><img src="'.$config_var->ADMIN_TPL_URL.'images/shared/edit icon.png" width="20" height="20" alt="" />'.$this->_button_name.'</a>';
		return $button;
	}
	
	function delete()
	{
	$config_var = new config();
		$button = '<a href = "'.$this->_form_edit_link.'" ><img src="'.$config_var->ADMIN_TPL_URL.'images/shared/delete.png" width="20" height="20" alt="" />'.$this->_button_name.'</a>';
		return $button;
	}
	
	function activate()
	{
	$config_var = new config();
		$button = '<a href = "'.$this->_form_edit_link.'" ><img src="'.$config_var->ADMIN_TPL_URL.'images/shared/activate.png" width="20" height="20" alt="" />'.$this->_button_name.'</a>';
		return $button;
	}
	
	function deactivate()
	{
	$config_var = new config();
		$button = '<a href = "'.$this->_form_edit_link.'" ><img src="'.$config_var->ADMIN_TPL_URL.'images/shared/deactivate.png" width="20" height="20" alt="" />'.$this->_button_name.'</a>';
		return $button;
	}
	
	function cancel()
	{
	$config_var = new config();
		$button = '<a href = "'.$this->_form_edit_link.'" ><img src="'.$config_var->ADMIN_TPL_URL.'images/shared/cancel.png" width="20" height="20" alt="" />'.$this->_button_name.'</a>';
		return $button;
	
	}
	
	
	
	}