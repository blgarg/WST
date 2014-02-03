<?php
class model_tour_addImage extends JDatabaseMySQL{   			
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
			function getGalleryName($id){
			$this->sql = "SELECT * FROM `images` WHERE `id` =".$id ;
			$this->query();
			return $this->loadAssoc();
			}
}
