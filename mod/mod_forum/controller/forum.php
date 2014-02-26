<?php

class forum_controller extends JDatabaseMySQL
{
var $modName  = '';
	   function runController(){
	   if(!empty($_REQUEST['forum_thread']))
	   {
	   			$model_Forum_newthread = new model_Forum_newthread();
				$objects = new stdClass();
				if(isset($_FILES['image_load']) && !empty($_FILES['image_load']))
				{
					$image_err = $model_Forum_newthread->uploadimage($_FILES['image_load']);
					if($image_err['filename']!="")
					{
						foreach($image_err['filename'] as $filename)
						{
							if(!empty($filename))
							{
								$objects->filename[] = strip_tags(@$filename);
							}
						}
					}
				}
				
				$objects->categorytitle = strip_tags(@$_REQUEST['title']);
				$objects->categoryText = @$_REQUEST['categoryText'];
				$objects->category = strip_tags(@$_REQUEST['cat_id']);
				$objects->subcategory = strip_tags(@$_REQUEST['sub_cat']);
				if($model_Forum_newthread->inserData($objects)){
					$_SESSION['succ'] = "New Forum has been added successfully.";
					@header('Location:index.php?mod=mod_forum&view=detail&id='.$_REQUEST['cat_id'].'&sub_cat='.$_REQUEST['sub_cat'].'');
				}else{
					$_SESSION['error'] = "Error adding new Forum.";
					@header('Location:index.php?mod=mod_forum&view=newthread&id='.$_REQUEST['cat_id'].'&sub_cat='.$_REQUEST['sub_cat'].'');
				 }
	   }
	    
		if(!empty($_REQUEST['post']))
	   {
	   			$model_Forum_post = new model_Forum_post();
				$objects = new stdClass();
				if(isset($_FILES['image_load']) && !empty($_FILES['image_load']))
				{
					$image_err = $model_Forum_post->uploadimage($_FILES['image_load']);
					if($image_err['filename']!="")
					{
						foreach($image_err['filename'] as $filename)
						{
							if(!empty($filename))
							{
								$objects->filename[] = strip_tags(@$filename);
							}
						}
					}
				}
				
				$objects->categorytitle = strip_tags(@$_REQUEST['title']);
				$objects->categoryText = @$_REQUEST['categoryText'];
				$objects->category = strip_tags(@$_REQUEST['cat_id']);
				$objects->subcategory = strip_tags(@$_REQUEST['sub_cat']);
				$objects->topic_id = strip_tags(@$_REQUEST['topic_id']);
				if($model_Forum_post->inserData($objects)){
					$_SESSION['succ'] = "New Forum has been added successfully.";
					@header('Location:index.php?mod=mod_forum&view=showthread&id='.$_REQUEST['cat_id'].'&sub_cat='.$_REQUEST['sub_cat'].'&topic_id='.$_REQUEST['topic_id'].'');
				}else{
					$_SESSION['error'] = "Error adding new Forum.";
					@header('Location:index.php?mod=mod_forum&view=showthread&id='.$_REQUEST['cat_id'].'&sub_cat='.$_REQUEST['sub_cat'].'&topic_id='.$_REQUEST['topic_id'].'');
				 }
	   }
	   global $config_var;
		}
}
