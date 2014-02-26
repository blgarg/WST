<?php

class model_forum_showthread extends JDatabaseMySQL{  			
          var $qry = '';  
		  var $_result = '';                     
          function __construct( $options='' ){ }   			   		   
		  function initialize(){
				$this->tb_name = 'posts';
				echo $this->where = ' where 1 and status=1 and topic_id="'.$_REQUEST['topic_id'].'" ';
				$this->where .=' order by topic_id desc';
				$this->adjacents = '1';
				$this->page = '?mod=mod_forum&view=showthread&id='.$_REQUEST['id'].'&sub_cat='.$_REQUEST['sub_cat'].'&topic_id='.$_REQUEST['topic_id'].'';
				$this->pageLimit = '15';
				return $this->get_page_nav_front();				
			}	
			
			function getvarp(){
					$_data = $this->get_page_nav_front();  
					$this->cur = $_data['result'];
					$result_set = $this->loadAssoc();
						return array('result'=>$result_set,'nav'=>$_data['nav']);
				}
				
			function numRow(){
					$this->setQuery($this->qry);
					$array_aa = $this->getNumRows();
					return $array_aa;
				}

			
			//Fetch Sub Cat name
			function getCatById($id){
		  	$this->sql = "SELECT * from `forum_categories` where cat_id=$id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		//Fetch Sub Cat name
			function getTopicById($id){
		  	$this->sql = "SELECT * from `topics` where topic_id=$id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
			function getAllTopicImagesId($id){
		  		$this->sql = "SELECT * from `topic_image` where topic_id=$id  ";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
				//Fetch Sub Cat name
			function getSubCatById($id){
		  
		   $this->sql = "SELECT * from `forum_sub_categories` where sub_cat_id=$id";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getMainForumById($id){
		  		$this->sql = "SELECT * from `topics` where topic_by=0 and topic_subcat='".$id."'";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
			
		function getForumSubCatById($id){
		  		$this->sql = "SELECT topic_title from `topics` where topic_subcat=$id limit 5";
			  if($this->query()){
				 return $this->loadResultArray();
			   }
		}
		
		function getAllForumSubCatById($id){
		  		$this->sql = "SELECT * from `topics` where topic_subcat=$id order by topic_id desc";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getMainPostById($id){
		  		$this->sql = "SELECT * from `posts` where topic_id=$id  order by post_id desc";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
			function getAllPostSubCatById($id){
		  		$this->sql = "SELECT * from `posts` where topic_id=$id order by post_id desc ";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getAllPostImagesId($id){
		  		$this->sql = "SELECT * from `posts_image` where post_id=$id  ";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getUserName($id){
		  		$this->sql = "SELECT * from `users` where id=$id ";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		function getTotalPost($id){
		  		$this->sql = "SELECT * from `posts` where post_by=$id order by post_id desc ";
			  if($this->query()){
				 return $this->loadAssoc();
			   }
		}
		
		
}
