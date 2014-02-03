<?php
class dashboard_toolbar
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
}