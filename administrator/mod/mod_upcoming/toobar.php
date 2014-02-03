<?php
class upcoming_toolbar
{    var $mod_view;
		var $toolBr = '';
     function __contruct(){}
	
	 function tooBar(){ 
	  switch(@$_GET['view'])
	   {
	     case 'default':
		 		return $this->dashboard();
				break;
		 case 'addNewbar':
		 		return $this->addNewbar();
				break;
		 case 'editbar':
		 		return $this->editbar();
				break;	
		
		 default:
		    return;
		  break;
	   }
	    }
	   
	   
	   
	   function dashboard(){
	   $config_var = new config();
	   $this->toolBr = '<table  cellpadding="0" cellspacing="0" width="100%" border="0" >
						<tr>
											
						
						</tr>
					            </table>';
						
						return $this->toolBr;
				}
		}