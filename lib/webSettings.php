<?php
class site extends JDatabaseMySQL
{  			
          var $qry = '';  
		  var $_result = '';
		  var $siteData;                     
          function __construct( $options='' )
		  { 
		  	 return self::getSite();
		  }	     			   		   
		  function initialize(){return true;}	
		  function getvarp(){return true;}
		  function getSite()
		  {
		  	  $this->sql = "SELECT * FROM  mgl_settings ";
			  if($this->query())
			  {
			   	$this->siteData = $this->loadAssoc();
		  	  }
		  }
			
}
