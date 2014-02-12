<?php

class model_partygirls_addImage extends JDatabaseMySQL{   			
          var $tableName;
		  var $pageTitle;
		  var $pageMetaTagTitle;
		  var $pageMetaDes;
		  var $pageContents;
		  var $cat_id;
		  var $pageCats = 24;
		  var $created_date;
		  var $page_title_link='';
		  var $qry = '';  
		  var $_result = '';     
		                     
         	function __construct(){}
		  	function initialize(){ return ;}	
			 	
			function getvarp(){ return; }
			function getpartygirlsName($id){
			$this->sql = "SELECT * FROM `party_girls_images` WHERE `id` =".$id ;
			$this->query();
			return $this->loadAssoc();
			}
}
