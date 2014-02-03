<?php
class settings_toolbar
{    var $mod_view;
		var $toolBr = '';
     function __contruct(){}
	 
	 function tooBar(){ 
	  switch(@$_GET['view'])
	   {
	     case 'default':
		 		return $this->dashboard();
				break;
		 
		 
		 default:
		    return;
		  break;
	   }
	    }
	   
	   
	   
	   function dashboard(){
	  $config_var = new config();
			$this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%"  align="right">
			<tr>
			<td align="right" width="17%">&nbsp;</td>
			<td align="center" width="12%">
			<a href = "javascript:;" onclick="checkSettings();" >
			<img src="'.$config_var->ADMIN_TPL_URL.'images/shared/save.png" width="20" height="20" alt=""  align="top" />&nbsp;<b>'.SAVE.'</b></a></td>
		
			</tr>
			</table>';
			return $this->toolBr;
						
				}		
						

}