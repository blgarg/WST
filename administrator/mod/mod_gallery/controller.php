<?php
class controller  extends gallery_controller
{   var $tpl = '';
    function __construct(){ $this->runController(); }
	
   
   
   function setTPL($renderUrl){		
   				$this->tpl = $renderUrl;
				return true;
				}
   
    function render()
	     {   
		 	if(isset($this->tpl)){ 
			  include $this->tpl; 
			}     
			  }  
	  
	  
	  }