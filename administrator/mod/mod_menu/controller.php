<?php
class controller 
{   var $tpl = '';
    function __construct(){	}
	
   
   function setTPL($renderUrl){		
   				$this->tpl = $renderUrl;
				return true;
				}
   
    function render()
	     {   if(isset($this->tpl)){ 
				
			include $this->tpl; 
			}     
			  }  
	  
	  
	  }